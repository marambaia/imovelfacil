<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Conteudos extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('text');
		$this->load->model('Opcoes_model', 'opcoes');
		$this->load->model('Paginas_model', 'paginas');
		$this->load->model('Conteudos_model', 'conteudos');
		$this->load->model('Arquivos_model', 'arquivos');
		$this->load->model('Caracteristicas_model', 'caracteristicas');
	}

	public function index() {
		redirect(base_url());
	}

	public function detalhes_conteudo($slug) {
		$conteudo 				  = $this->conteudos->detalhes_by_slug($slug);
		$dados['item'] 			  = $conteudo;
		
		// Carregando dados para o layout
		$html_header 			 	 = $this->tiles->cabecalho($conteudo->titulo, 'conteudos');
		$header['topo'] 		 	 = $this->tiles->topo();
		$header['menu_destaque'] 	 = $this->tiles->menu_destaque();
		$header['menu_principal']	 = $this->tiles->menu_principal();
		$dep['depoimentos'] 		 = $this->tiles->depoimentos();
		$hist['historias']			 = $this->tiles->historias();
		$contato['contato']			 = $this->tiles->contato();
		$footer['rodape']			 = $this->tiles->rodape();
		$search['lista_tipo_imovel'] = $this->tiles->lista_tipo_imovel();
		$search['lista_localidades'] = $this->tiles->lista_localidades();
		
		$imagens = $this->arquivos->listar_por_id_conteudo($conteudo->id_conteudo);
		$lista_imagens = '';
		foreach ($imagens as $imagem) {
			$lista_imagens .= '<li>';
			$lista_imagens .= '<a class="item-image" title="'.$imagem->descricao.'" data-lightbox="photo-list" href="'.base_url('/conteudo/'.$imagem->tipo.'/'.$imagem->nome.$imagem->extensao).'">';
			$lista_imagens .= img('/conteudo/'.$imagem->tipo.'/'.$imagem->nome.'_md'.$imagem->extensao);
			$lista_imagens .= '</a>';
			$lista_imagens .= '</li>';
		}
		$dados['fotos'] = $lista_imagens;
		
		$caracteristicas = $this->caracteristicas->listar_por_id_conteudo($conteudo->id_conteudo);
		if (!empty($caracteristicas[0]->nome)) {
			$nome_caracteristicas = unserialize($caracteristicas[0]->nome);
			$lista_caracteristicas = '';
			foreach ($nome_caracteristicas as $caracteristica) {
				$lista_caracteristicas .= '<li style="color: #4882CB;">'.$caracteristica.'</li>';
			}
			$dados['caracteristicas'] = $lista_caracteristicas;
		}
		
		$this->layout->region('html_header', 'view_html_header', $html_header);
		$this->layout->region('header', 'view_header', $header);
		$this->layout->region('quick_search_horizontal', 'quick_search_horizontal', $search);
		$this->layout->region('content', 'view_exibe_conteudo', $dados);
		$this->layout->region('contato_widget', 'contato_widget', $contato);
		$this->layout->region('historia_widget', 'historia_widget', $hist);
		$this->layout->region('depoimentos_widget', 'depoimentos_widget', $dep);
		$this->layout->region('footer', 'view_footer', $footer);
		$this->layout->region('html_footer', 'view_html_footer');
		 
		$this->layout->show('layout_conteudo');
		
	}
		
	public function buscar() {
		// Carregando dados para o layout
		$html_header 			 	 = $this->tiles->cabecalho('Resultado da Busca', 'busca');
		$header['topo'] 		 	 = $this->tiles->topo();
		$header['menu_destaque']  	 = $this->tiles->menu_destaque();
		$header['menu_principal']	 = $this->tiles->menu_principal();
		$dep['depoimentos'] 	 	 = $this->tiles->depoimentos();
		$hist['historias']		 	 = $this->tiles->historias();
		$contato['contato']		 	 = $this->tiles->contato();
		$footer['rodape']		 	 = $this->tiles->rodape();
		$script['busca']		 	 = TRUE; 
		$search['lista_tipo_imovel'] = $this->tiles->lista_tipo_imovel();
		$search['lista_localidades'] = $this->tiles->lista_localidades();
		
		$params = $this->input->post();
		$retorno_busca = '';
		
		if ( empty($params['localizacao']) &&  empty($params['tipo']) && empty($params['preco']) && empty($params['quartos']) && empty($params['banheiros']) && empty($params['suites']) &&  empty($params['garagem'])) {
			
			$resultados = $this->conteudos->listar_com_arquivo_principal($params);

			if ( ! empty($resultados) ) {
				$retorno_busca .= '<div class="clearfix list-view" id="new-listings">';
				foreach ($resultados as $resultado) { 
					$retorno_busca .= '<!-- One Box -->';
					$retorno_busca .= '<div class="listing-items box">';
					$retorno_busca .= '<div class="thumbnail-container">';
					$retorno_busca .= '<div class="localidade">'.$resultado->bairro.'</div>';
					$retorno_busca .= '<div class="images-available-container">';
					$retorno_busca .= '<div class="thumb-hover-wrapper single-slide-wrapper">';
					
					if ($resultado->quartos != 0 && $resultado->banheiros != 0) {
						$retorno_busca .= anchor(base_url('imovel/'.$resultado->slug), img(base_url('conteudo/'.$resultado->tipo_imagem.'/'.$resultado->imagem.'_md'.$resultado->extensao_imagem)), array('data-title' => $resultado->titulo, 'data-beds' => $resultado->quartos, 'data-baths' => $resultado->banheiros));
					} else {
						if ($resultado->quartos == 0 && $resultado->banheiros != 0) {
							$retorno_busca .= anchor(base_url('imovel/'.$resultado->slug), img(base_url('conteudo/'.$resultado->tipo_imagem.'/'.$resultado->imagem.'_md'.$resultado->extensao_imagem)), array('data-title' => $resultado->titulo, 'data-baths' => $resultado->banheiros));
						} else {
							if ($resultado->quartos != 0 && $resultado->banheiros == 0) {
								$retorno_busca .= anchor(base_url('imovel/'.$resultado->slug), img(base_url('conteudo/'.$resultado->tipo_imagem.'/'.$resultado->imagem.'_md'.$resultado->extensao_imagem)), array('data-title' => $resultado->titulo, 'data-beds' => $resultado->quartos));
							}
						}
						$retorno_busca .= anchor(base_url('imovel/'.$resultado->slug), img(base_url('conteudo/'.$resultado->tipo_imagem.'/'.$resultado->imagem.'_md'.$resultado->extensao_imagem)), array('data-title' => $resultado->titulo));
					}
					
					$retorno_busca .= '</div>';
					$retorno_busca .= '</div>';
					$retorno_busca .= '<div class="banner '.strtolower($resultado->tag).'">'.$resultado->tag.'</div>';
					$retorno_busca .= '</div>';
					$retorno_busca .= '<div class="item-details">';
					$retorno_busca .= '<h3>'.anchor(base_url('imovel/'.$resultado->slug), $resultado->titulo).'</h3>';
					$retorno_busca .= '<p>'.character_limiter($resultado->descricao, 220, '... '.anchor(base_url('imovel/'.$resultado->slug), '<span>Leia mais →</span>', array('class' => 'read_more'))).'</p>';
					$retorno_busca .= '</div>';
					$retorno_busca .= '<div class="price">'.$resultado->preco.'</div>';
					$retorno_busca .= '<div class="view-details">'.anchor(base_url('imovel/'.$resultado->slug), 'Ver Detalhes').'</div>';
					$retorno_busca .= '</div>';
					$retorno_busca .= '<!-- End One Box -->';
				}
				$retorno_busca .= '</div>';
			} else {
				$retorno_busca .= '<div class="post clearfix error_page">';
				$retorno_busca .= '<br />';
				$retorno_busca .= '<p>Nenhum imóvel foi encontrado com os itens selecionados.</p>';
				$retorno_busca .= '</div>';
			}
		} else {
			
			$resultados = $this->conteudos->listar_com_arquivo_principal($params);
			
			if ( ! empty($resultados) ) {
				$retorno_busca .= '<div class="clearfix list-view" id="new-listings">';
				foreach ($resultados as $resultado) {
					$retorno_busca .= '<!-- One Box -->';
					$retorno_busca .= '<div class="listing-items box">';
					$retorno_busca .= '<div class="thumbnail-container">';
					$retorno_busca .= '<div class="localidade">'.$resultado->bairro.'</div>';
					$retorno_busca .= '<div class="images-available-container">';
					$retorno_busca .= '<div class="thumb-hover-wrapper single-slide-wrapper">';
						
					if ($resultado->quartos != 0 && $resultado->banheiros != 0) {
						$retorno_busca .= anchor(base_url('imovel/'.$resultado->slug), img(base_url('conteudo/'.$resultado->tipo_imagem.'/'.$resultado->imagem.'_md'.$resultado->extensao_imagem)), array('data-title' => $resultado->titulo, 'data-beds' => $resultado->quartos, 'data-baths' => $resultado->banheiros));
					} else {
						if ($resultado->quartos == 0 && $resultado->banheiros != 0) {
							$retorno_busca .= anchor(base_url('imovel/'.$resultado->slug), img(base_url('conteudo/'.$resultado->tipo_imagem.'/'.$resultado->imagem.'_md'.$resultado->extensao_imagem)), array('data-title' => $resultado->titulo, 'data-baths' => $resultado->banheiros));
						} else {
							if ($resultado->quartos != 0 && $resultado->banheiros == 0) {
								$retorno_busca .= anchor(base_url('imovel/'.$resultado->slug), img(base_url('conteudo/'.$resultado->tipo_imagem.'/'.$resultado->imagem.'_md'.$resultado->extensao_imagem)), array('data-title' => $resultado->titulo, 'data-beds' => $resultado->quartos));
							}
						}
						$retorno_busca .= anchor(base_url('imovel/'.$resultado->slug), img(base_url('conteudo/'.$resultado->tipo_imagem.'/'.$resultado->imagem.'_md'.$resultado->extensao_imagem)), array('data-title' => $resultado->titulo));
					}
						
					$retorno_busca .= '</div>';
					$retorno_busca .= '</div>';
					$retorno_busca .= '<div class="banner '.strtolower($resultado->tag).'">'.$resultado->tag.'</div>';
					$retorno_busca .= '</div>';
					$retorno_busca .= '<div class="item-details">';
					$retorno_busca .= '<h3>'.anchor(base_url('imovel/'.$resultado->slug), $resultado->titulo).'</h3>';
					$retorno_busca .= '<p>'.character_limiter($resultado->descricao, 220, '... '.anchor(base_url('imovel/'.$resultado->slug), '<span>Leia mais →</span>', array('class' => 'read_more'))).'</p>';
					$retorno_busca .= '</div>';
					$retorno_busca .= '<div class="price">'.$resultado->preco.'</div>';
					$retorno_busca .= '<div class="view-details">'.anchor(base_url('imovel/'.$resultado->slug), 'Ver Detalhes').'</div>';
					$retorno_busca .= '</div>';
					$retorno_busca .= '<!-- End One Box -->';
				}
				$retorno_busca .= '</div>';
			} else {
				$retorno_busca .= '<div class="post clearfix error_page">';
				$retorno_busca .= '<br />';
				$retorno_busca .= '<p>Nenhum imóvel foi encontrado com os itens selecionados.</p>';
				$retorno_busca .= '</div>';
			}
		}
		$dados['busca'] = $retorno_busca;
		
		$this->layout->region('html_header', 'view_html_header', $html_header);
		$this->layout->region('header', 'view_header', $header);
		$this->layout->region('quick_search_horizontal', 'quick_search_horizontal', $search);
		$this->layout->region('content', 'view_resultado_busca', $dados);
		$this->layout->region('contato_widget', 'contato_widget', $contato);
		$this->layout->region('historia_widget', 'historia_widget', $hist);
		$this->layout->region('depoimentos_widget', 'depoimentos_widget', $dep);
		$this->layout->region('footer', 'view_footer', $footer);
		$this->layout->region('html_footer', 'view_html_footer', $script);
		 
		$this->layout->show('layout_conteudo');
	}
}
<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('Opcoes_model', 'opcoes');
		$this->load->model('Paginas_model', 'paginas');
		$this->load->model('Conteudos_model', 'conteudos');
	}
	
	public function index() {
		// Carregando dados para o layout
		$html_header 				 = $this->tiles->cabecalho('Max Imóveis', 'home');
		$header['topo'] 			 = $this->tiles->topo();
		$header['menu_destaque']	 = $this->tiles->menu_destaque();
		$header['menu_principal']	 = $this->tiles->menu_principal();
		$dep['depoimentos'] 	  	 = $this->tiles->depoimentos();
		$hist['historias']		 	 = $this->tiles->historias();
		$footer['rodape']			 = $this->tiles->rodape();
		$search['lista_tipo_imovel'] = $this->tiles->lista_tipo_imovel();
		$search['lista_localidades'] = $this->tiles->lista_localidades();
		
		$slides		  = $this->conteudos->listar_slides();
		$lista_slides = '';
		foreach ($slides as $slide) {
			# Slides
			$lista_slides .= '<li data-thumb="'.base_url('conteudo/'.$slide->tipo_imagem.'/'.$slide->imagem.'_pq'.$slide->extensao_imagem).'">';
			$lista_slides .= '<a href="#">'.img('conteudo/'.$slide->tipo_imagem.'/'.$slide->imagem.$slide->extensao_imagem).'</a>';
			$lista_slides .= '<div class="flex-caption">';
			$lista_slides .= '<p>'.$slide->titulo.'</p>';
			$lista_slides .= '<p><strong>'.$slide->preco.'</strong></p>';
			$lista_slides .= '</div>';
			$lista_slides .= '</li>';
		}
		$slider['slides']	 = $lista_slides;
		
		$conteudos 		 = $this->conteudos->listar_com_arquivo_principal();
		$lista_conteudos = '';
		foreach ($conteudos as $conteudo) {
			# Lista de imóveis
			$lista_conteudos .= '<!-- One Box -->';
			$lista_conteudos .= '<div class="listing-items box">';
			$lista_conteudos .= '<div class="thumbnail-container">';
			$lista_conteudos .= '<div class="localidade">'.$conteudo->bairro.'</div>';
			$lista_conteudos .= '<div class="images-available-container">';
			$lista_conteudos .= '<div class="thumb-hover-wrapper single-slide-wrapper">';
			
			if ($conteudo->quartos != 0 && $conteudo->banheiros != 0) {
				$lista_conteudos .= anchor(base_url($conteudo->slug), img('conteudo/'.$conteudo->tipo_imagem.'/'.$conteudo->imagem.'_md'.$conteudo->extensao_imagem), array('data-title' => $conteudo->titulo, 'data-beds' => $conteudo->quartos, 'data-baths' => $conteudo->banheiros));
			} else {
				if ($conteudo->quartos == 0 && $conteudo->banheiros != 0) { 
					$lista_conteudos .= anchor(base_url($conteudo->slug), img('conteudo/'.$conteudo->tipo_imagem.'/'.$conteudo->imagem.'_md'.$conteudo->extensao_imagem), array('data-title' => $conteudo->titulo, 'data-baths' => $conteudo->banheiros));
				} else {
					if ($conteudo->quartos != 0 && $conteudo->banheiros == 0) {
						$lista_conteudos .= anchor(base_url($conteudo->slug), img('conteudo/'.$conteudo->tipo_imagem.'/'.$conteudo->imagem.'_md'.$conteudo->extensao_imagem), array('data-title' => $conteudo->titulo, 'data-beds' => $conteudo->quartos));
					}
				}
				$lista_conteudos .= anchor(base_url($conteudo->slug), img('conteudo/'.$conteudo->tipo_imagem.'/'.$conteudo->imagem.'_md'.$conteudo->extensao_imagem), array('data-title' => $conteudo->titulo));
			}
				
			$lista_conteudos .= '</div>';
			$lista_conteudos .= '</div>';
			
			$lista_conteudos .= '<div class="banner '.strtolower($conteudo->tag).'">'.$conteudo->tag.'</div>';
			$lista_conteudos .= '</div>';
			$lista_conteudos .= '<div class="item-details">';
			$lista_conteudos .= '<h3>'.anchor(base_url($conteudo->slug), $conteudo->titulo).'</h3>';
			//$lista_conteudos .= '<p>...<a class="read_more" href="'.base_url($conteudo->slug).'"><span>Leia mais &rarr;</span></a></p>';
			$lista_conteudos .= '</div>';
			
			if ( ! empty($conteudo->preco) && $conteudo->preco != 'R$ 0,00') {
				$lista_conteudos .= '<div class="price">'.$conteudo->preco.'</div>';
			} else {
				$lista_conteudos .= '<div class="price"> Saiba o preço com nossos consultores. </div>';
			}
			
			$lista_conteudos .= '<div class="view-details">';
			$lista_conteudos .= anchor(base_url('imovel/'.$conteudo->slug), 'Ver Detalhes');
			$lista_conteudos .= '</div>';
			$lista_conteudos .= '</div>';
			$lista_conteudos .= '<!-- End One Box -->';
		}
		$content['conteudo'] = $lista_conteudos;
		
		$this->layout->region('html_header', 'view_html_header', $html_header);
		$this->layout->region('header', 'view_header', $header);
		$this->layout->region('slider', 'slider', $slider);
		$this->layout->region('quick_search', 'quick_search', $search);
		$this->layout->region('content', 'view_content', $content);
		$this->layout->region('historia', 'historia_widget', $hist);
		$this->layout->region('depoimentos', 'depoimentos_widget', $dep);
		$this->layout->region('footer', 'view_footer', $footer);
		$this->layout->region('html_footer', 'view_html_footer');
		 
		$this->layout->show('layout');
		
	}
	
	public function erro_404() {
		$this->load->view('erro_404');
	}
}
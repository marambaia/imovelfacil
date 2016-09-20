<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Paginas extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('text');
		$this->load->model('Paginas_model', 'paginas');
	}

	public function index() {
		redirect(base_url());
	}

	public function detalhes_pagina($slug) {
		// API de mapas do Google
		$this->load->library('googlemaps');
		
		$pagina 				  = $this->paginas->detalhes_by_slug($slug);
		$dados['item'] 			  = $pagina;

		// Carregando dados para o layout
		$html_header 			 	 = $this->tiles->cabecalho($pagina->nome, 'paginas');
		$header['topo'] 		 	 = $this->tiles->topo();
		$header['menu_destaque'] 	 = $this->tiles->menu_destaque();
		$header['menu_principal']	 = $this->tiles->menu_principal();
		$dep['depoimentos'] 		 = $this->tiles->depoimentos();
		$hist['historias']			 = $this->tiles->historias();
		$contato['contato']			 = $this->tiles->contato();
		$footer['rodape']			 = $this->tiles->rodape();
		$search['lista_tipo_imovel'] = $this->tiles->lista_tipo_imovel();
		$search['lista_localidades'] = $this->tiles->lista_localidades();
		
		// Mapa
		$config['center'] = '-22.789243,-43.307844';
		$config['zoom'] = '16';
		$this->googlemaps->initialize($config);
		$marker = array();
		$marker['position'] = '-22.789243,-43.307844';
		$this->googlemaps->add_marker($marker);
		$dados['map'] = $this->googlemaps->create_map();

		$content_page = '';
		$contato_widget = 'contato_widget';
		switch ($slug)
		{
			case 'sobre-nos':
				$content_page = 'view_exibe_pagina_sobre';
			break;
			case 'contatos':
				$content_page = 'view_exibe_pagina_contato';
				$contato_widget = 'contato_widget_hide';
			break;
			case 'solicite-uma-visita':
				$content_page = 'view_exibe_pagina_visita';
				$contato_widget = 'contato_widget_hide';
			break;
			case 'venda-seu-imovel':
				$content_page = 'view_exibe_pagina_visita';
				$contato_widget = 'contato_widget_hide';
			break;
			case 'compre-seu-imovel':
				$content_page = 'view_exibe_pagina_visita';
				$contato_widget = 'contato_widget_hide';
			break;
			default:
				$content_page = 'view_exibe_pagina';
		}
		
		$this->layout->region('html_header', 'view_html_header', $html_header);
		$this->layout->region('header', 'view_header', $header);
		$this->layout->region('quick_search_horizontal', 'quick_search_horizontal', $search);
		$this->layout->region('content', $content_page, $dados);
		$this->layout->region('contato_widget', $contato_widget, $contato);
		$this->layout->region('historia_widget', 'historia_widget', $hist);
		$this->layout->region('depoimentos_widget', 'depoimentos_widget', $dep);
		$this->layout->region('footer', 'view_footer', $footer);
		$this->layout->region('html_footer', 'view_html_footer');
			
		$this->layout->show('layout_conteudo');
	
	}
}
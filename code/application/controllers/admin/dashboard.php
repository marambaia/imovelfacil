<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	var $avatar;
	
	public function __construct() 
	{
		parent::__construct();
		
		if ( !$this->session->userdata('session_id') || !$this->session->userdata('logado')) 
			redirect(base_url('admin/home'));

		$this->load->model('Paginas_model', 'paginas');
		$this->load->helper('form');
		$this->load->helper('text');
		$this->load->library('table');
		
		$this->avatar  = $this->tiles->avatar();
	}
	
	public function index() {
		$header['avatar']  = $this->avatar['avatar'];
		$header['usuario'] = $this->avatar['usuario'];

		$paginas		  = $this->paginas->listar();
		$dados['paginas'] = $paginas;
		
		$this->layout->region('html_header', 'admin/layouts/html_header');
		$this->layout->region('header', 'admin/layouts/header', $header);
		$this->layout->region('menu', 'admin/layouts/_menu');
		$this->layout->region('body', 'admin/dashboard/_list', $dados);
		$this->layout->region('footer', 'admin/layouts/footer');
		$this->layout->region('html_footer', 'admin/layouts/html_footer');

		$this->layout->show('admin/layouts/main');
	}

	public function novo()
	{
		$paginas			 = $this->paginas->listar();
		$dados['paginas'] = $paginas;
	
		$this->load->view('admin/layouts/html_header');
		$this->load->view('admin/menu');
		$this->load->view('admin/form_paginas', $dados);
		$this->load->view('admin/layouts/html_footer');
	}
	
	public function adicionar() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('slug', 'Slug', 'required');
		if ($this->form_validation->run() == false) {
			$this->index();
		} else {
			$nome 			= $this->input->post('nome');
			$slug 			= $this->input->post('slug');
			$descricao 		= $this->input->post('descricao');
			$nivel_exibicao = $this->input->post('nivel_exibicao');
			$status 		= $this->input->post('status');
			$filho_de 		= $this->input->post('filho_de');
			$ordem 			= $this->input->post('ordem');
			
			if ($this->paginas->adicionar($nome, $slug, $descricao, $nivel_exibicao, $status, $filho_de, $ordem)) {
				$this->session->set_flashdata('msg', '<p>pagina "'. $nome .'" adicionado com sucesso.</p>');
			} else {
				$this->session->set_flashdata('msg', '<p>Não foi possível adicionar a pagina.</p>');
			}
			redirect(base_url('admin/paginas/novo'));
		}
	}
	
	public function editar($pagina = NULL) {
		$campos = 'id_pagina, nome';
		$order_by = 'ordem';
		$dados['lista_paginas'] = $this->paginas->listar_campos($campos, $order_by);
		$dados['pagina'] = $this->paginas->ver($pagina);
		
		$this->load->view('admin/layouts/html_header');
		$this->load->view('admin/menu');
		$this->load->view('admin/editar_paginas', $dados);
		$this->load->view('admin/layouts/html_footer');
	}
	
	public function alterar() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nome', 'Nome da pagina', 'required');
		$this->form_validation->set_rules('slug', 'Slug da pagina', 'required');
		if ($this->form_validation->run() == false) {
			$this->index();
		} else {
			$id_pagina 	= $this->input->post('id_pagina');
			$nome 			= $this->input->post('nome');
			$slug 			= $this->input->post('slug');
			$descricao 		= $this->input->post('descricao');
			$nivel_exibicao = $this->input->post('nivel_exibicao');
			$status 		= $this->input->post('status');
			$filho_de 		= $this->input->post('filho_de');
			$ordem 			= $this->input->post('ordem');
				
			if ($this->paginas->alterar($id_pagina, $nome, $slug, $descricao, $nivel_exibicao, $status, $filho_de, $ordem)) {
				redirect(base_url('admin/paginas/#cadastro'));
			} else {
				die('Não foi possível alterar a pagina');
			}
		}
	}
	
	public function excluir($id_pagina) {
		if ($this->paginas->excluir($id_pagina)) {
			redirect(base_url('admin/paginas/#cadastro'));
		} else {
			die('Não foi possível excluir a pagina');
		}
	}
	
}
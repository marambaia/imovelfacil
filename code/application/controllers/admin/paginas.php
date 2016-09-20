<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paginas extends CI_Controller {
	
	var $avatar;
	
	public function __construct() {
		parent::__construct();
		
		if ( !$this->session->userdata('session_id') || !$this->session->userdata('logado')) {
			redirect(base_url('admin/home'));
		}
		
		$this->load->model('Paginas_model', 'paginas');
		$this->load->helper('form');
		$this->load->helper('text');
		$this->load->library('table');
		$this->load->library('form_validation');
		
		$this->avatar = $this->tiles->avatar();
	}
	
	public function index($pagina = null) {
		$header['avatar']  = $this->avatar['avatar'];
		$header['usuario'] = $this->avatar['usuario'];
		$paginas		  = $this->paginas->listar('nome');
		$dados['paginas'] = $paginas;
		
		$this->layout->region('html_header', 'admin/layouts/html_header');
		$this->layout->region('header', 'admin/layouts/header', $header);
		$this->layout->region('menu', 'admin/layouts/_menu');
		$this->layout->region('body', 'admin/paginas/_list', $dados);
		$this->layout->region('footer', 'admin/layouts/footer');
		$this->layout->region('html_footer', 'admin/layouts/html_footer');

		$this->layout->show('admin/layouts/main');
	}

	public function cadastrar()
	{
		$header['avatar']  = $this->avatar['avatar'];
		$header['usuario'] = $this->avatar['usuario'];
		$paginas		  = $this->paginas->listar();
		$dados['paginas'] = $paginas;
		
		if ( $this->input->server('REQUEST_METHOD') === 'POST' )
		{
			$this->form_validation->set_rules('nome', 'Nome', 'required');
			$this->form_validation->set_rules('slug', 'Slug', 'required');
			
			if ($this->form_validation->run() != false)
			{
				$id_usuario		= $this->session->userdata('id');
				$nome 			= $this->input->post('nome');
				$slug 			= $this->input->post('slug');
				$descricao 		= $this->input->post('descricao');
				$nivel_exibicao = $this->input->post('nivel_exibicao');
				$status 		= $this->input->post('status');
				$filho_de 		= $this->input->post('filho_de');
				$ordem 			= $this->input->post('ordem');
					
				if ($this->paginas->adicionar($id_usuario, $nome, $slug, $descricao, $nivel_exibicao, $status, $filho_de, $ordem))
				{
					$this->session->set_flashdata('msg', '<p>Pronto! A página <strong>'. $nome .'</strong> foi adicionada com sucesso.</p>');
				}
				else
				{
					$this->session->set_flashdata('msg_error', '<p>Não foi possível adicionar a pagina. Tente novamente!</p>');
				}
				
				redirect('/admin/paginas');
				
			}
			
		}
		
		$this->layout->region('html_header', 'admin/layouts/html_header');
		$this->layout->region('header', 'admin/layouts/header', $header);
		$this->layout->region('menu', 'admin/layouts/_menu');
		$this->layout->region('body', 'admin/paginas/_form', $dados);
		$this->layout->region('footer', 'admin/layouts/footer');
		$this->layout->region('html_footer', 'admin/layouts/html_footer');

		$this->layout->show('admin/layouts/main');
	}
	
	public function editar($pagina = NULL) 
	{
		$header['avatar']  = $this->avatar['avatar'];
		$header['usuario'] = $this->avatar['usuario'];
		$paginas		  = $this->paginas->listar();
		$dados['paginas'] = $paginas;
		$editar			  = $this->paginas->ver($pagina);
		$dados['editar']  = $editar;
		
		if ( $this->input->server('REQUEST_METHOD') === 'POST' )
		{
			$this->form_validation->set_rules('nome', 'Nome', 'required');
			$this->form_validation->set_rules('slug', 'Slug', 'required');
			
			if ($this->form_validation->run() != false) {
				$id_pagina		= $this->input->post('id_pagina');
				$id_usuario		= $this->session->userdata('id');
				$nome 			= $this->input->post('nome');
				$slug 			= $this->input->post('slug');
				$descricao 		= $this->input->post('descricao');
				$nivel_exibicao = $this->input->post('nivel_exibicao');
				$status 		= $this->input->post('status');
				$filho_de 		= $this->input->post('filho_de');
				$ordem 			= $this->input->post('ordem');

				if ($this->paginas->alterar($id_pagina, $id_usuario, $nome, $slug, $descricao, $nivel_exibicao, $status, $filho_de, $ordem)) 
				{
					$this->session->set_flashdata('msg', '<p>Pronto! A página <strong>'. $nome .'</strong> foi editada com sucesso.</p>');
				} 
				else 
				{
					$this->session->set_flashdata('msg_error', '<p>Não foi possível editar a pagina. Tente novamente!</p>');
				}
				
				redirect(base_url('admin/paginas'));
				
			}
		}
			
		$this->layout->region('html_header', 'admin/layouts/html_header');
		$this->layout->region('header', 'admin/layouts/header', $header);
		$this->layout->region('menu', 'admin/layouts/_menu');
		$this->layout->region('body', 'admin/paginas/_form', $dados);
		$this->layout->region('footer', 'admin/layouts/footer');
		$this->layout->region('html_footer', 'admin/layouts/html_footer');
		
		$this->layout->show('admin/layouts/main');
	}
	
	public function excluir($id_pagina) {
		if ($this->paginas->excluir($id_pagina)) 
		{
			$this->session->set_flashdata('msg', '<p>Pronto! A página foi excluída com sucesso.</p>');
		} 
		else 
		{
			$this->session->set_flashdata('msg', '<p>Não foi possível excluir a pagina. Tente novamente!</p>');
		}
		
		redirect(base_url('admin/paginas'));
		
	}
	
}
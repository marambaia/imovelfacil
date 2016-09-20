<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Depoimentos extends CI_Controller {
	
	var $avatar;
	
	public function __construct() {
		parent::__construct();
		
		if ( !$this->session->userdata('session_id') || !$this->session->userdata('logado')) {
			redirect(base_url('admin/home'));
		}
		
		$this->load->model('Depoimentos_model', 'depoimentos');
		$this->load->helper('form');
		$this->load->helper('text');
		$this->load->library('table');
		$this->load->library('form_validation');
		
		$this->avatar = $this->tiles->avatar();
	}
	
	public function index() {
		$header['avatar']  = $this->avatar['avatar'];
		$header['usuario'] = $this->avatar['usuario'];
		$dados['depoimentos'] = $this->depoimentos->listar();
		
		$this->layout->region('html_header', 'admin/layouts/html_header');
		$this->layout->region('header', 'admin/layouts/header', $header);
		$this->layout->region('menu', 'admin/layouts/_menu');
		$this->layout->region('body', 'admin/depoimentos/_list', $dados);
		$this->layout->region('footer', 'admin/layouts/footer');
		$this->layout->region('html_footer', 'admin/layouts/html_footer');
		
		$this->layout->show('admin/layouts/main');
	}
	
	public function ver($id_depoimento) 
	{
		$dados['depoimento'] = $this->depoimentos->ver($id_depoimento);
		
		$this->layout->region('html_header', 'admin/layouts/html_header');
		$this->layout->region('header', 'admin/layouts/header');
		$this->layout->region('menu', 'admin/layouts/_menu');
		$this->layout->region('body', 'admin/depoimentos/view', $dados);
		$this->layout->region('footer', 'admin/layouts/footer');
		$this->layout->region('html_footer', 'admin/layouts/html_footer');
	
		$this->layout->show('admin/layouts/column0');
	}
	
	public function cadastrar()
	{
		$header['avatar']  = $this->avatar['avatar'];
		$header['usuario'] = $this->avatar['usuario'];
	
		if ( $this->input->server('REQUEST_METHOD') === 'POST' )
		{
			$this->form_validation->set_rules('autor', 'Autor', 'required');
			$this->form_validation->set_rules('texto', 'Depoimento', 'required');
				
			if ($this->form_validation->run() != false)
			{
				$depoimento['id_usuario'] = $this->session->userdata('id');
				$depoimento['autor']  	  = $this->input->post('autor');
				$depoimento['email']	  = $this->input->post('email');
				$depoimento['ordem'] 	  = $this->input->post('ordem');
				$depoimento['texto']	  = $this->input->post('texto');
				$depoimento['status']	  = $this->input->post('status');
				
				if ($this->depoimentos->adicionar($depoimento)) 
				{
					$this->session->set_flashdata('msg', '<p>Pronto!O depoimento de <strong>'.$depoimento['autor'].'</strong> foi adicionado com sucesso.</p>');
				}
				else
				{
					$this->session->set_flashdata('msg_error', '<p>Não foi possível adicionar o depoimento. Tente novamente!</p>');
				}
	
				redirect('/admin/depoimentos');
	
			}
				
		}
		
		$this->layout->region('html_header', 'admin/layouts/html_header');
		$this->layout->region('header', 'admin/layouts/header', $header);
		$this->layout->region('menu', 'admin/layouts/_menu');
		$this->layout->region('body', 'admin/depoimentos/_form');
		$this->layout->region('footer', 'admin/layouts/footer');
		$this->layout->region('html_footer', 'admin/layouts/html_footer');
		
		$this->layout->show('admin/layouts/main');
	}
	
	public function editar($id_depoimento = NULL)
	{
		$header['avatar']  = $this->avatar['avatar'];
		$header['usuario'] = $this->avatar['usuario'];
		$dados['editar']  = $this->depoimentos->ver($id_depoimento);
		
		if ( $this->input->server('REQUEST_METHOD') === 'POST' )
		{
			$this->form_validation->set_rules('autor', 'Autor', 'required');
			$this->form_validation->set_rules('texto', 'Depoimento', 'required');
				
			if ($this->form_validation->run() != false) 
			{
				$depoimento['id_depoimento'] = $this->input->post('id_depoimento');
				$depoimento['id_usuario'] 	 = $this->session->userdata('id');
				$depoimento['autor']  	 	 = $this->input->post('autor');
				$depoimento['email']	  	 = $this->input->post('email');
				$depoimento['ordem'] 	 	 = $this->input->post('ordem');
				$depoimento['texto']	 	 = $this->input->post('texto');
				$depoimento['status']	 	 = $this->input->post('status');
	
				if ($this->depoimentos->alterar($depoimento))
				{
					$this->session->set_flashdata('msg', '<p>Pronto! O depoimento de <strong>'.$depoimento['autor'].'</strong> foi editado com sucesso.</p>');
				}
				else
				{
					$this->session->set_flashdata('msg_error', '<p>Não foi possível editar o depoimento. Tente novamente!</p>');
				}
	
				redirect(base_url('admin/depoimentos'));
	
			}
		}
			
		$this->layout->region('html_header', 'admin/layouts/html_header');
		$this->layout->region('header', 'admin/layouts/header', $header);
		$this->layout->region('menu', 'admin/layouts/_menu');
		$this->layout->region('body', 'admin/depoimentos/_form', $dados);
		$this->layout->region('footer', 'admin/layouts/footer');
		$this->layout->region('html_footer', 'admin/layouts/html_footer');
	
		$this->layout->show('admin/layouts/main');
	}
	
	public function excluir($id_depoimento) {
		if ($this->depoimentos->excluir($id_depoimento)) 
		{
			$this->session->set_flashdata('msg', '<p>Pronto! O depoimentos foi excluído com sucesso.</p>');
		}
		else
		{
			$this->session->set_flashdata('msg', '<p>Não foi possível excluir o depoimento. Tente novamente!</p>');
		}
		
		redirect(base_url('admin/depoimentos'));
	}
	
}
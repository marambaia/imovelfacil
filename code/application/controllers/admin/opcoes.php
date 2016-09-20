<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Opcoes extends CI_Controller {
	
	var $avatar;
	
	public function __construct() {
		parent::__construct();
		
		if ( !$this->session->userdata('session_id') || !$this->session->userdata('logado')) {
			redirect(base_url('admin/home'));
		}
		
		$this->load->model('Opcoes_model', 'opcoes');
		$this->load->helper('form');
		$this->load->helper('text');
		$this->load->library('table');
		$this->load->library('form_validation');
		
		$this->avatar = $this->tiles->avatar();
	}
	
	public function index() {
		$header['avatar']  = $this->avatar['avatar'];
		$header['usuario'] = $this->avatar['usuario'];
		$opcoes 		  = $this->opcoes->listar();
		$dados['opcoes']  = $opcoes;
		
		$this->layout->region('html_header', 'admin/layouts/html_header');
		$this->layout->region('header', 'admin/layouts/header', $header);
		$this->layout->region('menu', 'admin/layouts/_menu');
		$this->layout->region('body', 'admin/opcoes/_list', $dados);
		$this->layout->region('footer', 'admin/layouts/footer');
		$this->layout->region('html_footer', 'admin/layouts/html_footer');
		
		$this->layout->show('admin/layouts/main');
	}
	
	public function ver($id_opcao) 
	{
		$opcao 			  = $this->opcoes->ver($id_opcao);
		$dados['opcao']   = $opcao;
	
		$this->layout->region('html_header', 'admin/layouts/html_header');
		$this->layout->region('header', 'admin/layouts/header');
		$this->layout->region('menu', 'admin/layouts/_menu');
		$this->layout->region('body', 'admin/opcoes/view', $dados);
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
			$this->form_validation->set_rules('nome', 'Nome', 'required');
			$this->form_validation->set_rules('valor', 'Valor', 'required');
				
			if ($this->form_validation->run() != false)
			{
				$opcao['id_usuario'] = $this->session->userdata('id');
				$opcao['nome']  	 = $this->input->post('nome');
				$opcao['valor']		 = $this->input->post('valor');
				$opcao['ordem'] 	 = $this->input->post('ordem');
				
				if ($this->opcoes->adicionar($opcao)) 
				{
					$this->session->set_flashdata('msg', '<p>Pronto!O item <strong>'. $nome .'</strong> foi adicionado com sucesso.</p>');
				}
				else
				{
					$this->session->set_flashdata('msg_error', '<p>Não foi possível adicionar o item. Tente novamente!</p>');
				}
	
				redirect('/admin/opcoes');
	
			}
				
		}
		
		$this->layout->region('html_header', 'admin/layouts/html_header');
		$this->layout->region('header', 'admin/layouts/header', $header);
		$this->layout->region('menu', 'admin/layouts/_menu');
		$this->layout->region('body', 'admin/opcoes/_form');
		$this->layout->region('footer', 'admin/layouts/footer');
		$this->layout->region('html_footer', 'admin/layouts/html_footer');
		
		$this->layout->show('admin/layouts/main');
	}
	
	public function editar($id_opcao = NULL)
	{
		$header['avatar']  = $this->avatar['avatar'];
		$header['usuario'] = $this->avatar['usuario'];
		$dados['editar']  = $this->opcoes->ver($id_opcao);
		
		if ( $this->input->server('REQUEST_METHOD') === 'POST' )
		{
			$this->form_validation->set_rules('nome', 'Nome', 'required');
			$this->form_validation->set_rules('valor', 'Valor', 'required');
				
			if ($this->form_validation->run() != false) {
				$opcao['id_opcao']	 = $this->input->post('id_opcao');
				$opcao['id_usuario'] = $this->session->userdata('id');
				$opcao['nome'] 		 = $this->input->post('nome');
				$opcao['valor'] 	 = $this->input->post('valor');
				$opcao['ordem'] 	 = $this->input->post('ordem');
	
				if ($this->opcoes->alterar($opcao))
				{
					$this->session->set_flashdata('msg', '<p>Pronto! A ítem <strong>'. $nome .'</strong> foi editado com sucesso.</p>');
				}
				else
				{
					$this->session->set_flashdata('msg_error', '<p>Não foi possível editar o ítem. Tente novamente!</p>');
				}
	
				redirect(base_url('admin/opcoes'));
	
			}
		}
			
		$this->layout->region('html_header', 'admin/layouts/html_header');
		$this->layout->region('header', 'admin/layouts/header', $header);
		$this->layout->region('menu', 'admin/layouts/_menu');
		$this->layout->region('body', 'admin/opcoes/_form', $dados);
		$this->layout->region('footer', 'admin/layouts/footer');
		$this->layout->region('html_footer', 'admin/layouts/html_footer');
	
		$this->layout->show('admin/layouts/main');
	}
	
	public function excluir($id_opcao) {
		if ($this->opcoes->excluir($id_opcao)) 
		{
			$this->session->set_flashdata('msg', '<p>Pronto! O ítem foi excluído com sucesso.</p>');
		}
		else
		{
			$this->session->set_flashdata('msg', '<p>Não foi possível excluir o ítem. Tente novamente!</p>');
		}
		
		redirect(base_url('admin/opcoes'));
	}
	
}
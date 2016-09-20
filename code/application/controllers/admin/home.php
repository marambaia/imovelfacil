<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
	}
	
	public function index() {
		$data = array('style' => 'background: none repeat scroll 0 0 #383E4B;');
		$this->load->view('admin/layouts/html_header', $data);
		$this->load->view('admin/login/index');
		$this->load->view('admin/layouts/html_footer');
	}
	
	public function login() {
		$usuario = $this->input->post('usuario');
		$senha = $this->input->post('senha');
		$this->db->where('usuario', $usuario);
		$this->db->where('senha', $senha);
		$this->db->where('status', 1);
		$usuario = $this->db->get('usuarios')->result();
		if (count($usuario)===1) {
			$dados = array(
					'id' 	  => $usuario[0]->id_usuario,
					'logado'  => TRUE,
			);
			$this->session->set_userdata($dados);
			redirect(base_url('admin/dashboard'));
		} else {
			redirect(base_url('admin/home'));
		}
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('admin/home');
	}
}
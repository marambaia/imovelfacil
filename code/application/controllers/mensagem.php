<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed.');

class Mensagem extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('Mensagens_model', 'mensagens');
	}
	
	public function index() {
		redirect(base_url('/pagina/contatos'));
	}
	
	public function enviar() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('contact_name', 'Nome', 'required');
		$this->form_validation->set_rules('contact_email', 'E-mail', 'required|valid_email');
		$this->form_validation->set_rules('contact_message', 'Mensagem', 'required');
		if ($this->form_validation->run() == false) {
			echo 'error';
			die();
		} else {
			// Seta os dados recebidos por post
			$dados['nome'] = $this->input->post('contact_name');
			$dados['email'] = $this->input->post('contact_email');
			$dados['telefone'] = $this->input->post('contact_phone');
			$dados['texto'] = $this->input->post('contact_message');
			$dados['tipo'] = $this->input->post('contact_type');
			
			// Grava no banco
			$this->mensagens->adicionar($dados);
			
			// Envia a mensagem por e-mail
			$mensagem = $this->load->view('mensagem', $dados, TRUE);
			$this->load->library('email');
			$this->email->from($this->input->post('contact_email'), $this->input->post('contact_name'));
			//$this->email->to('souzadeandrade@yahoo.com.br');
			$this->email->to('bernardo.albuquerque@yahoo.com.br');
			$this->email->bcc('bernardomais@gmail.com'); // Com cópia oculta para 
			$this->email->subject('Max Imóveis :: Mensagem enviada por: ' . $this->input->post('contact_name'));
			$this->email->message($mensagem);
			if ($this->email->send()) {
				echo 'sent';
			} else {
				echo 'error';
			}
		}
	}
	
	public function enviar_visita() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('contact_name', 'Nome', 'required');
		$this->form_validation->set_rules('contact_address', 'Endereço', 'required');
		if ($this->form_validation->run() == false) {
			echo 'error';
			die();
		} else {
			// Seta os dados recebidos por post
			$dados['nome'] = $this->input->post('contact_name');
			$dados['email'] = $this->input->post('contact_email');
			$dados['telefone'] = $this->input->post('contact_phone');
			$dados['texto'] = $this->input->post('contact_address');
			$dados['tipo'] = $this->input->post('contact_type');
			
			$view = '';
			switch ($dados['tipo'])
			{
				case 'solicite-uma-visita':
					$dados['tipo'] = 'visita';
					$view = 'mensagem_visita';
				break;
				case 'compre-seu-imovel':
					$dados['tipo'] = 'compra';
					$view = 'mensagem_compra';
				break;
				case 'venda-seu-imovel':
					$dados['tipo'] = 'venda';
					$view = 'mensagem_venda';
				break;
			}
				
			// Grava no banco
			$this->mensagens->adicionar($dados);
				
			// Envia a mensagem por e-mail
			$mensagem = $this->load->view($view, $dados, TRUE);
			$this->load->library('email');
			$this->email->from($this->input->post('contact_email'), $this->input->post('contact_name'));
			//$this->email->to('souzadeandrade@yahoo.com.br');
			$this->email->to('bernardo.albuquerque@yahoo.com.br');
			$this->email->bcc('bernardomais@gmail.com'); // Com cópia oculta para
			$this->email->subject('Max Imóveis  :: Solicitação de visita enviada por: ' . $this->input->post('contact_name'));
			$this->email->message($mensagem);
			if ($this->email->send()) {
				echo 'sent';
			} else {
				echo 'error';
			}
		}
	}
}
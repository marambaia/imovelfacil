<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Destaques extends CI_Controller
{
	public function __construct() 
	{
		parent::__construct();
		
		if (!$this->session->userdata('session_id') || !$this->session->userdata('logado'))
		{
			redirect(base_url('admin/home'));
		}
		
		$this->load->model('Conteudos_model', 'conteudos');
		$this->load->model('Arquivos_model', 'arquivos');
		$this->load->helper('form');
		$this->load->helper('text');
		$this->load->library('m2brimagem');
		$this->load->library('table');
	}
	
	public function index($id = null) 
	{
		$dados['conteudos'] = $this->conteudos->listar();
		$dados['arquivos'] = $this->arquivos->listar($id);
		$this->load->view('admin/html_header');
		$this->load->view('admin/menu');
		$this->load->view('admin/destaques', $dados);
		$this->load->view('admin/html_footer');
	}
	
	public function nova_imagem() {
		$dados['conteudos'] = $this->conteudos->listar();
		$this->load->view('admin/html_header');
		$this->load->view('admin/menu');
		$this->load->view('admin/form_destaques', $dados);
		$this->load->view('admin/html_footer');
	}
	
	public function adicionar() 
	{
		$this->load->library('form_validation');
		$this->load->library('file_validation');
		
		// Regras do Form Validation
		$this->form_validation->set_rules('id_conteudo', 'PERTENCE À', 'greater_than[0]');
		$this->form_validation->set_rules('tipo', 'TIPO', 'alpha');
		
		// Mensagens customizadas para o Form Validation
		$this->form_validation->set_message('greater_than', 'O campo %s é obrigatório.');
		$this->form_validation->set_message('alpha', 'O campo %s é obrigatório.');
		
		// Regras do File Validation
		$this->file_validation->set_rules('userfile', 'ARQUIVOS & IMAGENS', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			
			$id_conteudo  = $this->input->post('id_conteudo');
			$tipo 		  = $this->input->post('tipo');
			$array_upload = $this->upload_imagem($tipo);
			$nome 		  = $array_upload['raw_name'];
			$extensao 	  = $array_upload['file_ext'];
			
			if (empty($nome))
			{
				$this->session->set_flashdata('msg', $array_upload['error']);
				redirect(base_url('admin/arquivos'));
			}
			
			$slug_destaque 	 = $this->input->post('slug_destaque');
			$titulo_destaque = $this->input->post('titulo_destaque');
			$texto_destaque  = $this->input->post('texto_destaque');
			
			if ($this->arquivos->inserir($id_arquivo, $id_conteudo, $nome, $tipo, $extensao, $slug_destaque, $titulo_destaque, $texto_destaque)) 
			{
				redirect(base_url('admin/arquivos/redimencionar/'.$nome));
			} 
			else 
			{
				$this->session->set_flashdata('msg', '<p>Não foi possível inserir o arquivo.</p>');
				redirect(base_url('admin/arquivos'));
			}
		}
	}
	
	public function redimencionar($nome)
	{
		$imagem 			= $this->arquivos->listar_por_nome($nome);
		$img 				= 'conteudo/'.$imagem[0]->tipo.'/'.$imagem[0]->nome.$imagem[0]->extensao;
		$dados['tipo'] 		= $imagem[0]->tipo;
		$dados['nome'] 		= $imagem[0]->nome;
		$dados['extensao'] 	= $imagem[0]->extensao;
		$dados['path'] 		= $img;
		
		// Pegando dados da imagem
		$dadosImg = getimagesize($img);

		// Setando dados para o crop
		$dados['largura'] = $dadosImg[0];
		
		if ($dadosImg[1] > 496)
			$dados['altura'] = 496;
		else
			$dados['altura'] = $dadosImg[1];
		
		// Montando a página com os dados
		$this->load->view('admin/html_header');
		$this->load->view('admin/menu');
		$this->load->view('admin/redimencionar', $dados);
		$this->load->view('admin/html_footer');
	}
	
	private function upload_imagem($tipo)
	{
		$config['upload_path'] = './conteudo/'.$tipo.'/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '0';
		$config['max_width'] = '0';
		$config['max_height'] = '0';
		$config['encrypt_name'] = true;
		$this->load->library('upload', $config);
		if ($this->upload->do_upload()) 
		{
			$data = $this->upload->data();
			$image = $data['full_path'];
			$this->gerar_miniatura($image, '740', '');
		} 
		else 
		{
			$data = array('file_name' => '', 'file_ext' => '', 'error' => $this->upload->display_errors());
		}
		return $data;
	}
	
	private function gerar_miniatura( $image, $width = NULL, $height = NULL, $image_tmp = NULL, $tipo = NULL )
	{
		$this->m2brimagem->clear();
		$this->m2brimagem->initialize($image);
		// valida via m2brimagem
		if( $this->m2brimagem->valida() == 'OK' )
		{
			// redimensiona (opcional, só pra evitar imagens muito grandes)
			$this->m2brimagem->redimensiona( $width, $height, $tipo );
			// grava nova imagem
			if ( ! empty($image_tmp) )
				$retorno = $this->m2brimagem->grava( $image_tmp );
			else
				$retorno = $this->m2brimagem->grava( $image );
				
			if ($retorno != false)
				return TRUE;
		}
	}
	
	public function crop()
	{
		$tipo = $this->input->post('tipo');
		$nome = $this->input->post('nome');
		$ext  = $this->input->post('extensao');
		$x 	  = $this->input->post('x');
		$y 	  = $this->input->post('y');
		$w 	  = $this->input->post('w');
		$h 	  = $this->input->post('h');
		
		$path 		= 'conteudo/'.$tipo.'/';
		$image 		= $path.$nome.$ext;
		$image_tmp 	= $path.$nome.'_tmp'.$ext;
		
		$this->m2brimagem->clear();
		$this->m2brimagem->initialize($image);
		
		if( $this->m2brimagem->valida() == 'OK' )
		{
			$this->m2brimagem->posicaoCrop( $x, $y );
			$this->m2brimagem->redimensiona( $w, $h, 'crop' );
			$this->m2brimagem->grava( $image_tmp );
			
			// Redimenciona a imagem para 205 x 155 pixels baseado na imagem temporária criada pelo Crop.
			$this->gerar_miniatura( $image_tmp, '255', '155', $path.$nome.'_205x155'.$ext );
			
			// Redimenciona a imagem para 50 x 50 pixels baseado na imagem temporária criada pelo Crop.
			$this->gerar_miniatura( $image_tmp, '50', '50', $path.$nome.'_50x50'.$ext );
			
			// Remove a imagem temporária
			@unlink($image_tmp);
			
			// Envia mensagem de sucesso!
			$this->session->set_flashdata('msg', '<p>Arquivo inserido com sucesso.</p>');
		}
		else
		{
			$this->session->set_flashdata('msg', '<p>Não foi possível inserir o arquivo.</p>');	
		}
		redirect(base_url('admin/arquivos'));
	}
}
<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Detalhes extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();
		
		if (!$this->session->userdata('session_id') || !$this->session->userdata('logado'))
		{
			redirect('admin/home');
		}
		
		$this->load->model('Categorias_model', 'categorias');
		$this->load->model('Conteudos_model', 'conteudos');
		$this->load->model('Detalhes_model', 'detalhes');
		$this->load->helper('form');
		$this->load->helper('text');
		$this->load->library('table');
	}
	
	public function index($slug = null, $pagina = null)
	{
		$id_conteudo 		  	  = $this->conteudos->id_by_slug($slug);
		$titulo_conteudo	  	  = $this->conteudos->campos_por_id($id_conteudo, 'titulo');
		$detalhes	 		  	  = $this->detalhes->listar_por_conteudo($id_conteudo);
		$dados['slug']			  = $slug;
		$dados['id_conteudo'] 	  = $id_conteudo;
		$dados['titulo_conteudo'] = $titulo_conteudo[0]->titulo;
		$dados['detalhes'] 	  	  = $detalhes;
		$dados['autor'] 	  	  = ucwords($this->session->userdata('usuario'));
		
		$this->load->view('admin/html_header');
		$this->load->view('admin/menu');
		$this->load->view('admin/form_detalhes', $dados);
		//$this->load->view('admin/detalhes', $dados);
		$this->load->view('admin/html_footer');
	}
	
	public function adicionar()
	{
		$detalhes['id_conteudo'] 	= $this->input->post('id_conteudo');
		$detalhes['quartos'] 	 	= $this->input->post('quartos');
		$detalhes['banheiros'] 	 	= $this->input->post('banheiros');
		$detalhes['suites'] 	 	= $this->input->post('suites');
		$detalhes['garagem'] 	 	= $this->input->post('garagem');
		$detalhes['area_construida'] = $this->input->post('area_construida');
		$detalhes['area_total'] 	= $this->input->post('area_total');
		$detalhes['iptu'] 			= $this->input->post('iptu');
		$detalhes['preco'] 			= $this->input->post('preco');
		$detalhes['status'] 		= $this->input->post('status');
		$detalhes['condominio'] 	= $this->input->post('condominio');
		 
		if ($this->detalhes->inserir($detalhes)) 
		{
			redirect( 'admin/arquivos/index/' . $detalhes['id_conteudo'] );
		}
		else
		{
			die( 'Não foi possível adicionar o item.' );
		}
	}
	
	public function editar( $id_detalhes, $slug )
	{
		$titulo_conteudo	  	  = $this->conteudos->campos_por_id($id_detalhes, 'titulo');
		$detalhes	 		  	  = $this->detalhes->dados($id_detalhes);
		$dados['slug']			  = $slug;
		$dados['titulo_conteudo'] = $titulo_conteudo[0]->titulo;
		$dados['detalhes'] 	  	  = $detalhes;
		$dados['autor'] 	  	  = ucwords($this->session->userdata('usuario'));
		
		$this->load->view('admin/html_header');
		$this->load->view('admin/menu');
		$this->load->view('admin/editar_detalhes', $dados);
		$this->load->view('admin/html_footer');
	}
	
	public function alterar() 
	{
		$detalhes['id_conteudo'] 	= $this->input->post('id_conteudo');
		$detalhes['slug']			= $this->input->post('slug');
		$detalhes['quartos'] 	 	= $this->input->post('quartos');
		$detalhes['banheiros'] 	 	= $this->input->post('banheiros');
		$detalhes['suites'] 	 	= $this->input->post('suites');
		$detalhes['garagem'] 	 	= $this->input->post('garagem');
		$detalhes['area_construida'] = $this->input->post('area_construida');
		$detalhes['area_total'] 	= $this->input->post('area_total');
		$detalhes['iptu'] 			= $this->input->post('iptu');
		$detalhes['preco'] 			= $this->input->post('preco');
		$detalhes['status'] 		= $this->input->post('status');
		$detalhes['condominio'] 	= $this->input->post('condominio');
			
		if ($this->detalhes->gravar_alteracao($detalhes))
		{
			redirect( 'admin/detalhes/index/' . $detalhes['slug'] );
		}
		else
		{
			die( 'Não foi possível adicionar o item.' );
		}
	}
	
	public function excluir( $id, $slug )
	{
		if ($this->detalhes->excluir( $id ))
		{
			redirect(base_url('admin/detalhes/index/'.$slug));
		} else {
			die('Não foi possível excluir o item');
		}
	}
}
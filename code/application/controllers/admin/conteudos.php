<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Conteudos extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		if (!$this->session->userdata('session_id') || !$this->session->userdata('logado')) {
			redirect('admin/home');
		}
		
		$this->load->model('Categorias_model', 'categorias');
		$this->load->model('Conteudos_model', 'conteudos');
		$this->load->model('Arquivos_model', 'arquivos');
		$this->load->helper('form');
		$this->load->helper('text');
		$this->load->library('table');
		$this->load->library('pagination');
	}
	
	public function index($pagina = null) {
		$mostrar_por_pagina   = 10;
		$conteudos 			  = $this->conteudos->listar_pagina($pagina, $mostrar_por_pagina);
		$numero_paginas 	  = $this->conteudos->contar_paginas();
		$config['base_url']   = base_url('admin/conteudos/index');
		$config['total_rows'] = $numero_paginas[0]->total;
		$config['per_page']	  = $mostrar_por_pagina;
		$config['uri_segment']= 4;
		$config['first_link'] = 'Início';
		$config['last_link']  = 'Final';
		$this->pagination->initialize($config);
		$dados['paginacao'] = $this->pagination->create_links();
		
		$dados['conteudos'] = $conteudos;
		$dados['categorias'] = $this->categorias->listar();
		$dados['autor'] = ucwords($this->session->userdata('usuario'));
		
		$this->load->view('admin/html_header');
		$this->load->view('admin/menu');
		$this->load->view('admin/conteudos', $dados);
		$this->load->view('admin/html_footer');
	}
	
	public function novo() {
		$dados['categorias'] = $this->categorias->listar();
		$dados['autor'] = ucwords($this->session->userdata('usuario'));
		
		$this->load->view('admin/html_header');
		$this->load->view('admin/menu');
		$this->load->view('admin/form_conteudos', $dados);
		$this->load->view('admin/html_footer');
	}
	
	public function adicionar() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('titulo', 'Título', 'required');
		$this->form_validation->set_rules('slug', 'Slug', 'required');
		$this->form_validation->set_rules('id_categoria', 'Pertence à', 'required|greater_than[0]');
		$this->form_validation->set_message('greater_than', 'O campo "%s" é obrigatório');
		$this->form_validation->set_rules('status', 'Status', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$autor = $this->input->post('autor');
			$titulo = $this->input->post('titulo');
			$slug = $this->input->post('slug');
			$id_categoria = $this->input->post('id_categoria');
			$status = $this->input->post('status');
			$ordem = $this->input->post('ordem');
			$descricao = $this->input->post('descricao');
			if ($this->conteudos->inserir($autor, $titulo, $slug, $id_categoria, $status, $ordem, $descricao)) {
				redirect('admin/detalhes/index/'.$slug);
			} else {
				die('Não foi possível adicionar o conteúdo.');
			}
		}
	}
	
	public function descricao($slug) {
		$dados['categorias'] = $this->categorias->listar();
		$dados['id_conteudo'] = $this->conteudos->id_by_slug($slug);
		$dados['slug'] = $slug;
		$lista['conteudos'] = $this->conteudos->listar();
		$this->load->view('admin/html_header');
		$this->load->view('admin/menu');
		$this->load->view('admin/form_conteudos_descricao', $dados);
		$this->load->view('admin/conteudos', $lista);
		$this->load->view('admin/html_footer');
	}
	
	public function adicionar_descricao($slug) {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('descricao', 'Descrição', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->descricao($slug);
		} else {
			$config['upload_path'] = './conteudo/img/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '1024';
			$config['max_width'] = '740';
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload()){
				echo $this->upload->display_errors();
				echo '<a href="javascript:history.go(-1)">Voltar e corrigir.</a>';
			} else {
				$dados['nome'] = $this->input->post('nome');
				$dados['slug_receita'] = $this->input->post('slug_receita');
				$dados['texto'] = $this->input->post('texto');
				$dados['categoria'] = $this->input->post('categoria');
				$arquivo_upado = $this->upload->data();
				$dados['foto'] = $arquivo_upado['file_name'];
				$this->db->insert('receitas',$dados);
				redirect('administracao/receitas');
			}
			
			
			
			$id_conteudo = $this->input->post('id_conteudo');
			$descricao = $this->input->post('descricao');
			if ($this->conteudos->inserir_descricao($id_conteudo, $descricao)) {
				redirect('/admin/conteudos');
			} else {
				die('Não foi possível adicionar a descrição.');
			}
		}
	}
	
	public function editar($conteudo) {
		$dados['categorias'] = $this->categorias->listar();
		$dados['conteudo'] = $this->conteudos->detalhes($conteudo);		
		$dados['autor'] = ucwords($this->session->userdata('usuario'));
		
		$this->load->view('admin/html_header');
		$this->load->view('admin/menu');
		$this->load->view('admin/editar_conteudos', $dados);
		$this->load->view('admin/html_footer');
	}
	
	public function gravar_alteracao() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_categoria', 'Categoria', 'required');
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('descricao', 'Descrição', 'required');
		$this->form_validation->set_rules('preco', 'Preço', 'required');
		$this->form_validation->set_rules('slug', 'Slug', 'required');
		if ($this->form_validation->run() == false) {
			$this->index();
		} else {
			$id_produto = $this->input->post('id_produto');
			$id_categoria = $this->input->post('id_categoria');
			$nome = $this->input->post('nome');
			$descricao = $this->input->post('descricao');
			if ($_FILES['userfile']['error'] == 0) {
				$foto = $this->upload_foto();
			} else {
				$foto = $this->input->post('foto');
			}
			$preco = $this->input->post('preco');
			$slug = $this->input->post('slug');
			if ($this->conteudos->gravar_alteracao($id_produto, $id_categoria, $nome, $descricao, $foto, $preco, $slug)) {
				redirect(base_url('admin/conteudos'));
			} else {
				die('Não foi possível alterar o produto.');
			}
		}
	}
	
	public function excluir($conteudo) {
		
		$excluirArquivos = $this->arquivos->listarPorIdConteudo($conteudo);
		
		if (!empty($excluirArquivos)) {
			foreach ($excluirArquivos as $arquivo) {
				$this->arquivos->excluir($arquivo->id_arquivo, 'conteudo/' . $arquivo->tipo .'/'. $arquivo->nome .'/'. $arquivo->extensao);
			}
		}
		
		if ($this->conteudos->excluir($conteudo)) {
			$this->session->set_flashdata('msg', '<p>Conteúdo excluido com sucesso.</p>');
		} else {
			$this->session->set_flashdata('msg', '<p>Não foi possível excluir o conteúdo.</p>');
		}
		redirect(base_url('admin/conteudos/#cadastro'));
	}
	
	private function upload_foto() {
		$config['upload_path'] = './conteudos';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '0';
		$config['max_width'] = '0';
		$config['max_height'] = '0';
		$config['encrypt_name'] = true;
		$this->load->library('upload', $config);
		if ($this->upload->do_upload()) {
			$data = array('upload_data' => $this->upload->data());
			return $data['upload_data']['file_name'];
		} else {
			return '';
		}
	}
}
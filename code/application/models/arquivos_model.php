<?php 

class Arquivos_model extends CI_Model {
	
	var $id_arquivo;
	var $id_conteudo;
	var $nome;
	var $tipo;
	var $extensao;
	var $data_alteracao;
	var $slug_destaque;
	var $titulo_destaque;
	var $texto_destaque;
	
	public function __construct() {
		parent::__construct();
	}
	
	public function listar($order_by = NULL) {
		if (!empty($order_by))
			$this->db->order_by($order_by);

		return $this->db->get('arquivos')->result();
	}
	
	public function inserir($id_arquivo, $id_conteudo, $nome, $tipo, $extensao, $slug_destaque = NULL, $titulo_destaque = NULL, $texto_destaque = NULL) {
		$this->id_arquivo = $id_arquivo;
		$this->id_conteudo = $id_conteudo;
		$this->nome = $nome;
		$this->tipo = $tipo;
		$this->extensao = $extensao;
		$this->data_alteracao = date('Y-m-d h:i:s');
		$this->slug_destaque = $slug_destaque;
		$this->titulo_destaque = $titulo_destaque;
		$this->texto_destaque = $texto_destaque;
		return $this->db->insert('arquivos', $this);
	}
	
	public function listar_por_nome($nome)
	{
		$this->db->where('nome', $nome);
		return $this->db->get('arquivos')->result();
	}
	
	public function listar_por_id_conteudo($id_conteudo) {
		$this->db->where('id_conteudo', $id_conteudo);
		$arquivos = $this->db->get('arquivos')->result();
		return $arquivos;
	}
	
	public function alterar($id_arquivo, $id_conteudo, $nome, $tipo, $extensao, $data_alteracao) {
		$this->id_conteudo = $id_conteudo;
		$this->nome = $nome;
		$this->tipo = $tipo;
		$this->extensao = $extensao;
		$this->data_alteracao = date('Y-m-d h:i:s');
		$this->db->where('id_arquivo', $id_arquivo);
		return $this->db->update('arquivo', $this);
	} 
	
	public function excluir($id_arquivo, $path = null) {
		if (!empty($path)) {
			@unlink($path);
		} else {
			$arquivo = $this->listarPorIdConteudo($id_arquivo);
			@unlink('conteudo/' . $arquivo->tipo .'/'. $arquivo->nome .'/'. $arquivo->extensao);
		}
		$this->db->where('id_arquivo', $id_arquivo);
		return $this->db->delete('arquivos');
	}
}
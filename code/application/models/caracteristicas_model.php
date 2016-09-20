<?php 

class Caracteristicas_model extends CI_Model {
	
	var $id_caracteristica;
	var $id_conteudo;
	var $nome;
	var $data_alteracao;
	
	public function __construct() {
		parent::__construct();
	}
	
	public function listar($order_by = NULL) {
		if (!empty($order_by))
			$this->db->order_by($order_by);

		return $this->db->get('caracteristicas')->result();
	}
	
	public function listar_por_id_conteudo($id_conteudo) {
		$this->db->select('nome');
		$this->db->where('id_conteudo', $id_conteudo);
		$caracteristicas = $this->db->get('caracteristicas')->result();
		return $caracteristicas;
	}
	
	public function inserir($id_conteudo, $nome) {
		$this->id_conteudo = $id_conteudo;
		$this->nome 	   = $nome;
		return $this->db->insert('caracteristicas', $this);
	}
	

	/* Alterar tudo daqui para baixo */	
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
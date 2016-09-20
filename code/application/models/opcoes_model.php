<?php 

class Opcoes_model extends CI_Model 
{
	var $id_opcao;
	var $id_usuario;
	var $nome;
	var $valor;
	var $ordem;
	var $autor;
	var $data_alteracao;
	
	public function __construct() 
	{
		parent::__construct();
	}
	
	public function adicionar($dados = array()) 
	{
		$this->id_opcao		  = NULL;
		$this->id_usuario	  = $dados['id_usuario'];
		$this->nome 		  = $dados['nome'];
		$this->valor 		  = $dados['valor'];
		$this->ordem 		  = $dados['ordem'];
		$this->data_alteracao = date('Y-m-d h:i:s');
		unset($this->autor);
		
		return $this->db->insert('opcoes', $this);
	}
	
	public function listar($order_by = null) {
		if ( ! empty($order_by) )
			$this->db->order_by($order_by);
		else 
			$this->db->order_by('nome', 'asc');
		
		$this->db->select('o.id_opcao, o.nome, o.valor, o.ordem, o.data_alteracao, u.nome as autor');
		$this->db->from('opcoes o');
		$this->db->join('usuarios u', 'u.id_usuario = o.id_usuario');
		
		return $this->db->get()->result();
	}
	
	public function ver($opcao = NULL) {
		$this->db->select('o.id_opcao, o.id_usuario, o.nome, o.valor, o.ordem, o.data_alteracao, u.nome as autor');
		$this->db->from('opcoes o');
		$this->db->join('usuarios u', 'u.id_usuario = o.id_usuario');
		$this->db->where('id_opcao', $opcao);
		
		$opcoes = $this->db->get()->result();
		
		if (count($opcoes)==1) {
			foreach ($opcoes as $opcao) {
				$this->id_opcao = $opcao->id_opcao;
				$this->id_usuario = $opcao->id_usuario;
				$this->nome = $opcao->nome;
				$this->valor = $opcao->valor;
				$this->ordem = $opcao->ordem;
				$this->autor = $opcao->autor;
				$this->data_alteracao = $opcao->data_alteracao;
			}
			return $this;
		}
	}
	
	public function listar_campos($campos = NULL, $order_by = NULL) {
		if (!empty($campos))
			$this->db->select($campos);
		
		if (!empty($order_by))
			$this->db->order_by($order_by);
	
		return $this->db->get('opcoes')->result();
	}
	
	public function listar_por_nome($opcao = NULL) {
		if (!empty($opcao)) {
			$this->db->select('valor');
			$this->db->where('nome', $opcao);
			$this->db->order_by('ordem');
		} else {
			return FALSE;
		}
		return $this->db->get('opcoes')->result();
	}
	
	public function alterar($dados = array()) {
		$this->id_opcao = $dados['id_opcao'];
		$this->id_usuario = $dados['id_usuario'];
		$this->nome = $dados['nome'];
		$this->valor = $dados['valor'];
		$this->ordem = $dados['ordem'];
		$this->data_alteracao = date('Y-m-d h:i:s');
		unset($this->autor);
		
		$this->db->where('id_opcao', $this->id_opcao);
		
		return $this->db->update('opcoes', $this);
	}
	
	public function listar_pagina($offset = null, $numero_itens = null)
	{
		$this->db->order_by('id_opcao', 'desc');
		$conteudos = $this->db->get( 'opcoes', $numero_itens, $offset )->result();
		return $conteudos;
	}
	
	public function contar_paginas()
	{
		$this->db->select('count(*) as total');
		$this->db->from('opcoes');
		return $this->db->get()->result();
	}
	
	public function excluir($id_opcao) {
		$this->db->where('id_opcao', $id_opcao);
		return $this->db->delete('opcoes');
	}
	
}
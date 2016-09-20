<?php 

class Mensagens_model extends CI_Model {
	
	var $id_mensagem;
	var $nome;
	var $email;
	var $telefone;
	var $texto;
	var $tipo;
	var $data_alteracao;
	
	public function __construct() {
		parent::__construct();
	}
	
	public function adicionar($dados = array()) {
		$this->nome = $dados['nome'];
		$this->email = $dados['email'];
		$this->telefone = $dados['telefone'];
		$this->texto = $dados['texto'];
		$this->tipo = $dados['tipo'];
		$this->data_alteracao = date('Y-m-d h:i:s');
		return $this->db->insert('mensagens', $this);
	}
	
	public function listar($order_by = null) {
		$this->db->order_by('nome', 'asc');
		return $this->db->get('mensagens')->result();
	}
	
	public function ver($mensagem = NULL) {
		$this->db->where('id_mensagem', $mensagem);
		$mensagens = $this->db->get('mensagens')->result();
		
		if (count($mensagens==1)) {
			foreach ($mensagens as $mensagem) {
				$this->id_mensagem = $mensagem->id_mensagem;
				$this->nome = $mensagem->nome;
				$this->email = $mensagem->email;
				$this->telefone = $mensagem->telefone;
				$this->texto = $mensagem->texto;
				$this->tipo = $mensagem->tipo;
				$this->data_alteracao = $opcao->data_alteracao;
			}
			return $this;
		}
	}
		
	public function alterar($dados = array()) {
		$this->id_mensagem = $dados['id_mensagem'];
		$this->nome = $dados['nome'];
		$this->email = $dados['email'];
		$this->telefone = $dados['telefone'];
		$this->texto = $dados['texto'];
		$this->tipo = $dados['tipo'];
		$this->data_alteracao = date('Y-m-d h:i:s');
		$this->db->where('id_opcao', $this->id_opcao);
		
		return $this->db->update('mensagens', $this);
	}
	
	public function excluir($mensagem) {
		$this->db->where('id_mensagem', $mensagem);
		return $this->db->delete('mensagens');
	}
	
}
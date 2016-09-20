<?php 

class Depoimentos_model extends CI_Model 
{
	var $id_depoimento;
	var $id_usuario;
	var $autor;
	var $email;
	var $ordem;
	var $texto;
	var $status;
	var $data_alteracao;
	
	public function __construct() 
	{
		parent::__construct();
	}
	
	public function adicionar($dados = array()) 
	{
		$this->id_depoimento  = NULL;
		$this->id_usuario	  = $dados['id_usuario'];
		$this->autor 		  = $dados['autor'];
		$this->email		  = $dados['email'];
		$this->ordem 		  = $dados['ordem'];
		$this->texto		  = $dados['texto'];
		$this->status		  = $dados['status'];
		$this->data_alteracao = date('Y-m-d h:i:s');
		
		return $this->db->insert('depoimentos', $this);
	}
	
	public function listar($order_by = null, $limit = null) {
		if ( ! empty($order_by) )
			$this->db->order_by($order_by);
		
		if ( ! empty($limit) )
			$this->db->limit($limit);
		
		return $this->db->get('depoimentos')->result();
	}
	
	public function ver($id_depoimento = NULL) {
		$this->db->where('id_depoimento', $id_depoimento);
		$depoimentos = $this->db->get('depoimentos')->result();
		
		if (count($depoimentos)==1) {
			foreach ($depoimentos as $depoimento) {
				$this->id_depoimento  = $depoimento->id_depoimento;
				$this->id_usuario 	  = $depoimento->id_usuario;
				$this->email		  = $depoimento->email;
				$this->autor 		  = $depoimento->autor;
				$this->ordem 		  = $depoimento->ordem;
				$this->texto 		  = $depoimento->texto;
				$this->status 		  = $depoimento->status;
				$this->data_alteracao = $depoimento->data_alteracao;
				
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
	
	public function alterar($dados = array()) 
	{
		$this->id_depoimento = $dados['id_depoimento'];
		$this->id_usuario = $dados['id_usuario'];
		$this->autor = $dados['autor'];
		$this->email = $dados['email'];
		$this->ordem = $dados['ordem'];
		$this->texto = $dados['texto'];
		$this->status = $dados['status'];
		$this->data_alteracao = date('Y-m-d h:i:s');
		
		$this->db->where('id_depoimento', $this->id_depoimento);
		
		return $this->db->update('depoimentos', $this);
	}
	
	public function excluir($id_depoimento) 
	{
		$this->db->where('id_depoimento', $id_depoimento);
		return $this->db->delete('depoimentos');
	}
	
}
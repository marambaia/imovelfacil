<?php 

class Usuarios_model extends CI_Model {
	
	var $id_usuario;
	var $usuario;
	var $senha;
	var $email;
	var $status;
	var $nome;
	var $sobrenome;
	var $titulo;
	var $sexo;
	var $cpf_cnpj;
	var $id_ie;
	var $data_nascimento;
	var $registrado_em;
	var $chave_ativacao;
	
	public function __construct() {
		parent::__construct();
	}
	
	public function listar($order_by = NULL) {
		if (!empty($order_by))
			$this->db->order_by($order_by);

		return $this->db->get('usuarios')->result();
	}
	
	public function ver($id_usuario = null)
	{
		$this->db->where('id_usuario', $id_usuario);
		$usuarios = $this->db->get('usuarios')->result();
		if ( count($usuarios)  == 1 )
		{
			foreach ($usuarios as $usuario)
			{
				$this->id_usuario 		= $usuario->id_usuario;
				$this->usuario 			= $usuario->usuario;
				$this->email			= $usuario->email;
				$this->status			= $usuario->status;
				$this->nome				= $usuario->nome;
				$this->sobrenome		= $usuario->sobrenome;
				$this->titulo			= $usuario->titulo;
				$this->sexo				= $usuario->sexo;
				$this->cpf_cnpj			= $usuario->cpf_cnpj;
				$this->id_ie			= $usuario->id_ie;
				$this->data_nascimento 	= $usuario->data_nascimento;
				$this->registrado_em	= $usuario->registrado_em;
			}
			return $this;
		}
	}
	
	public function inserir() {
		
	}
	
	public function alterar($id_arquivo) {
		
	} 
	
	public function excluir($id_arquivo) {
		
	}
}
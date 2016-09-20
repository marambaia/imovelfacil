<?php 

class Paginas_model extends CI_Model {
	
	var $id_pagina;
	var $id_usuario;
	var $nome;
	var $slug;
	var $descricao;
	var $nivel_exibicao;
	var $status;
	var $filho_de;
	var $ordem;
	var $data_alteracao;
	var $criador_nome;
	var $criador_sobrenome;
	var $criador_usuario;
	var $criador_titulo;
	
	
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('Usuarios_model', 'usuarios');
	}
	
	public function listar($order_by = NULL) 
	{
		if ( ! empty($order_by) )
			$this->db->order_by($order_by);
		else 
			$this->db->order_by('id_pagina');
		
		return $this->db->get('paginas')->result();
	}
	
	public function listar_campos($campos = NULL, $order_by = NULL) 
	{
		if (!empty($campos))
			$this->db->select($campos);
		
		if (!empty($order_by))
			$this->db->order_by($order_by);
	
		return $this->db->get('paginas')->result();
	}
	
	public function listar_paginas_por_tipo($tipo = NULL, $limit = 10) {
		$this->db->select('id_pagina AS id, nome, slug, descricao');
		$this->db->where('nivel_exibicao', $tipo);
		$this->db->where('status', 1);
		$this->db->where('filho_de', 0);
		$this->db->order_by('ordem');
		$this->db->limit($limit);
		
		$paginas = $this->db->get('paginas')->result();
		
		$menu_paginas = array();
		for ($i = 0; $i < count($paginas); $i++) {
			$filhas = $this->listar_paginas_filhas($paginas[$i]->id);
			if ($filhas) {
				$menu_paginas[$i]['nome'] = $paginas[$i]->nome;
				$menu_paginas[$i]['slug'] = $paginas[$i]->slug;
				$menu_paginas[$i]['descricao'] = $paginas[$i]->descricao;
				
				if ($i == 0)
					$menu_paginas[$i]['dados'] = 'class="home item-menu menu"';
				else
					$menu_paginas[$i]['dados'] = 'class="item-menu menu"';
				
				for ($j = 0; $j < count($filhas); $j++) {
					$menu_paginas[$i]['filhas'][$j]['nome'] = $filhas[$j]->nome;
					$menu_paginas[$i]['filhas'][$j]['slug'] = $filhas[$j]->slug;
					$menu_paginas[$i]['filhas'][$j]['descricao'] = $filhas[$j]->descricao;
					$menu_paginas[$i]['filhas'][$j]['dados'] = 'class=""';
				}
			} else {
				$menu_paginas[$i]['nome'] = $paginas[$i]->nome;
				$menu_paginas[$i]['slug'] = $paginas[$i]->slug;
				$menu_paginas[$i]['descricao'] = $paginas[$i]->descricao;
				if ($i == 0)
					$menu_paginas[$i]['dados'] = 'class="home"';
				else
					$menu_paginas[$i]['dados'] = 'class=""';
				
				$menu_paginas[$i]['filhas'] = FALSE;
			}
		}
		return $menu_paginas;
	}
	
	public function listar_paginas_filhas($filho_de = NULL) {
		$this->db->select('id_pagina AS id, nome, slug, descricao');
		$this->db->where('nivel_exibicao', 4);
		$this->db->where('status', 1);
		$this->db->where('filho_de', $filho_de);
		$this->db->order_by('ordem');
		
		$filhas = $this->db->get('paginas')->result();
		if (count($filhas) > 0)
			return $filhas;
		else
			return FALSE;
	}
	
	public function detalhes_by_slug ($slug) {
		$query = "select 
					p.id_pagina, p.nome, p.slug, p.descricao, p.nivel_exibicao, p.status, p.filho_de, p.ordem, p.data_alteracao, 
					u.nome as criador_nome, u.sobrenome as criador_sobrenome, u.usuario as criador_usuario, u.titulo as criador_titulo 
				  from paginas p 
				  inner join usuarios u 
				  on p.id_usuario = u.id_usuario 
				  where p.slug = '".$slug."'";
		
		$paginas = $this->db->query($query)->result();
		
		if (count($paginas) == 1) {
			$detalhes = array();
			foreach ($paginas as $pagina) {
				$this->id_pagina 		 = $pagina->id_pagina;
				$this->nome 			 = $pagina->nome;
				$this->slug 			 = $pagina->slug;
				$this->descricao 		 = $pagina->descricao;
				$this->nivel_exibicao 	 = $pagina->nivel_exibicao;
				$this->data_alteracao 	 = $pagina->data_alteracao;
				$this->status 			 = $pagina->status;
				$this->filho_de 		 = $pagina->filho_de;
				$this->ordem 			 = $pagina->ordem;
				$this->criador_nome 	 = $pagina->criador_nome;
				$this->criador_sobrenome = $pagina->criador_sobrenome;
				$this->criador_usuario 	 = $pagina->criador_usuario;
				$this->criador_titulo 	 = $pagina->criador_titulo;
			}
		}
		return $this;
	}
	
	public function adicionar($id_usuario, $nome, $slug, $descricao = NULL, $nivel_exibicao = 3, $status = 1, $filho_de = 0, $ordem = 0) 
	{
		$this->id_pagina = NULL;
		$this->id_usuario = $id_usuario;
		$this->nome = $nome;
		$this->slug = $slug;
		$this->descricao = $descricao;
		$this->nivel_exibicao = $nivel_exibicao;
		$this->status = $status;
		$this->filho_de = $filho_de;
		$this->ordem = $ordem;
		$this->data_alteracao = date('Y-m-d h:i:s');
		unset($this->criador_nome);
		unset($this->criador_sobrenome);
		unset($this->criador_usuario);
		unset($this->criador_titulo);
		
		return $this->db->insert('paginas', $this);
	}
	
	public function ver($pagina = NULL) {
		$this->db->where('id_pagina', $pagina);
		$paginas = $this->db->get('paginas')->result();
		
		if (count($paginas)==1) {
			foreach ($paginas as $pagina) {
				$this->id_pagina  = $pagina->id_pagina;
				$this->nome = $pagina->nome;
				$this->slug = $pagina->slug;
				$this->descricao = $pagina->descricao;
				$this->nivel_exibicao = $pagina->nivel_exibicao;
				$this->status = $pagina->status;
				$this->filho_de = $pagina->filho_de;
				$this->ordem = $pagina->ordem;
				$this->data_alteracao = $pagina->data_alteracao;
			}
			return $this;
		}
	}
	
	public function ver_campos($pagina = NULL, $campos = NULL) {
		if (!empty($campos))
			$this->db->select($campos);
	
		$this->db->where('id_pagina', $pagina);
		
		return $this->db->get('paginas')->result();
	}
	
	
	public function alterar($id_pagina, $id_usuario, $nome, $slug, $descricao, $nivel_exibicao, $status, $filho_de, $ordem) {
		$this->id_pagina = $id_pagina;
		$this->id_usuario = $id_usuario;
		$this->nome = $nome;
		$this->slug = $slug;
		$this->descricao = $descricao;
		$this->nivel_exibicao = $nivel_exibicao;
		$this->status = $status;
		$this->filho_de = $filho_de;
		$this->ordem = $ordem;
		$this->data_alteracao = date('Y-m-d h:i:s');
		$this->db->where('id_pagina', $this->id_pagina);
		unset($this->criador_nome);
		unset($this->criador_sobrenome);
		unset($this->criador_usuario);
		unset($this->criador_titulo);

		return $this->db->update('paginas', $this);
	}
	
	public function listar_pagina($offset = null, $numero_itens = null)
	{
		$this->db->order_by('id_pagina', 'desc');
		$paginas = $this->db->get( 'paginas', $numero_itens, $offset )->result();
		return $paginas;
	}
	
	public function contar_paginas()
	{
		$this->db->select('count(*) as total');
		$this->db->from('paginas');
		return $this->db->get()->result();
	}
	
	public function excluir($id_pagina) {
		$this->db->where('id_pagina', $id_pagina);
		return $this->db->delete('paginas');
	}
	
}
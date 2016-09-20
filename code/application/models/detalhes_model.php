<?php 

class Detalhes_model extends CI_Model {
	
	var $id_detalhe;
	var $id_conteudo;
	var $quartos;
	var $banheiros;
	var $suites;
	var $garagem;
	var $area_construida;
	var $area_total;
	var $iptu;
	var $preco;
	var $status;
	var $condominio;
	
	public function __construct() {
		parent::__construct();
	}
	
	public function listar() {
		$this->db->order_by('id_conteudo', 'asc');
		return $this->db->get('detalhes')->result();
	}
	
	public function listar_por_conteudo($id_conteudo) {
		$this->db->where('id_conteudo', $id_conteudo);
		$this->db->order_by('id_conteudo', 'asc');
		return $this->db->get('detalhes')->result();
	}
	
	public function inserir($detalhes = array())
	{
		$this->id_detalhe	   = null;
		$this->id_conteudo 	   = isset($detalhes['id_conteudo'])?$detalhes['id_conteudo']:0;
		$this->quartos 		   = $detalhes['quartos'];
		$this->banheiros 	   = $detalhes['banheiros'];
		$this->suites 		   = $detalhes['suites'];
		$this->garagem 		   = $detalhes['garagem'];
		$this->area_construida = $detalhes['area_construida'];
		$this->area_total 	   = $detalhes['area_total'];
		$this->iptu 		   = $detalhes['iptu'];
		$this->preco 		   = $detalhes['preco'];
		$this->status 		   = $detalhes['status'];
		$this->condominio 	   = $detalhes['condominio'];

		return $this->db->insert('detalhes', $this);
	}
	
	public function dados($id)
	{
		$this->db->where('id_detalhe', $id);
		$detalhes = $this->db->get('detalhes')->result();
		
		foreach ($detalhes as $detalhe) {
			$this->id_detalhe	   = $id;
			$this->id_conteudo 	   = $detalhe->id_conteudo;
			$this->quartos 		   = $detalhe->quartos;
			$this->banheiros 	   = $detalhe->banheiros;
			$this->suites 		   = $detalhe->suites;
			$this->garagem 		   = $detalhe->garagem;
			$this->area_construida = $detalhe->area_construida;
			$this->area_total 	   = $detalhe->area_total;
			$this->iptu 		   = $detalhe->iptu;
			$this->preco 		   = $detalhe->preco;
			$this->status 		   = $detalhe->status;
			$this->condominio 	   = $detalhe->condominio;
		}
		return $this;
	}
	
	public function gravar_alteracao($detalhes = array())
	{
		$this->quartos 		   = $detalhes['quartos'];
		$this->banheiros 	   = $detalhes['banheiros'];
		$this->suites 		   = $detalhes['suites'];
		$this->garagem 		   = $detalhes['garagem'];
		$this->area_construida = $detalhes['area_construida'];
		$this->area_total 	   = $detalhes['area_total'];
		$this->iptu 		   = $detalhes['iptu'];
		$this->preco 		   = $detalhes['preco'];
		$this->status 		   = $detalhes['status'];
		$this->condominio 	   = $detalhes['condominio'];
		
		$this->db->where('id_detalhe', $detalhes['id_detalhe']);
		return $this->db->update('detalhes', $this);
	}
	
	public function excluir($id_detalhe)
	{
		$this->db->where('id_detalhe', $id_detalhe);
		return $this->db->delete('detalhes');
	}
	
}
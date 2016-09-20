<?php

class Tipos_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function tipo_imoveis() {
		$this->db->where('id_tipo !=', 20);
		return $this->db->get('tipos')->result();
	}
}
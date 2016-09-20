<?php

class Localidades_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function lista_localidades_estados() {
		$query = 'SELECT l.id_localidade, l.nome as localidade, e.uf 
					FROM localidades l 
					INNER JOIN estados e 
					ON l.id_estado = e.id_estado;';
		
		return $this->db->query($query)->result();
	}
}
<?php 

class Conteudos_model extends CI_Model {

	var $id_conteudo;
	var $id_categoria;
	var $id_tipo;
	var $titulo;
	var $descricao;
	var $autor;
	var $slug;
	var $data_alteracao;
	var $status;
	var $bairro;
	var $ordem;
	var $quartos;
	var $banheiros;
	var $suites;
	var $garagem;
	var $area_construida;
	var $area_total;
	var $iptu;
	var $preco;
	var $condominio;
	var $destaque;
	var $ano;
	var $tipo;
	var $img_path;
	var $img_name;
	var $img_ext;
	var $tag;
	
	public function __construct() {
		parent::__construct();
	}
	
	public function detalhes_by_slug($slug) {
		
		$query  = "select
					c.id_conteudo, c.id_categoria, c.id_tipo, c.titulo, c.descricao, c.autor, c.slug, c.data_alteracao, c.status, c.bairro, c.ordem, 
					c.quartos, c.banheiros, c.suites, c.garagem, c.destaque, c.ano, 
					Replace ( Replace ( Replace ( Format( c.area_construida, 2), '.', '|'), ',', '.'), '|', ',') as area_construida, 
					Replace ( Replace ( Replace ( Format( c.area_total, 2), '.', '|'), ',', '.'), '|', ',') as area_total, 
					Concat('R$ ', Replace ( Replace ( Replace ( Format( c.iptu, 2), '.', '|'), ',', '.'), '|', ',')) as iptu,
					Concat('R$ ', Replace ( Replace ( Replace ( Format( c.preco, 2), '.', '|'), ',', '.'), '|', ',')) as preco,
					Concat('R$ ', Replace ( Replace ( Replace ( Format( c.condominio, 2), '.', '|'), ',', '.'), '|', ',')) as condominio, 
					a.nome as imagem, a.tipo as tipo_imagem, a.extensao as extensao_imagem,
					t.nome as tipo, 
					tags.nome as tag 
					from conteudos c
					inner join arquivos a
					on c.id_conteudo = a.id_conteudo
					inner join tipos t
					on c.id_tipo = t.id_tipo
					inner join tags
					on c.id_tag = tags.id_tag 
					where c.status = 1 and a.principal = 1 and c.slug = '".$slug."'";
		
		$conteudos = $this->db->query($query)->result();
		
		foreach ($conteudos as $conteudo) {
			$this->id_conteudo		= $conteudo->id_conteudo;
			$this->id_categoria		= $conteudo->id_categoria;
			$this->id_tipo 			= $conteudo->id_tipo;
			$this->titulo 			= $conteudo->titulo;
			$this->descricao 		= $conteudo->descricao;
			$this->autor 			= $conteudo->autor;
			$this->slug 			= $conteudo->slug;
			$this->data_alteracao 	= $conteudo->data_alteracao;
			$this->status 			= $conteudo->status;
			$this->bairro 			= $conteudo->bairro;
			$this->ordem 			= $conteudo->ordem;
			$this->quartos 			= $conteudo->quartos;
			$this->banheiros 		= $conteudo->banheiros;
			$this->suites 			= $conteudo->suites;
			$this->garagem 			= $conteudo->garagem;
			$this->area_construida 	= $conteudo->area_construida;
			$this->area_total 		= $conteudo->area_total;
			$this->iptu 			= $conteudo->iptu;
			$this->preco 			= $conteudo->preco;
			$this->condominio 		= $conteudo->condominio;
			$this->destaque 		= $conteudo->destaque;
			$this->ano 				= $conteudo->ano;
			$this->tipo				= $conteudo->tipo;
			$this->img_path			= 'conteudo/'.$conteudo->tipo_imagem.'/';
			$this->img_name			= $conteudo->imagem;
			$this->img_ext			= $conteudo->extensao_imagem;
			$this->tag				= $conteudo->tag;
		}
		return $this;
	}
	
	public function id_by_slug($slug) {
		$this->db->select('id_conteudo AS id');
		$this->db->where('slug', $slug);
		$conteudo = $this->db->get('conteudos')->result();
		return $conteudo[0]->id;
	}
	
	public function campos_por_id($id_conteudo, $campos = '')
	{
		$this->db->select($campos);
		$this->db->where('id_conteudo', $id_conteudo);
		return $this->db->get('conteudos')->result();
	}
	
	public function listar() {
		$this->db->order_by('id_conteudo, titulo', 'asc');
		return $this->db->get('conteudos')->result();
	}
	
	public function listar_slides () {
		$query  = "select 
					c.titulo, Concat('R$ ', Replace ( Replace ( Replace ( Format( c.preco, 2), '.', '|'), ',', '.'), '|', ',')) as preco, 
					a.nome as imagem, 
					a.tipo as tipo_imagem,
					a.extensao as extensao_imagem 
					from conteudos c 
					inner join arquivos a 
					on c.id_conteudo = a.id_conteudo 
					where c.status = 1 and a.principal = 1 and c.destaque = 1 LIMIT 5";
		
		return $this->db->query($query)->result();
	}
	
	public function listar_historias() {
		$query = "SELECT 
					c.titulo, c.bairro as localidade, c.ano, c.descricao, 
					a.nome as nome_imagem, a.tipo as dir_imagem, a.extensao as ext_imagem 
					FROM conteudos c 
					INNER JOIN arquivos a 
					WHERE 
					c.id_conteudo = a.id_conteudo 
					AND c.id_categoria = 3 
					AND c.status = 1";
		return $this->db->query($query)->result();
	}
	
	public function listar_com_arquivo_principal ($params = array()) {
		$query  = "select
					c.id_conteudo, c.bairro, c.slug, c.titulo, c.quartos, c.banheiros, Concat('R$ ', Replace ( Replace ( Replace ( Format( c.preco, 2), '.', '|'), ',', '.'), '|', ',')) as preco, c.descricao, 
					a.nome as imagem, a.tipo as tipo_imagem, a.extensao as extensao_imagem, 
					t.nome as tipo, 
					tags.nome as tag, 
					l.nome as localidade  
					from conteudos c 
					inner join arquivos a  
					on c.id_conteudo = a.id_conteudo 
					inner join tipos t 
					on c.id_tipo = t.id_tipo 
					inner join tags 
					on c.id_tag = tags.id_tag 
					inner join localidades l 
					on c.id_localidade = l.id_localidade 
					where c.status = 1 and a.principal = 1";
		
					if ( ! empty($params['categoria']) )
						$query .= ' and c.id_categoria = ' . $params['categoria'];

					if ( ! empty($params['garagem']) )
						$query .= ' and c.garagem = ' . $params['garagem'];
					
					if ( ! empty($params['suites']) )
						$query .= ' and c.suites = ' . $params['suites'];
					
					if ( ! empty($params['banheiros']) )
						$query .= ' and c.banheiros = ' . $params['banheiros'];
					
					if ( ! empty($params['quartos']) )
						$query .= ' and c.quartos = ' . $params['quartos'];
					
					if ( ! empty($params['preco']) ) {
						switch ($params['preco']) {
							case '30k':
								$query .= ' and c.preco <= 30000';
							break;
							case '50k':
								$query .= ' and c.preco > 30000 and c.preco <= 50000';
							break;
							case '70k':
								$query .= ' and c.preco > 50000 and c.preco <= 70000';
							break;
							case '100k':
								$query .= ' and c.preco > 70000 and c.preco <= 100000';
							break;
							case '150k':
								$query .= ' and c.preco > 100000 and c.preco <= 150000';
							break;
							case '200k':
								$query .= ' and c.preco > 150000 and c.preco <= 200000';
							break;
							case '250k':
								$query .= ' and c.preco > 200000 and c.preco <= 250000';
							break;
							case '300k':
								$query .= ' and c.preco > 250000 and c.preco <= 300000';
							break;
							case '350k':
								$query .= ' and c.preco > 300000 and c.preco <= 350000';
							break;
							case '400k':
								$query .= ' and c.preco > 350000 and c.preco <= 400000';
							break;
							case '450k':
								$query .= ' and c.preco > 400000 and c.preco <= 450000';
							break;
							case '500k':
								$query .= ' and c.preco > 450000 and c.preco <= 500000';
							break;
							case '500k+':
								$query .= ' and c.preco > 500000';
							break;
						}
					}
					
					if ( ! empty($params['tipo']) )
						$query .= ' and c.id_tipo = ' . $params['tipo'];
					
					if ( ! empty($params['localizacao']) )
						$query .= ' and c.id_localidade = ' . $params['localizacao'];
	
		return $this->db->query($query)->result();
	}
	
	public function listar_pagina($offset = null, $numero_itens = null) 
	{
		$this->db->order_by('id_conteudo, titulo', 'asc');
		$conteudos = $this->db->get( 'conteudos', $numero_itens, $offset )->result();
		return $conteudos;
	}
	
	public function contar_paginas()
	{
		$this->db->select('count(*) as total');
		$this->db->from('conteudos');
		return $this->db->get()->result();
	}
	
	public function inserir($autor, $titulo, $slug, $id_categoria, $status, $ordem, $descricao) {
		$this->id_conteudo = null;
		$this->id_categoria = $id_categoria;
		$this->titulo = $titulo;
		$this->descricao = $descricao;
		$this->autor = $autor;
		$this->slug = $slug;
		$this->data_alteracao = date('Y-m-d h:i:s');
		$this->status = $status;
		$this->ordem = $ordem;
		return $this->db->insert('conteudos', $this);
	}
	
	public function inserir_descricao($id_conteudo, $descricao) {
		$data = array('descricao' => $descricao);
		$this->db->where('id_conteudo', $id_conteudo);
		return $this->db->update('conteudos', $data);
	}
	
	public function detalhes($conteudo) {
		$this->db->where('id_conteudo', $conteudo);
		$conteudos = $this->db->get('conteudos')->result();
		foreach ($conteudos as $conteudo) {
			$this->id_conteudo		= $conteudo->id_conteudo;
			$this->id_categoria		= $conteudo->id_categoria;
			$this->id_tipo 			= $conteudo->id_tipo;
			$this->titulo 			= $conteudo->titulo;
			$this->descricao 		= $conteudo->descricao;
			$this->autor 			= $conteudo->autor;
			$this->slug 			= $conteudo->slug;
			$this->data_alteracao 	= $conteudo->data_alteracao;
			$this->status 			= $conteudo->status;
			$this->bairro 			= $conteudo->bairro;
			$this->ordem 			= $conteudo->ordem;
			$this->quartos 			= $conteudo->quartos;
			$this->banheiros 		= $conteudo->banheiros;
			$this->suites 			= $conteudo->suites;
			$this->garagem 			= $conteudo->garagem;
			$this->area_construida 	= $conteudo->area_construida;
			$this->area_total 		= $conteudo->area_total;
			$this->iptu 			= $conteudo->iptu;
			$this->preco 			= $conteudo->preco;
			$this->condominio 		= $conteudo->condominio;
			$this->destaque 		= $conteudo->destaque;
			$this->ano 				= $conteudo->ano;
		}
		return $this;
	}
	
	public function gravar_alteracao($id_produto, $id_categoria, $nome, $descricao, $foto, $preco, $slug) {
		$this->id_produto = $id_produto;
		$this->id_categoria = $id_categoria;
		$this->nome = $nome;
		$this->descricao = $descricao;
		$this->foto = $foto;
		$this->preco = $preco;
		$this->slug = $slug;
		$this->db->where('id_produto', $id_produto);
		return $this->db->update('produtos', $this);
	}
	
	public function excluir($id_conteudo) {
		$this->db->where('id_conteudo', $id_conteudo);
		return $this->db->delete('conteudos');
	}
}
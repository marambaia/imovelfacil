<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Max Imóveis
 *
 * Um projeto de gerenciamento de imobiliária construído com o framework PHP CodeIgniter
 *
 * @package		MaxImoveis
 * @author		Bernardo Marambaia
 * @copyright	Copyright (c) 2009 - 2013 Marambaia.Info - SCIENCEIT Tecnologia da Informação LTDA.
 * @link		http://marambaia.info
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Tiles Class
 *
 * Essa classe habilita a criação e carrega os dados para as partes repetidas do layout
 *
 * @package		MaxImoveis
 * @subpackage	Libraries
 * @category	Libraries
 * @author		Bernardo Marambaia
 * @link		http://marambaia.info/projetos/maximoveis/libraries/tiles.html
 */

// ------------------------------------------------------------------------
class Tiles {

	var $CI;
	var $tel_celular1;
	var $tel_celular2;
	var $tel_fixo1;
	var $email_principal;
	var $endereco_principal;
	
	/**
	 * Constructor
	 *
	 * Loads the calendar language file and sets the default time reference
	 */
	public function __construct($config = array())
	{
		$this->CI =& get_instance();
		$this->CI->load->model('Opcoes_model', 'opcoes');
		$this->CI->load->model('Tipos_model', 'tipos');
		$this->CI->load->model('Localidades_model', 'localidades');
		$this->CI->load->model('Conteudos_model', 'conteudos');
		$this->CI->load->model('Usuarios_model', 'usuarios');
		$this->CI->load->model('Depoimentos_model', 'depoimentos');
		
		$this->tel_celular1		  = $this->CI->opcoes->listar_por_nome('telefone_celular1');
		$this->tel_celular2 	  = $this->CI->opcoes->listar_por_nome('telefone_celular2');
		$this->tel_fixo1	  	  = $this->CI->opcoes->listar_por_nome('telefone_fixo1');
		$this->email_principal	  = $this->CI->opcoes->listar_por_nome('email_principal');
		$this->endereco_principal = $this->CI->opcoes->listar_por_nome('endereco_principal');
	}

	// --------------------------------------------------------------------
	/**
	 * Cabeçalho
	 *
	 * Prepara e retorna os valores para o cabeçalho das páginas.
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @param	string
	 * @param	string
	 * @param	string
	 * @return	array  Retorna um array com os valores
	 */
	function cabecalho($title = 'Max Imóveis', $body_class = NULL, $author = 'Bernardo Marambaia', $description = NULL, $keywords = NULL) {
			$html_header = array(
					'title' => $title,
					'body_class' => $body_class,
					'author' => $author,
					'description' => $description,
					'keywords' => $keywords
			);
	
			return $html_header;
	}

	// ------------------------------------------------------------------------
	
	/**
	 *
	 */
	function topo() {
		$topo['tel_principal'] = $this->tel_celular1[0]->valor;
		$idiomas = $this->CI->opcoes->listar_por_nome('idioma');
		$i = 1;
		foreach ($idiomas as $idioma) {
			$topo['idioma_'.$i] = $idioma->valor;
			$i++;
		}
		return $topo;
	}

	// ------------------------------------------------------------------------
	
	/**
	 * 
	 */
	function menu_destaque() {
		$menu_destaques = $this->CI->paginas->listar_paginas_por_tipo(1, 3);
		$item_menu = '';
		for ($i = 0; $i < 3; $i++) {
			$item_menu['item_'.$i] = array('nome' => $menu_destaques[$i]['nome'], 'slug' => $menu_destaques[$i]['slug'], 'descricao' => $menu_destaques[$i]['descricao']);
		}
		return $item_menu;
	} 
	
	/**
	 * 
	 * @return string
	 */
	function menu_principal() {
		$menu_principal = $this->CI->paginas->listar_paginas_por_tipo(2, 6);
		
		$menu  = '';
		$menu .= '<ul id="menu-primary-menu" class="sf-menu sf-js-enabled sf-shadow">';
		foreach ($menu_principal as $item) {
			
			$controller_path = '/pagina/';
			
			if ($item['slug'] == '/')
				$controller_path = '';
			
			if (!empty($item['filhas']) && is_array($item['filhas'])) {
				$menu .= '<li '. $item['dados'] . '>';
				$menu .= '<a class="sf-with-ul" href="'. base_url($controller_path.$item['slug']) .'">'.$item['nome'].'<span class="sf-sub-indicator"> »</span></a>';
				$menu .= '<ul style="display: none; visibility: hidden;" class="sub-menu">';
				foreach ($item['filhas'] as $filha) {
					$menu .= '<li '. $filha['dados'] . '>' . anchor(base_url($controller_path.$filha['slug']), $filha['nome']) . '</li>';
				}
				$menu .= '</ul>';
				$menu .= '</li>';
			} else {
				$menu .= '<li '. $item['dados'] . '>' . anchor(base_url($controller_path.$item['slug']), $item['nome']) . '</li>';
			}
		}
		$menu .= '</ul>';
		return $menu;
	}
	
	/**
	 * 
	 * @return string
	 */
	function depoimentos() {
		$depoimentos = $this->CI->depoimentos->listar(null, '8');
		$lista_depoimentos = '';
		foreach ($depoimentos as $depoimento) {
			$lista_depoimentos .= '<div>';
			$lista_depoimentos .= '<p>'.$depoimento->texto.'</p>';
			if (!empty($depoimento->email)) {
				$lista_depoimentos .= '<p class="name"><a href="mailto:'.$depoimento->email.'">'.$depoimento->autor.'</a></p>';
			} else {
				$lista_depoimentos .= '<p class="name">'.$depoimento->autor.'</p>';
			}
			$lista_depoimentos .= '</div>';
		}
		return $lista_depoimentos;
	}
	
	/**
	 * 
	 * @return string
	 */
	function lista_tipo_imovel() {
		$imoveis = $this->CI->tipos->tipo_imoveis();
		$lista_imoveis  = '';
		foreach ($imoveis as $imovel) {
			$lista_imoveis .= '<option value='.$imovel->id_tipo.'>'.$imovel->nome.'</option>';
		}
		return $lista_imoveis;
	}
	
	function lista_localidades() {
		$localidades = $this->CI->localidades->lista_localidades_estados();
		$lista_localidades  = '';
		foreach ($localidades as $localidade) {
			$lista_localidades .= '<option value='.$localidade->id_localidade.'>'.$localidade->localidade.' - '.$localidade->uf.'</option>';
		}
		return $lista_localidades;
	}
	
	/**
	 * 
	 * @return string
	 */
	function historias() {
		$historias = $this->CI->conteudos->listar_historias();
		$lista_historias = '';
		foreach ($historias as $historia) {
			$lista_historias .= '<!-- One Box -->';
			$lista_historias .= '<li>';
			$lista_historias .= '<a class="item-image" title="'.$historia->descricao.'" data-lightbox="image-list" href="'.base_url('/conteudo/'.$historia->dir_imagem.'/'.$historia->nome_imagem.$historia->ext_imagem).'">';
			$lista_historias .= img('/conteudo/'.$historia->dir_imagem.'/'.$historia->nome_imagem.'_pq'.$historia->ext_imagem);
			$lista_historias .= '</a>';
			$lista_historias .= '<div class="narrow-item-details" style="float: right;">';
			$lista_historias .= '<h3><a title="'.$historia->descricao.'" data-lightbox="txt-list" href="'.base_url('/conteudo/'.$historia->dir_imagem.'/'.$historia->nome_imagem.$historia->ext_imagem).'">'.$historia->titulo.'</a></h3>';
			$lista_historias .= '<div class="item-info">'.$historia->localidade.'</div>';
			$lista_historias .= '<div class="price">'.$historia->ano.'</div>';
			$lista_historias .= '</div>';
			$lista_historias .= '</li>';
			$lista_historias .= '<!-- End One Box -->';
		}
		return $lista_historias;
	}
	
	/**
	 * 
	 * @return array
	 */
	function rodape() {
		$footer['tel_celular1']		  = $this->tel_celular1[0]->valor;
		$footer['tel_celular2']		  = $this->tel_celular2[0]->valor;
		$footer['tel_fixo1']		  = $this->tel_fixo1[0]->valor;
		$footer['email_principal']    = $this->email_principal[0]->valor;
		$footer['endereco_principal'] = $this->endereco_principal[0]->valor;
		
		return $footer;
	}
	
	/**
	 * 
	 * @return array
	 */
	function contato() {
		$contato['tel_celular1'] = $this->tel_celular1[0]->valor;
		$contato['tel_celular2'] = $this->tel_celular2[0]->valor;
		$contato['tel_fixo1']	 = $this->tel_fixo1[0]->valor;
		
		return $contato;
	}
	
	/**
	 * Get either a Gravatar URL or complete image tag for a specified email address.
	 *
	 * @param string $email The email address
	 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
	 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
	 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
	 * @param boole $img True to return a complete IMG tag False for just the URL
	 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
	 * @return String containing either just a URL or a complete image tag
	 * @source http://gravatar.com/site/implement/images/php/
	 */
	public function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
		$url = 'http://www.gravatar.com/avatar/';
		$url .= md5( strtolower( trim( $email ) ) );
		$url .= "?s=$s&d=$d&r=$r";
		if ( $img ) {
			$url = '<img src="' . $url . '"';
			foreach ( $atts as $key => $val )
				$url .= ' ' . $key . '="' . $val . '"';
			$url .= ' />';
		}
		return $url;
	}
	
	public function avatar()
	{
		$usuario = $this->CI->usuarios->ver($this->CI->session->userdata('id'));
		$dados = array();
		
		if ( count($usuario) == 1 )
		{
			$dados['avatar'] = $this->get_gravatar( $usuario->email, null, 'identicon', null, null, array() );
			$dados['usuario'] = $usuario->titulo.' '.$usuario->nome;
		}
		
		return $dados;
	}
}

// END Tiles class

/* End of file Tiles.php */
/* Location: ./application/libraries/Tiles.php */
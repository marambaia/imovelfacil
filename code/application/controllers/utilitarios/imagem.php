<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Imagem extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->library('image_lib');
	}
	
	public function index() {
		$this->gerar_miniatura('catedral.jpg', 600, 400);
		$this->girar('catedral.jpg', 90);
		$this->marca_dagua_texto('catedral_thumb.jpg', "Porto Alegre - Brasil", 18);
		$this->marca_dagua_imagem('catedral_thumb.jpg', 'codeigniter_logo.png');
		$this->load->view('utilitarios/imagem');
	}
	
	public function gerar_miniatura($foto, $width, $height, $miniatura = TRUE) {
		$this->image_lib->clear();
		$config['image_library'] = 'gd2';
		$config['source_image'] = 'fotos/' . $foto;
		$config['create_thumb'] = $miniatura;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = $width;
		$config['height'] = $height;
		$this->image_lib->initialize($config);
		return $this->image_lib->resize();
	}
	
	public function girar($foto, $angulo) {
		$this->image_lib->clear();
		$config['image_library'] = 'gd2';
		$config['source_image'] = 'fotos/' . $foto;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['thumb_marker'] = '_rotated';
		$config['rotation_angle'] = $angulo;
		$this->image_lib->initialize($config);
		$this->image_lib->rotate();
		return $this->gerar_miniatura('catedral_rotated.jpg', 300, 400, FALSE);
	}
	
	public function criar_copia($origem, $destino) {
		$this->image_lib->clear();
		$config['source_image'] = 'fotos/' . $origem;
		$config['new_image'] = 'fotos/' . $destino;
		$this->image_lib->initialize($config);
		if ($this->image_lib->resize()) {
			return $destino;
		} else {
			echo $this->image_lib->display_errors();
		}
	}
	
	public function marca_dagua_texto($foto, $texto, $font_size = '16') {
		$aplicar_em = $this->criar_copia($foto, 'marked_'.$foto);
		$this->image_lib->clear();
		$config['source_image'] = 'fotos/' . $aplicar_em;
		$config['wm_text'] = $texto;
		$config['wm_type'] = 'text';
		$config['wm_font_path'] = 'system/fonts/texb.ttf';
		$config['wm_font_size'] = $font_size;
		$config['wm_font_color'] = 'ffffff';
		$config['wm_vrt_alignment'] = 'top';
		$config['wm_hor_alignment'] = 'center';
		$config['wm_padding'] = '10';
		$this->image_lib->initialize($config);
		if (!$this->image_lib->watermark()) {
			echo $this->image_lib->display_errors();
		}
	}
	
	public function marca_dagua_imagem($foto, $marca_dagua) {
		$aplicar_em = $this->criar_copia($foto, 'overlay_' . $foto);
		$this->image_lib->clear();
		$config['source_image'] = 'fotos/' . $aplicar_em;
		$config['wm_overlay_path'] = 'fotos/' . $marca_dagua;
		$config['wm_type'] = 'overlay';
		$config['wm_vrt_alignment'] = 'top';
		$config['wm_hor_alignment'] = 'right';
		$config['wm_padding'] = '0';
		$this->image_lib->initialize($config);
		if (!$this->image_lib->watermark()) {
			echo $this->image_lib->display_errors();
		}
	}
}
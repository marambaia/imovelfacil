<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendario extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	
	public function index($ano = null, $mes = null) {
		if (!$ano)
			$ano = date('y');
		
		if (!$mes)
			$mes = date('m');
		
		$this->config->load('my_calendar');
		$preferencias = $this->config->item('formato');
		$preferencias['template'] = $this->config->item('template');
		$this->load->library('calendar', $preferencias);
		
		$feriados = array(
				'01-2012' => array('1' => base_url('posts/01/01/confraternizadao-universal')),
				'02-2012' => array('21' => base_url('posts/21/02/carnaval')),
				'04-2012' => array('6' => base_url('posts/06/04/paixao-de-cristo'), '21' => base_url('posts/21/04/tiradentes')),
				'05-2012' => array('1' => base_url('posts/01/05/dia-do-trabalhado')),
				'06-2012' => array('7' => base_url('posts/07/06/corpus-christi')),
				'09-2012' => array('7' => base_url('posts/07/09/independencia-do-brasil')),
				'10-2012' => array('12' => base_url('posts/12/10/nossa-senhora-aparecida')),
				'11-2012' => array('2' => base_url('posts/02/11/dia-dos-finados'), '15' => base_url('posts/15/11/proclamacao-da-republica')),
				'12-2012' => array('25' => base_url('posts/25/12/natal'))
		);
		
		if (! array_key_exists(($mes . '-' . $ano), $feriados)) {
			$feriados[$mes . '-' . $ano] = null;
		}
		
		$data['calendario'] = $this->calendar->generate($ano, $mes, $feriados[$mes . '-' . $ano]);
		$this->load->view('utilitarios/calendario', $data);
	}
	
	public function simples() {
		$this->load->library('calendar');
		echo $this->calendar->generate(2012, 11);
	}
}
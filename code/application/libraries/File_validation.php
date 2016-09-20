<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class File_validation {
	
	var $userfile;
	var $human_name;
	var $validation_function;
	var $CI;
	
	public function __construct()
	{
		$this->CI = & get_instance();
		$this->CI->load->library('form_validation');
	}
	
	public function set_rules($userfile, $human_name, $validation_function)
	{
		$this->userfile = $userfile;
		$this->human_name = $human_name;
		$this->validation_function = $validation_function;
		
		if (isset($_FILES[$this->userfile]) && !empty($_FILES[$this->userfile]['name']))
		{
			return TRUE;
		}
		else
		{
			$this->CI->form_validation->set_rules($this->userfile, $this->human_name, $this->validation_function);
		}
	}
}

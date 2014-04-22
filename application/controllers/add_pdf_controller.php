<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_pdf_controller extends CI_Controller {
	
	private static $className;
	
	public function __construct(){
		parent::__construct();
		$this->className = $this->router->fetch_class();
	}

	public function index(){
		//validateSession();
		log_class_method(LEVEL_DEBUG, $this->className , 'index.....Inicio');		
		$this->goAddForm();
	}
	
	private function goAddForm(){
		log_class_method(LEVEL_DEBUG, $this->className, 'goAddForm');
		$this->load->view('add_pdf_view');
	}
}
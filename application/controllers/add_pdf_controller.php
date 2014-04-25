<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_pdf_controller extends CI_Controller {
	
	private static $className;
	
	public function __construct(){
		parent::__construct();
		$this->className = $this->router->fetch_class();
	}

	public function index(){
		validateSession();
		log_class_method(LEVEL_DEBUG, $this->className , 'index.....Inicio');		
		$this->goAddForm();
		log_class_method(LEVEL_DEBUG, $this->className , 'index.....Fin');
	}
	
	public function add(){
		log_class_method(LEVEL_DEBUG, $this->className, 'add.....Inicio');
		$this->goSuccess();
		log_class_method(LEVEL_DEBUG, $this->className, 'add.....Fin');
	}
	
	private function goAddForm(){
		log_class_method(LEVEL_DEBUG, $this->className, 'goAddForm');
		$this->load->view('add_pdf_view', array('errorMessage'=>''));
	}
	
	private function goSuccess(){
		log_class_method(LEVEL_DEBUG, $this->className, 'goSuccess');
		$this->load->view('success_view');		
	}
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_pdf_controller extends CI_Controller {

	public function index(){
		log_message(LEVEL_DEBUG, 'Add_pdf_controller.index');		
		$this->goAddForm();
	}
	
	public function goAddForm(){
		$this->load->view('add_pdf_view');
	}
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_pdf_controller extends CI_Controller {
	
	private static $className;
	private $requestData = array('dataMessage'=>'','dataGrid'=>'','code'=>'','name'=>'','startDate'=>'','endDate'=>'');
	
	public function __construct(){
		parent::__construct();
		$this->className = $this->router->fetch_class();	
		$this->load->model('Pdf_Files_Model');
		$this->load->library('table');
		$this->load->helper('html');
		$this->setRulesValidationForm();
	}
	
	public function index(){
		log_class_method(LEVEL_DEBUG, $this->className , 'index.....Inicio');
		validateSession();
		$this->goForm($this->requestData);
		log_class_method(LEVEL_DEBUG, $this->className , 'index.....Fin');
	}
	
	public function search(){
		log_class_method(LEVEL_DEBUG, $this->className , 'search.....Inicio');
		validateSession();
		$request = (object)$this->requestData;
		
		$request->code = $this->input->post('code-field');
		$request->name = $this->input->post('name-field');
		$request->startDate = $this->input->post('start-date-field');
		$request->endDate = $this->input->post('end-date-field');
		
		$isValidateOk = $this->form_validation->run();
		if (!$isValidateOk){
			$request->dataMessage = validation_errors();
			return $this->goForm($request);
		}
		
		$request->dataMessage = '';
		
		$request->dataGrid = $this->prepareGrid($this->Pdf_Files_Model->getPdfFilesData($request));
		$this->goForm($request);
		
		log_class_method(LEVEL_DEBUG, $this->className , 'search.....Fin');
	}
	
	private function prepareGrid($result){
		$this->table->set_heading('Accion','Codigo', 'Nombre', 'Fecha', 'Ubicacion');
		foreach ($result as $row){
			$this->table->add_row('<a href="'.site_url().'edit_pdf_controller/load/'.$row->pdf_files_pk.'">Editar</a>',
					              $row->code,$row->name,$row->pdf_date,
								  '<a href="'.site_url().PDF_FILES_PATH.$row->full_path.'">'.PDF_FILES_PATH.$row->full_path.'</a>');
		}
		return $this->table->generate();
	}
	
	private function setRulesValidationForm(){
		log_class_method(LEVEL_DEBUG, $this->className, 'setRulesValidationForm');
		$this->form_validation->set_error_delimiters('','<br>');
		$this->form_validation->set_message(
				'checkdate',
				'El campo %s es mayor a la actual');
		$this->form_validation->set_rules(
				'code-field', 'Codigo',
				'trim');
		$this->form_validation->set_rules(
				'start-date-field', 'Fecha de Inicio',
				'regex_match['.DATE_PATTERN.']|callback_checkdate'
		);
		$this->form_validation->set_rules(
				'end-date-field', 'Fecha de final',
				'regex_match['.DATE_PATTERN.']|callback_checkdate'
		);
	
	}
	
	public function checkdate($newdate){
		log_class_method(LEVEL_DEBUG, $this->className, 'checkdate');		
		return is_null_or_empty($newdate)?true:is_less_than_current($newdate)&&is_valid_date($newdate);
	}
	
	private function goForm($data){
		log_class_method(LEVEL_DEBUG, $this->className, 'goForm');
		$this->load->view('search_pdf_view', $data);
	}
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit_pdf_controller extends CI_Controller {
	
	private static $className;
	private $uploadFileConf = array('allowed_types'=>'pdf|doc|docx','max_size' => '10240');
	private $requestData = array('dataMessage'=>'','id_pdf_file' => '','code'=>'','name'=>'','pdf_date'=>'');
	
	public function __construct(){
		parent::__construct();
		$this->className = $this->router->fetch_class();
		log_class_method(LEVEL_DEBUG, $this->className, '__construct');				
		$this->load->library('upload');	
		$this->load->model('Pdf_Files_Model');	
		$this->setRulesValidationForm();
	}

	public function load($id_pdf_file){		
		log_class_method(LEVEL_DEBUG, $this->className , 'index.....Inicio');
		validateSession();		
		$requestDataArray = (array)$this->Pdf_Files_Model->getPdfFilesDataById($id_pdf_file);
		$requestDataArray['pdf_date'] = date_format_for_app($requestDataArray['pdf_date']);
		$requestDataArray['dataMessage']= '';
		$this->goForm($requestDataArray);
		log_class_method(LEVEL_DEBUG, $this->className , 'index.....Fin');
	}
	
	public function edit(){
		log_class_method(LEVEL_DEBUG, $this->className, 'add.....Inicio');
		validateSession();
		
		$request = (object)$this->requestData;
		$request->code = $this->input->post('code-field');
		$request->name = $this->input->post('name-field');
		$request->date = $this->input->post('date-field');
		$request->id_pdf_file = $this->input->post('id-field');
				
		$isValidateOk = $this->form_validation->run();
		if (!$isValidateOk){
			$request->dataMessage = validation_errors();
			return $this->goForm($request);
		}
		
		$this->modifyData($request);
	
		$this->load($request->id_pdf_file);
		
		log_class_method(LEVEL_DEBUG, $this->className, 'add.....Fin');
	}
	
	private function modifyData($dataUpdated){
		log_class_method(LEVEL_DEBUG, $this->className, 'modifyData');
		$dataUpdated->date = date_format_for_db($dataUpdated->date);
		$this->Pdf_Files_Model->updatePdfFileData($dataUpdated);
	}
			
	private function setRulesValidationForm(){
		log_class_method(LEVEL_DEBUG, $this->className, 'setRulesValidationForm');
		$this->form_validation->set_error_delimiters('','<br>');
		$this->form_validation->set_message(
				'checkdate',
				'El campo %s es mayor a la actual o es inexistente');
		$this->form_validation->set_rules(
				'code-field', 'Codigo',
				'trim|required');
		$this->form_validation->set_rules(
				'name-field', 'Nombre',
				'required');
		$this->form_validation->set_rules(
				'date-field', 'Fecha', 
				'required|regex_match['.DATE_PATTERN.']|callback_checkdate'
		);
		
	}
	
	public function checkdate($newdate){
		log_class_method(LEVEL_DEBUG, $this->className, 'checkdate');
		return is_less_than_current($newdate)&&is_valid_date($newdate);		
	}
	
	private function goForm($data){
		log_class_method(LEVEL_DEBUG, $this->className, 'goForm');
		$this->load->view('edit_pdf_view', $data);
	}
	
}
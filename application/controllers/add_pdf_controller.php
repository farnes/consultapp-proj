<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_pdf_controller extends CI_Controller {
	
	private static $className;
	private $uploadFileConf = array('allowed_types'=>'pdf|doc|docx','max_size' => '10240');
	private $entityData = array('dataMessage'=>'','code'=>'','name'=>'','date'=>'');
	
	public function __construct(){
		parent::__construct();
		log_class_method(LEVEL_DEBUG, $this->className, '__construct');
		$this->className = $this->router->fetch_class();		
		$this->load->library('upload');		
	}

	public function index(){		
		log_class_method(LEVEL_DEBUG, $this->className , 'index.....Inicio');
		validateSession();						
		$this->goForm($this->entityData);
		log_class_method(LEVEL_DEBUG, $this->className , 'index.....Fin');
	}
	
	public function add(){
		log_class_method(LEVEL_DEBUG, $this->className, 'add.....Inicio');
		validateSession();
		
		$request = (object)$this->entityData;
		$request->code = $this->input->post('code-field');
		$request->name = $this->input->post('name-field');
		$request->date = $this->input->post('date-field');
		
		$this->setRulesValidationForm();
		$isValidateOk = $this->form_validation->run();
		if (!$isValidateOk){
			$request->dataMessage = validation_errors();
			$this->goForm($request);
			return;
		}				
		
		$this->prepareFileConf($request);
		$loadCorrectly = $this->upload->do_upload('upload-field');
		if (!$loadCorrectly){
			$request->dataMessage = $this->upload->display_errors();
			$this->goForm($request);				
			return;
		}
	
		$this->goForm($this->prepareSuccessData($request));
		
		log_class_method(LEVEL_DEBUG, $this->className, 'add.....Fin');
	}
	
	private function prepareSuccessData($success){
		log_class_method(LEVEL_DEBUG, $this->className, 'prepareSuccessData');
		$msg = 'El archivo se ha guardado con exito<br>';
		foreach ($this->upload->data() as $key => $value){
			$msg .= $key.' : '.$value.'<br>';
		}		
		$success->code = '';
		$success->name = '';
		$success->date = '';
		$success->dataMessage = $msg;
		return $success;
	}
	
	private function prepareFileConf($request){
		log_class_method(LEVEL_DEBUG, $this->className, 'prepareFileConf');
		$dateArray =  explode('/', $request->date);
		$folder = './uploads/pdf_files/'.$dateArray[2].$dateArray[1].$dateArray[0].'/';
		if(!is_dir($folder))mkdir($folder, 0777, true);		
		$this->uploadFileConf['upload_path'] = $folder;
		$this->uploadFileConf['file_name'] = $request->code.'_'.$request->name;
		$this->upload->initialize($this->uploadFileConf);
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
		$this->load->view('add_pdf_view', $data);
	}
	
}
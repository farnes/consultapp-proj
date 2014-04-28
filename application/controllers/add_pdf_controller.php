<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_pdf_controller extends CI_Controller {
	
	private static $className;
	private $uploadFileConf = array('allowed_types'=>'pdf|doc|docx','max_size' => '10240');
	
	public function __construct(){
		parent::__construct();
		$this->className = $this->router->fetch_class();		
		$this->load->library('upload');
	}

	public function index(){		
		log_class_method(LEVEL_DEBUG, $this->className , 'index.....Inicio');
		validateSession();
		$this->goAddForm();
		log_class_method(LEVEL_DEBUG, $this->className , 'index.....Fin');
	}
	
	public function add(){
		log_class_method(LEVEL_DEBUG, $this->className, 'add.....Inicio');
		validateSession();
		$code_field = $this->input->post('code-field');
		$name_field = $this->input->post('name-field');
		$date_field = $this->input->post('date-field');
		
		
		$this->setRulesValidationForm();
		$isValidateOk = $this->form_validation->run();
		if (!$isValidateOk){
			$this->goAddForm();
			return;
		}
		
		$this->prepareFileConf($date_field, $code_field, $name_field);
		$loadCorrectly = $this->upload->do_upload('upload-field');
		if (!$loadCorrectly){
			$this->goAddFormWithErrorMessage($this->upload->display_errors());				
			return;
		}
		
		$data = array('upload_data' => $this->upload->data());
		
		$this->goSuccess();
		log_class_method(LEVEL_DEBUG, $this->className, 'add.....Fin');
	}
	
	private function prepareFileConf($date,$code,$name){
		
		$dateArray =  explode('/', $date);
		$folder = './uploads/pdf_files/'.$dateArray[2].$dateArray[1].$dateArray[0].'/';
		if(!is_dir($folder))mkdir($folder, 0777, true);		
		$this->uploadFileConf['upload_path'] = $folder;
		$this->uploadFileConf['file_name'] = $code.'_'.$name;
		$this->upload->initialize($this->uploadFileConf);
	}
	
	private function setRulesValidationForm(){
				
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
				//'regex_match['.DATE_PATTERN.']|
				'callback_checkdate'
		);
		
	}
	
	public function checkdate($newdate){
		return is_less_than_current($newdate)&&is_valid_date($newdate);		
	}
	
	private function goAddForm(){
		log_class_method(LEVEL_DEBUG, $this->className, 'goAddForm');
		$this->load->view('add_pdf_view', array('errorMessage'=>''));
	}
	
	private function goAddFormWithErrorMessage($message){
		log_class_method(LEVEL_DEBUG, $this->className, 'goAddFormWithErrorMessage');
		$this->load->view('add_pdf_view', array('errorMessage'=>$message));
	}
	
	private function goSuccess(){
		log_class_method(LEVEL_DEBUG, $this->className, 'goSuccess');
		$this->load->view('success_view');		
	}
	
}
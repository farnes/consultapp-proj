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
		$day_field = $this->input->post('day-field');
		$month_field = $this->input->post('month-field');
		$year_field = $this->input->post('year-field');
		$date_field = $this->input->post('date-field');
		
		$this->setRulesValidationForm();
		if ($this->form_validation->run() == FALSE){
			$this->goAddForm();
			return;
		}
		
		$this->prepareFileConf($day_field, $month_field, $year_field, $code_field, $name_field);
		$loadCorrectly = $this->upload->do_upload('upload-field');
		if (!$loadCorrectly){
			$this->goAddFormWithErrorMessage($this->upload->display_errors());				
			return;
		}
		
		$data = array('upload_data' => $this->upload->data());
		
		$this->goSuccess();
		log_class_method(LEVEL_DEBUG, $this->className, 'add.....Fin');
	}
	
	private function prepareFileConf($day,$month,$year,$code,$name){
		
		$folder = './uploads/pdf_files/'.$year.$month.$day.'/';
		if(!is_dir($folder))mkdir($folder, 0777, true);		
		$this->uploadFileConf['upload_path'] = $folder;
		$this->uploadFileConf['file_name'] = $code.'_'.$name;
		$this->upload->initialize($this->uploadFileConf);
	}
	
	private function setRulesValidationForm(){
		$this->form_validation->set_rules(
				'date-field', 'Fecha', 
				'regex_match[#^[0-9]{2}/[0-9]{2}/[0-9]{4}$#]'
		);
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
	
	public function dummy(){
		return;	
	}
}
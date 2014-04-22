<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_Controller extends CI_Controller {
	
	private static $className;
	
	public function __construct(){
		parent::__construct();
		$this->className = $this->router->fetch_class();
	}

	public function index(){
		log_class_method(LEVEL_DEBUG, $this->className , 'index');
		$this->isLogged()?$this->goHome():$this->goFormLoggin();
	}

	public function loggin(){
		log_class_method(LEVEL_DEBUG, $this->className , 'loggin.....Inicio');

		if($this->isLogged()){
			$this->goHome();
			return;
		}
		
		$this->setRulesValidationForm();
		if ($this->form_validation->run() == FALSE){
			$this->goFormLoggin();
			return;
		}
		
		$user_field = $this->input->post('user-field');
		$pass_field = $this->input->post('pass-field');
		$id_user = $this->User_Model->getIdByUserPass($user_field,$pass_field);
		
		if(!$id_user){		
			$this->goFormLogginWithErrorMessage('El usuario o contrase&#241;a no es correcto');
			return;
		}
		
		$this->saveSession($id_user);
				
		$this->goHome();
		
		log_class_method(LEVEL_DEBUG, $this->className , 'loggin.....Fin');
	}
	
	public function loggout(){
		log_class_method(LEVEL_DEBUG, $this->className , 'loggout.....Inicio');
		if($this->isLogged()){
			$this->cleanSession();
		}
		$this->goFormLoggin();
		log_class_method(LEVEL_DEBUG, $this->className , 'loggout.....Fin');
	}

	private function saveSession($id){
		log_class_method(LEVEL_DEBUG, $this->className , 'saveSession');
		
		$data = $this->User_Model->getUserById($id);
		
		$infoSession = array(
			INFO_SESSION_USER => $data,
			INFO_SESSION_LOGGIN_IN => TRUE
		);
		
		$this->session->set_userdata($infoSession);
	}
	
	private function cleanSession(){
		log_class_method(LEVEL_DEBUG, $this->className , 'cleanSession');		
		
		$infoSession = array(
				INFO_SESSION_USER=>'',
				INFO_SESSION_LOGGIN_IN => FALSE
		);
		$this->session->unset_userdata($infoSession);
	}
	
	public function isLogged(){
		log_class_method(LEVEL_DEBUG, $this->className , 'isLogged');
		$result = $this->session->userdata(INFO_SESSION_LOGGIN_IN);		
		return $result;
	}

	private function setRulesValidationForm(){
		log_class_method(LEVEL_DEBUG, $this->className , 'setRulesValidationForm');
		$this->form_validation->set_rules(
			'user-field', 'Usuario',
			'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules(
			'pass-field', 'Contrase&#241;a',
			'trim|required|min_length[3]|max_length[30]');
	}
	
	private function goHome(){
		log_class_method(LEVEL_DEBUG, $this->className , 'goHome');
		$this->load->view('home_view');
	}
	
	private function goFormLoggin(){
		log_class_method(LEVEL_DEBUG, $this->className , 'goFormLoggin');
		$this->load->view('login_view', array('errorMessage'=>''));
	}
	
	private function goFormLogginWithErrorMessage($message){
		log_class_method(LEVEL_DEBUG, $this->className , 'goFormLogginWithErrorMessage');
		$this->load->view('login_view', array('errorMessage'=>$message));
	}
}

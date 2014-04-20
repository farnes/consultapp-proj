<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_Controller extends CI_Controller {

	public function index(){
		log_message(LEVEL_DEBUG, 'Login_Controller.index');
		$this->isLogged()?$this->goHome():$this->goFormLoggin();
	}

	public function loggin(){
		log_message(LEVEL_DEBUG, 'Login_Controller.loggin.....Inicio');

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
			$this->goFormLoggin();
			return;
		}
		
		$this->saveSession($id_user);
				
		$this->goHome();
		
		log_message(LEVEL_DEBUG, 'Login_Controller.loggin.....Fin');
		log_message(LEVEL_DEBUG, '------------------------------------------');
	}
	
	public function loggout(){
		log_message(LEVEL_DEBUG, 'Login_Controller.loggout.....Inicio');
		if($this->isLogged()){
			$this->cleanSession();
		}
		$this->goFormLoggin();
		log_message(LEVEL_DEBUG, 'Login_Controller.loggout.....Fin');
		log_message(LEVEL_DEBUG, '------------------------------------------');
	}

	private function saveSession($id){
		log_message(LEVEL_DEBUG, 'Login_Controller.saveSession');
		
		$data = $this->User_Model->getUserById($id);
		
		$infoSession = array(
			INFO_SESSION_USER => $data,
			INFO_SESSION_LOGGIN_IN => TRUE
		);
		
		$this->session->set_userdata($infoSession);
	}
	
	private function cleanSession(){
		log_message(LEVEL_DEBUG, 'Login_Controller.cleanSession');		
		
		$infoSession = array(
				INFO_SESSION_USER=>'',
				INFO_SESSION_LOGGIN_IN => FALSE
		);
		$this->session->unset_userdata($infoSession);
	}
	
	public function isLogged(){
		log_message(LEVEL_DEBUG, 'Login_Controller.isLogged');
		$result = $this->session->userdata(INFO_SESSION_LOGGIN_IN);		
		return $result;
	}

	private function setRulesValidationForm(){
		log_message(LEVEL_DEBUG, 'Login_Controller.setRulesValidationForm');
		$this->form_validation->set_rules(
			'user-field', 'Usuario',
			'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules(
			'pass-field', 'Contrase&#241;a',
			'trim|required|min_length[3]|max_length[30]');
	}
	
	private function goHome(){
		log_message(LEVEL_DEBUG, 'Login_Controller.goHome');
		$this->load->view('home');
	}
	
	private function goFormLoggin(){
		log_message(LEVEL_DEBUG, 'Login_Controller.goFormLoggin');
		$this->load->view('login_view');
	}
}

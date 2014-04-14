<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_Controller extends CI_Controller {
	
	private $user_field;
	private $pass_field;

	public function index(){
		log_message(LEVEL_ERROR, 'Login_Controller->index()');
		$this->isLogged()?$this->goHome():$this->goFormLoggin();
	}

	public function loggin(){
		log_message(LEVEL_ERROR, 'Inicio Login_Controller->loggin');

		if($this->isLogged()){
			$this->goHome();
			return;
		}
		
		$this->setRulesValidationForm();
		if ($this->form_validation->run() == FALSE){
			$this->goFormLoggin();
			return;
		}
		
		$this->getFieldsForm();
		if(!$this->User_Model->isUserExist($this->user_field,$this->pass_field)){
			$this->goFormLoggin();
			return;
		}
		
		$infoSession = array(
			INFO_SESSION_USER => $this->user_field,
			INFO_SESSION_LOGGIN_IN => TRUE
		);
		
		$this->session->set_userdata($infoSession);
		log_message(LEVEL_ERROR, 'guardo la sesion');
		$this->goHome();
		
		log_message(LEVEL_ERROR, 'Fin Login_Controller->loggin');
		log_message(LEVEL_ERROR, '------------------------------------------');
	}
	
	public function loggout(){
		log_message(LEVEL_ERROR, 'Inicio Login_Controller->loggout');
		if($this->isLogged()){
			log_message(LEVEL_ERROR, 'if this->isLogged : true');
			$infoSession = array(
				INFO_SESSION_USER=>'',
				INFO_SESSION_LOGGIN_IN => FALSE
			);
			$this->session->unset_userdata($infoSession);
		}
		$this->goFormLoggin();
		log_message(LEVEL_ERROR, 'Fin Login_Controller->loggout');
		log_message(LEVEL_ERROR, '------------------------------------------');
	}

	public function isLogged(){
		$result = $this->session->userdata(INFO_SESSION_LOGGIN_IN);
		log_message(LEVEL_ERROR, 'Login_Controller->isLogged() '.($result?'true':'false'));
		return $result;
	}
	
	private function getFieldsForm(){
		$this->user_field = $this->input->post('user-field');
		$this->pass_field = $this->input->post('pass-field');
		log_message(LEVEL_ERROR, 'obtengo user/pass '.$this->user_field.'/'.$this->pass_field);
	}

	private function setRulesValidationForm(){
		$this->form_validation->set_rules(
			'user-field', 'Usuario',
			'trim|required|min_length[5]|max_length[30]');
		$this->form_validation->set_rules(
			'pass-field', 'Contrase&#241;a',
			'trim|required|min_length[5]|max_length[30]');
	}
	
	private function goHome(){
		log_message(LEVEL_ERROR, 'Login_Controller->goHome()');
		$this->load->view('home');
	}
	
	private function goFormLoggin(){
		log_message(LEVEL_ERROR, 'Login_Controller->goFormLoggin()');
		$this->load->view('login_view');
	}
}

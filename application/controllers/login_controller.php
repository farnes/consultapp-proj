<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_Controller extends CI_Controller {
	
	public function index(){
		log_message(LEVEL_ERROR, 'Login_Controller->index()');
		$this->isLogged()?$this->goHome():$this->goFormLoggin();
	}
	
	public function isLogged(){
		$result = $this->session->userdata(INFO_SESSION_LOGGIN_IN);
		log_message(LEVEL_ERROR, 'Login_Controller->isLogged() '.($result?'true':'false'));
		return $result;
	}
	
	public function loggin(){
		log_message(LEVEL_ERROR, '------------------------------------------');
		log_message(LEVEL_ERROR, 'Inicio Login_Controller->loggin');
		if(!$this->isLogged()){	
			$user_field = $this->input->post('user-field');
			$pass_field = $this->input->post('pass-field');
			log_message(LEVEL_ERROR, 'obtengo user/pass '.$user_field.'/'.$pass_field);
			if($this->User_Model->isUserExist($user_field,$pass_field)){ 
				$infoSession = array(
					INFO_SESSION_USER=>$user_field,
					INFO_SESSION_LOGGIN_IN => TRUE
				);		
				$this->session->set_userdata($infoSession);
				log_message(LEVEL_ERROR, 'guardo la sesion');			
				$this->goHome();
			} else {			
				$this->goFormLoggin();
			}
		} else {
			$this->goHome();
		}
		log_message(LEVEL_ERROR, 'Fin Login_Controller->loggin');
		log_message(LEVEL_ERROR, '------------------------------------------');
	}
	
	public function loggout(){
		log_message(LEVEL_ERROR, '------------------------------------------');
		log_message(LEVEL_ERROR, 'Inicio Login_Controller->loggout');	
		if($this->isLogged()){	
			log_message(LEVEL_ERROR, 'if this->isLogged : true');
			$infoSession = array(
				INFO_SESSION_USER=>'',
				INFO_SESSION_LOGGIN_IN => FALSE
			);
			$this->session->unset_userdata($infoSession);				
		}else{
			log_message(LEVEL_ERROR, 'if this->isLogged : false');			
		}
		$this->goFormLoggin();
		log_message(LEVEL_ERROR, 'Fin Login_Controller->loggout');
		log_message(LEVEL_ERROR, '------------------------------------------');
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

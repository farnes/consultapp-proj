<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_Controller extends CI_Controller {
	public function testSession(){
		$dataSession = array(
			'username' => 'joseperez',
			'email' => 'joseperez@algun-sitio.com',
			'logged_in' => TRUE
		);	
			
		$this->session->set_userdata($dataSession);
		log_message(LEVEL_ERROR, 'Test_Controller->testSession() '.($this->session->userdata('logged_in')?'true':'false'));
		log_message(LEVEL_ERROR, 'Test_Controller->testSession() '.($this->session->userdata('logged_in')?'true':'false'));
		log_message(LEVEL_ERROR, 'Test_Controller->testSession() '.($this->session->userdata('logged_in')?'true':'false'));
		$this->session->unset_userdata('logged_in');
		log_message(LEVEL_ERROR, 'Test_Controller->testSession() '.($this->session->userdata('logged_in')?'true':'false'));
		log_message(LEVEL_ERROR, 'Test_Controller->testSession() '.($this->session->userdata('logged_in')?'true':'false'));
		$this->session->set_userdata($dataSession);
		log_message(LEVEL_ERROR, 'Test_Controller->testSession() '.($this->session->userdata('logged_in')?'true':'false'));
		$this->session->unset_userdata('logged_in');
		log_message(LEVEL_ERROR, 'Test_Controller->testSession() '.($this->session->userdata('logged_in')?'true':'false'));
		log_message(LEVEL_ERROR, 'Test_Controller->testSession() '.($this->session->userdata('logged_in')?'true':'false'));
		log_message(LEVEL_ERROR, 'Test_Controller->testSession() '.($this->session->userdata('logged_in')?'true':'false'));
		$this->session->set_userdata($dataSession);
		log_message(LEVEL_ERROR, 'Test_Controller->testSession() '.($this->session->userdata('logged_in')?'true':'false'));
		log_message(LEVEL_ERROR, 'Test_Controller->testSession() '.($this->session->userdata('logged_in')?'true':'false'));
		log_message(LEVEL_ERROR, 'Test_Controller->testSession() '.($this->session->userdata('logged_in')?'true':'false'));
		log_message(LEVEL_ERROR, 'Test_Controller->testSession() '.($this->session->userdata('logged_in')?'true':'false'));
		$this->session->unset_userdata('logged_in');
	}
}

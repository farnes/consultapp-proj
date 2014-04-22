<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Revisa en la sesion si esta loggeado
if(!function_exists('validateSession')){
	function validateSession(){
		log_message(LEVEL_DEBUG, 'Iniciando Helper funcion validateSession()');
		$CI =& get_instance();
		if($CI->session->userdata(INFO_SESSION_LOGGIN_IN)){
			log_message(LEVEL_DEBUG, 'sesion expirada o no esta logueado');
			redirect(base_url().'login_controller/loggin');
		}
	}
}

if(!function_exists('log_class_method')){
	function log_class_method($level,$nameClass,$nameMethod){		
		log_message(
			$level,
			$nameClass.'->'.$nameMethod
		);
	}
}

if(!function_exists('show_errors_app')){
	function show_errors_app($errorMessage){
		return;
	}
}

if(!function_exists('validate_errors_app')){
	function validate_errors_app($errorMessage){
		return;
	}
}


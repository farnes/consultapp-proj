<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Revisa en la sesion si esta loggeado
if(!function_exists('validateSession')){
	//No esta en uso
	function validateSession(){
		log_message('error', 'Iniciando Helper funcion validateSession()');
		$CI =& get_instance();
		//$session = isset($CI->session->userdata('logged_in')); 
		//log_message('error', 'Sesion logged_in:'.$session);
		if($session===FALSE){
			log_message('error', 'redirect to login_view');
			header("Location: loggin");
		}
		log_message('error', 'session '.$session);
		//Fijarse si hay un metodo getUserData para saber si esta loggeado creo q por ahi viene el error
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


<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Revisa en la sesion si esta loggeado
if(!function_exists('validateSession')){
	function validateSession(){
		log_message(LEVEL_DEBUG, 'Iniciando Helper funcion validateSession()');
		$CI =& get_instance();
		if(!$CI->session->userdata(INFO_SESSION_LOGGIN_IN)){
			log_message(LEVEL_DEBUG, 'sesion expirada o no esta logueado');
			redirect('/login_controller/loggin', 'refresh');
		}
	}
}

if(!function_exists('is_null_or_empty')){
	function is_null_or_empty($question){
		return (!isset($question) || trim($question)==='');
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

if(!function_exists('is_less_than_current')){
	function is_less_than_current($date){		
		return strtotime('now')>strtotime(str_replace('/', '-', $date));			
	}
}

if(!function_exists('is_valid_date')){
	function is_valid_date($date){		
		$dateArray =  explode('/', $date);
		return checkdate($dateArray[1],$dateArray[0],$dateArray[2]);
	}
}

if(!function_exists('var_value')){
	function var_value($valueToControl){
		return isset($valueToControl)?$valueToControl:'';
	}
}

if(!function_exists('date_format_for_db')){
	function date_format_for_db($input_date){
		$dateArray =  explode('/', $input_date);
		return $dateArray[2].'-'.$dateArray[1].'-'.$dateArray[0];
	}
}

if(!function_exists('date_format_for_app')){
	function date_format_for_app($input_date){
		$dateArray =  explode('-', $input_date);
		return $dateArray[2].'/'.$dateArray[1].'/'.$dateArray[0];
	}
}





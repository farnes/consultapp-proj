<?php
class User_Model extends CI_Model {

	public function __construct(){
		// Call the Model constructor
		parent::__construct();
	}
	
	/*
	 * Method: isUserExist
	 * Params: user/mail and password
	 * Description: se fija si existe el usuario/clave de ser asi devuelve
	 * verdadero y en caso contrario un falso	  
	 */
	
	public function isUserExist($user,$pass){

		$this->db->select('user_pk');
		$this->db->from('t_user');
		$this->db->where('email_vc', $user);
		$this->db->where('password_vc', $pass);
		$result = $this->db->get();

		if($result->num_rows()==1){
			return TRUE;
		}
		return FALSE;
	}
}
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

		$filter = array(
			USER_TABLE_FIELD_NAME => $user,
			USER_TABLE_FIELD_PASS => $pass
		);		
		
		$query = $this->db
			->select(USER_TABLE_FIELD_USER_PK)
			->from(USER_TABLE)
			->where($filter)
		->get();		
			
		if($query->num_rows()==1){
			return TRUE;
		}
		return FALSE;
	}
	
	public function getUserById($id){
		/* TODO:
		 * debe traer los datos por Id
		 * */ 
		return FALSE;
	}
}
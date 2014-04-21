<?php
class User_Model extends CI_Model {
	
	public function __construct(){
		// Call the Model constructor
		parent::__construct();
	}
	
	/*
	 * Method: getIdByUserPass
	 * Params: user and password
	 * Description: se fija si existe el usuario/clave de ser asi devuelve
	 * el campo user_pk y en caso contrario un FALSE	  
	 */
	
	public function getIdByUserPass($user,$pass){

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
			return $query->row()->user_pk;
		}
		return FALSE;
	}
	
	public function getUserById($id){
		
		$filter = array(
			USER_TABLE_FIELD_USER_PK => $id
		);		
		
		$query = $this->db
			->select()
			->from(USER_TABLE)
			->where($filter)
		->get();		
				
		return $query->row();	
	}
}
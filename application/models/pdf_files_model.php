<?php
class Pdf_Files_Model extends CI_Model {

	public function __construct(){
		// Call the Model constructor
		parent::__construct();
	}
	
	public function insertNewPdfFileData($dataFileUpload,$dataInserted){
		$newRow = array(
				PDF_TABLE_CODE_FIELD => $dataInserted->code,
				PDF_TABLE_NAME_FIELD => $dataInserted->name,			
				PDF_TABLE_PDF_DATE_FIELD => $dataInserted->date,
				PDF_TABLE_FULL_PATH_FIELD => $dataFileUpload->full_path,
				PDF_TABLE_ORIG_NAME_FIELD => $dataFileUpload->client_name,
				PDF_TABLE_LOAD_DATE_FIELD => date('Y-m-d H:i:s') 
		);
		$this->db->insert(PDF_TABLE,$newRow);
	}
	
	public function getPdfFilesData(){
		$query = $this->db
			->select()
			->from(PDF_TABLE)
		->get();	
		return $query->result();
	}
	
	public function getPdfFilesDataById($id){
		$filter = array(
				PDF_TABLE_PDF_FILES_PK_FIELD => $id
		);
		$query = $this->db
			->select()
			->from(PDF_TABLE)
			->where($filter)
		->get();
		return $query->row();
	}
}

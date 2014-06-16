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
				PDF_TABLE_FULL_PATH_FIELD => $dataFileUpload->orig_name,
				PDF_TABLE_ORIG_NAME_FIELD => $dataFileUpload->client_name,
				PDF_TABLE_LOAD_DATE_FIELD => date('Y-m-d H:i:s') 
		);
		$this->db->insert(PDF_TABLE,$newRow);
	}
	
	public function getPdfFilesData($data){
		
		$filter = array();		
		if(!is_null_or_empty($data->code))$filter[PDF_TABLE_CODE_FIELD]=$data->code;
		if(!is_null_or_empty($data->name))$filter[PDF_TABLE_NAME_FIELD]=$data->name;		
		if(!is_null_or_empty($data->startDate))$filter[PDF_TABLE_PDF_DATE_FIELD.' >=']=date_format_for_db($data->startDate);
		if(!is_null_or_empty($data->endDate))$filter[PDF_TABLE_PDF_DATE_FIELD.' <=']=date_format_for_db($data->endDate);
		
		$query = $this->db
			->select()
			->from(PDF_TABLE)
			->where($filter)
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
	
	public function updatePdfFileData($dataForUpdate){
		$data = array(
				PDF_TABLE_CODE_FIELD => $dataForUpdate->code,
				PDF_TABLE_NAME_FIELD => $dataForUpdate->name,
				PDF_TABLE_PDF_DATE_FIELD => $dataForUpdate->date,
				PDF_TABLE_FULL_PATH_FIELD => $dataForUpdate->full_path
		);
		$this->db->where(PDF_TABLE_PDF_FILES_PK_FIELD, $dataForUpdate->id_pdf_file);
		$this->db->update(PDF_TABLE, $data);
	}
}

<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Designation_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
    public function getDesiTable($param){
		$arOrder = array('','designation');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('designation', $searchValue); 
		}
        $this->db->where("desig_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_designation');
		$this->db->order_by('desig_id', 'DESC');
		// $this->db->where('desig_id <>', 1);
		// $this->db->where('desig_id <>', 2);
		// $this->db->where('desig_id <>', 3);
		// $this->db->where('desig_id <>', 4);
		// $this->db->where('desig_id <>', 5);
		// $this->db->where('desig_id <>', 6);
        $query = $this->db->get();
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getDesiTotalCount($param);
        $data['recordsFiltered'] = $this->getDesiTotalCount($param);
        return $data;

	}

	public function getDesiTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('designation', $searchValue); 
        }
		$this->db->select('*');
		$this->db->from('tbl_designation');
		$this->db->order_by('desig_id', 'DESC');
        $this->db->where("desig_status",1);
		// $this->db->where('desig_id <>', 1);
		// $this->db->where('desig_id <>', 2);
		// $this->db->where('desig_id <>', 3);
		// $this->db->where('desig_id <>', 4);
		// $this->db->where('desig_id <>', 5);
		// $this->db->where('desig_id <>', 6);
        $query = $this->db->get();
    	return $query->num_rows();
    }
	



	public function checkUser($designation) {

		$this->db->where('designation', $designation);
	
		$query = $this->db->get('tbl_designation');
	
		$count_row = $query->num_rows();
	
		if ($count_row > 0) {
		  //if count row return any row; that means you have already this email address in the database. so you must set false in this sense.
			return FALSE; // here I change TRUE to false.
		 } else {
		  // doesn't return any row means database doesn't have this email
			return TRUE; // And here false to TRUE
		 }
	}
	
}
?>
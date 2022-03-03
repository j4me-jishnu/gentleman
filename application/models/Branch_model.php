<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Branch_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
    public function getBranchTable($param){
		$arOrder = array('','branch_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('branch_name', $searchValue); 
        }
        $this->db->where("branch_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_branch');
		$this->db->order_by('branch_id', 'DESC');
        $query = $this->db->get();
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getBranchTotalCount($param);
        $data['recordsFiltered'] = $this->getBranchTotalCount($param);
        return $data;

	}

	public function getBranchTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('branch_name', $searchValue); 
        }
		$this->db->select('*');
		$this->db->from('tbl_branch');
		$this->db->order_by('branch_id', 'DESC');
        $this->db->where("branch_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
    
    public function getBranchTable2($param){
		$arOrder = array('','branch_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('branch_name', $searchValue); 
        }
        $this->db->where("branch_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('ntbl_branches');
		$this->db->order_by('branch_id', 'DESC');
        $query = $this->db->get();
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getBranch2TotalCount($param);
        $data['recordsFiltered'] = $this->getBranch2TotalCount($param);
        return $data;

	}

	public function getBranch2TotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('branch_name', $searchValue); 
        }
		$this->db->select('*');
		$this->db->from('ntbl_branches');
		$this->db->order_by('branch_id', 'DESC');
        $this->db->where("branch_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }    
	
}
?>
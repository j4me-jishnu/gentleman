<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Employee_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
    public function getBranchTable($param){
		$arOrder = array('','emp_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('emp_name', $searchValue);
        }
        $this->db->where("emp_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_employee');
		$this->db->order_by('emp_id', 'DESC');
        $query = $this->db->get();
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getBranchTotalCount($param);
        $data['recordsFiltered'] = $this->getBranchTotalCount($param);
        return $data;

	}

	public function getBranchTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('emp_name', $searchValue);
        }
		$this->db->select('*');
		$this->db->from('tbl_employee');
		$this->db->order_by('emp_id', 'DESC');
        $this->db->where("emp_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }

}
?>

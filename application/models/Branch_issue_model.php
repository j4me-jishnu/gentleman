<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Branch_issue_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
	public function getbranchCrTable($param){
		$arOrder = array('','searchValue','user_branch','start_date','end_date');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		$user_branch =(isset($param['user_branch']))?$param['user_branch']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
		$end_date =(isset($param['end_date']))?$param['end_date']:'';
		if($searchValue){ 

         $this->db->like('item_name', $searchValue);
        $this->db->or_like('username', $searchValue); 
          
        }
        if($user_branch){
            $this->db->where('branch_id_fk', $user_branch); 
        }
		if($start_date){
            $this->db->where('issue_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('issue_date <=', $end_date); 
        }
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
        $this->db->from('tbl_issueitem');
        $this->db->join('tbl_branch', 'tbl_issueitem.branch_id_fk = tbl_branch.branch_id');
        $this->db->join('tbl_item', 'tbl_issueitem.item_id_fk = tbl_item.item_id');
        $this->db->join('tbl_user', 'tbl_user.user_id = tbl_issueitem.user_id_fk');
        $query = $this->db->get();
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getbranchCrTotalCount($param);
        $data['recordsFiltered'] = $this->getbranchCrTotalCount($param);
        return $data;

	}
	public function getbranchCrTotalCount($param = NULL){
		
		$arOrder = array('','searchValue','user_branch','start_date','end_date');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		$user_branch =(isset($param['user_branch']))?$param['user_branch']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
		$end_date =(isset($param['end_date']))?$param['end_date']:'';
		if($searchValue){ 

        $this->db->where("(item_name LIKE '%".$searchValue."%')", NULL, FALSE);
          
        }
        if($user_branch){
            $this->db->where('branch_id_fk', $user_branch); 
        }
        if($start_date){
            $this->db->where('issue_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('issue_date <=', $end_date); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }
        $this->db->select('*');
        $this->db->from('tbl_issueitem');
        $this->db->join('tbl_branch', 'tbl_issueitem.branch_id_fk = tbl_branch.branch_id');
        $this->db->join('tbl_item', 'tbl_issueitem.item_id_fk = tbl_item.item_id');
        $query = $this->db->get();
    	return $query->num_rows();
    }
}
?>
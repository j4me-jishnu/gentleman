<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mutual_branch_transfer_model extends CI_Model{

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

        $this->db->where("(item_name LIKE '%".$searchValue."%')", NULL, FALSE);
          
        }
		if($start_date){
            $this->db->where('issue_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('issue_date <=', $end_date); 
        }
		 $sql = "select *,b1.id as newid,b1.status as newstatus,b2.branch_name as from_branch,b2.branch_id ,b3.branch_name as to_branch,b3.branch_id from tbl_branch_to_branch b1 join tbl_branch b2 on b2.branch_id = b1.from_branch_id_fk join tbl_branch b3 on b3.branch_id = b1.to_branch_id_fk join tbl_item on tbl_item.item_id = b1.item_id_fk where b1.status=1";
        $query = $this->db->query($sql);
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
       $sql = "select *,b1.id as newid,b1.status as newstatus,b2.branch_name as from_branch,b2.branch_id ,b3.branch_name as to_branch,b3.branch_id from tbl_branch_to_branch b1 join tbl_branch b2 on b2.branch_id = b1.from_branch_id_fk join tbl_branch b3 on b3.branch_id = b1.to_branch_id_fk join tbl_item on tbl_item.item_id = b1.item_id_fk where b1.status=1";
        $query = $this->db->query($sql);
        $data['data'] = $query->result();
    	return $query->num_rows();
    }
}
?>
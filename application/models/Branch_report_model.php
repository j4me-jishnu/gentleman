<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Branch_report_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
	public function getbranchCrTable($param,$shop_id){
       
		$arOrder = array('','searchValue','user_branch','start_date','end_date');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		$user_branch =(isset($param['user_branch']))?$param['user_branch']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
		$end_date =(isset($param['end_date']))?$param['end_date']:'';
		if($searchValue){ 

        $this->db->where("(item_name LIKE '%".$searchValue."%')", NULL, FALSE);
          
        }
		if($start_date){
            $this->db->where('updated_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('updated_date <=', $end_date); 
        }
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_shopstock');
		$this->db->join('tbl_branch', 'tbl_shopstock.shop_id_fk = tbl_branch.branch_id');
		$this->db->join('tbl_item', 'tbl_shopstock.item_id_fk = tbl_item.item_id');
         $this->db->where('shop_id_fk', $shop_id);
        $query = $this->db->get();
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getbranchCrTotalCount($param,$shop_id);
        $data['recordsFiltered'] = $this->getbranchCrTotalCount($param,$shop_id);
        return $data;

	}
	public function getbranchCrTotalCount($param = NULL,$shop_id){
		
		$arOrder = array('','searchValue','user_branch','start_date','end_date');
        $searchValue =($param['searchValue'])?$param['searchValue']:'';
        $user_branch =(isset($param['user_branch']))?$param['user_branch']:'';
        $start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
        if($searchValue){ 

        $this->db->where("(item_name LIKE '%".$searchValue."%')", NULL, FALSE);
          
        }
        if($start_date){
            $this->db->where('updated_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('updated_date <=', $end_date); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }
        $this->db->select('*');
        $this->db->from('tbl_shopstock');
        $this->db->join('tbl_branch', 'tbl_shopstock.shop_id_fk = tbl_branch.branch_id');
        $this->db->join('tbl_item', 'tbl_shopstock.item_id_fk = tbl_item.item_id');
         $this->db->where('shop_id_fk', $shop_id);
        $query = $this->db->get();
    	return $query->num_rows();
    }
}
?>
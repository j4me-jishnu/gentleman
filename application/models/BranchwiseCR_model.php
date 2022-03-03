<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class BranchwiseCR_model extends CI_Model{

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
        if($user_branch){
            $this->db->where('shop_id_fk', $user_branch); 
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
		$this->db->from('tbl_branch_stock');
		$this->db->join('tbl_branch', 'tbl_branch_stock.shop_id_fk = tbl_branch.branch_id');
		$this->db->join('tbl_item', 'tbl_branch_stock.item_id_fk = tbl_item.item_id');
        $this->db->where('tbl_branch_stock.reject',0);
        $this->db->where('tbl_branch_stock.delivery',1);
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
            $this->db->where('shop_id_fk', $user_branch); 
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
        $this->db->from('tbl_branch_stock');
        $this->db->join('tbl_branch', 'tbl_branch_stock.shop_id_fk = tbl_branch.branch_id');
        $this->db->join('tbl_item', 'tbl_branch_stock.item_id_fk = tbl_item.item_id');
        $this->db->where('tbl_branch_stock.reject',0);
        $this->db->where('tbl_branch_stock.delivery',1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
}
?>
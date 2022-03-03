<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Purchase_report_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
	public function getTable($param){
		$arOrder = array('','searchValue','start_date','end_date');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
		$end_date =(isset($param['end_date']))?$param['end_date']:'';
		if($searchValue){ 

        $this->db->where("(item_name LIKE '%".$searchValue."%' OR vendorname LIKE '%".$searchValue."%')", NULL, FALSE);
          
        }
		if($start_date){
            $this->db->where('item_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('item_date <=', $end_date); 
        }
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
        $this->db->select('*');
		$this->db->from('tbl_apurchase');
		$this->db->join('tbl_vendor','tbl_vendor.vendor_id = tbl_apurchase.vendor_id_fk');
		$this->db->where("delivery",0);
		$this->db->where("finaldelivery",0);
		$this->db->order_by('pr_id', 'DESC');
		$this->db->where('pr_status',1);
		$query = $this->db->get();
		//print_r($this->db->last_query());
        //exit();
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getbranchCrTotalCount($param);
        $data['recordsFiltered'] = $this->getbranchCrTotalCount($param);
        return $data;

	}
	public function getbranchCrTotalCount($param = NULL){
		
		$arOrder = array('','searchValue','start_date','end_date');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
		$end_date =(isset($param['end_date']))?$param['end_date']:'';
		if($searchValue){
        $this->db->like('item_name', $searchValue); 
        $this->db->or_like('vendorname ', $searchValue); 
            
        }
        $this->db->where("delivery",0);
		$this->db->where("finaldelivery",0);
		if($start_date){
            $this->db->where('item_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('item_date <=', $end_date); 
        }
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }

        $this->db->select('*');
		$this->db->from('tbl_apurchase');
		$this->db->join('tbl_vendor','tbl_vendor.vendor_id = tbl_apurchase.vendor_id_fk');
		$this->db->order_by('pr_id', 'DESC');
		$this->db->where("delivery",0);
		$this->db->where("finaldelivery",0);
		$this->db->where('pr_status',1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
}
?>
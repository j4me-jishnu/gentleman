<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Scrap_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
		public function getScraptable($param){
			$arOrder = array('','item_name','idate','fdate');
			$item_name =(isset($param['item_name']))?$param['item_name']:'';
			$idate =(isset($param['idate']))?$param['idate']:'';
			$fdate =(isset($param['fdate']))?$param['fdate']:'';
			if($item_name){
				$this->db->like('item_name', $item_name);
			}
			if($idate && $fdate){
				$this->db->where('return_date >=', $idate);
				$this->db->where('return_date <=', $fdate);
			}
			$this->db->where("status",1);
			if ($param['start'] != 'false' and $param['length'] != 'false') {
				$this->db->limit($param['length'],$param['start']);
			}
			$this->db->select('*');
			$this->db->from('tbl_scrap');
			$this->db->join('tbl_item', 'tbl_item.item_id = tbl_scrap.item_id_fk');
			$this->db->join('tbl_branch', 'tbl_branch.branch_id = tbl_scrap.branch_id_fk');
			$this->db->order_by('scrap_id', 'DESC');
			$query = $this->db->get();
			$data['data'] = $query->result();
			$data['recordsTotal'] = $this->getUsersTotalCount($param);
			$data['recordsFiltered'] = $this->getUsersTotalCount($param);
			return $data;

		}

	public function getUsersTotalCount($param = NULL){

		$arOrder = array('','item_name','idate','fdate');
        $item_name =(isset($param['item_name']))?$param['item_name']:'';
        $idate =(isset($param['idate']))?$param['idate']:'';
        $fdate =(isset($param['fdate']))?$param['fdate']:'';
        if($item_name){
            $this->db->like('item_name', $item_name);
        }
        if($idate && $fdate){
            $this->db->where('return_date >=', $idate);
            $this->db->where('return_date <=', $fdate);
        }
        $this->db->where("status",1);
        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }
        $this->db->select('*');
        $this->db->from('tbl_scrap');
        $this->db->join('tbl_item', 'tbl_item.item_id = tbl_scrap.item_id_fk');
        $this->db->join('tbl_branch', 'tbl_branch.branch_id = tbl_scrap.branch_id_fk');
        $this->db->order_by('scrap_id', 'DESC');
        $query = $this->db->get();
    	return $query->num_rows();
    }
}
?>

<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Item_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
    public function getItemTable($param){
		$arOrder = array('','item_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('item_name', $searchValue); 
        }
        $this->db->where("item_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_item');
		$this->db->join('tbl_category', 'tbl_category.category_id = tbl_item.category_id_fk');
		$this->db->order_by('item_name', 'ASC');
        $query = $this->db->get();
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getItemTotalCount($param);
        $data['recordsFiltered'] = $this->getItemTotalCount($param);
        return $data;

	}

	public function getItemTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
		$this->db->like('item_name', $searchValue); 
        }
		$this->db->select('*');
		$this->db->from('tbl_item');
		$this->db->join('tbl_category', 'tbl_category.category_id = tbl_item.category_id_fk');
		$this->db->order_by('item_id', 'DESC');
        $query = $this->db->get();
    	return $query->num_rows();
    }
	public function get_category()
	{
		$this->db->select('*');
		$this->db->from('tbl_category');
		$this->db->where('category_status',1);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_item_rop($item)
	{
		$this->db->select('item_rop');
		$this->db->from('tbl_rop');
		$this->db->where('item_id_fk',$item);
		$this->db->where('status',1);
		$query = $this->db->get();
		return $query->row();
	}
	public function get_rop_details($item_id,$branch)
	{
		$this->db->select('*');
		$this->db->from('tbl_rop');
		$this->db->where('item_id_fk',$item_id);
		$this->db->where('branch_id_fk',$branch);
		$this->db->where('status',1);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	function get_itemprice($item_id){
	
     $this->db->select('*');
	 $this->db->from('tbl_itemprice');
	 $this->db->where('item_id_fk',$item_id);
	 $query = $this->db->get();
	 
	 
	 return $query->result();
	
	}
}
?>

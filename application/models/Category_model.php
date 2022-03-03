<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
    public function getCateTable($param){
		$arOrder = array('','category_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('category_name', $searchValue); 
        }
        $this->db->where("category_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_category');
		$this->db->order_by('category_id', 'DESC');
        $query = $this->db->get();
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getCateTotalCount($param);
        $data['recordsFiltered'] = $this->getCateTotalCount($param);
        return $data;

	}

	public function getCateTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('category_name', $searchValue); 
        }
		$this->db->select('*');
		$this->db->from('tbl_category');
		$this->db->order_by('category_id', 'DESC');
        $this->db->where("category_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
	
}
?>
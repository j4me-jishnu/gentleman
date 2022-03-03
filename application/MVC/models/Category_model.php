<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
    public function getCategoryTable($param){
		$arOrder = array('','category_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('category_name', $searchValue); 
        }
        $this->db->where("category_status",1);

        // if ($param['order'] != 'false' and $param['dir'] != 'false') {
            // $order_field = $arOrder[$param['order']];
            // $this->db->order_by($order_field,$param['dir']);
        // }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('category');
		$this->db->order_by('category_id', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();
		//exit();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getCategoryTotalCount($param);
        $data['recordsFiltered'] = $this->getCategoryTotalCount($param);
        return $data;

	}

	public function getCategoryTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('category_name', $searchValue); 
        }
		$this->db->select('*');
		$this->db->from('category');
        $this->db->where("category_status",1);
		$this->db->order_by('category_id', 'DESC');
        $query = $this->db->get();
    	return $query->num_rows();
    }
	public function view_by()
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('category');
		$this->db->where('category_status', $status);
		$query = $this->db->get();
		
		$category_names = array();
		if ($query -> result()) {
		foreach ($query->result() as $category_name) {
		$category_names[$category_name-> category_id] = $category_name -> category_name;
			}
		return $category_names;
		} else {
		return FALSE;
		}
		}
		public function view_byname()
		{
		$status=1;
		$this->db->select('*');
		$this->db->from('category');
		$this->db->where('category_status', $status);
		$query = $this->db->get();
		return $query->result();
		}
    public function getlast($insert_id)
    {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('category_id', $insert_id);
        $query = $this->db->get();
        return $query->result();
    }            
		
}
?>
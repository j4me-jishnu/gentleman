<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Color_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
    public function getColorTable($param){
		$arOrder = array('','color_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('color_name', $searchValue); 
        }
        $this->db->where("color_status",1);

        // if ($param['order'] != 'false' and $param['dir'] != 'false') {
            // $order_field = $arOrder[$param['order']];
            // $this->db->order_by($order_field,$param['dir']);
        // }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('color_details');
		$this->db->order_by('color_id', 'DESC');
        $query = $this->db->get();
		
        //echo $this->db->last_query();
		//exit();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getColorTotalCount($param);
        $data['recordsFiltered'] = $this->getColorTotalCount($param);
        return $data;

	}

	public function getColorTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('color_name', $searchValue); 
        }
		$this->db->select('*');
		$this->db->from('color_details');
		$this->db->order_by('color_id', 'DESC');
        $this->db->where("color_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
	public function view_by()
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('color_details');
		$this->db->where('color_status', $status);
		$query = $this->db->get();
		return $query->result();
	}
    public function getlast($insert_id)
    {
        $this->db->select('*');
        $this->db->from('color_details');
        $this->db->where('color_id', $insert_id);
        $query = $this->db->get();
        return $query->result();
    }
}
?>
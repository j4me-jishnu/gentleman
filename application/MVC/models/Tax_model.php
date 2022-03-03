<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tax_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
    public function getTax($param){
		$arOrder = array('','tax_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
                $login_id =($param['user_id'])?$param['user_id']:'';
        if($searchValue){
            $this->db->like('tax_name', $searchValue); 
        }
        $this->db->where("tax_status",1);
        $this->db->where("id",$login_id);

        // if ($param['order'] != 'false' and $param['dir'] != 'false') {
            // $order_field = $arOrder[$param['order']];
            // $this->db->order_by($order_field,$param['dir']);
        // }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tax_class');
                $this->db->from('admin_login');
		$this->db->order_by('tax_id', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();
		//exit();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getemploteeTotalCount($param);
        $data['recordsFiltered'] = $this->getemploteeTotalCount($param);
        return $data;

	}

	public function getemploteeTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('tax_name', $searchValue); 
        }
		$this->db->select('*');
		$this->db->from('tax_class');
        $this->db->where("tax_status",1);
		$this->db->order_by('tax_id', 'DESC');
        $query = $this->db->get();
    	return $query->num_rows();
    }
	
}
?>
<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Enquiry_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
    public function getEnquiryTable($param){
		$arOrder = array('','customer_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('customer_name', $searchValue); 
        }
        $this->db->where("status",1);

        if ($param['order'] != 'false' and $param['dir'] != 'false') {
            $order_field = $arOrder[$param['order']];
            $this->db->order_by($order_field,$param['dir']);
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }

        $this->db->select('*,DATE_FORMAT(date,\'%d-%m-%Y\') as date');
        $this->db->from('enquiry');
        $this->db->join('customer', 'enquiry.customer_id_fk = customer.customer_id');
        $query = $this->db->get();
        // echo $this->db->last_query();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getEnquiryTotalCount($param);
        $data['recordsFiltered'] = $this->getEnquiryTotalCount($param);
        return $data;

	}

	public function getEnquiryTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('customer_name', $searchValue); 
        }
        $this->db->where("status",1);
        $this->db->select('enquiry_id');
        $this->db->from('enquiry');
        $this->db->join('customer', 'enquiry.customer_id_fk = customer.customer_id');
        $query = $this->db->get();
    	return $query->num_rows();
    }
}
?>
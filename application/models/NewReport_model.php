<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class NewReport_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function getCount($param)
    {
        $last_query = $param['lastquery'];
        return $this->db->query($last_query)->num_rows();
    }

    public function getPurchaseReportList($param)
    {
        $arOrder = array('','searchValue','start_date','end_date');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
		$end_date =(isset($param['end_date']))?$param['end_date']:'';
		if($searchValue){ 

        $this->db->like('vendor_name',$searchValue);
        $this->db->or_like('item_name',$searchValue);
          
        }
		if($start_date){
            $this->db->where('purchase_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('purchase_date <=', $end_date); 
        }
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }

        $this->db->select('*');
        $this->db->join('ntbl_vendor','ntbl_vendor.vendor_id=ntbl_purchase.purchase_vendor_id_fk');
        $this->db->join('ntbl_items','ntbl_items.item_id=ntbl_purchase.purchase_item_id_fk');
        $this->db->from('ntbl_purchase');
        $this->db->where('purchase_status',1);
        $query = $this->db->get();
        $param['lastquery'] = $this->db->last_query();
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getCount($param);
        $data['recordsFiltered'] = $this->getCount($param);
        return $data;
    }

}

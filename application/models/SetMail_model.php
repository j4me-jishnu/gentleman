<?php
Class SetMail_model extends CI_Model{

	public function getTable($param){
		$arOrder = array('','vendorname');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		$this->db->select('*');
		$this->db->from('tbl_email');
        $query = $this->db->get();
        $data['data'] = $query->result();
        // $data['recordsTotal'] = $this->getVendorTotalCount($param);
        // $data['recordsFiltered'] = $this->getVendorTotalCount($param);
        return $data;

	}

	public function getVendorDetails($vendor_id)
	{

		$this->db->select('*');
		$this->db->where('vendor_id',$vendor_id);
		$this->db->from('tbl_vendor');
        $query = $this->db->get();
        $data['data'] = $query->result();
        return $data;
	}

	public function getVendorPayment()
	{

		$sql= "SELECT COALESCE(t2.vendor_id,0) as vendor_id_fk,COALESCE(SUM(t1.grand_total),0) as total from (SELECT vendor_id_fk,grand_total from tbl_apurchase WHERE delivery = 0 and finaldelivery = 0 )t1 RIGHT JOIN (SELECT vendor_id FROM tbl_vendor) t2 on t1.vendor_id_fk = t2.vendor_id GROUP BY t2.vendor_id";
		$query = $this->db->query($sql);
		$data['data'] = $query->result();
		return $data;

	}
	public function getVendorTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('vendorname', $searchValue); 
        }
		$this->db->select('*');
		$this->db->from('tbl_vendor');
		$this->db->order_by('vendor_id', 'DESC');
        $this->db->where("vendorstatus",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
	public function view_by()
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_vendor');
		$this->db->where('vendorstatus', $status);
		$this->db->order_by('vendorname');
		$query = $this->db->get();
		
		$vendor_names = array();
		if ($query -> result()) {
		foreach ($query->result() as $vendor_name) {
		$vendor_names[$vendor_name-> vendor_id] = $vendor_name -> vendorname;
			}
		return $vendor_names;
		} else {
		return FALSE;
		}
	}

	public function getPurchase($param,$id)
	{
		$arOrder = array('','vendorname');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('tbl_vendor.vendorname', $searchValue); 
        }
        $this->db->where("tbl_vendor.vendorstatus",1);
		
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_apurchase');
		$this->db->join('tbl_vendor','tbl_vendor.vendor_id = tbl_apurchase.vendor_id_fk');
		$this->db->order_by('pr_id', 'DESC');
		$this->db->where("vendor_id_fk",$id);
		$this->db->where("delivery",0);
		$this->db->where("finaldelivery",0);
		
        $query = $this->db->get();
		
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getVendorPurchase($param,$id);
        $data['recordsFiltered'] = $this->getVendorPurchase($param,$id);
        return $data;

	}

		public function getVendorPurchase($param = NULL,$id){

		$arOrder = array('','vendorname');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('tbl_vendor.vendorname', $searchValue); 
        }
        $this->db->where("tbl_vendor.vendorstatus",1);
		
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_apurchase');
		$this->db->join('tbl_vendor','tbl_vendor.vendor_id = tbl_apurchase.vendor_id_fk');
		$this->db->order_by('pr_id', 'DESC');
		$this->db->where("vendor_id_fk",$id);
		$this->db->where("cc",0);
		$this->db->where("brm",0);
		$this->db->where("cm",0);
		$this->db->where("fm",0);
		$this->db->where("agm",0);
		$this->db->where("pm",0);
		$this->db->where("delivery",0);
		$this->db->where("finaldelivery",0);
		
        $query = $this->db->get();
    	return $query->num_rows();
    }
	
}

?>
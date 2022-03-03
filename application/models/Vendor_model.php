<?php
Class Vendor_model extends CI_Model{

	public function getVendorTable($param){
		$arOrder = array('','vendorname');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('vendorname', $searchValue); 
        }
        $this->db->where("vendorstatus",1);
		
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_vendor');
		$this->db->order_by('vendor_id', 'DESC');
        $query = $this->db->get();
		
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getVendorTotalCount($param);
        $data['recordsFiltered'] = $this->getVendorTotalCount($param);
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
	public function getPurchasedetails($vendor_id)
	{
	$this->db->select('*');
	$this->db->from('tbl_apurchase');
	$this->db->join('tbl_vendor','tbl_vendor.vendor_id = tbl_apurchase.vendor_id_fk');
	//$this->db->order_by('pr_id', 'DESC');
	$this->db->where("vendor_id_fk",$vendor_id);
	$this->db->where("delivery",0);
	$this->db->where("finaldelivery",0);
	$query = $this->db->get();
	return $query->result();
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


    public function getpaymentHistory($param,$id)
	{
		$sql = "SELECT t1.vendor_id_fk,t1.date,t1.total_at,t1.payment,t2.vendor_id,t2.paid_amount,t3.total from (SELECT vendor_id_fk,payment,date,total_at from tbl_vendor_payment WHERE vendor_id_fk = $id) t1 JOIN (SELECT vendor_id,paid_amount FROM tbl_vendor WHERE vendor_id =$id) t2 ON t1.vendor_id_fk = t2.vendor_id JOIN (SELECT vendor_id_fk,COALESCE(sum(grand_total),0) as total FROM tbl_apurchase WHERE vendor_id_fk = $id and delivery = 0 and finaldelivery = 0 ) t3 ON t2.vendor_id = t3.vendor_id_fk";
						
        $query = $this->db->query($sql);		
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getPaymentCount($param,$id);
        $data['recordsFiltered'] = $this->getPaymentCount($param,$id);
        return $data;

	}

	 public function getPaymentCount($param,$id)
	{
		$sql = "SELECT t1.vendor_id_fk,t1.date,t1.payment,t2.vendor_id,t3.total from (SELECT vendor_id_fk,payment,date from tbl_vendor_payment WHERE vendor_id_fk = $id) t1 JOIN (SELECT vendor_id FROM tbl_vendor WHERE vendor_id =$id) t2 ON t1.vendor_id_fk = t2.vendor_id JOIN (SELECT vendor_id_fk,COALESCE(sum(grand_total),0) as total FROM tbl_apurchase WHERE vendor_id_fk = $id and delivery = 0 and finaldelivery = 0 ) t3 ON t2.vendor_id = t3.vendor_id_fk";
        $query = $this->db->query($sql);
    	return $query->num_rows();

	}


	function get_amount($pr_id){

	  return $this->db->select('grand_total,amount_paid')->from('tbl_apurchase')->where('pr_id',$pr_id)->get()->result();


	}

	function get_paidamount($vendor_id){

      return $this->db->select('paid_amount')->from('tbl_vendor')->where('vendor_id',$vendor_id)->get()->result();

	}

	
}

?>
<?php
Class Purchase_model extends CI_Model{

    public function getPurchaseReport($param){
        $arOrder = array('','purchase_invoice_no','vendor_name');
        $purchase_invoice_no =(isset($param['purchase_invoice_no']))?$param['purchase_invoice_no']:'';
        $vendor_name =(isset($param['vendor_name']))?$param['vendor_name']:'';
	$start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
        if($purchase_invoice_no){
            $this->db->like('purchase_invoice_no', $purchase_invoice_no); 
        }
        if($vendor_name){
            $this->db->like('vendor_name', $vendor_name); 
        }
        if($start_date){
            $this->db->where('purchase_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('purchase_date <=', $end_date); 
        }
        
        $this->db->where("purchase_status",1);

        // if ($param['order'] != 'false' and $param['dir'] != 'false') {
            // //$order_field = $arOrder[$param['order']];
            // $this->db->order_by($order_field,$param['dir']);
        // }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }
	$this->db->select('*,purchase_id,product_name,product_purchase_quantity,purchase_status,purchase_price,purchase_total_price,DATE_FORMAT(purchase_date,\'%d-%m-%Y\') as purchase_date,count(purchase_id) as purchase_count,sum(purchase_total_price) as pur_totalPrice');
        $this->db->from('purchase_details');
        $this->db->join('vendor', 'purchase_details.vendor_id_fk = vendor.vendor_id');
        $this->db->join('product_details', 'purchase_details.product_id_fk = product_details.product_id');
        $this->db->join('category', 'category.category_id  = product_details.category_id_fk','left');
        $this->db->join('subcategory', 'subcategory.subcategory_id = product_details.subcategory_id_fk','left');
        $this->db->group_by('purchase_invoice_no'); 
        $this->db->order_by('purchase_id', 'DESC');
        $query = $this->db->get();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getPurchaseReportTotalCount($param);
        $data['recordsFiltered'] = $this->getPurchaseReportTotalCount($param);
        return $data;

	}
	public function getPurchaseReportTotalCount($param){
        $purchase_invoice_no =(isset($param['purchase_invoice_no']))?$param['purchase_invoice_no']:'';
        $vendor_name =(isset($param['vendor_name']))?$param['vendor_name']:'';
	$start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
        if($purchase_invoice_no){
            $this->db->like('purchase_invoice_no', $purchase_invoice_no); 
        }
        if($vendor_name){
            $this->db->like('vendor_name', $vendor_name); 
        }
        if($start_date){
            $this->db->where('purchase_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('purchase_date <=', $end_date); 
        }
		$this->db->where("purchase_status",1);
		$this->db->from('purchase_details');
                $this->db->join('vendor', 'purchase_details.vendor_id_fk = vendor.vendor_id');
                $this->db->join('product_details', 'purchase_details.product_id_fk = product_details.product_id');
		$this->db->join('category', 'category.category_id  = product_details.category_id_fk','left');
		$this->db->join('subcategory', 'subcategory.subcategory_id = product_details.subcategory_id_fk','left');
		$this->db->order_by('purchase_id', 'DESC');
                $this->db->group_by('purchase_invoice_no');
		$query = $this->db->get();
    	return $query->num_rows();
    }	
	public function gettotal_purchase()
	{
		$this->db->select('sum(purchase_total_price)as total');
		$this->db->from('purchase_details');
		$this->db->where("purchase_status",1);
        $query = $this->db->get();
    	return $query->result();
		//echo $this->db->last_query();
	}
	public function getpurchase_details()
	{
		$this->db->select('*');
		$this->db->from('purchase_details');
		$this->db->join('product_details', 'purchase_details.product_id_fk = product_details.product_id');
		$this->db->order_by('purchase_id', 'DESC');
		$this->db->limit('10');
		$this->db->where("purchase_status",1);
        $query = $this->db->get();
    	return $query->result();
		//echo $this->db->last_query();
	}
        public function purchaseinvoice()
	{
		$this->db->select('purchase_invoice_no');
		$this->db->from('purchase_details');
		$this->db->order_by('purchase_id', 'DESC');
		$this->db->limit('1');
        $query = $this->db->get();    
        return $query->row();
		//echo $this->db->last_query();
	}
        public function purchase_id()
	{
		$this->db->select('purchase_id');
		$this->db->from('purchase_details');
		$this->db->order_by('purchase_id', 'DESC');
		$this->db->limit('1');
        $query = $this->db->get();    
        return $query->row();
		//echo $this->db->last_query();
	}
        public function getcustomer_count($invoice_number)
	{
		$this->db->select('*');
		
		$this->db->from('purchase_details');
		$this->db->join('product_details', 'purchase_details.product_id_fk = product_details.product_id');
                $this->db->join('category','product_details.category_id_fk = category.category_id');
                $this->db->join('subcategory','product_details.subcategory_id_fk = subcategory.subcategory_id');
                $this->db->join('size','product_details.size_id_fk = size.size_id');
                $this->db->join('color_details','product_details.color_id_fk = color_details.color_id');
		$this->db->where('purchase_invoice_no',$invoice_number);
		$this->db->where("purchase_status",1);
                $query = $this->db->get();
                return $query->result();
		//echo $this->db->last_query();
	}
        public function getcustomer_total($invoice_number)
	{
		$this->db->select('*, sum(purchase_total_price)as total');
		
		$this->db->from('purchase_details');
		$this->db->where('purchase_invoice_no',$invoice_number);
		$this->db->where("purchase_status",1);
        $query = $this->db->get();
    	return $query->result();
		//echo $this->db->last_query();
	}
        public function gettotal($invoice_number)
	{
		$this->db->select('purchase_grandd_total, purchase_invoice_no,tax_id_fk, vendor_id_fk');
		
		$this->db->from('purchase_details');
		$this->db->where('purchase_invoice_no',$invoice_number);
		$this->db->where("purchase_status",1);
                $this->db->limit('1');
        $query = $this->db->get();
    	return $query->result();
		//echo $this->db->last_query();
	}
        public function taxDetails($invoice_number)
	{
		$this->db->select('*');
		
		$this->db->from('purchase_details');
                $this->db->join('tax_class','purchase_details.tax_id_fk = tax_class.tax_id');
                //$this->db->join('vendor','purchase_details.vendor_id_fk = vendor.vendor_id');
		$this->db->where('purchase_invoice_no',$invoice_number);
		$this->db->where("purchase_status",1);
                $this->db->limit('1');
                $query = $this->db->get();
                return $query->result();
		//echo $this->db->last_query();
	}
        public function getvendorData($vendor_id)
	{
		$this->db->select('*');
		
		$this->db->from('vendor');
		$this->db->where('vendor_id',$vendor_id);
		//$this->db->where("purchase_status",1);
                $this->db->limit('1');
        $query = $this->db->get();
    	return $query->result();
		//echo $this->db->last_query();
	}
        public function get_alldata($purchase_invoice_no){
            $this->db->select('*');
            $this->db->from('purchase_details');
            $this->db->join('product_details', 'purchase_details.product_id_fk = product_details.product_id');
            $this->db->join('category','product_details.category_id_fk = category.category_id');
            $this->db->join('subcategory','product_details.subcategory_id_fk = subcategory.subcategory_id');
            $this->db->join('size','product_details.size_id_fk = size.size_id');
            $this->db->join('color_details','product_details.color_id_fk = color_details.color_id');
            $this->db->where('purchase_invoice_no',$purchase_invoice_no);
            $this->db->where("purchase_status",1);
            $query = $this->db->get();
            return $query->result();
        }
        public function GetPurchaseData($purchase_id){
            $this->db->select('*');
            $this->db->from('purchase_details');
            $this->db->join('product_details', 'purchase_details.product_id_fk = product_details.product_id');
            $this->db->join('category','product_details.category_id_fk = category.category_id');
            $this->db->join('subcategory','product_details.subcategory_id_fk = subcategory.subcategory_id');
            $this->db->join('size','product_details.size_id_fk = size.size_id');
            $this->db->join('color_details','product_details.color_id_fk = color_details.color_id');
            $this->db->where('purchase_id',$purchase_id);
            $this->db->where("purchase_status",1);
            $query = $this->db->get();
            return $query->result();
        }
        public function gettaxtype(){
		
		$this->db->select('*');
		
		$this->db->from('tax_class');
		//$this->db->join('product_details', 'sale_details.product_id_fk = product_details.product_id');
		$this->db->where('tax_type',1);
		$this->db->where("tax_status",1);
        $query = $this->db->get();
    	return $query->result();
	}
        public function GettaxData($purchase_invoice_no){
            $this->db->select('tax_id_fk');
            $this->db->from('purchase_details');
            $this->db->where('purchase_invoice_no',$purchase_invoice_no);
            $this->db->where("purchase_status",1);
            $this->db->limit('1');
            $query = $this->db->get();
            return $query->result();
        }
}

?>
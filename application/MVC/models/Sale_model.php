<?php
Class Sale_model extends CI_Model{

	public function getSaleTable($param){
		$arOrder = array('','product_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('product_name', $searchValue); 
        }
        $this->db->where("sale_status",1);

        
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }

        $this->db->select('sale_id,product_name,sale_quantity,sale_status,sale_amount,sale_total_price,sale_discount,DATE_FORMAT(sale_date,\'%d/%m/%Y\') as sale_date');
        $this->db->from('sale_details');
        $this->db->join('product_details', 'sale_details.product_id_fk = product_details.product_id');
        
        $query = $this->db->get();
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getSaleTotalCount($param);
        $data['recordsFiltered'] = $this->getSaleTotalCount($param);
        return $data;

	}

	public function getSaleTotalCount($param){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('product_name', $searchValue); 
        }
        $this->db->where("sale_status",1);
        $this->db->from('sale_details');
        $this->db->join('product_details', 'sale_details.product_id_fk = product_details.product_id');
        //$this->db->join('vendor_details', 'purchase_details.vendor_id_fk = vendor_details.vendor_id');
        $query = $this->db->get();
    	return $query->num_rows();
    }
	public function getsaleid()
	{
		$this->db->select('sale_id');
		$this->db->from('sale_details');
		$this->db->order_by('sale_id', 'DESC');
		$this->db->limit('1');
        $query = $this->db->get();    
        return $query->result();
		//echo $this->db->last_query();
	}
	// public function get_row($table,$primaryfield,$id)
    // {
        // $this->db->where($primaryfield,$id);
		// $this->db->order_by($primaryfield, 'DESC');
		// $this->db->limit('1');
        // $q = $this->db->get($table);
        // if($q->num_rows() > 0)
        // {
            // return $q->row();
        // }
        // return false;
    // }
	public function getcustid()
	{
		$this->db->select('*');
		$this->db->from('sale_details');
		$this->db->where("sale_status",1);
		$this->db->order_by('sale_id', 'DESC');
		$this->db->limit('1');
        $query = $this->db->get();
    	return $query->result();
		//echo $this->db->last_query();
	}
	public function getcustomer_count($customer_details)
	{
		$this->db->select('*');
		
		$this->db->from('sale_details');
		$this->db->join('product_details', 'sale_details.product_id_fk = product_details.product_id');
		$this->db->where('cust_details',$customer_details);
		$this->db->where("sale_status",1);
        $query = $this->db->get();
    	return $query->result();
		//echo $this->db->last_query();
	}
	public function getproductname($product)
	{
		$this->db->select('product_name');
		$this->db->from('product_details');
		$this->db->where('product_id',$product);
		$this->db->where("product_status",1);
		$query = $this->db->get();
    	return $query->result();
	}
	
	public function getcustomer_total($customer_details)
	{
		$this->db->select('*, sum(sale_total_price)as total');
		
		$this->db->from('sale_details');
		$this->db->where('cust_details',$customer_details);
		$this->db->where("sale_status",1);
        $query = $this->db->get();
    	return $query->result();
		//echo $this->db->last_query();
	}
	
	// public function getcustomer_count_edit($sale_id)
	// {
		// $this->db->select('*');
		// $this->db->from('sale_details');
		// $this->db->join('product_details', 'sale_details.product_id_fk = product_details.product_id');
		// $this->db->where('cust_details',$sale_id);
		// $this->db->where("sale_status",1);
        // $query = $this->db->get();
    	// return $query->result();
		// //echo $this->db->last_query();
	// }
	
	public function getSaleReport($param){
        $arOrder = array('','sale_invoice_number','sale_totalPrice');
        $sale_invoice_number =(isset($param['sale_invoice_number']))?$param['sale_invoice_number']:'';
        $sale_totalPrice =(isset($param['sale_totalPrice']))?$param['sale_totalPrice']:'';
        $start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
        if($sale_invoice_number){
            $this->db->like('sale_invoice_number', $sale_invoice_number); 
        }
        if($sale_totalPrice){
            $this->db->like('sale_totalPrice', $sale_totalPrice); 
        }
        if($start_date){
            $this->db->where('sale_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('sale_date <=', $end_date); 
        }
        
        $this->db->where("sale_status",1);

        // if ($param['order'] != 'false' and $param['dir'] != 'false') {
            // //$order_field = $arOrder[$param['order']];
            // $this->db->order_by($order_field,$param['dir']);
        // }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*,DATE_FORMAT(sale_date,\'%d-%m-%Y\') as sale_date,count(sale_id) as sale_count,sum(sale_total_price) as sale_totalPrice');
        $this->db->from('sale_details');
        $this->db->join('product_details', 'sale_details.product_id_fk = product_details.product_id');
        $this->db->join('category', 'category.category_id  = product_details.category_id_fk');
	$this->db->join('subcategory', 'subcategory.subcategory_id = product_details.subcategory_id_fk');
        $this->db->group_by('sale_invoice_number');
        $this->db->order_by('sale_id', 'DESC');
		$query = $this->db->get();
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getSaleReportTotalCount($param);
        $data['recordsFiltered'] = $this->getSaleReportTotalCount($param);
        return $data;

	}
	public function getSaleReportTotalCount($param){
        $sale_invoice_number =(isset($param['sale_invoice_number']))?$param['sale_invoice_number']:'';
        $sale_totalPrice =(isset($param['sale_totalPrice']))?$param['sale_totalPrice']:'';
        $start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
        if($sale_invoice_number){
            $this->db->like('sale_invoice_number', $sale_invoice_number); 
        }
        if($sale_totalPrice){
            $this->db->like('sale_totalPrice', $sale_totalPrice); 
        }
        if($start_date){
            $this->db->where('sale_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('sale_date <=', $end_date); 
        }
		$this->db->select('*,count(sale_id) as sale_count,sum(sale_total_price) as sale_totalPrice');
        $this->db->from('sale_details');
        $this->db->join('product_details', 'sale_details.product_id_fk = product_details.product_id');
        // $this->db->join('product_details', 'sale_details.product_id_fk = product_details.product_id');
        $this->db->join('category', 'category.category_id  = product_details.category_id_fk');
		$this->db->join('subcategory', 'subcategory.subcategory_id = product_details.subcategory_id_fk');
                $this->db->group_by('sale_invoice_number');
		$this->db->order_by('sale_id', 'DESC');
        $query = $this->db->get();
    	return $query->num_rows();
    }	
	public function gettotal_sale()
	{
		$this->db->select('sum(sale_total_price)as total');
		$this->db->from('sale_details');
		$this->db->where("sale_status",1);
        $query = $this->db->get();
    	return $query->result();
		//echo $this->db->last_query();
	}
	public function getsale_details()
	{
		$this->db->select('*');
		$this->db->from('sale_details');
		$this->db->join('product_details', 'sale_details.product_id_fk = product_details.product_id');
		$this->db->order_by('sale_id', 'DESC');
		//$this->db->group_by('product_name');
		$this->db->limit('10');
		$this->db->where("sale_status",1);
        $query = $this->db->get();
    	return $query->result();
		//echo $this->db->last_query();
	}
	public function getunitamount($product_id){
		
		$this->db->select('*');
		$this->db->from('purchase_details');
		$this->db->where("product_id_fk",$product_id);
		$this->db->where("purchase_status",1);
        $query = $this->db->get();
    	return $query->row();
	}
	public function invoice_data($sale_id){
		
		$this->db->select('*');
		
		$this->db->from('sale_details');
		$this->db->join('product_details', 'sale_details.product_id_fk = product_details.product_id');
		$this->db->where('sale_id',$sale_id);
		$this->db->where("sale_status",1);
        $query = $this->db->get();
    	return $query->result();
	}
         public function getinvoice()
	{
		$this->db->select('sale_invoice_number');
		$this->db->from('sale_details');
		$this->db->order_by('sale_id', 'DESC');
		$this->db->limit('1');
        $query = $this->db->get();    
        return $query->row();
		//echo $this->db->last_query();
	}
         public function last_id()
	{
		$this->db->select('sale_id');
		$this->db->from('sale_details');
		$this->db->order_by('sale_id', 'DESC');
		$this->db->limit('1');
        $query = $this->db->get();    
        return $query->row();
		//echo $this->db->last_query();
	}
        public function invoiceDetails($customer_details)
	{
		$this->db->select('sale_invoice_number');
		
		$this->db->from('sale_details');
                //$this->db->join('tax_class','sale_details.tax_id_fk = tax_class.tax_id');
		$this->db->where('cust_details',$customer_details);
		$this->db->where("sale_status",1);
                $this->db->limit('1');
                $query = $this->db->get();
                return $query->result();
		//echo $this->db->last_query();
	}
	public function gettaxtype(){
		
		$this->db->select('*');
		
		$this->db->from('tax_class');
		//$this->db->join('product_details', 'sale_details.product_id_fk = product_details.product_id');
		$this->db->where('tax_type',2);
		$this->db->where("tax_status",1);
        $query = $this->db->get();
    	return $query->result();
	}
	public function gettotal($customer_details)
	{
		$this->db->select('grand_total');
		
		$this->db->from('sale_details');
		$this->db->where('cust_details',$customer_details);
		$this->db->where("sale_status",1);
                $this->db->limit('1');
        $query = $this->db->get();
    	return $query->result();
		//echo $this->db->last_query();
	}
	public function taxDetails($customer_details)
	{
		$this->db->select('*');
		
		$this->db->from('sale_details');
                $this->db->join('tax_class','sale_details.tax_id_fk = tax_class.tax_id');
		$this->db->where('cust_details',$customer_details);
		$this->db->where("sale_status",1);
                $this->db->limit('1');
                $query = $this->db->get();
                return $query->result();
		//echo $this->db->last_query();
	}
        public function getAmount($tax_id)
        {
            $this->db->select('*')->from('tax_class');
            //$this->db->join('product_details','product_id = productid_fk');
           $this->db->like('tax_id',$tax_id);
            $this->db->where('tax_status',1);
            $query = $this->db->get();
            return $query->row();
        }
        
        public function view_data($sale_invoice_number){
                $this->db->select('*');
		
		$this->db->from('sale_details');
		$this->db->join('product_details', 'sale_details.product_id_fk = product_details.product_id');
                $this->db->join('category','product_details.category_id_fk = category.category_id');
                $this->db->join('subcategory','product_details.subcategory_id_fk = subcategory.subcategory_id');
                $this->db->join('size','product_details.size_id_fk = size.size_id');
                $this->db->join('color_details','product_details.color_id_fk = color_details.color_id');
		$this->db->where('sale_invoice_number',$sale_invoice_number);
		$this->db->where("sale_status",1);
                $query = $this->db->get();
                return $query->result();
	}
        public function invoice($cust_details){
            $this->db->select('sale_invoice_number,tax_id_fk');
            $this->db->from('sale_details');
            $this->db->where('cust_details',$cust_details);
            $this->db->where("sale_status",1);
            $this->db->limit('1');
            $query = $this->db->get();
            return $query->row();
        }
        
        public function view_saleTotal($sale_invoice_number){
                $this->db->select('sum(sale_total_price) as sale_total');
		$this->db->from('sale_details');
		$this->db->where('sale_invoice_number',$sale_invoice_number);
		$this->db->where("sale_status",1);
                $query = $this->db->get();
                return $query->result();
	}
        public function view_saleDate($sale_invoice_number){
            $this->db->select('sale_date,tax_id_fk,sale_invoice_number,sale_remarks');
            $this->db->from('sale_details');
            $this->db->where('sale_invoice_number',$sale_invoice_number);
            $this->db->where("sale_status",1);
            $this->db->limit('1');
            $query = $this->db->get();
            return $query->row();
        }
        public function GetSaleData($sale_id){
            $this->db->select('*');
            $this->db->from('sale_details');
            $this->db->join('product_details', 'sale_details.product_id_fk = product_details.product_id');
            $this->db->join('category','product_details.category_id_fk = category.category_id');
            $this->db->join('subcategory','product_details.subcategory_id_fk = subcategory.subcategory_id');
            $this->db->join('size','product_details.size_id_fk = size.size_id');
            $this->db->join('color_details','product_details.color_id_fk = color_details.color_id');
            $this->db->where('sale_id',$sale_id);
            $this->db->where("sale_status",1);
            $query = $this->db->get();
            return $query->result();
        }
    public function GetData($invoice_no){
        $this->db->select('*');
            $this->db->from('sale_details');
            $this->db->where('sale_invoice_number',$invoice_no);
            $this->db->where("sale_status",1);
            $query = $this->db->get();
            return $query->result();
    }

}

?>
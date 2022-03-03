<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ProductDetails_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
    public function getProductTable($param){
		$arOrder = array('','product_name','category_name');
                $product_name =($param['product_name'])?$param['product_name']:'';
                $category_name =($param['category_name'])?$param['category_name']:'';
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
                $login_id =($param['user_id'])?$param['user_id']:'';
        if($searchValue){
            $this->db->like('product_name', $searchValue); 
        }
        if($product_name){
            $this->db->like('product_name', $product_name); 
        }
        if($category_name){
            $this->db->like('category_name', $category_name); 
        }
        $this->db->where("product_status",1);
        $this->db->where("id",$login_id);

        // if ($param['order'] != 'false' and $param['dir'] != 'false') {
            // $order_field = $arOrder[$param['order']];
            // $this->db->order_by($order_field,$param['dir']);
        // }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('product_details');
                 $this->db->from('admin_login');
		$this->db->join('product_category', 'product_details.category_id_fk = product_category.category_id');
                $this->db->join('subcategory', 'product_details.subcategory_id_fk = subcategory.subcategory_id');
		$this->db->order_by('product_id', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();
		//exit();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getproductTotalCount($param);
        $data['recordsFiltered'] = $this->getproductTotalCount($param);
        return $data;

	}

	public function getproductTotalCount($param = NULL){
                $product_name =($param['product_name'])?$param['product_name']:'';
                $category_name =($param['category_name'])?$param['category_name']:'';
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('category_name', $searchValue); 
        }
        if($product_name){
            $this->db->like('product_name', $product_name); 
        }
        if($category_name){
            $this->db->like('category_name', $category_name); 
        }
		$this->db->select('*');
		$this->db->from('product_details');
		$this->db->join('product_category', 'product_details.category_id_fk = product_category.category_id');
                $this->db->join('subcategory', 'product_details.subcategory_id_fk = subcategory.subcategory_id');
        $this->db->where("product_status",1);
		$this->db->order_by('product_id', 'DESC');
        $query = $this->db->get();
    	return $query->num_rows();
    }
	public function getcategory()
	{
		$this->db->select('*');
		$this->db->from('product_category');
        $this->db->where("category_status",1);
		$this->db->order_by('category_id', 'DESC');
        $query = $this->db->get();
		return $query->result();
	}
	
	public function subcategory($category_name = null){
		$this->db->select('subcategory_id, subcategory_name');
 
			if($category_name != NULL){
			$this->db->where('category_id_fk', $category_name);
			$this->db->where("subcategory_status",1);
			
		}
 
		$query = $this->db->get('subcategory');
		
		$subcategory_name = array();
		
 
		if($query->result()){
			foreach ($query->result() as $subcategory_names) {
			$subcategory_name[$subcategory_names->subcategory_id] = $subcategory_names->subcategory_name;
			
			}
			
			return $subcategory_name;
			}
		else{
		return FALSE;
		}
	}
	
    public function lookupcustomer($customer_name){
        $this->db->select('*')->from('customer');
		$this->db->like('customer_name',$customer_name);
		$this->db->where('customer_status',1);
        $query = $this->db->get(); 
        $result =  $query->result_array();
        
        $arData['rows']=$result;
        $arData['records']=$query->num_rows();
        $arData['total']=$query->num_rows();
        return $arData;
    }
	
	public function view_by()
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('product_category');
		$this->db->where('category_status', $status);
		$query = $this->db->get();
		
		$category_names = array();
		if ($query -> result()) {
		foreach ($query->result() as $category_name) {
		$category_names[$category_name->category_id] = $category_name -> category_name;
			}
		return $category_names;
		} else {
		return FALSE;
		}
		}
		
	public function getAvailableStock($product_id)
    {
        $this->db->where('product_id_fk',$product_id);
        $this->db->where('stock_status',1);
        $this->db->select('(purchase_quantity - sale_quantity) AS availableQuantity');
        $this->db->from('stock_details');
        $query = $this->db->get();
        return $query->row();
        
    }
    public function viewsub_by($category_id)
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('subcategory');
		$this->db->where('subcategory_status', $status);
                $this->db->where('category_id_fk',$category_id);
		$query = $this->db->get();
		
		$subcategory_names = array();
		if ($query -> result()) {
		foreach ($query->result() as $subcategory_name) {
		$subcategory_names[$subcategory_name->subcategory_id] = $subcategory_name -> subcategory_name;
			}
		return $subcategory_names;
		} else {
		return FALSE;
		}
		}
	public function getall_data()
	{
		$this->db->select('*');
		$this->db->from('product_details');
                $this->db->join('product_category', 'product_details.category_id_fk = product_category.category_id');
                $this->db->join('subcategory', 'product_details.subcategory_id_fk = subcategory.subcategory_id');
        $this->db->where("product_status",1);
		$this->db->order_by('product_id', 'DESC');
                $this->db->limit('5');
        $query = $this->db->get();
		return $query->result();
	}
        public function getSale_data()
	{
		$this->db->select('*');
		$this->db->from('sale_details');
                $this->db->join('product_details', 'sale_details.product_id_fk = product_details.product_id');
               $this->db->join('product_category', 'product_details.category_id_fk = product_category.category_id');
               $this->db->join('subcategory', 'product_details.subcategory_id_fk = subcategory.subcategory_id');
        $this->db->where("sale_status",1);
		$this->db->order_by('sale_id', 'DESC');
                $this->db->limit('5');
        $query = $this->db->get();
		return $query->result();
	}
        public function getSale_total()
	{
		$this->db->select('count(sale_id)as no_sale,sum(sale_total_price)as total');
		$this->db->from('sale_details');
                $this->db->where("sale_status",1);
                //$this->db->group_by("cust_details");
		//$this->db->order_by('product_id', 'DESC');
                //$this->db->limit('5');
        $query = $this->db->get();
		return $query->result();
	}
         public function getcount_product()
	{
		$this->db->select('count(product_id)as no_product');
		$this->db->from('product_details');
                $this->db->where("product_status",1);
                //$this->db->group_by("cust_details");
		//$this->db->order_by('product_id', 'DESC');
                //$this->db->limit('5');
        $query = $this->db->get();
		return $query->result();
	}
        public function getSaletax_total()
	{
		$this->db->select('count(sale_id)as no_sale,(grand_total)');
		$this->db->from('sale_details');
                $this->db->where("sale_status",1);
                $this->db->group_by("cust_details");
		//$this->db->order_by('product_id', 'DESC');
                //$this->db->limit('5');
        $query = $this->db->get();
		return $query->result();
	}
      
}
?>
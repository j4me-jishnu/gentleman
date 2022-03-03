<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
    public function getProductTable($param){
		$arOrder = array('','product_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('product_name', $searchValue); 
        }
        $this->db->where("product_status",1);

        // if ($param['order'] != 'false' and $param['dir'] != 'false') {
            // $order_field = $arOrder[$param['order']];
            // $this->db->order_by($order_field,$param['dir']);
        // }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('product_details');
		$this->db->join('category','category_id = category_id_fk');
        $query = $this->db->get();
        //echo $this->db->last_query();
		//exit();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getProductTotalCount($param);
        $data['recordsFiltered'] = $this->getProductTotalCount($param);
        return $data;

	}

	public function getProductTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('product_name', $searchValue); 
        }
		$this->db->where("product_status",1);
		$this->db->select('*');
		$this->db->from('product_details');
        $this->db->join('category','category_id = category_id_fk');
        $query = $this->db->get();
    	return $query->num_rows();
    }
	public function getProductReport($param){
        $arOrder = array('','product_name','category_name','subcategory_name','size_name','color_name');
        $product_name =(isset($param['product_name']))?$param['product_name']:'';
        $category_name =(isset($param['category_name']))?$param['category_name']:'';
        $subcategory_name =(isset($param['subcategory_name']))?$param['subcategory_name']:'';
        $size_name =(isset($param['size_name']))?$param['size_name']:'';
        $color_name =(isset($param['color_name']))?$param['color_name']:'';
      
        if($product_name){
            $this->db->like('product_name', $product_name); 
        }
        if($category_name){
            $this->db->like('category_name', $category_name); 
        }
        if($subcategory_name){
            $this->db->like('subcategory_name', $subcategory_name);
        }
		if($size_name){
            $this->db->like('size_name', $size_name);
        }
		if($color_name){
            $this->db->like('color_name', $color_name);
        }
        
        $this->db->where("product_status",1);
		
        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('product_details');
		$this->db->join('category','category_id = category_id_fk');
		$this->db->join('subcategory','subcategory_id = subcategory_id_fk');
		$this->db->join('color_details', 'product_details.color_id_fk = color_details.color_id');
        $this->db->join('size', 'product_details.size_id_fk = size.size_id');
		$this->db->order_by('product_id', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();
		//exit();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getProductReportTotalCount($param);
        $data['recordsFiltered'] = $this->getProductReportTotalCount($param);
        return $data;

	}
	public function getProductReportTotalCount($param){
        $product_name =(isset($param['product_name']))?$param['product_name']:'';
        $category_name =(isset($param['category_name']))?$param['category_name']:'';
        $subcategory_name =(isset($param['subcategory_name']))?$param['subcategory_name']:'';
        $size_name =(isset($param['size_name']))?$param['size_name']:'';
        $color_name =(isset($param['color_name']))?$param['color_name']:'';
		if($product_name){
            $this->db->like('product_name', $product_name); 
        }
        if($category_name){
            $this->db->like('category_name', $category_name); 
        }
        if($subcategory_name){
            $this->db->where('subcategory_name', $subcategory_name);
        }
		if($size_name){
            $this->db->where('size_name', $size_name);
        }
		if($color_name){
            $this->db->where('color_name', $color_name);
        }
		$this->db->where("product_status",1);
		$this->db->select('*');
		$this->db->from('product_details');
		$this->db->join('category','category_id = category_id_fk');
		$this->db->join('subcategory','subcategory_id = subcategory_id_fk');
		$this->db->join('color_details', 'product_details.color_id_fk = color_details.color_id');
        $this->db->join('size', 'product_details.size_id_fk = size.size_id');
		$this->db->order_by('product_id', 'DESC');
        $query = $this->db->get();
		return $query->num_rows();
        //echo $this->db->last_query();
		//exit();

	}	
	public function view_by()
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('product_details');
		$this->db->where('product_status', $status);
		$query = $this->db->get();
		return $query->result();
	}
	public function getcount_product()
	{
		$this->db->select('count(product_id)as total_count');
		$this->db->from('product_details');
		$this->db->where("product_status",1);
        $query = $this->db->get();
    	return $query->result();
		//echo $this->db->last_query();
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

    public function getAvailableProductStock($product_id)
    {
        $this->db->where('product_id',$product_id);
        $this->db->where('product_status',1);
        $this->db->select('SUM(product_purchase_quantity) as quantity');
        $this->db->from('product_details');
        $this->db->join('purchase_details','purchase_details.product_id_fk = product_details.product_id AND purchase_details.purchase_status = 1');
        $this->db->group_by('product_id');
        $query = $this->db->get();
        return $query->row();
        
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
	public function get_row($product_id)
    {
        $this->db->select('*');
		$this->db->from('product_details');
		$this->db->where('product_id', $product_id);
		$this->db->join('category','category_id = category_id_fk');
		$this->db->join('subcategory','subcategory_id = subcategory_id_fk');
		$query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->row();
        }
        return false;
    }
	
}
?>
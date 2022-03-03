<?php
Class Stock_model extends CI_Model{

	public function getStockTable($param){
		$arOrder = array('','product_name','category_name','subcategory_name','size_name','color_name');
                $product_name =($param['product_name'])?$param['product_name']:'';
                $category_name =($param['category_name'])?$param['category_name']:'';
                $subcategory_name =($param['subcategory_name'])?$param['subcategory_name']:'';
                $size_name =($param['size_name'])?$param['size_name']:'';
                $color_name =($param['color_name'])?$param['color_name']:'';
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('product_name', $searchValue); 
        }
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
        $this->db->where("stock_status",1);

        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }

        $this->db->select('*');
        $this->db->from('stock_details');
        $this->db->join('product_details', 'stock_details.product_id_fk = product_details.product_id');
        $this->db->join('category','product_details.category_id_fk = category.category_id');
        $this->db->join('color_details', 'product_details.color_id_fk = color_details.color_id');
        $this->db->join('size', 'product_details.size_id_fk = size.size_id');
        $this->db->join('subcategory', 'product_details.subcategory_id_fk = subcategory.subcategory_id');
        $this->db->order_by('stock_id', 'DESC');
		$query = $this->db->get();
        //echo $this->db->last_query();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getStockTotalCount($param);
        $data['recordsFiltered'] = $this->getStockTotalCount($param);
        return $data;

	}

	public function getStockTotalCount($param){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('product_name', $searchValue); 
        }
        $this->db->where("stock_status",1);
        $this->db->select('*');
        $this->db->from('stock_details');
        $this->db->join('product_details', 'stock_details.product_id_fk = product_details.product_id');
        $this->db->join('color_details', 'product_details.color_id_fk = color_details.color_id');
		$this->db->join('size', 'product_details.size_id_fk = size.size_id');
		$this->db->join('subcategory', 'product_details.subcategory_id_fk = subcategory.subcategory_id');
        $this->db->order_by('stock_id', 'DESC');
		$query = $this->db->get();
    	return $query->num_rows();
    }
	public function getold_stock()
	{
		$this->db->select('stock_id,product_name,purchase_date,purchase_quantity,sale_quantity');
		$this->db->from('stock_details');
		$this->db->join('product_details', 'stock_details.product_id_fk = product_details.product_id');
		$this->db->join('purchase_details', 'stock_details.product_id_fk = purchase_details.product_id_fk');
		$this->db->where('stock_status',1);
		$query = $this->db->get();
    	return $query->result();
	}
	
}

?>
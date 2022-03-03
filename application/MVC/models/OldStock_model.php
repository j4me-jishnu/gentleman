<?php
Class OldStock_model extends CI_Model{

	public function getoldstock($param){
		$arOrder = array('','product_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('product_name', $searchValue); 
        }
        $this->db->where("stock_status",1);

        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }

       $this->db->select('stock_id,product_name,category_name,subcategory_name,color_name,size_name,purchase_quantity,sale_quantity,stock_status,DATE_FORMAT(purchase_date,\'%d-%m-%Y\') as purchase_date');

		$this->db->from('stock_details');
		$this->db->join('product_details', 'stock_details.product_id_fk = product_details.product_id');
		$this->db->join('purchase_details', 'product_details.product_id = purchase_details.product_id_fk');
		$this->db->join('category', 'product_details.category_id_fk = category.category_id');
		$this->db->join('subcategory', 'product_details.subcategory_id_fk = subcategory.subcategory_id');
		$this->db->join('size', 'product_details.size_id_fk = size.size_id');
		$this->db->join('color_details', 'product_details.color_id_fk = color_details.color_id');

		$where_date = "purchase_date < DATE_SUB(now(), INTERVAL 14 DAY)";
		$this->db->where($where_date);

		$where_quantity = "(purchase_quantity - sale_quantity) >= 50";
		
		$this->db->where($where_quantity);

		$this->db->group_by('product_id');
		$this->db->order_by('purchase_date','AESC');
		$this->db->where('stock_status',1);

		$query = $this->db->get();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getoldstockTotalCount($param);
        $data['recordsFiltered'] = $this->getoldstockTotalCount($param);
        return $data;

	}

	public function getoldstockTotalCount($param){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('product_name', $searchValue); 
        }
        $this->db->select('stock_id,product_name,category_name,subcategory_name,color_name,size_name,purchase_quantity,sale_quantity,stock_status,DATE_FORMAT(purchase_date,\'%d-%m-%Y\') as purchase_date');

		$this->db->from('stock_details');
		$this->db->join('product_details', 'stock_details.product_id_fk = product_details.product_id');
		$this->db->join('purchase_details', 'product_details.product_id = purchase_details.product_id_fk');
		$this->db->join('category', 'product_details.category_id_fk = category.category_id');
		$this->db->join('subcategory', 'product_details.subcategory_id_fk = subcategory.subcategory_id');
		$this->db->join('size', 'product_details.size_id_fk = size.size_id');
		$this->db->join('color_details', 'product_details.color_id_fk = color_details.color_id');

		$where_date = "purchase_date < DATE_SUB(now(), INTERVAL 14 DAY)";
		$this->db->where($where_date);

		$where_quantity = "(purchase_quantity - sale_quantity) >= 50";
		$this->db->where($where_quantity);

		$this->db->group_by('product_id');
		$this->db->order_by('purchase_date','AESC');
		$this->db->where('stock_status',1);
		$query = $this->db->get();
    	return $query->num_rows();
    }
	
}

?>
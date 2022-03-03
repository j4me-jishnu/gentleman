<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class SaleReturn_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
    public function getSaleReturnTable($param){
		$arOrder = array('','product_name','invoice_no','return_reason');
                $product_name =($param['product_name'])?$param['product_name']:'';
                $invoice_no =($param['invoice_no'])?$param['invoice_no']:'';
                $return_reason =($param['return_reason'])?$param['return_reason']:'';
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        
        if($searchValue){
            $this->db->like('product_name', $searchValue); 
        }
        
        if($product_name){
            $this->db->like('product_name', $product_name); 
        }
        
        if($invoice_no){
            $this->db->like('invoice_no', $invoice_no); 
        }
        
        if($return_reason){
            $this->db->like('return_reason', $return_reason); 
        }
        
        $this->db->where("return_status",1);

        // if ($param['order'] != 'false' and $param['dir'] != 'false') {
            // $order_field = $arOrder[$param['order']];
            // $this->db->order_by($order_field,$param['dir']);
        // }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*, DATE_FORMAT(return_date,\'%d/%m/%Y\') as date');
		$this->db->from('sale_return');
                $this->db->join('product_details', 'sale_return.product_id_fk = product_details.product_id');
                $this->db->join('category','product_details.category_id_fk = category.category_id');
                $this->db->join('subcategory','product_details.subcategory_id_fk = subcategory.subcategory_id');
                $this->db->join('size','product_details.size_id_fk = size.size_id');
                $this->db->join('color_details','product_details.color_id_fk = color_details.color_id');
		$this->db->order_by('sreturn_id', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();
		//exit();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getpurchaseTotalCount($param);
        $data['recordsFiltered'] = $this->getpurchaseTotalCount($param);
        return $data;

	}

	public function getpurchaseTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
                $product_name =($param['product_name'])?$param['product_name']:'';
                $invoice_no =($param['invoice_no'])?$param['invoice_no']:'';
                $return_reason =($param['return_reason'])?$param['return_reason']:'';
		//$searchValue =($param['searchValue'])?$param['searchValue']:'';
        
        if($searchValue){
            $this->db->like('product_name', $searchValue); 
        }
        
        if($product_name){
            $this->db->like('product_name', $product_name); 
        }
        
        if($invoice_no){
            $this->db->like('invoice_no', $invoice_no); 
        }
        
        if($return_reason){
            $this->db->where('return_reason', $return_reason); 
        }
		$this->db->select('*');
		$this->db->from('sale_return');
                $this->db->join('product_details', 'sale_return.product_id_fk = product_details.product_id');
                $this->db->join('category','product_details.category_id_fk = category.category_id');
                $this->db->join('subcategory','product_details.subcategory_id_fk = subcategory.subcategory_id');
                $this->db->join('size','product_details.size_id_fk = size.size_id');
                $this->db->join('color_details','product_details.color_id_fk = color_details.color_id');
		$this->db->order_by('sreturn_id', 'DESC');
        $this->db->where("return_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
	public function view_by()
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('category');
		$this->db->where('category_status', $status);
		$query = $this->db->get();
		
		$category_names = array();
		if ($query -> result()) {
		foreach ($query->result() as $category_name) {
		$category_names[$category_name-> category_id] = $category_name -> category_name;
			}
		return $category_names;
		} else {
		return FALSE;
		}
		}
		public function view_byname()
		{
		$status=1;
		$this->db->select('*');
		$this->db->from('category');
		$this->db->where('category_status', $status);
		$query = $this->db->get();
		return $query->result();
		}
		public function getTax($tax_id_fk){
                    $status=1;
                    $this->db->select('*');
                    $this->db->from('tax_class');
                    $this->db->where('tax_id', $tax_id_fk);
                    $query = $this->db->get();
                    return $query->result();
                }
}
?>
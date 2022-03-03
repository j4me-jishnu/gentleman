<?php
class Commonmodel extends CI_Model{
    public function getVendorModel($vendorname){
        $this->db->where('vendor_status',1);
        if($vendorname){
            $this->db->like('vendor_name',$vendorname);
        }
        $query = $this->db->get('vendor');
        $result =  $query->result_array();
        
        $arData['rows']=$result;
        $arData['records']=$query->num_rows();
        $arData['total']=$query->num_rows();
        return $arData;
    }
    public function getProductModel($productname){
        $this->db->where('product_status',1);
        if($productname){
            $this->db->like('product_name',$productname);
        }
		$this->db->select('*');
        $this->db->from('product_details');
        $this->db->join('size', 'size.size_id  = product_details.size_id_fk','left');
        $this->db->join('color_details', 'color_details.color_id  = product_details.color_id_fk','left');
		$this->db->join('category', 'category.category_id  = product_details.category_id_fk','left');
		$this->db->join('subcategory', 'subcategory.subcategory_id = product_details.subcategory_id_fk','left');
        $query = $this->db->get();
        $result =  $query->result_array();
        
        $arData['rows']=$result;
        $arData['records']=$query->num_rows();
        $arData['total']=$query->num_rows();
        return $arData;
    }
    public function getProductDetails($purchaseid){
        $this->db->where('purchase_status',1);
         $this->db->where('stock_status',1);
        if($purchaseid){
            $where = "(purchase_id= '$purchaseid' or product_name like '%$purchaseid%')";
            $this->db->where($where);
        }
        $this->db->select('*');
        $this->db->from('purchase_details');
        $this->db->join('product_details', 'purchase_details.product_id_fk  = product_details.product_id');
        $this->db->join('stock_details', 'stock_details.product_id_fk  = product_details.product_id');
        $this->db->join('size', 'size.size_id  = product_details.size_id_fk','left');
        $this->db->join('color_details', 'color_details.color_id  = product_details.color_id_fk','left');
		$this->db->join('category', 'category.category_id  = product_details.category_id_fk','left');
		$this->db->join('subcategory', 'subcategory.subcategory_id = product_details.subcategory_id_fk','left');
		// $this->db->where('purchase_quantity!=',0);
		$query = $this->db->get();
        // echo $this->db->last_query();
        $result =  $query->result_array();
        
        $arData['rows']=$result;
        $arData['records']=$query->num_rows();
        $arData['total']=$query->num_rows();
        return $arData;
    }
    public function getCustomerModel($customername){
        $this->db->where('customer_status',1);
        if($customername){
            $this->db->like('customer_name',$customername);
        }
        $query = $this->db->get('customer');
        $result =  $query->result_array();
        
        $arData['rows']=$result;
        $arData['records']=$query->num_rows();
        $arData['total']=$query->num_rows();
        return $arData;
    }
    public function getEmployeeModel($employeename){
        $this->db->where('employee_status',1);
        if($employeename){
            $this->db->like('employee_name',$employeename);
        }
        $query = $this->db->get('employee_details');
        $result =  $query->result_array();
        
        $arData['rows']=$result;
        $arData['records']=$query->num_rows();
        $arData['total']=$query->num_rows();
        return $arData;
    }
    public function getInvoiceModel($invoiceNo){
        $this->db->where('purchase_status',1);
        if($invoiceNo){
            $this->db->like('purchase_invoice_no',$invoiceNo);
        }
        $this->db->select('*');
        $this->db->from('purchase_details');
        $this->db->join('product_details', 'purchase_details.product_id_fk  = product_details.product_id');
        $this->db->join('category', 'category.category_id  = product_details.category_id_fk','left');
        $this->db->join('subcategory', 'subcategory.subcategory_id = product_details.subcategory_id_fk','left');
        $query = $this->db->get();
        $result =  $query->result_array();
        
        $arData['rows']=$result;
        $arData['records']=$query->num_rows();
        $arData['total']=$query->num_rows();
        return $arData;
    }
    
    public function getSaleInvoiceModel($invoiceNo){
        $this->db->where('sale_status',1);
        if($invoiceNo){
            $this->db->like('sale_invoice_number',$invoiceNo);
        }
        $this->db->select('*');
        $this->db->from('sale_details');
        $this->db->join('product_details', 'sale_details.product_id_fk  = product_details.product_id');
        $this->db->join('category', 'category.category_id  = product_details.category_id_fk','left');
        $this->db->join('subcategory', 'subcategory.subcategory_id = product_details.subcategory_id_fk','left');
        $query = $this->db->get();
        $result =  $query->result_array();
        
        $arData['rows']=$result;
        $arData['records']=$query->num_rows();
        $arData['total']=$query->num_rows();
        return $arData;
    }
    
    
}
?>

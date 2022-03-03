<?php
/*
 This is used to write all common functions mainly for ajax calls.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Common extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('Commonmodel');
    }
    public function getVendorList(){        
        $vendorname = ($this->input->get('searchTerm'))?$this->input->get('searchTerm'):'';
        $result = $this->Commonmodel->getVendorModel($vendorname);
        $json = json_encode($result);
        echo $json;
        
    }
    public function getProductList(){        
        $productname = ($this->input->get('searchTerm'))?$this->input->get('searchTerm'):'';
        $result = $this->Commonmodel->getProductModel($productname);
		// print_r($result);
		// exit();
        $json = json_encode($result);
        echo $json;
    }
    public function getPurchaseListusingID(){        
        $purchaseid = ($this->input->get('searchTerm'))?$this->input->get('searchTerm'):'';
        $result = $this->Commonmodel->getProductDetails($purchaseid);
        // print_r($result);
        // exit();
        $json = json_encode($result);
        echo $json;
    }
    public function getCustomerList(){        
        $customername = ($this->input->get('searchTerm'))?$this->input->get('searchTerm'):'';
        $result = $this->Commonmodel->getCustomerModel($customername);
        $json = json_encode($result);
        echo $json;
    }
    public function getEmployeeList(){        
        $employeename = ($this->input->get('searchTerm'))?$this->input->get('searchTerm'):'';
        $result = $this->Commonmodel->getEmployeeModel($employeename);
        $json = json_encode($result);
        echo $json;
    }
    public function getInvoiceList(){        
        $invoiceNo = ($this->input->get('searchTerm'))?$this->input->get('searchTerm'):'';
        $result = $this->Commonmodel->getInvoiceModel($invoiceNo);
        $json = json_encode($result);
        echo $json;
    }
    public function getSaleInvoiceList(){        
        $invoiceNo = ($this->input->get('searchTerm'))?$this->input->get('searchTerm'):'';
        $result = $this->Commonmodel->getSaleInvoiceModel($invoiceNo);
        $json = json_encode($result);
        echo $json;
    }
    
}

?>

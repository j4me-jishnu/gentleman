<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vendor extends MY_Controller {
	public $table = 'tbl_vendor';
	public $history_table = 'tbl_vendor_payment';
	public $page  = 'Vendor';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
		}
        $this->load->model('General_model');
		$this->load->model('Vendor_model');
        
	}
	public function index()
	{
		$template['body'] = 'Vendor/list';
		$template['script'] = 'Vendor/script';
		$this->load->view('template', $template);
	}
	public function get(){
		$this->load->model('Vendor_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->Vendor_model->getVendorTable($param);
    	$vendor = $this->Vendor_model->getVendorPayment();
    	for($i=0;$i<count($data['data']);$i++)
    	{
    		$total=0;
            for($j=0;$j<count($vendor['data']);$j++)
            {
                if($data['data'][$i]->vendor_id == $vendor['data'][$j]->vendor_id_fk)
                {
                    $tot = $vendor['data'][$j]->total;
                    break;
                }
            }
            $data['data'][$i]->total = $tot;  
    	}
    	$json_data = json_encode($data);
        echo $json_data;
    }
	public function add(){
		$this->form_validation->set_rules('vendorname', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['body'] = 'Vendor/add';
			$template['script'] = 'Vendor/script';
			$this->load->view('template', $template);
		}
		else {
			
			$data = array(
						'vendorname' => $this->input->post('vendorname'),
						'vendoraddress' => $this->input->post('vendoraddress'),
						'vendorphone' => $this->input->post('vendorphone'),
						'vendoremail' => $this->input->post('vendoremail'),
						'vendorgst' => $this->input->post('vendorgst'),
						'vendorpan' => $this->input->post('vendorpan'),
						'vendorstate' => $this->input->post('vendorstate'),
						'vendor_stcode' => $this->input->post('vendor_stcode'),
						'vendorstatus' => 1
						);
			$vendor_id = $this->input->post('vendor_id');
			if($vendor_id){
				 
				 $data['vendor_id'] = $vendor_id;
				 $result = $this->General_model->update($this->table,$data,'vendor_id',$vendor_id);
				 
				 $operation = array(
					 'user_id' => $this->session->userdata('id'),
					 'operation' => 'Modified',
					 'to_whom' => $vendor_id,
					 'date' => date('Y-m-d'),
					 'operation_id' => 3
				 );
				 $this->General_model->add_operation($operation);
				 
				 $response_text = 'Vendor details  updated';
			}
			else{
				$result = $this->General_model->add($this->table,$data);
				$id = $this->db->insert_id();
				$operation = array(
					'user_id' => $this->session->userdata('id'),
					'operation' => 'Added',
					'to_whom' => $id,
					'date' => date('Y-m-d'),
					'operation_id' => 3,

				);
				$this->General_model->add_operation($operation);
				$response_text = 'Vendor details Added';
			}
			if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			}
			else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
	        redirect('/Vendor/', 'refresh');
		}
	}
	public function edit($vendor_id){
		$template['body'] = 'Vendor/add';
		$template['script'] = 'Vendor/script';
		$template['records'] = $this->General_model->get_row($this->table,'vendor_id',$vendor_id);
    	$this->load->view('template', $template);
	}
	public function delete(){
       
        $vendor_id = $this->input->post('vendor_id');
        $updateData = array('vendorstatus' => 0);
        $data = $this->General_model->update($this->table,$updateData,'vendor_id',$vendor_id);                       
        if($data) {
			
			$operation = array(
				'user_id' => $this->session->userdata('id'),
				'operation' => 'Deleted',
				'to_whom' => $vendor_id,
				'date' => date('Y-m-d'),
				'operation_id' => 3
			);
			$this->General_model->add_operation($operation);
            $response['text'] = 'Deleted successfully';
            $response['type'] = 'success';
        }
        else{
            $response['text'] = 'Something went wrong';
            $response['type'] = 'error';
        }
        $response['layout'] = 'topRight';
        $data_json = json_encode($response);
        echo $data_json;
       // redirect('/Vendor/', 'refresh');
    }

    public function viewPurchase($vendor_id)
    {
    	$template['body'] = 'Vendor/view_purchase';
    	$template['id'] = $vendor_id;
		$template['script'] = 'Vendor/script1';
		$this->load->view('template', $template);
    }

    public function getPurchase($id)
    {
    	$this->load->model('Vendor_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$data = $this->Vendor_model->getPurchase($param,$id);
		//print_r($data['item']);
    	$json_data = json_encode($data);
    	echo $json_data;
    }

    public function addPayment($vendor_id,$total)
    {		
    	$template['data'] = $this->General_model->get_row($this->table,'vendor_id',$vendor_id);;
    	$template['body'] = 'Vendor/addPayment';
		$template['vendor_id'] = $vendor_id;
		$template['item'] = $this->Vendor_model->getPurchasedetails($vendor_id);
    	$template['total'] = $total;
		$template['script'] = 'Vendor/script';
		//var_dump($template['data']);
		$this->load->view('template', $template);
    }

    public function addPaymentAction()
    {
    		$vendor_id = $this->input->post('vendor_id');
			$amount = $this->input->post('amount');
			$pr_id = $this->input->post('purchase');
    		$pay = $this->input->post('paid_amount');
    		$tot = $this->input->post('total');
			$paid_amount =$amount + $pay; 
			$vendor_paid = $this->Vendor_model->get_paidamount($vendor_id);
			$vendor_paidamount = $vendor_paid[0]->paid_amount + $amount;
    		$data = array(

              'amount_paid' => $paid_amount

			);

			$data_vendor = array(

              'paid_amount' => $vendor_paidamount

			);
			
			if($vendor_id){
				 $result = $this->General_model->update('tbl_apurchase',$data,'pr_id',$pr_id);
				 $r = $this->General_model->update($this->table,$data_vendor,'vendor_id',$vendor_id);
                 
				 $response_text = 'Payment successfully added..';
			}
			if($result){
				$operation = array(
						 'user_id' => $this->session->userdata('id'),
						 'operation' => 'Payment added',
						 'to_whom' => $vendor_id,
						 'date' => date('Y-m-d'),
						 'operation_id' => 16,
						 'value' =>$amount
					 );
					 $this->General_model->add_operation($operation);
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			}
			else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
	        redirect('/Vendor/', 'refresh');
		

    }

    public function paymentHistory($id)
	{
		$template['id'] =$id;
		$template['body'] = 'Vendor/payment_history';
		$template['script'] = 'Vendor/script2';
		$this->load->view('template', $template);

	}

	public function getpaymentHistory($id)
	{
		$this->load->model('Vendor_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->Vendor_model->getpaymentHistory($param,$id);
    	$json_data = json_encode($data);
    	echo $json_data;

	}

	function get_amount(){

	  $pr_id = $this->input->post('pr_id');
	  

	  $data = $this->Vendor_model->get_amount($pr_id);
	  
	  echo json_encode($data);

	}

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Purchase extends MY_Controller {
	public $table = 'purchase_details';
	public $page  = 'Purchase';
	public $stock_table = 'stock_details';
        public $tax_table ='tax_class';
        public $vendor_table = 'vendor';
	public function __construct() {
		parent::__construct();
        // if(! $this->is_logged_in()){
        //     redirect('/login');
        // }
        
        $this->load->model('General_model');
        $this->load->model('Product_model');
        $this->load->model('Purchase_model');
        $this->load->model('Size_model');
        $this->load->model('Color_model');
        $this->load->model('Sale_model');
        $this->currentuserid = $this->session->userdata('id');
        $this->currentusertype = $this->session->userdata('admin_type');
		
	}
	public function index()
	{
		$template['body'] = 'Purchase/list';
		$template['script'] = 'Purchase/script';
		$this->load->view('template', $template);
	}
	public function add(){
		
		$product_id_fk = $this->input->post('product_id_fk');
		$this->form_validation->set_rules('vendor_name', 'Name', 'required');
                //$this->form_validation->set_rules('product_name', 'Name', 'required');
		
		if ($this->form_validation->run() == FALSE) {
		$template['body'] = 'Purchase/add';
		$template['script'] = 'Purchase/script';
		//$template['size'] = $this->Size_model->view_by();
		//$template['color'] = $this->Color_model->view_by();
                $template['tax_type'] = $this->Purchase_model->gettaxtype();
		$this->load->view('template', $template);
				 
		}
		else {
                        $this->load->helper('date');
			$date = date('Y-m-d h:i:sa');
                        $purchase_date = str_replace('/', '-', $this->input->post('purchase_date'));
                        $purchase_date =  date("Y-m-d",strtotime($purchase_date));
                        $template = $this->Purchase_model->purchaseinvoice(); //to get last invoice number
                        $insert_id = $this->Purchase_model->purchase_id(); //to get last purchase id;
                        if($insert_id == null){
                            $last_id =0;
                        }
                        else{
                        $last_id = $insert_id->purchase_id;
                        }
                        if($last_id == 0){
                                $invoice = 100;
                                }
                        else{
                                $invoice = $template->purchase_invoice_no;
                                }
                        $invoice_number=$invoice+1;
                         $temp =count($this->input->post('purchase_quantity'));
                         $product_id_fk = $this->input->post('product_id_fk');
                         $purchase_quantity = $this->input->post('purchase_quantity');
                         $purchase_price = $this->input->post('purchase_price');
                         $sale_price = $this->input->post('sale_price');
                         $purchase_total_price = $this->input->post('purchase_total_price');
                         $tax_type = $this->input->post('tax_include');
                         $purchase_remarks = $this->input->post('purchase_remarks');
                         if($tax_type=='1'){
                             $tax_id_fk = $this->input->post('tax_id_fk');
                         }
                         else {
                             $tax_id_fk = 0;
                         }
                         $grand_total = $this->input->post('grand_total');
                        //print_r($grand_total);
                        $vendor_id=$this->input->post('vendor_id_fk');
                        //print_r($invoice_number);
                        //exit();
                        $vendor_data = array(
                            'vendor_name'=> $this->input->post('vendor_name'),
                            'vendor_address'=>$this->input->post('vendor_address'),
                            'vender_mail' =>$this->input->post('vendor_email'),
                            'vendor_phone' =>$this->input->post('vendor_phone'),
                            'vendor_tin' =>$this->input->post('vendor_tin'),
                            'vendor_pin' =>$this->input->post('vendor_pin'),
                            'vendor_status' => 1
                        );
                        
                       if($vendor_id){
                           $data['vendor_id'] = $vendor_id;
                           $result = $this->General_model->update($this->vendor_table,$vendor_data,'vendor_id',$vendor_id);
                       }
                       else {
                           $vendor_id = $this->General_model->add_returnID($this->vendor_table,$vendor_data);
                       }
                      $stock_values = $this->General_model->get_all($this->stock_table);
                      //print_r($stock_values);
                      //exit();
                       for($i=0;$i<$temp;$i++){
			
			$data = array(
						'product_id_fk' => $product_id_fk[$i],
                                                'vendor_id_fk' =>$vendor_id,
						'product_purchase_quantity' => $purchase_quantity[$i],
						'purchase_price' => $purchase_price[$i],
						'purchase_total_price' => $purchase_total_price[$i],
						'purchase_date' => $purchase_date,
						'sale_price' =>$sale_price[$i],
						'purchase_remarks' => $purchase_remarks,
                                                'tax_type' =>$tax_type,
                                                'tax_id_fk' =>$tax_id_fk,
						'purchase_created_date' => $date,
                                                'purchase_invoice_no' => $invoice_number,
                                                'purchase_grandd_total'=> $grand_total,
                                                'purchase_return_qty' =>0,
						'purchase_status' => 1
						);
                        //print_r($data);
			$purchase_id = $this->General_model->add_returnID($this->table,$data);
                        $insert_id = $this->db->insert_id();
                        foreach($stock_values as $stock){
                            $product = $stock->product_id_fk;
                            if($product == $product_id_fk[$i]){
                                $quantity = $purchase_quantity[$i]+$stock->purchase_quantity;
                                $purchase_total_amount = $purchase_total_price[$i]+$stock->purchase_total_amount;
                                $stock_data = array(
                                            'product_id_fk' =>$product_id_fk[$i],
                                            'purchase_quantity' => $quantity,
	                                    'purchase_total_amount' => $purchase_total_amount,
	                                    'updated_date' => date('Y-m-d h:i:s'),
	                                    );
                                $result = $this->General_model->update($this->stock_table,$stock_data,'product_id_fk',$product_id_fk[$i]);
                            }
                        }
                        $response_text = 'Purchase Details added  successfully';
                        }
                        if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
                                
                 redirect('/purchase/invoice/'.$invoice_number.'/'.$vendor_id);   
                    }
				 
               }		 
        public function invoice($invoice_number,$vendor_id){
            $user_id = $this->currentuserid;
            $template['currentusertype'] = $this->currentusertype;
            $template['admin_data'] = $this->General_model->admin_data($user_id);
            $template['purchase_details'] = $this->Purchase_model->getcustomer_count($invoice_number);
            $template['purchase_total'] = $this->Purchase_model->getcustomer_total($invoice_number);
            $template['grand_total'] = $this->Purchase_model->gettotal($invoice_number);
            $template['tax_details'] = $this->Purchase_model->taxDetails($invoice_number);
            $template['vendor_details'] = $this->Purchase_model->getvendorData($vendor_id);
            $template['body'] = 'Purchase/purchaseinvoice';
            $template['script'] = 'Purchase/script';
            
            //print_r($template);
            //exit();
            $this->load->view('template', $template);
        }
        public function view($invoice_number,$vendor_id){
            $template['purchase_details'] = $this->Purchase_model->getcustomer_count($invoice_number);
            $template['purchase_total'] = $this->Purchase_model->getcustomer_total($invoice_number);
            $template['grand_total'] = $this->Purchase_model->gettotal($invoice_number);
            $template['tax_details'] = $this->Purchase_model->taxDetails($invoice_number);
            $template['vendor_details'] = $this->Purchase_model->getvendorData($vendor_id);
            $template['body'] = 'Purchase/View';
            $template['script'] = 'Purchase/script';
            //print_r($template);
            $this->load->view('template', $template);
            
        }
	
	public function get(){
		$this->load->model('Purchase_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
	$param['purchase_invoice_no'] =(isset($_REQUEST['purchase_invoice_no']))?$_REQUEST['purchase_invoice_no']:'';
        $param['vendor_name'] =(isset($_REQUEST['vendor_name']))?$_REQUEST['vendor_name']:'';
        $start_date =(isset($_REQUEST['start_date']))?$_REQUEST['start_date']:'';
        $end_date =(isset($_REQUEST['end_date']))?$_REQUEST['end_date']:'';
		if($start_date){
            $start_date = str_replace('/', '-', $start_date);
            $param['start_date'] =  date("Y-m-d",strtotime($start_date));
        }
       
        if($end_date){
            $end_date = str_replace('/', '-', $end_date);
            $param['end_date'] =  date("Y-m-d",strtotime($end_date));
        }
		
    	$data = $this->Purchase_model->getPurchaseReport($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function edit($purchase_invoice_no,$vendor_id){
		$template['body'] = 'Purchase/edit';
		$template['script'] = 'Purchase/script';
                $template['tax_type'] = $this->Purchase_model->gettaxtype();
		//$template['size'] = $this->Size_model->view_by();
		//$template['color'] = $this->Color_model->view_by();
		$template['records'] = $this->Purchase_model->get_alldata($purchase_invoice_no);
                $template['tax'] = $this->Purchase_model->GettaxData($purchase_invoice_no);
                $template['vendor'] = $this->General_model->get_row($this->vendor_table,'vendor_id',$vendor_id);
                $template['purchase'] = $this->General_model->get_row($this->table,'purchase_invoice_no',$purchase_invoice_no);
                //print_r($template);
               //exit();
		$purchase_date = str_replace('-', '/', $template['purchase']->purchase_date);
                $template['purchase']->purchase_date =  date("d-m-Y",strtotime($purchase_date));
		//$product_name = $this->General_model->get_data('product_details','product_id','product_name',$template['records']->product_id_fk);
        //$template['records']->product_name = $product_name[0]->product_name;
		//print_r($template);
		//exit();
    	$this->load->view('template', $template);
		
		
	}
	public function delete(){
        $purchase_invoice_no = $this->input->post('purchase_invoice_no');
		$purchase_values['purchase_details'] = $this->Purchase_model->get_alldata($purchase_invoice_no);
                $count = count($purchase_values['purchase_details']);
                for($i=0;$i<$count;$i++){
                    $product_id_fk = $purchase_values['purchase_details'][$i]->product_id_fk;
                    $purchase_id = $purchase_values['purchase_details'][$i]->purchase_id;
                    $stock_values = $this->General_model->get_row($this->stock_table,'product_id_fk',$product_id_fk);
                    $balance_quantity = $stock_values->purchase_quantity-$purchase_values['purchase_details'][$i]->product_purchase_quantity;
                    $balance_total = $stock_values->purchase_total_amount-$purchase_values['purchase_details'][$i]->purchase_total_price;
                    $updateData = array('purchase_status' => 0);
                    $data = $this->General_model->update($this->table,$updateData,'purchase_id',$purchase_id);
                    $updatestockData = array('purchase_quantity' => $balance_quantity,
								'purchase_total_amount' => $balance_total);
                    $data1 = $this->General_model->update($this->stock_table,$updatestockData,'product_id_fk',$product_id_fk);
                }						
		if($data) {
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
		redirect('/category/', 'refresh');
    }
    public function edit_vendor(){
        $vendor_id = $this->input->post('vendor_id');
        $customer_name = $this->input->post('customer_name');
        $vendor_address = $this->input->post('vendor_address');
        $vender_mail = $this->input->post('vender_mail');
        $vendor_phone = $this->input->post('vendor_phone');
        $vendor_tin = $this->input->post('vendor_tin');
        $vendor_pin = $this->input->post('vendor_pin');
        
        $purchase_date = str_replace('/', '-', $this->input->post('date'));
        $purchase_date =  date("Y-m-d",strtotime($purchase_date));
        //$date= $this->input->post('date');
        $tax_id_fk = $this->input->post('tax_id_fk');
        $purchase_remarks = $this->input->post('purchase_remarks');
        $invoice_no = $this->input->post('invoice_no');
        $purchase_values['purchase_details'] = $this->Purchase_model->get_alldata($invoice_no);
        print_r($purchase_values);
        $count = count($purchase_values['purchase_details']);
        for($i=0;$i<$count;$i++){
            $purchase_id = $purchase_values['purchase_details'][$i]->purchase_id;
            $purchase_data = array('purchase_date' => $purchase_date,
                                    'tax_id_fk' => $tax_id_fk,
                                    'purchase_remarks'=> $purchase_remarks
                    );
            $data = $this->General_model->update($this->table,$purchase_data,'purchase_id',$purchase_id);
        }
        //print_r($invoice_no);
        $vendor_data=array('vendor_name'=> $customer_name,
                            'vendor_address'=>$vendor_address,
                            'vender_mail' =>$vender_mail,
                            'vendor_phone' =>$vendor_phone,
                            'vendor_tin' =>$vendor_tin,
                            'vendor_pin' =>$vendor_pin);
        $data = $this->General_model->update($this->vendor_table,$vendor_data,'vendor_id',$vendor_id);
        if($data) {
            $response['text'] = 'Updated successfully';
            $response['type'] = 'success';
        }
        else{
            $response['text'] = 'Something went wrong';
            $response['type'] = 'error';
        }
        $response['layout'] = 'topRight';
        $data_json = json_encode($response);
        echo $data_json;
    }

    public function generateBarcode($purchase_id_fk){
		
		$filename = "barcode/lilac.txt";
		$dest_folder = "barcode/".$purchase_id_fk;

		if (!file_exists($dest_folder)) {
		    mkdir($dest_folder, 0777, true);
		}
		$destfilename = $dest_folder."/lilac-code".time().".txt";
		// $myfile = fopen($filename, "r") or die("Unable to open file!");
		// $content = fread($myfile,filesize($filename));
		// fclose($myfile);
		
		$records = $this->General_model->get_row('purchase_details','purchase_id',$purchase_id_fk);
		$product_name = $this->General_model->get_data('product_details','product_id','product_name',$records->product_id_fk);
    	$records->product_name = $product_name[0]->product_name;

	    //read the entire string
		$str=file_get_contents($filename);

		//replace something in the file string - this is a VERY simple example
		$str=str_replace("<!--PRODUCT_NAME-->", $product_name[0]->product_name,$str);
		$str=str_replace("<!--PURCHASE_ID-->", $purchase_id_fk ,$str);
		$str=str_replace("<!--AMOUNT-->", $records->sale_price,$str);

		//write the entire string
		file_put_contents($destfilename, $str);
	}
        public function delete_id(){
            $purchase_id =$this->input->post('purchase_id');
            $purchase_values = $this->General_model->get_row($this->table,'purchase_id',$purchase_id);
            $product_id_fk = $purchase_values->product_id_fk;
            $stock_values = $this->General_model->get_row($this->stock_table,'product_id_fk',$product_id_fk);
            $balance_quantity = $stock_values->purchase_quantity-$purchase_values->product_purchase_quantity;
            $balance_total = $stock_values->purchase_total_amount-$purchase_values->purchase_total_price;
            //print_r($balance_total);
            //exit();
            $updateData = array('purchase_status' => 0);
            $data = $this->General_model->update($this->table,$updateData,'purchase_id',$purchase_id);
            $updatestockData = array('purchase_quantity' => $balance_quantity,
                                    'purchase_total_amount' => $balance_total);
            $this->General_model->update($this->stock_table,$updatestockData,'product_id_fk',$product_id_fk);
            
            if($data) {
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
		redirect('/category/', 'refresh');
            
        }
	public function editRow(){
            $purchase_id =$this->input->post('purchase_id');
            $data =  $this->Purchase_model->GetPurchaseData($purchase_id);
            echo json_encode($data);
        }
        public function editUpdate(){
            $this->load->helper('date');
            $date = date('Y-m-d h:i:sa');
            $purchase_id =$this->input->post('purchase_id');
            $product_id =$this->input->post('product_id');
            $product_purchase_quantity =$this->input->post('product_purchase_quantity');
            $purchase_price =$this->input->post('purchase_price');
            $sale_price =$this->input->post('sale_price');
            $purchase_total_price =$this->input->post('purchase_total_price');
            $tax_id_fk =$this->input->post('tax_id_fk');
            if($tax_id_fk != 0){
            $tax['tax'] = $this->General_model->get_row($this->tax_table,'tax_id',$tax_id_fk);
           
            $tax_amount = $tax['tax']->tax_amount;
            $grand_total = $purchase_total_price + ($purchase_total_price * $tax_amount/100);
            }
            else{
                $grand_total = $purchase_total_price;
            }
             //print_r($grand_total);
            $purchase_values = $this->General_model->get_row($this->table,'purchase_id',$purchase_id);
            $old_pproduct_id = $purchase_values->product_id_fk;
            $old_pqty = $purchase_values->product_purchase_quantity;
            $old_prate = $purchase_values->purchase_total_price;
            
            if($product_id == $old_pproduct_id){
                $stock_values = $this->General_model->get_row($this->stock_table,'product_id_fk',$product_id);
                $stock_qty = $stock_values->purchase_quantity;
                $stock_total = $stock_values->purchase_total_amount;
                if($product_purchase_quantity > $old_pqty){
                    $bal_s_qty = $stock_qty +($product_purchase_quantity - $old_pqty);
                    $stock_data = array(
                        'purchase_quantity'=> $bal_s_qty,
                        'updated_date' =>$date
                        );
                    $this->General_model->update($this->stock_table,$stock_data,'product_id_fk',$product_id);
                }
                if($product_purchase_quantity < $old_pqty){
                    $bal_s_qty = $stock_qty -($old_pqty - $product_purchase_quantity);
                    $stock_data = array(
                        'purchase_quantity'=> $bal_s_qty,
                        'updated_date' =>$date
                        );
                    $this->General_model->update($this->stock_table,$stock_data,'product_id_fk',$product_id);
                }
                if($purchase_total_price > $old_prate){
                    $bal_s_rate = $stock_total +($purchase_total_price - $old_prate);
                    $stock_data = array(
                        'purchase_total_amount' => $bal_s_rate,
                        'updated_date' =>$date
                        );
                    $this->General_model->update($this->stock_table,$stock_data,'product_id_fk',$product_id);
                }
                if($purchase_total_price < $old_prate){
                    $bal_s_rate = $stock_total- ($old_prate - $purchase_total_price);
                    $stock_data = array(
                        'purchase_total_amount' => $bal_s_rate,
                        'updated_date' =>$date
                        );
                    $this->General_model->update($this->stock_table,$stock_data,'product_id_fk',$product_id);
                }
                
           
                
            }
            if($product_id != $old_pproduct_id){
               $stock_values = $this->General_model->get_row($this->stock_table,'product_id_fk',$product_id);
               $stock_qty = $stock_values->purchase_quantity;
               $stock_total = $stock_values->purchase_total_amount;
               $bal_s_qty = $stock_qty + $product_purchase_quantity;
               $bal_s_rate = $stock_total + $purchase_total_price;
               $stock_oldvalues = $this->General_model->get_row($this->stock_table,'product_id_fk',$old_pproduct_id);
               $stock_qty = $stock_oldvalues->purchase_quantity;
               $stock_total = $stock_oldvalues->purchase_total_amount;
               $bal_so_qty = $stock_qty - $product_purchase_quantity;
               $bal_so_rate = $stock_total - $purchase_total_price;
               if($product_id){
               $stock_data = array(
                'purchase_quantity'=> $bal_s_qty,
                'purchase_total_amount' => $bal_s_rate,
                'updated_date' =>$date
                );
               $this->General_model->update($this->stock_table,$stock_data,'product_id_fk',$product_id);
               }
                
               $stock_olddata = array(
                'purchase_quantity'=> $bal_so_qty,
                'purchase_total_amount' => $bal_so_rate,
                'updated_date' =>$date
                );
               $this->General_model->update($this->stock_table,$stock_olddata,'product_id_fk',$old_pproduct_id);
               
            }
           $purchase_data = array(
              'product_id_fk' => $product_id,
              'product_purchase_quantity' =>$product_purchase_quantity,
              'purchase_price'=>$purchase_price,
              'sale_price' => $sale_price,
              'purchase_total_price' => $purchase_total_price,
              'tax_id_fk' => $tax_id_fk
              
            );
            $data = $this->General_model->update($this->table,$purchase_data,'purchase_id',$purchase_id);
            if($data) {
            $response['text'] = 'Product Details Updated successfully';
            $response['type'] = 'success';
        }
        else{
            $response['text'] = 'Something went wrong';
            $response['type'] = 'error';
        }
        $response['layout'] = 'topRight';
        $data_json = json_encode($response);
        echo $data_json;
        redirect('/Purchase/', 'refresh');
            
        }
}
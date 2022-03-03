<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sale extends MY_Controller {
	public $table = 'sale_details';
	public $table1 = 'product_details';
	public $page  = 'Sale';
	public $stock_table  = 'stock_details';
        public $purchase = 'purchase_details';
        public $tax_table ='tax_class';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
            redirect('/login');
        }
        
        $this->load->model('General_model');
        $this->load->model('ProductDetails_model');
        $this->load->model('Sale_model');
        $this->currentuserid = $this->session->userdata('id');
        $this->currentusertype = $this->session->userdata('admin_type');
	}
	public function index()
	{
		//$user_id = $this->currentuserid;
        //$template['currentusertype'] = $this->currentusertype;
        //$template['admin_data'] = $this->General_model->admin_data($user_id);
		$template['body'] = 'Sale/list';
		$template['script'] = 'Sale/script';
		
		$this->load->view('template', $template);
	}
	public function add(){
		// $template['body'] = 'Sale/add';
		// $template['script'] = 'Sale/script';
		// $template['getcustid'] = $this->Sale_model->getcustid();
		// $this->load->view('template', $template);
		// print_r($template);
		// exit();
		//$user_id = $this->currentuserid;
        //$template['currentusertype'] = $this->currentusertype;
        //$template['admin_data'] = $this->General_model->admin_data($user_id);
	
		$this->form_validation->set_rules('sale_date', 'Date', 'required');
		
		if ($this->form_validation->run() == FALSE) {
		$template['body'] = 'Sale/add';
		$template['script'] = 'Sale/script';
                $template['tax_type'] = $this->Sale_model->gettaxtype();
		$template['getcustid'] = $this->Sale_model->getcustid();
                //print_r($template);
               // exit();
		$this->load->view('template', $template);
		
		   
		}
		else {
			$this->load->helper('date');
			$date = date('Y-m-d h:i:sa');
                        $template = $this->Sale_model->getinvoice();
                        //print_r($template);
                        //exit();
                        $insert_id = $this->Sale_model->last_id();
                        if($insert_id == null){
                            $last_id =0;
                        }
                        else{
                        $last_id = $insert_id->sale_id;
                        }
                        if($last_id == 0){
                                $invoice = 100;
                                }
                        else{
                                $invoice = $template->sale_invoice_number;
                                }
                        $invoice_number=$invoice+1;
                                //print_r($invoice_number);
                     
                        
                        //exit();
			$sale_date = str_replace('/', '-', $this->input->post('sale_date'));
                        $sale_date =  date("Y-m-d",strtotime($sale_date));
				$product_id_fk = $this->input->post('product_id_fk');
				$getsaleid=$this->Sale_model->getsaleid();
				if(isset($getsaleid[0]->sale_id))
				{
					$getsaleid= $getsaleid[0]->sale_id;
				}
				else{
					$getsaleid =0;
				}
				$cust_details = $this->input->post('cust_details');
				$customer_details = $cust_details+1;
				$temp =count($this->input->post('sale_quantity'));
				$sale_quantity = $this->input->post('sale_quantity');
                                $sale_amount = $this->input->post('sale_amount');
				$sale_discount =$this->input->post('sale_discount');
				$sale_total_price = $this->input->post('sale_total_price');
				$sale_remarks = $this->input->post('sale_remarks');
				$sale_id = $this->input->post('sale_id');
                                $grand_total = $this->input->post('grand_total');
                                $purchase_id_fk = $this->input->post('purchase_id_fk');
                                $tax_id_fk = $this->input->post('tax_id_fk');
                                $sale_remarks = $this->input->post('sale_remarks');
                                $stock_values = $this->General_model->get_all($this->stock_table);
                                $sale_id == $this->input->post('sale_id');
								//$purchase_values = $this->General_model->get_all($this->purchase);
                                //print_r($grand_total);
                               // exit();
				
					
				for($i=0;$i<$temp;$i++)
					
				{
					$purchase = $this->General_model->get_row($this->purchase,'purchase_id',$purchase_id_fk[$i]);
                                    //foreach($purchase_values as $purchase){
										//$purchase_id = $purchase->purchase_id;
										// if($purchase_id == $purchase_id_fk[$i])
										// {
											$sale_qty = $sale_quantity[$i]+$purchase->purchase_return_qty;
											$purchase_data = array('purchase_return_qty'=>$sale_qty
													);
											$result = $this->General_model->update($this->purchase,$purchase_data,'purchase_id',$purchase_id_fk[$i]);
										// }
									//}
									//print_r($purchase_id_fk[$i]);
                                        $data = array(
                                            'product_id_fk' =>$product_id_fk[$i],
                                            'sale_quantity' =>$sale_quantity[$i],
                                            'sale_price' =>$sale_amount[$i],
                                            'sale_discount' =>$sale_discount[$i],
                                            'sale_total_price' =>$sale_total_price[$i],
                                            'purchase_id_fk' =>$purchase_id_fk[$i],
                                            'sale_remarks' =>$sale_remarks,
                                            'sale_created_date' =>$date,
                                            'tax_id_fk' => $tax_id_fk,
                                            'sale_date' => $sale_date,
                                            'cust_details' =>$customer_details,
                                            'sale_invoice_number'=>$invoice_number,
                                            'grand_total' =>$grand_total,
                                            'sale_status' =>1
                                            );
				 	$saleid = $this->General_model->add_returnID($this->table,$data);
                                        $insert_id = $this->db->insert_id();
                                        foreach($stock_values as $stock)
						{
							$product = $stock->product_id_fk;
							
							if($product == $product_id_fk[$i])
							{
								$quantity = $sale_quantity[$i]+$stock->sale_quantity;
								$sale_total_amount = $sale_total_price[$i]+$stock->sale_total_amount;
								$stock_data = array(
										'product_id_fk' =>$product_id_fk[$i],
										'sale_quantity' => $quantity,
	                                    'sale_total_amount' => $sale_total_amount,
	                                    'updated_date' => date('Y-m-d h:i:s'),
	                                    );	
									$result = $this->General_model->update($this->stock_table,$stock_data,'product_id_fk',$product_id_fk[$i]);
							}
						}
					$response_text = 'Sale Details added  successfully';
				}
					
			if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
				
				
			redirect('/sale/invoice/'.$customer_details);
			}
			
		}
	
	public function invoice($customer_details){
		$user_id = $this->currentuserid;
                $template['currentusertype'] = $this->currentusertype;
                $template['admin_data'] = $this->General_model->admin_data($user_id);
		$template['sale_details'] = $this->Sale_model->getcustomer_count($customer_details);
		$template['sale_total'] = $this->Sale_model->getcustomer_total($customer_details);
                $template['grand_total'] = $this->Sale_model->gettotal($customer_details);
                $template['tax_details'] = $this->Sale_model->taxDetails($customer_details);
                $template['invoice_no'] = $this->Sale_model->invoiceDetails($customer_details);
		//print_r($template);
		//exit();
		
		$template['body'] = 'Sale/invoice';
		$template['script'] = 'Sale/script';
		$this->load->view('template',$template);
		
	}
	
	// public function invoiceedit($sale_id){
		// $template['sale_details'] = $this->Sale_model->getcustomer_count_edit($sale_id);
		// //$template['sale_total'] = $this->Sale_model->getcustomer_total($sale_id);
		// print_r($template);
		// exit();
		// $template['body'] = 'Sale/invoiceedit';
		// $template['script'] = 'Sale/script';
		// $this->load->view('template',$template);
		
	// }
	
	public function get(){
		$this->load->model('Sale_model');
		//$param['user_id'] = $this->currentuserid;	
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		
		$param['sale_invoice_number'] =(isset($_REQUEST['sale_invoice_number']))?$_REQUEST['sale_invoice_number']:'';
                $param['sale_totalPrice'] =(isset($_REQUEST['sale_totalPrice']))?$_REQUEST['sale_totalPrice']:'';
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
        $data = $this->Sale_model->getSaleReport($param);
		
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function edit($sale_invoice_number){
		
		$template['body'] = 'Sale/edit';
		$template['script'] = 'Sale/scriptedit';
                $template['sale'] = $this->Sale_model->view_data($sale_invoice_number);
                $template['sale_date'] = $this->Sale_model->view_saleDate($sale_invoice_number);
		$template['tax_type'] = $this->Sale_model->gettaxtype();
                if($template['sale_date'] != null){
		$sale_date = str_replace('-', '/', $template['sale_date']->sale_date);
                $template['sale_date']->sale_date =  date("d/m/Y",strtotime($sale_date));
                }
                //print_r($template);
		//exit();
		//$product_name = $this->General_model->get_data('product_details','product_id','product_name',$template['records']->product_id_fk);
        //$template['records']->product_name = $product_name[0]->product_name;
		
    	$this->load->view('template', $template);
		
		
	}
	public function delete(){
        $sale_invoice_number = $this->input->post('sale_invoice_number');
                $sale_details['sale'] = $this->Sale_model->view_data($sale_invoice_number);
                
                $count = count($sale_details['sale']);
                
                for($i=0;$i<$count;$i++){
                $product_id_fk = $sale_details['sale'][$i]->product_id_fk;
                $sale_id = $sale_details['sale'][$i]->sale_id;
                $stock_values = $this->General_model->get_row($this->stock_table,'product_id_fk',$product_id_fk);
                $balance_quantity = $stock_values->sale_quantity-$sale_details['sale'][$i]->sale_quantity;
                $stock_sale_amount = $stock_values->sale_total_amount-$sale_details['sale'][$i]->sale_total_price;
                $updateData = array('sale_status' => 0);
                $data = $this->General_model->update($this->table,$updateData,'sale_id',$sale_id);
                $updatestockData = array('sale_quantity' => $balance_quantity,
                                        'sale_total_amount' => $stock_sale_amount,
                                        'updated_date' => date('Y-m-d h:i:s'),);
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
	 redirect('/sale/', 'refresh');
    }
	
	public function getunitamount(){
		$product_id = $this->input->post('product_id');
		$data = $this->Sale_model->getunitamount($product_id);
		echo json_encode($data);
	}
	public function edit_sale()
	{
		$template['body'] = 'Sale/edit';
		$template['script'] = 'Sale/scriptedit';
		$template['getcustid'] = $this->Sale_model->getcustid();
		$user_id = $this->currentuserid;
       // $template['currentusertype'] = $this->currentusertype;
        //$template['admin_data'] = $this->General_model->admin_data($user_id);
		$this->load->view('template', $template);
		// print_r($template);
		// exit();
	
		$this->form_validation->set_rules('sale_quantity', 'Quantity', 'required');
		
		if ($this->form_validation->run() == FALSE) {
		$template['body'] = 'Sale/add';
		$template['script'] = 'Sale/script';
		$template['getcustid'] = $this->Sale_model->getcustid();
		//$user_id = $this->currentuserid;
       // $template['currentusertype'] = $this->currentusertype;
       // $template['admin_data'] = $this->General_model->admin_data($user_id);
		$this->load->view('template', $template);
		
		   
		}
		else {
			$this->load->helper('date');
			$date = date('Y-m-d h:i:sa');
			$sale_date = str_replace('/', '-', $this->input->post('sale_date'));
            $sale_date =  date("Y-m-d",strtotime($sale_date));
				$product_id_fk = $this->input->post('product_id_fk');
				$getsaleid=$this->Sale_model->getsaleid();
				if(isset($getsaleid[0]->sale_id))
				{
					$getsaleid= $getsaleid[0]->sale_id;
				}
				else{
					$getsaleid =0;
				}
				$cust_details = $this->input->post('cust_details');
				$customer_details = $cust_details+1;
				$temp =count($this->input->post('sale_quantity'));
				$sale_quantity = $this->input->post('sale_quantity');
				$sale_amount = $this->input->post('sale_amount');
				$sale_discount =$this->input->post('sale_discount');
				$sale_total_price = $this->input->post('sale_total_price');
				$sale_remarks = $this->input->post('sale_remarks');
				$sale_id = $this->input->post('sale_id');
				//print_r($sale_id);
				$stock_values = $this->General_model->get_all($this->stock_table);
				$old_sale_amount = $this->input->post('old_sale_amount');
				$old_total_amount = $this->input->post('old_total_amount');
				$old_sale_discount = $this->input->post('old_sale_discount');
				if($sale_id)
					{
						$data1 = array(
							'product_id_fk' =>$product_id_fk,
							'sale_quantity' =>$sale_quantity,
							'sale_amount' =>$sale_amount,
							'sale_discount' =>$sale_discount,
							'sale_total_price' =>$sale_total_price,
							'sale_remarks' =>$sale_remarks,
							'sale_created_date' =>$date,
							'sale_date' => $sale_date,
							'cust_details' =>$cust_details,
							'sale_status' =>1
							);
                     $data1['sale_id'] = $sale_id;
                     $result = $this->General_model->update($this->table,$data1,'sale_id',$sale_id);
					 
					 $product_id_fk = $this->input->post('product_id_fk');
					 $stock_values = $this->General_model->get_row($this->stock_table,'product_id_fk',$this->input->post('product_id_fk'));
					 $old_quantity = $this->input->post('old_quantity');
					 
					 
					 //print_r($old_sale_amount);
					 //exit();
					 $old_product_id = $this->input->post('old_product_id');
					 $new_product_id = $this->input->post('product_id_fk');
					 $product = $stock_values->product_id_fk;
					 if($old_product_id == $new_product_id)
						{
						 if($old_quantity > $sale_quantity)
							{
							 $stock_quantity = $stock_values->sale_quantity;
							 $quantity = $old_quantity-$sale_quantity;
							 $new_quantity = $stock_quantity-$quantity;
							 $stock_total = $stock_values->sale_total_amount;	
							 $sale_total = $old_total_amount-$sale_total_price;
							 $new_total_amount = $stock_total-$sale_total;
							 $stock_data = array(
									'product_id_fk' =>$product_id_fk,
									'sale_quantity' => $new_quantity,
                                    'sale_total_amount' => $new_total_amount,
                                    'updated_date' => date('Y-m-d h:i:s'),
                                    );	
								$result = $this->General_model->update($this->stock_table,$stock_data,'product_id_fk',$product_id_fk);
							}
						 else if($old_quantity < $sale_quantity)
							{
							 $stock_quantity = $stock_values->sale_quantity;
							 $quantity = $sale_quantity-$old_quantity;
							 $new_quantity = $stock_quantity+$quantity;
							 $stock_total = $stock_values->sale_total_amount;	
							 $sale_total = $sale_total_price-$old_total_amount;
							 $new_total_amount = $stock_total+$sale_total;
							 $stock_data = array(
									'product_id_fk' =>$product_id_fk,
									'sale_quantity' => $new_quantity,
                                    'sale_total_amount' => $new_total_amount,
                                    'updated_date' => date('Y-m-d h:i:s'),
                                    );	
								$result = $this->General_model->update($this->stock_table,$stock_data,'product_id_fk',$product_id_fk);
							}
							else if($old_sale_amount != $sale_amount)
							{
								if ($old_sale_amount > $sale_amount)
								{
									$stock_total = $stock_values->sale_total_amount;	
									$sale_total = $old_total_amount-$sale_total_price;
									$new_total_amount = $stock_total-$sale_total;
									
									$stock_data = array(
											'productid_fk' =>$product_id_fk,
											'sale_total_amount' => $new_total_amount,
											'updated_date' => date('Y-m-d h:i:s'),
											);
									$result = $this->General_model->update($this->stock_table,$stock_data,'product_id_fk',$product_id_fk);
								}
								else if($sale_amount > $old_sale_amount)
								{
									$stock_total = $stock_values->sale_total_amount;	
									$sale_total = $sale_total_price-$old_total_amount;
									$new_total_amount = $stock_total+$sale_total;
									
									$stock_data = array(
											'product_id_fk' =>$product_id_fk,
											'sale_total_amount' => $new_total_amount,
											'updated_date' => date('Y-m-d h:i:s'),
											);
									$result = $this->General_model->update($this->stock_table,$stock_data,'product_id_fk',$product_id_fk);
								}
							}
							else if($old_sale_discount != $sale_discount)
							{
								if ($old_sale_discount > $sale_discount)
								{
									$stock_total = $stock_values->sale_total_amount;	
									$sale_total = $old_total_amount-$sale_total_price;
									$new_total_amount = $stock_total-$sale_total;
									
									$stock_data = array(
											'product_id_fk' =>$product_id_fk,
											'sale_total_amount' => $new_total_amount,
											'updated_date' => date('Y-m-d h:i:s'),
											);
									$result = $this->General_model->update($this->stock_table,$stock_data,'product_id_fk',$product_id_fk);
								}
								else if($sale_discount > $old_sale_discount)
								{
									$stock_total = $stock_values->sale_total_amount;
									//print_r($stock_total);
									//exit();
									$sale_total = $sale_total_price-$old_total_amount;
									$new_total_amount = $stock_total+$sale_total;
									
									$stock_data = array(
											'product_id_fk' =>$product_id_fk,
											'sale_total_amount' => $new_total_amount,
											'updated_date' => date('Y-m-d h:i:s'),
											);
									$result = $this->General_model->update($this->stock_table,$stock_data,'product_id_fk',$product_id_fk);
								}
							}
							
						 
					 else
							{
							 $stock_quantity = $stock_values->sale_quantity;
							 $stock_total = $stock_values->sale_total_amount;
							  $stock_data = array(
									'product_id_fk' =>$product_id_fk,
									'sale_quantity' => $stock_quantity,
                                    'sale_total_amount' => $stock_total,
                                    'updated_date' => date('Y-m-d h:i:s'),
                                    );	
								$result = $this->General_model->update($this->stock_table,$stock_data,'product_id_fk',$product_id_fk);
							}
						
						}
					 redirect('/sale/invoiceedit/'.$sale_id);
					}
				
	}
	}
	public function invoiceedit($sale_id){
		$template['sale_details'] = $this->Sale_model->invoice_data($sale_id);
		//$user_id = $this->currentuserid;
       // $template['currentusertype'] = $this->currentusertype;
       // $template['admin_data'] = $this->General_model->admin_data($user_id);
		//$template['sale_total'] = $this->Sale_model->getcustomer_total($customer_details);
		//$template['records'] = $this->General_model->get_row($this->table,'sale_id',$sale_id);
		//print_r($template);
		//exit();
		$template['body'] = 'Sale/invoiceedit';
		$template['script'] = 'Sale/script';
		$this->load->view('template',$template);
		
	}
        public function tax_amount()
        {
          
        $tax_id = $this->input->post('value');
        $data = $this->Sale_model->getAmount($tax_id);
        $json_data = json_encode($data);
    	echo $json_data;
        }
        
    public function view($sale_invoice_number,$cust_details){
        $template['sale_details'] = $this->Sale_model->view_data($sale_invoice_number);
        $template['sale_total'] = $this->Sale_model->view_saleTotal($sale_invoice_number);
        $template['invoice_number'] = $this->Sale_model->invoice($cust_details);
        
        $tax_id = $template['invoice_number']->tax_id_fk;
        $template['tax_details'] = $this->Sale_model->getAmount($tax_id);
       //print_r($template);
        //exit();
        $template['body'] = 'Sale/view';
        $template['script'] = 'Sale/script';
        $this->load->view('template',$template);
    }
    
    public function delete_id(){
        $sale_id = $this->input->post('sale_id');
                $sale_details = $this->General_model->get_row($this->table,'sale_id',$sale_id);
                
                $product_id_fk = $sale_details->product_id_fk;
                $stock_values = $this->General_model->get_row($this->stock_table,'product_id_fk',$product_id_fk);
                $balance_quantity = $stock_values->sale_quantity-$sale_details->sale_quantity;
                $stock_sale_amount = $stock_values->sale_total_amount-$sale_details->sale_total_price;
                $updateData = array('sale_status' => 0);
                $data = $this->General_model->update($this->table,$updateData,'sale_id',$sale_id);
                $updatestockData = array('sale_quantity' => $balance_quantity,
                                        'sale_total_amount' => $stock_sale_amount,
                                        'updated_date' => date('Y-m-d h:i:s'),);
		$data1 = $this->General_model->update($this->stock_table,$updatestockData,'product_id_fk',$product_id_fk);
                //print_r($updatestockData);
               // exit();	
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
	 redirect('/sale/', 'refresh');
    }
    
    public function editRow(){
       $sale_id = $this->input->post('sale_id');
        $data =  $this->Sale_model->GetSaleData($sale_id);
        echo json_encode($data);
    }
    public function editUpdate(){
            $this->load->helper('date');
            $date = date('Y-m-d h:i:sa');
            $sale_id =$this->input->post('sale_id');
            $product_id =$this->input->post('product_id');
            //print_r($product_id);
            $sale_quantity =$this->input->post('product_sale_quantity');
            $sale_price =$this->input->post('sale_price');
            $sale_discount =$this->input->post('sale_discount');
            $sale_total_price =$this->input->post('sale_total_price');
            $tax_id_fk =$this->input->post('tax_id_fk');
            $sale_remarks =$this->input->post('sale_remarks');
            
            $tax['tax'] = $this->General_model->get_row($this->tax_table,'tax_id',$tax_id_fk);
            $tax_amount = $tax['tax']->tax_amount;
            $grand_total = $sale_total_price + ($sale_total_price * $tax_amount/100);
            
            $sale_values = $this->General_model->get_row($this->table,'sale_id',$sale_id);
                $old_sproduct_id = $sale_values->product_id_fk;
                $old_sqty = $sale_values->sale_quantity;
                $old_srate = $sale_values->sale_total_price;
            if($product_id == $old_sproduct_id){
                $stock_values = $this->General_model->get_row($this->stock_table,'product_id_fk',$product_id);
                $stock_sqty = $stock_values->sale_quantity;
                $stock_total = $stock_values->sale_total_amount;
                
                if($sale_quantity > $old_sqty){
                    $bal_s_qty = $stock_sqty +($sale_quantity - $old_sqty);
                    $stock_data = array(
                        'sale_quantity'=> $bal_s_qty,
                        'updated_date' =>$date
                        );
                    $this->General_model->update($this->stock_table,$stock_data,'product_id_fk',$product_id);
                }
                if($sale_quantity < $old_sqty){
                    $bal_s_qty = $stock_sqty -($old_sqty - $sale_quantity);
                    $stock_data = array(
                        'sale_quantity'=> $bal_s_qty,
                        'updated_date' =>$date
                        );
                    $this->General_model->update($this->stock_table,$stock_data,'product_id_fk',$product_id);
                }
                if($sale_total_price > $old_srate){
                    $bal_s_rate = $stock_total +($sale_total_price - $old_srate);
                    $stock_data = array(
                        'sale_total_amount' => $bal_s_rate,
                        'updated_date' =>$date
                        );
                   $this->General_model->update($this->stock_table,$stock_data,'product_id_fk',$product_id);
                }
                if($sale_total_price < $old_srate){
                    $bal_s_rate = $stock_total- ($old_srate - $sale_total_price);
                    $stock_data = array(
                        'sale_total_amount' => $bal_s_rate,
                        'updated_date' =>$date
                        );
                    $this->General_model->update($this->stock_table,$stock_data,'product_id_fk',$product_id);
                }
                //print_r($stock_data);
            }
            if($product_id != $old_sproduct_id){
            $stock_values = $this->General_model->get_row($this->stock_table,'product_id_fk',$product_id);
            $stock_sqty = $stock_values->sale_quantity;
            $stock_stotal = $stock_values->sale_total_amount;
            $bal_s_qty = $stock_sqty + $sale_quantity;
            $bal_s_rate = $stock_stotal + $sale_total_price;
            $stock_oldvalues = $this->General_model->get_row($this->stock_table,'product_id_fk',$old_sproduct_id);
            $stock_qty = $stock_oldvalues->sale_quantity;
            $stock_total = $stock_oldvalues->sale_total_amount;
            $bal_so_qty = $stock_qty - $sale_quantity;
            $bal_so_rate = $stock_total - $sale_total_price;
            if($product_id){
               $stock_data = array(
                'sale_quantity'=> $bal_s_qty,
                'sale_total_amount' => $bal_s_rate,
                'updated_date' =>$date
                );
               $this->General_model->update($this->stock_table,$stock_data,'product_id_fk',$product_id);
               }
               $stock_olddata = array(
                'sale_quantity'=> $bal_so_qty,
                'sale_total_amount' => $bal_so_rate,
                'updated_date' =>$date
                );
               $this->General_model->update($this->stock_table,$stock_olddata,'product_id_fk',$old_sproduct_id);
            }
            $sale_date = array(
              'product_id_fk' => $product_id,
              'sale_quantity' =>$sale_quantity,
              'sale_price'=>$sale_price,
              'sale_discount'=>$sale_discount,
              'sale_total_price' => $sale_total_price,
              'tax_id_fk' => $tax_id_fk,
              'grand_total'=> $grand_total,
              'sale_remarks' => $sale_remarks
            );
            $data = $this->General_model->update($this->table,$sale_date,'sale_id',$sale_id);
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
    public function edit_basic(){
        $invoice_no = $this->input->post('invoice_no');
        
        $sale_date = str_replace('/', '-', $this->input->post('date'));
        $sale_date =  date("Y-m-d",strtotime($sale_date));
        $tax_id_fk = $this->input->post('tax_id_fk');
        $remarks = $this->input->post('remarks');
        $sale_data = $this->Sale_model->GetData($invoice_no);
        $count= count($sale_data);
        for($i=0;$i<$count;$i++){
            $sale_id = $sale_data[$i]->sale_id;
            $sale_update = array(
                            'sale_date' => $sale_date,
                            'tax_id_fk' =>$tax_id_fk,
                            'sale_remarks' =>$remarks
            );
            $data = $this->General_model->update($this->table,$sale_update,'sale_id',$sale_id);
        }
        if($data) {
            $response['text'] = 'Sale Details Updated successfully';
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
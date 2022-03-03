<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PurchaseReturns extends MY_Controller {
	public $table = 'purchase_return';
        public $purchase_table ='purchase_details';
        public $tax_table ='tax_class';
        public $stock_table ='stock_details';
         public $product_table ='product_details';
	public $page  = 'PurchaseReturn';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->load->model('General_model');
        $this->load->model('PurchaseReturn_model');
	}
	public function index()
	{
		$template['body'] = 'PurchaseReturn/list';
		$template['script'] = 'PurchaseReturn/script';
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('invoice_number', 'Number', 'required');
		if ($this->form_validation->run() == FALSE) {
                    $template['enquiry_type'] = $this->config->item('enquiry_type');
                    $template['body'] = 'PurchaseReturn/add';
                    $template['script'] = 'PurchaseReturn/script';
                    $this->load->view('template', $template);
		}
		else {
                        /*.... Exchange data ....*/
                    
                        $ex_productname = $this->input->post('ex_productname');
                        
                        $ex_productid = $this->input->post('ex_productid');
                        $ex_productquantity = $this->input->post('preturnpurchase_quantity');
                        $ex_productprice = $this->input->post('ex_productprice');
                        
                        $ex_productSalepize = $this->input->post('ex_productSalepize');
                        
                        
                        /*.... Exchange data Ends Here....*/
                        
                        $product_id=$this->input->post('product_id_fk');
                        $return_qtyamount=$this->input->post('return_qtyamount');
                        $purchase_id=$this->input->post('purchase_id_fk');
                        $invoice_number= $this->input->post('invoice_number');
                        $vendor_id = $this->input->post('vendor_id_fk');
                        $return_qty = $this->input->post('return_quantity');
                        $ex_total = $return_qty * $ex_productprice;
                        //print_r($ex_total);
                        //exit();
                        $purchase_qty = $this->input->post('preturnpurchase_quantity');
                        $return_reason = $this->input->post('return_reason');
                        $description = $this->input->post('reurn_description');
                        $return_date = str_replace('/', '-', $this->input->post('return_date'));
                        $return_date =  date("Y-m-d",strtotime($return_date));
                        
                                            $data = array(
						'product_id_fk' => $product_id,
						'purchase_id_fk' => $purchase_id,
						'invoice_no' => $invoice_number,
                                                'customer_id_fk' => $vendor_id,
                                                'return_qty' => $return_qty,
                                                'preturnpurchase_quantity' => $purchase_qty,
                                                'return_date' => $return_date,
                                                'return_reason' => $return_reason,
                                                'return_description' => $description,
                                                'return_status' => 1
                            
                                            );
                        $preturn_id = $this->input->post('preturn_id');
			if($preturn_id){
					 
                            $data['preturn_id'] = $preturn_id;
                            $template['return'] = $this->General_model->get_row($this->table,'preturn_id',$preturn_id);
                                $old_rqty = $template['return']->return_qty;
                            //print_r($old_rqty);
                            //
                            $template['purchase'] = $this->General_model->get_row($this->purchase_table,'purchase_id',$purchase_id);
                                $old_pqty = $template['purchase']->product_purchase_quantity;
                                $old_ptotal = $template['purchase']->purchase_total_price;
                                $old_pgrand_total = $template['purchase']->purchase_grandd_total;
                                $purchase_pprice = $template['purchase']->purchase_price;
                                $tax_id=$template['purchase']->tax_id_fk;
                            $tax['tax'] = $this->General_model->get_row($this->tax_table,'tax_id',$tax_id);
                                $tax_amount = $tax['tax']->tax_amount;
                            $stock['purchase'] = $this->General_model->get_row($this->stock_table,'product_id_fk',$product_id);
                                
                                    if($old_rqty < $return_qty){
                                        $purchase_qty = $old_pqty-($return_qty - $old_rqty);
                                        $total = $purchase_qty * $purchase_pprice;
                                        $grand_total = (($total*$tax_amount)/100)+$total;
                                        $s_bal_qty = $stock['purchase']->purchase_quantity + ($return_qty - $old_rqty);
                                        $s_bal_total = $stock['purchase']->purchase_total_amount - ($purchase_qty * $purchase_pprice);
                                    }
                                
                                    if($old_rqty > $return_qty){
                                        $purchase_qty = $old_pqty+($old_rqty - $return_qty);
                                        $total = $purchase_qty * $purchase_pprice;
                                        $grand_total = (($total*$tax_amount)/100)+$total;
                                        $s_bal_qty = $stock['purchase']->purchase_quantity + ($old_rqty - $return_qty);
                                        $s_bal_total = $stock['purchase']->purchase_total_amount - ($purchase_qty * $purchase_pprice);
                                    }
                                    //print_r($s_bal_qty);
                                   //exit();
                            $purchase_data = array('product_purchase_quantity' => $purchase_qty, // updating purchase table
                                                        'purchase_total_price' => $total,
                                                        'purchase_grandd_total' => $grand_total
                                                        );
                            $stock_data = array('purchase_quantity' => $s_bal_qty, // updating stock table
                                                    'purchase_total_amount ' => $s_bal_total
                                                    );
                            $result = $this->General_model->update($this->purchase_table,$purchase_data,'purchase_id',$purchase_id);
                            $result = $this->General_model->update($this->stock_table,$stock_data,'product_id_fk',$product_id);
                            $result = $this->General_model->update($this->table,$data,'preturn_id',$preturn_id);
                            //print_r($stock);
                            //exit();
                            $response_text = 'Category  updated successfully';
                        }
                        else{
                           /*.....Exchange Add Start Here...*/
                            
                            if($return_reason == 2) 
                            {
                                if($purchase_qty == $return_qty){
                                    $ex_total1 = $ex_productprice * $return_qty;
                                    $stockdata = $this->General_model->get_row($this->stock_table,'product_id_fk',$product_id);
                                    $purchase =  $this->General_model->get_row($this->purchase_table,'purchase_id',$purchase_id);
                                    $purchase_qty = $stockdata->purchase_quantity;
                                    $s_bal_qty = $purchase_qty - $ex_productquantity;
                                    $s_bal_pamount = $stockdata->purchase_total_amount - $purchase->purchase_total_price;
                                    $stockReduced = array('purchase_quantity' => $s_bal_qty,
                                                            'purchase_total_amount' =>$s_bal_pamount,
                                                            'updated_date' => date('Y-m-d h:i:sa'));
                                    $stockdata = $this->General_model->update($this->stock_table,$stockReduced,'product_id_fk',$product_id);
                                    print_r($stockdata);
                                    $newstockdata = $this->General_model->get_row($this->stock_table,'product_id_fk',$ex_productid);
                                    $sn_bal_qty = $newstockdata->purchase_quantity + $ex_productquantity;
                                    $sn_bal_pamount = $newstockdata->purchase_total_amount + $ex_total1;
                                    $stockAdded = array('purchase_quantity' => $sn_bal_qty,
                                                            'purchase_total_amount' =>$sn_bal_pamount,
                                                            'updated_date' => date('Y-m-d h:i:sa'));
                                    $stockdata1 = $this->General_model->update($this->stock_table,$stockAdded,'product_id_fk',$ex_productid);
                                    
                                    print_r($stockdata1);
                                    //exit();
                                    
                                    
                                    
                                    
                                    $purchaseupdate = array('product_id_fk' => $ex_productid, 
                                                    'product_purchase_quantity' => $ex_productquantity,
                                                    'purchase_price' => $ex_productprice,
                                                    'sale_price' => $ex_productSalepize,
                                                    'purchase_total_price' => $ex_total1,
                                                    'purchase_remarks' => 'Exchange',
                                                    'purchase_date' => date('Y-m-d')
                                                    );
                                    $this->General_model->update($this->purchase_table,$purchaseupdate,'purchase_id',$purchase_id);
                                    $result = $this->General_model->add($this->table,$data);
                                    //redirect('/purchase/invoice/'.$invoice_number.'/'.$vendor_id);
                                }
                                if($purchase_qty > $return_qty){
                                    $purchase =  $this->General_model->get_row($this->purchase_table,'purchase_id',$purchase_id);
                                    $ppurchase_qty = $purchase->product_purchase_quantity - $return_qty;
                                    
                                    $vendor_id= $purchase->vendor_id_fk;
                                    $tax_type = $purchase->tax_type;
                                    $tax_id_fk = $purchase->tax_id_fk;
                                    if($tax_type == 1){
                                        $tax = $this->PurchaseReturn_model->getTaxData($tax_id_fk);
                                        print_r($tax);
                                        $taxAmount = $tax->tax_amount;
                                        $p_grand_tot = $ex_total + ($ex_total * $taxAmount/100);
                                    }
                                    else{ 
                                        $p_grand_tot = $ex_total;
                                    }
                                    $ppurchase_total = $purchase->purchase_price * ($purchase_qty - $return_qty);
                                    $old_purchaseData = array('product_purchase_quantity' => $ppurchase_qty,
                                                                'purchase_total_price' =>$ppurchase_total);
                                    $this->General_model->update($this->purchase_table,$old_purchaseData,'purchase_id',$purchase_id);
                                    $newpurchase_data = array('product_id_fk' => $ex_productid,
                                                                'vendor_id_fk'=> $vendor_id,
                                                                'product_purchase_quantity'=>$return_qty,
                                                                'purchase_price' =>$ex_productprice,
                                                                'purchase_total_price'=>$ex_total,
                                                                'purchase_date'=>date('Y-m-d'),
                                                                'sale_price'=>$ex_productSalepize,
                                                                'purchase_remarks'=>'Exchanged Product',
                                                                'tax_type'=>$tax_type,
                                                                'tax_id_fk'=>$tax_id_fk,
                                                                'purchase_created_date' =>date('Y-m-d h:i:sa'),
                                                                'purchase_invoice_no'=>$invoice_number,
                                                                'purchase_grandd_total'=>$p_grand_tot,
                                                                'purchase_status' =>1);
                                    $result = $this->General_model->add($this->purchase_table,$newpurchase_data);
                                    $np_stockdata = $this->General_model->get_row($this->stock_table,'product_id_fk',$ex_productid);
                                    $np_s_qty = $np_stockdata->purchase_quantity + $return_qty;
                                    $np_s_tot = $np_stockdata->purchase_total_amount + $ex_total;
                                            $stocknew = array('purchase_quantity' => $np_s_qty,
                                                            'purchase_total_amount' =>$np_s_tot,
                                                            'updated_date' => date('Y-m-d h:i:sa'));
                                            
                                    $stockdata2 = $this->General_model->update($this->stock_table,$stocknew,'product_id_fk',$ex_productid);
                                    $old_stockdata = $this->General_model->get_row($this->stock_table,'product_id_fk',$product_id);
                                    $op_s_qty = $old_stockdata->purchase_quantity - $return_qty;
                                    $op_s_tot = $old_stockdata->purchase_total_amount - $ex_total;
                                    $stockold = array('purchase_quantity' => $np_s_qty,
                                                            'purchase_total_amount' =>$np_s_tot,
                                                            'updated_date' => date('Y-m-d h:i:sa'));
                                    $stockdataold = $this->General_model->update($this->stock_table,$stockold,'product_id_fk',$product_id);
                                    $result = $this->General_model->add($this->table,$data);
                                    redirect('/purchase/invoice/'.$invoice_number.'/'.$vendor_id);
                                            //print_r($newpurchase_data);
                                    //print_r($stocknew);
                                    exit();
                                    
                                }
                                
//                                
                                //$this->General_model->update($this->purchase_table,$purchaseupdate,'purchase_id',$purchase_id);
                                //$this->General_model->update($this->stock_table,$stockupdate,'product_id_fk',$product_id);
                                //$this->General_model->update($this->stock_table,$newstockupdate,'product_id_fk',$ex_productid);
                                //redirect('/purchase/invoice/'.$invoice_number.'/'.$vendor_id);
                            }
                            
                            /*.....Exchange Add Ends Here...*/
                           else {  
                                $template['purchase'] = $this->General_model->get_row($this->purchase_table,'purchase_id',$purchase_id);
                                $tax_id=$template['purchase']->tax_id_fk;
                                $tax['tax'] = $this->General_model->get_row($this->tax_table,'tax_id',$tax_id);
                                $tax_amount = $tax['tax']->tax_amount;
                                $balance_qty = $template['purchase']->product_purchase_quantity - $return_qty;
                                $balance_total = $balance_qty * $template['purchase']->purchase_price;
                                $grand_total = (($balance_total * $tax_amount)/100)+$balance_total;
                                if($purchase_qty == $return_qty){
                                    $purchase_data = array('purchase_status'=>0);
                                }
                                else if ($purchase_qty >= $return_qty){
                                    $purchase_data = array('product_purchase_quantity' => $balance_qty,
                                                            'purchase_total_price' => $balance_total,
                                                            'purchase_grandd_total' => $grand_total
                                                            );
                                }
                                $result = $this->General_model->update($this->purchase_table,$purchase_data,'purchase_id',$purchase_id);
                                $stock['purchase'] = $this->General_model->get_row($this->stock_table,'product_id_fk',$product_id);
                                $s_bal_qty = $stock['purchase']->purchase_quantity - $return_qty;
                                $s_bal_total = $stock['purchase']->purchase_total_amount - ($return_qty * $template['purchase']->purchase_price);
                                    $stock_data = array('purchase_quantity' => $s_bal_qty,
                                                        'purchase_total_amount ' => $s_bal_total
                                                        );
                                $result = $this->General_model->update($this->stock_table,$stock_data,'product_id_fk',$product_id);

                               $result = $this->General_model->add($this->table,$data);
                                $response_text = 'Return Details added  successfully';
                           }
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
	public function get(){
        $this->load->model('PurchaseReturn_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
        $param['invoice_no'] =(isset($_REQUEST['invoice_no']))?$_REQUEST['invoice_no']:'';
        $param['product_name'] =(isset($_REQUEST['product_name']))?$_REQUEST['product_name']:'';
        $param['return_reason'] =(isset($_REQUEST['return_reason']))?$_REQUEST['return_reason']:'';
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
        
    	$data = $this->PurchaseReturn_model->getPurchasereturnTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function delete(){
        $preturn_id = $this->input->post('preturn_id');
        $updateData = array('return_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'preturn_id',$preturn_id);
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
	public function edit($preturn_id){
		$template['body'] = 'PurchaseReturn/add';
		$template['script'] = 'PurchaseReturn/script';
		$template['records'] = $this->General_model->get_row($this->table,'preturn_id',$preturn_id);
                $product_id = $template['records']->product_id_fk;
                $template['product'] = $this->General_model->get_row($this->product_table,'product_id',$product_id);
                $return_date = str_replace('-', '/', $template['records']->return_date);
                $template['records']->return_date =  date("d/m/Y",strtotime($return_date));
    	$this->load->view('template', $template);
		//print_r($template);
		//exit();
		
	}
}
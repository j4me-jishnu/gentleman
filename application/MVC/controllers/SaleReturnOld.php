<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SaleReturn extends MY_Controller {
	public $table = 'sale_return';
        public $sale_table ='sale_details';
        public $tax_table ='tax_class';
        public $stock_table ='stock_details';
         public $product_table ='product_details';
	public $page  = 'SaleReturn';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->load->model('General_model');
	}
	public function index()
	{
		$template['body'] = 'SaleReturn/list';
		$template['script'] = 'SaleReturn/script';
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('invoice_number', 'Number', 'required');
		if ($this->form_validation->run() == FALSE) {
                    $template['body'] = 'SaleReturn/add';
                    $template['script'] = 'SaleReturn/script';
                    $this->load->view('template', $template);
		}
		else {
                    
                        /*.... Exchange data ....*/
                    
                        $ex_productname = $this->input->post('ex_productname');
                        $ex_productid = $this->input->post('ex_productid');
                        $ex_productquantity = $this->input->post('ex_productquantity');
                        $ex_productprice = $this->input->post('ex_productprice');
                        $ex_productdisc = $this->input->post('ex_productdisc');
                        $ex_total = $this->input->post('ex_total');
                        
                        /*.... Exchange data Ends Here....*/
                        
                        $product_id=$this->input->post('product_id_fk');
                        $return_qtyamount=$this->input->post('return_qtyamount');
                        $sale_id_fk=$this->input->post('sale_id_fk');
                        $invoice_number= $this->input->post('invoice_number');
                        $return_qty = $this->input->post('return_qty');
                        $sreturn_qty = $this->input->post('sreturn_qty');
                        $return_reason = $this->input->post('return_reason');
                        $description = $this->input->post('return_description');
                        $return_date = str_replace('/', '-', $this->input->post('return_date'));
                        $return_date =  date("Y-m-d",strtotime($return_date));
                        $template['sale'] = $this->General_model->get_row($this->sale_table,'sale_id',$sale_id_fk);
                        $customer_details = $template['sale']->cust_details;
                                            $data = array(
						'product_id_fk' => $product_id,
						'sale_id_fk' => $sale_id_fk,
						'invoice_no' => $invoice_number,
                                                'return_qty' => $return_qty,
                                                'sreturn_qty' => $sreturn_qty,
                                                'return_date' => $return_date,
                                                'return_reason' => $return_reason,
                                                'return_description' => $description,
                                                'return_status' => 1
                            
                                            );
                        $sreturn_id = $this->input->post('sreturn_id');
			if($sreturn_id){
					 
                            $data['sreturn_id'] = $sreturn_id;
                            $template['return'] = $this->General_model->get_row($this->table,'sreturn_id',$sreturn_id);
                                $old_rqty = $template['return']->return_qty;
                            //print_r($old_rqty);
                           //exit();
                            $template['sale'] = $this->General_model->get_row($this->sale_table,'sale_id',$sale_id_fk);
                                $old_sqty = $template['sale']->sale_quantity;
                                $old_stotal = $template['sale']->sale_total_price;
                                $old_sgrand_total = $template['sale']->grand_total;
                                $sale_price = $template['sale']->sale_price;
                                $tax_id=$template['sale']->tax_id_fk;
                            $tax['tax'] = $this->General_model->get_row($this->tax_table,'tax_id',$tax_id);
                                $tax_amount = $tax['tax']->tax_amount;
                            $stock['sale'] = $this->General_model->get_row($this->stock_table,'product_id_fk',$product_id);
                                
                                    if($old_rqty < $return_qty){
                                        $sale_qty = $old_sqty-($return_qty - $old_rqty);
                                        //print_r($sale_qty);
                                        //exit();
                                        $total = $sale_qty * $sale_price;
                                        $grand_total = (($total*$tax_amount)/100)+$total;
                                        $s_bal_qty = $stock['sale']->sale_quantity + ($return_qty - $old_rqty);
                                        $s_bal_total = $stock['sale']->sale_total_amount - ($sale_qty * $sale_price);
                                    }
                                
                                    if($old_rqty > $return_qty){
                                        $sale_qty = $old_pqty+($old_rqty - $return_qty);
                                        $total = $sale_qty * $sale_price;
                                        $grand_total = (($total*$tax_amount)/100)+$total;
                                        $s_bal_qty = $stock['sale']->sale_quantity + ($old_rqty - $return_qty);
                                        $s_bal_total = $stock['sale']->sale_total_amount - ($sale_qty * $sale_price);
                                    }
                                    //print_r($s_bal_qty);
                                   //exit();
                            $sale_data = array('sale_quantity' => $purchase_qty, // updating purchase table
                                                        'sale_total_price' => $total,
                                                        'grand_total' => $grand_total
                                                        );
                            $stock_data = array('sale_quantity' => $s_bal_qty, // updating stock table
                                                    'sale_total_amount ' => $s_bal_total
                                                    );
                            $result = $this->General_model->update($this->sale_table,$sale_data,'sale_id',$sale_id_fk);
                            $result = $this->General_model->update($this->stock_table,$stock_data,'product_id_fk',$product_id);
                            $result = $this->General_model->update($this->table,$data,'sreturn_id',$sreturn_id);
                            //print_r($stock);
                            //exit();
                            $response_text = 'Category  updated successfully';
                        }
                        else{
                            /*.....Exchange Add Start Here...*/
                            
                            if($return_reason == 2) 
                            {
                                $saleupdate = array('product_id_fk' => $ex_productid, 
                                                    'sale_quantity' => $ex_productquantity,
                                                    'sale_price' => $ex_productprice,
                                                    'sale_discount' => $ex_productdisc,
                                                    'sale_total_price' => $ex_total,
                                                    'sale_remarks' => 'Exchange',
                                                    'sale_date' => date('Y-m-d'),
                                                    'sale_created_date' => date('Y-m-d h:i:sa')
                                                    );
                                $stockdata = $this->General_model->get_row($this->stock_table,'product_id_fk',$product_id);
                                $newstockdata = $this->General_model->get_row($this->stock_table,'product_id_fk',$ex_productid);
                                if(isset($stockdata->sale_quantity))
                                {
                                    $salequantity = $stockdata->sale_quantity;
                                    $sale_total_amount = $stockdata->sale_total_amount;
                                    $salequantity = $salequantity + $return_qty; 
                                    $sale_total_amount = $sale_total_amount - $return_qtyamount;
                                    $stockupdate = array('sale_quantity' => $salequantity, 
                                                    'sale_total_amount' => $sale_total_amount
                                                    );
                                }
                                if(isset($newstockdata->sale_quantity))
                                {
                                    $exsalequantity = $stockdata->sale_quantity;
                                    $exsale_total_amount = $stockdata->sale_total_amount;
                                    $exsalequantity = $exsalequantity - $ex_productquantity; 
                                    $exsale_total_amount = $exsale_total_amount + $ex_total;
                                    $newstockupdate = array('sale_quantity' => $exsalequantity, 
                                                    'sale_total_amount' => $exsale_total_amount
                                                    );
                                }
//                                
                                $this->General_model->update($this->sale_table,$saleupdate,'sale_id',$sale_id_fk);
                                $this->General_model->update($this->stock_table,$stockupdate,'product_id_fk',$product_id);
                                $this->General_model->update($this->stock_table,$newstockupdate,'product_id_fk',$ex_productid);
                                redirect('/sale/invoice/'.$customer_details);
                            }
                            
                            /*.....Exchange Add Ends Here...*/
                            
                            $template['sale'] = $this->General_model->get_row($this->sale_table,'sale_id',$sale_id_fk);
                            $tax_id=$template['sale']->tax_id_fk;
                            $tax['tax'] = $this->General_model->get_row($this->tax_table,'tax_id',$tax_id);
                            
                            $tax_amount = $tax['tax']->tax_amount;
                            $balance_qty = $template['sale']->sale_quantity - $return_qty;
                            $balance_total = $balance_qty * $template['sale']->sale_price;
                            $grand_total = (($balance_total * $tax_amount)/100)+$balance_total;
                            print_r($grand_total);
                           //exit();
                            if($sreturn_qty == $return_qty){
                                $sale_data = array('sale_status'=>0);
                            }
                            else if ($sreturn_qty >= $return_qty){
                                $sale_data = array('sale_quantity' => $balance_qty,
                                                        'sale_total_price' => $balance_total,
                                                        'grand_total' => $grand_total
                                                        );
                            }
                            $result = $this->General_model->update($this->sale_table,$sale_data,'sale_id',$sale_id_fk);
                            $stock['sale'] = $this->General_model->get_row($this->stock_table,'product_id_fk',$product_id);
                            $s_bal_qty = $stock['sale']->sale_quantity - $return_qty;
                            $s_bal_total = $stock['sale']->sale_total_amount - ($return_qty * $template['sale']->sale_price);
                                $stock_data = array('sale_quantity' => $s_bal_qty,
                                                    'sale_total_amount ' => $s_bal_total
                                                    );
                            $result = $this->General_model->update($this->stock_table,$stock_data,'product_id_fk',$product_id);
                            
                           $result = $this->General_model->add($this->table,$data);
                            $response_text = 'Return Details added  successfully';
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
	public function get(){
        $this->load->model('SaleReturn_model');
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
        
    	$data = $this->SaleReturn_model->getSaleReturnTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function delete(){
        $sreturn_id = $this->input->post('sreturn_id');
        $updateData = array('return_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'sreturn_id',$sreturn_id);
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
	public function edit($sreturn_id){
		$template['body'] = 'SaleReturn/add';
		$template['script'] = 'SaleReturn/script';
		$template['records'] = $this->General_model->get_row($this->table,'sreturn_id',$sreturn_id);
                $product_id = $template['records']->product_id_fk;
                $template['product'] = $this->General_model->get_row($this->product_table,'product_id',$product_id);
                $return_date = str_replace('-', '/', $template['records']->return_date);
                $template['records']->return_date =  date("d/m/Y",strtotime($return_date));
    	$this->load->view('template', $template);
		//print_r($template);
		//exit();
		
	}
}


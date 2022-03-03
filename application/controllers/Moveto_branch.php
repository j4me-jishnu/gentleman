<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Moveto_branch extends MY_Controller {
	public $table = 'tbl_branch_stock';
	public $tbl_narration = 'tbl_narration-branchreject';
	public $tbl_stock = 'tbl_stock';
	public $tbl_stockup = 'tbl_stockup'; 
	public $tableshopstock = 'tbl_shopstock';
	public $page  = 'purchaserequest';
	public function __construct() {
		parent::__construct();
       if(! $this->is_logged_in()){
            redirect('/login');
        }
        $this->load->library('email');
        $this->load->model('General_model');
		$this->load->model('Purchase_model');
		$this->load->model('Apurchase_model');
		$this->load->model('Vendor_model');
		$this->load->model('Moveto_branch_model');
		$this->load->model('Request_Br_to_br_model');
		$this->load->model('Branchstock_model');
       
	}
	public function index()
	{
		$template['body'] = 'Moveto_branch/list';
		$template['script'] = 'Moveto_branch/script';
		$this->load->view('template', $template);
	}
	public function add(){
		
		$this->form_validation->set_rules('vendor_id', 'Number', 'required');
		if ($this->form_validation->run() == FALSE) {
			//$template['refno'] = $this->Apurchase_model->Refno();
			//$branch_id = $template['refno'][0]->branch_id;
			//$template['brmname'] = $this->Apurchase_model->brmname($branch_id);
			$template['body'] = 'APurchase/add';
			$template['script'] = 'APurchase/script';
			$template['vendor_names'] = $this->Vendor_model->view_by();
			$this->load->view('template', $template);
		}
		else {

				$this->load->helper('string');
				$ref = random_string('alnum',5);
				$temp =count($this->input->post('item_id_fk'));
				$item_id_fk = $this->input->post('item_id_fk');
				$item_name = $this->input->post('item_name');
				$item_quantity = $this->input->post('item_quantity');
				$item_price = $this->input->post('item_price');
				$branch_id = 0;
				$billno =$this->input->post('purchase_invoice_number');
				$vendor_id =$this->input->post('vendor_id');
				$ref_number = $this->input->post('ref_number');
				$item_total_price = $this->input->post('item_total_price');
				$item_tax = $this->input->post('item_tax');
				$net_total = $this->input->post('net_total');
				$item_date = str_replace('/', '-', $this->input->post('purchase_date'));
				$item_date =  date("Y-m-d",strtotime($item_date));
				$edit_ref = $this->input->post('edit_ref');
				//var_dump($temp);

				if($edit_ref)
				{
					
					for($i=1;$i<$temp;$i++)
					{
						$up_data = array(
							'item_date'=>$item_date,
							'item_id_fk' => $item_id_fk[$i],
							'item_name' =>$item_name[$i],
							'item_quantity' => $item_quantity[$i],
							'item_price' => $item_price[$i],
							'taxamount'=>$item_tax[$i],
							'item_total'=>$item_total_price[$i],
							'grand_total'=>$net_total,
							'remark'=>'null'
						);
						$prid = $this->Apurchase_model->getPrid($item_id_fk[$i],$edit_ref);	
						if(isset($prid[0]->pr_id))
						{
							$pr_id = $prid[0]->pr_id;
							var_dump('present');
						}

						if(isset($pr_id)){
						$this->General_model->update($this->table,$up_data,'pr_id',$pr_id); 
						}
					}
					$items = $this->Apurchase_model->getItemid($edit_ref);
					//var_dump($items);
					
					if( count($items)+1 > $temp)
					{	//var_dump('heloo');
						$z = array();
						for($i=0;$i<count($items);$i++)
						{
							$z[$i] = $items[$i]->item_id_fk;
						}
						unset($item_id_fk[0]);
						$result = array_diff($z, $item_id_fk);
						//var_dump($result);
						for($i=0;$i<$temp;$i++)
						{
							if(isset($result[$i])){
							$item = $this->Apurchase_model->getItem($result[$i],$edit_ref);
							$total = $item[0]->item_total;
							$grand = $item[0]->grand_total;
							$pr_id = $item[0]->pr_id;
							$new_grand =  $grand - $total;
							$stat_data = array( 'pr_status'=>0);
							$grad_data = array( 'grand_total'=>$new_grand);
							$this->General_model->update($this->table,$stat_data,'pr_id',$pr_id);
							$this->General_model->update($this->table,$grad_data,'ref_number',$edit_ref);
							} 
						}
						
						redirect('/Apurchaserequest/edit/'.$edit_ref.'/'.$branch_id);
					}
					else if( count($items)+1 <= $temp)
					{
						//var_dump('haii');
						$z = array();
						for($i=0;$i<count($items);$i++)
						{
							$z[$i] = $items[$i]->item_id_fk;
						}
						unset($item_id_fk[0]);
						$result = array_diff($item_id_fk, $z);
						for($i=0;$i<$temp;$i++)
						{ //var_dump("heloo");
							if(isset($result[$i])){

								$data = array(
								'item_date'=>$item_date,
								'ref_number'=>$edit_ref,
								'invoice_no'=>$billno,
								'vendor_id_fk'=>$vendor_id,
								'branch_id_fk'=>0,
								'item_id_fk' => $item_id_fk[$i],
								'item_name' =>$item_name[$i],
								'item_quantity' => $item_quantity[$i],
								'item_price' => $item_price[$i],
								'taxamount'=>$item_tax[$i],
								'item_total'=>$item_total_price[$i],
								'grand_total'=>$net_total,
								'cc' => 0,
								'brm' =>1,
								'cm' => 1,
								'fm' => 1,
								'agm' => 2,
								'pm' => 1,
								'delivery'=>0,
								'finaldelivery'=>1,
								'remark'=>'remark',
								'order_file'=>'',
								'pr_status' => 1
								);
								var_dump($data);
								$this->Apurchase_model->updateRequest($data,$edit_ref);
							} 
							$grad_data = array( 'grand_total'=>$net_total);
							$this->General_model->update($this->table,$grad_data,'ref_number',$edit_ref);
						}
						
						//redirect('/Apurchaserequest/edit/'.$edit_ref.'/'.$branch_id);
					}
					
					redirect('/Apurchaserequest');
				}
				else{
					for($i=1;$i<$temp;$i++){
					$data = array(
							'item_date'=>$item_date,
							'ref_number'=>"GENTLEMAN-$ref",
							'invoice_no'=>$billno,
							'vendor_id_fk'=>$vendor_id,
							'branch_id_fk'=>$branch_id,
							'item_id_fk' => $item_id_fk[$i],
							'item_name' =>$item_name[$i],
							'item_quantity' => $item_quantity[$i],
							'item_price' => $item_price[$i],
							'taxamount'=>$item_tax[$i],
							'item_total'=>$item_total_price[$i],
							'grand_total'=>$net_total,
							'cc' => 0,
							'brm' =>1,
							'cm' => 1,
							'fm' => 1,
							'agm' => 2,
							'pm' => 1,
							'delivery'=>0,
							'finaldelivery'=>1,
							'remark'=>'Null',
							'order_file'=>'',
							'pr_status' => 1
						);
					$result = $this->General_model->add($this->table,$data);
					$response_text = 'Request added  successfully';
					
					if($result){
					$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
					}
					else{
					$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
					}
					}
					redirect('/Apurchaserequest/', 'refresh');
				}
		}
	}
	public function get(){
		$this->load->model('Apurchase_model');
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->Apurchase_model->getPurchaseTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function get_head(){
		$this->load->model('Moveto_branch_model');
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->Moveto_branch_model->getPurchaseTable_head($param);
    	$id = $this->session->userdata('id');
    	$_data = $this->Moveto_branch_model->getNextAproval($id);
    	$_status = $this->Moveto_branch_model->getStatus();
    	for($i = 0;$i<count($data['data']);$i++)
    	{
    		$pstatus = 2;
    		$rstatus = 2;
    		for($j = 0;$j<count($_data);$j++)
    		{
    			if($data['data'][$i]->issue_id == $_data[$j]->issue_id_fk)
    			{
    				$pstatus = $_data[$j]->is_approved;
    				$rstatus = $_data[$j]->reject;
    				break;
    			}
    		}
    		$data['data'][$i]->is_pending = $pstatus;
    		$data['data'][$i]->is_reject = $rstatus;
    	}

    	for($i = 0;$i<count($data['data']);$i++)
    	{
    		$approve = 1;
    		$reject = 0;
    		for($j = 0;$j<count($_status);$j++)
    		{
    			 	
    			if($data['data'][$i]->issue_id == $_status[$j]->issue_id_fk)
    			{
    				$approve = $_status[$j]->approved;
    				$reject = $_status[$j]->reject;
    				$des = $_status[$j]->des_name;
    				break;
    			}
    		}
    		$data['data'][$i]->approved = $approve;
    		$data['data'][$i]->newreject = $reject;
    		//$data['data'][$i]->des_name = $des;
    	}
    	for($i=0;$i<count($data['data']);$i++)
			{

				$itemnamenew=$this->Branchstock_model->get_branch_name($data['data'][$i]->item_id_fk);
				$data['data'][$i]->itemnamenew=$itemnamenew->item_name;

			}
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function purchaserequest(){
		$this->load->model('Apurchase_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->Apurchase_model->getPurchaseTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function aprove()
	{
		$id = $this->session->userdata('id');
		$issue_id = $this->input->post('issue_id');
		$result = $this->Moveto_branch_model->updateApprovel($issue_id,$id);
		if($result) {
			
            $response['text'] = 'updated successfully';
            $response['type'] = 'success';
        }
        else{
            $response['text'] = 'Something went wrong';
            $response['type'] = 'error';
        }
        $data_json = json_encode($response);
        echo $data_json;
	}
	
	public function reject()
	{
		$issue_id = $this->input->post('issue_id');
		$data=array('com'=>4,'agm'=>3,'reject'=>1,'delivery'=>0); 
		
		$result = $this->Moveto_branch_model->updateStatus($this->table,$data,'issue_id',$issue_id);

		$id = $this->session->userdata('id');
		$issue_id = $this->input->post('issue_id');
		$result = $this->Moveto_branch_model->updateReject($issue_id,$id);
		if($result) {
            $response['text'] = 'updated successfully';
            $response['type'] = 'success';
        }
        else{
            $response['text'] = 'Something went wrong';
            $response['type'] = 'error';
        }
        $data_json = json_encode($response);
        echo $data_json;
	}
	public function viewnarration()
	{
		$id = $this->input->post('id');
		$data=$this->Moveto_branch_model->get_narration($id);
		echo json_encode($data);
	}
	public function view($ref_number,$br){
		$template['record'] = $this->Apurchase_model->viewInvoice($ref_number);
		
		$template['branch'] = $this->Apurchase_model->viewBranch($br);
		$template['body'] = 'APurchase/view';
        $template['script'] = 'APurchase/script';
        $this->load->view('template',$template);
    }
	public function addtoBranch($id){
		$date1 = date('Y-m-d');
		$data = $this->Moveto_branch_model->getRow($id);
		$item_id = $data[0]->item_id_fk;
		$data1 = array(
			'shop_id_fk' =>$data[0]->shop_id_fk,
			'item_id_fk' =>$data[0]->item_id_fk,
			'item_quantity' =>$data[0]->item_quantity,
			'used_quantity' =>$data[0]->used_quantity,
			'updated_date' =>$date1,
			'status' =>1
		 );
		$datas = array('com' =>0,'agm' =>0,'delivery' =>1 );

	   $data_issue = array(
		   
		"user_id_fk" => $this->session->userdata('id'),
		"item_id_fk" => $data[0]->item_id_fk,
		"branch_id_fk" => $data[0]->shop_id_fk,
		"issue_quantity" =>$data[0]->item_quantity,
		"issue_date" => $date1,
		"issue_status" => 1,
        "master_status"=>1
	   );
	   $this->General_model->add('tbl_issueitem',$data_issue);
		$k = $this->General_model->add($this->tableshopstock,$data1);
		$c = $this->General_model->update($this->table,$datas,'issue_id',$id);
		$result = $this->Moveto_branch_model->getMasterStock($item_id);
		$iqty = $result[0] ->remaining_qty;
		$irop = $result[0] ->master_rop;
		$iname= $result[0] ->item_name;
		$admin= $this->Request_Br_to_br_model->getAdmin();
		$Frommail = $this->General_model->getMail();
		if(isset($Frommail[0]->email)){
		$from_mail = $Frommail[0]->email;
		if($iqty < $irop)
		{
				
			   $super_user = $this->General_model->getSuperUsers();
			   for($j = 0;$j<count($super_user);$j++)
			   {

				   	$udata = $this->General_model->getSuMail($super_user[$j]->id);
					$useremail = $udata[0]->user_email;
					$message ="item moved to branch";
					//var_dump($useremail);
					$this->email->from($from_mail); 
					$this->email->to($useremail);
					$this->email->subject('Stock Balance ');
					$this->email->message($message);
					$this->email->set_newline("\r\n");
					if($this->email->send())
					{
					
					}
					else
					{
					 //show_error($this->email->print_debugger());
					}

				   }
				
				$admin= $this->Request_Br_to_br_model->getAdmin();
				$this->email->from($from_mail); 
				$this->email->to($admin[0]->user_email);
				$this->email->subject('Stock balance');
				$this->email->message($message);
				$this->email->set_newline("\r\n");
				if($this->email->send())
				{
				
				}
				else
				{
				
				}
		}
	}
			redirect('/Moveto_branch/', 'refresh');
	}



	function get_operator(){

		$issue_id = $this->input->post('issue_id');
		
		 
		$data = $this->Moveto_branch_model->get_operator($issue_id);
	   
//echo $data[0]->user_name;
		echo json_encode($data[0]->user_name);
   }

   function delete(){

	  $issue_id = $this->input->post('issue_id');
	  
	  $this->General_model->delete('tbl_branch_stock','issue_id',$issue_id);
	  $response['text'] = 'Deleted successfully';
	  $response['type'] = 'success';
	  echo json_encode($response);

   }
	
}

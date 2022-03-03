<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Purchaserequest extends MY_Controller {
	public $table = 'tbl_purchase';
	public $tbl_narration = 'tbl_narration-reject';
	public $tbl_stock = 'tbl_stock';
	public $tbl_stockup = 'tbl_stockup'; 
	public $page  = 'purchaserequest';
	public function __construct() {
		parent::__construct();
       if(! $this->is_logged_in()){
            redirect('/login');
        }
        
        $this->load->model('General_model');
		$this->load->model('Purchase_model');
       
	}
	public function index()
	{
		$template['refno'] = $this->Purchase_model->Refno();
		$branch_id = $template['refno'][0]->branch_id;
		$template['is_head'] = $this->Purchase_model->is_head($branch_id);
		$template['body'] = 'Purchase/list';
		$template['script'] = 'Purchase/script';
		$this->load->view('template', $template);
	}
	public function add(){
		
		$this->form_validation->set_rules('ref_number', 'Number', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['refno'] = $this->Purchase_model->Refno();
			$branch_id = $template['refno'][0]->branch_id;
			$template['brmname'] = $this->Purchase_model->brmname($branch_id);
			$template['body'] = 'Purchase/add';
			$template['script'] = 'Purchase/script';
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
				$branch_id = $this->input->post('branch_id');
				$ref_number = $this->input->post('ref_number');
				$remark = $this->input->post('branch_remark');
				$item_total_price = $this->input->post('item_total_price');
				$item_tax = $this->input->post('item_tax');
				$net_total = $this->input->post('net_total');
				$item_date = str_replace('/', '-', $this->input->post('item_date'));
				$item_date =  date("Y-m-d",strtotime($item_date));
				$edit_ref = $this->input->post('edit_ref');
				if($edit_ref)
				{
					for($i=1;$i<$temp;$i++){
					$up_data = array(
							'item_date'=>$item_date,
							'item_id_fk' => $item_id_fk[$i],
							'item_name' =>$item_name[$i],
							'item_quantity' => $item_quantity[$i],
							'item_price' => $item_price[$i],
							'taxamount'=>$item_tax[$i],
							'item_total'=>$item_total_price[$i],
							'grand_total'=>$net_total,
							'remark'=>$remark
						);
						$prid = $this->Purchase_model->getPrid($item_id_fk[$i],$edit_ref);	
						$pr_id = $prid[0]->pr_id;
						if(isset($pr_id)){
						$this->General_model->update($this->table,$up_data,'pr_id',$pr_id); 
						}
					}
					$items = $this->Purchase_model->getItemid($edit_ref);
					
					if( count($items)+1 > $temp)
					{
						$z = array();
						for($i=0;$i<count($items);$i++)
						{
							$z[$i] = $items[$i]->item_id_fk;
						}
						unset($item_id_fk[0]);
						$result = array_diff($z, $item_id_fk);
						for($i=0;$i<$temp;$i++)
						{
							if(isset($result[$i])){
							$item = $this->Purchase_model->getItem($result[$i],$edit_ref);
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
						redirect('/purchaserequest/edit/'.$edit_ref.'/'.$branch_id);
					}
					else if( count($items)+1 < $temp)
					{
						$z = array();
						for($i=0;$i<count($items);$i++)
						{
							$z[$i] = $items[$i]->item_id_fk;
						}
						unset($item_id_fk[0]);
						$result = array_diff($item_id_fk, $z);
						for($i=0;$i<$temp;$i++)
						{
							if(isset($result[$i])){
								$data = array(
								'item_date'=>$item_date,
								'ref_number'=>$edit_ref,
								'branch_id_fk'=>$branch_id,
								'item_id_fk' => $item_id_fk[$i],
								'item_name' =>$item_name[$i],
								'item_quantity' => $item_quantity[$i],
								'item_price' => $item_price[$i],
								'taxamount'=>$item_tax[$i],
								'item_total'=>$item_total_price[$i],
								'grand_total'=>$net_total,
								'cc' => 0,
								'brm' =>2,
								'cm' => 1,
								'fm' => 1,
								'agm' => 1,
								'pm' => 1,
								'delivery'=>0,
								'finaldelivery'=>1,
								'remark'=>$remark,
								'order_file'=>'',
								'pr_status' => 1
								);
								$this->General_model->add($this->table,$data);
							} 
							$grad_data = array( 'grand_total'=>$net_total);
							$this->General_model->update($this->table,$grad_data,'ref_number',$edit_ref);
						}
						redirect('/purchaserequest/edit/'.$edit_ref.'/'.$branch_id);
					}
					redirect('/purchaserequest/edit/'.$edit_ref.'/'.$branch_id);
				}
				else{
					for($i=1;$i<$temp;$i++){
					$data = array(
							'item_date'=>$item_date,
							'ref_number'=>"$ref_number-$ref",
							'branch_id_fk'=>$branch_id,
							'item_id_fk' => $item_id_fk[$i],
							'item_name' =>$item_name[$i],
							'item_quantity' => $item_quantity[$i],
							'item_price' => $item_price[$i],
							'taxamount'=>$item_tax[$i],
							'item_total'=>$item_total_price[$i],
							'grand_total'=>$net_total,
							'cc' => 0,
							'brm' =>2,
							'cm' => 1,
							'fm' => 1,
							'agm' => 1,
							'pm' => 1,
							'delivery'=>0,
							'finaldelivery'=>1,
							'remark'=>$remark,
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
					//redirect('/purchaserequest/', 'refresh');
				}
		}
	}
	public function get(){
		$this->load->model('Purchase_model');
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->Purchase_model->getPurchaseTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function get_head(){
		$this->load->model('Purchase_model');
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->Purchase_model->getPurchaseTable_head($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function purchaserequest(){
		$this->load->model('Purchase_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->Purchase_model->getPurchaseTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function aprove()
	{
		$refno = $this->input->post('refno');
		$branch_id_fk = $this->input->post('branch_id_fk');
		$designation = $this->input->post('designation');
		$items = $this->Purchase_model->get_items($refno);
		$file_date = date('Y-m-d'); $date = date('d/m/Y');
		$file_name = $refno.$file_date.".pdf";
		if($designation == 5)
		{
			$this->load->library('Pdf');
			$this->pdf->setPrintHeader(false);
			$this->pdf->setPrintFooter(false);
			$this->pdf->AddPage();
			$this->pdf->SetFont('helvetica', 'B', 13);
			$this->pdf->writeHTMLCell(0, 0, '', 5, 'Ph:0484-2522364', 0, 1, 0, true, 'R', true);
			$this->pdf->SetFont('times', 'B', 24);
			$this->pdf->writeHTMLCell(200, 0, '', 14, 'GENTLEMAN CHITS FUNDS', 0, 1, 0, true, 'C', true);
			$this->pdf->SetFont('times', 'B', 13);
			$this->pdf->writeHTMLCell(200, 0, '', '', 'GENTLEMAN APARTMENT, 1ST FLOOR, MARKET ROAD, KOTTAYAM, DIST, KERALA', 0, 1, 0, true, 'C', true);
			$this->pdf->writeHTMLCell(225, 0, -10, 40, '--------------------------------------------------------------------------------------------------------------------------------------------------', 0, 1, 0, true, 'C', true);
			$this->pdf->SetFont('times', 'B', 13);
			$this->pdf->writeHTMLCell(0, 0, '', 50, 'REFNO:'.$refno, 0, 1, 0, true, 'L', true);
			$this->pdf->writeHTMLCell(0, 0, '', 50, 'Date.'.$date, 0, 1, 0, true, 'R', true);
			$this->pdf->SetFont('times', 'U', 15);
			$this->pdf->writeHTMLCell(0, 0, '', 70, 'PURCHASE ORDER', 0, 1, 0, true, 'C', true);
			$this->pdf->SetFont('times', '', 15);
			$this->pdf->setCellHeightRatio(1.25);
			$this->pdf->writeHTMLCell(0, 0, 20, 80, 'Purchase order from gentleman chity funds generated by purchase manager.Following items are requested from ....... branch', 0, 1, 0, true, 'C', true);
			$html = '<table border="1">
			<tr>
              <th align="Center">Particulars</th>
              <th align="Center">Quantity</th>
              <th align="Center">Price</th>
			  <th align="Center">Tax</th>
              <th align="Center">NetAmount</th>
			</tr>';
			 foreach($items as $key){
				 $html .= '<tr>
							  <td align="Center">'.$key->item_name.'</td>
							  <td align="Center">'.$key->item_quantity.'</td>
							  <td align="Center">'.$key->item_price.'</td>
							  <td align="Center">'.$key->taxamount.'</td>
							  <td align="Center">'.$key->item_total.'</td>
						   </tr>';
			  }
			$html .= '</table>';
			$this->pdf->writeHTMLCell(0, 0, 20, 100, $html);
			$this->pdf->SetFont('times', '', 15);
			$this->pdf->writeHTMLCell(0, 0, 20, 205, 'Place: Thalayolaparambu', 0, 1, 0, true, '', true);
			$this->pdf->writeHTMLCell(0, 0, 20, 213, 'Date:'.$date, 0, 1, 0, true, '', true);
			$this->pdf->writeHTMLCell(0, 0, 20, 223, 'Parchase Manager', 0, 1, 0, true, 'R', true);
			
			$this->pdf->Output($_SERVER['DOCUMENT_ROOT'] ."Gentleman/Orders/".$file_name,'F');
			
		}
		if($designation == 3){ $data=array('brm'=>0,'cm'=>2); }else if($designation == 2){ $data=array('cm'=>0,'fm'=>2); }else if($designation == 4){ $data=array('fm'=>0,'agm'=>2); }else if($designation == 1){ $data=array('agm'=>0,'pm'=>2); }else if($designation == 5){ $data=array('pm'=>0,'delivery'=>1,'cc'=>1,'order_file'=>$file_name); }
		$result = $this->Purchase_model->update($this->table,$data,'ref_number',$refno,'branch_id_fk',$branch_id_fk);
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
	// public function addtostock()
	// {
		// $refno = $this->input->post('refno');
		// $items = $this->Purchase_model->get_items($refno);
			// for($i=0;$i<count($items);$i++)
			// {
				// $item = $items[$i]->item_id_fk;
				// $itemname = $items[$i]->item_name;
				// $brid = $items[$i]->branch_id_fk;
				// $quantity = $items[$i]->item_quantity;
				
				// $itemsrop = $this->Purchase_model->get_rop($brid,$item);
				// $rop = $itemsrop->item_rop;
				
				// $checkitem = $this->Purchase_model->checkitem($brid,$item);
				// $data=array('delivery'=>0,'cc'=>0);
				// $this->Purchase_model->update($this->table,$data,'ref_number',$refno,'branch_id_fk',$brid);
				// if($checkitem)
				// {
					// $stock_id = $checkitem->stock_id;
					// $itemid = $checkitem->item_id_fk;
					// $br = $checkitem->branch_id_fk;
					// $qty = $checkitem->issuedqua;
					// $qnty = $qty + $quantity;
					// $up_stockdata = array('issuedqua'=>$qnty);
					// $result = $this->Purchase_model->update($this->tbl_stock,$up_stockdata,'branch_id_fk',$br,'item_id_fk',$itemid);
					// $tbl_stockup = array('up_date'=>date('Y-m-d'));
					// $this->Purchase_model->update($this->tbl_stockup,$tbl_stockup,'branch_id_fk',$br,'item_id_fk',$itemid);
				// }
				// else
				// {
					// $add_stockdata = array('item_id_fk'=>$item,'branch_id_fk'=>$brid,'item_name'=>$itemname,'item_quantity'=>$quantity,'issuedqua'=>$quantity,'item_rop'=>$rop,'stock_status'=>1,'used_quantity'=>0);
					// $result = $this->General_model->add($this->tbl_stock,$add_stockdata);
					// $stock_id_fk = $this->db->insert_id(); 
					// $tbl_stockup = array('stock_id_fk'=>$stock_id_fk,'item_id_fk'=>$item,'branch_id_fk'=>$brid,'up_date'=>date('Y-m-d'),'up_status'=>1);
					// $this->General_model->add($this->tbl_stockup,$tbl_stockup);
				// }
			// }
			// if($result) {
            // $response['text'] = 'updated successfully';
            // $response['type'] = 'success';
			// }
			// else{
				// $response['text'] = 'Something went wrong';
				// $response['type'] = 'error';
			// }
			// $data_json = json_encode($response);
			// echo $data_json;
	// }
	public function reject()
	{
		$desi = $this->input->post('desi');
		$ref = $this->input->post('ref');
		$brid = $this->input->post('brid');
		$narration = $this->input->post('narration');
			 if($desi == 3){ $data=array('brm'=>4,'cm'=>3,'fm'=>3,'agm'=>3,'pm'=>3,'reject'=>1,'delivery'=>3); $narration_data=array('branch_id_fk'=>$brid,'ref_no'=>$ref,'brm'=>1,'cm'=>0,'fm'=>0,'agm'=>0,'pm'=>0,'narration'=>$narration,'status'=>1);}
		else if($desi == 2){ $data=array('brm'=>3,'cm'=>4,'fm'=>3,'agm'=>3,'pm'=>3,'reject'=>1,'delivery'=>3); $narration_data=array('branch_id_fk'=>$brid,'ref_no'=>$ref,'brm'=>0,'cm'=>1,'fm'=>0,'agm'=>0,'pm'=>0,'narration'=>$narration,'status'=>1);}
		else if($desi == 4){ $data=array('brm'=>3,'cm'=>3,'fm'=>4,'agm'=>3,'pm'=>3,'reject'=>1,'delivery'=>3); $narration_data=array('branch_id_fk'=>$brid,'ref_no'=>$ref,'brm'=>0,'cm'=>0,'fm'=>1,'agm'=>0,'pm'=>0,'narration'=>$narration,'status'=>1);}
		else if($desi == 1){ $data=array('brm'=>3,'cm'=>3,'fm'=>3,'agm'=>4,'pm'=>3,'reject'=>1,'delivery'=>3); $narration_data=array('branch_id_fk'=>$brid,'ref_no'=>$ref,'brm'=>0,'cm'=>0,'fm'=>0,'agm'=>1,'pm'=>0,'narration'=>$narration,'status'=>1);}
		else if($desi == 5){ $data=array('brm'=>3,'cm'=>3,'fm'=>3,'agm'=>3,'pm'=>4,'reject'=>1,'delivery'=>3); $narration_data=array('branch_id_fk'=>$brid,'ref_no'=>$ref,'brm'=>0,'cm'=>0,'fm'=>0,'agm'=>0,'pm'=>1,'narration'=>$narration,'status'=>1);}
		$result = $this->Purchase_model->update($this->table,$data,'ref_number',$ref,'branch_id_fk',$brid);
		$this->General_model->add($this->tbl_narration,$narration_data);
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
		$refno = $this->input->post('refno');
		$data=$this->Purchase_model->get_narration($refno);
		echo json_encode($data);
	}
	public function view($ref_number,$br){
		$template['record'] = $this->Purchase_model->viewInvoice($ref_number);
		$template['branch'] = $this->Purchase_model->viewBranch($br);
		$template['body'] = 'Purchase/view';
        $template['script'] = 'Purchase/script';
        $this->load->view('template',$template);
    }
	public function edit($ref_number,$br){
		$template['record'] = $this->Purchase_model->viewInvoice($ref_number);
		$template['branch'] = $this->Purchase_model->viewBranch($br);
		$template['refno'] = $this->Purchase_model->Refno();
		$template['body'] = 'Purchase/add';
        $template['script'] = 'Purchase/script';
        $this->load->view('template',$template);
    }
	public function getProducts(){
		$refno = $this->input->post('refno');
		$data=$this->Purchase_model->getProducts($refno);
		echo json_encode($data);
    }
}
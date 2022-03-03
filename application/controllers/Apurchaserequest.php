<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Apurchaserequest extends MY_Controller
{
	public $table = 'tbl_apurchase';
	public $tbl_narration = 'tbl_narration-reject';
	public $tbl_stock = 'tbl_stock';
	public $tbl_stockup = 'tbl_stockup';
	public $tbl_req_approve = 'tbl_purchase_approval';
	public $page  = 'purchaserequest';
	public function __construct()
	{
		parent::__construct();
		if (!$this->is_logged_in()) {
			redirect('/login');
		}
		$this->load->library('email');
		$this->load->model('General_model');
		$this->load->model('Purchase_model');
		$this->load->model('Apurchase_model');
		$this->load->model('Vendor_model');
	}
	public function index()
	{
		$template['body'] = 'APurchase/list';
		$template['script'] = 'APurchase/script';
		$this->load->view('template', $template);
	}

	public function add_new_purchase(){
		$this->form_validation->set_rules('vendor_id', 'Number', 'required');
		if($this->form_validation->run() == FALSE){
			$template['body'] = 'APurchase/new_purchase';
			$template['script'] = 'APurchase/script';
			$template['vendor_names'] = $this->getVendors();
			$template['item_names'] = $this->get_all_item_list();
			$this->load->view('template', $template);
		}
	}

	public function add_purchase(){
		// print_r($_POST); die;
		$item_total=intval($_POST['price'])*intval($_POST['quantity']);
		$item_name=$this->Apurchase_model->getItemNameNew($_POST['item']);
		$ref = $this->generateRandomString();
		$reference_number='GENTLEMAN-'.$ref;
		$insert_array=[
			'ref_number'=>$reference_number,
			'invoice_no'=>$_POST['bill_number'],
			'item_id_fk'=>$_POST['item'],
			'branch_id_fk'=>$_POST['branch_id_fk'],
			'item_name'=>$item_name,
			'item_quantity'=>$_POST['quantity'],
			'item_price'=>$_POST['price'],
			'item_date'=>$_POST['date'],
			'taxamount'=>$_POST['tax_percent'],
			'item_total'=>$item_total,
			'grand_total'=>$item_total,
			'cc'=>$_POST['cc'],
			'brm'=>$_POST['brm'],
			'cm'=>$_POST['cm'],
			'fm'=>$_POST['fm'],
			'agm'=>$_POST['agm'],
			'pm'=>$_POST['pm'],
			'delivery'=>$_POST['delivery'],
			'finaldelivery'=>$_POST['finaldelivery'],
			'reject'=>$_POST['reject'],
			'remark'=>$_POST['remark'],
			'vendor_id_fk'=>$_POST['vendor_id'],
			'pr_status'=>$_POST['pr_status'],
			'amount_paid'=>$_POST['amount_paid'],
			// 'order_file'=>,
		];
		$result=$this->Apurchase_model->add_purchase($insert_array);
		if($result){
			redirect('/Apurchaserequest');
		}
		else{

		}
	}

	public function getVendors(){
		$result=$this->Apurchase_model->get_vendor_list();
		return $result;
	}

	public function get_all_item_list(){
		$result=$this->Apurchase_model->get_all_item_list();
		return $result;
	}

	function generateRandomString($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

	public function add()
	{
		$this->form_validation->set_rules('vendor_id', 'Number', 'required');
		if ($this->form_validation->run() == FALSE) {
			//$template['refno'] = $this->Apurchase_model->Refno();
			//$branch_id = $template['refno'][0]->branch_id;
			//$template['brmname'] = $this->Apurchase_model->brmname($branch_id);
			$template['body'] = 'APurchase/add';
			$template['script'] = 'APurchase/script';
			$template['vendor_names'] = $this->Vendor_model->view_by();
			$this->load->view('template', $template);
		} else {
			$this->load->helper('string');
			$ref = random_string('alnum', 5);
			$temp = count($this->input->post('item_id_fk'));
			$item_id_fk = $this->input->post('item_id_fk');
			$item_name = $this->input->post('item_name');
			$item_quantity = $this->input->post('item_quantity');
			$item_price = $this->input->post('item_price');
			$branch_id = 0;
			$billno = $this->input->post('purchase_invoice_number');
			$vendor_id = $this->input->post('vendor_id');
			$ref_number = $this->input->post('ref_number');
			$item_total_price = $this->input->post('item_total_price');
			$item_tax = $this->input->post('item_tax');
			$net_total = $this->input->post('net_total');
			$item_date = str_replace('/', '-', $this->input->post('purchase_date'));
			$item_date =  date("Y-m-d", strtotime($item_date));
			$edit_ref = $this->input->post('edit_ref');


			if ($edit_ref) {

				for ($i = 1; $i < $temp; $i++) {
					$up_data = array(
						'item_date' => $item_date,
						'item_id_fk' => $item_id_fk[$i],
						'item_name' => $item_name[$i],
						'item_quantity' => $item_quantity[$i],
						'item_price' => $item_price[$i],
						'taxamount' => $item_tax[$i],
						'item_total' => $item_total_price[$i],
						'grand_total' => $net_total,
						'remark' => 'null'
					);
					$prid = $this->Apurchase_model->getPrid($item_id_fk[$i], $edit_ref);
					if (isset($prid[0]->pr_id)) {
						$pr_id = $prid[0]->pr_id;
						//var_dump('present');
					}

					if (isset($pr_id)) {
						$this->General_model->update($this->table, $up_data, 'pr_id', $pr_id);
					}
				}
				$items = $this->Apurchase_model->getItemid($edit_ref);
				//var_dump($items);

				if (count($items) + 1 > $temp) {	//var_dump('heloo');
					$z = array();
					for ($i = 0; $i < count($items); $i++) {
						$z[$i] = $items[$i]->item_id_fk;
					}
					unset($item_id_fk[0]);
					$result = array_diff($z, $item_id_fk);
					//var_dump($result);
					for ($i = 0; $i < $temp; $i++) {
						if (isset($result[$i])) {
							$item = $this->Apurchase_model->getItem($result[$i], $edit_ref);
							$total = $item[0]->item_total;
							$grand = $item[0]->grand_total;
							$pr_id = $item[0]->pr_id;
							$new_grand =  $grand - $total;
							$stat_data = array('pr_status' => 0);
							$grad_data = array('grand_total' => $new_grand);
							$this->General_model->update($this->table, $stat_data, 'pr_id', $pr_id);
							$this->General_model->update($this->table, $grad_data, 'ref_number', $edit_ref);
						}
					}

					redirect('/Apurchaserequest/edit/' . $edit_ref . '/' . $branch_id);
				} else if (count($items) + 1 <= $temp) {
					//var_dump('haii');
					$z = array();
					for ($i = 0; $i < count($items); $i++) {
						$z[$i] = $items[$i]->item_id_fk;
					}
					unset($item_id_fk[0]);
					$result = array_diff($item_id_fk, $z);
					for ($i = 0; $i < $temp; $i++) { //var_dump("heloo");
						if (isset($result[$i])) {

							$data = array(
								'item_date' => $item_date,
								'ref_number' => $edit_ref,
								'invoice_no' => $billno,
								'vendor_id_fk' => $vendor_id,
								'branch_id_fk' => 0,
								'item_id_fk' => $item_id_fk[$i],
								'item_name' => $item_name[$i],
								'item_quantity' => $item_quantity[$i],
								'item_price' => $item_price[$i],
								'taxamount' => $item_tax[$i],
								'item_total' => $item_total_price[$i],
								'grand_total' => $net_total,
								'cc' => 0,
								'brm' => 1,
								'cm' => 1,
								'fm' => 1,
								'agm' => 2,
								'pm' => 1,
								'delivery' => 0,
								'finaldelivery' => 1,
								'remark' => 'remark',
								'order_file' => '',
								'pr_status' => 1
							);
							//var_dump($data);
							$this->Apurchase_model->updateRequest($data, $edit_ref);
						}
						$grad_data = array('grand_total' => $net_total);
						$this->General_model->update($this->table, $grad_data, 'ref_number', $edit_ref);
					}

					//redirect('/Apurchaserequest/edit/'.$edit_ref.'/'.$branch_id);
				}

				redirect('/Apurchaserequest');
			} else {
				for ($i = 1; $i < $temp; $i++) {
					$data = array(
						'item_date' => $item_date,
						'ref_number' => "GENTLEMAN-$ref",
						'invoice_no' => $billno,
						'vendor_id_fk' => $vendor_id,
						'branch_id_fk' => $branch_id,
						'item_id_fk' => $item_id_fk[$i],
						'item_name' => $item_name[$i],
						'item_quantity' => $item_quantity[$i],
						'item_price' => $item_price[$i],
						'taxamount' => $item_tax[$i],
						'item_total' => $item_total_price[$i],
						'grand_total' => $net_total,
						'cc' => 0,
						'brm' => 1,
						'cm' => 1,
						'fm' => 1,
						'agm' => 2,
						'pm' => 1,
						'delivery' => 0,
						'finaldelivery' => 1,
						'remark' => 'Null',
						'order_file' => '',
						'pr_status' => 1
					);
					$Frommail = $this->General_model->getMail();
					if (isset($Frommail[0]->email)) {
						$from_mail = $Frommail[0]->email;
					}
					$message = "A new purchase request is waiting for your approval--BILL NO:" . $billno;
					$result = $this->General_model->add_returnID($this->table, $data);

					$super_user = $this->General_model->getSuperUsers();
					// var_dump($result);
					// var_dump($super_user);
					for ($j = 0; $j < count($super_user); $j++) {
						$da = array(
							'pr_id_fk' => $result,
							'su_id_fk' => $super_user[$j]->id,
							'designation' => $super_user[$j]->designation,
							'is_approved' => 0,
							'reject' => 0
						);
						$k = $this->General_model->add($this->tbl_req_approve, $da);
						$udata = $this->General_model->getSuMail($super_user[$j]->id);
						if (isset($Frommail[0]->email)) {
							$useremail = $udata[0]->user_email;
							//var_dump($useremail);
							$this->email->from($from_mail);
							$this->email->to($useremail);
							$this->email->subject('Purchase request approval');
							$this->email->message($message);
							$this->email->set_newline("\r\n");

							// print_r($useremail);
							// exit();
							if ($this->email->send()) {
							} else {
								//show_error($this->email->print_debugger());
							}
						}
					}



					$operation = array(
						'user_id' => $this->session->userdata('id'),
						'operation' => 'Purchase',
						'to_whom' => $billno,
						'date' => date('Y-m-d'),
						'operation_id' => 10
					);
					$this->General_model->add_operation($operation);
					$response_text = 'Request added  successfully';
					$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				redirect('/Apurchaserequest/', 'refresh');
			}
		}
	}
	public function get()
	{
		$this->load->model('Apurchase_model');
		$param['draw'] = (isset($_REQUEST['draw'])) ? $_REQUEST['draw'] : '';
		$param['length'] = (isset($_REQUEST['length'])) ? $_REQUEST['length'] : '10';
		$param['start'] = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : '0';
		$param['order'] = (isset($_REQUEST['order'][0]['column'])) ? $_REQUEST['order'][0]['column'] : '';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order'][0]['dir'] : '';
		$param['searchValue'] = (isset($_REQUEST['search']['value'])) ? $_REQUEST['search']['value'] : '';

		$data = $this->Apurchase_model->getPurchaseTable($param);
		$json_data = json_encode($data);
		echo $json_data;
	}
	public function get_head()
	{
		$this->load->model('Apurchase_model');
		$param['draw'] = (isset($_REQUEST['draw'])) ? $_REQUEST['draw'] : '';
		$param['length'] = (isset($_REQUEST['length'])) ? $_REQUEST['length'] : '10';
		$param['start'] = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : '0';
		$param['order'] = (isset($_REQUEST['order'][0]['column'])) ? $_REQUEST['order'][0]['column'] : '';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order'][0]['dir'] : '';
		$param['searchValue'] = (isset($_REQUEST['search']['value'])) ? $_REQUEST['search']['value'] : '';

		$data = $this->Apurchase_model->getPurchaseTable_head($param);
		//echo $data['data'][0]->is_approved;
		//exit();
		$id = $this->session->userdata('id');
		$_data = $this->Apurchase_model->getNextAproval($id);
		$_status = $this->Apurchase_model->getStatus();
		for ($i = 0; $i < count($data['data']); $i++) {
			$pstatus = 2;
			$rstatus = 2;
			for ($j = 0; $j < count($_data); $j++) {
				if ($data['data'][$i]->pr_id == $_data[$j]->pr_id_fk) {
					$pstatus = $_data[$j]->is_approved;
					$rstatus = $_data[$j]->reject;
					break;
				}
			}
			$data['data'][$i]->is_pending = $pstatus;
			$data['data'][$i]->is_reject = $rstatus;
		}

		for ($i = 0; $i < count($data['data']); $i++) {
			$approve = 1;
			$reject = 0;
			for ($j = 0; $j < count($_status); $j++) {

				if ($data['data'][$i]->pr_id == $_status[$j]->pr_id_fk) {
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

		// var_dump($data['data']);
		//  var_dump($_data);
		//var_dump($_status);

		$json_data = json_encode($data);
		echo $json_data;
	}
	public function purchaserequest()
	{
		$this->load->model('Apurchase_model');
		$param['draw'] = (isset($_REQUEST['draw'])) ? $_REQUEST['draw'] : '';
		$param['length'] = (isset($_REQUEST['length'])) ? $_REQUEST['length'] : '10';
		$param['start'] = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : '0';
		$param['order'] = (isset($_REQUEST['order'][0]['column'])) ? $_REQUEST['order'][0]['column'] : '';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order'][0]['dir'] : '';
		$param['searchValue'] = (isset($_REQUEST['search']['value'])) ? $_REQUEST['search']['value'] : '';

		$data = $this->Apurchase_model->getPurchaseTable($param);
		$json_data = json_encode($data);
		echo $json_data;
	}
	public function aprove()
	{
		echo "test"; die;
		$id = $this->session->userdata('id');
		$refno = $this->input->post('refno');
		$pr_id = $this->input->post('pr_id');
		$branch_id_fk = $this->input->post('branch_id_fk');
		$designation = $this->input->post('designation');
		$items = $this->Apurchase_model->get_items($refno);
		$file_date = date('Y-m-d');
		$date = date('d/m/Y');
		$file_name = $refno . $file_date . ".pdf";
		// $this->load->library('Pdf');
		// $this->pdf->setPrintHeader(false);
		// $this->pdf->setPrintFooter(false);
		// $this->pdf->AddPage();
		// $this->pdf->SetFont('helvetica', 'B', 13);
		// $this->pdf->writeHTMLCell(0, 0, '', 5, 'Ph:0484-2522364', 0, 1, 0, true, 'R', true);
		// $this->pdf->SetFont('times', 'B', 24);
		// $this->pdf->writeHTMLCell(200, 0, '', 14, 'GENTLEMAN CHITS FUNDS', 0, 1, 0, true, 'C', true);
		// $this->pdf->SetFont('times', 'B', 13);
		// $this->pdf->writeHTMLCell(200, 0, '', '', 'GENTLEMAN APARTMENT, 1ST FLOOR, MARKET ROAD, KOTTAYAM, DIST, KERALA', 0, 1, 0, true, 'C', true);
		// $this->pdf->writeHTMLCell(225, 0, -10, 40, '--------------------------------------------------------------------------------------------------------------------------------------------------', 0, 1, 0, true, 'C', true);
		// $this->pdf->SetFont('times', 'B', 13);
		// $this->pdf->writeHTMLCell(0, 0, '', 50, 'REFNO:'.$refno, 0, 1, 0, true, 'L', true);
		// $this->pdf->writeHTMLCell(0, 0, '', 50, 'Date.'.$date, 0, 1, 0, true, 'R', true);
		// $this->pdf->SetFont('times', 'U', 15);
		// $this->pdf->writeHTMLCell(0, 0, '', 70, 'PURCHASE ORDER', 0, 1, 0, true, 'C', true);
		// $this->pdf->SetFont('times', '', 15);
		// $this->pdf->setCellHeightRatio(1.25);
		// $this->pdf->writeHTMLCell(0, 0, 20, 80, 'Purchase order from gentleman chity funds generated by purchase manager.Following items are requested from ....... branch', 0, 1, 0, true, 'C', true);
		// $html = '<table border="1">
		// <tr>
		//            <th align="Center">Particulars</th>
		//            <th align="Center">Quantity</th>
		//            <th align="Center">Price</th>
		//   <th align="Center">Tax</th>
		//            <th align="Center">NetAmount</th>
		// </tr>';
		//  foreach($items as $key){
		// 	 $html .= '<tr>
		// 				  <td align="Center">'.$key->item_name.'</td>
		// 				  <td align="Center">'.$key->item_quantity.'</td>
		// 				  <td align="Center">'.$key->item_price.'</td>
		// 				  <td align="Center">'.$key->taxamount.'</td>
		// 				  <td align="Center">'.$key->item_total.'</td>
		// 			   </tr>';
		//   }
		// $html .= '</table>';
		// $this->pdf->writeHTMLCell(0, 0, 20, 100, $html);
		// $this->pdf->SetFont('times', '', 15);
		// $this->pdf->writeHTMLCell(0, 0, 20, 205, 'Place: Thalayolaparambu', 0, 1, 0, true, '', true);
		// $this->pdf->writeHTMLCell(0, 0, 20, 213, 'Date:'.$date, 0, 1, 0, true, '', true);
		// $this->pdf->writeHTMLCell(0, 0, 20, 223, 'Parchase Manager', 0, 1, 0, true, 'R', true);

		// $this->pdf->Output($_SERVER['DOCUMENT_ROOT'] ."Gentleman/Orders/".$file_name,'F');

		$res = $this->Apurchase_model->updateApprovel($pr_id, $id);
		$data = array('fm' => 0, 'delivery' => 1, 'order_file' => $file_name);
		$result = $this->Apurchase_model->update($this->table, $data, 'ref_number', $refno, 'branch_id_fk', 0);

		if ($res) {

			$response['text'] = 'updated successfully';
			$response['type'] = 'success';
		} else {
			$response['text'] = 'Something went wrong';
			$response['type'] = 'error';
		}
		$data_json = json_encode($response);
		echo $data_json;
	}

	public function reject()
	{
		$id = $this->session->userdata('id');
		$refno = $this->input->post('refno');
		$prid = $this->input->post('purchase_id');
		$reason = $this->input->post('reason');
		$data = array('brm' => 3, 'cm' => 3, 'fm' => 4, 'agm' => 3, 'pm' => 3, 'reject' => 1, 'delivery' => 3);
		$result = $this->Apurchase_model->update($this->table, $data, 'ref_number', $refno, 'branch_id_fk', 0);
		$res = $this->Apurchase_model->updateReject($prid, $id, $reason);
		if ($res) {
			$response['text'] = 'updated successfully';
			$response['type'] = 'success';
		} else {
			$response['text'] = 'Something went wrong';
			$response['type'] = 'error';
		}


		redirect('/Apurchaserequest/', 'refresh');
	}
	public function viewnarration()
	{
		$refno = $this->input->post('refno');
		$data = $this->Apurchase_model->get_narration($refno);
		echo json_encode($data);
	}
	public function view($ref_number, $br)
	{
		$template['record'] = $this->Apurchase_model->viewInvoice($ref_number);
		$template['branch'] = $this->Apurchase_model->viewBranch($br);
		$template['body'] = 'APurchase/view';
		$template['script'] = 'APurchase/script';
		$this->load->view('template', $template);
	}
	public function edit($ref_number, $br)
	{
		$template['record'] = $this->Apurchase_model->viewInvoice($ref_number);
		$template['vendor_names'] = $this->Vendor_model->view_by();
		$template['body'] = 'APurchase/add';
		$template['script'] = 'APurchase/script';
		$this->load->view('template', $template);
	}
	public function getProducts()
	{
		$refno = $this->input->post('refno');
		$data = $this->Apurchase_model->getProducts($refno);
		// var_dump($data); die;
		echo json_encode($data);
	}

	public function get_gst()
	{
		$vendor_id = $this->input->post('vid');
		$records = $this->Apurchase_model->get_gst($vendor_id);
		$data_json = json_encode($records);
		echo $data_json;
	}

	public function updateDelivery()
	{
		$pr_id = $this->input->post('pr_id');
		$data = $this->Apurchase_model->updateDelivery($pr_id);
		echo json_encode($data);
	}

	function get_operator()
	{

		$pr_id = $this->input->post('pr_id');

		// print_r($pr_id);
		// exit();
		$data = $this->Apurchase_model->get_operator($pr_id);

		//echo $data[0]->user_name;
		echo json_encode($data[0]->user_name);
	}

	function get_operator_rejected()
	{

		$pr_id = $this->input->post('pr_id');

		// print_r($pr_id);
		// exit();
		$data = $this->Apurchase_model->get_operator($pr_id);

		//echo $data[0]->user_name;
		echo json_encode("Rejected_by " . $data[0]->user_name . " Reason: " . $data[0]->reject_reason . " On " . $data[0]->updated_date);
	}

	function getprice(){
		$item_id = $this->input->post('item');
		$quantity = $this->input->post('quantity');
		$price = $this->Apurchase_model->get_price($item_id, $quantity);
		// var_dump($price); die();
		echo $price[0]->price;
	}

	function getgst()
	{

		$vendor_id = $this->input->post('vendor');

		$gst = $this->Apurchase_model->getgst($vendor_id);

		echo $gst[0]->vendorgst;
	}
	function purchase_edit()
	{

		$pr_id = $this->uri->segment(3);
		$template['records'] = $this->Apurchase_model->get_purchase($pr_id);

		$template['body'] = 'APurchase/edit';
		$template['script'] = 'APurchase/script';
		$this->load->view('template', $template);
	}

	function edit_purchase()
	{
		$pr_id = $this->input->post('pr_id');
		$quantity = $this->input->post('quantity');
		$price = $this->input->post('price');

		$data = $this->Apurchase_model->get_purchasedetails($pr_id);

		$tax = $data[0]->taxamount;
		$total = $price + $tax;

		$data_purchase = array(

			'item_quantity' => $quantity,
			'item_price' => $price,
			'item_total' => $total,
			'grand_total' => $total

		);

		$this->General_model->update($this->table, $data_purchase, 'pr_id', $pr_id);
		$response['text'] = 'updated successfully';

		redirect('/Apurchaserequest');
	}


	function delete()
	{

		$pr_id = $this->uri->segment(3);

		$data = array('pr_status' => 0);

		$this->General_model->update($this->table, $data, 'pr_id', $pr_id);

		redirect('Apurchaserequest');
	}

	/* To get stock item list from items table*/
	function getItemList(){
			$result= $this->Apurchase_model->get_item_list();
			$data = json_encode($result);
      echo $data;
	}

	function getItemName(){
		$result= $this->Apurchase_model->getItemName($this->input->post('id'));
		$data=json_encode($result);
		echo $data;
	}
}

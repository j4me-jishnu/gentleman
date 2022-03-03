<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Request_item extends MY_Controller {
	public $table = ' tbl_request_item';
	public $tbl_return = ' tbl_return';
	public $tbl_stock = ' tbl_stock';
	public $page  = 'updateusage';
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
			redirect('/login');
		}

		$this->load->model('Request_item_model');
		$this->load->model('Purchase_model');
		$this->load->model('General_model');
		$this->load->model('Request_Br_to_br_model');
		$this->load->library('email');
	}
	public function index()
	{
		$template['refno'] = $this->Request_item_model->Refno();
		$branch_id = $template['refno'][0]->branch_id;
		$template['brmname'] = $this->Request_item_model->brmname($branch_id);
		if(isset($template['brmname'][0]->user_branch))
		{
			$br = $template['brmname'][0]->user_branch;
		}
		else
		{
			$br = 0;
		}
		$template['userid'] = $this->Request_item_model->get_id($br);
		$template['item'] = $this->Request_item_model->get_item();
		$template['body'] = 'Request_item/list';
		$template['script'] = 'Request_item/script';
		$this->load->view('template', $template);
	}

	public function add()
	{
		$template['refno'] = $this->Request_item_model->Refno();
		$branch_id = $template['refno'][0]->branch_id;
		$template['brmname'] = $this->Request_item_model->brmname($branch_id);
		if(isset($template['brmname'][0]->user_branch))
		{
			$br = $template['brmname'][0]->user_branch;
		}
		else
		{
			$br = 0;
		}
		$template['userid'] = $this->Request_item_model->get_id($br);
		$template['item'] = $this->Request_item_model->get_item();
		$template['body'] = 'Request_item/add';
		$template['script'] = 'Request_item/script';
		$this->load->view('template', $template);
	}
	public function addAction(){
		$this->form_validation->set_rules('itemid', 'itemId', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['refno'] = $this->Request_item_model->Refno();
			$branch_id = $template['refno'][0]->branch_id;
			$template['brmname'] = $this->Request_item_model->brmname($branch_id);
			$br = $template['brmname'][0]->user_branch;
			$template['userid'] = $this->Request_item_model->get_id($br);
			$template['item'] = $this->Request_item_model->get_item($br);
			$template['body'] = 'Request_item/add';
			$template['script'] = 'Request_item/script';
			$this->load->view('template', $template);
		}
		else {
			$template['refno'] = $this->Purchase_model->Refno();
			$branch_id = $template['refno'][0]->branch_id;
			$itemid = $this->input->post('itemid');
			$quantity = $this->input->post('quantity');
			$date = $this->input->post('request_date');

			$data = array(
				'item_id_fk' => $itemid,
				'branch_id_fk' => $branch_id,
				'request_quantity' => $this->input->post('quantity'),
				'request_date' => date('Y-m-d'),
				'request_status' => 1
			);
			$result = $this->General_model->add($this->table,$data);
			$response_text = 'Request Updated  successfully';

			if($result){

				$operation = array(
					'user_id' => $this->session->userdata('id'),
					'operation' => 'Request item',
					'to_whom' => $itemid,
					'date' => date('Y-m-d'),
					'operation_id' => 15,
					'value' =>$quantity
				);
				$this->General_model->add_operation($operation);

				$idata = $this->General_model->getI($itemid);
				$bdata = $this->General_model->getB($branch_id);
				$item =$idata[0]->item_name;
				$branch =$bdata[0]->branch_name;
				$admin= $this->Request_Br_to_br_model->getAdmin();
				$Frommail = $this->General_model->getMail();
				if(isset($Frommail[0]->email)){
					$from_mail = $Frommail[0]->email;
					$message=$quantity." Stock of ".$item." Requested  from ".$branch;
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
				$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			}
			else{
				$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
			redirect('/Request_item/', 'refresh');
		}
	}
	public function get(){
		$this->load->model('Request_item_model');
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
		$param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
		$param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
		$param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
		$param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		$template['refno'] = $this->Purchase_model->Refno();
		$branch_id = $template['refno'][0]->branch_id;

		$data = $this->Request_item_model->getData($param,$branch_id);
		$json_data = json_encode($data);
		echo $json_data;
	}
	public function delete(){

		$request_id = $this->input->post('request_id');
		$data = $this->Request_item_model->delete($request_id);
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
		redirect('/Request_item/', 'refresh');
	}

	public function edit($branch_id){
		$template['body'] = 'Branch/add';
		$template['script'] = 'Branch/script';
		$template['records'] = $this->General_model->get_row($this->table,'branch_id',$branch_id);
		$this->load->view('template', $template);
	}

	public function checkissue(){
		$itemid = $this->input->post('itemid');
		$userid = $this->input->post('userid');
		$template['refno'] = $this->Request_item_model->Refno();
		$branch_id = $template['refno'][0]->branch_id;
		$data = $this->Request_item_model->get_issue($itemid,$userid,$branch_id);
		echo json_encode($data);
	}
	public function checkuse(){
		$itemid = $this->input->post('itemid');
		$userid = $this->input->post('userid');
		$template['refno'] = $this->Request_item_model->Refno();
		$branch_id = $template['refno'][0]->branch_id;
		$data = $this->Request_item_model->get_usage($itemid,$userid,$branch_id);
		echo json_encode($data);
	}
	public function returned(){
		$itemid = $this->input->post('itemid');
		$userid = $this->input->post('userid');
		$template['refno'] = $this->Request_item_model->Refno();
		$branch_id = $template['refno'][0]->branch_id;
		$data = $this->Request_item_model->get_returned($itemid,$userid,$branch_id);
		echo json_encode($data);
	}

	function get_operator(){
		$request_id = $this->input->post('request_id');

		// print_r($pr_id);
		// exit();
		$data = $this->Request_item_model->get_operator($request_id);

		//echo $data[0]->user_name;
		echo json_encode($data[0]->user_name);
	}


}

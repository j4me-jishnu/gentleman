<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Return_item extends MY_Controller
{
	public $tbl_issueitem = 'tbl_issueitem';
	public $table = 'tbl_returnproduct';
	public $tbl_stock = 'tbl_stock';
	public $page  = 'issueitem';
	public function __construct()
	{
		parent::__construct();
		if (!$this->is_logged_in()) {
			redirect('/login');
		}

		$this->load->model('General_model');
		$this->load->model('Apurchase_model');
		$this->load->model('Issueitem_model');
		$this->load->model('Purchase_model');
		$this->load->model('Stock_model');
		$this->load->model('Return_item_model');
		$this->load->model('Request_Br_to_br_model');
		$this->load->library('email');
	}
	public function index()
	{
		$template['body'] = 'Return_item/list';
		$template['script'] = 'Return_item/script';
		$this->load->view('template', $template);
	}
	public function add()
	{
		$this->form_validation->set_rules('itemid', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['refno'] = $this->Purchase_model->Refno();
			$branch_id = $template['refno'][0]->branch_id;
			$template['item'] = $this->Stock_model->get_Branchitem($branch_id);
			$template['brmname'] = $this->Purchase_model->brmname($branch_id);
			if (isset($template['brmname'][0]->user_branch)) {
				$br = $template['brmname'][0]->user_branch;
			} 
			else {
				$br = 0;
			}
			$template['userid'] = $this->Issueitem_model->get_id($br);
			$template['body'] = 'Return_item/add';
			$template['script'] = 'Return_item/script';
			$this->load->view('template', $template);
		} else {
			
			

			$rdate = str_replace('/', '-', $this->input->post('rdate'));
			$rdate =  date("Y-m-d", strtotime($rdate));
			$itemid = $this->input->post('itemid');
			$quantity = $this->input->post('quantity');
			
			$branch_name =  $this->session->userdata('user_branch');	
			$branch_id = $this->Return_item_model->get_branch_id($branch_name);
			/* Function to fetch available balance of an item against a branch */
			// $avai=$this->Return_item_model->check_available_stock($itemid,$branch_id);
			// var_dump($avai); exit();
			
			$avai=100;
			// $avai = $this->input->post('avai'); |No item is loading on $avai

			//test
			// Function for get available stock of returning item for the branch
			$branch_id = $this->session->userdata('id');
			// check from here...

			if ($avai > $quantity) {
				$narration = $this->input->post('narration');
				$template['refno'] = $this->Purchase_model->Refno();
				$branch_id = $template['refno'][0]->branch_id;
				$data = array(
					'item_id_fk' => $itemid,
					'branch_id_fk' => $branch_id,
					'item_quantity' => $quantity,
					'return_date' => $rdate,
					'return_reason' => $narration,
					'return_comment' => $this->input->post('reason'),
					'status' => 1
				);

				$result = $this->General_model->add($this->table, $data);
				$response_text = 'Return detils added successfully';
				if ($result) {
					$operation = array(
						'user_id' => $this->session->userdata('id'),
						'operation' => 'Item Returned',
						'to_whom' => $itemid,
						'date' => date('Y-m-d'),
						'operation_id' => 13,
						'value' => $quantity
					);
					$this->General_model->add_operation($operation);

					$res = $this->Issueitem_model->getBS($branch_id, $itemid);
					if (isset($res[0])) {
						$iqty = $res[0]->total;
						$irop = $res[0]->item_rop;
						$iname = $res[0]->item_name;
						$bname = $res[0]->branch_name;
						if ($iqty < $irop) {
							$admin = $this->Request_Br_to_br_model->getAdmin();
							$Frommail = $this->General_model->getMail();
							if (isset($Frommail[0])) {
								$from_mail = $Frommail[0]->email;
								$udata = $this->Apurchase_model->getAgmmail();
								$useremail = $udata[0]->user_email;
								$message = "Stock of " . $iname . " Reached below  in " . $bname;
								$this->email->from($from_mail);
								$this->email->to($admin[0]->user_email);
								$this->email->subject('Stock balance');
								$this->email->message($message);
								$this->email->set_newline("\r\n");
								if ($this->email->send()) {
								} else {
								}
							}
						}
					}


					$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				} else {
					$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
			} else {
				$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Entered quantity is less than available quantity,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}

			redirect('/Return_item/', 'refresh');
		}
	}

	

	public function get()
	{
		$this->load->model('Return_item_model');
		$param['draw'] = (isset($_REQUEST['draw'])) ? $_REQUEST['draw'] : '';
		$param['length'] = (isset($_REQUEST['length'])) ? $_REQUEST['length'] : '10';
		$param['start'] = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : '0';
		$param['order'] = (isset($_REQUEST['order'][0]['column'])) ? $_REQUEST['order'][0]['column'] : '';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order'][0]['dir'] : '';
		$param['searchValue'] = (isset($_REQUEST['search']['value'])) ? $_REQUEST['search']['value'] : '';

		$data = $this->Return_item_model->getReturnTable($param);

		$json_data = json_encode($data);
		echo $json_data;
	}
	public function delete()
	{

		$return_id = $this->input->post('return_id');

		$data = $this->Return_item_model->delete($return_id);
		if ($data) {
			$response['text'] = 'Deleted successfully';
			$response['type'] = 'success';
		} else {
			$response['text'] = 'Something went wrong';
			$response['type'] = 'error';
		}
		$response['layout'] = 'topRight';
		$data_json = json_encode($response);
		echo $data_json;
		redirect('/Return_item/', 'refresh');
	}
	public function edit($branch_id)
	{
		$template['body'] = 'Branch/add';
		$template['script'] = 'Branch/script';
		$template['records'] = $this->General_model->get_row($this->table, 'branch_id', $branch_id);
		$this->load->view('template', $template);
	}
	public function checkstock()
	{
		$template['refno'] = $this->Purchase_model->Refno();
		$br = $template['refno'][0]->branch_id;
		$itemid = $this->input->post('itemid');
		$data = $this->Issueitem_model->checkstock($itemid, $br);
		echo json_encode($data);
	}
}

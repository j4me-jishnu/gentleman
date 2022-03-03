<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Openigstock extends MY_Controller {
	public $table = 'tbl_opening_stock';

	public $page  = 'openigstock';
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
			redirect('/login');
		}
		$this->load->model('General_model');
		$this->load->model('Users_model');
		$this->load->model('Openigstock_model');
	}
	public function index()
	{
		$template['body'] = 'Openingstock/list';
		$template['script'] = 'Openingstock/script';
		$this->load->view('template', $template);
	}
	public function add(){
		// $this->form_validation->set_rules('item_name', 'Name', 'required'); old code

		// New code for validating opening stock inputs

		$this->form_validation->set_rules('item_name','item_name','trim|required|min_length[3]|regex_match[/[a-zA-Z]/]');
		$this->form_validation->set_rules('branch','branch','required');
		$this->form_validation->set_rules('item_stock','item_stock','trim|required|numeric');



		if ($this->form_validation->run() == FALSE) {
			$template['branch'] = $this->Users_model->get_branch();
			$template['body'] = 'Openingstock/add';
			$template['script'] = 'Openingstock/script';
			$this->load->view('template', $template);
		}
		else{
			$branch = $this->input->post('branch');
			$item_id = $this->input->post('item_id');
			$item_stock = $this->input->post('item_stock');
			$date = str_replace('/', '-', $this->input->post('date'));
			$date =  date("Y-m-d",strtotime($date));
			$checkitem = $this->Openigstock_model->checkitem($branch,$item_id);
			if($branch!='' && $item_id!='' && $item_stock!='')
			{
				$ropid = $this->Openigstock_model->getrop_id($branch , $item_id);
				if(isset( $ropid->rop_id)){
					$rop_id = $ropid->rop_id;


					$item_rop = $ropid->item_rop;
					$itemname = $this->Openigstock_model->getitemName($item_id);
					$itemname = $itemname->item_name;
				}
				else
				{
					$rop_id = 0;


					$item_rop = 0;
					$itemname = $this->Openigstock_model->getitemName($item_id);
					$itemname = $itemname->item_name;
				}

				if($branch==0){
					$shop_stock = $this->Openigstock_model->get_stock($item_id);

					if(isset($shop_stock[0])){

						$data_stock = array(

							'item_quantity'=>$shop_stock[0]->item_quantity + $item_stock

						);

						$this->General_model->update('tbl_stock',$data_stock,'stock_id',$shop_stock[0]->stock_id);

						$data_up = array(

							'stock_id_fk' => $shop_stock[0]->stock_id,
							'item_id_fk' => $item_id,
							'up_date' => date('Y-m-d'),
							'up_status' => 1
						);
						$dstock = $this->Openigstock_model->get_up($shop_stock[0]->stock_id);

						if($dstock==NULL){


							$this->General_model->add('tbl_stockup',$data_up);
						}
					}
					else{

						$data_stock = array(
							'item_id_fk' => $item_id,
							'item_name' => $itemname,
							'branch_id_fk' => $branch,
							'item_quantity'=>$item_stock,
							'issuedqua'=>$item_stock,
							'stock_status'=>1

						);

						$this->General_model->add('tbl_stock',$data_stock);

						$stock_id = $this->db->insert_id();
						$data_up = array(

							'stock_id_fk' => $stock_id,
							'item_id_fk' => $item_id,
							'up_date' => date('Y-m-d'),
							'up_status' => 1
						);

						$this->General_model->add('tbl_stockup',$data_up);

					}

				}

				else{

					$data_branch = array(

						'shop_id_fk' => $branch,
						'item_id_fk' => $item_id,
						'item_quantity' => $item_stock,
						'updated_date' => date('Y-m-d'),
						'status' => 1

					);

					$this->General_model->add('tbl_shopstock',$data_branch);

				}

				$data = array(
					'item_id_fk' => $item_id,
					'branch_id_fk' => $branch,
					'item_name' => $itemname,
					'item_quantity'=>$item_stock,
					'date' =>$date,
					'stock_status'=>1
				);

				$stock_id = $this->input->post('stock_id');
				if($stock_id){

					$data['stock_id'] = $stock_id;
					$result = $this->General_model->update($this->table,$data,'stock_id',$stock_id);
					$tbl_stockup = array('stock_id_fk'=>$stock_id,'item_id_fk'=>$item_id,'branch_id_fk'=>$branch,'up_date'=>date('Y-m-d'),'up_status'=>1);
					//$this->General_model->update($this->tbl_stockup,$tbl_stockup,'stock_id_fk',$stock_id);
					$response_text = 'Stock  updated successfully';
				}
				else{
					//  $result = $this->General_model->add('tbl_opening_stock',$data);
					$result = $this->Openigstock_model->insertOP($data);
					$stock_id_fk = $this->db->insert_id();
					// $this->General_model->add($this->tbl_stockup,$tbl_stockup);
					$response_text = 'Stock added  successfully';
				}

			}
			if($result == 1){
				$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			}
			else{
				$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
			redirect('/openigstock/', 'refresh');
		}
	}
	public function getOpeningMaster(){
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
		$param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
		$param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
		$param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
		$param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		$start_date = (isset($_REQUEST['start_date']))?$_REQUEST['start_date']:'';
		$end_date = (isset($_REQUEST['end_date']))?$_REQUEST['end_date']:'';
		if($start_date){
			$start_date = str_replace('/', '-', $start_date);
			$param['start_date'] =  date("Y-m-d",strtotime($start_date));
		}
		if($end_date){
			$end_date = str_replace('/', '-', $end_date);
			$param['end_date'] =  date("Y-m-d",strtotime($end_date));
		}
		// var_dump($start_date);


		$data = $this->Openigstock_model->getOpeningStockTable($param);
		//print_r($this->db->last_query());
		//exit;
		$json_data = json_encode($data);
		echo $json_data;
	}

	public function getOpeningBranch(){

		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
		$param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
		$param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
		$param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
		$param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		$start_date = (isset($_REQUEST['start_date']))?$_REQUEST['start_date']:'';
		$end_date = (isset($_REQUEST['end_date']))?$_REQUEST['end_date']:'';
		if($start_date){
			$start_date = str_replace('/', '-', $start_date);
			$param['start_date'] =  date("Y-m-d",strtotime($start_date));
		}
		if($end_date){
			$end_date = str_replace('/', '-', $end_date);
			$param['end_date'] =  date("Y-m-d",strtotime($end_date));
		}

		$data = $this->Openigstock_model->getOpeningBranchTable($param);
		$open =$this->Openigstock_model->getOpen($param);
		$merge['data'] = array_merge($open['data'],$data['data']);
		$newArr = array();
		$dummy = $merge['data'];
		for($i = 0; $i < count($dummy); $i++) {
			$total = $dummy[$i]->total;
			for ($j = 0; $j < count($dummy); $j++) {
				if ($dummy[$i]->item_id_fk == $dummy[$j]->item_id_fk &&
				$dummy[$i]->shop_id_fk == $dummy[$j]->shop_id_fk &&
				$i != $j) {
					$total += $dummy[$j]->total;
				}
			}
			$newArr[$i] = $dummy[$i];
			$newArr[$i]->total = $total;
		}

		$_data = array();

		foreach ($newArr as $val) {

			if(isset($_data[$val->item_id_fk.$val->shop_id_fk])) {
				continue;
			} else {
				$_data[$val->item_id_fk.$val->shop_id_fk] = $val;
			}
		}

		//var_dump($_data['83']->total);
		$data = array();

		$data['data'] =array_values($_data);
		$json_data = json_encode($data);
		echo $json_data;


	}

	public function getClosingMaster(){

		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
		$param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
		$param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
		$param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
		$param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		$start_date = (isset($_REQUEST['start_date']))?$_REQUEST['start_date']:'';
		$end_date = (isset($_REQUEST['end_date']))?$_REQUEST['end_date']:'';
		if($start_date){
			$start1_date = str_replace('/', '-', $start_date);
			$param['start1_date'] =  date("Y-m-d",strtotime($start1_date));

			$start_date = str_replace('/', '-', $end_date);
			$param['start_date'] =  date("Y-m-d",strtotime($start_date.' +1 day'));
		}
		if($end_date){
			$end1_date = str_replace('/', '-', $end_date);
			$param['end1_date'] =  date("Y-m-d",strtotime($end1_date));
			// $end_date = str_replace('/', '-', $end_date);
			$param['end_date'] =  date("Y-m-d");
		}

		$data = $this->Openigstock_model->getClosingMaster($param);
		$json_data = json_encode($data);
		echo $json_data;
	}


	public function getClosingBranch(){

		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
		$param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
		$param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
		$param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
		$param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		$start_date = (isset($_REQUEST['start_date']))?$_REQUEST['start_date']:'';
		$end_date = (isset($_REQUEST['end_date']))?$_REQUEST['end_date']:'';
		if($start_date){
			$start_date = str_replace('/', '-', $end_date);
			$param['start_date'] =  date("Y-m-d",strtotime($start_date.' +1 day'));
		}
		if($end_date){
			// $end_date = str_replace('/', '-', $end_date);
			$param['end_date'] =  date("Y-m-d");
		}

		$data = $this->Openigstock_model->getOpeningBranchTable($param);
		$open =$this->Openigstock_model->getOpen($param);
		$merge['data'] = array_merge($open['data'],$data['data']);
		$newArr = array();
		$dummy = $merge['data'];
		for($i = 0; $i < count($dummy); $i++) {
			$total = $dummy[$i]->total;
			for ($j = 0; $j < count($dummy); $j++) {
				if ($dummy[$i]->item_id_fk == $dummy[$j]->item_id_fk &&
				$dummy[$i]->shop_id_fk == $dummy[$j]->shop_id_fk &&
				$i != $j) {
					$total += $dummy[$j]->total;
				}
			}
			$newArr[$i] = $dummy[$i];
			$newArr[$i]->total = $total;
		}

		$_data = array();

		foreach ($newArr as $val) {

			if(isset($_data[$val->item_id_fk.$val->shop_id_fk])) {
				continue;
			} else {
				$_data[$val->item_id_fk.$val->shop_id_fk] = $val;
			}
		}

		//var_dump($_data['83']->total);


		$data = array();

		$data['data'] =array_values($_data);
		$json_data = json_encode($data);
		echo $json_data;


	}

	public function edit($stock_id){

		$template['branch'] = $this->Users_model->get_branch();
		$template['records'] = $this->General_model->get_row($this->table,'stock_id',$stock_id);
		$template['body'] = 'Openingstock/add';
		$template['script'] = 'Openingstock/script';
		$this->load->view('template', $template);
	}
	public function delete()
	{
		$stock_id = $this->input->post('stock_id');
		$updateData = array('stock_status' => 0);
		$upData = array('up_status' => 0);
		$data = $this->General_model->update($this->table,$updateData,'stock_id',$stock_id);
		$this->General_model->update($this->tbl_stockup,$upData,'stock_id_fk',$stock_id);
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
		redirect('/openigstock/', 'refresh');
	}

	public function openingStockEdit(){
		$template['branch'] = $this->Users_model->get_branch();
		$template['body'] = 'Openingstock/edit';
		$template['script'] = 'Openingstock/script';
		$template['stock_items']=$this->Openigstock_model->fetch_all_stock_items();
		$template['branches']=$this->Openigstock_model->fetch_all_branches();
		$this->load->view('template', $template);
	}

	/* Function to fetch opening stock for branch and master stock items */
	public function getOpeningStock(){
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
		$param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
		$param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
		$param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
		$param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';

		$branch_id=$this->input->post('branch_id');
		$item_id=$this->input->post('item_id');

		if($branch_id=="master"){
			$result=$this->Openigstock_model->get_master_openingstock_history($item_id);
			$result['os_history']=$this->Openigstock_model->get_openingstock_history($branch_id,$item_id);
			echo json_encode($result);
		}
		else{
			$result=$this->Openigstock_model->fetch_opening_stock($branch_id,$item_id);
			$result['os_history']=$this->Openigstock_model->get_openingstock_history($branch_id,$item_id,$param);
			// var_dump($result); echo "<br>";
			// echo"<pre>".print_r($result['data'])."<pre>"; die;
			echo json_encode($result);
		}
	}
	public function single_item_edit($openingstock_id){
		$openingstock_id=intval($openingstock_id);
		$template['single_os_data'] = $this->Openigstock_model->get_single_os($openingstock_id);
		$template['body'] = 'Openingstock/edit_single_item';
		$template['script'] = 'Openingstock/script';
		// $template['stock_items']=$this->Openigstock_model->fetch_all_stock_items();
		// $template['branches']=$this->Openigstock_model->fetch_all_branches();
		$this->load->view('template', $template);

	}

	public function updateOS(){
		$data = array(
			'item_quantity' => $this->input->post('item_quantity'),
			'item_name' => $this->input->post('item_name'),
			'date' => $this->input->post('item_date')
		);
		$os_id=$this->input->post('item_id');
		$result=$this->Openigstock_model->updateOpeningStock($os_id,$data);
		// $this->db->where('opening_id', $this->input->post('item_id'));
		// $this->db->update('tbl_opening_stock', $data);
		if($result){
			$response_text = 'Opening stock updated successfully';
			$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
		}
		else{
			$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong, please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
		}
		redirect('/openigstock/', 'refresh');


		// $this->db->set('raw_status',0);
		// $this->db->where('prod_id',$product_id);
		// $this->db->update('tbl_rawmaterials');

	}

}

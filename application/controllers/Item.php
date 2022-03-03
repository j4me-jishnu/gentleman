<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Item extends MY_Controller {
	public $table = ' tbl_item';
	public $tbl_rop = ' tbl_rop';
	public $page  = 'item';
	public function __construct() {
		parent::__construct();
       if(! $this->is_logged_in()){
            redirect('/login');
        }
        $this->load->model('General_model');
		$this->load->model('Item_model');
		$this->load->model('Users_model');
    }
	public function index()
	{
		$template['body'] = 'Item/list';
		$template['script'] = 'Item/script';
		$template['branch'] = $this->Users_model->get_branch();
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('item_name', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['category'] = $this->Item_model->get_category();
			$template['branch'] = $this->Users_model->get_branch();
			$template['body'] = 'Item/add';
			$template['script'] = 'Item/script';
			$this->load->view('template', $template);
		}
		else {
			$temp = count($this->input->post('item_quantity'));
			$item_quantity = $this->input->post('item_quantity');
            $item_price = $this->input->post('item_price');
			$branches = $this->input->post('branches');
			$item_rop = $this->input->post('item_rop');
			$data = array(
						'category_id_fk' => $this->input->post('item_category'),
						'item_name' => $this->input->post('item_name'),
						'item_hsn' => $this->input->post('item_hsn'),
						'item_tax' => $this->input->post('item_tax'),
						'item_description' => $this->input->post('item_description'),
						'item_status' => 1
						);
				$item_id = $this->input->post('item_id');
				if($item_id){
					 
                     $data['item_id'] = $item_id;
                     $result = $this->General_model->update($this->table,$data,'item_id',$item_id);
                     $operation = array(
						 'user_id' => $this->session->userdata('id'),
						 'operation' => 'Modified',
						 'to_whom' => $item_id,
						 'date' => date('Y-m-d'),
						 'operation_id' => 9
					 );

					 for($i=1;$i<$temp;$i++)
					 {
						 if($item_quantity[$i]!=''){
						 $data_itemprice = array(
							 'item_id_fk' =>$item_id,
							 'quantity' => $item_quantity[$i],
							 'price' => $item_price[$i],
							 'date' => date('Y-m-d')
						 );
						 
						 
						 $this->General_model->add('tbl_itemprice',$data_itemprice);
						 }
						 
					 }
					 $this->General_model->add_operation($operation);
                     $response_text = 'Item  updated successfully';
                }
				else{
                     $result = $this->General_model->add($this->table,$data);
                     $id = $this->db->insert_id();
                     $operation = array(
						 'user_id' => $this->session->userdata('id'),
						 'operation' => 'Added',
						 'to_whom' => $id,
						 'date' => date('Y-m-d'),
						 'operation_id' => 9
					 );
					 
					 $this->General_model->add_operation($operation);
					 $itemid = $this->db->insert_id();
                     $response_text = 'Item added  successfully';
                }
				if(isset($itemid))
				{
					for($i=1;$i<$temp;$i++)
					{
						if($item_quantity[$i]!=''){
						$data_itemprice = array(
							'item_id_fk' => $id,
							'quantity' => $item_quantity[$i],
							'price' => $item_price[$i],
							'date' => date('Y-m-d')
						);
						
						
						$this->General_model->add('tbl_itemprice',$data_itemprice);
						}
						
					}
					
					if($branches){
					for($i=0; $i < count($branches); $i++)
					{
						$rop_data = array(
						'item_id_fk' => $itemid,
						'branch_id_fk' => $branches[$i],
						'item_rop' => $item_rop,
						'status' => 1
						);
						$this->General_model->add($this->tbl_rop,$rop_data);
						
					}
					}
				}
				if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
	        redirect('/item', 'refresh');
		}
	}
	public function get(){
		$this->load->model('Item_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->Item_model->getItemTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function delete(){
        $item_id = $this->input->post('item_id');
        $updateData = array('item_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'item_id',$item_id);
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
    }
	public function edit($item_id){
		$template['category'] = $this->Item_model->get_category();
		$template['branch'] = $this->Users_model->get_branch();
		$template['body'] = 'Item/add';
		$template['script'] = 'Item/script';
		$template['records'] = $this->General_model->get_row($this->table,'item_id',$item_id);
    	$this->load->view('template', $template);
	}
	public function update_branch()
	{
		$item_id = $this->input->post('item_id');
		$branch = $this->input->post('branch');
		$item = $this->Item_model->get_item_rop($item_id);
		$item_rop = $item->item_rop;
		$rop = $this->Item_model->get_rop_details($item_id,$branch);
		$rop_data = array(
						'item_id_fk' => $item_id,
						'branch_id_fk' => $branch,
						'item_rop' => $item_rop,
						'status' => 1
						);
		if($rop == 0)
		{
			$data = $this->General_model->add($this->tbl_rop,$rop_data);
			$response['text'] = 'Added successfully';
            $response['type'] = 'success';
		}
		else
		{
            $response['text'] = 'Already Exists';
            $response['type'] = 'success';
        }
		$response['layout'] = 'topRight';
        $data_json = json_encode($response);
        echo $data_json;
	}
	
	
	function view(){
		
		
		$item_id = $this->uri->segment(3);
		$template['records'] = $this->Item_model->get_itemprice($item_id);
		
	
		
		$template['body']='Item/price';
		$template['script'] = 'Item/script';
		
		$this->load->view('template',$template);
	}
}
?>
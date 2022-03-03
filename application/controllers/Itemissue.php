<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Itemissue extends MY_Controller {
	public $table = 'tbl_stock';
	public $tbl_stockup = 'tbl_stockup';
	public $page  = 'Itemissue';
	public function __construct() {
        parent::__construct();
        if(! $this->is_logged_in()){
            redirect('/login');
        }
        
        $this->load->model('General_model');
        $this->load->model('Users_model');
        $this->load->model('Itemissue_model');
    }
    public function index()
    {
        $template['body'] = 'Itemissue/list';
        $template['script'] = 'Itemissue/script';
        $this->load->view('template', $template);
    }
    public function add(){
            $this->form_validation->set_rules('item_name', 'Name', 'required');
            if ($this->form_validation->run() == FALSE) {
				$template['branch'] = $this->Users_model->get_branch();
                $template['body'] = 'Itemissue/add';
                $template['script'] = 'Itemissue/script';
                $this->load->view('template', $template);
            }
            else{
                    $branch = $this->input->post('branch');
                    $item_id = $this->input->post('item_id');
                    $itemstock = $this->input->post('item_stock');
                    $checkitem = $this->Itemissue_model->checkitem($branch,$item_id);
					if($checkitem !="")
					{
						$item_stock = $checkitem->item_quantity + $itemstock;
						$issuedqua = $checkitem->issuedqua + $itemstock;
						$used_quantity = $checkitem->used_quantity;
						$issued = $checkitem->issued + $itemstock;
					}
					else
					{
						$item_stock = $itemstock;
						$issuedqua = $itemstock;
						$used_quantity = 0;
						$issued = $itemstock;
					}
                    if($branch!='' && $item_id!='' && $item_stock!='')
                    {
                            $ropid = $this->Itemissue_model->getrop_id($branch , $item_id);
                            $rop_id = $ropid->rop_id;
							$item_rop = $ropid->item_rop;
							$itemname = $this->Itemissue_model->getitemName($item_id);
                            $itemname = $itemname->item_name;
							$data = array(
								'item_id_fk' => $item_id,
								'branch_id_fk' => $branch,
								'item_name' => $itemname,
								'item_quantity'=>$item_stock,
								'issuedqua'=>$issuedqua,
								'used_quantity'=>$used_quantity,
								'issued'=>$issued,
								'item_rop'=>$item_rop,
								'stock_status'=>1
								);
							$stock_id = $this->input->post('stock_id');
							if($stock_id){
								 
								 $data['stock_id'] = $stock_id;
								 $result = $this->General_model->update($this->table,$data,'stock_id',$stock_id);
								 $tbl_stockup = array('stock_id_fk'=>$stock_id,'item_id_fk'=>$item_id,'branch_id_fk'=>$branch,'up_date'=>date('Y-m-d'),'up_status'=>1);
								 $this->General_model->update($this->tbl_stockup,$tbl_stockup,'stock_id_fk',$stock_id);
								 $response_text = 'Stock  updated successfully';
							}
							else{
								 $result = $this->General_model->add($this->table,$data);
								 $stock_id_fk = $this->db->insert_id(); 
								 $tbl_stockup = array('stock_id_fk'=>$stock_id_fk,'item_id_fk'=>$item_id,'branch_id_fk'=>$branch,'up_date'=>date('Y-m-d'),'up_status'=>1);
								 $this->General_model->add($this->tbl_stockup,$tbl_stockup);
								 $response_text = 'Stock added  successfully';
							}	
                            
                    }
                    if($result){
                    $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
                    }
                    else{
                    $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
                    }
					redirect('/Itemissue/', 'refresh');
            }
    }
	public function get(){
		
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->Itemissue_model->getStockTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function edit($stock_id){
		
		$template['branch'] = $this->Users_model->get_branch();
		$template['records'] = $this->General_model->get_row($this->table,'stock_id',$stock_id);
		$template['body'] = 'Itemissue/add';
		$template['script'] = 'Itemissue/script';
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
		redirect('/Itemissue/', 'refresh');
    }
	
}
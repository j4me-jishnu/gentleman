<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Setrop extends MY_Controller {
public $table = 'tbl_rop';
public $tbl_stock = 'tbl_stock';
public $page  = 'setrop';
public function __construct() {
parent::__construct();
if(! $this->is_logged_in()){
redirect('/login');
}

$this->load->model('General_model');
$this->load->model('Users_model');
$this->load->model('Setrop_model');
}
public function index()
{

$template['body'] = 'Setrop/list';
$template['script'] = 'Setrop/script1';
$this->load->view('template', $template);
}
public function add()
{
$this->form_validation->set_rules('item_id', 'Name', 'required');
if ($this->form_validation->run() == FALSE) 
{
$template['item'] = $this->General_model->get_item();
$template['branch'] = $this->General_model->get_br();
$template['a'] = 1;
$template['body'] = 'Setrop/add';
$template['script'] = 'Setrop/script';
$this->load->view('template', $template);
}
else{
$branch = $this->input->post('branchid');
$item_id = $this->input->post('item_id');
$item_rop = $this->input->post('item_rop');
$checkitem = $this->Setrop_model->checkitem($branch,$item_id);
if($branch!='' && $item_id!='' && $item_rop!='')
{
 //$ropid = $this->Setrop_model->getrop_id($branch , $item_id);
// $rop_id = $ropid->rop_id;
// if($checkitem)
// {
//     $stock_id = $checkitem->stock_id;
//     $up_stockdata = array('item_rop'=>$item_rop);
//     $this->General_model->update($this->tbl_stock,$up_stockdata,'stock_id',$stock_id);
// }
// $data = array(
//                 'item_rop' => $item_rop
//             );
// $result = $this->General_model->update($this->table,$data,'rop_id',$rop_id);
// $response_text = 'ROP updated successfully';

$ropid = $this->Setrop_model->getrop_id($branch,$item_id);

// $rop_id = $ropid->rop_id;
$data1 = array(
'item_rop' => $item_rop,
'item_id_fk' =>$item_id,

'branch_id_fk' =>$branch,
'status' =>1
);
$data2 = array(
'item_rop' => $item_rop
);
if($ropid == false)
{

$result = $this->Setrop_model->add1($data1);
$id = $this->db->insert_id();
$operation = array(
'user_id' => $this->session->userdata('id'),
'operation' => 'Branch rop added',
'to_whom' => $item_id,
'date' => date('Y-m-d'),
'operation_id' => 8,
'value' =>$item_rop
);

}
else
{
$operation = array(
'user_id' => $this->session->userdata('id'),
'operation' => 'Branch rop Modified',
'to_whom' => $item_id,
'date' => date('Y-m-d'),
'operation_id' => 8,
'value' =>$item_rop
);
$rop_id = $ropid->rop_id;
$result = $this->General_model->update($this->table,$data2,'rop_id',$rop_id);

}
$this->General_model->add_operation($operation);

$response_text = 'ROP updated successfully';
}
//if($result){
//$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
//}

redirect('/Setrop/', 'refresh');
}
}

public function get()
{   
$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
$param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
$param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
$param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
$param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
$param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
$data = $this->Setrop_model->getRopTable($param);
$json_data = json_encode($data);
echo $json_data;
}

public function edit($rop_id)
{
$template['body'] = 'Setrop/add';
$template['script'] = 'Setrop/script1';
$template['branch'] = $this->General_model->get_branch($rop_id);
$template['item'] = $this->General_model->getitems($rop_id);
$template['records'] = $this->General_model->get_row($this->table,'rop_id',$rop_id);
$this->load->view('template', $template);
}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Setmrop extends MY_Controller {
	public $table = 'tbl_master_rop';
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
        $template['branch'] = $this->Users_model->get_branch();
        $template['body'] = 'setmrop/list';
        $template['script'] = 'setmrop/script';
        $this->load->view('template', $template);
    }
    public function add(){
        $this->form_validation->set_rules('item_id', 'Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $template['body'] = 'setmrop/add';
            $template['item'] = $this->General_model->get_item();
            $template['a']=1;
            $template['script'] = 'setmrop/script1';
            $this->load->view('template', $template);
        }
        else{

            $item_id = $this->input->post('item_id');
            $item_rop = $this->input->post('item_rop');
            $checkitem = $this->Setrop_model->checkMasteritem($item_id);
            if($item_id!='' && $item_rop!='')
            {
                $ropid = $this->Setrop_model->getMasterrop_id($item_id);
                           // $rop_id = $ropid->rop_id;
                $data1 = array(
                    'item_rop' => $item_rop,
                    'item_id_fk' =>$item_id,
                    'branch_id_fk' =>0,
                    'rop_status' =>1
                );
                $data2 = array(
                    'item_rop' => $item_rop
                );
                if($ropid == false)
                {

                   $result = $this->Setrop_model->add($data1);
                   $response_text = 'ROP added successfully';
                   $id = $this->db->insert_id();
                   $operation = array(
                       'user_id' => $this->session->userdata('id'),
                       'operation' => 'Master rop added',
                       'to_whom' => $item_id,
                       'date' => date('Y-m-d'),
                       'operation_id' => 6,
                       'value' =>$item_rop
                   );

               }
               else
               {
                $rop_id = $ropid->rop_id;
                $result = $this->General_model->update($this->table,$data2,'rop_id',$rop_id);
                $response_text = 'ROP updated successfully';
                $operation = array(
                   'user_id' => $this->session->userdata('id'),
                   'operation' => 'Master rop modified',
                   'to_whom' => $item_id,
                   'date' => date('Y-m-d'),
                   'operation_id' => 6,
                   'value' =>$item_rop
               );

            }

            $this->General_model->add_operation($operation);


                    /*$operation = array(
                        'user_id' => $this->session->userdata('id'),
                        'operation' => 'Modified',
                        'to_whom' => $rop_id,
                        'date' => date('Y-m-d'),
                        'operation_id' => 6
                    );
                    $this->General_model->add_operation($operation);*/

                }
                if($result){
                    $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
                }
                else{
                    $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
                }
                redirect('/Setmrop/', 'refresh');
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

            $data = $this->Setrop_model->getMasterRopTable($param);
            $json_data = json_encode($data);
            echo $json_data;
        }




        public function edit($rop_id)
        {
            $template['body'] = 'setmrop/add';
            $template['script'] = 'setmrop/script';
            $template['item'] = $this->General_model->getitemname($rop_id);
//print_r($template['item']);
            $template['records'] = $this->General_model->get_row($this->table,'rop_id',$rop_id);
//print_r($template['records']);
            $this->load->view('template', $template);
        }

        function delete(){

         $rop_id = $this->input->post('rop_id');




         $this->General_model->delete('tbl_master_rop','rop_id',$rop_id);

         $response['text'] = 'Deleted successfully';
         $response['type'] = 'success';
         echo json_encode($response);

     }

 }
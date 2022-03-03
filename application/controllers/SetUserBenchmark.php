<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SetUserBenchmark extends MY_Controller {
	public $table = 'issue_benchmark';
    public $tabler = 'issue_benchmark_report';
	public $tbl_stock = 'tbl_stock';
	public $page  = 'setrop';
	public function __construct() {
        parent::__construct();
        if(! $this->is_logged_in()){
            redirect('/login');
        }
          $this->load->model('General_model');
        $this->load->model('Purchase_model');
        $this->load->model('Issueitem_model');
         $this->load->model('Users_model');
        $this->load->model('Branch_Benchmark_model');
    }
    public function index()
    {
        $template['refno'] = $this->Purchase_model->Refnumb();
        $branch_id = $template['refno'][0]->branch_id;
        $template['users'] = $this->Issueitem_model->get_users($branch_id);
        $template['body'] = 'UserBenchmark/list';
        $template['script'] = 'UserBenchmark/script1';
        $this->load->view('template', $template);
    }
    public function add(){
            $this->form_validation->set_rules('item_name', 'Name', 'required');
            if ($this->form_validation->run() == FALSE) {
                $template['refno'] = $this->Purchase_model->Refnumb();
                $branch_id = $template['refno'][0]->branch_id;
                $template['users'] = $this->Issueitem_model->get_users($branch_id);
                $template['branch'] = $this->Issueitem_model->get_branchuser();
               // print_r( $template['branch']);
                $template['body'] = 'UserBenchmark/add';
                $template['script'] = 'UserBenchmark/script';
                $this->load->view('template', $template);
            }
            else{
                    $template['refno'] = $this->Purchase_model->Refnumb();
                    $branch_id = $template['refno'][0]->branch_id;   
                    $user = $this->input->post('user');
                    $item_id = $this->input->post('item_id');
                    $item_rop = $this->input->post('benchmark');
                    $idate = $this->input->post('idate');
                    $fdate = $this->input->post('fdate');
                    $checkitem = $this->Branch_Benchmark_model->checkitem($user,$item_id);
                    if($user!='' && $item_id!='' && $item_rop!='')
                    {

                            $ropid = $this->Branch_Benchmark_model->getrop_id($user,$item_id);
                            $data1 = array(
                                            'benchmark' => $item_rop,
                                            'item_id_fk' =>$item_id,
                                            'user_id_fk' =>$user,
                                            'branch_id_fk' =>$branch_id,
                                            'initial_date' =>$idate,
                                            'final_date' =>$fdate
                                            
                                            );
                             $data2 = array(
                                            'benchmark' => $item_rop,
                                            'initial_date' =>$idate,
                                            'final_date' =>$fdate
                                        );
                             $data3 = array(
                                            'benchmark' => $item_rop,
                                            'item_id_fk' =>$item_id,
                                            'user_id_fk' =>$user,
                                            'branch_id_fk' =>$branch_id,
                                            'initial_date' =>$idate,
                                            'final_date' =>$fdate
                                           
                                        );
                             if($ropid == false)
                             {
                                 $result = $this->Branch_Benchmark_model->add1($data1);
                                 $id = $this->db->insert_id();
                                 $operation = array(
                                     'user_id' => $this->session->userdata('id'),
                                     'operation' => 'Branch Bench mark added',
                                     'to_whom' => $item_id,
                                     'date' => date('Y-m-d'),
                                     'operation_id' => 22,
                                     'value' =>$user
                                 );
                             
                             }
                            else
                            {
                                $operation = array(
                                 'user_id' => $this->session->userdata('id'),
                                 'operation' => 'Branch Bench mark Modified',
                                 'to_whom' => $item_id,
                                 'date' => date('Y-m-d'),
                                 'operation_id' => 22,
                                 'value' =>$user
                             );
                                $rop_id = $ropid->id;
                                 $result = $this->General_model->update($this->table,$data2,'id',$rop_id);
                                
                            }
                            $this->General_model->add_operation($operation);
                            $this->General_model->add($this->tabler,$data3);
                     
                        $response_text = 'Benchmark updated successfully';
                    }
                    if($result){
                    $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
                    }
                   
            redirect('/SetUserBenchmark/', 'refresh');
            }
    }

    public function get()
    {   
        $template['refno'] = $this->Purchase_model->Refnumb();
        $branch_id = $template['refno'][0]->branch_id;
        $param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
         $data = $this->Branch_Benchmark_model->getBenchTable($param,$branch_id);
        $json_data = json_encode($data);
        echo $json_data;
    }
}
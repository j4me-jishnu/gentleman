<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SetMasterBenchmark extends MY_Controller {
	public $table = 'master_benchmark';
    public $tabler = 'master_benchmark_report';
	public $tbl_stock = 'tbl_stock';
	public $page  = 'setrop';
	public function __construct() {
        parent::__construct();
        if(! $this->is_logged_in()){
            redirect('/login');
        }
        
        $this->load->model('General_model');
        $this->load->model('Users_model');
        $this->load->model('Master_Benchmark_model');
    }
    public function index()
    {
        $template['master'] =$this->Master_Benchmark_model->getBenchmasterTable();
        $template['body'] = 'MasterBenchmark/list';
        $template['script'] = 'MasterBenchmark/script1';
        $this->load->view('template', $template);
    }
    public function add(){
            $this->form_validation->set_rules('item_name', 'Name', 'required');
            if ($this->form_validation->run() == FALSE) {
                $template['branch'] = $this->Users_model->get_branch();
                $template['body'] = 'MasterBenchmark/add';
                $template['script'] = 'MasterBenchmark/script';
                $this->load->view('template', $template);
            }
            else{
                    $branch = $this->input->post('branch');
                    $item_id = $this->input->post('item_id');
                    $item_rop = $this->input->post('benchmark');
                    $idate = $this->input->post('idate');
                    $fdate = $this->input->post('fdate');
                    $checkitem = $this->Master_Benchmark_model->checkitem($branch,$item_id);
                    if($branch!='' && $item_id!='' && $item_rop!='')
                    {

                            $ropid = $this->Master_Benchmark_model->getrop_id($branch,$item_id);
                            $data1 = array(
                                            'benchmark' => $item_rop,
                                            'item_id_fk' =>$item_id,
                                            'branch_id_fk' =>$branch,
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
                                            'branch_id_fk' =>$branch,
                                            'initial_date' =>$idate,
                                            'final_date' =>$fdate
                                           
                                        );
                             if($ropid == false)
                             {
                                 $result = $this->Master_Benchmark_model->add1($data1);
                                 $id = $this->db->insert_id();
                                 $operation = array(
                                     'user_id' => $this->session->userdata('id'),
                                     'operation' => 'Master Bench mark added',
                                     'to_whom' => $item_id,
                                     'date' => date('Y-m-d'),
                                     'operation_id' => 21,
                                     'value' =>$branch
                                 );
                             
                             }
                            else
                            {
                                $operation = array(
                                 'user_id' => $this->session->userdata('id'),
                                 'operation' => 'Master Bench mark Modified',
                                 'to_whom' => $item_id,
                                 'date' => date('Y-m-d'),
                                 'operation_id' => 21,
                                 'value' =>$branch
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
                   
            redirect('/SetMasterBenchmark/', 'refresh');
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
        
        $data = $this->Master_Benchmark_model->getBenchTable($param);
        $json_data = json_encode($data);
        echo $json_data;
    }

    public function get_master()
    {   
        $param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
        $data = $this->Master_Benchmark_model->getBenchmasterTable($param);
        $json_data = json_encode($data);
        echo $json_data;
    }



    public function edit($id)
{
$template['body'] = 'MasterBenchmark/add';;
$template['script'] = 'MasterBenchmark/script';
$template['branch'] = $this->General_model->get_branchmaster($id);
$template['item'] = $this->General_model->getitemmaster($id);

$template['records'] = $this->General_model->get_row($this->table,'id',$id);
$this->load->view('template', $template);
}
}
<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Branch extends MY_Controller
{
    public $table = ' tbl_branch';
    public $page  = 'Branch';
    public function __construct()
    {

        parent::__construct();
        if (!$this->is_logged_in()) {
            redirect('/login');
        }
        $this->load->library('email');

        $this->load->model('General_model');
        $this->load->model('Branch_model');
    }
    public function index()
    {
        $template['body'] = 'Branch/list';
        $template['script'] = 'Branch/script';
        $this->load->view('template', $template);
    }
    public function add()
    {
        $this->form_validation->set_rules('branch_name', 'Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $template['body'] = 'Branch/add';
            $template['script'] = 'Branch/script';
            $this->load->view('template', $template);
        } else {
            $is_ac = $this->input->post('is_active');
            if ($is_ac == '') {
                $is_ac = 0;
            }
            $is_head = $this->input->post('is_head');
            if ($is_head == '') {
                $is_head = 0;
            }
            $data = array(
                'br_id' => $this->input->post('br_id'),
                'branch_name' => $this->input->post('branch_name'),
                'branch_address' => $this->input->post('branch_address'),
                'branch_phone' => $this->input->post('branch_phone'),
                'branch_email' => $this->input->post('branch_email'),

                'branch_status' => 1
            );
            $branch_id = $this->input->post('branch_id');
            if ($branch_id) {

                $data['branch_id'] = $branch_id;
                $result = $this->General_model->update($this->table, $data, 'branch_id', $branch_id);
                $operation = array(
                    'user_id' => $this->session->userdata('id'),
                    'operation' => 'Modified',
                    'to_whom' => $branch_id,
                    'date' => date('Y-m-d'),
                    'operation_id' => 4
                );
                $this->General_model->add_operation($operation);
                $response_text = 'Branch  updated successfully';
            } else {
                $result = $this->General_model->add($this->table, $data);
                $id = $this->db->insert_id();
                $operation = array(
                    'user_id' => $this->session->userdata('id'),
                    'operation' => 'Added',
                    'to_whom' => $id,
                    'date' => date('Y-m-d'),
                    'operation_id' => 4
                );
                $this->General_model->add_operation($operation);
                $response_text = 'Branch added  successfully';
            }
            if ($result) {
                $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
            } else {
                $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
            }
            redirect('/Branch/', 'refresh');
        }
    }
    public function get()
    {
        $this->load->model('Branch_model');
        $param['draw'] = (isset($_REQUEST['draw'])) ? $_REQUEST['draw'] : '';
        $param['length'] = (isset($_REQUEST['length'])) ? $_REQUEST['length'] : '10';
        $param['start'] = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : '0';
        $param['order'] = (isset($_REQUEST['order'][0]['column'])) ? $_REQUEST['order'][0]['column'] : '';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order'][0]['dir'] : '';
        $param['searchValue'] = (isset($_REQUEST['search']['value'])) ? $_REQUEST['search']['value'] : '';

        //$data = $this->Branch_model->getBranchTable($param);
        $data = $this->Branch_model->getBranchTable2($param);
        $json_data = json_encode($data);
        echo $json_data;
    }
    public function delete()
    {
        $branch_id = $this->input->post('branch_id');
        $updateData = array('branch_status' => 0);
        $data = $this->General_model->update($this->table, $updateData, 'branch_id', $branch_id);
        if ($data) {
            $operation = array(
                'user_id' => $this->session->userdata('id'),
                'operation' => 'Deleted',
                'to_whom' => $branch_id,
                'date' => date('Y-m-d'),
                'operation_id' => 4
            );
            $this->General_model->add_operation($operation);
            $response['text'] = 'Deleted successfully';
            $response['type'] = 'success';
        } else {
            $response['text'] = 'Something went wrong';
            $response['type'] = 'error';
        }
        $response['layout'] = 'topRight';
        $data_json = json_encode($response);
        echo $data_json;
        //redirect('/branch/', 'refresh');
    }
    public function edit($branch_id)
    {
        $template['body'] = 'Branch/add';
        $template['script'] = 'Branch/script';
        $template['records'] = $this->General_model->get_row($this->table, 'branch_id', $branch_id);
        $this->load->view('template', $template);
    }
}

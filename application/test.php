html

<div class="box-body table-responsive">
  <table id="branch_table" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Slno</th>
        <th>Name</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Edit / Delete</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>

script
<script type="text/javascript">
$table = $('#branch_table').DataTable( {
  "processing": true,
  "serverSide": true,
  "bDestroy" : true,
  dom: 'lBfrtip',
  buttons: [
    {
      extend: 'copy',
      exportOptions: {
        columns: [ 1, 2, 3 , 4 ]
      }
    },
    {
      extend: 'excel',
      exportOptions: {
        columns: [ 1, 2, 3 , 4 ]
      }
    },
    {
      extend: 'pdf',
      exportOptions: {
        columns: [ 1, 2, 3 , 4 ]
      }
    },
    {
      extend: 'print',
      exportOptions: {
        columns: [ 1, 2, 3 , 4 ]
      }
    },
    {
      extend: 'csv',
      exportOptions: {
        columns: [ 1, 2, 3 , 4 ]
      }
    },
  ],
  "ajax": {
    "url": "<?php echo base_url();?>branch/get/",
    "type": "POST",
    "data" : function (d) {

    }
  },
  "createdRow": function ( row, data, index ) {

    $table.column(0).nodes().each(function(node,index,dt){
      $table.cell(node).data(index+1);
    });
    var h = data['is_head'];
    if(h==1){ var head='head office'; }else{head=''}
    $('td', row).eq(5).html('<center><?php $u = $this->session->userdata('user_type'); if($u != 'S'){ ?><a href="<?php echo base_url();?>branch/edit/'+data['branch_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['branch_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a><?php } ?></center>');
    $('td', row).eq(1).html('<center>'+data['branch_name']+'&nbsp;&nbsp;<span style="color:green">'+head+'</span</center>');
  },

  "columns": [
    { "data": "branch_status", "orderable": true },
    { "data": "branch_name", "orderable": false },
    { "data": "branch_address", "orderable": false },
    { "data": "branch_phone", "orderable": false },
    { "data": "branch_email", "orderable": false },
    { "data": "branch_id", "orderable": false }

  ]
} );
</script>

<?php
add in controller
$param['draw'] = (isset($_REQUEST['draw'])) ? $_REQUEST['draw'] : '';
$param['length'] = (isset($_REQUEST['length'])) ? $_REQUEST['length'] : '10';
$param['start'] = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : '0';
$param['order'] = (isset($_REQUEST['order'][0]['column'])) ? $_REQUEST['order'][0]['column'] : '';
$param['dir'] = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order'][0]['dir'] : '';
$param['searchValue'] = (isset($_REQUEST['search']['value'])) ? $_REQUEST['search']['value'] : '';

$data = $this->Branch_model->getBranchTable($param);
$json_data = json_encode($data);
echo $json_data;

add in model

public function getBranchTable($param){
  $arOrder = array('','branch_name');
  $searchValue =($param['searchValue'])?$param['searchValue']:'';
  if($searchValue){
    $this->db->like('branch_name', $searchValue);
  }
  $this->db->where("branch_status",1);
  if ($param['start'] != 'false' and $param['length'] != 'false') {
    $this->db->limit($param['length'],$param['start']);
  }
  $this->db->select('*');
  $this->db->from('tbl_branch');
  $this->db->order_by('branch_id', 'DESC');
  $query = $this->db->get();
  $data['data'] = $query->result();
  $data['recordsTotal'] = $this->getBranchTotalCount($param);
  $data['recordsFiltered'] = $this->getBranchTotalCount($param);
  return $data;

  public function getBranchTotalCount($param = NULL){
    $searchValue =($param['searchValue'])?$param['searchValue']:'';
    if($searchValue){
      $this->db->like('branch_name', $searchValue);
    }
    $this->db->select('*');
    $this->db->from('tbl_branch');
    $this->db->order_by('branch_id', 'DESC');
    $this->db->where("branch_status",1);
    $query = $this->db->get();
    return $query->num_rows();
  }
}



?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Users Details
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url();?>Users/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
      <li class="active">Users Details</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="box">
       <div class="row">
        <!-- <div class="col-md-3">
         <div class="input-group margin">
           <div class="input-group-btn">
            <button type="button" class="btn btn-primary nohover">Name</button>
          </div>
          <input type="text" name="user_name" placeholder="Name" id="user_name" class="form-control">
          <input type="hidden" id="user_id">
        </div>
      </div>	 -->


      <!-- <div class="col-sm-1">
       <div class="input-group">
        <button type="button" id="search" class="btn bg-orange btn-flat margin" onclick="<?php if(isset($values->mainhead_id))echo $values->mainhead_id;?>">Search</button>
      </div>
    </div> -->
  </div>
  <div class="box-header">
    <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
    <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
    <div class="col-md-8"><h2 class="box-title"></h2> </div>
    <div class="col-md-2">
      <a href="<?php echo base_url();?>Users_branch/add" class="btn btn-primary"><i class="fa fa-plus-square"></i>  Add User</a>
    </div>
    <div class="btn-group">
      <button type="button" class="btn btn-success">Action</button>
      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
      </button>
      <ul class="dropdown-menu" role="menu">
        <li><a href="<?php echo base_url();?>dashboard">Dashboard</a></li>
        <li><a href="<?php echo base_url();?>branch">Branch</a></li>
        <li><a href="<?php echo base_url();?>users">Users</a></li>
        <li><a href="<?php echo base_url();?>designation">Designation</a></li>
      </ul>
    </div>
  </div>
  <input type="hidden" name="a" id="uid">
  <!-- /.box-header -->
  <!-- <div class="box-body table-responsive">
    <table id="user_table" class="table table-bordered table-striped">
      <thead>
        <tr>
         <th>Slno</th>
         <th>Name</th>
         <th>Address</th>
         <th>Branch</th>
         <th>Phone</th>
         <th>Email</th>

         <th>Edit / Delete</th>
       </tr>
     </thead>
     <tbody>
      <?php

      foreach($records as $row){

       echo '<tr>
       <td>'.$row->user_id.'</td>
       <td>'.$row->username.'</td>
       <td>'.$row->user_address.'</td>
       <td>'.$row->branch_name.'</td>
       <td>'.$row->user_phone.'</td>
       <td>'.$row->user_email.'</td>
       <td><center><a href="'.base_url().'index.php/Users_branch/edit/'.$row->user_id.'"><i class="fa fa-edit iconFontSize-medium" ></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.base_url().'index.php/Users_branch/delete/'.$row->user_id.'"><i class="fa fa-trash-o iconFontSize-medium"></i></a></center></td>
       <tr>';

     }

     ?>


   </tbody>
 </table>
</div> -->

</div>
<!-- /.box -->

<div class="box">
  <div class="box-header">
    <h3 class="box-title">Users Deatils</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table id="user_table" class="table table-bordered table-striped">
      <thead>
        <tr>
         <th>Slno</th>
         <th>Name</th>
         <th>Address</th>
         <th>Phone</th>
         <th>Email</th>
       </tr>
     </thead>
     <tbody>
     </tbody>
   </table>
 </div>
 <!-- /.box-body -->
</div>
</div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(function () {
  //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Date picker
    $('#date').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy'
    });
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
  //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    $table = $('#user_table').DataTable( {
    "searching": false,
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "ajax": {
            "url": "<?php echo base_url();?>Dash_board/get/",
            "type": "POST",
            "data" : function (d) {

       }
        },
        "createdRow": function ( row, data, index ) {

      $table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
        },

        "columns": [
            { "data": "user_status", "orderable": true },
            { "data": "username", "orderable": false },
            { "data": "user_address", "orderable": false },
            { "data": "user_phone", "orderable": false },
      { "data": "user_email", "orderable": false }
        ]
    } );
});
</script>

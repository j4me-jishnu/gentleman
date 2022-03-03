
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Employee Details
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url();?>designation"><i class="fa fa-dashboard"></i> Back to View</a></li>
      <li class="active">Employee Details</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">

      <!-- right column -->
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title"></h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal" method="POST" action="<?php echo base_url();?>NewMaster/addEmployee">
            <!-- radio -->
            <div class="form-group">
              <input type="hidden" name="emp_id" value="<?php if(isset($records[0]->emp_id)) echo $records[0]->emp_id ?>"/>
              <label for="inputEmail3" class="col-sm-2 control-label"></label>
            </div>
            <div class="box-body">

            <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">Branch Name<span style="color:red">*</span></label>
                <div class="col-sm-6">
                <select class="form-control" name="branch_name">
                    <option>SELECT</option>
                  <?php foreach($branch_list as $branch_lists){ ?>
                    <option value="<?php echo $branch_lists->branch_name ?>" <?php if(isset($records[0]->branch_name)) { if($records[0]->branch_name == $branch_lists->branch_name) { ?> selected="selected"<?php } } ?>><?php echo $branch_lists->branch_name ?></option>
                  <?php } ?>  
                </select>
                </div>
              </div>

              <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">Designation Name<span style="color:red">*</span></label>
                <div class="col-sm-6">
                <select class="form-control" name="desg_id">
                    <option>SELECT</option>
                  <?php foreach($desg_list as $desg_lists){ ?>
                    <option value="<?php echo $desg_lists->desg_id ?>" <?php if(isset($records[0]->desg_id_fk)) { if($records[0]->desg_id_fk == $desg_lists->desg_id) { ?> selected="selected"<?php } } ?>><?php echo $desg_lists->desg_name ?></option>
                  <?php } ?>  
                </select>
                </div>
              </div>

              <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">Emplopyee Name<span style="color:red">*</span></label>

                <div class="col-sm-6">
                  <input type="text" class="form-control" name="emp_name" id="emp_name" placeholder="Enter Employee Name" value="<?php if(isset($records[0]->emp_name)) echo $records[0]->emp_name ?>">
                  <small><?php echo validation_errors(); ?></small>
                </div>
              </div>

              <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">Address</label>

                <div class="col-sm-6">
                  <input type="text" class="form-control" name="emp_address" id="emp_address" placeholder="Enter Employee Address" value="<?php if(isset($records[0]->emp_address)) echo $records[0]->emp_address ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">Phone No</label>

                <div class="col-sm-6">
                  <input type="text" class="form-control" name="emp_phone" id="emp_phone" placeholder="Enter Employee Phone No" value="<?php if(isset($records[0]->emp_phone_no)) echo $records[0]->emp_phone_no ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">Email</label>

                <div class="col-sm-6">
                  <input type="text" class="form-control" name="emp_mail" id="emp_mail" placeholder="Enter Employee Mail ID" value="<?php if(isset($records[0]->emp_email)) echo $records[0]->emp_email ?>">
                </div>
              </div>
             
              <div class="form-group">
                <div class="col-sm-6">
                  <input class="btn btn-primary" type="submit" value="SAVE" name="submit">
                </div>
              </div>
            </div>

            <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </div>
      <!--/.col (right) -->
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

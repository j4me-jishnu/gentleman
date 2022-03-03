
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add Category Details
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url();?>designation"><i class="fa fa-dashboard"></i> Back to View</a></li>
      <li class="active">Category Details</li>
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
          <form class="form-horizontal" method="POST" action="<?php echo base_url();?>NewMaster/addDesignation">
            <!-- radio -->
            <div class="form-group">
              <input type="hidden" name="desg_id" value="<?php if(isset($records->desg_id)) echo $records->desg_id ?>"/>
              <label for="inputEmail3" class="col-sm-2 control-label"></label>
            </div>
            <div class="box-body">

              <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">Category Name<span style="color:red">*</span></label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="desg_name" id="emp_name" placeholder="Enter Designation Name" value="<?php if(isset($records->desg_name)) echo $records->desg_name ?>">
                  <small><?php echo validation_errors(); ?></small>
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

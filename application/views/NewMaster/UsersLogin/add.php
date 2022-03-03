
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Users Login Details
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url();?>designation"><i class="fa fa-dashboard"></i> Back to View</a></li>
      <li class="active">Login Details</li>
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
          <form class="form-horizontal" method="POST" action="<?php echo base_url();?>NewMaster/addLoginUsersDetails">
            <!-- radio -->
            <div class="form-group">
              <input type="hidden" name="user_login_id" value="<?php if(isset($records[0]->id)) echo $records[0]->id ?>"/>
              <label for="inputEmail3" class="col-sm-2 control-label"></label>
            </div>
            <div class="box-body">

            <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">Branch Name<span style="color:red">*</span></label>
                <div class="col-sm-6">
                <select class="form-control" name="branch_name">
                    <option>SELECT</option>
                  <?php foreach($branch as $branch){ ?>
                    <option value="<?php echo $branch->branch_name ?>" <?php if(isset($records[0]->user_branch)) { if($records[0]->user_branch == $branch->branch_name) { ?> selected="selected"<?php } } ?>><?php echo $branch->branch_name ?></option>
                  <?php } ?>  
                </select>
                </div>
              </div>

              <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">User Name<span style="color:red">*</span></label>

                <div class="col-sm-6">
                  <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Enter User Name" value="<?php if(isset($records[0]->user_name)) echo $records[0]->user_name ?>">
                  <small><?php echo validation_errors(); ?></small>
                </div>
              </div>

              <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">User Email<span style="color:red">*</span></label>

                <div class="col-sm-6">
                  <input type="email" class="form-control" name="user_email" id="user_email" placeholder="Enter User Email ID" value="<?php if(isset($records[0]->user_email)) echo $records[0]->user_email ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">User Password<span style="color:red">*</span></label>

                <div class="col-sm-6">
                  <input type="password" class="form-control" name="user_password" id="user_password" placeholder="Enter User Password" value="<?php if(isset($records[0]->user_password)) echo $records[0]->user_password ?>">
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

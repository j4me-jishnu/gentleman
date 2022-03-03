<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Users Form

      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url(); ?>users"><i class="fa fa-dashboard"></i> Back to View</a></li>
      <li class="active">Users Form</li>
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
          <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>Users/add">
            <!-- radio -->
            <div class="form-group">
              <input type="hidden" name="user_id" value="<?php if (isset($records->user_id)) echo $records->user_id ?>" />
              <input type="hidden" name="log_id" value="<?php if (isset($records->login_id_fk)) echo $records->login_id_fk ?>" />
              <?php echo validation_errors(); ?>
              <label for="inputEmail3" class="col-sm-2 control-label"></label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <!-- <label for="size_name" class="col-sm-1 control-label">ID <span style="color:red">*</span></label>

                <div class="col-sm-3">
                  <input type="text" data-pms-required="true" class="form-control" name="ur_id" placeholder="ID" readonly value="<?php if (isset($records->ur_id)) {
                    echo $records->ur_id;
                  } else {
                    if (isset($userid->ur_id)){
                      echo $userid->ur_id + 1;
                    } else {
                      echo 1;
                    }
                  }  ?>">
                </div> -->
                <label for="size_name" class="col-sm-1 control-label">Name <span style="color:red">*</span></label>

                <div class="col-sm-3">
                  <input type="text" data-pms-required="true" class="form-control" name="name" placeholder="Name" value="<?php if (isset($records->username)) echo $records->username ?>">
                </div>
              </div>
            </div>
            <div class="box-body">

            </div>
            <div class="box-body">
              <div class="form-group">
                <label for="description" class="col-sm-1 control-label">Address</label>

                <div class="col-sm-3">
                  <textarea class="form-control" name="user_address"><?php if (isset($records->user_address)) echo $records->user_address ?></textarea>
                </div>

                <label for="size_name" class="col-sm-1 control-label">Phone <span style="color:red">*</span></label>

                <div class="col-sm-3">
                  <input type="text" data-pms-required="true" class="form-control" name="user_phone" placeholder="Phone" value="<?php if (isset($records->user_phone)) echo $records->user_phone ?>">
                </div>
              </div>
            </div>
            <div class="box-body">
              <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">Email <span style="color:red">*</span></label>
                <div class="col-sm-3">
                  <input type="text" data-pms-required="true" class="form-control" name="user_email" placeholder="Email" value="<?php if (isset($records->user_email)) echo $records->user_email ?>">
                </div>
                <label for="size_name" class="col-sm-1 control-label">Designation<span style="color:red">*</span></label>
                <div class="col-sm-3">
                  <select id="designation" name="user_designation" data-pms-required="true" data-pms-type="alphanumericsOnly" class="form-control pull-right select2">
                    <option value="">----Please Select----</option>
                    <?php
                    foreach ($designation as $designations) {
                      $desig_names = isset($records->user_designation) ? $records->user_designation : '';
                      ?>
                      <option value="<?php echo $designations->desig_id ?>" <?php if ($desig_names == $designations->desig_id) echo "selected=selected" ?>><?php echo $designations->designation ?></option>
                      <?php
                    }
                    ?>

                  </select>
                </div>
              </div>
            </div>
            <div class="box-body userNpass">
              <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">Username<span style="color:red">*</span></label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Username" value="<?php if (isset($records->user_name)) echo $records->user_name ?>">
                </div>
                <label for="size_name" class="col-sm-1 control-label">Password<span style="color:red">*</span></label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="user_password" name="user_password" placeholder="Password" value="<?php if (isset($records->user_password)) echo $records->user_password ?>">
                </div>
              </div>
            </div>
            <div class="box-body">
              <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">Branch <span style="color:red">*</span></label>
                <div class="col-sm-3">
                  <select id="branch" name="user_branch" data-pms-required="true" data-pms-type="alphanumericsOnly" class="form-control pull-right select2">
                    <?php if (isset($records)) {
                      echo '<option  value="' . $records->branch_id . '">' . $records->branch_name . '</option>';
                    }
                    ?>
                    <option value="">----Please Select----</option>
                    <?php
                    foreach ($branch as $branchs) {
                      $branch_names = isset($records->user_branch) ? $records->user_branch : '';
                      echo '<option value="' . $branchs->branch_id . '">' . $branchs->branch_name . '</option>';
                      ?>

                      <?php
                    }
                    ?>

                  </select>
                </div>
                <label for="description" class="col-sm-1 control-label">Is Active</label>
                <div class="col-sm-3">
                  <input type="checkbox" id="is_active" name="is_active" value="1" <?php if (isset($records->active)) {
                    if ($records->active == 1) {
                      echo "checked = checked";
                    }
                  } ?> />
                  <input type="hidden" id="isactive" value="<?php if (isset($records->is_active)) echo $records->is_active ?>" />
                </div>

              </div>
              <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">Privilage <span style="color:red">*</span></label>

                <div class="col-sm-3">
                  <select id="privilage" name="privilage" data-pms-required="true" data-pms-type="alphanumericsOnly" class="form-control pull-right select2" required="required">
                    <option value="">select</option>
                    <option value="A" style="color:red" <?php if (isset($records->user_type)) {
                      if ($records->user_type == 'A') {
                        echo ' selected="selected"';
                      }
                    } ?>>Admin</option>
                    <option value="S" style="color:green" <?php if (isset($records->user_type)) {
                      if ($records->user_type == 'S') {
                        echo ' selected="selected"';
                      }
                    } ?>>User</option>
                    <option value="Su" style="color:blue" <?php if (isset($records->user_type)) {
                      if ($records->user_type == 'Su') {
                        echo ' selected="selected"';
                      }
                    } ?>>Super user</option>

                  </select>
                </div>
              </div>
              <?php
              if (isset($records) && $records->user_type == 'Su') {

                echo '<div id="setprivilage">
                <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">Give Access To:</label>

                <div class="col-sm-3">';
                if ($records->purchase == 1) {
                  echo '<input  type="checkbox" name="purchase" value="1" checked>Purchase<br>';
                } else {
                  echo '<input  type="checkbox" name="purchase" value="1">Purchase<br>';
                }
                if ($records->stockmove == 1) {
                  echo '<input  type="checkbox" name="stockmovement" value="1" checked>Sock move Request<br>';
                } else {
                  echo '<input  type="checkbox" name="stockmovement" value="1">Sock move Request<br>';
                }
                if ($records->masterstock == 1) {
                  echo '<input  type="checkbox" name="masterstock" value="1" checked>Master Stock<br>';
                } else {

                  echo '<input  type="checkbox" name="masterstock" value="1">Master Stock<br>';
                }
                if ($records->branchstock == 1) {
                  echo '<input  type="checkbox" name="branchstock" value="1" checked>Branch Stock<br>';
                } else {

                  echo '<input  type="checkbox" name="branchstock" value="1">Branch Stock<br>';
                }
                if ($records->returnstock == 1) {
                  echo '<input  type="checkbox" name="returnstock" value="1" checked>Return Stock<br>';
                } else {

                  echo '<input  type="checkbox" name="returnstock" value="1">Return Stock<br>';
                }
                if ($records->branchrequest == 1) {
                  echo '<input  type="checkbox" name="branchrequest" value="1" checked>Branch to Branch Request<br>';
                } else {
                  echo '<input  type="checkbox" name="branchrequest" value="1">Branch to Branch Request<br>';
                }
                if ($records->branch == 1) {
                  echo '<input  type="checkbox" name="branch" value="1" checked>Branch<br>';
                } else {
                  echo '<input  type="checkbox" name="branch" value="1">Branch<br>';
                }
                if ($records->scrap == 1) {
                  echo '<input  type="checkbox" name="scrap" value="1" checked>Scrap Items<br>';
                } else {
                  echo '<input  type="checkbox" name="scrap" value="1">Scrap Items<br>';
                }
                if ($records->designationaccess == 1) {
                  echo '<input  type="checkbox" name="designation" value="1" checked>Designation<br>';
                } else {
                  echo '<input  type="checkbox" name="designation" value="1">Designation<br>';
                }
                if ($records->users == 1) {
                  echo '<input  type="checkbox" name="users" value="1" checked>Users<br>';
                } else {

                  echo '<input  type="checkbox" name="users" value="1">Users<br>';
                }
                if ($records->vendor == 1) {
                  echo '<input  type="checkbox" name="vendor" value="1" checked>Vendor Details<br>';
                } else {
                  echo '<input  type="checkbox" name="vendor" value="1">Vendor Details<br>';
                }
                if ($records->product == 1) {
                  echo '<input  type="checkbox" name="product" value="1" checked>Product Request<br>';
                } else {
                  echo '<input  type="checkbox" name="product" value="1">Product Request<br>';
                }
                if ($records->inventory == 1) {
                  echo '<input  type="checkbox" name="inventory" value="1" checked>Inventory<br>';
                } else {

                  echo '<input  type="checkbox" name="inventory" value="1">Inventory<br>';
                }
                if ($records->rop == 1) {
                  echo '<input  type="checkbox" name="rop" value="1" checked>Rop<br>';
                } else {
                  echo '<input  type="checkbox" name="rop" value="1" checked>Rop<br>';
                }
                if ($records->report == 1) {
                  echo '<input  type="checkbox" name="report" value="1" checked>Reports<br>';
                } else {
                  echo '<input  type="checkbox" name="report" value="1">Reports<br>';
                }
                if ($records->log == 1) {
                  echo '<input  type="checkbox" name="log" value="1" checked>Log<br>';
                } else {
                  echo '<input  type="checkbox" name="log" value="1" >Log<br>';
                }

                echo '</div>
                </div>
                </div>';
              } else {
                echo '<div id="setprivilage" style="display:none">
                <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">Give Access To:</label>

                <div class="col-sm-3">
                <input  type="checkbox" name="purchase" value="1">Purchase<br>
                <input  type="checkbox" name="stockmovement" value="1">Sock move Request<br>
                <input  type="checkbox" name="masterstock" value="1">Master Stock<br>
                <input  type="checkbox" name="branchstock" value="1">Branch Stock<br>
                <input  type="checkbox" name="returnstock" value="1">Return Stock<br>
                <input  type="checkbox" name="branchrequest" value="1">Branch to Branch Request<br>
                <input  type="checkbox" name="branch" value="1">Branch<br>
                <input  type="checkbox" name="scrap" value="1">Scrap Items<br>
                <input  type="checkbox" name="designation" value="1">Designation<br>
                <input  type="checkbox" name="users" value="1">Users<br>
                <input  type="checkbox" name="vendor" value="1">Vendor Details<br>
                <input  type="checkbox" name="product" value="1">Product Request<br>
                <input  type="checkbox" name="inventory" value="1">Inventory<br>
                <input  type="checkbox" name="rop" value="1">Rop<br>
                <input  type="checkbox" name="report" value="1">Reports<br>
                <input  type="checkbox" name="log" value="1">Log<br>
                </div>
                </div>
                </div>';
              }
              ?>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="reset" class="btn">Cancel</button>
              <button type="submit" class="btn btn-info pull-right">Next</button>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
        <!-- /.box -->

      </div>
      <!--/.col (right) -->
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

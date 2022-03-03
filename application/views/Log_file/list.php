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
      <li><a href="<?php echo base_url();?>users/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
      <li class="active">Users Details</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="box">
        <div class="row">
          <div class="col-md-3">
            <div class="input-group margin">
              <div class="input-group-btn">
                <button type="button" class="btn btn-primary nohover">User Name</button>
              </div><!-- /btn-group-->
              <input type="text" name="user_name" placeholder="Name" id="user_name" class="form-control">
              <input type="hidden" id="user_id">
            </div><!-- /input-group -->
          </div>
          <div class="col-md-3">
            <div class="input-group margin">
              <div class="input-group-btn">
                <button type="button" class="btn btn-primary nohover">Designation</button>
              </div><!-- /btn-group -->
              <select id="designation"  name="user_designation" data-pms-required="true" data-pms-type="alphanumericsOnly" class="form-control pull-right select2" >
                <option value="0">Admin</option>
                <?php
                foreach($designation as $designations){
                  $desig_names = isset($records->user_designation)?$records->user_designation:'';
                  ?>
                  <option  value="<?php echo $designations->desig_id?>"<?php if($desig_names == $designations->desig_id) echo "selected=selected"?>><?php echo $designations->designation ?></option>
                  <?php
                }
                ?>

              </select>
            </div><!-- /input-group -->
          </div>
          <div class="col-md-3">
            <div class="input-group margin">
              <div class="input-group-btn">
                <button type="button" class="btn btn-primary nohover">Log</button>
              </div><!-- /btn-group -->
              <select name="log" id="log" data-pms-required="true" data-pms-type="alphanumericsOnly" class="form-control pull-right select2" >
                <option value="">----Please Select----</option>
                <option value="1">Designation</option>
                <option value="2">User</option>
                <option value="3">Vendor</option>
                <option value="4">Branch</option>
                <option value="5">Category</option>
                <option value="6">Master rop</option>
                <option value="7">Mail</option>
                <option value="8">Branch rop</option>
                <option value="9">Item</option>
                <option value="10">Purchase</option>
                <option value="11">Master to branch transfer</option>
                <option value="12">Issue item</option>
                <option value="13">Return item</option>
                <option value="15">Request item</option>
                <option value="16">Vendor Payment</option>
                <option value="20">Bench mark period</option>
                <option value="21">Master Bench mark</option>
                <option value="22">Branch Bench mark</option>


              </select>
            </div><!-- /input-group -->
          </div>
          <div class="col-sm-3">
            <div class="input-group margin">
              <div class="input-group-btn">
                <button type="button" class="btn btn-primary nohover">Action on</button>
              </div><!-- /btn-group-->
              <input type="text" name="action" placeholder="" id="action" class="form-control">
              <input type="hidden" id="user_id">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group margin">
              <div class="input-group-btn">
                <button type="button" class="btn btn-primary nohover">Date</button>
              </div><!-- /btn-group-->
              <input type="date" id="pmsDateStart" class="form-control" name="start_date">
              <input type="date" id="pmsDateEnd" class="form-control" name="end_date">
            </div>
          </div>

          <div class="col-sm-4">
            <div class="input-group">
              <button type="button" id="search" class="btn bg-orange btn-flat margin" onclick="<?php if(isset($values->mainhead_id))echo $values->mainhead_id;?>">Search</button>
            </div>
          </div>
        </div>

        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table id="log_table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <tr>
                  <th>SLNo</th>
                  <th>Date</th>
                  <th>User</th>
                  <th>User type</th>
                  <th>Action</th>
                  <th>Action on</th>
                </tr>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->


    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

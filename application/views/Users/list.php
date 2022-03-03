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
                <div class="col-md-3">
					<div class="input-group margin">
					<div class="input-group-btn">
						<button type="button" class="btn btn-primary nohover">Name</button>
					</div><!-- /btn-group-->
					<input type="text" name="user_name" placeholder="Name" id="user_name" class="form-control">
					<input type="hidden" id="user_id">
					</div><!-- /input-group -->
				</div>
				<div class="col-md-4">
					<div class="input-group margin">
					<div class="input-group-btn">
						<button type="button" class="btn btn-primary nohover">Designation</button>
					</div><!-- /btn-group -->
					<select id="designation"  name="user_designation" data-pms-required="true" data-pms-type="alphanumericsOnly" class="form-control pull-right select2" >
						<option value="">----Please Select----</option>
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
						<button type="button" class="btn btn-primary nohover">Branch</button>
					</div><!-- /btn-group -->
					<select name="user_branch" id="user_branch" data-pms-required="true" data-pms-type="alphanumericsOnly" class="form-control pull-right select2" >
						<option value="">----Please Select----</option>
							<?php
								foreach($branch as $branchs){
									$branch_names = isset($records->user_branch)?$records->user_branch:'';
									?>
								<option  value="<?php echo $branchs->branch_id?>"<?php if($branch_names == $branchs->branch_id) echo "selected=selected"?>><?php echo $branchs->branch_name ?></option>
								 <?php
									}
							?>

					</select>
					</div><!-- /input-group -->
				</div>
				<div class="col-sm-1">
					<div class="input-group">
						<button type="button" id="search" class="btn bg-orange btn-flat margin" onclick="<?php if(isset($values->mainhead_id))echo $values->mainhead_id;?>">Search</button>
					</div>
				</div>
            </div>
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <div class="col-md-8"><h2 class="box-title"></h2> </div>
				<div class="col-md-2">
                  <a href="<?php echo base_url();?>users/add" class="btn btn-primary"><i class="fa fa-plus-square"></i>  Add User</a>
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
            <div class="box-body table-responsive">
              <table id="user_table" class="table table-bordered table-striped">
                <thead>
                <tr>
				 <th>Slno</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Branch</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>User type</th>

                  <th>Edit / Delete</th>
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

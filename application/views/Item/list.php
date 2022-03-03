<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Item Details
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Item Details</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="box">
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <div class="col-md-8"><h2 class="box-title"></h2> </div>
				<div class="col-md-2">
                  <a href="<?php echo base_url();?>item/add" class="btn btn-primary"><i class="fa fa-plus-square"></i>  Add Item</a>
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
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="item_table" class="table table-bordered table-striped">
                <thead>
                <tr>
				          <th>Slno</th>
                  <th>Item</th>
                  <th>Category</th>
				          <th>HSN</th>
				          <th>Tax</th>
                  <th>Description</th>
        				  
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
	 	<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add New Branch</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<form method="post">
								<input type="hidden" id="item_id" name="item_id">
								<div class="form-group">
									<label for="size_name" class="col-sm-4 control-label">Select Branch<span style="color:red">*</span></label>
									<div class="col-sm-4">
										<select id="branch"  name="branches" data-placeholder="Select a Branch" style="width: 100%;" data-pms-required="true" class="form-control pull-right select2" >
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
									</div>
								</div>
								
							</form>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" id="branch_update" data-dismiss="modal" class="btn btn-default">Submit</button>
					</div>	
				</div>
			</div>
		</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->







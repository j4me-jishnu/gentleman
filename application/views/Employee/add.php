<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Employee Form
			<!-- <small>Optional description</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url();?>Employee"><i class="fa fa-dashboard"></i> Back to View</a></li>
			<li class="active">Employee Form</li>
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
					<form class="form-horizontal" method="POST" action="<?php echo base_url();?>Employee/add">
						<!-- radio -->
						<div class="form-group">
							<input type="hidden" name="emp_id" value="<?php if(isset($records->emp_id)) echo $records->emp_id ?>"/>
							<?php echo validation_errors(); ?>
							<label for="inputEmail3" class="col-sm-2 control-label"></label>
						</div>
						<div class="box-body">
							<div class="form-group">
								
								<label for="size_name" class="col-sm-1 control-label">Name <span style="color:red">*</span></label>

								<div class="col-sm-3">
									<input type="text" data-pms-required="true"  class="form-control" name="emp_name" placeholder="Name" value="<?php if(isset($records->emp_name)) echo $records->emp_name ?>">
								</div>
								<label for="size_name" class="col-sm-1 control-label">Designation <span style="color:red">*</span></label>

								<div class="col-sm-3">
									<input type="text" data-pms-required="true"  class="form-control" name="emp_desig" placeholder="Designation" value="<?php if(isset($records->emp_desig)) echo $records->emp_desig ?>">
								</div>
							</div>
						</div>
						
					</div>
					<div class="box-body">
						<div class="form-group">

							<!--<label for="size_name" class="col-sm-1 control-label">Type <span style="color:red">*</span></label>-->
<!--<div class="col-sm-3">
					  <select class="form-control" name="branch_type" id="branch_type"> 
						<option value="1">1 Star</option>
						<option value="2">2 Star</option>
						<option value="3">3 Star</option>
						<option value="4">4 Star</option>
						<option value="5">5 Star</option>
					  </select>
					  <input type="hidden" id="branchtype" value="<?php if(isset($records->branch_type)) echo $records->branch_type ?>"/>
					  </div>
					</div>
				</div>-->
				<!--<div class="box-body">
					<div class="form-group">
					 <label for="description" class="col-sm-1 control-label">Is Active</label>

					  <div class="col-sm-3">
						<input type="checkbox"  id="is_active" name="is_active" value="1"/>
						<input type="hidden" id="isactive" value="<?php if(isset($records->is_active)) echo $records->is_active ?>"/>
					  </div>
					<?php $ad = $this->session->userdata('user_type'); if($ad=='A') { ?>
					<label for="description" class="col-sm-1 control-label">Headoffice?</label>
					<div class="col-sm-3">
					<input type="checkbox"  id="is_head" name="is_head" value="1"/>
					<input type="hidden" id="ishead" value="<?php if(isset($records->is_head)) echo $records->is_head ?>"/>
					</div>
					<?php } ?>
					</div>
				</div>-->
				<!-- /.box-body -->
				<div class="box-footer">
					<button type="reset" class="btn ">Cancel</button>
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







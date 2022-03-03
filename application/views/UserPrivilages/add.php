<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Change User Privilage
			<!-- <small>Optional description</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url();?>Employee"><i class="fa fa-dashboard"></i>Back to View</a></li>
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
					<form class="form-horizontal" method="POST" action="<?php echo base_url();?>UserPrivilages/add">
						<!-- radio -->
						<div class="form-group">
							<?php echo validation_errors(); ?>
							<input type="hidden" name="id" value="<?php if(isset($records->id)) echo $records->id ?>"/>
							<label for="inputEmail3" class="col-sm-2 control-label"></label>
						</div>
						<div class="box-body">
							<div class="form-group">
								<label for="size_name" class="col-sm-1 control-label">Username <span style="color:red">*</span></label>
								<div class="col-sm-3">
									<input type="text" data-pms-required="true"  class="form-control" name="user_name" placeholder="Username" value="<?php if(isset($records->user_name)) echo $records->user_name ?>" disabled>
								</div>
								<label for="size_name" class="col-sm-1 control-label">Privilage type <span style="color:red">*</span></label>
								<div class="col-sm-3">
									<!-- <input type="text" data-pms-required="true"  class="form-control" name="user_type" placeholder="Privilages" value="<?php if(isset($records->user_type)) echo $records->user_type ?>"> -->
									<select class="form-control" name="user_type">
										<option value="A">Admin</option>
										<option value="Su">Super user</option>
										<option value="S">User</option>
									</select>
								</div>
							</div>
						</div>

					</div>
					<div class="box-body">
						<div class="form-group">
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

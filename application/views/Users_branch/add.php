<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
Users Form
<!-- <small>Optional description</small> -->
</h1>
<ol class="breadcrumb">
<li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
<li><a href="<?php echo base_url();?>users"><i class="fa fa-dashboard"></i> Back to View</a></li>
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
<form class="form-horizontal" method="POST" action="<?php echo base_url();?>Users_branch/add_action">
<!-- radio -->
<div class="form-group">
<input type="hidden" name="user_id" value="<?php if(isset($records->user_id)) echo $records->user_id ?>"/>
<input type="hidden" name="log_id" value="<?php if(isset($records->login_id_fk)) echo $records->login_id_fk ?>"/>
<?php echo validation_errors(); ?>
<label for="inputEmail3" class="col-sm-2 control-label"></label>
</div>
<div class="box-body">
<div class="form-group">
<label for="size_name" class="col-sm-1 control-label">ID <span style="color:red">*</span></label>

<div class="col-sm-3">
<input type="text" data-pms-required="true"  class="form-control" name="ur_id" placeholder="ID" value="<?php if(isset($records->ur_id)){ echo $records->ur_id; }else { if(isset($userid->ur_id)){echo $userid->ur_id + 1;}else{ echo 1; } }  ?>">
</div>
<label for="size_name" class="col-sm-1 control-label">Name <span style="color:red">*</span></label>

<div class="col-sm-3">
<input type="text" data-pms-required="true"  class="form-control" name="name" placeholder="Name" value="<?php if(isset($records->username)) echo $records->username ?>">
</div>
</div>
</div>
<div class="box-body">

</div>   
<div class="box-body">
<div class="form-group">
<label for="description" class="col-sm-1 control-label">Address</label>

<div class="col-sm-3">
<textarea class="form-control" name="user_address"><?php if(isset($records->user_address)) echo $records->user_address ?></textarea>
</div>

<label for="size_name" class="col-sm-1 control-label">Phone <span style="color:red">*</span></label>

<div class="col-sm-3">
<input type="text" data-pms-required="true"  class="form-control" name="user_phone" placeholder="Phone" value="<?php if(isset($records->user_phone)) echo $records->user_phone ?>">
</div>

<div class="col-sm-3">
<input type="text" data-pms-required="true"  class="form-control" name="user_email" placeholder="Email" value="<?php if(isset($records->user_email)) echo $records->email ?>">
</div>
</div>	
</div>


<div class="box-body">



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







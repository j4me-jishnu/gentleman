<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
Category Details
<!-- <small>Optional description</small> -->
</h1>
<ol class="breadcrumb">
<li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
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
<form class="form-horizontal" method="POST" action="<?php echo base_url();?>category/add">
<!-- radio -->
<div class="form-group">
<input type="hidden" name="category_id" value="<?php if(isset($records->category_id)) echo $records->category_id ?>"/>
<?php echo validation_errors(); ?>
<label for="inputEmail3" class="col-sm-2 control-label"></label>
</div>
  <div class="box-body">
  <div class="form-group">
  <label for="size_name" class="col-sm-2 control-label">Category<span style="color:red">*</span></label>

  <div class="col-sm-3">
  <input type="text" data-pms-required="true"  class="form-control" name="category_name" placeholder="Category" value="<?php if(isset($records->category_name)) echo $records->category_name ?>">
  </div>
  </div>
<div class="form-group">
<label for="description" class="col-sm-2 control-label">Description</label>

<div class="col-sm-3">
<textarea class="form-control" name="category_dscription"><?php if(isset($records->category_dscription)) echo $records->category_dscription ?></textarea>
</div>
</div>
</div>
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







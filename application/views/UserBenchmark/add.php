<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
User Benchmark
<!-- <small>Optional description</small> -->
</h1>
<ol class="breadcrumb">
<li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">User Benchmark</li>
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
<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
</div>
<!-- /.box-header -->
<!-- form start -->
<form class="form-horizontal" method="POST" action="<?php echo base_url();?>SetUserBenchmark/add">
<!-- radio -->
<div class="form-group">
<input type="hidden" name="branch_id" value="<?php if(isset($records->branch_id)) echo $records->branch_id ?>"/>
<?php echo validation_errors(); ?>
<label for="inputEmail3" class="col-sm-2 control-label"></label>
</div>
<div class="box-body">
<div class="form-group">
<label for="size_name" class="col-sm-1 control-label">Item<span style="color:red">*</span></label>

<div class="col-sm-1">
<input type="text" data-pms-required="true"  class="form-control" id="item_name" name="item_name" placeholder="ItemName" required="required">
<input type="hidden" id="item_id" name="item_id"/>
</div>
<label for="description" class="col-sm-1 control-label">User</label>
<div class="col-sm-1">
<select id="user"  name="user" data-pms-required="true" data-pms-type="alphanumericsOnly" class="form-control pull-right select2" >
<option value="">-Please Select-</option>
    
<?php
foreach($users as $u){
?>
<option  value="<?php echo $u->user_id?>"><?php echo $u->username?></option>
<?php
}
?>
</select>

</div>
<label for="size_name" class="col-sm-1 control-label">Branch<span style="color:red">*</span></label>
<div class="col-sm-1">

<select id="branch_id"  name="branch_id" data-pms-required="true" data-pms-type="alphanumericsOnly" class="form-control pull-right select2" >

<?php
foreach($branch as $branchs){
?>
<option  value="<?php echo $branchs->branch_id?>"> <?php echo $branchs->branch_name?></option>
<?php
}
?>


</select>

</div>


<label for="size_name" class="col-sm-1 control-label">Bench mark<span style="color:red">*</span></label>

<div class="col-sm-1">
<input type="text" data-pms-required="true"  class="form-control" name="benchmark" value="<?php if(isset($records->benchmark)) echo $records->benchmark ?>" >

</div>
<label for="size_name" class="col-sm-1 control-label">Initial Date <span style="color:red">*</span></label>

<div class="col-sm-2">
<input type="date"  required  class="form-control" name="idate"  max="<?php echo date('Y-m-d') ?>" id="vendorne" required="required">
</div>
<label for="size_name" class="col-sm-1 control-label">Final Date <span style="color:red">*</span></label>

<div class="col-sm-3">
<input type="date"  required  class="form-control" name="fdate" min="<?php echo date('Y-m-d') ?>"  required="required">
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







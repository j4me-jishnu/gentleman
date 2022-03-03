<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
Item Details
<!-- <small>Optional description</small> -->
</h1>
<ol class="breadcrumb">
<li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Item Details</li>
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
<form class="form-horizontal" method="POST" action="<?php echo base_url();?>item/add">
<!-- radio -->
<div class="form-group">
<input type="hidden" name="item_id" value="<?php if(isset($records->item_id)) echo $records->item_id ?>"/>
<?php echo validation_errors(); ?>
<label for="inputEmail3" class="col-sm-2 control-label"></label>
</div>
<div class="box-body">
<div class="form-group">
<label for="size_name" class="col-sm-2 control-label">Category<span style="color:red">*</span></label>

<div class="col-sm-3">
<select id="category"  name="item_category" data-pms-reired="true"  class="form-control pull-right select2" >
<option value="">----Please Select----</option>
<?php
foreach($category as $categorys){
$category_names = isset($records->category_id_fk)?$records->category_id_fk:'';
?>
<option  value="<?php echo $categorys->category_id?>"<?php if($category_names == $categorys->category_id) echo "selected=selected"?>><?php echo $categorys->category_name ?></option>
<?php
}
?>

</select>
</div>
</div>
<div class="form-group">
<label for="size_name" class="col-sm-2 control-label">Itemname<span style="color:red">*</span></label>

<div class="col-sm-3">
<input type="text" data-pms-required="true"  class="form-control" name="item_name" placeholder="Name" value="<?php if(isset($records->item_name)) echo $records->item_name ?>">
</div>
</div>

<div class="form-group">
<label for="size_name" class="col-sm-2 control-label">HSN<span style="color:red">*</span></label>

<div class="col-sm-3">
<input type="text" data-pms-required="true"  class="form-control" name="item_hsn" placeholder="HSN" value="<?php if(isset($records->item_hsn)) echo $records->item_hsn ?>">
</div>
</div>
<div class="form-group">
<label for="size_name" class="col-sm-2 control-label">Tax<span style="color:red">*</span></label>

<div class="col-sm-3">
<input type="text" data-pms-required="true"  data-pms-type="digitsOnly" class="form-control" name="item_tax" placeholder="Tax" value="<?php if(isset($records->item_tax)) echo $records->item_tax ?>">
</div>
</div>
<?php if(isset($records->item_id)){ ?>

<?php } else { ?>

<div class="form-group">
<label for="size_name" class="col-sm-2 control-label">Rop<span style="color:red">*</span></label>

<div class="col-sm-3">
<input type="text" data-pms-required="true"  data-pms-type="digitsOnly" class="form-control" name="item_rop" placeholder="Re-order Point" value="<?php if(isset($records->item_tax)) echo $records->item_tax ?>">
</div>
</div>
<?php } ?> 
<div class="form-group">
<label for="description" class="col-sm-2 control-label">Description</label>

<div class="col-sm-3">
<textarea class="form-control" name="item_description"><?php if(isset($records->item_description)) echo $records->item_description ?></textarea>
</div>
</div>
</div>
<!-- /.box-body -->
<div class="box-footer">
<div class="box-body no-padding">
				<DIV class="product-item box box-success" id="list"></br><table class="table table-bordered" cellspacing="2" ><tr><div class="form-group"><div class=""><label for="quantity" class="col-sm-1 control-label">Quantity</label></div><div class="col-sm-1"> <input type="text"  class="form-control quantity" id="pquantity"  placeholder="Qty"></div><div class=""><label for="price" class="col-sm-1 control-label">Price</label></div><div class="col-sm-1"> <input type="text"  class="form-control price" id="pprice"  placeholder="Price"></div></div></tr></table></DIV>
				<input type="hidden" id="edit_qua" value="<?php if(isset($record)) echo count($record);?>"/>
				<input type="hidden" id="edit_ref" name="edit_ref" value="<?php if(isset($record[0]->ref_number)) echo $record[0]->ref_number;?>"/>
				</div>


                <div id="form">
				  <div>
					  <div class="form-fields" id="datatable" style="display:none">
						<table id="item_tab" class="table table-bordered pull-right">
						  <tr>
							
							<th>Quantity</th>
							<th>Price</th>
							
						  </tr>
						  <tr id="template">
							
							<td><span class="qName"></span><input type="hidden"   name="item_quantity[]" class="qnName"/></td>
							<td><span class="pRate"></span><input type="hidden"   name="item_price[]" class="prRate"/></td>
							
							<td><input type="button" class="remove" style="display:none" value="Remove" /> &nbsp <input type="button" class="edit" style="display:none" value="Edit" /></td>
						  </tr>
						</table>
					  </div><!--.form-fields-->
				  </div>
				</div>




<button type="reset" class="btn ">Cancel</button>
<button type="submit" class="btn btn-info pull-right">Next</button>
</div>
<!-- /.box-footer -->
</form>
</div>
<!-- /.box -->
<button class="btn btn-info pull-right" id="add">ADD</button>

</div>
<!--/.col (right) -->
</div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
Purchase Form
<!-- <small>Optional description</small> -->
</h1>
<ol class="breadcrumb">
<li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Purchase Form</li>
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
<h3 class="box-title">Branch Details</h3>
</div>
<!-- /.box-header -->
<!-- form start -->
<form class="form-horizontal" method="POST" action="<?php echo base_url();?>Apurchaserequest/edit_purchase">
<!-- radio -->
         <input type="hidden" name="pr_id" value="<?php echo $records[0]->pr_id; ?>">
				<div class="box-footer">
				<div class="box-body no-padding">
				<DIV class="product-item box box-success" id="list"></br><table class="table table-bordered" cellspacing="2" ><tr><div class="form-group"><div class=""><label for="productname" class="col-sm-1 control-label">ItemName</label></div><div class="col-sm-2"> <input type="text"  id="item_name" class="form-control product_name" placeholder="Item name" value="<?php echo $records[0]->item_name; ?>" readonly/><input type="hidden" id="item_id" class="form-control" value="<?php echo $records[0]->item_id_fk; ?>"/></div><div class="form-group"><div class=""><label for="quantity" class="col-sm-1 control-label">Quantity</label></div><div class="col-sm-1"> <input type="text"  class="form-control quantity" id="pquantity" name="quantity"  placeholder="Qty" value="<?php echo $records[0]->item_quantity; ?>"></div><div class=""><label for="price" class="col-sm-1 control-label">Price</label></div><div class="col-sm-1"> <input type="text"  class="form-control price" name="price" id="pprice" value="<?php echo $records[0]->item_price; ?>"  placeholder="Price"></div></div></tr></table></DIV>
				<input type="hidden" id="edit_qua" value="<?php if(isset($record)) echo count($record);?>"/>
				<input type="hidden" id="edit_ref" name="edit_ref" value="<?php if(isset($record[0]->ref_number)) echo $record[0]->ref_number;?>"/>
				</div>
				<div id="form">
				  <div>
					  <div class="form-fields" id="datatable" style="display:none">
						
					  </div><!--.form-fields-->
				  </div>
				</div>
				<div class="NetTotalAmount pull-right" style="display: none;">
					<div class="pull-right" ><h3>Total : <b><span id="grand_total"></span><input type="hidden" name="net_total" id="net_total" /></b></h3></div>
				</div>
			</div>
              <!-- /.box-body -->

			  <div>
			 
			  
			  </div>
              <div class="box-footer">
			 
                <button type="reset" class="btn ">Cancel</button>
				
				<button type="submit" class="btn btn-info pull-left">Next</button>
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







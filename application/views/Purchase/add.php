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
            <form class="form-horizontal" method="POST" action="<?php echo base_url();?>purchaserequest/add">
              <!-- radio -->
               <div class="form-group">
			   <!--<input type="hidden" name="branch_id" value="<?php if(isset($records->branch_id)) echo $records->branch_id ?>"/>-->
                <?php echo validation_errors(); ?>
                 <label for="inputEmail3" class="col-sm-2 control-label"></label>
                </div>
				<div class="form-group">
				<label for="product_name" class="col-sm-2 control-label">Branch</label>
					<div class="col-sm-2">
					<h5><?php echo $refno[0]->branch_name; ?><h5>
					<input type="hidden" data-pms-required="true" readonly name="ref_number"  class="form-control" placeholder="Number" value="<?php echo $refno[0]->branch_name; ?>" />
					<input type="hidden" name="branch_id" value="<?php echo $refno[0]->branch_id; ?>" />
					</div>
					<div class="pull-right">
                        <label for="product_name" class="col-sm-2 control-label ">Date: </label>
                            <div class="col-sm-7">
							<input type="text" placeholder="Date" data-pms-required="true" class="form-control" name="item_date" id="date" value="<?php echo date('d/m/Y');?>"/>
						</div>
					</div>
				</div>
                    
                    <div class="form-group">
						<label for="purchase_quantity" class="col-sm-2 control-label">Address</label>

						<div class="col-sm-2">
						<h5><?php echo $refno[0]->branch_address; ?><h5>
                        <input type="hidden" class="form-control" id="branch_address" name="branch_address" value="<?php echo $refno[0]->branch_address; ?>"/>
						</div> 
						<label for="sale_price" class="col-sm-1 control-label">Email Id</label>

                        <div class="col-sm-2">
						<h5><?php echo $refno[0]->branch_email; ?><h5>
                        <input type="hidden" data-pms-required="true" id="vender_mail" data-pms-type="email" class="form-control" name="branch_email" placeholder="Email Id" value="<?php echo $refno[0]->branch_email; ?>"/>
						</div>
                    </div>
                    <div class="form-group">
                        <label for="sale_price" class="col-sm-2 control-label">Phone Number</label>

                        <div class="col-sm-2">
						<h5><?php echo $refno[0]->branch_phone; ?><h5>
                        <input type="hidden" data-pms-required="true" id="branch_phone" data-pms-type="digitsOnly" class="form-control" name="branch_phone" placeholder="Phone Number" value="<?php echo $refno[0]->branch_phone; ?>"/>
                        </div>
						<label for="sale_price" class="col-sm-1 control-label">Brm</label>

                        <div class="col-sm-2">
						<h5><?php if(isset($refno[0]->username)) echo $refno[0]->username; ?><h5>
                        <input type="hidden" data-pms-required="true" id="branch_brm" data-pms-required="true" class="form-control" name="branch_brm" placeholder="Brm" value="<?php if(isset($refno[0]->username)) echo $refno[0]->username; ?>"/>
                        </div>
						<label for="purchase_quantity" class="col-sm-1 control-label">Remark</label>

						<div class="col-sm-2">
                          <textarea class="form-control" id="branch_remark" name="branch_remark"></textarea>
						</div>
                    </div>
				<div class="box-footer">
				<div class="box-body no-padding">
				<DIV class="product-item box box-success" id="list"></br><table class="table table-bordered" cellspacing="2" ><tr><div class="form-group"><div class=""><label for="productname" class="col-sm-1 control-label">ItemName</label></div><div class="col-sm-2"> <input type="text"  id="item_name" class="form-control product_name" placeholder="Item name"/><input type="hidden" id="item_id" class="form-control"/></div><div class="form-group"><div class=""><label for="quantity" class="col-sm-1 control-label">Qunatity</label></div><div class="col-sm-1"> <input type="text"  class="form-control quantity" id="pquantity"  placeholder="Qty"></div><div class=""><label for="price" class="col-sm-1 control-label">Price</label></div><div class="col-sm-1"> <input type="text"  class="form-control price" id="pprice"  placeholder="Price"></div><div class=""><label for="price" class="col-sm-1 control-label">Tax</label></div><div class="col-sm-1"> <input type="text"  class="form-control tax" id="tax"  placeholder="Tax"></div><div class=""><label>Total Amount :</label><label><span id="totalAmount"></span></label><input type="hidden" class="totalPrice"   id="total_price" ></div></div></tr></table></DIV>
				<input type="hidden" id="edit_qua" value="<?php if(isset($record)) echo count($record);?>"/>
				<input type="hidden" id="edit_ref" name="edit_ref" value="<?php if(isset($record[0]->ref_number)) echo $record[0]->ref_number;?>"/>
				</div>
				<div id="form">
				  <div>
					  <div class="form-fields" id="datatable" style="display:none">
						<table id="item_table" class="table table-bordered pull-right">
						  <tr>
							<th>Item Name</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Tax</th>
							<th>Total</th>
							<th>Remove/Edit</th>
						  </tr>
						  <tr id="template">
							<td><span class="pName"></span><input type="hidden"  name="item_id_fk[]" class="form-control pr_id"/><input type="hidden"  readonly="readonly" name="item_name[]" class="prName"/></td>
							<td><span class="qName"></span><input type="hidden"  readonly="readonly" name="item_quantity[]" class="qnName"/></td>
							<td><span class="pRate"></span><input type="hidden"  readonly="readonly" name="item_price[]" class="prRate"/></td>
							<td><span class="ptax"></span><input type="hidden"  readonly="readonly" name="item_tax[]" class="prtax"/></td>
							<td><span class="namount"></span><input type="hidden"  readonly="readonly" name="item_total_price[]" class="ntamount"/></td>
							<td><input type="button" class="remove" style="display:none" value="Remove" /> &nbsp <input type="button" class="edit" style="display:none" value="Edit" /></td>
						  </tr>
						</table>
					  </div><!--.form-fields-->
				  </div>
				</div>
				<div class="NetTotalAmount pull-right" style="display: none;">
					<div class="pull-right" ><h3>Total : <b><span id="grand_total"></span><input type="hidden" name="net_total" id="net_total" /></b></h3></div>
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







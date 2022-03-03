<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Purchase Form
			<!-- <small>Optional description</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
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
					<form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>Apurchaserequest/add">
						<!-- radio -->
						<div class="form-group">
							<!--<input type="hidden" name="branch_id" value="<?php if (isset($records->branch_id)) echo $records->branch_id ?>"/>-->
							<?php echo validation_errors(); ?>
							<label for="inputEmail3" class="col-sm-2 control-label"></label>
						</div>
						<div class="form-group">

							<label for="product_name" class="col-sm-2 control-label"> Vender Name <span style="color:red">*</span></label>
							<div class="col-sm-4">
								<input type="hidden" id="vendor_name" value="<?php if (isset($record[0]->vendorname)) echo $record[0]->vendorname; ?>" />
								<?php echo form_dropdown('vendor_id', $vendor_names, '', 'id="vendor_id_fk" class="form-control select2"  data-pms-required="true" data-pms-type="dropDown"', 'name="vendor_id"'); ?>
							</div>
							<label for="product_name" class="col-sm-2 control-label ">Date: </label>
							<div class="col-sm-4">
								<input type="text" placeholder="Date" data-pms-required="true" class="form-control" name="purchase_date" id="date" value="<?php if (isset($record->item_date)) {
																																								echo $record[0]->item_date;
																																							} else {
																																								echo date('d/m/Y');
																																							} ?>">
							</div>
						</div>
						<div class="form-group">

							<label for="sale_price" class="col-sm-2 control-label">Bill Number</label>

							<div class="col-sm-4">
								<input type="text" id="purchase_invoice_number" class="form-control" name="purchase_invoice_number" placeholder="Invoice Number" value="<?php if (isset($record[0]->invoice_no)) echo $record[0]->invoice_no ?>">
							</div>
							<label for="sale_price" class="col-sm-2 control-label">GSTIN No.</label>

							<div class="col-sm-4">
								<input type="text" id="vendorgst" class="form-control" name="vendorgst" placeholder="GST Number" value="<?php if (isset($record[0]->vendorgst)) echo $record[0]->vendorgst ?>">
							</div>


						</div>
						<div class="box-footer">
							<div class="box-body no-padding">
								<DIV class="product-item box box-success" id="list"></br>
									<table class="table table-bordered" cellspacing="2">
										<tr>
											<div class="form-group">
												<div class=""><label for="productname" class="col-sm-1 control-label">ItemName</label></div>
												<div class="col-sm-2"> <input type="text" id="item_name" class="form-control product_name" placeholder="Item name" /><input type="hidden" id="item_id" class="form-control" /></div>
												<div class="form-group">
													<div class=""><label for="quantity" class="col-sm-1 control-label">Quantity</label></div>
													<div class="col-sm-1"> <input type="text" class="form-control quantity" id="pquantity" placeholder="Qty"></div>
													<div class=""><label for="price" class="col-sm-1 control-label">Price</label></div>
													<div class="col-sm-1"> <input type="text" class="form-control price" id="pprice" placeholder="Price"></div>
													<div class=""><label for="price" class="col-sm-1 control-label">Tax</label></div>
													<div class="col-sm-1"> <input type="text" class="form-control tax" id="tax" placeholder="Tax"></div>
													<div class=""><label>Total Amount :</label><label><span id="totalAmount"></span></label><input type="hidden" class="totalPrice" id="total_price"></div>
												</div>
										</tr>
									</table>
								</DIV>
								<input type="hidden" id="edit_qua" value="<?php if (isset($record)) echo count($record); ?>" />
								<input type="hidden" id="edit_ref" name="edit_ref" value="<?php if (isset($record[0]->ref_number)) echo $record[0]->ref_number; ?>" />
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
												<td><span class="pName"></span><input type="hidden" name="item_id_fk[]" class="form-control pr_id" /><input type="hidden" readonly="readonly" name="item_name[]" class="prName" /></td>
												<td><span class="qName"></span><input type="hidden" name="item_quantity[]" class="qnName" /></td>
												<td><span class="pRate"></span><input type="hidden" name="item_price[]" class="prRate" /></td>
												<td><span class="ptax"></span><input type="hidden" name="item_tax[]" class="prtax" /></td>
												<td><span class="namount"></span><input type="hidden" name="item_total_price[]" class="ntamount" /></td>
												<td><input type="button" class="remove" style="display:none" value="Remove" /> &nbsp <input type="button" class="edit" style="display:none" value="Edit" /></td>
											</tr>
										</table>
									</div>
									<!--.form-fields-->
								</div>
							</div>
							<div class="NetTotalAmount pull-right" style="display: none;">
								<div class="pull-right">
									<h3>Total : <b><span id="grand_total"></span><input type="hidden" name="net_total" id="net_total" /></b></h3>
								</div>
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
					<button class="btn btn-info pull-right" id="add">Save</button>

				</div>
				<!-- /.box -->

			</div>
			<!--/.col (right) -->
		</div>

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
$arReason = array(""=>'---Please Select---',1=>'Damage',2=>'Exchange',3=>'No use');
?>

 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Purchase Returns Form
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>index.php/dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>index.php/PurchaseReturns/"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active">Returns Form</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">

          <!-- right column -->
        <div class="col-md-8">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/PurchaseReturns/add">
              <!-- radio -->
                <div class="form-group">
					<input type="hidden" name="preturn_id" value="<?php if(isset($records->preturn_id)) echo $records->preturn_id ?>"/>
					<?php echo validation_errors(); ?>
					<label for="inputEmail3" class="col-sm-2 control-label"></label>
                </div>
            <div class="box-body">
                <div class="form-group">
                  <label for="size_name" class="col-sm-3 control-label">Date : </label>

                  <div class="col-sm-6">
                    <input type="text" placeholder="Date" data-pms-required="true" class="form-control" name="return_date" id="date" value="<?php if(isset($records->return_date)) { echo $records->return_date;} else{ echo date('d/m/Y');} ?>">
                  </div>
		</div>
                
                <div class="form-group">
                  <label for="size_name" class="col-sm-3 control-label">Invoice Number : </label>

                  <div class="col-sm-6">
                      <?php if(isset($records->invoice_no)){ ?>
                      <span><b><?php echo $records->invoice_no; ?><input type="hidden"  name="invoice_number" value="<?php echo $records->invoice_no ?>"></b></span> <?php
                      }
                          else { ?>
                    <input type="text" data-pms-required="true" data-pms-type="digitsOnly" autofocus class="form-control" id="invoice_no" name="invoice_number" placeholder="Invoice Number" value="">
                          <?php } ?>
                    <input type="hidden" name="purchase_id_fk" id="purchase_id" value="<?php if(isset($records->purchase_id_fk)) echo $records->purchase_id_fk?>" >
                    <input type="hidden" name="vendor_id_fk" id="vendor_id" value="<?php if(isset($records->customer_id_fk)) echo $records->customer_id_fk?>">
                  </div>
		</div>
                
                <div class="form-group">
                  <label for="size_name" class="col-sm-3 control-label">Product Name : </label>

                  <div class="col-sm-6">
                    <input type="text" data-pms-required="true" id="product_name" disabled class="form-control" name="product_name" placeholder="Product Name" value="<?php if(isset($product->product_name)) echo $product->product_name ?>">
                    <input type="hidden" name="product_id_fk" id="product_id" value="<?php if(isset($records->product_id_fk)) echo $records->product_id_fk ?>">
                  </div>
		</div>
                
                <div class="form-group">
                  <label for="size_name" class="col-sm-3 control-label">Purchase Qty :</label>

                  <div class="col-sm-6">
                      <input type="text" data-pms-required="true" disabled id="purchase_Qty" class="form-control" placeholder="No. Quantity" value="">  
                    <input type="hidden" data-pms-required="true" id="purchase_qty" class="form-control" name="preturnpurchase_quantity" placeholder="No. Quantity" value="<?php if(isset($records->preturnpurchase_quantity)) echo $records->preturnpurchase_quantity ?>">
                  </div>
		</div>
                
                <div class="form-group">
                  <label for="size_name" class="col-sm-3 control-label">Return Qty : </label>

                  <div class="col-sm-6">
                    <input type="hidden" id="purchase_price">
                    <input type="text" id="return_quantity" data-pms-required="true" data-pms-type="digitsOnly" class="form-control" name="return_quantity" placeholder="No. Quantity" value="<?php if(isset($records->return_qty)) echo $records->return_qty ?>">
                    <input type="hidden" name="return_qtyamount" id="return_qtyamount">
                  </div>
		</div>
                
                <div class="form-group">
                  <label for="size_name" class="col-sm-3 control-label">Return Reason : </label>

                  <div class="col-sm-6">
                        <select id="return_reason" disabled name ="return_reason" class="form-control" data-pms-required="true"  data-pms-type="dropDown" >

                                <?php foreach($arReason as $key => $value){

                                        $reason = isset($records->return_reason)?$records->return_reason:'';
                                        ?>

                                <option value="<?php echo $key; ?>" <?php if($reason == $key) echo "selected=selected"?>><?php  echo $value;?></option>

                                <?php }?>
                        </select>
                  </div>
		</div>
                
                 <div class="form-group">
                  <label for="size_name" class="col-sm-3 control-label">Remarks : </label>

                  <div class="col-sm-6">
                      <textarea class="form-control" name="reurn_description"><?php if(isset($records->return_description)) echo $records->return_description ?></textarea>
                  </div>
		</div>
            </div>
              <div id="exchangemodal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">EnterNew Product</h4>
                        </div>
                        <div class="modal-body">
                                <div class="form-group clearfix">
                                        <div class="col-md-2">
                                        <label for="exampleInputEmail1">Product</label>
                                        </div>

                                        <div class="col-md-4">
                                        <input type="text"  class="form-control exproduct" name="ex_productname" id="ex_productname" placeholder="Product Name" >
                                        <input type="hidden"  class="form-control" name="ex_productid" id="ex_productid">
                                        </div>
                                </div>    
                                <div class="form-group clearfix">
                                        <div class="col-md-2">
                                        <label for="exampleInputEmail1">Quantity</label>
                                        </div>

                                        <div class="col-md-4">
                                        <input type="text"  class="form-control exproduct" disabled name="ex_productquantity" id="ex_productquantity" placeholder="Quantity" >
                                        </div>
                                </div> 
                                <div class="form-group clearfix">
                                        <div class="col-md-2">
                                        <label for="exampleInputEmail1">Price</label>
                                        </div>

                                        <div class="col-md-4">
                                        <input type="text"  class="form-control exproduct" name="ex_productprice" id="ex_productprice" placeholder="Price" >
                                        </div>
                                        <div class="col-md-3">
                                        <span id="showtotal" style="display: none">Total:</span><span id="total"> </span>
                                        <input type="hidden"  name="ex_total" id="ex_total">
                                       
                                        </div>
                                </div>
                               <div class="form-group clearfix">
                                        <div class="col-md-2">
                                        <label for="exampleInputEmail1">Sale Price</label>
                                        </div>

                                        <div class="col-md-4">
                                        <input type="text"  class="form-control exproduct" name="ex_productSalepize" id="ex_productSalepize" placeholder="Discount" >
                                        </div>
                                        
                                </div>

                                
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
              <!-- /.box-body -->
              
			  <div class="box-footer">
				<button type="submit" class="btn btn-info">Next</button>
                <button type="reset" class="btn pull-right">Cancel</button>
                
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







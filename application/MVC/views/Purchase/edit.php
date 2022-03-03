<?php $arTax = array(""=>'---Please Select---',1=>'Yes',2=>'No') ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Purchase Details Form
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>index.php/dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>index.php/Purchase/"><i class="fa fa-dashboard"></i> Back to List</a></li>
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
			       
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
			<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
            
              <!-- radio -->
               <div class="form-group">
			   
			   <input type="hidden" id="invoice_no" name="invoice_no" value="<?php if(isset($purchase->purchase_invoice_no)) echo $purchase->purchase_invoice_no ?>"/>
               
                 <label for="inputEmail3" class="col-sm-2 control-label"></label> 
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="form-group">
                            <label for="product_name" class="col-sm-2 control-label">Vender Name</label>
                                <div class="col-sm-4">
                                    <span><b><?php if(isset($vendor->vendor_name)) echo $vendor->vendor_name ?></b></span>
                                        <input type="hidden" data-pms-required="true" name="vendor_name" id="customer_name" class="form-control" placeholder="Vendor Name" value="<?php if(isset($vendor->vendor_name)) echo $vendor->vendor_name ?>" />
                                        <input type="hidden" name="vendor_id_fk" id="vendor_id" class="form-control" value="<?php if(isset($vendor->vendor_id)) echo $vendor->vendor_id ?>"/>
                                </div>
                            
                            <div class="pull-right">
                            <label for="product_name" class="col-sm-2 control-label ">Date: </label>
                                <div class="col-sm-7">
                                    <input type="text" data-pms-required="true" placeholder="Date" class="form-control" name="purchase_date" id="date" value="<?php if(isset($purchase->purchase_date)) { echo $purchase->purchase_date;} else{ echo date('d/m/Y');} ?>">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="">
                            <div class="form-group">
                              <label for="purchase_quantity" class="col-sm-2 control-label">Address</label>

                              <div class="col-sm-4">
                                  <textarea class="form-control" id="vendor_address" name="vendor_address"><?php if(isset($vendor->vendor_address)) echo $vendor->vendor_address ?></textarea>
                              </div> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="">
                            <div class="form-group">
                                <label for="sale_price" class="col-sm-2 control-label">Email Id</label>

                                <div class="col-sm-4">
                                        <input type="text" data-pms-required="true" id="vender_mail" data-pms-type="email" class="form-control" name="vendor_email" placeholder="Email Id" value="<?php if(isset($vendor->vender_mail)) echo $vendor->vender_mail ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="">
                            <div class="form-group">
                                <label for="sale_price" class="col-sm-2 control-label">Phone Number</label>

                                <div class="col-sm-4">
                                        <input type="text" data-pms-required="true" id="vendor_phone" data-pms-type="digitsOnly" class="form-control" name="vendor_phone" placeholder="Phone Number" value="<?php if(isset($vendor->vendor_phone)) echo $vendor->vendor_phone ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="">
                            <div class="form-group">
                                <label for="sale_price" class="col-sm-2 control-label">Include Tax ?</label>

                                <div class="col-sm-2">
                                    <input type="hidden" id="taxtype" value="<?php if(isset($purchase->tax_type)) echo $purchase->tax_type ?>" >
                                        <?php if(isset($purchase->tax_type) && ($purchase->tax_type) == 1) { ?>
                                    <span><b>Yes</b></span>
                                        <?php } else { ?>
                                    <span><b>No </b></span>
                                        <?php } ?>
                                </div>
                                <div class="col-sm-2">
                                    <?php if(isset($purchase->tax_type) && ($purchase->tax_type) == 1) { ?>
                                    <select name="tax_id_fk" data-pms-required="true"  id="taxClass" class="form-control" >
                                                <?php
                                                        foreach($tax_type as $taxtype){
                                                                $taxtypes = isset($purchase->tax_id_fk)?$purchase->tax_id_fk:'';
                                                                ?>
                                                        <option value="<?php echo $taxtype->tax_id?>"<?php if($taxtypes == $taxtype->tax_id) echo "selected=selected"?>><?php echo $taxtype->tax_name ?></option>
                                                         <?php
                                                                }
                                                ?>
                                    </select>
                                    <?php } ?>
                                    <input type="hidden" id="tax_amount">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="">
                            <div class="form-group">
                                <label for="sale_price" class="col-sm-2 control-label">Tin No.</label>

                                <div class="col-sm-4">
                                        <input type="text" data-pms-required="true" id="vendor_tin" class="form-control" name="vendor_tin" placeholder="Tin Number" value="<?php if(isset($vendor->vendor_tin)) echo $vendor->vendor_tin ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="">
                            <div class="form-group">
                                <label for="sale_price" class="col-sm-2 control-label">Pan No.</label>

                                <div class="col-sm-4">
                                        <input type="text" data-pms-required="true" id="vendor_pin" class="form-control" name="vendor_pin" placeholder="Pan Number" value="<?php if(isset($vendor->vendor_pin)) echo $vendor->vendor_pin ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="">
                            <div class="form-group">
                                <label for="sale_price" class="col-sm-2 control-label">Remarks</label>

                                <div class="col-sm-4">
                                    <textarea id="purchase_remarks" class="form-control"><?php if(isset($purchase->purchase_remarks)) echo $purchase->purchase_remarks ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="">
                            <div class="form-group">
                                <div class="col-sm-3">
                                </div>
                                <div class="col-sm-4">
                                        <button id="update" class="btn btn-info">update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"><h4><center>Product Details</center></h4>
                        <table class="table table-striped col-md-11" id='table' val=''>
                            <input type="hidden" id="count" value="<?php echo count($records) ?>"/>
                            <?php 
                            $i=0;
                            foreach ($records as $purchase) { ?>
                            <table class="table table-striped col-md-11" id='table' value="<?php $purchase->purchase_id ?>">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Size</th>
                                    <th>Color</th>
                                    <th>Purchase Quantity</th>
                                    <th>Purchase Rate</th>
                                    <th>Sale Price</th>
                                    <th>Total</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $purchase->product_name ?></td>
                                    <td><?php echo $purchase->category_name ?></td>
                                    <td><?php echo $purchase->size_name ?></td>
                                    <td><?php echo $purchase->color_name ?></td>
                                    <td><?php echo $purchase->product_purchase_quantity ?></td>
                                    <td><?php echo $purchase->purchase_price ?></td>
                                    <td><?php echo $purchase->sale_price ?></td>
                                    <td><?php echo $purchase->purchase_total_price ?></td>
                                    
                                     <input type="hidden" id="product_id<?php echo $i?>" value="<?php echo $purchase->product_id ?>">         
                                    <td><center><button id="purchase_update" onclick="return confirmUpdate('<?php echo $purchase->purchase_id ?>')" class="btn btn-block btn-warning btn-sm" value="<?php echo $i;?>">Edit Row</button></center></td>
                                    <td><center><button onclick="return comfirmDeleteRow('<?php echo $purchase->purchase_id ?>')" class="btn btn-block btn-danger btn-sm">Delete</button></center></td>
                                </tr>
                            </tbody>
                            <?php
                            $i++;
                          } ?>
                        </table>
                      </div>
                    </div>
                    
                </div>
              <!-- /.box-body -->
              <div class="box-footer">
                  <center>
                      <a href="<?php echo base_url();?>index.php/purchase/add"><button class="btn btn-danger">add New Purchase</button></a>
                      <a href="<?php echo base_url();?>index.php/Purchase/"><button class="btn btn-info">back to view</button></a>
                  </center>
              </div>
              <!-- /.box-footer -->
            <div id="EditPurchase" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <form >
                        <div class="modal-content">
                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Edit Product Details</h4></div>

                                <div class="form-group clearfix">
                                    <div class="col-md-2">
                                    <label for="exampleInputEmail1">Product Name</label>
                                    </div>

                                    <div class="col-md-4">
                                    <input type="text"  class="form-control" id="Product_name" placeholder="Product" >
                                    <input type="hidden"   id="Product_id" placeholder="Category" >
                                    <input type="hidden"   id="Purchase_id" placeholder="Category" >
                                    </div>
                                     
                                    <div class="col-md-2">
                                    <label for="exampleInputEmail1">Category</label>
                                    </div>

                                    <div class="col-md-4">
                                        <input type="text" disabled  class="form-control" id="Category_name" placeholder="Category" >
                                    </div>
                                </div>
                                
                                <div class="form-group clearfix">
                                    <div class="col-md-2">
                                    <label for="exampleInputEmail1">Size</label>
                                    </div>

                                    <div class="col-md-4">
                                    <input type="text" disabled class="form-control" id="Size_name" placeholder="Size" >
                                    </div>
                                    
                                    <div class="col-md-2">
                                    <label for="exampleInputEmail1">Color</label>
                                    </div>

                                    <div class="col-md-4">
                                    <input type="text" disabled class="form-control" id="Color_name" placeholder="Color" >
                                    </div>
                                </div>
                                
                                <div class="form-group clearfix">
                                    <div class="col-md-2">
                                    <label for="exampleInputEmail1">Purchase Quantity</label>
                                    </div>

                                    <div class="col-md-4">
                                    <input type="text" data-pms-required="true" data-pms-type="digitsOnly" class="form-control" id="Purchase_qty" placeholder="Qty" >
                                    </div>
                                    
                                    <div class="col-md-2">
                                    <label for="exampleInputEmail1">Purchase Rate</label>
                                    </div>

                                    <div class="col-md-4">
                                    <input type="text" data-pms-required="true" data-pms-type="digitsOnly" class="form-control" id="Purchase_rte" placeholder="Purchase Price" >
                                    </div>
                                </div>
                            
                                <div class="form-group clearfix">
                                    <div class="col-md-2">
                                    <label for="exampleInputEmail1">Sale Rate</label>
                                    </div>

                                    <div class="col-md-4">
                                    <input type="text" data-pms-required="true" data-pms-type="digitsOnly" class="form-control" id="Sale_price" placeholder="Sale Price" >
                                    </div>
                                    
                                    <div class="col-md-2">
                                    <label for="exampleInputEmail1">Total</label>
                                    </div>

                                    <div class="col-md-4">
                                        <b>: <span id="PurchaseTotal"></span></b>
                                    <input type="hidden"  class="form-control" id="Total_purchase" >
                                    </div>
                                </div>
                        <div class="modal-footer">

                        <button type="button"  onclick="AddPurchase()" class="btn btn-primary option">OK</button>

                        </div>
                        </div>
                    </form>
                </div>
            </div>
          </div>
          <!-- /.box -->
          
        </div>
        <!--/.col (right) -->
     </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
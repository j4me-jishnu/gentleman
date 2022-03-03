

 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sale Edit Details Form
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>index.php/dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>index.php/Sale/"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active">Sale Form</li>
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
              <h3 class="box-title">Sale Edit Form</h3>
            </div>
              <div class="box-body">
                  
                    <div class="row">
                        <div class="form-group">
                            <label for="product_name" class="col-sm-2 control-label">Sale Date</label>
                                <div class="col-sm-3">
                                    <span><b></b></span>
                                       <input type="text" placeholder="Date" class="form-control" name="sale_date" id="date" value="<?php if(isset($sale_date->sale_date)) { echo $sale_date->sale_date;} else{ echo date('d/m/Y');} ?>">
                                       <input type="hidden" id="invoice_no" value="<?php if(isset($sale_date->sale_invoice_number)) echo $sale_date->sale_invoice_number ?>" >
                                </div>
                        </div>
                    </div>
                  <br>
                        <div class="row">
                        <div class="form-group">
                            <label for="product_name" class="col-sm-2 control-label ">tax </label>
                                <div class="col-sm-3">
                                    <select name="tax_id_fk" data-pms-required="true"  id="taxClass" class="form-control" >
                                            <option value="">----Select----</option>
                                                <?php
                                                        foreach($tax_type as $taxtype){
                                                                $taxtypes = isset($sale_date->tax_id_fk)?$sale_date->tax_id_fk:'';
                                                                ?>
                                                        <option value="<?php echo $taxtype->tax_id?>"<?php if($taxtypes == $taxtype->tax_id) echo "selected=selected"?>><?php echo $taxtype->tax_name ?></option>
                                                         <?php
                                                                }
                                                ?>
                                    </select>
                                    <input type="hidden" id="tax_amount">
                                </div>
                        </div>
                    </div>
                  <br>
                  
                  <div class="row">
                        <div class="form-group">
                            <label for="product_name" class="col-sm-2 control-label">Remarks</label>
                                <div class="col-sm-3">
                                    <span><b></b></span>
                                       <textarea  id="remarks" class="form-control"><?php if(isset($sale_date->sale_remarks)) echo $sale_date->sale_remarks ?></textarea>
                                        
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
                            <input type="hidden" id="count" value="<?php echo count($sale) ?>"/>
                            <?php 
                            $i=0;
                            foreach ($sale as $sales) { ?>
                            <table class="table table-bordered col-md-11" id='table' value="<?php $sales->sale_id ?>">
                            <?php }?>
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Size</th>
                                    <th>Color</th>
                                    <th>sale Quantity</th>
                                    <th>sale Rate</th>
                                    <th>Sale discount</th>
                                    <th>Total</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($sale as $sales) { ?>
                                <tr>
                                    <td><?php echo $sales->product_name ?></td>
                                    <td><?php echo $sales->category_name ?></td>
                                    <td><?php echo $sales->subcategory_name ?></td>
                                    <td><?php echo $sales->size_name ?></td>
                                    <td><?php echo $sales->color_name ?></td>
                                    <td><?php echo $sales->sale_quantity ?></td>
                                    <td><?php echo $sales->sale_price ?></td>
                                    <td><?php echo $sales->sale_discount ?></td>
                                    <td><?php echo $sales->sale_total_price ?></td>   
                                    <td><center><button id="purchase_update" onclick="return confirmUpdate('<?php echo $sales->sale_id ?>')" class="btn btn-block btn-warning btn-sm" value="<?php echo $i;?>">Edit Row</button></center></td>
                                    <td><center><button onclick="return comfirmDeleteRow('<?php echo $sales->sale_id ?>')" class="btn btn-block btn-danger btn-sm">Delete</button></center></td>
                                </tr>
                                <?php
                            $i++;
                          } ?>
                            </tbody>
                            
                        </table>
                      </div>
                    </div>
                    </div>
              <div class="footer">
                  
              </div>
                  
              </div>
              
              <!-- /.box-body -->
              
          <!-- /.box -->
          <div id="EditSale" class="modal fade" role="dialog">
                <div class="modal-dialog">
                        <div class="modal-content">
                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Edit Product Details</h4></div>

                                <div class="form-group clearfix">
                                    <div class="col-md-2">
                                    <label for="exampleInputEmail1">Product Name</label>
                                    </div>

                                    <div class="col-md-4">
                                    <input type="text"  class="form-control" id="Product_name" placeholder="Product Name" >
                                    <input type="hidden" id="Product_id" >
                                    <input type="hidden" id="Sale_id" >
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
                                    <input type="text" disabled  class="form-control" id="Color_name" placeholder="Color" >
                                    </div>
                                </div>
                                
                                <div class="form-group clearfix">
                                    <div class="col-md-2">
                                    <label for="exampleInputEmail1">Sale Quantity</label>
                                    </div>

                                    <div class="col-md-4">
                                    <input type="text"  class="form-control" id="Sale_qty" placeholder="Sale Quantity" >
                                    </div>
                                    
                                    <div class="col-md-2">
                                    <label for="exampleInputEmail1">Sale Price</label>
                                    </div>

                                    <div class="col-md-4">
                                    <input type="text"  class="form-control" id="Sale_price" placeholder="Sale Price" >
                                    </div>
                                </div>
                            
                                <div class="form-group clearfix">
                                    <div class="col-md-2">
                                    <label for="exampleInputEmail1">Discount</label>
                                    </div>

                                    <div class="col-md-4">
                                    <input type="text"  class="form-control" id="Sale_discount" placeholder="Discount" >
                                    </div>
                                    
                                    <div class="col-md-2">
                                    <label for="exampleInputEmail1">Total</label>
                                    </div>

                                    <div class="col-md-4">
                                        <b>: <span id="SaleTotal"></span></b>
                                    <input type="hidden"  class="form-control" id="Sale_total_price" placeholder="Category" >
                                    </div>
                                </div>
                                
                                
                                
                                <div class="form-group clearfix">
                                    <div class="col-md-2">
                                    <label for="exampleInputEmail1">Description</label>
                                    </div>

                                    <div class="col-md-5">
                                        <textarea id="Description" class="form-control"></textarea>
                                    </div>
                                </div>
                        <div class="modal-footer">

                        <button type="button"  onclick="AddSale()" class="btn btn-primary option" data-dismiss="modal">OK</button>

                        </div>
                        </div>
                </div>
            </div>
        </div>
        <!--/.col (right) -->
     </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->







<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product Details Form
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>index.php/dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>index.php/product/"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active">Product Form</li>
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
            <form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/product/add">
              <!-- radio -->
               <div class="form-group">
			   <input type="hidden" id="product_id" name="product_id" value="<?php if(isset($records->product_id)) echo $records->product_id ?>"/>
                <?php echo validation_errors(); ?>
                 <label for="inputEmail3" class="col-sm-2 control-label"></label>
                <!--<div class="col-sm-10 input-group date">
                  <label class="col-sm-4 control-label">
                  <input type="radio" name="customer_type" class="flat-red customerType" value="N" checked>
                  New customer
                  </label>

                  <label class="col-sm-4 control-label">
                  <input type="radio" name="customer_type" value="O" class="flat-red customerType">
                  Old customer
                  </label>
                </div>-->
				
                 
                </div>
              <div class="box-body">
				<div class="form-group">
                  <!--<label for="customer_email" class="col-sm-2 control-label"> Category</label>
                  <div class="col-sm-4">
                    <select name="category_id_fk" data-pms-required="true"  class="form-control pull-right" >
                      <option value="">Select</option>
							<?php
								foreach($category as $categorys){
									$cat = isset($records->category_id_fk)?$records->category_id_fk:'';
									?>
								<option value="<?php echo $categorys->category_id?>"<?php if($cat == $categorys->category_id) echo "selected=selected"?>><?php echo $categorys->category_name ?></option>
								 <?php
									}
								?>
                      
                    </select>
                  </div>-->
					
					
					<label for="customer_email" class="col-sm-2 control-label"> Category <span style="color:red">*</span></label>
					
					<?php if(isset($records->category_name)) { 
					 $category_names[''] ='----Please Select---';  ?>
					 
					 <div class="col-sm-4">
					 <input type="hidden" value="<?php if(isset($records->category_id)) echo $records->category_id ?>" id="categoryname"/>
					 <input type="hidden" value="<?php $records->category_id; ?>" id="check"/>
					<?php echo form_dropdown('category_id', $category_names, '', 'id="category" class="form-control select2" autofocus data-pms-required="true" data-pms-type="alphanumericsOnly"', 'name="category_id_fk"');?>	
					</div>
				<?php	}
					else {
					$category_names[''] = '----Please Select---';  ?>
					<div class="col-sm-4">
					<?php echo form_dropdown('category_id', $category_names,'', 'id="category" class="form-control select2" autofocus data-pms-required="true" data-pms-type="alphanumericsOnly"', 'name="category_id_fk"');?>	
					</div>
					<?php } ?>
					
					
					<label for="customer_email" class="col-sm-2 control-label">Sub category <span style="color:red">*</span></label>
					
					<?php if(isset($records->subcategory_name)) {
					 $subcategory_name[1] = $records->subcategory_name; ?>
					<div class="col-sm-4" >
					<?php echo form_dropdown('subcategory_id', $subcategory_name, '', 'id="subcategory" class="form-control select2"  data-pms-required="true" data-pms-type="alphanumericsOnly"', 'name="subcategory_id_fk"'); ?>
					</div>
					<?php	}
					else { $subcategory_name[''] = '---Please Select---'; ?>
					<div class="col-sm-4" >
					<?php echo form_dropdown('subcategory_id', $subcategory_name, '', 'id="subcategory" class="form-control select2"  data-pms-required="true" data-pms-type="alphanumericsOnly"', 'name="subcategory_id_fk"'); ?>
					</div>
					<?php } ?>
				</div>
				
				<div class="form-group"> 
				  <label for="customer_email" class="col-sm-2 control-label"> Size/Unit <span style="color:red">*</span></label>
                  <div class="col-sm-4">
                    <select id="size_id_fk" name="size_id_fk" data-pms-required="true" data-pms-type="alphanumericsOnly" class="form-control pull-right select2" >
                      <option value="">----Select----</option>
                      <option value='+' class="form-control">+Add New</option>
                    <?php
                            foreach($size as $sizes){
                                    $size_name = isset($records->size_id_fk)?$records->size_id_fk:'';
                                    ?>
                            <option value="<?php echo $sizes->size_id?>"<?php if($size_name == $sizes->size_id) echo "selected=selected"?>><?php echo $sizes->size_name ?></option>
                             <?php
                                    }
                            ?>
                      
                    </select>
                  </div>
				  <label for="customer_email" class="col-sm-2 control-label"> Color <span style="color:red">*</span></label>
                  <div class="col-sm-4">
                    <select id="color_id_fk" name="color_id_fk" data-pms-required="true" data-pms-type="alphanumericsOnly" class="form-control pull-right select2" >
                      <option value="">---Select----</option>
                      <option value='+'>+Add New</option>
                    <?php
                            foreach($color as $Colors){
                                    $color_name = isset($records->color_id_fk)?$records->color_id_fk:'';
                                    ?>
                            <option value="<?php echo $Colors->color_id?>"<?php if($color_name == $Colors->color_id) echo "selected=selected"?>><?php echo $Colors->color_name ?></option>
                             <?php
                                    }
                            ?>
                      
                    </select>
                  </div>
				  
                </div>
				
				
				
                <div class="form-group">
                  <label for="product_name" class="col-sm-2 control-label">Product Name <span style="color:red">*</span></label>

                  <div class="col-sm-4">
                    <input type="text" data-pms-required="true" class="form-control" name="product_name" placeholder="Name" value="<?php if(isset($records->product_name)) echo $records->product_name ?>">
                  </div>
				  <label for="reorder_quantity" class="col-sm-2 control-label">Reorder Quantity <span style="color:red">*</span></label>

                  <div class="col-sm-4">
                    <input type="text" data-pms-required="true" data-pms-type="digitsOnly" class="form-control" name="product_reorderqty" placeholder="Number" value="<?php if(isset($records->product_reorderqty)) echo $records->product_reorderqty ?>">
                  </div>
                </div>
				
				
				<div class="form-group">
                  <label for="product_brand" class="col-sm-2 control-label">Product Brand</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="product_brand" placeholder="Product Brand" value="<?php if(isset($records->product_brand)) echo $records->product_brand ?>">
                  </div>
				  <label for="description" class="col-sm-2 control-label">Description</label>

                  <div class="col-sm-4">
                    <textarea class="form-control" name="product_description"><?php if(isset($records->product_description)) echo $records->product_description ?></textarea>
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
            <div id="addcolour" class="modal fade" role="dialog">
                <div class="modal-dialog">
                        <div class="modal-content">
                                <div class="modal-header">
                                        <button type="button" class="close" onclick="colourmodalclose()" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Enter Colour And Description</h4></div>

                                <div class="form-group clearfix">
                                        <div class="col-md-2">
                                        <label for="exampleInputEmail1">Colour</label>
                                        </div>

                                        <div class="col-md-3">
                                        <input type="text"  class="form-control" id="color_name" placeholder="Colour" >
                                        </div>
                                         <div class="col-md-2">
                                        <label for="exampleInputEmail1">Description</label>
                                        </div>

                                        <div class="col-md-3">
                                        <textarea class="form-control" id="color_remarks"></textarea>
                                        </div>   

                                </div>
                                
                        <div class="modal-footer">

                        <button type="button"  onclick="srate()" class="btn btn-primary option" data-dismiss="modal">OK</button>

                        </div>
                        </div>
                </div>
            </div>
            <div id="addsize" class="modal fade" role="dialog">
                <div class="modal-dialog">
                        <div class="modal-content">
                                <div class="modal-header">
                                        <button type="button" onclick="sizemodalclose()" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Enter Size And Description</h4></div>

                                <div class="form-group clearfix">
                                        <div class="col-md-2">
                                        <label for="exampleInputEmail1">Size</label>
                                        </div>

                                        <div class="col-md-3">
                                        <input type="text"  class="form-control" id="size" placeholder="Size" >
                                        </div>
                                         <div class="col-md-2">
                                        <label for="exampleInputEmail1">Description</label>
                                        </div>

                                        <div class="col-md-3">
                                        <textarea class="form-control" id="size_remarks"></textarea>
                                        </div>   

                                </div>
                                
                        <div class="modal-footer">

                        <button type="button"  onclick="rate()" class="btn btn-primary option" data-dismiss="modal">OK</button>

                        </div>
                        </div>
                </div>
            </div>
            <div id="addcategory" class="modal fade" role="dialog">
                <div class="modal-dialog">
                        <div class="modal-content">
                                <div class="modal-header">
                                        <button type="button" onclick="categorymodalclose()" class="close" >&times;</button>
                                <h4 class="modal-title">Enter Category And Description</h4></div>

                                <div class="form-group clearfix">
                                        <div class="col-md-2">
                                        <label for="exampleInputEmail1">Category</label>
                                        </div>

                                        <div class="col-md-3">
                                        <input type="text"  class="form-control" id="Category_name" placeholder="Category" >
                                        </div>
                                         <div class="col-md-2">
                                        <label for="exampleInputEmail1">Description</label>
                                        </div>

                                        <div class="col-md-3">
                                        <textarea class="form-control" id="Category_desc"></textarea>
                                        </div>   

                                </div>
                                
                        <div class="modal-footer">

                        <button type="button"  onclick="Addcategory()" class="btn btn-primary option" data-dismiss="modal">OK</button>

                        </div>
                        </div>
                </div>
            </div>
            <div id="addsubcategory" class="modal fade" role="dialog">
                <div class="modal-dialog">
                        <div class="modal-content">
                                <div class="modal-header">
                                        <button type="button" onclick="subcategorymodalclose()" class="close" >&times;</button>
                                <h4 class="modal-title">Enter SubCategory And Description</h4></div>

                                <div class="form-group clearfix">
                                        <div class="col-md-2">
                                        <label for="exampleInputEmail1">SubCategory</label>
                                        </div>

                                        <div class="col-md-3">
                                        <input type="text"  class="form-control" id="subCategory_name" placeholder="SubCategory" >
                                        </div>
                                         <div class="col-md-2">
                                        <label for="exampleInputEmail1">Description</label>
                                        </div>

                                        <div class="col-md-3">
                                        <textarea class="form-control" id="subCategory_desc"></textarea>
                                        </div>   

                                </div>
                                
                        <div class="modal-footer">

                        <button type="button"  onclick="Addsubcategory()" class="btn btn-primary option" data-dismiss="modal">OK</button>

                        </div>
                        </div>
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







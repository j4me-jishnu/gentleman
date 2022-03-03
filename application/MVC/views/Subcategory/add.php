

 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product Sub Category Form
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>index.php/dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>index.php/subcategory/"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active">Sub Category Form</li>
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
            <form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/subcategory/add">
              <!-- radio -->
                <div class="form-group">
					<input type="hidden" name="subcategory_id" value="<?php if(isset($records->subcategory_id)) echo $records->subcategory_id ?>"/>
					<?php echo validation_errors(); ?>
					<label for="inputEmail3" class="col-sm-2 control-label"></label>
                </div>
            <div class="box-body">
                <div class="form-group">
                  <label for="customer_email" class="col-sm-2 control-label"> Category <span style="color:red">*</span></label>
                  <div class="col-sm-2">
                    <select id="category_id_fk" autofocus name="category_id_fk" data-pms-required="true" data-pms-type="alphanumericsOnly" class="form-control pull-right select2" >
                      <option value="">----Select----</option>
                      <option  value='+' class="form-control">+Add New</option>
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
                <div class="col-sm-2">
                    <input type="text" data-pms-required="true" class="form-control" name="subcategory_name" placeholder="Sub Category Name" value="<?php if(isset($records->subcategory_name)) echo $records->subcategory_name ?>">
                  </div>
				  
				  <label for="description" class="col-sm-2 control-label">Description</label>

                  <div class="col-sm-2">
                    <textarea class="form-control" onUnfocus="send()" name="subcategory_remarks"><?php if(isset($records->subcategory_remarks)) echo $records->subcategory_remarks ?></textarea>
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
            
            <div id="addcategory" class="modal fade" role="dialog">
                <div class="modal-dialog">
                        <div class="modal-content">
                                <div class="modal-header">
                                        <button type="button" onclick="categorymodalclose()" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Enter Category And Description</h4></div>

                                <div class="form-group clearfix">
                                        <div class="col-md-2">
                                        <label for="exampleInputEmail1">Category</label>
                                        </div>

                                        <div class="col-md-3">
                                        <input type="text" data-pms-required="true"  class="form-control" id="Category" placeholder="Category" >
                                        </div>
                                         <div class="col-md-2">
                                        <label for="exampleInputEmail1">Description</label>
                                        </div>

                                        <div class="col-md-3">
                                        <textarea class="form-control" id="Category_remarks"></textarea>
                                        </div>   

                                </div>
                                
                        <div class="modal-footer">

                        <button type="button"  onclick="rate()" class="btn btn-primary option" data-dismiss="modal">OK</button>

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







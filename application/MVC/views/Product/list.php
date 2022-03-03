

 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product Details
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>index.php/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="<?php echo base_url();?>index.php/product/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
        <li class="active">Product Details</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
	<div class="row">
		<div class="col-md-3">
		   <div class="input-group margin">
				<div class="input-group-btn">
					<button type="button" class="btn btn-primary nohover">Name</button>
				</div><!-- /btn-group -->
                                <input type="text" name="product_name" placeholder="Product Name" id="product_name" class="form-control">
			</div><!-- /input-group -->
		</div>
		
		<div class="col-md-3">
		   <div class="input-group margin">
				<div class="input-group-btn">
					<button type="button" class="btn btn-primary nohover">Category</button>
				</div><!-- /btn-group -->
                                <input type="text" name="category_name" placeholder="Category Name" id="category_name" class="form-control">
			</div><!-- /input-group -->
		</div>
		
		<div class="col-md-3">
		   <div class="input-group margin">
				<div class="input-group-btn">
					<button type="button" class="btn btn-primary nohover">Sub Category</button>
				</div><!-- /btn-group -->
                                <input type="text" name="subcategory_name" placeholder="Sub Category" id="subcategory_name" class="form-control">
			</div><!-- /input-group -->
		</div>
		
		<div class="col-md-3">
		   <div class="input-group margin">
				<div class="input-group-btn">
					<button type="button" class="btn btn-primary nohover">Size</button>
				</div><!-- /btn-group -->
                                <input type="text" name="size_name"placeholder="Size Name" id="size_name" class="form-control">
			</div><!-- /input-group -->
		</div>
		
		<div class="col-md-3">
		   <div class="input-group margin">
				<div class="input-group-btn">
					<button type="button" class="btn btn-primary nohover">Color</button>
				</div><!-- /btn-group -->
                                <input type="text" name="color_name" placeholder="Color Name" id="color_name" class="form-control">
			</div><!-- /input-group -->
		</div>
		
				
		<div class="col-md-1">
				<div class="input-group">
					<button type="button" id="search" class="btn bg-orange btn-flat margin" onclick="<?php if(isset($values->mainhead_id))echo $values->mainhead_id;?>">Search</button>
				</div>
		</div>
		<div class="col-sm-1">
				<div class="input-group">
					<a href="<?php echo base_url();?>index.php/product"><button class="btn bg-navy btn-flat margin" >Refresh</button></a>
				</div>
		</div>
	</div>
	
      <div class="row">
	  
        <div class="box">
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
			 
              <div class="col-md-8"><h2 class="box-title"></h2> </div>
				
				
				<div class="col-md-2">
                  <a href="<?php echo base_url();?>index.php/product/add" class="btn btn-primary"><i class="fa fa-plus-square"></i>  Add new Product</a>
				</div>
				
				<div class="btn-group">
                      <button type="button" class="btn btn-success">Action</button>
                      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo base_url();?>index.php/category">Categories</a></li>
						<li><a href="<?php echo base_url();?>index.php/subcategory">Sub Categories</a></li>
						<li><a href="<?php echo base_url();?>index.php/color">Colour</a></li>
						<li><a href="<?php echo base_url();?>index.php/size">Size</a></li>
						<li><a href="<?php echo base_url();?>index.php/stock">Stock Management </a></li>
                        
                      </ul>
                    </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="product_details_table" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                    <th>Sl No.</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Sub category</th>
                    <th>Colour</th>
                    <th>Size</th>
                    <th>Brand</th>
                    <th>Re-Order Quantity</th>
                    <th>Description</th>
                    <th>Edit / Delete</th>
                  <th></th>
                  
                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

         
     </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->









 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product Colour Details
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>index.php/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>index.php/color/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
        <li class="active">Product Colour Details</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="box">
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <div class="col-md-8"><h2 class="box-title"></h2> </div>
				
				
				<div class="col-md-2">
                  <a href="<?php echo base_url();?>index.php/color/add" class="btn btn-primary"><i class="fa fa-plus-square"></i>  Add colour</a>
				</div>
				
				<div class="btn-group">
                      <button type="button" class="btn btn-success">Action</button>
                      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo base_url();?>index.php/product">Products</a></li>
                        <li><a href="<?php echo base_url();?>index.php/category">Categories</a></li>
						<li><a href="<?php echo base_url();?>index.php/subcategory">Sub Categories</a></li>
						<li><a href="<?php echo base_url();?>index.php/size">Size</a></li>
                        
                      </ul>
                    </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="color_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Colour</th>
                  <th>Remarks</th>
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







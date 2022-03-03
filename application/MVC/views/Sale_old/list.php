

 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sale Details
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>index.php/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>index.php/sale/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
        <li class="active">Sale Details</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-md-3">
			   <div class="input-group margin">
					<div class="input-group-btn">
						<button type="button" class="btn btn-primary nohover">Invoice No</button>
					</div><!-- /btn-group -->
                                        <input type="text" name="product_name" placeholder="Invoice Number" id="sale_invoice_number" class="form-control">
				</div><!-- /input-group -->
			</div>
			<!--<div class="col-md-3">
			   <div class="input-group margin">
					<div class="input-group-btn">
						<button type="button" class="btn btn-primary nohover">Total Price</button>
					</div><!-- /btn-group 
                                        <input type="text" name="product_name" placeholder="Category Name" id="sale_totalPrice" class="form-control">
				</div><!-- /input-group 
			</div>-->
                        <div class="col-md-5">
				<div class="input-group margin">
					<div class="input-group-btn">
					<button type="button" class="btn btn-primary nohover">Date </button>
					</div><!-- /btn-group -->
					<input id="pmsDateStart" type="text" data-validation-optional="true" data-pms-max-date="today" data-pms-type="date" name="start_date" data-pms-date-to="pmsDateEnd" class="col-md-5 form-control" placeholder="dd/mm/yyyy" >
					<span tabindex="-1" class="input-group-btn select-calendar date-range"><button type="button" tabindex="-1" class="btn btn-default"><i class=" fa fa-calendar"></i></button></span>
						
					<input id="pmsDateEnd" type="text" data-validation-optional="true" data-pms-type="date" name="end_date" data-pms-date-from="pmsDateStart" class="col-md-5 form-control" placeholder="dd/mm/yyyy" >
					<span tabindex="-1" class="input-group-btn select-calendar date-range"><button type="button" tabindex="-1" class="btn btn-default"><i class=" fa fa-calendar"></i></button></span>
				</div>
			</div>
                       		
			<div class="col-md-1">
					<div class="input-group">
						<button type="button" id="search" class="btn bg-orange btn-flat margin" onclick="<?php if(isset($values->mainhead_id))echo $values->mainhead_id;?>">Search</button>
					</div>
			</div>
			
			<div class="col-sm-1">
				<div class="input-group">
					<a href="<?php echo base_url();?>index.php/sale"><button class="btn bg-navy btn-flat margin" >Refresh</button></a>
				</div>
			</div>
		</div>
		
      <div class="row">
        <div class="box">
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <div class="col-md-8"><h2 class="box-title"></h2> </div>
			  
			  <!--<div class="col-md-2">
                  <a href="<?php echo base_url();?>index.php/purchase/" class="btn btn-default"><i class="glyphicon glyphicon-user"></i>Purchase List</a>
              </div>-->
			  
              <div class="col-md-2">
                  <a href="<?php echo base_url();?>index.php/sale/add" class="btn btn-primary"><i class="fa fa-plus-square"></i>  Add new Sale</a>
              </div>
			  
			  <div class="btn-group">
                      <button type="button" class="btn btn-success">Action</button>
                      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo base_url();?>index.php/product">Products</a></li>
						<li><a href="<?php echo base_url();?>index.php/purchase">Purchase</a></li>
                                                <li><a href="<?php echo base_url();?>index.php/SaleReturn">Sale Return</a></li>
						<li><a href="<?php echo base_url();?>index.php/stock">Stock Management </a></li>
                        
                      </ul>
                    </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="sale_details_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>Sl No.</th>
                <th>invoice No.</th>
                <th>Sale Date</th>
                <th>Product Count</th>
                <th>Total price</th>
                <th>View / Invoice</th>
                <th>Edit / Delete</th>   
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







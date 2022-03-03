

 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Old Stock
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>index.php/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <!--<li><a href="<?php echo base_url();?>index.php/sale/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>-->
        <li class="active">Old Stock</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
				<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
                  <h3 class="box-title">Old Stock</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="old_stock_details" class="table table-striped">
                    <thead>
						<tr>
						  <th>Sl No.</th>
						  <th>Product Name</th>
						  <th>Category</th>
						  <th>Sub Category</th>
						  <th>Size</th>
						  <th>Color</th>
						  <th>Purchase date</th>
						  <th>Balance Quantity</th>
				
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
		  
		  </div>
		  
		  

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->







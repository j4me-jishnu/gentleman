

 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>index.php/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <!--<li><a href="<?php echo base_url();?>index.php/sale/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>-->
        <li class="active">Dashboard</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
	
		<div class="row">
            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php foreach ($total_sale as $total)
				{
					if($total->total == 0){
						echo '0.00';
					}
					else{
						echo $total->total;
					}
				}
				?> </h3>
				  <h4>Total Sale</h4>
                </div>
                <div class="icon">
                  <i class="fa fa-shopping-bag"></i>
                </div>
                <!--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
              </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php foreach ($total_purchase as $total)
				{
				   if($total->total == 0){
						echo '0.00';
					}
					else{
						echo $total->total;
					}
				}
				?> </h3>
                  <h4>Total Purchase</h4>
                </div>
                <div class="icon">
                  <i class="fa fa-cart-plus"></i>
                </div>
                <!--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
              </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php foreach ($product_count as $row)
				{
					if($row->total_count == 0){
						echo '0';
					}
					else{
						echo $row->total_count;
					}
				}
				?> </h3>
				  <h4>Total Product</h4>
                </div>
                <div class="icon">
                  <i class="fa fa-product-hunt"></i>
                </div>
                <!--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
		  
		  <div class="row">
			<div class="col-md-6">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">New Purchase</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
					<tr>
                      <th>Product Name</th>
                      <th>Quantity</th>
                      <th>Total Amount</th>
					</tr>
                      
					  <?php foreach ($purchase_details as $row)
					{ ?>
                    <tr><td><?php echo $row->product_name; ?></td>
					<td><?php echo $row->product_purchase_quantity; ?></td>
					<td><?php echo $row->purchase_total_price; ?></td></tr>
                    
					<?php } ?>
					
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			  </div>
			  
			  <div class="col-md-6">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Latest Sales</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                    <tr>
                      <th>Product Name</th>
                      <th>Sale Quantity</th>
                      <th>total Amount</th>
                    </tr>
					
					<?php foreach ($sale_details as $row)
					{ ?>
                    <tr><td><?php echo $row->product_name; ?></td>
					<td><?php echo $row->sale_quantity; ?></td>
					<td><?php echo $row->sale_total_price; ?></td></tr>
                    
					<?php } ?>
                    
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
		  </div>
		  
		  <div class="row">
			<div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
				<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
                  <center><h2 class="box-title">OLD STOCK</h2></center>
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
				<a href="<?php echo base_url();?>index.php/OldStock" class="small-box-footer pull-right btn btn-danger" >More Details <i class="fa fa-arrow-right"></i></a>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
		  
		  </div>
		  
		  

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->









		<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Invoice
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url();?>index.php/sale/">Back to list</a></li>
            <li class="active">Invoice</li>
          </ol>
        </section>
        <!-- Main content -->
        <section   class="col-xs-4 invoice">
		<div id="divName">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-5">
              <h2 class="page-header">
                <!--<center><img src="<?php echo base_url();?>assets/dist/img/anarkaly.png" alt="User Image"></center>-->
				<h1 style="font-family:Lucida Calligraphy;margin-left:60px;font-size:50px""><center><b>Lilac</b></center></h1>
               <!--<small class="pull-right" style="font-size:13px">Date: <?php echo date('d/m/Y');?></small>-->
              </h2>
            </div><!-- /.col -->
          </div>
		  <div class="row">
		  <div class="col-xs-5">
            <address >
                <span style="margin-left:90px;font-size:10px">Date:<?php echo date('d/m/Y');?></span><br>
                <span style="margin-left:67px;font-size:15px">MUVATTUPUZHA</span><br>
                <p style="font-size:14px;margin-left:40px">Phone:9400086205,9495260096</p>
                
            </address>
			
            </div>
          </div><!-- /.row -->
          <!-- Table row -->
          <div class="row">
            <div class="col-xs-6">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Rs</th>
                    <th>Discount</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
				<?php foreach ($sale_details as $row)
               {
				   ?>
				<tr>
					<td ><?php echo $row->product_name;?></td>
                    <td ><?php echo $row->sale_quantity;?></td>
                    <td ><?php echo $row->sale_amount;?></td>
                    <td ><?php echo $row->sale_discount;?></td>
                    <td><?php echo $row->sale_total_price;?></td>
                  </tr>
				<?php
				}
                 ?> 
				</tbody>
              </table>
            </div><!-- /.col -->
          </div><!-- /.row -->

          <div class="row">
 			<div class="col-xs-11">
			<?php foreach ($sale_details as $row)
               { ?>
              <p class="pull-right lead"><b>Total Amount : <?php echo $row->sale_total_price; ?></b></p>
			  <?php
				}
                 ?>
            </div><!-- /.col -->
          </div><!-- /.row -->
		</div>
          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-xs-16">
              <a class="btn btn-default" onclick="printDiv();"><i class="fa fa-print"></i> Print</a>
              <a href="<?php echo base_url();?>index.php/sale/" ><button class="btn btn-success pull-right">Go to View <i class="fa fa-arrow-right"></i></button></a>
              <a href="<?php echo base_url();?>index.php/sale/add" ><button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-reply"></i> Back to New Sale</button></a>
            </div>
          </div>
		  
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
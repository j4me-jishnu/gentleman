

		<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Invoice
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
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
                  
				<h1 style="font-family:Lucida Calligraphy;margin-left:30px;font-size:25px"><center><b><?php echo $admin_data->shop_name;?></b></center></h1>
               <!--<small class="pull-right" style="font-size:13px">Date: <?php echo date('d/m/Y');?></small>-->
              </h2>
            </div><!-- /.col -->
          </div>
		  <div class="row">
		  <div class="col-xs-10">
            <address >
				<span style="margin-left:100px;font-size:10px">Date:<?php echo date('d/m/Y');?></span><br>
                                <?php foreach ($invoice_no as $invoice)
                                {
				   ?>
                                <span style="margin-left:100px;font-size:10px">invioceNo.:#<?php echo $invoice->sale_invoice_number;?></span><br><?php } ?>
                <span style="margin-left:30px;font-size:15px"><?php echo $admin_data->shop_address;?></span><br>
                <p style="font-size:12px;margin-left:40px">Phone: <?php echo $admin_data->phone_no;?></p>
                
            </address>
                                	
            </div>
          </div><!-- /.row -->
          <!-- Table row -->
          <div class="row">
            <div class="col-xs-6">
              <table style="margin-left:20px;" class="table table-striped">
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
                    <td ><?php echo $row->sale_price;?></td>
                    <td ><?php echo $row->sale_discount;?></td>
                    <td><?php echo number_format($row->sale_total_price,2);?></td>
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
			<?php foreach ($sale_total as $row)
               { ?>
                      <?php foreach ($grand_total as $rows)
               { ?>
                <?php foreach ($tax_details as $tax)
               { ?>
              <p class="pull-right">Total Amount : <?php echo number_format($row->total,2); ?><br/>
              <span class="pull-right">Tax(<?php echo $tax->tax_name; ?>)(<?php echo $tax->tax_amount; ?>%) : <?php echo number_format(($row->total*$tax->tax_amount/100),2); ?></span></p>
              <p class="pull-right lead"><b>Grand Total : <?php echo number_format($row->total+($row->total*$tax->tax_amount/100),2); ?></b></p>
			  <?php
				}
               }
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
              <a href="<?php echo base_url();?>index.php/sale/add" ><button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-reply"></i> Back to Sale</button></a>
            </div>
          </div>
		  
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
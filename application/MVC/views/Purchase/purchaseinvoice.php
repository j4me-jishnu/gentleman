<?php

$arPayment = array("CR" =>"COD","CA"=>"Check","CK"=>"Credit");
?>

		<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Purchase Invoice
            <small></small>
          </h1>
          <ol class="breadcrumb">
           
            <li><a href="<?php echo base_url();?>index.php/Purchase/">Back to list</a></li>
          </ol>
        </section>
        <!-- Main content -->
        <section   class="col-xs-11 invoice">
	<div id="divName">
          <!-- title row -->
          <!--<img src="<?php echo base_url();?>assets/dist/img/Logo.PNG" alt="Logo" class='margin' />-->
		  <div class="row">
		  <div class="col-xs-4">
            <h3><?php echo $admin_data->shop_name;?></h3>
            <address><?php echo $admin_data->shop_address;?><br>
			<p>Phone No: <?php echo $admin_data->phone_no;?><br>
			Mail: <?php echo $admin_data->admin_email;?></p></address>
			
          </div>
		  
		  <div class="col-xs-4">
                      <h4>Supplier Details</h4>
                      <?php foreach ($vendor_details as $row) { ?>
                      
                        
                      <h5><b><?php echo $row->vendor_name;?></b></h5>
                            <address><b><?php echo $row->vendor_address; ?></b><br>
                            <p>Phone No: <b><?php echo $row->vendor_phone; ?></b></b><br>
                            Mail: <b><?php echo $row->vender_mail; ?></b></p></address>
                    <?php } ?>
			
          </div>
                      <div class="col-xs-4">
                          <p>Order Date: <b><?php echo date('d/m/Y')?></b><br>
                              <?php foreach ($grand_total as $row) { ?>
			Invoice No: <b>#TX<?php echo $row->purchase_invoice_no; ?></b></p>
                              <?php } ?>
                      </div>
          </div><!-- /.row -->
            <div class="row">
		<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Purchase Details</h3>
                </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-striped">
                            <tr>
                                    <th><center>Sl No.</center></th>
                                    <th><center>Product Name</center></th>
                                    <th><center>Category</center></th>
                                    <th><center>Size/ Unit</center></th>
                                    <th><center>color</center></th>
                                    <th><center>Purchase Quantity</center></th>
                                    <th><center>purchase Price</center></th>
                                    <th><center>Total</center></th>
                            </tr>
                            <?php
                            $i=1;
                            foreach($purchase_details as $purchase) {?>
                            <tr>
                                    <td><center><?php echo $i++ ?></center></td>
                                    <td><center><?php echo $purchase->product_name;?></center></td>
                                    <td><center><?php echo $purchase->category_name;?></center></td>
                                    <td><center><?php echo $purchase->size_name;?></center></td>
                                    <td><center><?php echo $purchase->color_name;?></center></td>
                                    <td><center><?php echo $purchase->product_purchase_quantity;?></center></td>
                                    <td><center><?php echo number_format($purchase->purchase_price,2);?></center></td>
                                    <td><center><?php echo number_format($purchase->purchase_total_price,2);?></center></td>
                            </tr>
                            <?php } ?>
			</table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
                <div class="col-md-8 pull-right">
                    <div class="col-md-3 pull-right">
                        <?php foreach($purchase_total as $purchase) {?>
                       <h4><b> Total :<span>    <?php echo number_format($purchase->total,2);?></b></h4>
                        <?php } ?>
                    </div>
                </div>
                
                <?php if($tax_details !=null){ ?>
                <div class="col-md-8 pull-right">
                    <div class="col-md-3 pull-right">
                            <?php foreach($grand_total as $total) {?>
                            <?php foreach($tax_details as $tax) {?>
                           <h7><b> Tax(<?php if(isset($tax->tax_name)) echo $tax->tax_name; ?>)(<?php echo number_format($tax->tax_amount,2); ?>%) :<span>    <?php echo number_format((($purchase->total * $tax->tax_amount)/100),2);?></b></h7>
                            <?php 
                            }
                            } ?>
                    </div>
                </div>
                <?php } ?>
                <?php if($tax_details != null){ ?>
                <div class="col-md-11 pull-right">
                    <div class="col-md-4 pull-right">
                            <?php foreach($grand_total as $total) {?>
                        <h3><b>Grand Total :<span>    <?php echo number_format($purchase->total +(($purchase->total * $tax->tax_amount)/100),2);?></b></h3>
                            <?php } ?>
                    </div>
                </div>
                <?php } else { ?>
                <div class="col-md-11 pull-right">
                    <div class="col-md-4 pull-right">
                            <?php foreach($grand_total as $total) {?>
                        <h3><b>Grand Total :<span>    <?php echo number_format($purchase->total,2);?></b></h3>
                            <?php } ?>
                    </div>
                </div>
                <?php } ?>
		  
            </div>
	</div>
          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-xs-11">
			<div class="col-xs-4"></div>
			
			<div class="col-xs-2">
              <a class="btn btn-default" onclick="printDiv();"><i class="fa fa-print"></i> Print</a>
			</div>
			
			<!--<div id="editor"></div>-->
			<!--<div class="col-xs-2">
              <button class="btn btn-success" id="cmd"><i class="fa fa-download"></i> Save PDF</button>
			</div>-->
			
			<div class="col-xs-2">
              <a href="<?php echo base_url();?>index.php/purchase/" ><button class="btn btn-warning"><i class="fa fa-rotate-left"></i> Back to View</button></a>
			</div> 
            </div>
          </div>
		  
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
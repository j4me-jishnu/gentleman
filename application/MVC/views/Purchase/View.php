

 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <?php foreach($vendor_details as $vendor) { ?>
      <h1>Purchase Details of  <span class="label label-success"><?php echo $vendor->vendor_name;?></span></h1>
        <?php } ?>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>index.php/dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>index.php/Purchase/"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active">Purchase Details</li>
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
			  <?php foreach($grand_total as $total) { ?>     
              <h3 class="box-title">Invoice No : <span style="font-size:16px;color:red"><b>#TX<?php echo $total->purchase_invoice_no;?></b></span></h3>
                          <?php } ?>
              
              <div class="pull-right"><a href="<?php echo base_url();?>index.php/Purchase/"><button class="btn btn-success">Back to View</button></a>
                   <a href="<?php echo base_url();?>index.php/Purchase/invoice/<?php echo $total->purchase_invoice_no;?>/<?php echo $total->vendor_id_fk ?>"><button class="btn btn-primary">View Invoice</button></a></div>
            </div>
             
           <div class="box-body">
               <div class="form-group">
                   <label class="col-sm-12"><h4><center>Vendor Details</center></h4></label>
                   <div class="col-md-12">
                   <table class="table table-striped">
                       <thead>
                           <tr>
                               <th>Vendor Name</th>
                               <th>Phone Address</th>
                               <th>Mail Id</th>
                               <th>Phone Number</th>
                               <th>Tin No.</th>
                               <th>Pin No.</th>
                           </tr>
                       </thead>
                       <?php foreach($vendor_details as $vendor) { ?>
                       <tbody>
                            <td><?php echo $vendor->vendor_name;?></td>
                            <td><?php echo $vendor->vendor_address;?></td>
                            <td><?php echo $vendor->vender_mail;?></td>
                            <td><?php echo $vendor->vendor_phone;?></td>
                            <td><?php echo $vendor->vendor_tin;?></td>
                            <td><?php echo $vendor->vendor_pin;?></td>
                       </tbody>
                       <?php } ?>
                       
                   </table>
                   </div>
                   <label class="col-sm-12"><h4><center>Purchase Details</center></h4></label>
                   <div class="col-md-12">
                   <table class="table table-striped">
                       <thead>
                           <tr>
                               <th>Sl No.</th>
                               <th>Product Name</th>
                               <th>Category</th>
                               <th>Sub Category</th>
                               <th>Size</th>
                               <th>Color</th>
                               <th>Quantity</th>
                               <th>Purchase Price</th>
                               <th>Sale Price</th>
                               <th>Total Price</th>
                               <th><center>Barcode</center></th>
                           </tr>
                       </thead>
                       <?php 
                       $i=1;
                       foreach($purchase_details as $vendor) { ?>
                       <tbody>
                           
                           <td><?php echo $i++; ?></td> 
                           
                            <td><?php echo $vendor->product_name;?></td>
                            <td><?php echo $vendor->category_name;?></td>
                            <td><?php echo $vendor->subcategory_name;?></td>
                            <td><?php echo $vendor->size_name;?></td>
                            <td><?php echo $vendor->color_name;?></td>
                            <td><?php echo $vendor->product_purchase_quantity;?></td>
                            <td><?php echo number_format($vendor->purchase_price,2);?></td>
                            <td><?php echo number_format($vendor->sale_price,2);?></td>
                            <td><?php echo number_format($vendor->purchase_total_price,2);?></td>
                            <td><center><a href="<?php echo base_url();?>index.php/barcode/generate/<?php echo $vendor->purchase_id;?>" class="btn btn-app"><i class="fa fa-barcode" ></i></a></center></td>
                       </tbody>
                       <?php } ?>
                       
                   </table>
                   </div>
		</div>
            </div>
              <!-- /.box-body -->
            <div class="box-footer">
                <div class="row">
                    <div class="col-md-3 pull-right">
                        <h3><?php foreach($purchase_total as $purchase) {?>
                        Sub Total : <?php echo number_format($purchase->total,2);?>
                        <?php } ?></h3>
                    </div>
                </div>
                <?php if($tax_details !=null){ ?>
                <div class="row">
                    <div class="col-md-3 pull-right">
                       <h4> <?php foreach($grand_total as $total) {?>
                            <?php foreach($tax_details as $tax) {?>
                        Tax(<?php echo $tax->tax_name; ?>)(<?php echo number_format($tax->tax_amount,2); ?>%) :<span>    <?php echo number_format((($purchase->total * $tax->tax_amount)/100),2);?></h4>
                    <?php 
                            }
                            } ?>
                        
                    </div>
                    
                </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-3 pull-right">
                        <?php foreach($grand_total as $total) {?>
                            <?php foreach($tax_details as $tax) {?>
                        <h3><b>Grand Total: <?php echo number_format($purchase->total+(($purchase->total * $tax->tax_amount)/100),2);?></b></h3>
                    <?php 
                            }
                            } ?>
                    </div>
                </div>
                
            </div>
            
              
              <!-- /.box-footer -->
            
          </div>
          <!-- /.box -->
          
        </div>
        <!--/.col (right) -->
     </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->







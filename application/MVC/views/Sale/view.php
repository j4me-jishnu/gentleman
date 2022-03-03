

 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <h1>Sale Details</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>index.php/dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>index.php/sale/"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active">Sale Details</li>
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
			       
              <h3 class="box-title">Invoice No : <span style="font-size:16px;color:red"><b>#TX<?php echo $invoice_number->sale_invoice_number;?></b></span></h3>
              <div class="pull-right"><a href="<?php echo base_url();?>index.php/sale/" ><button class="btn btn-success">Back To View</button></a></div>           
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <!-- radio -->
           <div class="box-body">
               <div class="form-group">
                   <label class="col-sm-12"><h4><center>Sale Details</center></h4></label>
                   <div class="col-md-12">
                   <table class="table table-striped">
                       <thead>
                           <tr>
                               <th>Sl No</th>
                               <th>Product Name</th>
                               <th>Category</th>
                               <th>Sub Category</th>
                               <th>Size</th>
                               <th>Color</th>
                               <th>Quantity</th>
                               <th>Sale Price</th>
                               <th>Total Price</th>
                           </tr>
                       </thead>
                       <?php  $i=1; foreach($sale_details as $sale) { ?>
                       <tbody>
                           <td><?php echo $i++;?></td>
                            <td><?php echo $sale->product_name;?></td>
                            <td><?php echo $sale->category_name;?></td>
                            <td><?php echo $sale->subcategory_name;?></td>
                            <td><?php echo $sale->size_name;?></td>
                            <td><?php echo $sale->color_name;?></td>
                            <td><?php echo $sale->sale_quantity;?></td>
                            <td><?php echo number_format($sale->sale_price,2);?></td>
                            <td><?php echo number_format($sale->sale_total_price,2);?></td>
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
                        <?php foreach($sale_total as $total){ ?>
                        <h3>Total : <?php echo number_format($total->sale_total,2) ?></h3>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 pull-right">
                        
                       <h4>
                           
                        Tax(<?php echo $tax_details->tax_name ?>)(<?php echo $tax_details->tax_amount ?>)% : <?php echo number_format($total->sale_total*$tax_details->tax_amount/100,2) ?></h4>
                       
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-3 pull-right">
                        <h3><b>Grand Total: <?php echo number_format($total->sale_total +($total->sale_total*$tax_details->tax_amount/100),2) ?></b></h3>
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







<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <h1>Purchase Details</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dash_board/"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>purchaserequest"><i class="fa fa-dashboard"></i> Back to List</a></li>
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
			  <address class="adrs">
				Branch : <?php echo $record[0]->ref_number;?><br>
				Address : <?php echo $branch[0]->branch_address;?><br>
				Phone : <?php echo $branch[0]->branch_phone;?><br>
				Email : <?php echo $branch[0]->branch_email;?><br>
				<br>
				Manager : <?php echo $branch[0]->username;?><br>
			  </address>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <!-- radio-->
           <div class="box-body table-responsive">
               <div class="form-group">
                   <label class="col-sm-12"><h4><center>Item Details</center></h4></label>
                   <div class="col-md-12">
                   <table class="table table-striped table-responsive">
                       <thead>
                           <tr>
                               <th>Sl No</th>
                               <th>Item Name</th>
                               <th>Category</th>
                               <th>Quantity</th>
                               <th>Price</th>
							   <th>Tax</th>
							   <th>Total</th>
                           </tr>
                       </thead>
                       <?php  $i=1; foreach($record as $records) { ?>
                       <tbody>
                            <td><?php echo $i++;?></td>
                            <td><?php echo $records->item_name;?></td>
							<td><?php echo $records->category_name;?></td>
							<td><?php echo $records->item_quantity;?></td>
							<td><?php echo $records->item_price;?></td>
							<td><?php echo $records->taxamount;?></td>
							<td><?php echo $records->item_total;?></td>
                       </tbody>
                       <?php } ?>

                   </table>
                   </div>
		</div>
            </div>
			<div class="box-footer">
			<p class="pull-right lead">Grand Total :  <?php echo number_format($record[0]->grand_total,2); ?></p>
			</div>
              <!-- /.box-body
            <div class="box-footer">
                <?php
            $five = 0;$twentyeight = 0; $eighteen = 0; $twelve = 0;$igsttwelve = 0;$igsteighty = 0;$igsttwetyeight = 0;$igstfive = 0;$vatfive = 0;
                foreach($sale_details as $row) {?>

                     <?php
                        foreach($tax_details as $taxtype){
                        $taxtypes = isset($row->taxid_fk)?$row->taxid_fk:'';

                        if($taxtypes == $taxtype->tax_id)
                         {
                            $tax = $taxtype->tax_name ;
                            $amount = ($row->sale_price * $row->sale_quantity)-$row->sale_discount;
                            $amount = $amount / 100;
                            if($tax == 'GST @ 12% (split tax)')
                            { $twelve++ ;$amount = $amount * 12; $amount = $amount/2;if($twelve==1){$amt=$amount;}else{$amt=$amt+$amount;} ?>
                            <div class="row" id="cgsttwelve"><div class="col-xs-12 "><p class="pull-right"> <?php echo "CGST @6.0" ;?>&nbsp&nbsp&nbsp&nbsp<i class="fa fa-rupee" ></i>&nbsp<?php echo "$amt" ;?></p></div></div>
                            <div class="row" id="sgsttwelve"><div class="col-xs-12 "><p class="pull-right"> <?php echo "SGST @6.0" ;?>&nbsp&nbsp&nbsp&nbsp<i class="fa fa-rupee" ></i>&nbsp<?php echo "$amt" ;?></p></div></div>
                           <?php }
                           else if($tax == 'GST @ 18% (split tax)')
                            { $eighteen++ ;$amount = $amount * 18; $amount = $amount/2;if($eighteen==1){$amt=$amount;}else{$amt=$amt+$amount;}?>
                            <div class="row" id="cgsteighteen"><div class="col-xs-12 "><p class="pull-right"> <?php echo "CGST @9.0" ;?>&nbsp&nbsp&nbsp&nbsp<i class="fa fa-rupee" ></i>&nbsp<?php echo "$amt" ;?></p></div></div>
                            <div class="row" id="sgsteighteen"><div class="col-xs-12 "><p class="pull-right"> <?php echo "SGST @9.0" ;?>&nbsp&nbsp&nbsp&nbsp<i class="fa fa-rupee" ></i>&nbsp<?php echo "$amt" ;?></p></div></div>
                           <?php }
                           else if($tax == 'GST @ 28% (split tax)')
                            { $twentyeight++ ;$amount = $amount * 28; $amount = $amount/2;if($twentyeight==1){$amt=$amount;}else{$amt=$amt+$amount;}?>
                            <div class="row" id="cgsttwenty"><div class="col-xs-12 "><p class="pull-right"> <?php echo "CGST @14.0" ;?>&nbsp&nbsp&nbsp&nbsp<i class="fa fa-rupee" ></i>&nbsp<?php echo "$amt" ;?></p></div></div>
                            <div class="row" id="sgsttwenty"><div class="col-xs-12 "><p class="pull-right"> <?php echo "SGST @14.0" ;?>&nbsp&nbsp&nbsp&nbsp<i class="fa fa-rupee" ></i>&nbsp<?php echo "$amt" ;?></p></div></div>
                           <?php }
                           else if($tax == 'GST @ 5% (split tax)')
                            { $five++ ;$amount = $amount * 5; $amount = $amount/2;if($five==1){$amt=$amount;}else{$amt=$amt+$amount;} ?>
                            <div class="row" id="cgstfive"><div class="col-xs-12 "><p class="pull-right"> <?php echo "CGST @2.5" ;?>&nbsp&nbsp&nbsp&nbsp<i class="fa fa-rupee" ></i>&nbsp<?php echo "$amt" ;?></p></div></div>
                            <div class="row" id="sgstfive"><div class="col-xs-12 "><p class="pull-right"> <?php echo "SGST @2.5" ;?>&nbsp&nbsp&nbsp&nbsp<i class="fa fa-rupee" ></i>&nbsp<?php echo "$amt" ;?></p></div></div>
                           <?php }
                           else if($tax == 'IGST @ 12%')
                            {$igsttwelve++ ;$amount = $amount * 12; if($igsttwelve==1){$amt=$amount;}else{$amt=$amt+$amount;} ?>
                            <div class="row" id="igsttwelve"><div class="col-xs-12 "><p class="pull-right"> <?php echo "IGST @12.0" ;?>&nbsp&nbsp&nbsp&nbsp<i class="fa fa-rupee" ></i>&nbsp<?php echo "$amt" ;?></p></div></div>
                           <?php }
                           else if($tax == 'IGST @ 18%')
                            {$igsteighty++ ;$amount = $amount * 18; if($igsteighty==1){$amt=$amount;}else{$amt=$amt+$amount;}?>
                            <div class="row" id="igsteighty"><div class="col-xs-12"><p class="pull-right"> <?php echo "IGST @18.0" ;?>&nbsp&nbsp&nbsp&nbsp<i class="fa fa-rupee" ></i>&nbsp<?php echo "$amt" ;?></p></div></div>
                           <?php }
                           else if($tax == 'IGST @ 28%')
                            {$igsttwetyeight++ ;$amount = $amount * 28; if($igsttwetyeight==1){$amt=$amount;}else{$amt=$amt+$amount;} ?>
                            <div class="row" id="igsttwetyeight"><div class="col-xs-12 "><p class="pull-right"> <?php echo "IGST @28.0" ;?>&nbsp&nbsp&nbsp&nbsp<i class="fa fa-rupee" ></i>&nbsp<?php echo "$amt" ;?></p></div></div>
                           <?php }
                           else if($tax == 'IGST @ 5%')
                            { $igstfive++ ;$amount = $amount * 5; if($igstfive==1){$amt=$amount;}else{$amt=$amt+$amount;}?>
                            <div class="row" id="igstfive"><div class="col-xs-12 "><p class="pull-right"> <?php echo "IGST @5.0" ;?>&nbsp&nbsp&nbsp&nbsp<i class="fa fa-rupee" ></i>&nbsp<?php echo "$amt" ;?></p></div></div>
                           <?php }
                         }
                            }
                        ?>
                     <?php } ?>

            <div class="row">
                <div class="col-xs-12">

                <?php foreach ($grand_total as $rows)
               { ?>
               <p class="pull-right lead">Grand Total : <?php echo number_format($row->grand_total,2); ?></p>
			  <?php
               }

                 ?>
                </div>
           </div>

            </div>-->
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

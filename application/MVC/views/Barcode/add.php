

 <style>
#barcodetable>tr>td{width:60px;}

</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Barcode Generate Form
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>index.php/size/"><i class="fa fa-dashboard"></i> Back to View</a></li>
        <li class="active">Barcode Generate Form</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">

          <!-- right column -->
        <div class="col-md-8">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/barcode/create/<?php echo $purchase_id_fk ?>">
              <!-- radio -->
               <div class="form-group">
			   <input type="hidden" name="purchase_id_fk" value="<?php echo $purchase_id_fk ?>"/>
                <?php echo validation_errors(); ?>
                 <label for="inputEmail3" class="col-sm-2 control-label"></label>
                <!--<div class="col-sm-10 input-group date">
                  <label class="col-sm-4 control-label">
                  <input type="radio" name="customer_type" class="flat-red customerType" value="N" checked>
                  New customer
                  </label>

                  <label class="col-sm-4 control-label">
                  <input type="radio" name="customer_type" value="O" class="flat-red customerType">
                  Old customer
                  </label>
                </div>-->
                 
                </div>
              <div class="box-body">
                <div class="form-group">
                  <label for="size_name" class="col-sm-2 control-label">Barcode Rows</label>
					
                  <div class="col-sm-4">
                    <input type="text" autofocus class="form-control" name="barcode_count" placeholder="Count" >
                  </div>
				  <a href="<?php echo base_url();?>index.php/barcode/create/<?php echo $purchase_id_fk ?>"><button class="btn pull-right">refresh</button></a>
				        </div>  
              </div>
			<section   >
			<div id="divName">
			<table style="margin-left:10px;">
              <?php if(isset($barcode_image) && $barcode_image != '') {
                for($i = 0; $i<$count;$i++){?>
                  
					<td class="res" style="text-align:center; font-size: 10px; margin-right: 144px; margin-left: 153px; border-left-width: 112px; border-right-width: 36px; height: 98px; width: 100px"><div style="width: 200px; height: 85px;"><p><?php  echo $records->product_name;?></p>
                  <p>Price:<?php echo $records->sale_price;?></p><?php
                  echo '<img style="height:20px;width:80px" src="data:image/png;base64,' . $barcode_image . '" /><br/><br/>'; ?>
				  </div></td> 
					
				 <td class="rep" style="font-size: 10px; text-align:center; margin-left=10px;"><div style="width: 200px; height: 85px;"> <p><?php  echo $records->product_name;?></p>
                  <p>Price:<?php echo $records->sale_price;?></p><?php
                  echo '<img style="height:20px;width:80px" src="data:image/png;base64,' . $barcode_image . '" /><br/><br/>'; ?>
				 </div> </td>
				  
				  
				  
					
				  


		<?php

                } ?>
				</table>
			  </div>
			  </section>
				
                <div class="box-footer">
                <button type="button" onclick="printDiv();" class="btn btn-info">Print</button>
                
              </div>

               <?php } 
               else{
                ?>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info">Next</button>
                <button type="reset" class="btn pull-right">Cancel</button>
              </div>
              <?php }  ?>
			 
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
          
        </div>
        <!--/.col (right) -->
     </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->







<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Add Payment
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add payment</li>
      </ol>
    </section>
	<form class="form-horizontal" method="POST" action="<?php echo base_url();?>Vendor/addPaymentAction">
     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
		  <fieldset>
		    <legend>Payment</legend>
			<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
            
              <!-- radio -->
               <div class="form-group">
			   <input type="hidden" name="vendor_id" value="<?php if(isset($data->vendor_id)) echo $data->vendor_id ?>"/>
                <?php echo validation_errors(); ?>
			    <div class="box-body">
				<div class="form-group">
					  <label for="size_name" class="col-sm-4 control-label">Vendor Name <span style="color:red">*</span></label>

					  <div class="col-sm-5">
						<input type="text"  required  class="form-control" name="vendor_name" id="vendorname"  value="<?php if(isset($data->vendorname)) echo $data->vendorname ?>" readonly>
					  </div>
				</div>
				<div class="form-group">
					  <label for="size_name" class="col-sm-4 control-label">Address<span style="color:red">*</span></label>

					  <div class="col-sm-5">
						<textarea class="form-control" name="vendor_address" readonly> <?php if(isset($data->vendoraddress)) echo $data->vendoraddress ?> </textarea>
					  </div>
				</div>
         
			

				<div class="form-group">
					  <label for="size_name" class="col-sm-4 control-label">Purchase Details<span style="color:red"></span></label>

					  <div class="col-sm-5">
						<select id="purchase" class="form-control" name="purchase">
						<option>--Please Select--</option>
						<?php
						foreach($item as $row){

							echo '<option value="'.$row->pr_id.'">'.$row->item_name.'</option>';
						}
						
						?>
						</select>
					  </div>
				</div>
			

				<div class="form-group">
					  <label for="size_name" class="col-sm-4 control-label">Paid amount</label>

					  <div class="col-sm-5">
						<input type="text"  required  class="form-control" name="paid_amount" id="paid"  value="<?php if(isset($data->paid_amount)) echo $data->paid_amount ?>" readonly>
					  </div>
				</div>
				<div class="form-group">
					  <label for="size_name" class="col-sm-4 control-label">Balance</label>

					  <div class="col-sm-5">
						<input type="text"  required  class="form-control" name="balance" id="balance"  value="<?php if(isset($total)) echo $total-$data->paid_amount ?>" readonly>
					  </div>
				</div>
				
				<div class="form-group">
					  <label for="size_name" class="col-sm-4 control-label">Add payment</label>

					  <div class="col-sm-5">
						<input type="text"  required  class="form-control" placeholder="Amount" name="amount" id="vendor_stcode">
					  </div>
				</div>
                </div>
              <!-- /.box-body -->
              
            
			</fieldset>
          </div>
          
          <!-- /.box -->
        </div>
		<div class="box-footer">                
                <div class="row">
                  <div class="col-md-6">
                  </div>
                  <div class="col-md-4">
                      <button type="button" class="btn btn-danger" onclick="window.location.reload();">Cancel</button>
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  </div>
	    </div>
        <!-- /.col -->
        </div>
      
    </section>
	
	</form>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script>

$(document).ready(function(){
 $('#purchase').change(function(){
  var pr_id = $('#purchase').val();
  
  if(pr_id != '')
  {
   $.ajax({
    url:"<?php echo site_url('Vendor/get_amount');?>",
    method:"POST",
    data:{pr_id:pr_id},
    success:function(data)
    {
     
		var obj = JSON.parse(data);

     $('#balance').val(obj[0].grand_total - obj[0].amount_paid);
	 $('#paid').val(obj[0].amount_paid);


    }
   });
  }
  
 });


 
});



  </script>






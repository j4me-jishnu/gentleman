

 <?php $tax_type = array(""=>"---Please Select---",1=>"Input Tax",2=>"Output Tax");?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tax Details Form
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>index.php/dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>index.php/Tax/"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active">Tax Details Form</li>
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
            <form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/Tax/add">
              <!-- radio -->
                <div class="form-group">
					<input type="hidden" name="tax_id" value="<?php if(isset($records->tax_id)) echo $records->tax_id ?>"/>
					<?php echo validation_errors(); ?>
					<label for="inputEmail3" class="col-sm-2 control-label"></label>
                </div>
            <div class="box-body">
                <div class="form-group">
                  <label for="size_name" class="col-sm-2 control-label">Tax Name <span style="color:red;"><b>*</b></span></label> 

                  <div class="col-sm-8">
                    <input type="text" data-pms-required="true" autofocus class="form-control" name="tax_name" placeholder="Tax Name" value="<?php if(isset($records->tax_name)) echo $records->tax_name ?>">
                  </div>
                </div>
                
                 <div class="form-group">
                  <label for="size_name" class="col-sm-2 control-label">Tax Type <span style="color:red;"><b>*</b></span></label> 

                  <div class="col-sm-8">
                    <select name="tax_type" data-pms-required="true" data-pms-type="dropDown" class="form-control pull-right select2" >
                      <?php foreach ($tax_type as $key => $value) { 
                        $Types = isset($records->tax_type)?$records->tax_type:''; ?>
                        <option value="<?php echo $key;?>" <?php if($Types == $key) echo "selected=selected"?>><?php echo $value;?> </option>
                      <?php } ?>
                      
                    </select>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="size_name" class="col-sm-2 control-label">Tax Amount <span style="color:red;"><b>*</b></span></label> 

                  <div class="col-sm-8">
                    <input type="text" data-pms-required="true" class="form-control" name="tax_amount" data-pms-type="digitsOnly" placeholder="Tax Amount (%)" value="<?php if(isset($records->tax_amount)) echo $records->tax_amount ?>">
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="details" class="col-sm-2 control-label">Tax Details</label>

                  <div class="col-sm-8">
                    <textarea class="form-control"  name="tax_description"><?php if(isset($records->tax_description)) echo $records->tax_description; ?></textarea>
                  </div>
                </div>
                
               
				
            </div>
              <!-- /.box-body -->
              
			  <div class="box-footer">
				<button type="submit" class="btn btn-info">Next</button>
                <button type="reset" class="btn pull-right">Cancel</button>
                
              </div>
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







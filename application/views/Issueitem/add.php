<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Issueitem Form
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Issueitem Form</li>
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
              <h3 class="box-title pull-right"><span style="display: none;" id="available">Available balance:<span id="avail"></span></span></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="<?php echo base_url();?>issueitem/add">
              <!-- radio -->
               <div class="form-group">
			   <input type="hidden" name="branch_id" value="<?php if(isset($records->branch_id)) echo $records->branch_id ?>"/>
                <?php echo validation_errors(); ?>
                 <label for="inputEmail3" class="col-sm-2 control-label"></label>
                </div>
				<div class="box-body">
					<div class="form-group">
					  <label for="size_name" class="col-sm-1 control-label">Issued to<span style="color:red">*</span></label>

					  <div class="col-sm-2">
						<select name ="user_id" class="form-control" id ="userid">
						    <option></option>
              <?php foreach($users as $use){?><option value ="<?php echo $use->user_id;?>"><?php echo $use->username?> </option><?php } ?>
              
            </select>
						
					  </div>
					
					  <label for="size_name" class="col-sm-1 control-label">ItemName<span style="color:red">*</span></label>

					  <div class="col-sm-2">
						<select id="itemid"  name="itemid" data-pms-required="true" data-pms-type="alphanumericsOnly" class="form-control pull-right select2" >
						<option value="">----Please Select----</option>
							<?php
								foreach($item as $items){
									$item_names = isset($records->itemid_fk)?$records->itemid_fk:'';
									?>
								<option  value="<?php echo $items->item_id_fk?>"><?php echo $items->item_name; ?></option>
								 <?php
									}
							?>
						</select>
           
					  </div>
					  
					  <label for="size_name" class="col-sm-1 control-label">Quantity<span style="color:red">*</span></label>

					  <div class="col-sm-2">
						<input type="text" data-pms-required="true"  class="form-control" id="quantity" name="quantity" placeholder="Quantity" value="<?php if(isset($records->quantity)) echo $records->quantity ?>" >
					  </div>
					  <label for="size_name" class="col-sm-1 control-label">Date<span style="color:red">*</span></label>

					  <div class="col-sm-2">
						<input type="text" data-pms-required="true" id="date" class="form-control" name="issue_date" placeholder="Date" value="<?php echo date('d/m/Y'); ?>">
					  </div>



            
					</div>
                </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="reset" class="btn ">Cancel</button>
                <button type="submit" class="btn btn-info pull-right">Next</button>
              </div>
              <!-- /.box-footer -->
            </form>
            <input type="hidden" id ="sum">
            <input type="hidden" id ="benchmark">
          </div>
          <!-- /.box -->
          
        </div>
        <!--/.col (right) -->
     </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->







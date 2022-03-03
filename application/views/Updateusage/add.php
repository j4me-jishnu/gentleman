<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Usageupdate Form
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Usageupdate Form</li>
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
              <h3 class="box-title pull-right"><span id="issued" style="display:none;">Issued Quantity: <span id="iss"></span></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="used" style="display:none;">Used Quantity: <span id="use"></span></span></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="<?php echo base_url();?>updateusage/add">
              <!-- radio -->
               <div class="form-group">
			   <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
			   <input type="hidden" name="branch_id" value="<?php if(isset($records->branch_id)) echo $records->branch_id ?>"/>
                <?php echo validation_errors(); ?>
                 <label for="inputEmail3" class="col-sm-2 control-label"></label>
                </div>
				<div class="box-body">
					<div class="form-group">
					<!--<label for="size_name" class="col-sm-2 control-label">Name<span style="color:red">*</span></label>
					<div class="col-sm-2">
					<input type="text" data-pms-required="true"  id="staff_name"  class="form-control" name="staff_name" placeholder="Employee Name" value="">
					</div>-->
					<label for="size_name" class="col-sm-2 control-label">Date<span style="color:red">*</span></label>
					<div class="col-sm-2">
					<input type="text" data-pms-required="true"  id="date" readonly class="form-control" name="branch_phone" placeholder="Date" value="<?php echo date('d/m/Y');?>">
					<input type="hidden" id="issue_ck"/>
					<input type="hidden" id="used_ck"/>
					<input type="hidden" id="returned"/>
					</div>
					</div>
					<div class="form-group">
					<label for="size_name" class="col-sm-2 control-label">Name<span style="color:red">*</span></label>
					<div class="col-sm-2">
					<input type="text" data-pms-required="true"  class="form-control" name="emp_name" id="emp_name" placeholder="Name" value="<?php if(isset($records->branch_phone)) echo $records->branch_phone ?>">	
					<input type="hidden" data-pms-required="true"  class="form-control" name="userid" id="userid"  value="<?php if(isset($records->userid_fk)) echo $records->userid_fk ?>">
					</div>
					</div>
					<!--<div class="form-group">
					<label for="size_name" class="col-sm-2 control-label">User ID<span style="color:red">*</span></label>
					<div class="col-sm-2">
					
					</div>
					</div>-->
					<div class="form-group">
					  <label for="size_name" class="col-sm-2 control-label">ItemName<span style="color:red">*</span></label>

					  <div class="col-sm-2">
						<select id="itemid"  name="itemid" data-pms-required="true" data-pms-type="alphanumericsOnly" class="form-control select2" >
						<option value="">----Please Select----</option>
							<?php
								foreach($item as $items){
									$item_names = isset($records->itemid_fk)?$records->itemid_fk:'';
									?>
								<option  value="<?php echo $items->item_id?>"<?php if($item_names == $items->item_id) echo "selected=selected"?>><?php echo $items->item_name ?></option>
								 <?php
									}
							?>
						</select>
					  </div>
					</div>
					<div class="form-group">
					 <label for="size_name" class="col-sm-2 control-label">Quantity<span style="color:red">*</span></label>

					  <div class="col-sm-2">
						<input type="text" data-pms-required="true"  class="form-control" name="item_quantity" id="item_quantity" placeholder="Quantity" value="<?php if(isset($records->branch_phone)) echo $records->branch_phone ?>">
					  </div>
					</div>
					<div class="form-group">
					  <label for="size_name" class="col-sm-2 control-label">Update</label>

					  <div class="col-sm-2">
						<input type="checkbox" name="usage_update" value="1">
					  </div>
					  
					  <label for="size_name" class="col-sm-2 control-label">Return</label>

					  <div class="col-sm-2">
						<input type="checkbox" name="usage_update" value="2">
					  </div>
					  </div>
				</div>
				<div id="addcolour" class="modal fade" role="dialog">
                <div class="modal-dialog">
                        <div class="modal-content">
                                <div class="modal-header">
                                        <button type="button" class="close" onclick="colourmodalclose()" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Enter Narration</h4></div>

                                <div class="form-group clearfix">
                                       <div class="col-md-2">
                                        <label for="exampleInputEmail1">Narration</label>
                                        </div>

                                        <div class="col-md-5">
                                        <textarea class="form-control" name="narration" id="narration"></textarea>
                                        </div>   

                                </div>
                                
                        <div class="modal-footer">

                        <button type="button"  onclick="srate()" class="btn btn-primary option" data-dismiss="modal">OK</button>

                        </div>
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
		</div>
          <!-- /.box -->
          
        </div>
        <!--/.col (right) -->
     </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->







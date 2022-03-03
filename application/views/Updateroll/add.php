<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Rollupdate Form
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Rollupdate Form</li>
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
            <form class="form-horizontal" method="POST" action="<?php echo base_url();?>updateroll/add" enctype="multipart/form-data">
              <!-- radio -->
               <div class="form-group">
			   <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
			   <input type="hidden" name="bra_id" value="<?php if(isset($records->branch_id)) echo $records->branch_id ?>"/>
                <?php echo validation_errors(); ?>
                 <label for="inputEmail3" class="col-sm-2 control-label"></label>
                </div>
				<div class="box-body">
					<div class="form-group">
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
					<input type="hidden" value="<?php if(isset($item[0]->item_id)) echo $item[0]->item_id;?>"/>
					</div>
					</div>
					<div class="form-group">
					 <label for="size_name" class="col-sm-2 control-label">Quantity<span style="color:red">*</span></label>

					  <input type="hidden" name="txt_file" value="<?php if(isset($records->company_logo)) echo $records->company_logo ?>"/>
					  <input  type="file" class="col-sm-2" name="text_file" />
					  <input type="hidden" name="itemid" id="itemid" value="<?php if(isset($item[0]->item_id)) echo $item[0]->item_id;?>"/>
					</div>
					<div class="form-group">
					  <label for="size_name" class="col-sm-2 control-label">Update</label>

					  <div class="col-sm-2">
						<input type="checkbox" name="usage_update" value="1">
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







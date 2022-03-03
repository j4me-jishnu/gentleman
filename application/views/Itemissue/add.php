<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Item Issue to Branch Details
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Item Issue to Branch Details</li>
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
              <h3 class="box-title"></h3>
			  <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Itemissue/add">
              <!-- radio -->
               <div class="form-group">
			   <input type="hidden" name="branch_id" value="<?php if(isset($records->branch_id)) echo $records->branch_id ?>"/>
                <?php echo validation_errors(); ?>
                 <label for="inputEmail3" class="col-sm-2 control-label"></label>
                </div>
				<div class="box-body">
					<div class="form-group">
					  <label for="size_name" class="col-sm-2 control-label">Item name<span style="color:red">*</span></label>

					  <div class="col-sm-2">
						<input type="text" data-pms-required="true"  class="form-control" id="item_name" name="item_name" placeholder="ItemName" value="<?php if(isset($records->item_name)) echo $records->item_name ?>" >
						<input type="hidden" id="item_id" name="item_id" value="<?php if(isset($records->item_id_fk)) echo $records->item_id_fk ?>"/>
						<input type="hidden" name="stock_id" value="<?php if(isset($records->stock_id)) echo $records->stock_id ?>" />
						<input type="hidden" name="stock_id" value="<?php if(isset($records->stock_id)) echo $records->stock_id ?>" />
					  </div>
					  <label for="description" class="col-sm-1 control-label">Branch</label>
						<div class="col-sm-3">
						<select id="branch"  name="branch" data-pms-required="true" data-pms-type="alphanumericsOnly" class="form-control pull-right select2" >
						<option value="">----Please Select----</option>
							<?php
								foreach($branch as $branchs){
									$branch_names = isset($records->branch_id_fk)?$records->branch_id_fk:'';
									?>
								<option  value="<?php echo $branchs->branch_id?>"<?php if($branch_names == $branchs->branch_id) echo "selected=selected"?>><?php echo $branchs->branch_name ?></option>
								 <?php
									}
							?>
                      
						</select>
					    </div>
					  <label for="size_name" class="col-sm-1 control-label">Quantity<span style="color:red">*</span></label>

					  <div class="col-sm-2">
						<input type="text" data-pms-required="true"  data-pms-type="digitsOnly" class="form-control" name="item_stock" placeholder="OpenigStock" value="<?php if(isset($records->issued)) echo $records->issued ?>">
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







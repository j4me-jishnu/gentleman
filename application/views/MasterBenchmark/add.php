<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Branch Benchmark
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Branch Benchmark</li>
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
            <form class="form-horizontal" method="POST" action="<?php echo base_url();?>SetMasterBenchmark/add">
              <!-- radio -->
               <div class="form-group">
			   <input type="hidden" name="branch_id" value="<?php if(isset($records->branch_id)) echo $records->branch_id ?>"/>
                <?php echo validation_errors(); ?>
                 <label for="inputEmail3" class="col-sm-2 control-label"></label>
                </div>
				<div class="box-body">
					<div class="form-group">
					  <label for="size_name" class="col-sm-1 control-label">Item<span style="color:red">*</span></label>

					  <div class="col-sm-1">
						<input type="text" data-pms-required="true"  class="form-control" id="item_name" name="item_name" placeholder="ItemName" value="<?php if(isset($item[0]->item_name)) echo $item[0]->item_name ?>" >
						<input type="hidden" id="item_id" name="item_id" value="<?php if(isset($item[0]->item_id_fk)) echo $item[0]->item_id_fk ?>"/>
					  </div>
					  <label for="description" class="col-sm-1 control-label">Branch</label>
						<div class="col-sm-1">
						<select id="branch"  name="branch" data-pms-required="true" data-pms-type="alphanumericsOnly" class="form-control pull-right select2" >
            <option value="0">Masterstock</option>
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
					  <label for="size_name" class="col-sm-1 control-label">Bench mark<span style="color:red">*</span></label>

					  <div class="col-sm-1">
						<input type="text" data-pms-required="true"  class="form-control" name="benchmark" value="<?php if(isset($records->benchmark)) echo $records->benchmark ?>" >

					  </div>
            <label for="size_name" class="col-sm-1 control-label">Initial Date <span style="color:red">*</span></label>

            <div class="col-sm-2">
            <input type="date"  required  class="form-control" name="idate" id="start_date" max="<?php echo date('Y-m-d') ?>" value="<?php if(isset($records->initial_date)) echo $records->initial_date ?>" >
            </div>
            <label for="size_name" class="col-sm-1 control-label">Final Date <span style="color:red">*</span></label>

            <div class="col-sm-2">
            <input type="date"    class="form-control" name="fdate" id="end_date" min="<?php echo date('Y-m-d') ?>"  value="<?php if(isset($records->final_date)) echo $records->final_date ?>" >
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







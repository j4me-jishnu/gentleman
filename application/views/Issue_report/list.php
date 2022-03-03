<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Branch stock report
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Branch stock report</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="box">
			<div class="row">
				<div class="col-md-3">
					<div class="input-group margin">
					<div class="input-group-btn">
						<button type="button" class="btn btn-primary nohover" style="display: none;">Branch Name</button>
					</div><!-- /btn-group -->
					<select name="user_branch" id="user_branch" data-pms-required="true" data-pms-type="alphanumericsOnly" class="form-control pull-right select2" style="display: none;" >
						<option value="">----Please Select----</option>
							<?php
								foreach($branch as $branchs){
									$branch_names = isset($records->user_branch)?$records->user_branch:'';
									?>
								<option  value="<?php echo $branchs->branch_id?>"<?php if($branch_names == $branchs->branch_id) echo "selected=selected"?>><?php echo $branchs->branch_name ?></option>
								 <?php
									}
							?>
                      
					</select>
					</div><!-- /input-group -->
				</div>
                <div class="col-md-4">
				<div class="input-group margin">
					<div class="input-group-btn">
					<button type="button" class="btn btn-primary nohover">Date </button>
					</div><!-- /btn-group -->
					<input id="pmsDateStart" type="date" placeholder="dd/mm/yyyy" class="form-control">
					
						
					<input id="pmsDateEnd" type="date" placeholder="dd/mm/yyyy" class="form-control">
					
				</div>
				</div>	
				<div class="col-sm-1">
					<div class="input-group">
						<button type="button" id="search" class="btn bg-orange btn-flat margin" onclick="<?php if(isset($values->mainhead_id))echo $values->mainhead_id;?>">Search</button>
					</div>
				</div>
            </div>
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <div class="col-md-8"><h2 class="box-title"></h2> </div>
			</div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="issue_table" class="table table-bordered table-striped">
                <thead>
               <tr>
                 <th>Slno</th>
                  <th>Branch Name</th>
                  <th>Item Name</th>
                  <th>Issued to</th>
                  <th>Issued Quantity</th>
                  <th>Issued Date</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div align="center"><b>Total:</b> <span id = "tot"></span></div>
          </div>
          <!-- /.box -->

         
     </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->







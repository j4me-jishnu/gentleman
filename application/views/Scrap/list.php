<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Scrap Details
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      
        <li class="active">Scrap Details</li>
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
						<button type="button" class="btn btn-primary nohover">Item Name</button>
					</div><!-- /btn-group--> 
					<input type="text" name="user_name" placeholder="Name" id="item_name" class="form-control">
					<input type="hidden" id="user_id">
					</div><!-- /input-group -->
				</div>	
				<div class="col-md-4">
					<div class="input-group margin">
					<div class="input-group-btn">
						<button type="button" class="btn btn-primary nohover">Initial Date</button>
					</div><!-- /btn-group -->
					<input type="date" id="idate"  name="user_designation" data-pms-required="true" data-pms-type="alphanumericsOnly" class="form-control pull-right select2" >
					</div><!-- /input-group -->
				</div>
				<div class="col-md-3">
					<div class="input-group margin">
					<div class="input-group-btn">
						<button type="button" class="btn btn-primary nohover">Final Date</button>
					</div><!-- /btn-group -->
					<input type="date" name="user_branch" id="fdate" data-pms-required="true" data-pms-type="alphanumericsOnly" class="form-control pull-right select2" >
					</div><!-- /input-group -->
				</div>
				<div class="col-sm-1">
					<div class="input-group">
						
					</div>
				</div>
            </div>
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <div class="col-md-8"><h2 class="box-title"></h2> </div>
				<div class="col-md-2">
                  
				</div>
				
            </div>
            <input type="hidden" name="a" id="uid">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="scrap_table" class="table table-bordered table-striped">
                <thead>
                <tr>
				 <th>Slno</th>
                  <th>Item Name</th>
                  <th>Quantity</th>
                  <th>Reason</th>
                  <th>Return From</th>
                  <th>Date</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

         
     </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->







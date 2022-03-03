<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Userwise conception report
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Userwise conception report</li>
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
						<button type="button" class="btn btn-primary nohover">Name</button>
					</div><!-- /btn-group -->
					<input type="text" name="user_name" placeholder="Name" id="user_name" class="form-control">
					<input type="hidden" id="product_id">
					</div><!-- /input-group -->
				</div>
                <div class="col-md-4">
				<div class="input-group margin">
					<div class="input-group-btn">
					<button type="button" class="btn btn-primary nohover">Date </button>
					</div><!-- /btn-group -->
					<input id="pmsDateStart" type="text" data-validation-optional="true" data-pms-max-date="today" data-pms-type="date"  name="start_date" data-pms-date-to="pmsDateEnd" class="col-md-5 form-control" placeholder="dd/mm/yyyy" >
					<span tabindex="-1" class="input-group-btn select-calendar date-range"><button type="button" tabindex="-1" class="btn btn-default"><i class=" fa fa-calendar"></i></button></span>
						
					<input id="pmsDateEnd" type="text" data-validation-optional="true" data-pms-type="date"  name="end_date" data-pms-date-from="pmsDateStart" class="col-md-5 form-control" placeholder="dd/mm/yyyy" >
					<span tabindex="-1" class="input-group-btn select-calendar date-range"><button type="button" tabindex="-1" class="btn btn-default"><i class=" fa fa-calendar"></i></button></span>
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
            
            <!-- /.box-body -->
        </div>
          <!-- /.box -->
		<div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url();?>/profile/profile.jpg" alt="User profile picture">

              <h3 class="profile-username text-center" id="name"></h3>

              <p class="text-muted text-center" id="desi"></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Branch</b> <a class="pull-right" id="branch"></a>
				  <input type="hidden" id="user_id" value="01x"/>
                </li>
                <li class="list-group-item">
                  <b>Address</b> <a class="pull-right" id="address"></a>
                </li>
                <li class="list-group-item">
                  <b>Phone</b> <a class="pull-right" id="phone"></a>
                </li>
				<li class="list-group-item">
                  <b>Email</b> <a class="pull-right" id="email"></a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
			
        </div>
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Issued Item</a></li>
              <li><a href="#timeline" data-toggle="tab">Used Item</a></li>
              <li><a href="#return" data-toggle="tab">Returned Item</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Issued Items</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="issue_table" class="table table-bordered table-striped">
					<thead>
					<tr>
					 <th>Slno</th>
					  <th>Item Name</th>
					  <th>Quantity</th>
					  <th>Date</th>
					</tr>
					</thead>
					<tbody>
					</tbody>
					</table>	
				</div>
				</div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <div class="box-body">
                  <table id="used_table" class="table table-bordered table-striped">
					<thead>
					<tr>
					 <th>Slno</th>
					  <th>Item Name</th>
					  <th>Quantity</th>
					  <th>Date</th>
					</tr>
					</thead>
					<tbody>
					</tbody>
					</table>
                </div>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="return">
                <div class="box-body">
                  <table id="return_table" class="table table-bordered table-striped">
					<thead>
					<tr>
					 <th>Slno</th>
					  <th>Item Name</th>
					  <th>Quantity</th>
					  <th>Date</th>
					  <th>Narration</th>
					</tr>
					</thead>
					<tbody>
					</tbody>
					</table>
                </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div> 
     </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->







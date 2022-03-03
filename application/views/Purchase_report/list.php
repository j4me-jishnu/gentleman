<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Purchase report
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Purchase report</li>
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
            
          </div><!-- /btn-group -->
        
          </div><!-- /input-group -->
        </div>
                <div class="col-md-4">
        <div class="input-group margin">
          <div class="input-group-btn">
          </div>
          <input type="date" id="pmsDateStart" class="form-control" name="start_date">
          <input type="date" id="pmsDateEnd" class="form-control" name="end_date">
          <!-- /btn-group -->
          <!-- <input id="pmsDateStart" type="text" data-validation-optional="true" data-pms-max-date="today" data-pms-type="date" name="start_date" data-pms-date-to="pmsDateEnd1" class="col-md-5 form-control" placeholder="dd/mm/yyyy" >
          <span tabindex="-1" class="input-group-btn select-calendar date-range"><button type="button" tabindex="-1" class="btn btn-default"><i class=" fa fa-calendar"></i></button></span>
            
          <input id="pmsDateEnd" type="text" data-validation-optional="true" data-pms-type="date" name="end_date" data-pms-date-from="pmsDateStart1" class="col-md-5 form-control" placeholder="dd/mm/yyyy" >
          <span tabindex="-1" class="input-group-btn select-calendar date-range"><button type="button" tabindex="-1" class="btn btn-default"><i class=" fa fa-calendar"></i></button></span> -->
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
              <table id="purchase_report_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                   <th>SINO</th>
                  <th>INVOICE NO</th>
                  <th>ITEM NAME</th>
                  <th>ITEM QUANTITY</th>
                  <th>TOTAL PRICE</th>
                  <th>VENDOR NAME</th>
                  <th>PURCHASE DATE</th>
                 
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







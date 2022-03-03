
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Benchmark Report
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
       
        <li class="active">Benchmark period</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="box">
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <div class="col-md-8"><h2 class="box-title"></h2> </div>
				        <div class="col-md-3">
          <div class="input-group margin">
          
          </div><!-- /input-group -->
        </div>

        <div class="col-md-3">
          <div class="input-group margin">
          <div class="input-group-btn">
            <button type="button" class="btn btn-primary nohover">Table</button>
          </div><!-- /btn-group -->
          <select name="table" id="table" data-pms-required="true" data-pms-type="alphanumericsOnly" class="form-control pull-right select2" >
            <option value="">----Please Select----</option>
            <option value="1">Branch BenchMark Table</option>
            <option value="2">Master To Branch Transfer Table</option>
            <option value="3">User BenchMark Table</option>
            <option value="4">User Issue table</option>
                      
          </select>
          </div><!-- /input-group -->
        </div>
        <div class="col-md-3">
          <div class="input-group margin">
          <div class="input-group-btn">
            <button type="button" class="btn btn-primary nohover">Branch</button>
          </div><!-- /btn-group -->
          <select name="user_branch" id="branch" data-pms-required="true" data-pms-type="alphanumericsOnly" class="form-control pull-right select2" >
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
        <div class="col-md-3">
          <div class="input-group margin">
          <div class="input-group-btn">
            <button type="button" class="btn btn-primary nohover">Items</button>
          </div><!-- /btn-group -->
          <select name="item" id="item" data-pms-required="true" data-pms-type="alphanumericsOnly" class="form-control pull-right select2" >
            <option value="">----Please Select----</option>
              <?php
                foreach($items as $item){
                 
                  ?>
                <option  value="<?php echo $item->item_id ?>"><?php echo $item->item_name ?></option>
                 <?php
                  }
              ?>
                      
          </select>
        </div>
      </div>
          <div class="col-md-3">
          <div class="input-group margin">
          <div class="input-group-btn">
            <button type="button" class="btn btn-primary nohover">Initial date</button>
          </div><!-- /btn-group -->
         <input type="date"  required  class="form-control" name="idate" id="idate">
        </div>
      </div>
      <div class="col-md-3">
          <div class="input-group margin">
          <div class="input-group-btn">
            <button type="button" class="btn btn-primary nohover">Final Date</button>
          </div><!-- /btn-group -->
         <input type="date"  required  class="form-control" name="fdate" id="fdate">
      
          
          </div><!-- /input-group -->

          <div class="input-group">
            <button type="button" id="search" class="btn bg-orange btn-flat margin" onclick="<?php if(isset($values->mainhead_id))echo $values->mainhead_id;?>">Search</button>
         
        </div>

        </div>
				
			
				
            </div>
            <!-- /.box-header -->
           


            <div class="box-body table-responsive" id="1">
              <center><h3>Branch BenchMark Table</h3></center>
              <table id="branch_benchmark" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Slno</th>
                  <th>Branch name</th>
                  <th>Item name</th>
                  <th>Benchmark</th>
                  <th>Initial date</th>
                  <th>Final date</th>

                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>


             <div class="box-body table-responsive" id="2" style="display:none;">
               <center><h3>Master To Branch Transfer Table</h3></center>
              <table id="stock_move" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Slno</th>
                  <th>Branch name</th>
                  <th>Item name</th>
                  <th>Issue Date</th>
                  <th>Quantity</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>

             <div class="box-body table-responsive" id="3" style="display:none;">
              <center><h3>User BenchMark Table</h3></center>
              <table id="user_benchmark" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Slno</th>
                  <th>Branch name</th>
                  <th>Item name</th>
                  <th>User name</th>
                  <th>Benchmark</th>
                  <th>Initial date</th>
                  <th>Final date</th>

                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>

             <div class="box-body table-responsive" id="4" style="display:none;">
              <center><h3>User Issue table</h3></center>
              <table id="issue_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Slno</th>
                  <th>Branch name</th>
                  <th>Item name</th>
                  <th>Issued to</th>
                  <th>Quantity</th>
                  <th>Issued Date</th>

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







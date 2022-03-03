<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        IssueRoll Form
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">IssueRoll Form</li>
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
            <form class="form-horizontal" method="POST" action="<?php echo base_url();?>issueroll/add">
              <!-- radio -->
               <div class="form-group">
			   <input type="hidden" name="branch_id" value="<?php if(isset($records->branch_id)) echo $records->branch_id ?>"/>
                <?php echo validation_errors(); ?>
                 <label for="inputEmail3" class="col-sm-2 control-label"></label>
                </div>
				<div class="box-body">
					<div class="form-group">
					  <label for="size_name" class="col-sm-1 control-label">Name<span style="color:red">*</span></label>

					  <div class="col-sm-2">
						<input type="text" data-pms-required="true"  class="form-control" name="emp_name" id="emp_name" placeholder="Name" value="<?php if(isset($records->branch_phone)) echo $records->branch_phone ?>">	
						<input type="hidden" data-pms-required="true"  class="form-control" name="userid" id="userid"  value="<?php if(isset($records->userid_fk)) echo $records->userid_fk ?>">
						<input type="hidden" name="itemid" id="itemid" value="<?php if(isset($item[0]->item_id)) echo $item[0]->item_id;?>"/>
					  </div>
					  <label for="size_name" class="col-sm-1 control-label">RollCount<span style="color:red">*</span></label>

					  <div class="col-sm-2">
						<input type="text" data-pms-required="true"  class="form-control" id="quantity" name="quantity" placeholder="Quantity" value="<?php if(isset($records->quantity)) echo $records->quantity ?>">
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
            <br><br>
        <div class="row" id="prvs" style="display:none">
        <div class="col-md-1"></div>    
      <div class="col-md-10">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Previous Issued</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered"  id="previous">
                <tr>
                 <th>Slno</th>
				  <th>Date</th>
                  <th>Quantity</th>
                  <th>Ticket Count</th>
                </tr>
              </table>
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>
          </div>
          <!-- /.box -->
          
        </div>
        <!--/.col (right) -->
     </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->







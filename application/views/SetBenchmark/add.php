<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Benchmark period
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
      
        <li class="active">Benchmark Period</li>
      </ol>
    </section>
	<form class="form-horizontal" method="POST" action="<?php echo base_url();?>SetBenchmark/editAction">
     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
		  <fieldset>
		    <legend>Benchmark Period</legend>
			<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
            
              <!-- radio -->
               <div class="form-group">
			   <input type="hidden" name="id" value="<?php if(isset($records->id)) echo $records->id ?>"/>
                <?php echo validation_errors(); ?>
			    <div class="box-body">
				<div class="form-group">
					  <label for="size_name" class="col-sm-2 control-label">Initial Date <span style="color:red">*</span></label>

					  <div class="col-sm-3">
						<input type="date"  required  class="form-control" name="idate" id="vendorne">
					  </div>
            <label for="size_name" class="col-sm-2 control-label">Final Date <span style="color:red">*</span></label>

            <div class="col-sm-3">
            <input type="date"  required  class="form-control" name="fdate">
            </div>
				</div>
				
                <div class="form-group">
					 
					  <div class="col-sm-5">
						<input type="hidden"  required  class="form-control" name="password" id="bb"  value="<?php if(isset($records->password)) echo $records->password?>">
					  </div>
				</div>
				
              <!-- /.box-body -->
              
            
			</fieldset>
          </div>
          
          <!-- /.box -->
        </div>
		<div class="box-footer">                
                <div class="row">
                  <div class="col-md-6">
                  </div>
                  <div class="col-md-4">
                      <button type="button" class="btn btn-danger" onclick="window.location.reload();">Cancel</button>
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  </div>
	    </div>
        <!-- /.col -->
        </div>
      
    </section>
	
	</form>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->







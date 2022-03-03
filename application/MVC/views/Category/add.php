

 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product Category Form
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>index.php/dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>index.php/category/"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active">Category Form</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">

          <!-- right column -->
        <div class="col-md-8">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/category/add">
              <!-- radio -->
                <div class="form-group">
					<input type="hidden" name="category_id" value="<?php if(isset($records->category_id)) echo $records->category_id ?>"/>
					<?php echo validation_errors(); ?>
					<label for="inputEmail3" class="col-sm-2 control-label"></label>
                </div>
            <div class="box-body">
                <div class="form-group">
                  <label for="size_name" class="col-sm-2 control-label">Category <span style="color:red">*</span></label>

                  <div class="col-sm-3">
                    <input type="text" data-pms-required="true" autofocus class="form-control" name="category_name" placeholder="Name" value="<?php if(isset($records->category_name)) echo $records->category_name ?>">
                  </div>
				  
				  <label for="description" class="col-sm-2 control-label">Description</label>

                  <div class="col-sm-5">
                    <textarea class="form-control" onUnfocus="send()" name="category_description"><?php if(isset($records->category_description)) echo $records->category_description ?></textarea>
                  </div>
                </div>    
            </div>
              <!-- /.box-body -->
              
			  <div class="box-footer">
				<button type="submit" class="btn btn-info">Next</button>
                <button type="reset" class="btn pull-right">Cancel</button>
                
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







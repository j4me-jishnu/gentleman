<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Issue Details
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Issue Details</li>
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
				<div class="col-md-2">
                  <a href="<?php echo base_url();?>issueitem/add" class="btn btn-primary"><i class="fa fa-plus-square"></i>  Issue item</a>
				</div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				 <th>Slno</th>
                  <th>Date</th>
                  <th>Name</th>
                  <th>Item</th>
                  <th>Quantity</th>
                  <th>Edit / Delete</th>
                </tr>
                </thead>
                <tbody>
                <tr>
				  <td>1</td>
                  <td>20/12/2018</td>
                  <td>Jijeev</td>
                  <td>Thaliyola</td>
                  <td>150</td>
                  <td><i class="fa fa-edit iconFontSize-medium" ></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-trash-o iconFontSize-medium" ></i></td>
                </tr>
                <tr>
				  <td>2</td>
                  <td>15/12/2018</td>
                  <td>Rahul</td>
                  <td>Thaliyola</td>
                  <td>200</td>
                  <td><i class="fa fa-edit iconFontSize-medium" ></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-trash-o iconFontSize-medium" ></i></td>
                </tr>
                <tr>
				  <td>3</td>
                  <td>10/12/2018</td>
                  <td>Edwin</td>
                  <td>Thaliyola</td>
                  <td>50</td>
                  <td><i class="fa fa-edit iconFontSize-medium" ></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-trash-o iconFontSize-medium" ></i></td>
                </tr>
                
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








<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Benchmark Details
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        
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
          <?php $u = $this->session->userdata('user_type'); 
          ?>
                  <a href="<?php echo base_url();?>SetMasterBenchmark/add" class="btn btn-primary"><i class="fa fa-plus-square"></i> Add New</a>
         
        </div>
        
            </div>


            <div class="box-body table-responsive">
<h1>Master Benchmark</h1>

<input type="hidden" id="designation" value="<?php echo $this->session->userdata('designation');?>" />
<input type="hidden" value="<?php if(isset($is_head[0]->is_head)) echo $is_head[0]->is_head;?>" id="is_head"/>
  <table id="ropmaster_table" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th>SLNO</th>
      <th>BRANCH NAME</th>
      <th>ITEM NAME</th>
      <th>BENCHMARK</th>
      <th>INITIAL DATE</th>
      <th>FINAL DATE</th>
      <th>EDIT</th>
      
    </tr>
    <?php
    foreach($master['data'] as $row){
      
       echo '<tr>
     
      <td>' . $row->id .'</td>
      <td>Master Stock</td>
      <td>'.$row->item_name.'</td>
      <td>'.$row->benchmark.'</td>
      <td>'.$row->initial_date.'</td>
      <td>'.$row->final_date.'</td>
      <td><a href="'. base_url() .'SetMasterBenchmark/edit/'.$row->id.'"><i class="fa fa-edit iconFontSize-medium" ></i></a></td>
      </tr>';

    }
    
    ?>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
            <h1>Branch Benchmark</h1>

            <input type="hidden" id="designation" value="<?php echo $this->session->userdata('designation');?>" />
			<input type="hidden" value="<?php if(isset($is_head[0]->is_head)) echo $is_head[0]->is_head;?>" id="is_head"/>
              <table id="rop_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SLNO</th>
                  <th>BRANCH NAME</th>
                  <th>ITEM NAME</th>
                  <th>BENCHMARK</th>
                  <th>INITIAL DATE</th>
                  <th>FINAL DATE</th>
                   <th>EDIT</th>
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







<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

        Master Stock

        <!-- <small>Optional description</small> -->

      </h1>

      <ol class="breadcrumb">

        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Master Stock</li>

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

           if($u == 'A'){ ?>

                  <!-- <a href="<?php echo base_url();?>NewMaster/addPurchaseList" class="btn btn-primary"><i class="fa fa-plus-square"></i>  Add Purchase</a> -->

                <?php } ?>
				</div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">

              <table id="designation_table" class="table table-bordered table-striped">
                <thead>
                <tr>
				  <th>Slno</th>
                  <th>Item Name</th>
                  <th>Opening Stock</th>
                  <th>Purchase Stock</th>
                  <th>Total Stock</th>
                  <th>Purchase Return Stock</th>
                  <th>Returns from Branches</th>
                  <th>Branch Given</th>
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














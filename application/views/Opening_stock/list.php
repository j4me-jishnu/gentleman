<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Opening Stock Details

        <!-- <small>Optional description</small> -->

      </h1>

      <ol class="breadcrumb">

        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="<?php echo base_url();?>designation/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>

        <li class="active">Opening Stock</li>

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

                  <a href="<?php echo base_url();?>NewMaster/addPurchaseList" class="btn btn-primary"><i class="fa fa-plus-square"></i>  Add Purchase</a>

                <?php } ?>

				</div>

            </div>

            <!-- /.box-header -->

            <div class="box-body table-responsive">
            <form action="<?php echo base_url() ?>Main/addOS" method="POST">
            <div class="row">
              <div class="col-md-1">
                <label>Select</label>
                </div>
                <div class="col-md-4">
                  <label>Item Name</label>
                </div>
                <div class="col-md-4">
                  <label>Quantity</label>
                </div>
              </div>
              <input type="hidden" name="counter" id="counter" value="0">
              <DIV id="service" class="box-body no-padding" ></div>
            <i class="fa fa-fw fa-plus-square fa-2x" onClick="addMore();" Style="color:green;"></i>
            <i class="fa fa-fw fa-minus-square pull-right fa-2x" onClick="deleteRow();" Style="color:red;"></i>
            <br><br><br><br>
            <input type="submit" value="SUBMIT" class="btn btn-success btn-sm">
            </form>
            </div>

            <!-- /.box-body -->

          </div>

          <!-- /.box -->



         

     </div>



    </section>

    <!-- /.content -->

  </div>

  <!-- /.content-wrapper -->













<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit opening stock
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Edit Opening Stock Details</li>
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
            <h3 class="box-title"></h3>
      <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal" method="POST" action="<?php echo base_url();?>openigstock/">
              <table>
                  <tr>
                      <td> <select name="branch" id="branch" class="form-control">
                          <option value="">Choose branch name</option>
                          <option value="master">Master stock</option>
                          <?php foreach($branches as $branch) { ?>
                          <option value=<?php echo $branch['branch_id']; ?>><?php echo $branch['branch_name']; ?></option>
                          <?php } ?>
                      </select> </td>
                  </tr><break>
                  <tr>
                      <td> <select name="item_name" id="item_name" class="form-control">
                      <option value="">Select item</option>
                      <?php foreach($stock_items as $item) { ?>
                      <option value=<?php echo $item['item_id']; ?>><?php echo $item['item_name']; ?></option>
                      <?php } ?>
                      </select></td>
                  </tr>
                  <tr>
                    <td><h5 class="form-control">Total opening stock count : </h5></td>
                    <td><h4><b><span class="form-control" id="current_stock"></b></span></h4></td>
                  </tr>
              </table>
          </form>
        </div>
        <!-- /.box -->
      </div>
      <!--/.col (right) -->
    </div>

<!-- Table showing the opening details of a particular item -->
          <div class="container box-body table-responsive">
            <table id='opening_stock_table' class="table table-bordered table-striped">
              <thead>
                  <tr>
                    <th>Item name</th>
                    <th>Stock Quantity</th>
                    <th>Updated on</th>
                    <!-- <th></th> -->
                  </tr>
              </thead>
              <tbody>
              </tbody>
            </table>

          </div>
</div>

    </div>


  </section>
  <!-- /.content -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</div>

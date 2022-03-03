<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Update Stock
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"> Update Stock</li>
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
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <div class="table-responsive mailbox-messages">
            <!--<input type="checkbox" class="checkVal">-->
            <button type="button" class="btn btn-warning update">Update</button>
            <table class="table table-hover table-striped">
              <tbody>
                <tr>
                  <th>Select</th>
                  <th>Item Name</td>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Tax</th>
                    <th>Amount</th>
                  </tr>
                  <?php for($i=0;$i<count($items);$i++) { ?>
                    <tr>
                      <?php if($items[$i]->finaldelivery ==1){?>
                        <td><input type="checkbox" class="checkVal" value="<?php echo $items[$i]->pr_id; ?>"></td>
                      <?php } else { ?>
                        <td><span style="color:green"><i class="fa fa-check-square-o" ></i></span></td>
                      <?php } ?>
                      <td><?php echo $items[$i]->item_name; ?></td>
                      <td><?php echo $items[$i]->item_quantity; ?></td>
                      <td><?php echo $items[$i]->item_price; ?></td>
                      <td><?php echo $items[$i]->taxamount; ?></td>
                      <td><?php echo $items[$i]->item_total; ?></td>
                    </tr>

                    <button type="button" name="button" id="item_details" data-id=<?php echo $items[$i]->item_id_fk; ?>  data-quantity="<?php echo $items[$i]->item_quantity; ?>"></button>

                  <?php } if(count($items)<=0) {?>
                    <tr><td>No Items Found</td></tr>
                  <?php }?>
                </tbody>
              </table>
              <!-- /.table -->
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->


      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

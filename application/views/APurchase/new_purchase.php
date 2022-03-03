<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Purchase Form
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Purchase Form</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <!-- <div class="box-header with-border"> -->
            <!-- <h3 class="box-title">Branch Details</h3> -->
            <!-- <div class="container"> -->
            <form class="" action="<?php echo base_url(); ?>Apurchaserequest/add_purchase" method="post">
              <table>
                <tr>
                  <!-- <td> <input type="hidden" name="ref_number" value="GENT"> </td> -->
                  <td> <input type="hidden" name="branch_id_fk" value="0"> </td>
                  <td> <input type="hidden" name="cc" value="0"> </td>
                  <td> <input type="hidden" name="brm" value="1"> </td>
                  <td> <input type="hidden" name="cm" value="1"> </td>
                  <td> <input type="hidden" name="fm" value="1"> </td>
                  <td> <input type="hidden" name="agm" value="2"> </td>
                  <td> <input type="hidden" name="pm" value="0"> </td>
                  <td> <input type="hidden" name="delivery" value="1"> </td>
                  <td> <input type="hidden" name="finaldelivery" value="1"> </td>
                  <td> <input type="hidden" name="reject" value="0"> </td>
                  <td> <input type="hidden" name="remark" value="Null"> </td>
                  <td> <input type="hidden" name="pr_status" value="1"> </td>
                  <td> <input type="hidden" name="amount_paid" value="0"> </td>
                </tr>
                <tr>
                  <td><label for="">Vendor</label></td>
                  <td> <select class="form-control" name="vendor_id" required>
                    <option value="" disabled selected>Select Vendor</option>
                    <?php foreach ($vendor_names as $vendor) { ?>
                      <option value="<?php echo $vendor->vendor_id; ?>"><?php echo $vendor->vendorname; ?></option>
                    <?php } ?>
                  </select> </td>
                </tr>

                <tr>
                  <td><label for="">Date</label></td>
                  <td> <input type="date" class="form-control" name="date" value="" required> </td>
                </tr>
                <tr>
                  <td><label for="">Bill Number</label></td>
                  <td> <input type="text" class="form-control" name="bill_number" value="" placeholder="Bill Number" required> </td>
                </tr>
                <tr>
                  <td><label for="">GST Number</label></td>
                  <td> <input type="text" class="form-control" name="gst_number" value="" placeholder="GST Number" required> </td>
                </tr>
                <tr>
                  <td><label for="">Item</label></td>
                  <td> <select class="form-control" name="item" required>
                    <option value="" disabled selected>Select Item</option>
                    <?php foreach ($item_names as $item) { ?>
                      <option value="<?php echo $item->item_id; ?>"><?php echo $item->item_name; ?></option>
                    <?php } ?>
                  </select> </td>
                </tr>
                <tr>
                  <td><label for="">Quantity</label></td>
                  <td> <input type="text" class="form-control" name="quantity" value="" placeholder="Quantity" required> </td>
                </tr>
                <tr>
                  <td><label for="">Price</label></td>
                  <td> <input type="text" class="form-control" name="price" value="" placeholder="Price" required> </td>
                </tr>
                <tr>
                  <td><label for="">Tax</label></td>
                  <td> <input type="text" class="form-control" name="tax_percent" value="" placeholder="Enter in percentage" required> </td>
                </tr>
                <tr>
                  <td><button type="submit" class="btn btn-success" value="">Add purchase</button></td>
                </tr>
              </form>
              <!-- </div> -->
            <!-- </div>

            <button class="btn btn-info pull-right" id="add">Save</button>
          </div> -->
        </div>
      </div>
    </section>
  </div>

<div class="content-wrapper">

	<section class="content-header">

		<h1>

			Total Stock Details

		</h1>

		<ol class="breadcrumb">

			<li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

			<li><a href="<?php echo base_url();?>Employee/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>

			<li class="active">Total Stock Details</li>

		</ol>

	</section>

	<section class="content">

		<div class="row">

			<div class="box">

				<div class="box-header">

					<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />

					<div class="col-md-8"><h2 class="box-title"></h2> </div>

          <button type="button" onclick="addOpeningStock()" name="button" class="btn btn-success" style="float:right;">Request Item</button>

				</div>

				<div class="box-body table-responsive">

					<table id="Branch_Opening_Stock" class="table table-bordered table-striped">

						<thead>

							<tr>

								

								<th>Item Name</th>

								<th>Opening Stock</th>

								<th>Requested From Master</th>

								<th>Recieved From Branch</th>

								<th>Given To Branch</th>

								<th>Issued</th>

                                <th>Return To Master</th>

                                <th>Total</th>

								<th>Action</th>

							</tr>

						</thead>

						<tbody>

                            <?php

                            foreach($items as $item){ ?>

                            <tr>

                                <td><?php echo $item->item_name ?></td>

                                

                                <?php if(!empty($opening_stock)){ ?>

                                <?php foreach($opening_stock as $ost){ ?>

                                <?php if($ost->os_item_id_fk == $item->item_id){ ?>    

                                    <td><?php echo $ost->os_item_count ?></td>

                                <?php } ?>

                               <?php } ?>

                               <?php } else { ?>

                                <td>0</td>

                               <?php } ?>    

                               

                               <?php if(!empty($recieved_by_master)){ ?>

                               <?php foreach($recieved_by_master as $recievedmaster){ ?> 

                                <?php if($recievedmaster->req_item_id_fk == $item->item_id){ ?>    

                                    <td><?php echo $recievedmaster->total_req_qty ?></td>

                                <?php } ?>

                               <?php } ?> 

                               <?php } else { ?>

                                <td>0</td>

                               <?php } ?> 

                               

                               <?php if(!empty($b2b_recieved)){ ?>

                               <?php foreach($b2b_recieved as $recieved){ ?> 

                                <?php if($recieved->btob_item_id_fk == $item->item_id){ ?>    

                                    <td><?php echo $recieved->total_btb_qty ?></td>

                                <?php }?>

                                  

                               <?php } ?> 

                               <?php } else { ?>

                                <td>0</td>

                               <?php } ?> 

                               

                                <?php if(!empty($b2b_givens)){ ?>

                               <?php foreach($b2b_givens as $givens){ ?> 

                                <?php if($givens->btob_item_id_fk == $item->item_id){ ?>    

                                    <td><?php echo $givens->btb_item_count ?></td>

                                <?php } ?>

                               <?php } ?> 

                               <?php } else { ?>

                                <td>0</td>

                               <?php } ?>     

                               

                               <?php if(!empty($issued_items)){ ?>

                               <?php foreach($issued_items as $issueds){ ?> 

                                <?php if($issueds->issued_item_id_fk == $item->item_id){ ?>    

                                    <td><?php echo $issueds->total_issued_qty ?></td>

                                <?php } ?>  

                               <?php } ?>

                               <?php } else { ?>

                                <td>0</td>

                               <?php } ?>  

                               

                               <?php if(!empty($return_master)){ ?>

                               <?php foreach($return_master as $returnmaster2){ ?> 

                                <?php if(@$returnmaster2->return_item_id_fk == $item->item_id){ ?>    

                                    <td><?php echo $returnmaster2->total_return_qty ?></td>

                                <?php }?>

                               <?php } ?> 

                               <?php } else { ?>

                                 <td>0</td>

                               <?php } ?>



                               <?php if(!empty($total_stock)) { ?>

                               <?php foreach($total_stock as $totals){ ?>

                                <?php if($totals['item_id_fks'] == $item->item_id){ ?>    

                                    <td><?php echo @$totals['item_count']; ?></td>

                                <?php } ?>    

                               <?php } ?>

                               <?php } else { ?>

                                <td>0</td>

                               <?php } ?> 

                            </tr>

                           <?php  } ?>

						</tbody>

					</table>

				</div>

			</div>

		</div>

	</section>

</div>


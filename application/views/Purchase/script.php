<script>
$(function () {
	var edit_qua = $('#edit_qua').val();
	if(edit_qua)
	{
		$('#datatable').show();
		var ref = $('#edit_ref').val();
		var template = $('#template');
		if(ref)
		{
			$.ajax({ 
			  url:"<?php echo base_url()?>Purchaserequest/getProducts",
			  type: 'POST',
			  data: {refno:ref},
			  dataType: 'json',
			  success:
			  function(data)
			  {
				//alert(data[0]['ref_number'])
				var id = 0;
				do {
					var row = template.clone();
					template.find("input:text").val("");
					row.find('.prName').val(data[id]['item_name']);
					row.find('.pr_id').val(data[id]['item_id_fk']);
					row.find('.pName').html(data[id]['item_name']);
					row.find('.qnName').val(data[id]['item_quantity']);
					row.find('.qName').html(data[id]['item_quantity']);
					row.find('.prRate').val(data[id]['item_price']);
					row.find('.pRate').html(data[id]['item_price']);
					row.find('.prtax').val(data[id]['taxamount']);
					row.find('.ptax').html(data[id]['taxamount'])
					row.find('.ntamount').val(data[id]['item_total']);
					row.find('.namount').html(data[id]['item_total']);
					row.attr('id', 'row_' + (++id)); row.attr('class', 'newrow');
					row.find('.remove').show();
					row.find('.edit').show();
					template.after(row);
					
				}
				while (id < edit_qua); 
				
				$(".NetTotalAmount").css('display','block');
				$('#grand_total').html(parseFloat(data[0]['grand_total']).toFixed(2));
				$('#net_total').val(parseFloat(data[0]['grand_total']).toFixed(2));
			  },
			  error:function(e){
			  console.log("error");
			}
			});
		}
	}
	
});
$(document).on("change",'#pquantity',function(){
    var quantity = $(this).val();
    if(quantity)
        {
            var amount = $('#pprice').val();
            var tax = $('#tax').val();
            if(tax !== '' && quantity !=='' && amount !==''){
            amount = parseFloat(quantity) * parseFloat(amount); 
            var amount_divide = parseFloat(amount)/100;
            var percantage = parseFloat(amount_divide) * parseFloat(tax);  
            var Rowtotal = parseFloat(percantage) + parseFloat(amount);
            $('#totalAmount').html(parseFloat(Rowtotal).toFixed(2));
            $('#total_price').val(parseFloat(Rowtotal).toFixed(2));
            }
        }
            
    
});
$(document).on("change",'#pprice',function(){
    var amount = $(this).val();
    if(amount)
        {
            var quantity = $('#pquantity').val();
            var tax = $('#tax').val();
            if(tax !== '' && quantity !=='' && amount !==''){
            amount = parseFloat(quantity) * parseFloat(amount); 
            var amount_divide = parseFloat(amount)/100;
            var percantage = parseFloat(amount_divide) * parseFloat(tax);  
            var Rowtotal = parseFloat(percantage) + parseFloat(amount);
            $('#totalAmount').html(parseFloat(Rowtotal).toFixed(2));
            $('#total_price').val(parseFloat(Rowtotal).toFixed(2));
            }
        }
            
    
});
$(document).on("change",'#tax',function(){
    var tax = $(this).val();
    if(tax)
        {
            var quantity = $('#pquantity').val();
            var amount = $('#pprice').val();
            if(tax !== '' && quantity !=='' && amount !==''){
            amount = parseFloat(quantity) * parseFloat(amount); 
            var amount_divide = parseFloat(amount)/100;
            var percantage = parseFloat(amount_divide) * parseFloat(tax);  
            var Rowtotal = parseFloat(percantage) + parseFloat(amount);
            $('#totalAmount').html(parseFloat(Rowtotal).toFixed(2));
            $('#total_price').val(parseFloat(Rowtotal).toFixed(2));
            }
        }
            
    
});
$(document).ready(function(){
    $("#purchase_table").on('click','.rejectDeatails',function(){
    var currentRow=$(this).closest("tr"); 
    var refno=currentRow.find("td:eq(1)").text(); // get current row 2nd TD
	$.ajax({ 
			  url:"<?php echo base_url()?>purchaserequest/viewnarration",
			  type: 'POST',
			  data: {refno:refno},
			  dataType: 'json',
			  success:
			  function(data)
			  {
				if(data['brm']==1){$('#owner').html('Brm Rejeted');$('#desc').html(data['narration']);}else if(data['cm']==1){$('#owner').html('CM Rejeted');$('#desc').html(data['narration']);}else if(data['fm']==1){$('#owner').html('FM Rejeted');$('#desc').html(data['narration']);}else if(data['agm']==1){$('#owner').html('AGM Rejeted');$('#desc').html(data['narration']);}else if(data['pm']==1){$('#owner').html('PM Rejeted');$('#desc').html(data['narration']);}  
				$('#narration').modal();
			  },
			  error:function(e){
			  console.log("error");
			}
		});
	});
});
// $(document).ready(function(){
    // $("#purchase_table").on('click','.addtostock',function(){
    // var currentRow=$(this).closest("tr"); 
    // var refno=currentRow.find("td:eq(1)").text(); // get current row 2nd TD
	// $.ajax({ 
			  // url:"<?php echo base_url()?>purchaserequest/addtostock",
			  // type: 'POST',
			  // data: {refno:refno},
			  // dataType: 'json',
			  // success:
			  // function(data)
			  // {
				// location.reload();
			  // },
			  // error:function(e){
			  // console.log("error");
			// }
		// });
	// });
// });
function rejectok(){
	var reject_narration = $('#reject_narration').val();
	var brid = $('#brid').val();
	var ref = $('#refno').val();
	var desi = $('#designation').val();
	if(reject_narration!='')
	{
		$.ajax({ 
				  url:"<?php echo base_url()?>purchaserequest/reject",
				  type: 'POST',
				  data: {narration:reject_narration,brid:brid,ref:ref,desi:desi},
				  dataType: 'json',
				  success:
				  function(data)
				  {
					location.reload();
				  },
				  error:function(e){
				  console.log("error");
				}
			 
			});
	}
	
}

$(document).ready(function(){
	$("#purchase_table").on('change','.quotationSt',function(){
	var conf = confirm("Do you want to continue?");
	if(conf){
	 var option = $(this).val(); 	
	 var currentRow=$(this).closest("tr"); 
	 var refno=currentRow.find("td:eq(1)").text(); // get current row 2nd TD
	 $('#refno').val(refno);
	 var designation=$('#designation').val(); 
	 if(option=='pending'){
	 }
	 else if(option=='reject')
	 {
		$('#reject').modal(); 
	 }
	 else{
			$.ajax({ 
				  url:"<?php echo base_url()?>purchaserequest/aprove",
				  type: 'POST',
				  data: {refno:refno,branch_id_fk:option,designation:designation},
				  dataType: 'json',
				  success:
				  function(data)
				  {
					location.reload();
				  },
				  error:function(e){
				  console.log("error");
				}
			 
			});
		}
	}
	else{
		$('.quotationSt').val('pending'); 
	}
	});
});
$(function () {
	var is_head = $('#is_head').val();
	if(is_head == 1){
		$table = $('#purchase_table').DataTable( {
		"searching": false,
		"processing": true,
		"serverSide": true,
		"bDestroy" : true,
		dom: 'lBfrtip',
		buttons: [
			{
				extend: 'copy',
				exportOptions: {
					columns: [ 1, 2, 3, 4 ]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [ 1, 2, 3, 4 ]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [ 1, 2, 3, 4 ]
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [ 1, 2, 3, 4 ]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [ 1, 2, 3, 4 ]
				}
			},
		],
		"ajax": {
			"url": "<?php echo base_url();?>purchaserequest/get_head",
			"type": "POST",
			"data" : function (d) {
			   }
		},
		"createdRow": function ( row, data, index ) {
			$table.column(0).nodes().each(function(node,index,dt){
			$table.cell(node).data(index+1);
			});
			var designation = $('#designation').val();
			if(data['brm']==2 && designation==3){
			$('td',row).eq(5).html('<center><select onchange ="changeStatus('+data['branch_id_fk']+')" class="quotationSt"><option value="pending" style="color:#ff9966">Pending</option><option value='+data['branch_id_fk']+' style="color:green">Approve</option><option value="reject" style="color:#cc3300">Reject</option></select></center>');					
			}
			else if(data['brm']==2 && designation!=3){
			$('td',row).eq(5).html('<center><span style="color:red;">Waiting For Brm Aproval</span></center>');
			}
			if(data['cm']==2 && designation==2){
			$('#refno').val(data['ref_number']);
			$('td',row).eq(5).html('<center><select onchange ="changeStatus('+data['branch_id_fk']+')" class="quotationSt"><option value="pending" style="color:#ff9966">Pending</option><option value='+data['branch_id_fk']+' style="color:green">Approve</option><option value="reject" style="color:#cc3300">Reject</option></select></center>');					
			}
			else if(data['cm']==2 && designation!=2){
			$('td',row).eq(5).html('<center><span style="color:red;">Waiting For CM Aproval</span></center>');
			}
			else if(data['fm']==2 && designation==4)
			{
			$('td',row).eq(5).html('<center><select onchange ="changeStatus('+data['branch_id_fk']+')" class="quotationSt"><option value="pending" style="color:#ff9966">Pending</option><option value='+data['branch_id_fk']+' style="color:green">Approve</option><option value="reject" style="color:#cc3300">Reject</option></select></center>');					
			}
			else if(data['fm']==2 && designation!=4){
			$('td',row).eq(5).html('<center><span style="color:red;">Waiting For FM Aproval</span></center>');
			}
			else if(data['agm']==2 && designation==1)
			{
			$('td',row).eq(5).html('<center><select onchange ="changeStatus('+data['branch_id_fk']+')" class="quotationSt"><option value="pending" style="color:#ff9966">Pending</option><option value='+data['branch_id_fk']+' style="color:green">Approve</option><option value="reject" style="color:#cc3300">Reject</option></select></center>');					
			}
			else if(data['agm']==2 && designation!=1){ 
			$('td',row).eq(5).html('<center><span style="color:red;">Waiting For AGM Aproval</span></center>');
			}
			else if(data['pm']==2 && designation==5)
			{
			$('td',row).eq(5).html('<center><select onchange ="changeStatus('+data['branch_id_fk']+')" class="quotationSt"><option value="pending" style="color:#ff9966">Pending</option><option value='+data['branch_id_fk']+' style="color:green">Issue</option><option value="reject" style="color:#cc3300">Reject</option></select></center>');					
			}
			else if(data['pm']==2 && designation!=5){
			$('td',row).eq(5).html('<center><span style="color:red;">Waiting For PM Aproval</span></center>');
			}
			else if(data['brm']==0 && data['cm']==0 && data['fm']==0 && data['agm']==0 && data['pm']==0 && data['delivery']==1 && designation!=6){
			$('td',row).eq(5).html('<center><span>Purchase Order created</span><a href="<?php echo base_url();?>/Orders/'+data['order_file']+'" width="10px" target="_blank"><center>view</center></a></center>');
			}
			else if(data['brm']==0 && data['cm']==0 && data['fm']==0 && data['agm']==0 && data['pm']==0 && data['delivery']==1 && designation==6){
			$('td',row).eq(5).html('<center><span>Purchase Order created</span><a href="<?php echo base_url();?>/Orders/'+data['order_file']+'" width="10px" target="_blank"><center>view</center></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>/Orders/'+data['order_file']+'" width="10px" target="_blank"><center>view</center></a></center>');
			}
			else if(data['brm']==0 && data['cm']==0 && data['fm']==0 && data['agm']==0 && data['pm']==0 && data['delivery']==0){
			$('td',row).eq(5).html('<center><span style="color:green">Delivered</span></center>');
			}
			else if(data['brm']==4 && data['cm']==3 && data['fm']==3 && data['agm']==3 && data['pm']==3 && data['delivery']==3 && data['reject']==1){
			$('td',row).eq(5).html('<center><span style="color:black;">Brm Rejected&nbsp;&nbsp;&nbsp;<a class="rejectDeatails" >View Details</a></span></center>');
			}
			else if(data['brm']==3 && data['cm']==4 && data['fm']==3 && data['agm']==3 && data['pm']==3 && data['delivery']==3 && data['reject']==1){
			$('td',row).eq(5).html('<center><span style="color:black;">CM Rejected&nbsp;&nbsp;&nbsp;<a class="rejectDeatails" >View Details</a></span></center>');
			}
			else if(data['brm']==3 && data['cm']==3 && data['fm']==4 && data['agm']==3 && data['pm']==3 && data['delivery']==3 && data['reject']==1){
			$('td',row).eq(5).html('<center><span style="color:black;">FM Rejected&nbsp;&nbsp;&nbsp;<a class="rejectDeatails" >View Details</a></span></center>');
			}
			else if(data['brm']==3 && data['cm']==3 && data['fm']==3 && data['agm']==4 && data['pm']==3 && data['delivery']==3 && data['reject']==1){
			$('td',row).eq(5).html('<center><span style="color:black;">AGM Rejected&nbsp;&nbsp;&nbsp;<a class="rejectDeatails" >View Details</a></span></center>');
			}
			else if(data['brm']==3 && data['cm']==3 && data['fm']==3 && data['agm']==3 && data['pm']==4 && data['delivery']==3 && data['reject']==1){
			$('td',row).eq(5).html('<center><span style="color:black;">PM Rejected&nbsp;&nbsp;&nbsp;<a class="rejectDeatails" >View Details</a></span></center>');
			}
			$('td', row).eq(6).html('<center><a target="_blank" href="<?php echo base_url();?>Purchaserequest/view/'+data['ref_number']+'/'+data['branch_id_fk']+'"><i class="fa fa-eye" ></i></a></center>');
		},

		"columns": [
			{ "data": "pr_status", "orderable": false },
			{ "data": "ref_number", "orderable": false },
			{ "data": "item_date", "orderable": false },
			{ "data": "purchase_count", "orderable": false },
			{ "data": "remark", "orderable": false },
			{ "data": "pr_id", "orderable": false },
			{ "data": "pr_id", "orderable": false },
		 ]
		
		} );
		
	}
	else{
		$table = $('#purchase_table').DataTable( {
		"searching": false,
		"processing": true,
		"serverSide": true,
		"bDestroy" : true,
		dom: 'lBfrtip',
		buttons: [
			{
				extend: 'copy',
				exportOptions: {
					columns: [ 1, 2, 3, 4 ]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [ 1, 2, 3, 4 ]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [ 1, 2, 3, 4 ]
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [ 1, 2, 3, 4 ]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [ 1, 2, 3, 4 ]
				}
			},
		],
		"ajax": {
			"url": "<?php echo base_url();?>purchaserequest/get",
			"type": "POST",
			"data" : function (d) {
			   }
		},
        "createdRow": function ( row, data, index ) {
            $table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
			var designation = $('#designation').val();
			if(data['brm']==2 && designation==3){
			$('td',row).eq(5).html('<center><select onchange ="changeStatus('+data['branch_id_fk']+')" class="quotationSt"><option value="pending" style="color:#ff9966">Pending</option><option value='+data['branch_id_fk']+' style="color:green">Approve</option><option value="reject" style="color:#cc3300">Reject</option></select></center>');					
			}
			else if(data['brm']==2 && designation!=3){
			$('td',row).eq(5).html('<center><span style="color:red;">Waiting For Brm Aproval</span></center>');
			}
			if(data['cm']==2 && designation==2){
			$('#refno').val(data['ref_number']);
			$('td',row).eq(5).html('<center><select onchange ="changeStatus('+data['branch_id_fk']+')" class="quotationSt"><option value="pending" style="color:#ff9966">Pending</option><option value='+data['branch_id_fk']+' style="color:green">Approve</option><option value="reject" style="color:#cc3300">Reject</option></select></center>');					
			}
			else if(data['cm']==2 && designation!=2){
			$('td',row).eq(5).html('<center><span style="color:red;">Waiting For CM Aproval</span></center>');
			}
			else if(data['fm']==2 && designation==4)
			{
			$('td',row).eq(5).html('<center><select onchange ="changeStatus('+data['branch_id_fk']+')" class="quotationSt"><option value="pending" style="color:#ff9966">Pending</option><option value='+data['branch_id_fk']+' style="color:green">Approve</option><option value="reject" style="color:#cc3300">Reject</option></select></center>');					
			}
			else if(data['fm']==2 && designation!=4){
			$('td',row).eq(5).html('<center><span style="color:red;">Waiting For FM Aproval</span></center>');
			}
			else if(data['agm']==2 && designation==1)
			{
			$('td',row).eq(5).html('<center><select onchange ="changeStatus('+data['branch_id_fk']+')" class="quotationSt"><option value="pending" style="color:#ff9966">Pending</option><option value='+data['branch_id_fk']+' style="color:green">Approve</option><option value="reject" style="color:#cc3300">Reject</option></select></center>');					
			}
			else if(data['agm']==2 && designation!=1){ 
			$('td',row).eq(5).html('<center><span style="color:red;">Waiting For AGM Aproval</span></center>');
			}
			else if(data['pm']==2 && designation==5)
			{
			$('td',row).eq(5).html('<center><select onchange ="changeStatus('+data['branch_id_fk']+')" class="quotationSt"><option value="pending" style="color:#ff9966">Pending</option><option value='+data['branch_id_fk']+' style="color:green">Approve</option><option value="reject" style="color:#cc3300">Reject</option></select></center>');					
			}
			else if(data['pm']==2 && designation!=5){
			$('td',row).eq(5).html('<center><span style="color:red;">Waiting For PM Aproval</span></center>');
			}
			else if(data['brm']==0 && data['cm']==0 && data['fm']==0 && data['agm']==0 && data['pm']==0 && data['delivery']==1 && designation!=6){
			$('td',row).eq(5).html('<center><span>Purchase Order created</span><a href="<?php echo base_url();?>/Orders/'+data['order_file']+'" width="10px" target="_blank"><center>view</center></a></center>');
			}
			else if(data['brm']==0 && data['cm']==0 && data['fm']==0 && data['agm']==0 && data['pm']==0 && data['delivery']==1 && designation==6){
			$('td',row).eq(5).html('<center><span>Purchase Order created</span><a href="<?php echo base_url();?>/Orders/'+data['order_file']+'" width="10px" target="_blank"><center>view</center></a><a href="<?php echo base_url();?>/stock/addtoStock/'+data['ref_number']+'"><center>Add to stock</center></a></center>');
			}
			else if(data['brm']==0 && data['cm']==0 && data['fm']==0 && data['agm']==0 && data['pm']==0 && data['delivery']==0 &&data['finaldelivery']==1){
			$('td',row).eq(5).html('<center style="color:red;">Waiting Remainig Items <a href="<?php echo base_url();?>/stock/addtoStock/'+data['ref_number']+'"><center>Add to stock</center></a></center>');
			}
			else if(data['brm']==0 && data['cm']==0 && data['fm']==0 && data['agm']==0 && data['pm']==0 && data['delivery']==0 &&data['finaldelivery']==0){
			$('td',row).eq(5).html('<center style="color:green;">Delivered <a href="<?php echo base_url();?>/stock/addtoStock/'+data['ref_number']+'"><center>Add to stock</center></a></center>');
			}
			else if(data['brm']==4 && data['cm']==3 && data['fm']==3 && data['agm']==3 && data['pm']==3 && data['delivery']==3 && data['reject']==1){
			$('td',row).eq(5).html('<center><span style="color:black;">Brm Rejected&nbsp;&nbsp;&nbsp;<a class="rejectDeatails" >View Details</a></span></center>');
			}
			else if(data['brm']==3 && data['cm']==4 && data['fm']==3 && data['agm']==3 && data['pm']==3 && data['delivery']==3 && data['reject']==1){
			$('td',row).eq(5).html('<center><span style="color:black;">CM Rejected&nbsp;&nbsp;&nbsp;<a class="rejectDeatails">View Details</a></span></center>');
			}
			else if(data['brm']==3 && data['cm']==3 && data['fm']==4 && data['agm']==3 && data['pm']==3 && data['delivery']==3 && data['reject']==1){
			$('td',row).eq(5).html('<center><span style="color:black;">FM Rejected&nbsp;&nbsp;&nbsp;<a class="rejectDeatails" >View Details</a></span></center>');
			}
			else if(data['brm']==3 && data['cm']==3 && data['fm']==3 && data['agm']==4 && data['pm']==3 && data['delivery']==3 && data['reject']==1){
			$('td',row).eq(5).html('<center><span style="color:black;">AGM Rejected&nbsp;&nbsp;&nbsp;<a class="rejectDeatails" >View Details</a></span></center>');
			}
			else if(data['brm']==3 && data['cm']==3 && data['fm']==3 && data['agm']==3 && data['pm']==4 && data['delivery']==3 && data['reject']==1){
			$('td',row).eq(5).html('<center><span style="color:black;">PM Rejected&nbsp;&nbsp;&nbsp;<a class="rejectDeatails" >View Details</a></span></center>');
			}
			if(data['brm']==2 && designation==3){
			$('td', row).eq(6).html('<center><a target="_blank" href="<?php echo base_url();?>Purchaserequest/view/'+data['ref_number']+'/'+data['branch_id_fk']+'"><i class="fa fa-eye" ></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>Purchaserequest/edit/'+data['ref_number']+'/'+data['branch_id_fk']+'"><i class="fa fa-edit" ></i></a></center>');
			}
			else{
			$('td', row).eq(6).html('<center><a target="_blank" href="<?php echo base_url();?>Purchaserequest/view/'+data['ref_number']+'/'+data['branch_id_fk']+'"><i class="fa fa-eye" ></i></a></center>');
			}
			
        },

        "columns": [
            { "data": "pr_status", "orderable": false },
            { "data": "ref_number", "orderable": false },
            { "data": "item_date", "orderable": false },
            { "data": "purchase_count", "orderable": false },
            { "data": "remark", "orderable": false },
            { "data": "pr_id", "orderable": false },
			{ "data": "pr_id", "orderable": false }
         ]
        
    } );
		
	}
});
  function changeStatus(branch_id_fk){
	$('#brid').val(branch_id_fk);
	}


  var param = '';
  var $itemList=[ {'columnName':'item_name','label':'Item'}];
  $('#item_name').rcm_autoComplete('<?php echo base_url();?>common/getItemList',$itemList,param,getItemName);
  function getItemName(el,event,item)
   {
       console.log(el);
       console.log(el.next());
       if(item.item_id)
	    {
            el.val(item.item_name);
			$("#item_id").val(item.item_id);
			$("#pprice").val(item.item_price);
			$("#tax").val(item.item_tax);
        }
    }
  $(document).on("change",".update",function(){
	if($(this).val()==1)
	{
		$('#addcolour').modal();
	}
  });
  function colourmodalclose()
	{
    $('#addcolour').modal('hide');
    }
 $(document).keypress(function(event){
	
	var keycode = (event.keyCode ? event.keyCode : event.which);
	if(keycode == '43'){
		
		var quantity = $('#pquantity').val();
		if(quantity)
			{
				var amount = $('#pprice').val();
				var tax = $('#tax').val();
				if(tax !== '' && quantity !=='' && amount !==''){
				amount = parseFloat(quantity) * parseFloat(amount); 
				var amount_divide = parseFloat(amount)/100;
				var percantage = parseFloat(amount_divide) * parseFloat(tax);  
				var Rowtotal = parseFloat(percantage) + parseFloat(amount);
				$('#totalAmount').html(parseFloat(Rowtotal).toFixed(2));
				$('#total_price').val(parseFloat(Rowtotal).toFixed(2));
				}
			}
		var template = $('#template'),
		id = 0;
		if($('#item_name').val()!=='')
		{
		$('#datatable').show();
		var row = template.clone();
		template.find("input:text").val("");
		row.attr('id', 'row_' + (++id)); row.attr('class', 'newrow');
		row.find('.prName').val($('#item_name').val());
		row.find('.pr_id').val($('#item_id').val());
		row.find('.pName').html($('#item_name').val());$('#item_name').val('');
		row.find('.qnName').val($('#pquantity').val());
		row.find('.qName').html($('#pquantity').val());$('#pquantity').val('');
		row.find('.prRate').val($('#pprice').val());
		row.find('.pRate').html($('#pprice').val());$('#pprice').val('');
		row.find('.prtax').val($('#tax').val());
		row.find('.ptax').html($('#tax').val());$('#tax').val('');
		row.find('.ntamount').val($('#total_price').val());
		row.find('.namount').html($('#total_price').val());$('#total_price').val('');
		row.find('.remove').show();$('#totalAmount').html('');
		row.find('.edit').show();
		template.after(row);
		var netTotal = 0;
		$( ".ntamount" ).each(function( index ) {
		var ntamount = $( this ).val(); if(ntamount == ''){ntamount = 0;}
		netTotal = netTotal + parseFloat(ntamount);
		});
		$(".NetTotalAmount").css('display','block');
		$('#grand_total').html(parseFloat(netTotal).toFixed(2));
		$('#net_total').val(parseFloat(netTotal).toFixed(2));
		}
    }
}); 
$(document).ready(function() {
	$('.form-fields').on('click', '.remove', function(){
		$(this).closest('tr').remove();
    });
	$('.form-fields').on('click', '.edit', function(){
        $('#item_name').val($(this).closest('tr').find('.prName').val());
		$('#item_id').val($(this).closest('tr').find('.pr_id').val());
		$('#pquantity').val($(this).closest('tr').find('.qnName').val());
		$('#pprice').val($(this).closest('tr').find('.prRate').val());
		$('#tax').val($(this).closest('tr').find('.prtax').val());
		$('#total_price').val($(this).closest('tr').find('.ntamount').val());
		$('#totalAmount').html($(this).closest('tr').find('.ntamount').val());
		var netTotal = $('#net_total').val();
		var rwTotal = $(this).closest('tr').find('.ntamount').val();
		var diff = parseFloat(netTotal) - parseFloat(rwTotal);
		$('#grand_total').html(parseFloat(diff).toFixed(2));
		$('#net_total').val((diff).toFixed(2));
		$(this).closest('tr').remove();
    });
});

	$("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
	//Date picker
    $('#date').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy'
    });
var response = $("#response").val();
  if(response){
      console.log(response,'response');
      var options = $.parseJSON(response);
      noty(options);
      }
	  
</script>
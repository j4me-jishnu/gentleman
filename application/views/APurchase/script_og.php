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
			  url:"<?php echo base_url()?>Apurchaserequest/getProducts",
			  type: 'POST',
			  data: {refno:ref},
			  dataType: 'json',
			  success:
			  function(data){
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
	var item = $('#item_name').val();
	$.ajax({
			  url:"<?php echo base_url()?>Apurchaserequest/getPrice",
			  type: 'POST',
			  data: {quantity:quantity ,item:item},
			  dataType: 'json',
			  success:
			  function(data)
			  {

				$('#pprice').val(data);
				$('#totalAmount').html(data);

			  }

			});


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
            amount = parseFloat(amount);
            var amount_divide = parseFloat(amount)/100;
            var percantage = parseFloat(amount_divide) * parseFloat(tax);
            var Rowtotal = parseFloat(percantage) + parseFloat(amount);
            $('#totalAmount').html(parseFloat(amount).toFixed(2));
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
            amount = parseFloat(amount);
            var amount_divide = parseFloat(amount)/100;
            var percantage = parseFloat(amount_divide) * parseFloat(tax);
            var Rowtotal = parseFloat(percantage) + parseFloat(amount);
            $('#totalAmount').html(parseFloat(amount).toFixed(2));
            $('#total_price').val(parseFloat(Rowtotal).toFixed(2));
            }
        }


});
$(document).ready(function(){
    $("#purchase_table").on('click','.rejectDeatails',function(){
    var currentRow=$(this).closest("tr");
    var refno=currentRow.find("td:eq(1)").text(); // get current row 2nd TD
	$.ajax({
			  url:"<?php echo base_url()?>Apurchaserequest/viewnarration",
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

function rejectok(){
	var reject_narration = $('#reject_narration').val();
	var prid = $('#prid').val();
	var ref = $('#refno').val();
	var desi = $('#designation').val();
	if(reject_narration!='')
	{
		$.ajax({
				  url:"<?php echo base_url()?>Apurchaserequest/reject",
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

		if($('#status').val()=='reject'){
			var currentRow=$(this).closest("tr");
			var refno=currentRow.find("td:eq(1)").text();
          $('#purchase_id').val($('#prid').val());
		  $('#reference').val(refno);
			$('#myModal').show();

}

else{

	var pr_id = $('#prid').val();
	var conf = confirm("Do you want to continue?");
		if(conf){
			var option = $(this).val();
			var currentRow=$(this).closest("tr");
			var refno=currentRow.find("td:eq(1)").text(); // get current row 2nd TD
			$('#refno').val(refno);
			var designation=$('#designation').val();
			if(option == 'pending'){
			}
			else if(option == 'reject')
			{

				$.ajax({
					    url:"<?php echo base_url()?>Apurchaserequest/reject",
						type: 'POST',
						data:{pr_id:pr_id,refno:refno},
						dataType: 'json',
						success:
						function(data)
						{
							location.reload();
						},
						error:function(e){
						  	location.reload();
						    console.log("error");
						}

					});
			}
			else
			{
				$.ajax({
					    url:"<?php echo base_url()?>Apurchaserequest/aprove",
						type: 'POST',
						data: {refno:refno,branch_id_fk:option,designation:designation,pr_id:pr_id},
						dataType: 'json',
						success:
						function(data)
						{
							location.reload();
						},
						error:function(e){
						  	location.reload();
						    //console.log("error",e);

						}

					});
			}
		}
		else{
			$('.quotationSt').val('pending');
		}


}
	});
});
$(function () {

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
			"url": "<?php echo base_url();?>Apurchaserequest/get_head",
			"type": "POST",
			"data" : function (d) {
			   }
		},
		"createdRow": function ( row, data, index ) {
			$table.column(0).nodes().each(function(node,index,dt){
			$table.cell(node).data(index+1);
			});
			var designation = $('#designation').val();

			if(data['delivery']==0 && data['finaldelivery']==0){
			 $('td', row).eq(6).html('<center> <a onclick=" checkdy('+data['pr_id']+')">&nbsp;&nbsp;Delivered&nbsp;&nbsp;&nbsp;</a><div id="dy"></center>');



			}
			else if(data['newreject'] == 1){
			$('td',row).eq(6).html('<center><span style="color:black;"><a onclick="checkop('+data['pr_id']+')">&nbsp;&nbsp;Rejected&nbsp;&nbsp;&nbsp;</a><div id="op"></div>');
			}

			else if(data['approved'] == 1){

				//delivery_finaldelivery(data['pr_id']);
			$('td',row).eq(6).html('<center><span>Purchase Order created</span><a href="<?php echo base_url();?>/Orders/'+data['order_file']+'" width="10px" target="_blank"><center>view</center></a><a href="<?php echo base_url();?>/stock/addtoStock/'+data['ref_number']+'"><center>Add to stock</center></a></center>');
			}

			else if(data['is_pending']==0 && data['is_reject']==0)
			{
			$('td',row).eq(6).html('<center><select onchange ="changeStatus('+data['pr_id']+')" class="quotationSt" id="status"><option value="pending" style="color:#ff9966">Pending</option><option value='+data['pr_id']+' style="color:green">Approve</option><option value="reject" style="color:#cc3300">Reject</option></select></center>');
			}

			else if(data['delivery']==0 && data['finaldelivery']==0){
			$('td',row).eq(6).html('<center><span style="color:green">Delivered</span></center>');
			}

			else{
			$('td',row).eq(6).html('<center><a onclick="checkap('+data['pr_id']+')"><span style="color:red">&nbsp;&nbsp;&nbsp;Waiting for aproval&nbsp;&nbsp;</a><div id="ap"></div>');
			}
			if(data['approved'] !=1 && data['newreject'] !=1){
			$('td', row).eq(7).html('<center><a href="<?php echo base_url();?>Apurchaserequest/edit/'+data['ref_number']+'/'+data['branch_id_fk']+'"><i class="fa fa-edit" ></i></a>&nbsp;&nbsp;<a target="_blank" href="<?php echo base_url();?>Apurchaserequest/view/'+data['ref_number']+'/'+data['branch_id_fk']+'"><i class="fa fa-eye" ></i></a></center>');
			}

			else{
			$('td', row).eq(7).html('<center><a target="_blank" href="<?php echo base_url();?>Apurchaserequest/view/'+data['ref_number']+'/'+data['branch_id_fk']+'"><i class="fa fa-eye" ></i></a></center>');
		}

		},

		"columns": [
			{ "data": "pr_status", "orderable": false },
			{ "data": "invoice_no", "orderable": false },
			{ "data": "ref_number", "orderable": false },
			{ "data": "vendorname", "orderable": false },
			{ "data": "item_date", "orderable": false },
			{ "data": "purchase_count", "orderable": false },
			{ "data": "pr_id", "orderable": false },
			{ "data": "pr_id", "orderable": false },

		 ]

		} );



});

function changeStatus(pr_id){


	$('#prid').val(pr_id);
}


function delivery_finaldelivery(pr_id){
	$.ajax({
            url:"<?php echo base_url();?>Apurchaserequest/updateDelivery",
			type: 'POST',
			data:{pr_id:pr_id},
			dataType: 'json',
			success:
			function(data)
			{
				//location.reload();
			},
			error:function(e){
			  	//location.reload();
			    //console.log("error");
			}
	});
}

$("form").submit(function(e){
	var rows = $('table#item_table tr:last').index()-1;
		if(rows == 0)
		{
			e.preventDefault(e);
			var options1 = {
			'title': 'Error',
			'style': 'error',
			'message': 'Please Enter Item....!',
			'icon': 'warning',
			};
			var n1 = new notify(options1);

			n1.show();
			setTimeout(function(){
			n1.hide();
		   }, 3000);
		}
    });
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
 $('#add').click(function(){


		var quantity = $('#pquantity').val();
		if(quantity)
			{
				var amount = $('#pprice').val();
				var tax = $('#tax').val();
				if(tax !== '' && quantity !=='' && amount !==''){
				var amount_divide = parseFloat(amount)/100;
				var percantage = parseFloat(amount_divide) * parseFloat(tax);
				var Rowtotal = parseFloat(amount);
				$('#totalAmount').html(parseFloat(amount).toFixed(2));
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

});

$(document).on("change",'#vendor_id_fk',function(){
		var id = $(this).val();

		if(id){
			$.ajax({
            url:"<?php echo base_url();?>Apurchaserequest/get_gst",
			type: 'POST',
			data:{vid:id},
			dataType: 'json',
			success:function(data){
				$('#vendorgst').val(data[0]['vendorgst']);
            }
			});
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



function checkop(pr_id){

var pr = pr_id;
//alert(pr);
$.ajax({
url:"<?php echo base_url();?>Apurchaserequest/get_operator_rejected",
type: 'POST',
data:{pr_id:pr_id},
dataType: 'json',
success:function(data){
console.log(data);

alert(data)



$('#op').html();

}


});



}

function checkap(pr_id){

var pr = pr_id;
alert(pr);
$.ajax({
url:"<?php echo base_url();?>Apurchaserequest/get_operator",
type: 'POST',
data:{pr_id:pr_id},
dataType: 'json',
success:function(data){
console.log(data);

alert('pending from '+data)
$('#op').html();

}


});



}










function checkdy(pr_id){

var pr = pr_id;
//alert(pr);
if(pr){
	$.ajax({
            url:"<?php echo base_url();?>Apurchaserequest/get_operator",
            data:{pr_id:pr_id},
            method:"POST",
            datatype:"json",
            success:function(data){
                alert('deliverd by'+data);
				//$('#dy').html('rejected by'+data);
            }
        });





}

}



$(document).on("change",'#vendor_name',function(){
	var vendor = $(this).val();
	$.ajax({
			  url:"<?php echo base_url()?>Apurchaserequest/getgst",
			  type: 'POST',
			  data: {vendor:vendor},
			  dataType: 'json',
			  success:
			  function(data)
			  {

				$('#vendorgst').val(data);

			  }

			});




});


</script>

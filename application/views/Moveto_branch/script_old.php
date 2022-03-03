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
    $("#issue_table").on('click','.rejectDeatails',function(){
    var currentRow=$(this).closest("tr"); 
    var id=currentRow.find("td:eq(1)").text(); // get current row 2nd TD
	$.ajax({ 
			  url:"<?php echo base_url()?>Moveto_branch/viewnarration",
			  type: 'POST',
			  data: {id:id},
			  dataType: 'json',
			  success:
			  function(data)
			  {
				if(data['com']==1){$('#owner').html('Com Rejeted');$('#desc').html(data['narration']);}else if(data['agm']==1){$('#owner').html('AGM Rejeted');$('#desc').html(data['narration']);} 
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
	var brid = $('#brid').val();
	var ref = $('#refno').val();
	var desi = $('#designation').val();
	console.log('designation',desi);
	if(reject_narration!='')
	{
		$.ajax({ 
				  url:"<?php echo base_url()?>Moveto_branch/reject",
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
	$("#issue_table").on('change','.quotationSt',function(){
	var conf = confirm("Do you want to continue?");
	if(conf){
	 var option = $(this).val(); 	
	 var issue_id = $('#issue_id').val();
	 if(option=='pending'){
	 }
	 else if(option=='reject')
	 {
		$.ajax({ 
				  url:"<?php echo base_url()?>Moveto_branch/reject",
				  type: 'POST',
				  data: {issue_id:issue_id},
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
	 else{
	 	alert(issue_id);
			// $.ajax({ 
			// 	  url:"<?php echo base_url()?>Moveto_branch/aprove",
			// 	  type: 'POST',
			// 	  data: {issue_id:issue_id},
			// 	  dataType: 'json',
			// 	  success:
			// 	  function(data)
			// 	  {
			// 		location.reload();
			// 	  },
			// 	  error:function(e){
			// 	  	//location.reload();
			// 	  console.log("error");
			// 	}
			 
			// });
		}
	}
	// else{
	// 	$('.quotationSt').val('pending'); 
	// }
	});
});
$(function () {
	
		$table = $('#issue_table').DataTable( {
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
			"url": "<?php echo base_url();?>Moveto_branch/get_head",
			"type": "POST",
			"data" : function (d) {
			   }
		},
		"createdRow": function ( row, data, index ) {
			$table.column(0).nodes().each(function(node,index,dt){
			$table.cell(node).data(index+1);
			});
			var designation = $('#designation').val();

			if(data['delivery']== 1){
			$('td',row).eq(4).html('<center><span style="color:green"><a onclick="checkissue('+data['issue_id']+')">&nbsp;&nbsp;Issued&nbsp;&nbsp;&nbsp;</a><div id="is'+data['issue_id']+'"></div>');
			}
			else if(data['newreject'] == 1){
				$('td',row).eq(4).html('<center><span style="color:black;"><a onclick="checkop('+data['issue_id']+')">&nbsp;&nbsp;Rejected&nbsp;&nbsp;&nbsp;</a><div id="op'+data['issue_id']+'"></div>');
			}

			else if(data['approved'] == 1){

				//delivery_finaldelivery(data['pr_id']);
			$('td',row).eq(4).html('<center><a href="<?php echo base_url();?>/Moveto_branch/addtoBranch/'+data['issue_id']+'"><center>Issue to branch</center></a></center><br><center><a onclick="return confirmDelete('+data['issue_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
			}
			else if(data['is_pending']==0 && data['is_reject']==0)
			{
			$('td',row).eq(4).html('<center><select onchange ="changeStatus('+data['issue_id']+')" class="quotationSt"><option value="pending" style="color:#ff9966">Pending</option><option value='+data['issue_id']+' style="color:green">Approve</option><option value="reject" style="color:#cc3300">Reject</option></select></center>');					
			}
			else{
			$('td',row).eq(4).html('<center><a onclick="checkap('+data['issue_id']+')">&nbsp;&nbsp;&nbsp;Waiting for aproval&nbsp;&nbsp;</a><div id="ap'+data['issue_id']+'"></div>');
			}
		





			// if(data['com']==2 && designation==2)
			// {
			// $('td',row).eq(5).html('<center><select onchange ="changeStatus('+data['branch_id_fk']+')" class="quotationSt"><option value="pending" style="color:#ff9966">Pending</option><option value='+data['branch_id_fk']+' style="color:green">Approve</option><option value="reject" style="color:#cc3300">Reject</option></select></center>');					
			// }
			// else if(data['com']==2 && designation!=2){ 
			// $('td',row).eq(5).html('<center><span style="color:red;">Waiting For COM Aproval</span></center>');
			// }

			// else if(data['agm']==2 && designation==1)
			// {
			// $('td',row).eq(5).html('<center><select onchange ="changeStatus('+data['branch_id_fk']+')" class="quotationSt"><option value="pending" style="color:#ff9966">Pending</option><option value='+data['branch_id_fk']+' style="color:green">Approve</option><option value="reject" style="color:#cc3300">Reject</option></select></center>');					
			// }
			// else if(data['agm']==2 && designation!=1){
			// $('td',row).eq(5).html('<center><span style="color:red;">Waiting For AGM Aproval</span></center>');
			// }
			// else if(data['com']==0 && data['agm']==0 && data['delivery']!=0){
			// $('td',row).eq(5).html('<center><a href="<?php echo base_url();?>/Moveto_branch/addtoBranch/'+data['issue_id']+'"><center>Issue to branch</center></a></center>');
			// }
			// else if(data['com']==0 && data['agm']==0 && data['delivery']==0){
			// $('td',row).eq(5).html('<center><span style="color:green">Issued</span></center>');
			// }
			// else if(data['com']==4 && data['agm']==3 && data['delivery']==3 && data['reject']==1){
			// $('td',row).eq(5).html('<center><span style="color:black;"> COM Rejected&nbsp;&nbsp;&nbsp;<a class="rejectDeatails" >View Details</a></span></center>');
			// }
			// else if(data['com']==3 && data['agm']==4 && data['delivery']==3 && data['reject']==1){
			// $('td',row).eq(5).html('<center><span style="color:black;"> AGM  Rejected&nbsp;&nbsp;&nbsp;<a class="rejectDeatails" >View Details</a></span></center>');
			// }
			
		},

		"columns": [
			{ "data": "item_name", "orderable": false },
			{ "data": "branch_name", "orderable": false },
			{ "data": "item_name", "orderable": false },
			{ "data": "item_quantity", "orderable": false },
			{ "data": "issue_id", "orderable": false },
			
		 ]
		
		} );	
	
});

  function changeStatus(issue_id_fk){
	$('#issue_id').val(issue_id_fk);
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
			var n1 =new notify(options1);

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
	  



	  function checkap(issue_id){

var issue_id = issue_id;
//alert(i);
$.ajax({
url:"<?php echo base_url();?>Moveto_branch/get_operator",
type: 'POST',
data:{issue_id:issue_id},
dataType: 'json',
success:function(data){
console.log(data);

alert('pending from '+data)
$('#ap').html();

}


});

	  }
function checkop(issue_id){

var issue_id = issue_id;
//alert(i);
$.ajax({
url:"<?php echo base_url();?>Moveto_branch/get_operator",
type: 'POST',
data:{issue_id:issue_id},
dataType: 'json',
success:function(data){
console.log(data);

alert('Rejected from  '+data)
$('#op').html();

}


});



}

function checkissue(issue_id){

var issue_id = issue_id;
//alert(i);
$.ajax({
url:"<?php echo base_url();?>Moveto_branch/get_operator",
type: 'POST',
data:{issue_id:issue_id},
dataType: 'json',
success:function(data){
console.log(data);

alert('Issued from  '+data)
$('#is').html();

}


});



}

function confirmDelete(issue_id){
    var conf = confirm("Do you want to Delete Product Request ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>Moveto_branch/delete",
            data:{issue_id:issue_id},
            method:"POST",
            datatype:"json",
            success:function(data){
                var options = $.parseJSON(data);
                noty(options);
                $table.ajax.reload();
				}
			});
		}
	}


</script>
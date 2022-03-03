<script>
	$table = $('#requesttable').DataTable( {
		"processing": true,
		"serverSide": true,
		"bDestroy" : true,
		dom: 'lBfrtip',
		buttons: [
		{
			extend: 'copy',
			exportOptions: {
				columns: [ 1, 2, 3 , 4]
			}
		},
		{
			extend: 'excel',
			exportOptions: {
				columns: [ 1, 2, 3 , 4 ]
			}
		},
		{
			extend: 'pdf',
			exportOptions: {
				columns: [ 1, 2, 3 , 4 ]
			}
		},
		{
			extend: 'print',
			exportOptions: {
				columns: [ 1, 2, 3 , 4 ]
			}
		},
		{
			extend: 'csv',
			exportOptions: {
				columns: [ 1, 2, 3 , 4 ]
			}
		},
		],
		"ajax": {
			"url": "<?php echo base_url();?>Request_Br_to_br/getRequest/",
			"type": "POST",
			"data" : function (d) {
				d.branch = $("#branch").val();
			}
		},
		"createdRow": function ( row, data, index ) {
			
			$table.column(0).nodes().each(function(node,index,dt){
				$table.cell(node).data(index+1);
			});
			
			if (data['newstatus'] == 2) {
				$('td', row).eq(5).html('<center><a onclick=" checkreject('+data['id']+')">&nbsp;&nbsp;Rejected &nbsp;&nbsp;&nbsp;</a><div id="rej"></center>');
			}
			else if (data['newstatus'] == 1) {
				$('td', row).eq(5).html('<center><a onclick=" checkapproved('+data['id']+')">&nbsp;&nbsp;Approved &nbsp;&nbsp;&nbsp;</a><div id="app"></center>');
			}

			else{
				$('td', row).eq(5).html('<center><?php $u = $this->session->userdata('user_type'); ?><a target="_blank" href="<?php echo base_url();?>Request_Br_to_br/updateToapprove/'+data['newid']+'">Approve</a><br/> <a onclick="reject('+data['newid']+')" href="#myModal" data-toggle="modal"><font color="red">Reject</font></a></center><br><center><a href="<?php echo base_url();?>Request_Br_to_br/edit/'+data['newid']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a></center>');
			}
			// }
			// else if(issuedqua <= 0)
			// {
			// $('td',row).eq(7).html('<center><button class="btn btn-block btn-danger btn-xs">Out Of Stock</button></center>');
			// }
			// else if(issuedqua >= rop)
			// {
			// $('td',row).eq(7).html('<center><button class="btn btn-block btn-success btn-xs">Product Available</button></center>');
			// }
		},

		"columns": [
		{ "data": "id", "orderable": true },
		{ "data": "from_branch", "orderable": true },
		{ "data": "to_branch", "orderable": false },
		{ "data": "item_name", "orderable": false },
		{ "data": "item_quantity", "orderable": false},
		{ "data": "item_quantity", "orderable": false}		
		
		]
	} );


	function reject(new_id){
     //alert(request_id);
     $("#new_id").val(new_id);
     

 }




 function checkreject(id){

 	var rt = id;
//alert(pr);
$.ajax({
	url:"<?php echo base_url();?>Request_Br_to_br/get_operator",
	type: 'POST',
	data:{id:id},
	dataType: 'json',
	success:function(data){
		console.log(data);

		alert(data)
		$('#rej').html();

	}


});
}
function checkapproved(id){

	var rt = id;
//alert(pr);
$.ajax({
	url:"<?php echo base_url();?>Request_Br_to_br/get_operator_approve",
	type: 'POST',
	data:{id:id},
	dataType: 'json',
	success:function(data){
		console.log(data);

		alert(data)
		$('#app').html();

	}


});
}
$(document).on('change','#itemid',function(){
var itemid = $(this).val();
var branch = $('#from_branch_id').val();
console.log(branch);console.log(itemid);
if(itemid!=''){
$.ajax({ 
// url:"<?php echo base_url();?>issueitem/checkstock",
url:"<?php echo base_url();?>Request_Br_to_br/checkstock",
type: 'POST',
data: {itemid:itemid,branch:branch},
dataType: 'json',
success:function(data)
{
$('#avail').html(data['total']);
$('#available').show();
},
error:function(e){
console.log("error");
}
});
}
});
$(document).on('keyup','#quantity',function(){
var quantity = parseFloat($(this).val());
var avialable = parseFloat($('#avail').html());
console.log('quantity',quantity);
console.log('availaaaa',avialable);
if(quantity >= avialable || quantity <= 0)
{
var options1 = {
'title': 'Error',
'style': 'error',
'message': 'Input Below or equal Available....!',
'icon': 'warning',
};
var n1 = new notify(options1);
n1.show();
setTimeout(function(){  
n1.hide();
}, 3000);
$('#quantity').val('');
}
});



</script>
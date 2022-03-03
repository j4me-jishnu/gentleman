<script>
$('.select2').select2();
$(document).on('change','#item',function () {
	$table.ajax.reload();
});
$(document).on('change','#user_branch',function () {
	$table.ajax.reload();
});
$table = $('#stocktable').DataTable( {
	"searching" :false,
	"processing": true,
	"serverSide": true,
	"bDestroy" : true,
	"aLengthMenu": [[100,200, 400, 600], [100,200, 400, 600]],
	"iDisplayLength": 100,
	dom: 'lBfrtip',
	buttons: [
		{
			extend: 'copy',
			exportOptions: {
				columns: [ 1, 2, 3 , 4 , 5, 6,7]
			}
		},
		{
			extend: 'excel',
			exportOptions: {
				columns: [ 1, 2, 3 , 4 , 5, 6,7]
			}
		},
		{
			extend: 'pdf',
			exportOptions: {
				columns: [ 1, 2, 3 , 4 , 5, 6,7]
			}
		},
		{
			extend: 'print',
			exportOptions: {
				columns: [ 1, 2, 3 , 4 , 5, 6,7]
			}
		},
		{
			extend: 'csv',
			exportOptions: {
				columns: [ 1, 2, 3 , 4 , 5, 6,7]
			}
		},
	],
	"ajax": {
		"url": "<?php echo base_url();?>Branchstock/get/",
		"type": "POST",
		"data" : function (d) {
			d.user_branch = $("#user_branch").val();
			d.item = $("#item").val();
		}
	},
	"createdRow": function ( row, data, index ) {
		$table.column(0).nodes().each(function(node,index,dt){
			$table.cell(node).data(index+1);
		});
		// $.ajax({
		// 	url:"<?php echo base_url();?>Branchstock/test",
		// 	type: 'POST',
		// 	data:{
		// 		branch_id:data['shop_id_fk'],
		// 		item_id:data['item_id_fk']
		// 	},
		// 	// dataType: 'json',
		// 	success:function(data1){
		// 		data['branch_to_branch']=data1;
		// 	}
		// });
		// console.log(data['branch_to_branch']);
		var rop = data['item_rop'];
		rop = parseFloat(rop);

		$('#tot').html(data['all_total']);
		var issuedqua = data['total'];
		var req=data['request_quantity'];
		var rec=data['used_qty'];

		var tot_rec=parseFloat(req) + parseFloat(rec);
		var openingstock_with_rec=parseFloat(data['total_qty'])+tot_rec;
		$('td',row).eq(3).html(openingstock_with_rec);
		$('td',row).eq(4).html(tot_rec);
		if(issuedqua <= 0){
			$('td',row).eq(10).html('<center><button class="btn btn-block btn-danger btn-xs">Out Of Stock</button></center>');
		}
		else if(issuedqua < rop){
			$('td',row).eq(10).html('<center><button class="btn btn-block btn-warning btn-xs">Reached Below</button></center>');
		}
		else if(issuedqua >= rop){
			$('td',row).eq(10).html('<center><button class="btn btn-block btn-success btn-xs">Product Available</button></center>');
		}
		$('td',row).eq(11).hide();
	},

	"columns": [
		{ "data": "item_name", "orderable": true },
		{ "data": "branch_name", "orderable": true },
		{ "data": "itemnamenew", "orderable": false },
		{ "data": "total_qty", "orderable": false },
		{ "data": "total_qty", "orderable": true,"searchable": true },
		{ "data": "used_qty", "orderable": true,"searchable": true },
		{ "data": "tot_qty", "orderable": false },
		{ "data": "total", "orderable": false},
		{ "data": "item_rop", "orderable": false},
		{ "data": "updated_date", "orderable": false },
		{ "data": "total", "orderable": false}
	]
} );
</script>


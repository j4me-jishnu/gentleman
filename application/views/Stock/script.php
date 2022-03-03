<script>
	$('.select2').select2();
	$(document).on('change', '#item', function() {
		$table.ajax.reload();
	});
	$table = $('#stocktable').DataTable({
		"processing": true,
		"serverSide": false,
		"bDestroy": true,
		dom: 'lBfrtip',
		buttons: [{
				extend: 'copy',
				exportOptions: {
					columns: [1, 2, 3, 4, 5,6,7,]
				}
			},
			{
				extend: 'excel',
				exportOptions: {
					columns: [1, 2, 3, 4,5,6,7,]
				}
			},
			{
				extend: 'pdf',
				exportOptions: {
					columns: [1, 2, 3, 4,5,6,7,]
				}
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [1, 2, 3, 4,5,6,7,]
				}
			},
			{
				extend: 'csv',
				exportOptions: {
					columns: [1, 2, 3, 4,5,6,7,]
				}
			},
		],
		"ajax": {
			"url": "<?php echo base_url(); ?>Stock/getBstock/",
			"type": "POST",
			"data": function(d) {
				d.item = $("#item").val();
				console.log(d);
			}
		},
		function(row, data, index) {
			// console.log(data); /* Here comes the data*/
		},
		"createdRow": function(row, data, index) {
			$table.column(0).nodes().each(function(node, index, dt) {
				$table.cell(node).data(index + 1);
			});
			var rop = data['item_rop'];
			var x =parseInt(data['total_qty']) + parseInt(data['request_quantity']);
			rop = parseFloat(rop);
			$('#tot').html(data['all_total']);
			var issuedqua = data['total'];
			var req = data['request_quantity'];
			var rec=data['last_issued_qty'];
			var rec = data['total_qty'];
			let remaining = parseFloat(rec)-parseFloat(data['item_quantity']);
			var tot_rec = parseFloat(req) + parseFloat(rec);
			$('td', row).eq(3).html(tot_rec);
			if (data['total'] <= 0) {
				$('td', row).eq(11).html('<center><button class="btn btn-block btn-danger btn-xs">Out Of Stock</button></center>');
			} else if (data['total'] < rop) {
				$('td', row).eq(11).html('<center><button class="btn btn-block btn-warning btn-xs">Reached Below</button></center>');
			} else if (data['total'] >= rop) {
				$('td', row).eq(11).html('<center><button class="btn btn-block btn-success btn-xs">Product Available</button></center>');
			}
			$('td', row).eq(11).html(data['item_quantity']);
			// if (issuedqua <= 0) {
			// 	$('td', row).eq(11).html('<center><button class="btn btn-block btn-danger btn-xs">Out Of Stock</button></center>');
			// } else if (issuedqua < rop) {
			// 	$('td', row).eq(11).html('<center><button class="btn btn-block btn-warning btn-xs">Reached Below</button></center>');
			// } else if (issuedqua >= rop) {
			// 	$('td', row).eq(11).html('<center><button class="btn btn-block btn-success btn-xs">Product Available</button></center>');
			// }
			// $('td', row).eq(11).html(data['item_quantity']);
		},
		// "createdRow": function(row, data, index) {
		// 	$table.column(0).nodes().each(function(node, index, dt) {
		// 		$table.cell(node).data(index + 1);
		// 	});
		// 	var rop = data['item_rop'];
		// 	var x =parseInt(data['total_qty']) + parseInt(data['request_quantity']);
		// 	rop = parseFloat(rop);
		// 	// $('#tot').html(data['all_total']);
		// 	var issuedqua = data['total'];
		// 	var req = data['request_quantity'];
		// 	// var rec=data['last_issued_qty'];
		// 	var rec = data['total_qty'];
		// 	// let remaining = parseFloat(rec)-parseFloat(data['item_quantity']);
		// 	var tot_rec = parseFloat(req) + parseFloat(rec);
		// 	$('td', row).eq(3).html(tot_rec);
		// 	if (issuedqua <= 0) {
		// 		$('td', row).eq(11).html('<center><button class="btn btn-block btn-danger btn-xs">Out Of Stock</button></center>');
		// 	} else if (issuedqua < rop) {
		// 		$('td', row).eq(11).html('<center><button class="btn btn-block btn-warning btn-xs">Reached Below</button></center>');
		// 	} else if (issuedqua >= rop) {
		// 		$('td', row).eq(11).html('<center><button class="btn btn-block btn-success btn-xs">Product Available</button></center>');
		// 	}
		// 	$('td', row).eq(11).html(data['item_quantity']);
		// },

		"columns": [{
				"data": "item_name",
				"orderable": true
			},
			{
				"data": "item_name",
				"orderable": true
			},
			{
				"data": "total_qty",
				"orderable": true
			},
			{
				"data": "request_quantity",
				"orderable": true
			},
			{
				"data": "request_quantity",
				"orderable": true
			},
			{
				"data": "updated_date",
				"orderable": true
			},
			// { "data": "last_issued_qty", "orderable": false },
			{
				"data": "tot_qty",
				"orderable": true
			},
			{
				"data": "total_returns_to_master",
				"orderable": true
			},
			// here
			{
				"data": "single_to_branch_count",
				"orderable": true
			},
			{
				"data": "item_rop",
				"orderable": true
			},
			{
				"data": "total",
				"orderable": true
			},
			// end
			{
				"data": "total",
				"orderable": true
			},
			// {
			// 	"data": "tot_qty", /* Variable showing the quantity of item returned */
			// 	"orderable": false
			// }

		]
	});
	$.ajax({
    url:"<?php echo base_url();?>Dash_board/getBranchStockDetails",
    data:{},
    method:"POST",
    datatype:"json",
    success:function(data){
      var data = $.parseJSON(data);
      $("#tot").html(data.total_balance_stock);
    }
  });
</script>

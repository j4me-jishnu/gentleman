<script>
  $table = $('#stocktable').DataTable( {

     	//"filter" :false,
  		"paging":   true,
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,

        "aLengthMenu": [[100,200, 400, 600,800], [100,200, 400, 600,800]],
         "iDisplayLength": 100,
        dom: 'lBfrtip',
			buttons: [
				{
					extend: 'copy',
					exportOptions: {
						columns: [ 1, 2, 3 ]
					}
				},
				{
					extend: 'excel',
					exportOptions: {
						columns: [ 1, 2, 3 ]
					}
				},
				{
					extend: 'pdf',
					exportOptions: {
						columns: [ 1, 2, 3 ]
					}
				},
				{
					extend: 'print',
					exportOptions: {
						columns: [ 1, 2, 3 ]
					}
				},
				{
					extend: 'csv',
					exportOptions: {
						columns: [ 1, 2, 3]
					}
				},
			],
        "ajax": {
            "url": "<?php echo base_url();?>Masterstock/get/",
            "type": "POST",
            "data" : function (d) {
            d.branch = $("#branch").val();
            }
        },
        "createdRow": function ( row, data, index ) {
			$table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
      });
			var rop = data['master_rop'];
			rop = parseFloat(rop);
			var issuedqua = data['remaining_qty'];
			if(issuedqua < rop)
			{
			$('td',row).eq(10).html('<center><button class="btn btn-block btn-warning btn-xs">Reached Below</button></center>');
			}
			else if(issuedqua <= 0)
			{
			$('td',row).eq(10).html('<center><button class="btn btn-block btn-danger btn-xs">Out Of Stock</button></center>');
			}
			else if(issuedqua >= rop)
			{
			$('td',row).eq(10).html('<center><button class="btn btn-block btn-success btn-xs">Product Available</button></center>');
			}
		},

    "columns": [
      { "data": "stock_status", "orderable": true },
      { "data": "item_name", "orderable": false },
      { "data": "opening_stock", "orderable": false },
      { "data": "purchase_quantity", "orderable": false },
      { "data": "branch_return_count", "orderable": false },
      { "data": "simple_total_stock", "orderable": false },
      { "data": "tot_issued", "orderable": false },
      { "data": "t_quantity", "orderable": false },
      { "data": "master_rop", "orderable": false },
      { "data": "up_date", "orderable": false },
      { "data": "stock_id", "orderable": false },
    ]
  } );
</script>

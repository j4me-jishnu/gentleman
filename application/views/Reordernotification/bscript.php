<script>
	$('.select2').select2();
	$(document).on('change','#item',function () {
	$table.ajax.reload();	
	});	
	$(document).on('change','#user_branch',function () {
	$table.ajax.reload();	
	});
  $table = $('#stocktable').DataTable( {
  		"filter" :false,
  		"paging":   false,
        "processing": true,
        "serverSide": false,
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
            "url": "<?php echo base_url();?>Reordernotification/bget/",
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
			var rop = data['item_rop'];
				rop = parseFloat(rop);

					$('#tot').html(data['all_total']);
			var issuedqua = data['total'];
			if(issuedqua <= 0)
			{
			$('td',row).eq(8).html('<center><button class="btn btn-block btn-danger btn-xs">Out Of Stock</button></center>');
			}
			else if(issuedqua < rop)
			{
			$('td',row).eq(8).html('<center><button class="btn btn-block btn-warning btn-xs">Reached Below</button></center>');	
			}
			
			else if(issuedqua >= rop)
			{
			$('td',row).eq(8).html('<center><button class="btn btn-block btn-success btn-xs">Product Available</button></center>');
			}
			$('td',row).eq(9).hide();
		},

        "columns": [
            { "data": "item_name", "orderable": true },
            { "data": "branch_name", "orderable": true },
            { "data": "item_name", "orderable": false },
            // { "data": "item_rop", "orderable": false },
            /* opening stock */
            { "data": "total_qty", "orderable": false },
            /* Recived from master */
            { "data": "request_quantity", "orderable": false },
            /* Recieved Date */
			{ "data": "updated_date", "orderable": false },
			{ "data": "used_qty", "orderable": false },
            { "data": "total", "orderable": false},
            { "data": "total", "orderable": false}		
            
        ]
    } );
</script>
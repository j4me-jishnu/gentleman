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
						columns: [ 1, 2, 3 , 4 , 5, 6]
					}
				},
				{
					extend: 'excel',
					exportOptions: {
						columns: [ 1, 2, 3 , 4 , 5, 6]
					}
				},
				{
					extend: 'pdf',
					exportOptions: {
						columns: [ 1, 2, 3 , 4 , 5, 6]
					}
				},
				{
					extend: 'print',
					exportOptions: {
						columns: [ 1, 2, 3 , 4 , 5, 6]
					}
				},
				{
					extend: 'csv',
					exportOptions: {
						columns: [ 1, 2, 3 , 4 , 5, 6]
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
		},

        "columns": [
            { "data": "item_name", "orderable": true },
            { "data": "branch_name", "orderable": true },
            { "data": "item_name", "orderable": false },
            /* opening stock */
            { "data": "total", "orderable": false },
            /* recieved */
			{ "data": "date", "orderable": false },
			/* recieved date */
			{ "data": "date", "orderable": false },
			/* used quantity */
            { "data": "used_qty", "orderable": false },
            /* balance */
            { "data": "total", "orderable": false},
            /* */
            { "data": "total", "orderable": false}		
            
        ]
    } );
</script>
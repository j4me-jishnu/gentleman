<script>
  $table = $('#rop_table').DataTable( {
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
            "url": "<?php echo base_url();?>Benchmark_Request/getRequest/",
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
				$('td', row).eq(5).html('<center>Rejected</center>');
			}
			else if (data['newstatus'] == 1) {
				$('td', row).eq(5).html('<center>Approved</center>');
			}

			else{
				$('td', row).eq(5).html('<center><?php $u = $this->session->userdata('user_type'); ?><a target="_blank" href="<?php echo base_url();?>Request_Br_to_br/updateToapprove/'+data['newid']+'">Approve</a><br/><a target="_blank" href="<?php echo base_url();?>Request_Br_to_br/updateToreject/'+data['newid']+'"><font color="red">Reject</font></a></center>');
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
</script>
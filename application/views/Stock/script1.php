<script>
	$('.select2').select2();
	$(document).on('change','#item',function () {
	$table.ajax.reload();
	});
  $table = $('#stocktable').DataTable( {
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        dom: 'lBfrtip',
			buttons: [
				{
					extend: 'copy',
					exportOptions: {
						columns: [ 1, 2, 3 , 4 ,5]
					}
				},
				{
					extend: 'excel',
					exportOptions: {
						columns: [ 1, 2, 3 , 4]
					}
				},
				{
					extend: 'pdf',
					exportOptions: {
						columns: [ 1, 2, 3 , 4]
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
"url": "<?php echo base_url();?>stock/getBstock/",
"type": "POST",
"data" : function (d) {
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
if(issuedqua <=0)
{
$('td',row).eq(7).html('<center><button class="btn btn-block btn-danger btn-xs">Out Of Stock</button></center>');
}
else if(issuedqua < rop)
{
$('td',row).eq(7).html('<center><button class="btn btn-block btn-warning btn-xs">Reached Below</button></center>');
}
else if(issuedqua >= rop)
{
$('td',row).eq(7).html('<center><button class="btn btn-block btn-success btn-xs">Product Available</button></center>');
}
},

        "columns": [
            { "data": "item_name", "orderable": false },
            { "data": "item_name", "orderable": false },
            { "data": "total_qty", "orderable":false },
						{ "data": "request_quantity", "orderable": false },
						{ "data": "updated_date", "orderable": false },
						{ "data": "last_issued_qty", "orderable": false },
						{ "data": "total", "orderable": false },
						{ "data": "total", "orderable": false }
					]
    } );


</script>

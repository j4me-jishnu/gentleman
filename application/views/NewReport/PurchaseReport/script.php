<script>
  $(function () {
	//Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Date picker
    $('#date').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy'
    });
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
	//Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    $table = $('#purchase_report_table').DataTable( {
		
        "processing": true,
        "paging":   true,
        "serverSide": true,
        "bDestroy" : true,
        "aLengthMenu": [[10, 20, 40], [10, 20, 40]],
         "iDisplayLength": 10,
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [ 1, 2, 3, 4 ,5, 6]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 1, 2, 3, 4 ,5, 6]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 1, 2, 3, 4 ,5, 6]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 1, 2, 3, 4 ,5, 6]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [ 1, 2, 3, 4 ,5, 6]
                }
            },
        ],
        	
        "ajax": {
            "url": "<?php echo base_url();?>NewReport/getPurchaseReport",
            "type": "POST",
            "data" : function (d) {
            d.user_branch = $("#user_branch").val();
			d.start_date = $("#pmsDateStart").val();
			d.end_date = $("#pmsDateEnd").val();
			}
        },
        "createdRow": function ( row, data, index ) {
          
			$table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
		},

        "columns": [
            { "data": "purchase_status", "orderable": false },
            { "data": "purchase_bill_no", "orderable": false },
            { "data": "item_name", "orderable": false },
            { "data": "purchase_qty", "orderable": false },
            { "data": "purchase_price", "orderable": false },
            { "data": "vendor_name", "orderable": false },
            { "data": "purchase_date", "orderable": false }
            
            
        ]
    } );
	
});
$('#search').click(function () {
	$table.ajax.reload();
});
</script>
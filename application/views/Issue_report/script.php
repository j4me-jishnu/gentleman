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

    $table = $('#issue_table').DataTable( {
		
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
            "url": "<?php echo base_url();?>Issue_report/get/",
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
             $('#tot').html(data['all_total']);
		},

        "columns": [
            { "data": "issue_id", "orderable": true },
            { "data": "branch_name", "orderable": false },
            { "data": "item_name", "orderable": false },
            { "data": "username", "orderable": false },
            { "data": "issue_quantity", "orderable": false },
            { "data": "issue_date", "orderable": false }
           
            
        ]
    } );
	
});
$('#search').click(function () {
	$table.ajax.reload();
});
</script>
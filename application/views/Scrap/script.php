<script>
$("#item_name").keyup(function () {
$table.ajax.reload();
});
// $(document).on('change','#designation',function () {
// $table.ajax.reload();
// });
$(document).on('change','#fdate',function () {
$table.ajax.reload();
});
$(function () {
	var isactive = $('#isactive').val();
	if(isactive){$('#is_active').attr('checked', true);}
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

    $table = $('#scrap_table').DataTable( {
		"searching": false,
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        dom: 'lBfrtip',
			buttons: [
				{
					extend: 'copy',
					exportOptions: {
						columns: [ 1, 2, 3 , 4 ]
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
            "url": "<?php echo base_url();?>Scrap/getScrap/",
            "type": "POST",
            "data" : function (d) {
            d.item_name = $("#item_name").val();
			d.idate = $("#idate").val();
			d.fdate = $("#fdate").val();
           }
        },
        "createdRow": function ( row, data, index ) {

			$table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });

        },

        "columns": [
            { "data": "status", "orderable": true },
            { "data": "item_name", "orderable": false },
            { "data": "item_quantity", "orderable": false },
            { "data": "scrap_reason", "orderable": false },
            { "data": "branch_name", "orderable": false },
			{ "data": "return_date", "orderable": false }


        ]
    } );
});
$(document).on('change','#designation',function () {
	var v = $(this).val();
	$('#user_name').val('');
	$('#user_password').val('');
	if(v==1 || v==2 || v==3 || v==4 || v==5 || v==6 )
	{
		$('.userNpass').show();
	}
	else{
		$('.userNpass').hide();
	}
    //
});

$('#search').click(function () {
    $table.ajax.reload();
});
function confirmDelete(user_id){
    var conf = confirm("Do you want to Delete User ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>users/delete",
            data:{user_id:user_id},
            method:"POST",
            datatype:"json",
            success:function(data){
                var options = $.parseJSON(data);
                noty(options);
                $table.ajax.reload();
				}
			});
		}
	}
	var response = $("#response").val();
	  if(response){
		  console.log(response,'response');
		  var options = $.parseJSON(response);
		  noty(options);
	  }
</script>

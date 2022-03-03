<script>
$("#user_name").keyup(function () {
$table.ajax.reload();
});

$("#action").keyup(function () {
$table.ajax.reload();
});

function changeStatus(user_id) {
	$('#uid').val(user_id+1);
	var i = $('#uid').val();
	console.log('iddd=>',i);
}

$(document).on('change','#designation',function () {
$table.ajax.reload();
});
$(document).on('change','#log',function () {
$table.ajax.reload();
});
$(function () {
	//var isactive = $('#isactive').val();
	//if(isactive){$('#is_active').attr('checked', true);}
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


    $(document).ready(function(){
	$("#user_table").on('change','.quotationSt',function(){
	var conf = confirm("Do you want to continue?");
	if(conf){
	  var option = $(this).val();
	  var uid = $('#uid').val();
	  console.log(option);
	  console.log(uid);

			$.ajax({
				  url:"<?php echo base_url()?>users/setPrivilage",
				  type: 'POST',
				  data: {uid:uid,option:option},
				  dataType: 'json',
				  success:
				  function(data)
				  {
					location.reload();
				  },
				  error:function(e){
				  console.log("error");
				}
			});
	}
	});
});


    $table = $('#log_table').DataTable( {

		"searching": false,
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        dom: 'lBfrtip',
			buttons: [
				{
					extend: 'copy',
					exportOptions: {
						columns: [ 1,2, 3 , 4 ,5]
					}
				},
				{
					extend: 'excel',
					exportOptions: {
						columns: [1,2, 3 , 4 ,5]
					}
				},
				{
					extend: 'pdf',
					exportOptions: {
						columns: [ 1,2, 3 , 4 ,5]
					}
				},
				{
					extend: 'print',
					exportOptions: {
						columns: [ 1,2, 3 , 4 ,5]
					}
				},
				{
					extend: 'csv',
					exportOptions: {
						columns: [1,2, 3 , 4 ,5]
					}
				},
			],
        "ajax": {
            "url": "<?php echo base_url();?>Log_file/get/",
            "type": "POST",
            "data" : function (d) {
            d.user_name = $("#user_name").val();
			d.designation = $("#designation").val();
			d.log = $("#log").val();
			d.action = $("#action").val();
			d.start_date = $("#pmsDateStart").val();
			d.end_date = $("#pmsDateEnd").val();
           }
        },
        "createdRow": function ( row, data, index ) {
			$table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });

            if(data['user_type'] == 'A')
            {

            $('td', row).eq(3).html('Admin');
        	}
        	 else if(data['user_type'] == 'Su')
            {
            $('td', row).eq(3).html('Super User');
        	}
        	 if(data['user_type'] == 'S')
            {
            $('td', row).eq(3).html('User');
        	}
        },

        "columns": [
            { "data": "id", "orderable": true },
            { "data": "date", "orderable": true, "order": "asc" },
            { "data": "user_name", "orderable": false },
            { "data": "user_type", "orderable": false },
            { "data": "operation", "orderable": false },
            { "data": "name", "orderable": false }
        ]
    } );
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

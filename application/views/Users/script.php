<script>
$("#user_name").keyup(function () {
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
$(document).on('change','#user_branch',function () {
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
				  url:"<?php echo base_url()?>Users/setPrivilage",
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


    $table = $('#user_table').DataTable( {
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
            "url": "<?php echo base_url();?>Users/get/",
            "type": "POST",
            "data" : function (d) {
            d.user_name = $("#user_name").val();
			d.designation = $("#designation").val(); 
			d.branch_name = $("#user_branch").val(); 
           }
        },
        "createdRow": function ( row, data, index ) {
           // alert(data);
			$table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
            $('td', row).eq(7).html('<center><a href="<?php echo base_url();?>Users/edit/'+data['user_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['user_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a><br><a href="<?php echo base_url(); ?>Users/history/'+data['id']+'">Show History</a></center>');
			
            

            if(data['user_type'] == 'A')
            {
            $('td', row).eq(6).html('<center>Admin</center>');
        	}	
        	 else if(data['user_type'] == 'Su')
            {
            $('td', row).eq(6).html('<center>Super User</center>');
        	}	
        	 if(data['user_type'] == 'S')
            {
            $('td', row).eq(6).html('<center>User</center>');
        	}	

        },

        "columns": [
            { "data": "user_status", "orderable": true },
            { "data": "username", "orderable": false },
            { "data": "user_address", "orderable": false },
            { "data": "branch_name", "orderable": false },
            { "data": "user_phone", "orderable": false },
			{ "data": "user_email", "orderable": false },
			{ "data": "user_type", "orderable": false },          
            { "data": "user_id", "orderable": false }
            
        ]
    } );
});
$(document).on('change','#designation',function () {
	var v = $(this).val(); 
	$('#user_name').val(''); 
	$('#user_password').val(''); 
	// if(v==1 || v==2 || v==3 || v==4 || v==5 || v==6 )
	// {
	// 	$('.userNpass').show();
	// }
	// else{
	// 	$('.userNpass').hide();
	// }
    //
});

$('#search').click(function () {
    $table.ajax.reload();
});
function confirmDelete(user_id){
    var conf = confirm("Do you want to Delete User ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>Users/delete",
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




	  $(document).ready(function(){
	$("#privilage").on('change',function(){
	var pr = $("#privilage").val();

	if(pr == "Su"){

		$('#setprivilage').show();

	}

	});
});
</script>
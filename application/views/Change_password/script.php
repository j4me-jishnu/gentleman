<script>
var response = $("#response").val();
  if(response){
      console.log(response,'response');
      var options = $.parseJSON(response);
      noty(options);
  }
  $(function () {
	  $("#email option:first").before('<option value="">----Please Select---</option>');
	$("#email").val("").change();
	var ctnm = $('#mail').val();
	if(ctnm){$("#email").val(ctnm).change();}
    $(".select2").select2();
	
	$("#user_name option:first").before('<option value="">----Please Select---</option>');
	$("#user_name").val("").change();
	var ctnm = $('#user_name').val();
	if(ctnm){$("#user_name").val(ctnm).change();}
    $(".select2").select2();
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

    $table = $('#login_table').DataTable( {
        "searching": true,
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "ajax": {
            "url": "<?php echo base_url();?>Changepass/get/",
            "type": "POST",
            "data" : function () {
			}
        },
        "createdRow": function ( row, data, index ) {
            $table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
            $('td', row).eq(7).html('<center><a href="<?php echo base_url();?>Changepass/add/'+data['id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
          
        },

        "columns": [
            { "data": "user_name", "orderable": false },
            { "data": "email", "orderable": false },
			{ "data": "password	", "orderable": false },
            { "data": "status", "orderable": false }
            
        ]
        
    } );
});
function confirmDelete(id){
    var conf = confirm("Do you want to Delete Product ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>Changepass/edit/",
            data:{id:id},
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
</script>
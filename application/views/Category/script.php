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

    $table = $('#cat_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        dom: 'lBfrtip',
			buttons: [
				{
					extend: 'copy',
					exportOptions: {
						columns: [ 1, 2]
					}
				},
				{
					extend: 'excel',
					exportOptions: {
						columns: [ 1, 2]
					}
				},
				{
					extend: 'pdf',
					exportOptions: {
						columns: [ 1, 2]
					}
				},
				{
					extend: 'print',
					exportOptions: {
						columns: [ 1, 2]
					}
				},
				{
					extend: 'csv',
					exportOptions: {
						columns: [ 1, 2]
					}
				},
			],
        "ajax": {
            "url": "<?php echo base_url();?>category/get",
            "type": "POST",
            "data" : function (d) {
            
           }
        },
        "createdRow": function ( row, data, index ) {
          
			$table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
            $('td', row).eq(3).html('<center><?php $u = $this->session->userdata('user_type'); if($u != 'S'){ ?><a href="<?php echo base_url();?>category/edit/'+data['category_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['category_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a><?php } ?></center>');
        },

        "columns": [
            { "data": "category_status", "orderable": true },
            { "data": "category_name", "orderable": false },
            { "data": "category_dscription", "orderable": false },
            { "data": "category_id", "orderable": false }
            
        ]
    } );
});
function confirmDelete(category_id){
    var conf = confirm("Do you want to Delete Branch ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>Category/delete",
            data:{category_id:category_id},
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
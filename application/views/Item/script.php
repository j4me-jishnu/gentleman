<script>
  $(function () {
	$('.select2').select2()
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

    $table = $('#item_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "lengthMenu":["All",100,50,25,10],
        dom: 'lBfrtip',
			buttons: [
				{
					extend: 'copy',
					exportOptions: {
						columns: [ 1, 2, 3 , 4 , 5  ]
					}
				},
				{
					extend: 'excel',
					exportOptions: {
						columns: [ 1, 2, 3 , 4 , 5  ]
					}
				},
				{
					extend: 'pdf',
					exportOptions: {
						columns: [ 1, 2, 3 , 4 , 5  ]
					}
				},
				{
					extend: 'print',
					exportOptions: {
						columns: [ 1, 2, 3 , 4 , 5  ]
					}
				},
				{
					extend: 'csv',
					exportOptions: {
						columns: [ 1, 2, 3 , 4 , 5 ]
					}
				},
			],
        "ajax": {
            "url": "<?php echo base_url();?>item/get/",
            "type": "POST",
            "data" : function (d) {

           }
        },
        "createdRow": function ( row, data, index ) {

			$table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
            $('td', row).eq(6).html('<center><?php $u = $this->session->userdata('user_type'); if($u != 'S'){ ?><a href="<?php echo base_url();?>item/edit/'+data['item_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['item_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a>&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>Item/view/'+data['item_id']+'"><i class="fa fa-eye" ></i></a><?php } ?></center>');
        },

        "columns": [
            { "data": "item_status", "orderable": true },
            { "data": "item_name", "orderable": false },
			{ "data": "category_name", "orderable": false },
			{ "data": "item_hsn", "orderable": false },
            { "data": "item_tax", "orderable": false },
			{ "data": "item_description", "orderable": false },

            { "data": "item_id", "orderable": false }

        ]
    } );
});
function confirmDelete(item_id){
    var conf = confirm("Do you want to Delete Item ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>item/delete",
            data:{item_id:item_id},
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
function branches(item_id){
	$('#item_id').val(item_id);
	$('#myModal').modal();
};
 $(document).on('click','#branch_update',function(){
	 var item_id = $('#item_id').val();
	 var branch = $('#branch').val();
	 if(item_id !="" && branch !="")
	 {
		 $.ajax({
            url:"<?php echo base_url();?>item/update_branch",
            data:{item_id:item_id,branch:branch},
            method:"POST",
            datatype:"json",
            success:function(data){
                var options = $.parseJSON(data);
                noty(options);
                $table.ajax.reload();
				}
			});
	 }

 })



 $('#add').click(function(){


	 var quantity = $('#pquantity').val();
	 var price = $('#pprice').val();
     var template = $('#template');
	 var id = 0;

      if(quantity!='' && price!=''){
		$('#datatable').show();
		var row = template.clone();
		template.find("input:text").val("");
		row.attr('id', 'row_' + (++id)); row.attr('class', 'newrow');
		row.find('.qnName').val($('#pquantity').val());
		row.find('.qName').html($('#pquantity').val());$('#pquantity').val('');
		row.find('.prRate').val($('#pprice').val());
		row.find('.pRate').html($('#pprice').val());$('#pprice').val('');


		template.after(row);

	  }


 })
</script>

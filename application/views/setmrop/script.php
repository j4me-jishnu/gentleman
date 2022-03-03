<script>
  var response = $("#response").val();
  if(response){
      console.log(response,'response');
      var options = $.parseJSON(response);
      noty(options);
  }
  var param = '';
  
  var $customerList=[ {'columnName':'customer_name','label':'Customer'} ];
  $(function () {
  
    var enquiry_type = {'J':'Job','C':'Complaint','F':'Follow-up'};
    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Date picker
    $('#start_date').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy'
    });
  $('#end_date').datepicker({
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

$table = $('#rop_table').DataTable( {
"processing": true,
"serverSide": true,
"bDestroy" : true,

"ajax": {
"url": "<?php echo base_url();?>Setmrop/get",
"type": "POST",
"data" : function (d) {

}
},
"createdRow": function ( row, data, index ) {

$table.column(0).nodes().each(function(node,index,dt){
$table.cell(node).data(index+1);
});
$('td', row).eq(3).html('<center><a href="<?php echo base_url();?>Setmrop/edit/'+data['rop_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['rop_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
	},

"columns": [
{ "data": "rop_status", "orderable": true },
{ "data": "item_name", "orderable": false },
{ "data": "item_rop", "orderable": false },
{ "data": "rop_id", "orderable": false }
]

} );
    
    
  });
 function confirmDelete(rop_id){
    var conf = confirm("Do you want to Delete ROP Details ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>Setmrop/delete",
            data:{rop_id:rop_id},
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
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

  $.ajax({
    url:"<?php echo base_url();?>Dash_board/getBranchStockDetails",
    data:{},
    method:"POST",
    datatype:"json",
    success:function(data){
      var data = $.parseJSON(data);
      $("#stockCount").html(data.total_balance_stock);
    }
  });

  $table = $('#user_table').DataTable( {
    "searching": false,
    "processing": true,
    "serverSide": true,
    "bDestroy" : true,
    // dom: 'lBfrtip',
    // buttons: [
    // {
    // extend: 'copy',
    // exportOptions: {
    // columns: [ 1, 2, 3 , 4 ]
    // }
    // },
    // {
    // extend: 'excel',
    // exportOptions: {
    // columns: [ 1, 2, 3 , 4 ]
    // }
    // },
    // {
    // extend: 'pdf',
    // exportOptions: {
    // columns: [ 1, 2, 3 , 4 ]
    // }
    // },
    // {
    // extend: 'print',
    // exportOptions: {
    // columns: [ 1, 2, 3 , 4 ]
    // }
    // },
    // {
    // extend: 'csv',
    // exportOptions: {
    // columns: [ 1, 2, 3 , 4 ]
    // }
    // },
    // ],
    "ajax": {
      "url": "<?php echo base_url();?>Dash_board/get/",
      "type": "POST",
      "data" : function (d) {
        // console.log(d);
      }
    },
    "createdRow": function ( row, data, index ) {
      $table.column(0).nodes().each(function(node,index,dt){
        $table.cell(node).data(index+1);
      });
    },

    "columns": [
      { "data": "user_status", "orderable": true },
      { "data": "username", "orderable": false },
      { "data": "user_address", "orderable": false },
      { "data": "user_phone", "orderable": false },
      { "data": "user_email", "orderable": false }
    ]
  } );
});
</script>

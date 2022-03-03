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

  $table = $('#designation_table').DataTable( {
    "processing": true,
    "serverSide": false,
    "bDestroy" : true,
    dom: 'lBfrtip',
    aLengthMenu: [
        [100, 200, 300, 400, -1],
        [100, 200, 300, 400, "All"]
    ],
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
      "url": "<?php echo base_url();?>NewMaster/getMasterStock/",
      'dataSrc':"",
      "type": "POST",
      "data" : function (d) {

      }
    },
    "createdRow": function ( row, data, index ) {

      $table.column(0).nodes().each(function(node,index,dt){
        $table.cell(node).data(index+1);
      });
      if(data['opening_stck_qty']==0){
        $('td', row).eq(4).html('<center><?php $u = $this->session->userdata('user_type'); if($u != 'S'){ ?><a style="color:white;" href="<?php echo base_url();?>NewMaster/updateMasterStockDetails/'+data['item_id']+'"><button class="btn btn-success">Update</bytton></a><?php } ?></center>');
        //$('td', row).eq(4).html('<center><?php $u = $this->session->userdata('user_type'); if($u != 'S'){ ?><a style="color:white;" href="<?php echo base_url();?>NewMaster/updateMasterStockDetails/'+data['item_id']+'"><button class="btn btn-success">Update</bytton></a><button onclick="confirmDelete('+data['item_id']+')" class="btn btn-danger">DELETE</button><?php } ?></center>');
      }
    },

    "columns": [
      { "data": "item_status", "orderable": true },
      { "data": "item_name", "orderable": false },
      { "data": "cate_name", "orderable": false },
      { "data": "opening_stck_qty", "orderable": false },
      { "data": null, "defaultContent":""},
    ]
  } );
});
function confirmDelete(item_id){
  var conf = confirm("Do you want to Delete Item Details ?");
  if(conf){
    $.ajax({
      url:"<?php echo base_url();?>NewMaster/deleteItems2",
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

</script>

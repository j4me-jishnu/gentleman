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

      "url": "<?php echo base_url();?>NewMaster/getPurchaseStockList/",

      'dataSrc':"",

      "type": "POST",

      "data" : function (d) {

      }

    },

    "createdRow": function ( row, data, index ) {



      $table.column(0).nodes().each(function(node,index,dt){

        $table.cell(node).data(index+1);

      });

      $('td', row).eq(9).html('<center><?php $u = $this->session->userdata('user_type'); if($u != 'S'){ ?><a href="<?php echo base_url();?>designation/edit/'+data['purchase_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['purchase_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a><?php } ?></center>');

    },



    "columns": [

      { "data": "purchase_status", "orderable": true },

      { "data": "item_name", "orderable": false },

      { "data": "purchase_qty", "orderable": false },

      { "data": "updated_at", "orderable": false },

    ]

  } );

});

function confirmDelete(purchase_id){

  var conf = confirm("Do you want to Delete Purchase Details ?");

  if(conf){

    $.ajax({

      url:"<?php echo base_url();?>NewMaster/deletePurchaseDetails",

      data:{purchase_id:purchase_id},

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


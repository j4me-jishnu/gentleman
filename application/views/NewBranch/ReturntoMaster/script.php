<script type="text/javascript">



$(document).ready(function(){

  $table = $('#returnToMasterTable').DataTable( {

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

      "url": "<?php echo base_url();?>NewBranch/getReturntomasterRequests/",

      "type": "POST",

      "data" : function (d) {

        console.log(d);

      }

    },

    "createdRow": function ( row, data, index ) {

      $table.column(0).nodes().each(function(node,index,dt){

        $table.cell(node).data(index+1);

      });

      if(data['is_approved']==0){

        $('td', row).eq(4).html('<center><button type="button" class="btn btn-warning">Pending</button></center>');

      }

      else if(data['req_status']==1){

        $('td', row).eq(4).html('<center><button type="button" class="btn btn-success">Approved</button></center>');

      }

      else{

        $('td', row).eq(4).html('<center><button type="button" class="btn btn-danger">Rejected</button></center>');

      }

    },

    "columns": [

      { "data": "return_id", "orderable": true },

      { "data": "item_name", "orderable": false },

      { "data": "return_quantity", "orderable": false },

      { "data": "created_at", "orderable": false },

      { "data": "is_approved", "orderable": false },

    ]

  } );

})



function addReturnStockModal(){

  $.ajax({

  url: '<?php echo base_url(); ?>NewCommon/getAllStockItems',

  type: 'post',

  data: {},

  success: function(response){

    var data = JSON.parse(response);

    var dataset = data.data;

    $('#selectItem option').remove();

    var select=document.getElementById("selectItem");

    dataset.forEach((item) => {

      console.log(item.item_name);

      $(select).append('<option value="'+item['item_id']+'">'+item['item_name']+'</option>');

    });

  }

});

  $('#addReturnStockModal').modal('show')

}

</script>


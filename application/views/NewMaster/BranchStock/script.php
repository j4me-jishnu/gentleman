<script>

    $(document).ready(function(){

  $table = $('#Branch_Opening_Stock').DataTable( {

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

      "url": "<?php echo base_url();?>NewMaster/getBranchOpeningStocks/",
      

      //"url": "<?php echo base_url();?>Common/Test/",

      "type": "POST",

      "data" : function (d) {

        //console.log(d);

      }

    },

    "createdRow": function ( row, data, index ) {

      $table.column(0).nodes().each(function(node,index,dt){

        $table.cell(node).data(index+1);

      });

      console.log(data.os_quantity);

    //   if(data['is_approved']==0){

    //     $('td', row).eq(5).html('<center><button type="button" class="btn btn-warning">Pending</button></center>');

    //   }

    //   else if(data['is_approved']==1){

    //     $('td', row).eq(5).html('<center><button type="button" class="btn btn-success">Approved</button></center>');

    //   }

    //   else{

    //     $('td', row).eq(5).html('<center><button type="button" class="btn btn-danger">Rejected</button></center>');

    //   }

      $('td', row).eq(10).html('<center><a onclick="editrequestBtoBModal('+data['os_id']+')"><i class="fa fa-edit iconFontSize-medium" ></i></a>&nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['os_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');

    },

    // "columns": [

    //   { "data": "item_name", "orderable": false },

    //   { "data": "item_name", "orderable": false },

    //   { "data": "os_quantity", "orderable": false },

    //   { "data": "created_at", "orderable": false },

    //   { "data": null, "defaultContent": "" },

    // ]



    "columns": [

      { "data": "item_name", "orderable": false },

      { "data": "branch_name", "orderable": false },

      { "data": "item_name", "orderable": false },

      { "data": "os_quantity", "orderable": false },
      
      { "data": "branch_qty_sum", "orderable": false },

      { "data": "brach_r_qty_sum", "orderable": false },
      
      { "data": "br_total_stck", "orderable": false },

      { "data": "brach_g_qty_sum", "orderable": false },

      { "data": "brach_issue_qty_sum", "orderable": false },

      { "data": "branch_ret_qty_sum", "orderable": false },

      

      { "data": null, "defaultContent": "" },

    ]

  } );

})

function addOpeningStock()

{



$.ajax({

  url: '<?php echo base_url(); ?>NewCommon/getAllStockItems',

  type: 'post',

  data: {},

  success: function(response){

    var data = JSON.parse(response);

    var dataset = data.data;

    // $('#item_list option').remove();

    var select=document.getElementById("Item_lists");

    dataset.forEach((item) => {

      $(select).append('<option value="'+item['item_id']+'">'+item['item_name']+'</option>');

    });

  }

});



    $('#addOpeningStocks').modal('show');

}



function confirmDelete(os_id)

{

  var conf =confirm("Do you want To Delete This Opening Stock?");

  if(conf){

  $.ajax({

  url: '<?php echo base_url(); ?>NewBranch/deleteBranchOpeningStock',

  type: 'post',

  data: {os_id:os_id},

  success: function(response){

    $('#Branch_Opening_Stock').DataTable().ajax.reload();

  }

});

}

}

</script>
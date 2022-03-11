<script>

$(document).ready(function(){
  $('#selectBranch').on('change',function(){
    branch_id=this.value;
  // })
  $table = $('#branchStockTable').DataTable( {
    "processing": true,
    "serverSide": true,
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
          columns: [ 1, 2, 3  ]
        }
      },
      {
        extend: 'excel',
        exportOptions: {
          columns: [ 1, 2, 3  ]
        }
      },
      {
        extend: 'pdf',
        exportOptions: {
          columns: [ 1, 2, 3 ]
        }
      },
      {
        extend: 'print',
        exportOptions: {
          columns: [ 1, 2, 3]
        }
      },
      {
        extend: 'csv',
        exportOptions: {
          columns: [ 1, 2, 3 ]
        }
      },
    ],
    "ajax": {
      "url": "<?php echo base_url();?>NewMaster/getBranchStockFromMaster/",
      "type": "POST",
      data: {
        branch_id:branch_id
      },
      success: function(response){
        console.log(response);
      }
    },
    "createdRow": function ( row, data, index ) {
      $table.column(0).nodes().each(function(node,index,dt){
        $table.cell(node).data(index+1);
      });
      // console.log(data.os_quantity);

      // $('td', row).eq(10).html('<center><a onclick="editrequestBtoBModal('+data['os_id']+')"><i class="fa fa-edit iconFontSize-medium" ></i></a>&nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['os_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
    },
    "columns": [
      { "data": "item_name", "orderable": false },
      { "data": "item_name", "orderable": false },
      { "data": "stock_balance", "orderable": false },
    ]
  } );
});
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

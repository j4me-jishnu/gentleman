<script>
$(document).ready(function(){
  $table = $('#requestTable').DataTable( {
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
          columns: [ 1, 2, 3 , 4 , 5]
        }
      },
      {
        extend: 'excel',
        exportOptions: {
          columns: [ 1, 2, 3 , 4 , 5]
        }
      },
      {
        extend: 'pdf',
        exportOptions: {
          columns: [ 1, 2, 3 , 4 , 5]
        }
      },
      {
        extend: 'print',
        exportOptions: {
          columns: [ 1, 2, 3 , 4 , 5]
        }
      },
      {
        extend: 'csv',
        exportOptions: {
          columns: [ 1, 2, 3 , 4 , 5]
        }
      },
    ],

    "ajax": {
      "url": "<?php echo base_url();?>NewBranch/getMasterStockRequests/",
      "type": "POST",
      "data" : function (d) {
      }
    },

    "createdRow": function ( row, data, index ) {
      $table.column(0).nodes().each(function(node,index,dt){
        $table.cell(node).data(index+1);
      });

      if(data['req_status']!=1 && data['req_status']!=2){
        $('td', row).eq(7).html('<center><button data-id='+data['req_id']+' data-item_id='+data['req_item_id_fk']+' data-branch_id='+data['req_branch_id_fk']+' data-req_qty='+data['req_item_quantity']+' class="btn btn-success" onclick="showApproveModal(this)">Approve</button><button type="button" onclick="openRejectModal('+data['req_id']+')" class="btn btn-danger">Reject</button></center>');
      }
      else
      {
        $('td', row).eq(7).html('<center><button type="button" class="btn btn-success" disabled>Approve</button><button type="button" class="btn btn-danger" disabled>Reject</button></center>');
      }
    },

    "columns": [
      { "data": "created_at", "orderable": false },
      { "data": "item_name", "orderable": false },
      { "data": "req_item_quantity", "orderable": false },
      { "data": "branch_name", "orderable": false },
      { "data": "created_at", "orderable": false },
      {
        "data": "req_status",
        "render": function ( data, type, row ) {
          if(data == 0){
            return '<button class="btn btn-warning">Pending</button>';
          }else if(data == 1){
            return '<button class="btn btn-success">Approved</button>';
          }else{
            return '<button class="btn btn-danger">Rejected</button>';
          }
        }
      },
      {
        "data": "req_remarks",
        "render": function ( data, type, row ) {
          if(data != ""){
            return data;
          }
          else
          {
            return data;
          }
        }
      },
      { "data": null, "defaultContent":"" },
    ]
  } );
})

function showApproveModal(data){
  var req_id=data.getAttribute('data-id');
  var branch_id=data.getAttribute('data-branch_id');
  var item_id=data.getAttribute('data-item_id');
  var request_quantity=data.getAttribute('data-req_qty');
  $.ajax({
    url: '<?php echo base_url(); ?>NewMaster/getCurrentStock',
    type: 'post',
    data: {
      branch_id:branch_id,
      item_id:item_id,
    },
    success: function(response){
      var current_stock = JSON.parse(response);
      $('#request_id').val(req_id);
      $('#request_item_id').val(item_id);
      $('#requested_branch').val(branch_id);
      $('#requested_stock').val(request_quantity);
      $('#avbl_stock').val(current_stock);
      $("#currentStock").html(current_stock);
      $('#requestApprovalModal').modal('show');
    }
  });
}

// function showAddRequestModal(){
//   $.ajax({
//   url: '<?php echo base_url(); ?>NewCommon/getAllStockItems',
//   type: 'post',
//   data: {},
//   success: function(response){
//     var data = JSON.parse(response);
//     var dataset = data.data;
//     $('#selectItem option').remove();
//     var select=document.getElementById("selectItem");
//     dataset.forEach((item) => {
//       //console.log(item.item_name);
//       $(select).append('<option value="'+item['item_id']+'">'+item['item_name']+'</option>');
//     });
//   }
// });
//     $('#requestItemModal').modal('show');
// }
//
//
//
function openRejectModal(req_id){
  $('#hidden_req_id').val(req_id);
  $('#rejectModel').modal('show');
}

// function ajaxApprovals(data)
// {
//   var item_name = data.getAttribute('data-item');
//   var req_qty = data.getAttribute('data-qty');
//   var item_id = data.getAttribute('data-id');
//   var req_id = data.getAttribute('data-item-id');
//
//   $('#item_namedes').val(item_name);
//   $('#req_ttl_stcks').val(req_qty);
//   $('#req_id_').val(req_id);
//
// $.ajax({
//   url: '<?php echo base_url(); ?>NewMaster/ajaxTotalStocks',
//   type: 'post',
//   data: {item_id:item_id},
//   success: function(response){
//     var data = JSON.parse(response);
//     $('#ttl_stck_amt').val(data[0].Total_qty);
//     if(parseInt(req_qty) > parseInt(data[0].Total_qty)){
//       $("#submits").hide();
//     }
//     else
//     {
//       $("#submits").show();
//     }
//   }
// });
//
//   $('#ajaxapprovals').modal('show');
// }

</script>

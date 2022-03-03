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
      "url": "<?php echo base_url();?>NewMaster/getBranchReturnList/",
      'dataSrc':"",
      "type": "POST",
      "data" : function (d) {
        //console.log(d);
      }
    },
    "createdRow": function ( row, data, index ) {
      $table.column(0).nodes().each(function(node,index,dt){
        $table.cell(node).data(index+1);
      });
     if(data['is_approved'] == 0){
    //$('td', row).eq(6).html('<center><a onclick="ajaxApprove('+data['return_id']+')"><button type="button" class="btn btn-success">Approve</button></a><button type="button" onclick="openRejectModal('+data['return_id']+')" class="btn btn-danger">Reject</button></center>');
    $('td', row).eq(6).html('<center><button type="button" class="btn btn-success" onclick="showModal('+data['return_id']+')">Approve</button><button type="button" onclick="openRejectModal('+data['return_id']+')" class="btn btn-danger">Reject</button></center>');
     }
     else{
      $('td', row).eq(6).html('<center><button type="button" class="btn btn-success" disabled>Approve</button><button type="button"class="btn btn-danger" disabled>Reject</button></center>');
     }

    },
    "columns": [
      { "data": "return_status", "orderable": false },
      { "data": "item_name", "orderable": false },
      { "data": "return_quantity", "orderable": false },
      { "data": "branch_name", "orderable": false },
      { "data": "return_remarks", "orderable": false },
      {
            "data": "is_approved",
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
      { "data": null, "defaultContent":"" },

    ]
  } );
})

function showAddRequestModal(){
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
      //console.log(item.item_name);
      $(select).append('<option value="'+item['item_id']+'">'+item['item_name']+'</option>');
    });
  }
});
    $('#requestItemModal').modal('show');
}

function ajaxApprove(return_id)
{
  $.ajax({
  url: '<?php echo base_url(); ?>NewMaster/ajaxapproveBReturn',
  type: 'post',
  data: {return_id:return_id},
  success: function(response){
    var data = JSON.parse(response);
    $('#requestTable').DataTable().ajax.reload();
  }
})
}

function openRejectModal(req_id) {
  $('#hidden_req_id').val(req_id);
  $('#rejectModel').modal('show');
 
}

function showModal(return_id)
{
  $('#accept_req_id').val(return_id);
  $('#accept_modal').modal('show');
}
</script>

<script>
$(document).ready(function(){
  $table = $('#requestTable').DataTable( {
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
          columns: [ 1, 2, 3 , 4 ,5]
        }
      },
      {
        extend: 'excel',
        exportOptions: {
          columns: [ 1, 2, 3 , 4 ,5]
        }
      },
      {
        extend: 'pdf',
        exportOptions: {
          columns: [ 1, 2, 3 , 4 ,5]
        }
      },
      {
        extend: 'print',
        exportOptions: {
          columns: [ 1, 2, 3 , 4 ,5]
        }
      },
      {
        extend: 'csv',
        exportOptions: {
          columns: [ 1, 2, 3 , 4,5 ]
        }
      },
    ],
    "ajax": {
      "url": "<?php echo base_url();?>NewBranch/getBranchStockRequests/",
      "type": "POST",
      "dataSrc":'',
      "data" : function (d) {
        //console.log(d);
      }
    },
    "createdRow": function ( row, data, index ) {
      $table.column(0).nodes().each(function(node,index,dt){
        $table.cell(node).data(index+1);
      });
      if(data['req_status']==0){
        $('td', row).eq(4).html('<center><button type="button" class="btn btn-warning">Pending</button></center>');
      }
      else if(data['req_status']==1){
        $('td', row).eq(4).html('<center><button type="button" class="btn btn-success">Approved</button></center>');
      }
      else{
        $('td', row).eq(4).html('<center><button type="button" class="btn btn-danger">Rejected</button></center>');
      }
      $('td', row).eq(5).html('<center><a onclick="showEditRequest('+data['req_id']+')"><i class="fa fa-edit iconFontSize-medium" ></i></a>&nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['req_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
    },
    "columns": [
      { "data": "item_name", "orderable": false },
      { "data": "item_name", "orderable": false },
      { "data": "req_item_quantity", "orderable": false },
      { "data": "created_at", "orderable": false },
      { "data": "req_status", "orderable": false },
      { "data": "item_name", "orderable": false },
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

      console.log(item.item_name);

      $(select).append('<option value="'+item['item_id']+'">'+item['item_name']+'</option>');

    });

  }

});

    $('#requestItemModal').modal('show');

}



function showEditRequest(req_id) {



  $.ajax({

  url: '<?php echo base_url(); ?>NewBranch/editToStockRequest',

  type: 'post',

  data: {req_id:req_id},

  success: function(response){

    var data = JSON.parse(response);

    //var dataset = data.data;

    console.log(data);

    $('#selectdItem option').remove();

    var select=document.getElementById("selectedItem");



    // data.record.forEach((item) => {

    //   $(select).html('<option value="'+item['item_id']+'">'+item['item_name']+'</option>');

    // });

    $(select).html('<option value="'+data[0].item_id+'">'+data[0].item_name+'</option>');



    $('#item_quantity2').val(data[0].req_item_quantity);

    $('#req_id').val(data[0].req_id);

  },

  error: function (request, status, error) {

    console.log(request.responseText);

  }

});

  $('#editRequsetModal').modal('show');

}



function confirmDelete(req_id)

{

  var conf = confirm("Do you want to Delete this Stock Request ?");

  if(conf){

      $.ajax({

          url:"<?php echo base_url();?>NewBranch/deleteToStockRequest",

          data:{req_id:req_id},

          type:"POST",

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

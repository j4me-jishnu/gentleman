<script type="text/javascript">
$(document).ready(function(){
  $table = $('#branchtobranch_table').DataTable( {
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
      "url": "<?php echo base_url();?>NewBranch/getBranchtoBranchRequests/",
      "type": "POST",
      "data" : function (d) {
      }
    },
    "createdRow": function ( row, data, index ) {
      $table.column(0).nodes().each(function(node,index,dt){
        $table.cell(node).data(index+1);
      });
      if(data['is_approved']==0){
        $('td', row).eq(5).html('<center><button type="button" class="btn btn-warning">Pending</button></center>');
      }
      else if(data['req_status']==1){

        $('td', row).eq(5).html('<center><button type="button" class="btn btn-success">Approved</button></center>');
      }
      else{
        $('td', row).eq(5).html('<center><button type="button" class="btn btn-danger">Rejected</button></center>');

      }

      $('td', row).eq(6).html('<center><a onclick="editrequestBtoBModal('+data['btob_id']+')"><i class="fa fa-edit iconFontSize-medium" ></i></a>&nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['btob_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');

    },

    "columns": [

      { "data": "branch_name", "orderable": false },

      { "data": "branch_name", "orderable": false },

      { "data": "item_name", "orderable": false },

      { "data": "btob_quantity", "orderable": false },

      { "data": "created_at", "orderable": false },

      { "data": "btob_id", "orderable": false },

      { "data": null, "defaultContent": "" },

    ]

  } );

})

// function showBtoBRequestModal(){
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
//       $(select).append('<option value="'+item['item_id']+'">'+item['item_name']+'</option>');
//     });
//   }
// });
//
//   $.ajax({
//   url: '<?php echo base_url(); ?>NewCommon/getAllBranches',
//   type: 'post',
//   data: {},
//   success: function(response){
//     var dataset = data.data;
//     $('#selectBranch option').remove();
//     var select=document.getElementById("selectBranch");
//     dataset.forEach((item) => {
//       $(select).append('<option value="'+item['branch_id']+'">'+item['branch_name']+'</option>');
//     });
//   }
// });
//
//
// $('#requestBtoBModal').modal('show');
//
// }

function showBtoBRequestModal(){
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
        $(select).append('<option value="'+item['item_id']+'">'+item['item_name']+'</option>');
      });
    }
  });

  $.ajax({
    url: '<?php echo base_url(); ?>NewCommon/getAllBranches',
    type: 'post',
    data: {},
    success: function(response){
      var data = JSON.parse(response);
      var dataset = data.data;
      $('#selectBranch option').remove();
      var select=document.getElementById("selectBranch");
      dataset.forEach((item) => {
        $(select).append('<option value="'+item['branch_id']+'">'+item['branch_name']+'</option>');
      });
    }
  });
  $('#requestBtoBModal').modal('show');
}



function editrequestBtoBModal(btob_id) {
  $.ajax({
  url: '<?php echo base_url(); ?>NewCommon/getAllBranches',
  type: 'post',
  data: {},
  success: function(response){
    var data = JSON.parse(response);
    var dataset = data.data;
    $('#selectBranch2 option').remove();
    var branch2=document.getElementById("selectBranch2");
    dataset.forEach((item) => {
      $(branch2).append('<option value="'+item['branch_id']+'">'+item['branch_name']+'</option>');
    });
  }
});
  $.ajax({
  url: '<?php echo base_url(); ?>NewCommon/getAllStockItems',
  type: 'post',

  data: {},

  success: function(response){

    var data = JSON.parse(response);

    var dataset = data.data;

    $('#selectItem2 option').remove();

    var select2=document.getElementById("selectItem2");

    dataset.forEach((item) => {

      $(select2).append('<option value="'+item['item_id']+'">'+item['item_name']+'</option>');

    });

  }

});



  $.ajax({

  url: '<?php echo base_url(); ?>NewCommon/editBtoBrequest',

  type: 'post',

  data: {btob_id:btob_id},

  success: function(response){

    var data = JSON.parse(response);

    //var dataset = data.data;

console.log(data[0].item_id);

console.log(data[0].item_name);

    $('#btob_id2').val(data[0].btob_id);

    $('#item_quantity2').val(data[0].btob_quantity);

    $("#selectBranch2 option[value='"+data[0].branch_id+"']").prop('selected',true);

    $("#selectItem2 option[value='"+data[0].item_id+"']").prop('selected',true);



    //$('#selectItem option').remove();

    // var select=document.getElementById("selectItem");

    // data.forEach((item) => {

    //   $(select).append('<option value="'+item['item_id']+'">'+item['item_name']+'</option>');

    // });

  }

});



  $('#editrequestBtoBModal').modal('show');

}



function confirmDelete(btob_id)

{

  var conf =confirm("Do you want To Delete This Branch to Branch Request");

  if(conf){

  $.ajax({

  url: '<?php echo base_url(); ?>NewBranch/deleteBtoBRequest',

  type: 'post',

  data: {btob_id:btob_id},

  success: function(response){
    $('#branchtobranch_table').DataTable().ajax.reload();
  }

});

}

}
</script>

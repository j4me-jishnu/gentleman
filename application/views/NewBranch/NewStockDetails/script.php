<script>
    $(document).ready(function(){
//   $table = $('#Branch_Opening_Stock').DataTable( {
//     "processing": true,
//     "serverSide": true,
//     "bDestroy" : true,
//     dom: 'lBfrtip',
//     buttons: [
//       {
//         extend: 'copy',
//         exportOptions: {
//           columns: [ 1, 2, 3 , 4 ]
//         }
//       },
//       {
//         extend: 'excel',
//         exportOptions: {
//           columns: [ 1, 2, 3 , 4 ]
//         }
//       },
//       {
//         extend: 'pdf',
//         exportOptions: {
//           columns: [ 1, 2, 3 , 4 ]
//         }
//       },
//       {
//         extend: 'print',
//         exportOptions: {
//           columns: [ 1, 2, 3 , 4 ]
//         }
//       },
//       {
//         extend: 'csv',
//         exportOptions: {
//           columns: [ 1, 2, 3 , 4 ]
//         }
//       },
//     ],
    
//   } );
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
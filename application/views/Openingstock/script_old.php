<script>
var param = '';
var $itemList=[ {'columnName':'item_name','label':'Item'}];
$('#item_name').rcm_autoComplete('<?php echo base_url();?>common/getItemList',$itemList,param,getItemName);
function getItemName(el,event,item)
{
  console.log(el);
  console.log(el.next());
  if(item.item_id)
  {
    el.val(item.item_name);
    $("#item_id").val(item.item_id);
  }
}
var response = $("#response").val();
if(response){
  console.log(response,'response');
  var options = $.parseJSON(response);
  noty(options);
}
$table1 = $('#Stock_table').DataTable( {
  "processing": true,
  "serverSide": true,
  "paging": true,
  "bDestroy" : true,
  dom: 'lBfrtip',
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
    "url": "<?php echo base_url();?>Openigstock/getOpeningMaster/",
    "type": "POST",
    "data" : function (d) {
      d.start_date = $("#pmsDateStart").val();
      d.end_date = $("#pmsDateEnd").val();

    }
  },
  "createdRow": function ( row, data, index ) {

    $table1.column(0).nodes().each(function(node,index,dt){
      $table1.cell(node).data(index+1);
    });

    // Line to add a new colum for edit
    // $('td', row).eq(3).html('<center><a href="<?php echo base_url();?>openigstock/openingStockEdit"><i class="fa fa-edit iconFontSize-medium" ></i></a></center>');

  },
  "columns": [
    {"data": "empty", "defaultContent": ''},
    { "data": "item_name", "orderable": false },
    { "data": "remaining_qty", "orderable": false },
    { "data": "pr_id", "orderable": false },


  ]
} );

$table = $('#Branch_table').DataTable( {
  "processing": false,
  "serverSide": true,
  "paging": true,
  "bDestroy" : true,
  dom: 'lBfrtip',
  buttons: [
    {
      extend: 'copy',
      exportOptions: {
        columns: [ 1, 2, 3 ,4]
      }
    },
    {
      extend: 'excel',
      exportOptions: {
        columns: [ 1, 2, 3 ]
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
        columns: [ 1, 2, 3 ]
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
    "url": "<?php echo base_url();?>Openigstock/getOpeningBranch/",
    "type": "POST",
    "data" : function (d) {


      d.start_date = $("#pmsDateStart").val();
      d.end_date = $("#pmsDateEnd").val();

    }
  },
  "createdRow": function ( row, data, index ) {

    $table.column(0).nodes().each(function(node,index,dt){
      $table.cell(node).data(index+1);
    });


  },

  "columns": [
    { "data": "total", "orderable": true },
    { "data": "item_name", "orderable": false },
    { "data": "branch_name", "orderable": false },
    { "data": "total", "orderable": false }

  ]
} );

//     $table = $('#Close_table').DataTable( {
//         "processing": true,
//         "serverSide": true,
//         "paging": false,
//         "bDestroy" : true,
//         dom: 'lBfrtip',
// 			buttons: [
// 				{
// 					extend: 'copy',
// 					exportOptions: {
// 						columns: [ 1, 2]
// 					}
// 				},
// 				{
// 					extend: 'excel',
// 					exportOptions: {
// 						columns: [ 1, 2]
// 					}
// 				},
// 				{
// 					extend: 'pdf',
// 					exportOptions: {
// 						columns: [ 1, 2]
// 					}
// 				},
// 				{
// 					extend: 'print',
// 					exportOptions: {
// 						columns: [ 1, 2]
// 					}
// 				},
// 				{
// 					extend: 'csv',
// 					exportOptions: {
// 						columns: [ 1, 2]
// 					}
// 				},
// 			],
//         "ajax": {
//             "url": "<?php echo base_url();?>openigstock/getClosingMaster/",
//             "type": "POST",
//             "data" : function (d) {


//             d.start_date = $("#pmsDateStart").val();
// 			d.end_date = $("#pmsDateEnd").val();

//            }
//         },
//        "createdRow": function ( row, data, index ) {

// 			// $table.column(0).nodes().each(function(node,index,dt){
//    //          $table.cell(node).data(index+1);
//    //          });


// 		},


//         "columns": [
//             // { "data": "pr_id", "orderable": true },
//             { "data": "item_name", "orderable": false },
//             { "data": "remaining_qty", "orderable": false }

// 		]
//     } );


//     $table = $('#Branch_closetable').DataTable( {
//         "processing": false,
//         "serverSide": true,
//         "paging": false,
//         "bDestroy" : true,
//         dom: 'lBfrtip',
// 			buttons: [
// 				{
// 					extend: 'copy',
// 					exportOptions: {
// 						columns: [ 1, 2, 3 ]
// 					}
// 				},
// 				{
// 					extend: 'excel',
// 					exportOptions: {
// 						columns: [ 1, 2, 3 ]
// 					}
// 				},
// 				{
// 					extend: 'pdf',
// 					exportOptions: {
// 						columns: [ 1, 2, 3 ]
// 					}
// 				},
// 				{
// 					extend: 'print',
// 					exportOptions: {
// 						columns: [ 1, 2, 3 ]
// 					}
// 				},
// 				{
// 					extend: 'csv',
// 					exportOptions: {
// 						columns: [ 1, 2, 3 ]
// 					}
// 				},
// 			],
//         "ajax": {
//             "url": "<?php echo base_url();?>openigstock/getClosingBranch/",
//             "type": "POST",
//             "data" : function (d) {


//             d.start_date = $("#pmsDateStart").val();
// 			d.end_date = $("#pmsDateEnd").val();

//            }
//         },
//         "createdRow": function ( row, data, index ) {

// 			// $table.column(0).nodes().each(function(node,index,dt){
//    //          $table.cell(node).data(index+1);
//    //          });


// 		},

//         "columns": [
//             // { "data": "item_name", "orderable": true },
//             { "data": "item_name", "orderable": false },
//             { "data": "branch_name", "orderable": false },
//             { "data": "total", "orderable": false }

// 		]
//     } );

$('#search').click(function () {
  var table = $('#Stock_table').DataTable();
  var table1 = $('#Branch_table').DataTable();
  var table2 = $('#Close_table').DataTable();
  var table3 = $('#Branch_closetable').DataTable();
  table.ajax.reload();
  table1.ajax.reload();
  table2.ajax.reload();
  table3.ajax.reload();
});

/* Function to get stock item count curresponding to stock items for each branches */
$("#item_name").on("keyup",function get_data(){
  var branch = document.getElementById('branch').value;
  var item = document.getElementById('item_name').value;
  if(branch=="" || item==""){
    alert('Please select mandatory fields');
  }
  $.ajax({
    url:"<?php echo base_url()?>Openigstock/getOpeningStock",
    type: 'POST',
    data: {branch_id:branch, item_id:item},
    dataType: 'json',
    success:function(data){
      // console.log(data.os_history.data);
      var count = data.sum_of_item_quantity;
      document.getElementById("current_stock").innerHTML=count;

      $('#OpeningStockHistory').DataTable({
        data: data.os_history.data,
        "createdRow": function ( row, data, index ) {
          $('td', row).eq(3).html('<center><a href="#"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['item_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
        },
        columns: [
          {'data':'item_name'},
          {'data':'item_quantity','render': function(data, type, full, meta){return "<input type='text' value="+data+"></input>"}},
          {'data':'date'},
          {'data':'date'},
        ],
      });


    },
    error:function(e){
      console.log("error");
    }
  });

});
// --------------------------------------------------------------

</script>

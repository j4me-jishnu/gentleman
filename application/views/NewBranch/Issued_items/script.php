<script>

    $(document).ready(function(){

  $table = $('#issued_table').DataTable( {

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

      "url": "<?php echo base_url();?>NewBranch/getIssuedList/",
      
      // 'dataSrc':"",

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

        $('td', row).eq(5).html('<center><button type="button" class="btn btn-warning">Pending</button></center>');

      }

      else if(data['is_approved']==1){

        $('td', row).eq(5).html('<center><button type="button" class="btn btn-success">Approved</button></center>');

      }

      else{

        $('td', row).eq(5).html('<center><button type="button" class="btn btn-danger">Rejected</button></center>');

      }

      $('td', row).eq(6).html('<center><a onclick="editrequestBtoBModal('+data['issued_id']+')"><i class="fa fa-edit iconFontSize-medium" ></i></a>&nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['issued_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');

    },

    "columns": [

      { "data": "emp_name", "orderable": false },

      { "data": "emp_name", "orderable": false },

      { "data": "item_name", "orderable": false },

      { "data": "issued_quantity", "orderable": false },

      { "data": "created_at", "orderable": false },

      { "data": "issued_id", "orderable": false },

      { "data": null, "defaultContent": "" },

    ]

  } );

})

function addIssuedStock()

{



$.ajax({

  url: '<?php echo base_url(); ?>NewCommon/getAllStockItems',

  type: 'post',

  data: {},

  success: function(response){

    var data = JSON.parse(response);

    var dataset = data.data;

    // $('#item_list option').remove();

    var select=document.getElementById("item_list");

    dataset.forEach((item) => {

      $(select).append('<option value="'+item['item_id']+'">'+item['item_name']+'</option>');

    });

  }

});



$.ajax({

  url: '<?php echo base_url(); ?>NewCommon/getAllBranchEmployees',

  type: 'post',

  data: {},

  success: function(response){

    var data = JSON.parse(response);

    var dataset = data.data;

    // $('#item_list option').remove();

    var emp=document.getElementById("emp_list");

    dataset.forEach((emp_lists) => {

      $(emp).append('<option value="'+emp_lists['emp_id']+'">'+emp_lists['emp_name']+'</option>');

    });

  }

});

    $('#addIssuedStock').modal('show');

}



function confirmDelete(issued_id)

{

  var conf =confirm("Do you want To Delete This Issued Stock Item?");

  if(conf){

  $.ajax({

  url: '<?php echo base_url(); ?>NewBranch/deleteIssuedStock',

  type: 'post',

  data: {issued_id:issued_id},

  success: function(response){

    $('#issued_table').DataTable().ajax.reload();

  }

});

}

}

</script>
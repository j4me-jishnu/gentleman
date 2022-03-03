<script type="text/javascript">

  function showAddEmployeeModal(){

    $('#addEmployeeModal').modal('show');

  }

  $table = $('#branch_table').DataTable( {

    "processing": true,

    "serverSide": false,

    "bDestroy" : true,

    dom: 'lBfrtip',

    buttons: [

      {

        extend: 'copy',

        exportOptions: {

          columns: [ 1, 2 ]

        }

      },

      {

        extend: 'excel',

        exportOptions: {

          columns: [ 1, 2 ]

        }

      },

      {

        extend: 'pdf',

        exportOptions: {

          columns: [ 1, 2 ]

        }

      },

      {

        extend: 'print',

        exportOptions: {

          columns: [ 1, 2 ]

        }

      },

      {

        extend: 'csv',

        exportOptions: {

          columns: [ 1, 2 ]

        }

      },

    ],

    "ajax": {

      "url": "<?php echo base_url();?>Dash_board/branchROplist/",

    //   "dataSrc":"",

      "type": "POST",

      "data" : function (d) {

        //console.log(d);

      }

    },

    "createdRow": function ( row, data, index ) {

      $table.column(0).nodes().each(function(node,index,dt){

        $table.cell(node).data(index+1);

      });

      // $('td', row).eq(2).html('<center><a onclick="editModal(this)" data-name="'+data['emp_name']+'" data-id="'+data['emp_id']+'"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;<a onclick="confirmDelete('+data['emp_id']+')"><i class="fa fa-trash"></i></a></center>');

    },

    "columns": [

      { "data": "item_name", "orderable": false },

      { "data": "item_name", "orderable": false },

      { "data": "rop_branch_ROP", "orderable": false },

      { 
            "data": "br_rop_stat",                   
            "render": function ( data, type, row ) {
                if(data == 1){
                    return '<button class="btn btn-success btn-sm">Available</button>';
                }else if(data == 2){
                    return '<button class="btn btn-warning btn-sm">Below ROP</button>';
                }else if(data == 0){
                    return '<button class="btn btn-danger btn-sm">No Stock</button>';
                }
            }
        },

    ]

  } );



  function confirmDelete(emp_id){

    var conf = confirm("Do you want to Delete Employee ?");

    if(conf){

        $.ajax({

            url:"<?php echo base_url();?>NewBranch/deleteEmployee",

            data:{emp_id:emp_id},

            method:"POST",

            datatype:"json",

            success:function(data){

                var options = $.parseJSON(data);

                noty(options);

                //$table.ajax.reload();

                $('#branch_table').DataTable().ajax.reload()

            }

        });



    }

	}

  function editModal(data) {

    var id = data.getAttribute('data-id');

    var name = data.getAttribute('data-name');

    console.log(name);

    $('#emp_ides').val(id);

    $('#emp_names').val(name);

    $('#editMOdals').modal('show');

  }

</script>


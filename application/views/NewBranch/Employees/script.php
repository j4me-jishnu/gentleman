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

      "url": "<?php echo base_url();?>NewBranch/getEmployeeList/",

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

      { "data": "emp_status", "orderable": false },

      { "data": "emp_name", "orderable": false },

      { "data": "branch_name", "orderable": false },

      { "data": "desg_name", "orderable": false },

      { "data": "emp_address", "orderable": false },

      { "data": "emp_phone_no", "orderable": false },

      { "data": "emp_email", "orderable": false },

      // { "data": "emp_id", "orderable": true },

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


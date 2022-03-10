<script type="text/javascript">
  $(document).ready(function(){
    $table = $('#items_table').DataTable( {
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
        "url": "<?php echo base_url();?>NewMaster/getItemList/",
        'dataSrc':"",
        "type": "POST",
        "data" : function (d) {

        }
      },
      "createdRow": function ( row, data, index ) {

        $table.column(0).nodes().each(function(node,index,dt){
          $table.cell(node).data(index+1);
        });
        // $('td', row).eq(2).html('<center><?php $u = $this->session->userdata('user_type'); if($u != 'S'){ ?><a href="<?php echo base_url();?>NewMaster/editDesignation/'+data['desg_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['desg_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a><?php } ?></center>');
      },

      "columns": [
        { "data": "item_status", "orderable": true },
        { "data": "item_name", "orderable": false },
        { "data": "cate_name", "defaultContent":""},
      ]
    } );
  });

  function showAddItemModal(){
    $('#addItemModal').modal('show');
  }
</script>

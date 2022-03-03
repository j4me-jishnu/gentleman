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



    $table = $('#rop_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
         dom: 'lBfrtip',
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
            columns: [ 1, 2, 3]
          }
        },
      ],

      "ajax": {
            "url": "<?php echo base_url();?>SetMasterBenchmark/get",
            "type": "POST",
            "data" : function (d) {
            
           }
        },
        "createdRow": function ( row, data, index ) {
          
      $table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
            $('td', row).eq(6).html('<center><a href="<?php echo base_url();?>SetMasterBenchmark/edit/'+data['id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a></center>');   
         },

        "columns": [
            { "data": "id", "orderable": true },
            { "data": "branch_name", "orderable": false },
            { "data": "item_name", "orderable": false },
            { "data": "benchmark", "orderable": false },
            { "data": "initial_date", "orderable": false },
            { "data": "final_date", "orderable": false },
             { "data": "final_date", "orderable": false }
            
        ]
        
    } );
    
    
  });


    

</script>
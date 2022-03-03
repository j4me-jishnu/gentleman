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
	$table = $('#Stock_table').DataTable( {
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
            "url": "<?php echo base_url();?>Itemissue/get/",
            "type": "POST",
            "data" : function (d) {
            
           }
        },
        "createdRow": function ( row, data, index ) {
          
			$table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
			
			$('td', row).eq(5).html('<center><a href="<?php echo base_url();?>Itemissue/edit/'+data['stock_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a>&nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['stock_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
		},

        "columns": [
            { "data": "stock_status", "orderable": true },
            { "data": "item_name", "orderable": false },
            { "data": "branch_name", "orderable": false },
            { "data": "issued", "orderable": false },
			{ "data": "item_rop", "orderable": false },
            { "data": "stock_id", "orderable": false }
		]
    } ); 
	function confirmDelete(stock_id){
    var conf = confirm("Do you want to Delete Stock ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>Itemissue/delete",
            data:{stock_id:stock_id},
            method:"POST",
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
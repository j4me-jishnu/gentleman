<script>
var param = '';
  var $nameList=[ {'columnName':'username','label':'Name'}];
  $('#emp_name').rcm_autoComplete('<?php echo base_url();?>common/getEmployeeList',$nameList,param,getEmplyeName);
  function getEmplyeName(el,event,item)
   {
       console.log(el);
       console.log(el.next());
       if(item.user_id)
	    {
            el.val(item.username);
			$("#userid").val(item.user_id).change();
		}
    }						
$(document).on('change','#itemid',function(){
	var itemid = $(this).val();
	if(itemid!=''){
    $.ajax({ 
                url:"<?php echo base_url()?>Branch_to_branch/checkstock",
                type: 'POST',
                data: {itemid:itemid},
                dataType: 'json',
                success: function(data){
                  var a=parseFloat(data['total']) - parseFloat(data['total_qty']);
					        $('#avail').html(a);
                  $('#avai').val(a);
					        $('#available').show();
				      },
                error:function(e){
                console.log("error");
              }
            });
    }
});

$(document).on('change','#quantity',function(){
  var quantity = parseFloat($(this).val());
  console.log(quantity.val());
  var avialable = parseFloat($('#avail').html());
  console.log('quantity',quantity);
  console.log('availaaaa',avialable);
  if(quantity >= avialable || quantity <= 0)
  {
      var options1 = {
        'title': 'Error',
        'style': 'error',
        'message': 'Input Below or equal Available...!',
        'icon': 'warning',
      };
      var n1 = new notify(options1);
      n1.show();
      setTimeout(function(){  
        n1.hide();
      }, 3000);
      $('#quantity').val('');
  }
});   		
$(document).on('change','#quantity',function(){
    var q = $(this).val();
    var itemid = $('#itemid').val();
    if(itemid=='')
    {
        var options1 = {
			'title': 'Error',
			'style': 'error',
			'message': 'Please Select Item....!',
			'icon': 'warning',
			};
			var n1 = new notify(options1);
                        n1.show();
			setTimeout(function(){  
			n1.hide();
		   }, 3000);
        $('#quantity').val('');           
    }
    else if(q!=''){
    $.ajax({ 
                url:"<?php echo base_url()?>issueitem/checkstock",
                type: 'POST',
                data: {itemid:itemid},
                dataType: 'json',
                success:
                function(data)
                {
                  // console.log(data);
                  alert(data);
                     if(parseFloat(q) >= data['issuedqua'])
                     {
                        var options1 = {
						'title': 'Error',
						'style': 'error',
						'message': 'Input Below or equal Available....!',
						'icon': 'warning',
						};
						var n1 = new notify(options1);
									n1.show();
						setTimeout(function(){  
						n1.hide();
						}, 3000);
                        $('#quantity').val('');
                     }
                     
                },
                error:function(e){
                console.log("error");
              }
            });
    }
});   
$('#date').datepicker({
  autoclose: true,
  format: 'dd/mm/yyyy'
});
var response = $("#response").val();
  if(response){
      console.log(response,'response');
      var options = $.parseJSON(response);
      noty(options);
	}
	$table = $('#issue_table').DataTable( {
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
            "url": "<?php echo base_url();?>Return_item/get/",
            "type": "POST",
            "data" : function (d) {
            
           }
        },
        "createdRow": function ( row, data, index ) {
          
			$table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
		
		},

        "columns": [
            { "data": "status", "orderable": true },
            { "data": "return_date", "orderable": false },
            { "data": "item_name", "orderable": false },
            { "data": "item_quantity", "orderable": false },
            { "data": "return_reason", "orderable": false },
            { "data": "return_comment", "orderable": false }
           
            
        ]
    } );

  function confirmDelete(return_id){
    var conf = confirm("Do you want to Delete Return Details ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>Return_item/delete",
            data:{return_id:return_id},
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
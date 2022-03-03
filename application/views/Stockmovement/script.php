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
// $(document).on('change','#itemid',function(){
// 	var itemid = $(this).val();
//   var branchid = $("#branchid").val();
// 	if(itemid!=''){
//     $.ajax({ 
//                 url:"<?php echo base_url();?>Stockmovement/checkstock",
//                 type: 'POST',
//                 data: {itemid:itemid,branchid:branchid},
//                 dataType: 'json',
//                 success:
//                 function(data)
//                 {
// 					$('#avail').html(data['remaining_qty']);
// 					$('#available').show();
//           $('#sum').val(data['sum']);
//           $('#benchmark').val(data['benchmark']);
// 				},
//                 error:function(e){
//                 console.log("error");
//               }
//             });
//     }
// });
$(document).on('change','#itemid',function(){
  var itemid = $(this).val();
  if(itemid!=''){
    $.ajax({ 
                url:"<?php echo base_url()?>Stockmovement/checkstock",
                type: 'POST',
                data: {itemid:itemid},
                dataType: 'json',
                success:
                function(data)
                {
                  console.log(data);
          $('#avail').html(data);
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
  var avialable = parseFloat($('#avail').html());
  var sum = parseFloat($('#sum').val());
  var benchmark = parseFloat($('#benchmark').val());
  var sum1=sum+quantity;
  console.log('quantity',quantity);
  console.log('availaaaa',avialable);
  console.log('sum',sum);
  console.log('benchmark',benchmark);
  if(quantity >= avialable || quantity <= 0)
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

  else if(benchmark !=0 && sum1>benchmark)
  {
     var options1 = {
        'title': 'Error',
        'style': 'error',
        'message': 'Input Exceeds the Benchmark...!',
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
            "url": "<?php echo base_url();?>issueitem/get/",
            "type": "POST",
            "data" : function (d) {
            
           }
        },
        "createdRow": function ( row, data, index ) {
          
			$table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
			//$('td', row).eq(5).html('<center><a href="<?php echo base_url();?>issueitem/edit/'+data['issue_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['issue_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
		},

        "columns": [
            { "data": "issue_status", "orderable": true },
            { "data": "issuedate", "orderable": false },
            { "data": "username", "orderable": false },
            { "data": "item_name", "orderable": false },
            { "data": "issue_quantity", "orderable": false }
           // { "data": "issue_id", "orderable": false }
            
        ]
    } );
</script>
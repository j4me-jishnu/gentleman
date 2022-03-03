<script>
$(document).ready(function() {
$("form").submit(function(e){
	var itemid = $('#itemid').val();
	var userid = $("#userid").val();
    if(itemid=='' && userid!='')
    {

        e.preventDefault(e);

        var options1 = {
        'title': 'Error',
        'style': 'error',
        'message': 'Paper Roll not found in stock....!',
        'icon': 'warning',
        };
        var n1 = new notify(options1);

        n1.show();
        setTimeout(function(){  
        n1.hide();
       }, 3000);
    }
   else
    {

    }

});
});
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
$(document).on('change','#userid',function(){
	var userid = $(this).val();
	var itemid = $('#itemid').val();
	if(userid!='' && itemid!='')
	{
		$.ajax({ 
                url:"<?php echo base_url()?>Issueroll/getPrevious",
                type: 'POST',
                data: {itemid:itemid,userid:userid},
                dataType: 'json',
                success:
                function(data)
                {
					var lgn = data.length;
					if(lgn>0)
					{
						$("#previous").find("tr:gt(0)").remove();
						$("#prvs").show();
						for(var i=0; i<lgn; i++)
						{
							var j = i+1;
							$('#previous tr:last').after('<tr><td>'+j+'</td><td>'+data[i]['issdate']+'</td><td>'+data[i]['roll_quantity']+'</td><td>'+data[i]['ticket_count']+'</td></tr>');
						}
					}
				},
                error:function(e){
                console.log("error");
              }
            });
	}
});	
$(document).on('change','#itemid',function(){
	var itemid = $(this).val();
	if(itemid!=''){
    $.ajax({ 
                url:"<?php echo base_url()?>issueitem/checkstock",
                type: 'POST',
                data: {itemid:itemid},
                dataType: 'json',
                success:
                function(data)
                {
					$('#avail').html(data['issuedqua']);
					$('#available').show();
				},
                error:function(e){
                console.log("error");
              }
            });
    }
});		
$(document).on('change','#quantity',function(){
    var q = $(this).val();
    var itemid = $('#itemid').val();
   
    if(q!=''){
    $.ajax({ 
                url:"<?php echo base_url()?>issueitem/checkstock",
                type: 'POST',
                data: {itemid:itemid},
                dataType: 'json',
                success:
                function(data)
                {
					
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
            "url": "<?php echo base_url();?>issueroll/get/",
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
            { "data": "roll_quantity", "orderable": false }
           // { "data": "issue_id", "orderable": false }
            
        ]
    } );
</script>
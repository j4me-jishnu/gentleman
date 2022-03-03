<script>
  
	$(function () {
	//Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Date picker
    $('#date').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy'
    });
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
	//Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    $table = $('#issue_table').DataTable( {
		"searching": false,
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        	
        "ajax": {
            "url": "<?php echo base_url();?>userwise_conception_report/get/",
            "type": "POST",
            "data" : function (d) {
            d.user_id = $("#user_id").val();
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
            { "data": "issue_status", "orderable": true },
            { "data": "item_name", "orderable": false },
            { "data": "issue_quantity", "orderable": false },
            { "data": "issue_date", "orderable": false }
            
        ]
    } );
	$table1 = $('#used_table').DataTable( {
		"searching": false,
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        	
        "ajax": {
            "url": "<?php echo base_url();?>userwise_conception_report/getu/",
            "type": "POST",
            "data" : function (d) {
            d.user_id = $("#user_id").val();
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
            { "data": "usage_status", "orderable": true },
            { "data": "item_name", "orderable": false },
            { "data": "usage_quantity", "orderable": false },
            { "data": "usage_date", "orderable": false }
            
        ]
    } );
	$table2 = $('#return_table').DataTable( {
		"searching": false,
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        	
        "ajax": {
            "url": "<?php echo base_url();?>userwise_conception_report/getur/",
            "type": "POST",
            "data" : function (d) {
            d.user_id = $("#user_id").val();
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
            { "data": "return_status", "orderable": true },
            { "data": "item_name", "orderable": false },
            { "data": "item_quantity", "orderable": false },
            { "data": "return_date", "orderable": false },
			{ "data": "return_narration", "orderable": false }
            
        ]
    } );
});
var param = '';
  var $customerList=[ {'columnName':'username','label':'Name'}];
  $('#user_name').rcm_autoComplete('<?php echo base_url();?>common/getCustomerList',$customerList,param,getCustomerName);
  function getCustomerName(el,event,item)
   {
	   console.log(el);
       console.log(el.next());
	   if(item.user_id)
	    {
			$('.tableRow').remove();
            el.val(item.username);
			var user_id = item.user_id;
			$("#user_id").val(user_id);
			$table2.ajax.reload();
			$table1.ajax.reload();
			$table.ajax.reload();
			$.ajax({ 
			  url:"<?php echo base_url()?>Userwise_conception_report/get_designation",
			  type: 'POST',
			  data: {user_id:user_id},
			  dataType: 'json',
			  success:
			  function(data)
			  {
				$("#name").html(data['username']);
				$("#desi").html(data['designation']);
				$("#branch").html(data['branch_name']);
				$("#address").html(data['user_address']);
				$("#phone").html(data['user_phone']);
				$("#email").html(data['user_email']);
				
			  },
			  error:function(e){
			  console.log("error");
			}
			});
	
		}
    }

	$('#search').click(function () {
        $table.ajax.reload();
		$table1.ajax.reload();
		$table2.ajax.reload();
	});
</script>
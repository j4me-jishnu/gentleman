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
			$("#userid").val(item.user_id);
		}
    }
$(document).on('change','#item_quantity',function(){
	var qua = $(this).val();
	var issue_ck = $('#issue_ck').val();
	var used_ck = $('#used_ck').val();
	if(issue_ck==0)
	{
		var options1 = {
			'title': 'Error',
			'style': 'error',
			'message': 'This item not issued....!',
			'icon': 'warning',
			};
			var n1 = new notify(options1);
			n1.show();
			setTimeout(function(){  
			n1.hide();
		}, 3000);
		$('#itemid').val('');
		$('#userid').val('');
		$('#item_quantity').val('');
	}
	else{
		var bal = parseFloat(issue_ck) -  parseFloat(used_ck);
		if(qua > bal)
		{
			var options1 = {
			'title': 'Error',
			'style': 'error',
			'message': 'Quantity Higherthan Balance....!',
			'icon': 'warning',
			};
			var n1 = new notify(options1);
			n1.show();
			setTimeout(function(){  
			n1.hide();
			}, 3000);
			$('#item_quantity').val('');
		}
	}
	
});
$("input:checkbox").on('click', function() {
	  var ret = $(this).val();
	  if(ret==2){$('#addcolour').modal();}
	  var $box = $(this);
	  if ($box.is(":checked")) {
	  var group = "input:checkbox[name='" + $box.attr("name") + "']";
	  $(group).prop("checked", false);
	  $box.prop("checked", true);
	  } else {
		$box.prop("checked", false);
	  }
});
function colourmodalclose()
{
$('#addcolour').modal('hide');
}
$('#date').datepicker({
  autoclose: true,
  format: 'dd/mm/yyyy'
});	
$(document).on('change','#itemid',function(){
    var q = $(this).val();
    var userid = $('#userid').val();
    if(userid=='')
    {
        var options1 = {
			'title': 'Error',
			'style': 'error',
			'message': 'Please Select UserName First....!',
			'icon': 'warning',
			};
			var n1 = new notify(options1);
                        n1.show();
			setTimeout(function(){  
			n1.hide();
		   }, 3000);
        $('#itemid').val('');        
    }
    else if(q!=''){
    $.ajax({ 
                url:"<?php echo base_url()?>updateusage/checkissue",
                type: 'POST',
                data: {itemid:q,userid:userid},
                dataType: 'json',
                success:
                function(data)
                {
					if(data[0]['issued'])
					{
					 $('#issue_ck').val(data[0]['issued']);
					}
					else{
					 $('#issue_ck').val(0);
					}
					
					$.ajax({ 
							url:"<?php echo base_url()?>updateusage/returned",
							type: 'POST',
							data: {itemid:q,userid:userid},
							dataType: 'json',
							success:
							function(data)
							{
								if(data[0]['returned'])
								{
								$('#returned').val(data[0]['returned']);	
								}
								else{
								$('#returned').val(0);
								}
								var issue_ck = $('#issue_ck').val();
								var returned = $('#returned').val();
								var d = parseFloat(issue_ck) - parseFloat(returned);
								$('#iss').html(d); $('#issue_ck').val(d);
								$('#issued').show(); 
							},
							error:function(e){
							console.log("error");
						}
					});
					
                },
                error:function(e){
                console.log("error");
			}
		});
		
		$.ajax({ 
                url:"<?php echo base_url()?>updateusage/checkuse",
                type: 'POST',
                data: {itemid:q,userid:userid},
                dataType: 'json',
                success:
                function(data)
                {
					if(data[0]['used'])
					{
					 $('#use').html(data[0]['used']); $('#used_ck').val(data[0]['used']);
					}
					else{
					 $('#use').html(0); $('#used_ck').val(0);
					}
					 $('#used').show(); 
                },
                error:function(e){
                console.log("error");
			}
		});
    }
});  
  
</script>
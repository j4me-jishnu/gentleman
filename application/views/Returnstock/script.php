<script>
  $table = $('#stocktable').DataTable( {
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        dom: 'lBfrtip',
			buttons: [
				{
					extend: 'copy',
					exportOptions: {
						columns: [ 1, 2, 3 , 4 , 5]
					}
				},
				{
					extend: 'excel',
					exportOptions: {
						columns: [ 1, 2, 3 , 4 , 5]
					}
				},
				{
					extend: 'pdf',
					exportOptions: {
						columns: [ 1, 2, 3 , 4 , 5]
					}
				},
				{
					extend: 'print',
					exportOptions: {
						columns: [ 1, 2, 3 , 4 , 5]
					}
				},
				{
					extend: 'csv',
					exportOptions: {
						columns: [ 1, 2, 3 , 4 , 5]
					}
				},
			],
        "ajax": {
            "url": "<?php echo base_url();?>Returnstock/getreturn/",
            "type": "POST",
            "data" : function (d) {
            d.branch = $("#branch").val();
            }
        },
        "createdRow": function ( row, data, index ) {

			$table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
			// var rop = data['item_rop'];
			// 	rop = parseFloat(rop);
			// var issuedqua = data['total'];
			// if(issuedqua < rop)
			// {
			// let link = '';
			console.log(data);

			if (data['return_to_master'] == 1) {
				$('td', row).eq(6).html('<center> <a onclick=" checkism('+data['return_id']+')">&nbsp;&nbsp;Issue to masterstock &nbsp;&nbsp;&nbsp;</a><div id="ism"></center>');
			}

			else if(data['return_to_vendor'] == 1) {
				$('td', row).eq(6).html('<center>Product returned</center>');
			}
			else{

				if(data['return_reason'] == 'scrap')
				{

					$('td', row).eq(6).html('<center><?php $u = $this->session->userdata('user_type');  ?><a onclick="return branches('+data['return_id']+','+data['item_quantity']+','+data['branch_id_fk']+','+data['item_id_fk']+','+data['return_date']+')"><button type="button" class="btn btn-block btn">Issue To Master</button></a><br/><a target="_blank" href="<?php echo base_url();?>Returnstock/updateScrapReturn/'+data['return_id']+'"><font color="red">Scrap</font></a></center>');
				// $('td', row).eq(6).html('<center><a target="_blank" href="<?php echo base_url();?>Returnstock/updateToMaster/'+data['return_id']+'">Issue to master Stock</a><br/><a target="_blank" href="<?php echo base_url();?>Returnstock/updateToReturn/'+data['return_id']+'"><font color="red">Return</font></a></center>');
				}
				else{
					$('td', row).eq(6).html('<center><?php $u = $this->session->userdata('user_type');  ?><a target="_blank" href="<?php echo base_url();?>Returnstock/updateToMaster/'+data['return_id']+'">Issue to master stock</a><br/><a target="_blank" href="<?php echo base_url();?>Returnstock/updateToReturn/'+data['return_id']+'"><font color="red">Return</font></a></center>');
				}

			}
			// }
			// else if(issuedqua <= 0)
			// {
			// $('td',row).eq(7).html('<center><button class="btn btn-block btn-danger btn-xs">Out Of Stock</button></center>');
			// }
			// else if(issuedqua >= rop)
			// {
			// $('td',row).eq(7).html('<center><button class="btn btn-block btn-success btn-xs">Product Available</button></center>');
			// }
		},

        "columns": [
            { "data": "item_id", "orderable": true },
            { "data": "branch_name", "orderable": true },
            { "data": "item_name", "orderable": false },
			{ "data": "return_date", "orderable": false },
			{ "data": "return_reason", "orderable": false },
            { "data": "item_quantity", "orderable": false},
            { "data": "item_quantity", "orderable": false}

        ]
    } );
  function branches(return_id,item_quantity,branch_id_fk,item_id_fk,return_date){
	$('#return_id').val(return_id);
	$('#item_quantity').val(item_quantity);
	$('#branch_id_fk').val(branch_id_fk);
	$('#item_id_fk').val(item_id_fk);
	$('#return_date').val(return_date);
	$('#myModal').modal();
	};

$(document).on('click','#branch_update',function(){
	 var return_id = $('#return_id').val();
	 var item_quantity = $('#item_quantity').val();
	 var branch_id_fk = $('#branch_id_fk').val();
	 var item_id_fk = $('#item_id_fk').val();
	 var add_quantity = $('#add_quantity').val();
	 var date = $('#return_date').val();
	 if(return_id !="" && add_quantity !="")
	 {
		 $.ajax({
            url:"<?php echo base_url();?>Returnstock/updateScrap",
            data:{item_id_fk:item_id_fk,branch_id_fk:branch_id_fk,return_id:return_id,item_quantity:item_quantity,add_quantity:add_quantity},
            method:"POST",
            datatype:"json",
            success:function(data){
                var options = $.parseJSON(data);
                noty(options);
                $table.ajax.reload();
				}
			});
	 }

 })





 function checkism(return_id){

var rt = return_id;
//alert(pr);
$.ajax({
url:"<?php echo base_url();?>Returnstock/get_operator",
type: 'POST',
data:{return_id:return_id},
dataType: 'json',
success:function(data){
console.log(data);

alert('Issued by '+data)
$('#ism').html();

}


});



}



</script>

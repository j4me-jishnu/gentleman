<script>
$(document).on("click",'.update',function(){
	if ($('.checkVal').is(':checked')) {
		var prid = $('.checkVal').val();
		var quantity = $('.quantity').val();
		if(prid)
		{

			var details = document.getElementById('item_details');
			var new_id= details.getAttribute('data-id');
			var new_quan= details.getAttribute('data-quantity');
			console.log(new_quan);
			// $.ajax({
			// 	url:"<?php echo base_url();?>stock/updateStock",
			// 	data:{prid:prid,quantity:quantity},
			// 	method:"POST",
			// 	datatype:"json",
			// 	success:function(data){
			// 		console.log("prid=>",prid);
			// 		console.log("quantity=>",quantity);
			// 		location.reload();
			// 	}
			// });

			$.ajax({
				url:"<?php echo base_url();?>stock/updateStocktoStockTable",
				data:{id:new_id,quantity:new_quan},
				method:"POST",
				datatype:"json",
				success:function(data){
					console.log(data);
				}
			});

		}
	}
});
</script>

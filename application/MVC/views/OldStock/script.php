<script>

  var response = $("#response").val();
  if(response){
      console.log(response,'response');
      var options = $.parseJSON(response);
      noty(options);
  }
 $(function () {

    

    $table = $('#old_stock_details').DataTable( {
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			],
        "ajax": {
            "url": "<?php echo base_url();?>index.php/OldStock/get/",
            "type": "POST",
            "data" : function (d) {
           }
        },
        "createdRow": function ( row, data, index ) {
          
            $('td',row).eq(0).html(index+1);
			var balance_quantity = parseInt(data['purchase_quantity']) - parseInt(data['sale_quantity']);
               $('td',row).eq(7).html(balance_quantity);
          
        },

        "columns": [
            { "data": "stock_id", "orderable": false },
            { "data": "product_name", "orderable": true },
            { "data": "category_name", "orderable": true },
            { "data": "subcategory_name", "orderable": true },
            { "data": "color_name", "orderable": true },
            { "data": "size_name", "orderable": true },
			{ "data": "purchase_date", "orderable": true },
            { "data": "stock_id", "orderable": true }
         
        ]
        
    } );
    
    
  });
  
</script>
<script>

  var response = $("#response").val();
  if(response){
      console.log(response,'response');
      var options = $.parseJSON(response);
      noty(options);
  }
  var param = '';
  //var $customerList=[ {'columnName':'customer_name','label':'Customer'} ];
  var $productList=[ {'columnName':'product_name','label':'Product'} ];
  $('#product_name').rcm_autoComplete('<?php echo base_url();?>index.php/common/getProductList',$productList,param,getProductName);
  
  // Auto Searching//
$( "#productname" ).keypress(function() {
            $table.ajax.reload();
});
// Auto Searching//
$( "#category_name" ).keypress(function() {
            $table.ajax.reload();
});
// Auto Searching//
$( "#subcategory_name" ).keypress(function() {
            $table.ajax.reload();
});
// Auto Searching//
$( "#color_name" ).keypress(function() {
            $table.ajax.reload();
});
$( "#size_name" ).keypress(function() {
            $table.ajax.reload();
});
  $(function () {

    var enquiry_type = {'J':'Job','C':'Complaint','F':'Follow-up'};
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

    $table = $('#stock_details_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			],
        "ajax": {
            "url": "<?php echo base_url();?>index.php/stock/get/",
            "type": "POST",
            "data" : function (d) {
                                d.product_name = $("#productname").val();
                                d.category_name = $("#category_name").val();
                                d.subcategory_name = $("#subcategory_name").val();
                                d.color_name = $("#color_name").val();
                                d.size_name = $("#size_name").val();
            
           }
        },
        "createdRow": function ( row, data, index ) {
          
            $('td',row).eq(0).html(index+1);
			var balance_quantity = parseInt(data['purchase_quantity']) - parseInt(data['sale_quantity']);
               if (balance_quantity == 0){
				$('td',row).eq(9).html('<center>'+balance_quantity+'</center>');
				$('td',row).eq(10).html('<center><button class="btn btn-block btn-danger btn-xs">Out Of Stock</button></center>');
			}
			else if(balance_quantity >=data['product_reorderqty']){
				$('td',row).eq(9).html('<center>'+balance_quantity+'</center>');
				$('td',row).eq(10).html('<center><button class="btn btn-block btn-success btn-xs">Product available</button></center>');
			}
			else if(balance_quantity < data['product_reorderqty']){
				$('td',row).eq(9).html('<center>'+balance_quantity+'</center>');
				$('td',row).eq(10).html('<center><button class="btn btn-block btn-warning btn-xs">Reached Below</button></center>');
			}
          
        },

        "columns": [
            { "data": "stock_id", "orderable": false },
            { "data": "product_name", "orderable": false },
            { "data": "category_name", "orderable": false },
            { "data": "subcategory_name", "orderable": false },
            { "data": "color_name", "orderable": false },
            { "data": "size_name", "orderable": false },
            { "data": "product_reorderqty", "orderable": false },
            { "data": "purchase_quantity", "orderable": false },
            { "data": "sale_quantity", "orderable": false },    
            { "data": "stock_status", "orderable": false },
            { "data": "stock_status", "orderable": false }
            
            
        ]
        
    } );
    
    
  });

  $(document).on("ifChecked",".customerType",function(){
    console.log("ENter");
    var val = $(this).val();
    console.log(val,'val');
    if(val == 'N'){
      $("#customer_id").val('');
      // $("#customer_name").val('');
      $("#customer_address").val('');
      $("#customer_phone").val('');
      $("#customer_email").val('');
      $('#customer_name').rcm_autoComplete_d();
    }
    else {
      console.log("customer name append");
      $('#customer_name').rcm_autoComplete('<?php echo base_url();?>index.php/common/getCustomerList',$customerList,param,getCustomerName);
    }
  });

  function getCustomerName(el,event,item){
        console.log(item);
        if(item.customer_id){
            el.val(item.customer_name);
            $("#customer_id").val(item.customer_id);
            $("#customer_address").val(item.customer_address);
            $("#customer_phone").val(item.customer_phone);
            $("#customer_email").val(item.customer_email);
            
        }
    }
function confirmDelete(sale_id){
    var conf = confirm("Do you want to Delete Sale Details ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>index.php/sale/delete",
            data:{sale_id:sale_id},
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
	function getProductName(el,event,item){
       console.log(item);
        if(item.product_id){
            el.val(item.product_name);
            $("#product_id").val(item.product_id);
        }
    }
	$(document).on("blur",".amountclass",function(){
        var quantity = $("#quantity").val();
        var amount = $("#amount").val();
		var discount = $("#discount").val();
        if(quantity != '' && amount !=''){
            totalamount = parseFloat(quantity) * parseFloat(amount);
			if (discount){
				totalamount = totalamount - parseFloat(discount);
			}
        }
        else{
            totalamount = 0;
        }
        $("#totalAmount").html(parseFloat(totalamount).toFixed(2));
        $("#total_price").val(parseFloat(totalamount).toFixed(2));
    })
$('#search').click(function () {
        
        $table.ajax.reload();
    });
  
</script>
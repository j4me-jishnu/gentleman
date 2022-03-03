
<script>

var counter = 0;

function addMore() {
	$("<DIV>").load("", function() {
		$(this).attr('data-validation','required');
		$(this).attr('data-validation','nameFields');
		$(this).attr('data-validation','digitsOnly');
		$(this).attr('data-validation','date');
		$(this).attr('data-validation','usPhone');
		$(this).attr('data-validation','email');
		$(this).attr('data-validation','dropDown');
		var htmlVal = '<DIV class="product-item box box-success id="list"><input type="checkbox" name="item_index[]"/><table class="table table-bordered" cellspacing="2" ><input type="hidden" name="sale_id[]"><tr><div class="form-group"><label for="product_name"  class="col-sm-1 control-label">Product Name</label><div class="col-sm-2"><input type="text" data-pms-required="true"  name="product_name[]" id="product_name'+counter+'" class="form-control" placeholder="product name"/><input type="hidden"  name="product_id_fk[]" id="product_id'+counter+'" class="form-control"/></div><label for="sale_quantity" class="col-sm-1 control-label">Quantity</label><div class="col-sm-1"><input type="text"   data-validation="digitsOnly" data-pms-required="true" class="form-control amountclass" id="quantity'+counter+'" name="sale_quantity[]" placeholder="Quantity"></div><label for="sale_price" class="col-sm-1 control-label"> Price</label><div class="col-sm-1"><input type="text" class="form-control amountclass" id="amount'+counter+'" name="sale_amount[]" placeholder="Price"></div><label for="sale_discount" class="col-sm-1 control-label"> Discount</label><div class="col-sm-1"><input type="text" class="form-control amountclass" id="discount'+counter+'" name="sale_discount[]" placeholder="Price"></div><div class=""><label>Total Amount :</label><label><span id="totalAmount'+counter+'"></span><input type="hidden" name="sale_total_price[]" id="total_price'+counter+'" ></label></div></div></tr><tr><div class="form-group"><label for="sale_remarks" class="col-sm-2 control-label">Remarks:</label><div class="col-sm-3"><textarea class="form-control" name="sale_remarks[]"></textarea></div></div></tr></table></div></DIV>';
		console.log(counter);
			$("#product").append(htmlVal);
			var param = '';
  
  var $productList=[ {'columnName':'product_name','label':'Product'} ];
  $('#product_name'+counter+'').rcm_autoComplete('<?php echo base_url();?>index.php/common/getProductList',$productList,param,getProductName);
//alert(counter);
	});	
counter++;	
}
$(document).on("blur",'.amountclass',function(){
        var quantity = $('#quantity'+counter+'').val();
        var amount = $('#amount'+counter+'').val();
		var discount = $('#discount'+counter+'').val();
        if(quantity != '' && amount !=''){
            totalamount = parseFloat(quantity) * parseFloat(amount);
			if (discount){
				totalamount = totalamount - parseFloat(discount);
				//alert(counter);
			}
        }
        else{
            totalamount = 0;
        }
        $('#totalAmount'+counter+'').html(parseFloat(totalamount).toFixed(2));
        $('#total_price'+counter+'').val(parseFloat(totalamount).toFixed(2));
    })
  var response = $("#response").val();
  if(response){
      console.log(response,'response');
      var options = $.parseJSON(response);
      noty(options);
  }
  
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

    $table = $('#sale_details_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "ajax": {
            "url": "<?php echo base_url();?>index.php/sale/get/",
            "type": "POST",
            "data" : function (d) {
				d.product_name = $("#productname").val();
                d.start_date = $("#pmsDateStart").val();
                d.end_date = $("#pmsDateEnd").val();
            
           }
        },
        "createdRow": function ( row, data, index ) {
          
            $('td',row).eq(0).html(index+1);
			$('td', row).eq(7).html('<center><a href="<?php echo base_url();?>index.php/sale/edit/'+data['sale_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['sale_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
          
        },

        "columns": [
            { "data": "sale_id", "orderable": false },
            { "data": "product_name", "orderable": true },
			{ "data": "sale_date", "orderable": true },
            { "data": "sale_quantity", "orderable": true },
            { "data": "sale_amount", "orderable": true },
            { "data": "sale_discount", "orderable": true },
            { "data": "sale_total_price", "orderable": true },
            { "data": "sale_status", "orderable": false }
            
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
            $('#product_id'+counter+'').val(item.product_id);
        }
    }
	$(document).on("blur",".amountclass",function(){
        var quantity = $('#quantity').val();
        var amount = $('#amount').val();
		var discount = $('#discount').val();
        if(quantity != '' && amount !=''){
            totalamount = parseFloat(quantity) * parseFloat(amount);
			if (discount){
				totalamount = totalamount - parseFloat(discount);
			}
        }
        else{
            totalamount = 0;
        }
        $('#totalAmount').html(parseFloat(totalamount).toFixed(2));
        $('#total_price').val(parseFloat(totalamount).toFixed(2));
    })
	
function deleteRow() {
	$('DIV.product-item').each(function(index, item){
		jQuery(':checkbox', this).each(function () {
            if ($(this).is(':checked')) {
				$(item).remove();
            }
        });
	});
}
$('#search').click(function () {
        
        $table.ajax.reload();
    });
</script>
 

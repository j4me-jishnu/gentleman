
<script>
 $(document).ready(function() {
            //option A
            $("form").submit(function(e){
//                alert('submit intercepted');
                var c = 0;
                $('.table-bordered').each(function(){
//                    values.push($(this).val()); 
                    c++;
                });
                    var options1 = {
                    'title': 'Error',
                    'style': 'error',
                    'message': 'Please Add Products....!',
                    'icon': 'warning',
                    };
                    var n1 = new notify(options1);  
                if(c==0)
                {
                    e.preventDefault(e);
                     n1.show();
                  
                }
                else
                {
                    
                }
                
            });
        });
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
		var htmlVal = '<DIV class="product-item box box-success id="list"><input type="checkbox" name="item_index[]"/><table class="table table-bordered" cellspacing="2" ><input type="hidden" name="sale_id[]"><tr><div class="form-group"><div class="col-md-11"><div class="col-sm-2"><input type="text" data-pms-required="true" data-validation="required" autofocus name="product_name[]" id="product_name'+counter+'" class="form-control product_name" placeholder="Product Name"/><input type="hidden"  name="product_id_fk[]" id="product_id'+counter+'" class="form-control"/><input type="hidden" name="purchase_id_fk"   id="purchase_id'+counter+'" class="form-control"/></div><div class="col-sm-2"><input type="text"   data-validation="digitsOnly" data-pms-required="true" class="form-control amountclass" id="quantity'+counter+'" name="sale_quantity[]" placeholder="Quantity"></div><div class="col-sm-2"><input type="text" data-pms-required="true" data-validation="digitsOnly" class="form-control amountclass" id="amount'+counter+'" name="sale_amount[]" placeholder="Price"></div><div class="col-sm-2"><input type="text" data-validation="digitsOnly" class="form-control amountclass" id="discount'+counter+'" name="sale_discount[]" placeholder="Discount"></div><div class=""><label>Total Amount :</label><label><span id="totalAmount'+counter+'"></span><input type="hidden" class="totalPrice"  name="sale_total_price[]" id="total_price'+counter+'" ></label></div></div></div></tr></table></div></DIV>';
		// console.log(counter);
			$("#product").append(htmlVal);
			var param = '';
                        
  var $productList=[ {'columnName':'product_name','label':'Product'},{'columnName':'category_name','label':'Categry'},{'columnName':'subcategory_name','label':'Subcategry'},{'columnName':'size_name','label':'Size'},{'columnName':'color_name','label':'Color'} ];
  $('#product_name'+counter+'').rcm_autoComplete('<?php echo base_url();?>index.php/common/getPurchaseListusingID',$productList,param,getProductName);
   $('#product_name'+counter+'').focus();
    $('#product_name'+counter+'').click(function(){
       $("#productname").val(''); 
   });   
    $('#product_name'+counter+'').change(function(){
    $(this).val('');  
     setTimeout(function(){  
     var a = $("#productname").val();
     
     
     
     if(a ==='')
        { 
          
         var options1 = {
         'title': 'Error',
         'style': 'error',
         'message': 'Product Not Exist....!',
         'icon': 'warning',
         };
          var n1 = new notify(options1);  

          if(a == '') {
             n1.show();
           }

       }
    }, 1000);
    });
    $('#quantity'+counter+'').change(function(){
      var quant =  $(this).val(); 
      var $p = $(this).parent(); 
         var avail = $("#checkquantity").val();
         
         if(avail)
         {
                var options = {
                'title': 'Error',
                'style': 'error',
                'message': 'Quantity is Greater than available!',
                'icon': 'warning',
                };
             var quant = parseFloat(quant);   
             if(quant > avail) 
             {
                 var n1 = new notify(options); 
                n1.show(); 
//                $('#quantity'+counter+'').val('').change();
                $p.find('.amountclass').val('');
             }
         }
    
    });
	});	
counter++;	
}
function getProductName(el,event,item){
       // console.log(item);
      
       console.log(el);
       console.log(el.next());
       
        if(item.product_id){
            el.val(item.product_name);
            var productId = el.next().attr("id");

            var lastChar = productId.substr(productId.length - 1);
            $("#"+el.next().attr("id")).val(item.product_id);
            $("#amount"+lastChar).val(item.sale_price);
            $("#productname").val(item.product_name);
            $("#purchase_id"+lastChar).val(item.purchase_id);
            var check = $("#purchase_id"+lastChar).val();
            var diff = parseFloat(item.purchase_quantity) - parseFloat(item.sale_quantity);
            $("#checkquantity").val(diff);
            $("#pavailable").html(diff);
            $("#availbalance").fadeToggle(1000);
            for(var i=1;i<=counter;i++)
                        {
                            if(i==1)
                            {
                                $("#availbalance").fadeToggle(3000);
                            }
                            if(i==lastChar)
                            {
                            }else{
                                
                                if($('#purchase_id'+i+'').val() === check)
                                { 
                                    
                                    $("#amount"+lastChar).val('');
                                    $("#product_name"+lastChar).val('');
                                    
                                    
                                    var options1 = {
                                        'title': 'Error',
                                        'style': 'error',
                                        'message': 'Product Already Exist....!',
                                        'icon': 'warning',
                                        };
                                 var n1 = new notify(options1);  
                                 var n1Val = $("#product_name"+lastChar).val();
                                 if(n1Val === '') {
                                    n1.show();
                                    $("#product_id"+lastChar).val('');
                                    $("#purchase_id"+lastChar).val('');
                                  }
                                  
                                }
                            }
                        }
			}
    }
$(document).on("blur",'.amountclass',function(){
        var counterId = $(this).attr("id");
        var counter = counterId.substr(counterId.length - 1);
        var quantity = $('#quantity'+counter+'').val();
        var amount = $('#amount'+counter+'').val();
        var discount = $('#discount'+counter+'').val();
        if(quantity != '' && amount !=''){
            totalamount = parseFloat(quantity) * parseFloat(amount);
			if (discount){
				totalamount = totalamount - parseFloat(discount);
			}
        }
        else{
            totalamount = 0;
        }
        
        $('#totalAmount'+counter+'').html(parseFloat(totalamount).toFixed(2));
        $('#total_price'+counter+'').val(parseFloat(totalamount).toFixed(2));
        
        var netTotalAmount = 0;
        $( ".totalPrice" ).each(function( index ) {
          netTotalAmount = netTotalAmount + parseFloat($( this ).val());
        });
        var tax_id = $('#tax_type').val();
        var tax;
        //alert(tax_id);
        if (tax_id)
                        {
                            $.ajax({
				  url:"<?php echo base_url()?>index.php/sale/tax_amount",
				  type: 'POST',
				  data: {value:tax_id},
				  dataType: 'json',
				  success:
				  function(data)
				  {
                                     //alert(data['product_name']);
                                     //var paper_name=data['product_name'];
                                     //var tax_amount = data['tax_amount'];
                                    //alert(tax_amount);
                                    document.getElementById('tax_amount').value=data['tax_amount'];
                                     tax = $('#tax_amount').val();
                                     var netTotaltax = (netTotalAmount * tax)/100;
                                     var netTotalAmount1 = netTotaltax + netTotalAmount;
                                     //alert(netTotalAmount);
                                     $(".NetTotalAmount").css('display','block');
                                     $('#netTax').html(parseFloat(netTotaltax).toFixed(2));
                                     $('#netAmount').html(parseFloat(netTotalAmount).toFixed(2));
                                     $('#grand_total').html(parseFloat(netTotalAmount1).toFixed(2));
                                     $('#tax_class').html(parseFloat(tax).toFixed(2));
                                     $('#tax_total').val(parseFloat(netTotalAmount1).toFixed(2));
                                    //alert(netTotaltax);
                                     //alert(tax);
                                        //var paper_product=data['product_name'];
                                   },
                    error:function(e){
                    console.log("error");
                    }
                })
                }
        $(".NetTotalAmount").css('display','block');
        $('#netAmount').html(parseFloat(netTotalAmount).toFixed(2));
    })



  var response = $("#response").val();
  if(response){
      console.log(response,'response');
      var options = $.parseJSON(response);
      noty(options);
  }
// Auto Searching//
$( "#sale_invoice_number" ).keypress(function() {
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

    $table = $('#sale_details_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			],
        "ajax": {
            "url": "<?php echo base_url();?>index.php/sale/get/",
            "type": "POST",
            "data" : function (d) {
				d.sale_invoice_number = $("#sale_invoice_number").val();
                                d.sale_totalPrice = $("#sale_totalPrice").val();
                                d.start_date = $("#pmsDateStart").val();
                                d.end_date = $("#pmsDateEnd").val();
            
           }
        },
        "createdRow": function ( row, data, index ) {
          
            $('td',row).eq(0).html(index+1);
                        $('td', row).eq(6).html('<center><a target="_blank" href="<?php echo base_url();?>index.php/sale/view/'+data['sale_invoice_number']+'/'+data['cust_details']+'"><i class="fa fa-eye" ></i></a> &nbsp;&nbsp;&nbsp; <a target="_blank" href="<?php echo base_url();?>index.php/sale/invoice/'+data['cust_details']+'"><i class="fa  fa-file iconFontSize-medium" ></i></a></center>');
			$('td', row).eq(7).html('<center><a href="<?php echo base_url();?>index.php/sale/edit/'+data['sale_invoice_number']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['sale_invoice_number']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
          
        },

        "columns": [
            { "data": "sale_id", "orderable": false },
            { "data": "sale_invoice_number", "orderable": false },
            { "data": "sale_date", "orderable": false },
            { "data": "sale_count", "orderable": false },
            { "data": "sale_totalPrice", "orderable": false },
            { "data": "sale_remarks", "orderable": false },
            { "data": "sale_id", "orderable": false },
            { "data": "sale_id", "orderable": false }
         
            
        ]
        
    } );
    
    
  });

  

  
function confirmDelete(sale_invoice_number){
    var conf = confirm("Do you want to Delete Sale Details ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>index.php/sale/delete",
            data:{sale_invoice_number:sale_invoice_number},
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
	

	
function deleteRow() {
	$('DIV.product-item').each(function(index, item){
		jQuery(':checkbox', this).each(function () {
            if ($(this).is(':checked')) {
				$(item).remove();
                                var a = $("#countervalue").val();
                                $("#countervalue").val(a-1);
            }
        });
	});
}
$('#search').click(function () {
        
        $table.ajax.reload();
    });
	
	

function printDiv(divName) {
    var printContents = document.getElementById('divName').innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}

</script>
 

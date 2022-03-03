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
		var htmlVal = '<DIV class="product-item box box-success id="list"><input type="checkbox" name="item_index[]"/><table class="table table-bordered" cellspacing="2" ><input type="hidden" name="purchase_id[]"><tr><div class="form-group"><div class="col-sm-2"><input type="text" data-pms-required="true" data-validation="required" autofocus name="product_name[]" id="product_name'+counter+'" class="form-control product_name" placeholder="product name"/><input type="hidden"  name="product_id_fk[]" id="product_id'+counter+'" class="form-control"/></div><div class="col-sm-2"><input type="text" data-pms-required="true" disabled data-validation="required" name="product_category[]" id="product_category'+counter+'" class="form-control" placeholder="Category"/><input type="hidden"  name="category_id_fk[]" id="category_id'+counter+'" class="form-control"/></div><div class="col-sm-2"><input type="text" data-pms-required="true" disabled data-validation="required" name="subcategory[]" id="subcategory'+counter+'" class="form-control" placeholder="Sub Category"/><input type="hidden"  name="subcategory_id_fk[]" id="subcategory_id'+counter+'" class="form-control"/></div><div class="col-sm-2"><input type="text"   data-validation="required" disabled data-pms-required="true" class="form-control" id="size'+counter+'" name="size_name[]" placeholder="Size"><input type="hidden"  name="size_id_fk[]" id="size_id_fk'+counter+'" class="form-control"/></div><div class="col-sm-2"><input type="text" disabled  data-validation="required" data-pms-required="true" class="form-control" id="color'+counter+'" name="color_name[]" placeholder="Color"><input type="hidden"  name="color_id_fk[]" id="color_id'+counter+'" class="form-control"/></div></div></tr><tr><div class="form-group"><div class="col-sm-2"><input type="text"   data-validation="digitsOnly" data-pms-required="true" class="form-control amountclass" id="pquantity'+counter+'" name="purchase_quantity[]" placeholder="Qty"></div><div class="col-sm-2"><input type="text" data-pms-required="true" data-validation="digitsOnly" class="form-control amountclass" id="pprice'+counter+'" name="purchase_price[]" placeholder="Purchase Price"></div><div class="col-sm-2"><input type="text"   data-pms-required="true" data-validation="digitsOnly" class="form-control" name="sale_price[]" placeholder="Sale Price"></div><div class=""><label>Total Amount :</label><label><span id="totalAmount'+counter+'"></span></label><input type="hidden" class="totalPrice"  name="purchase_total_price[]" id="total_price'+counter+'" ></div></div></tr></table></DIV>';
		// console.log(counter);
			$("#product").append(htmlVal);
			var param = '';
  
  var $productList=[ {'columnName':'product_name','label':'Product'},{'columnName':'category_name','label':'Categry'},{'columnName':'subcategory_name','label':'Subcategry'},{'columnName':'size_name','label':'Size'},{'columnName':'color_name','label':'Color'} ];
   $('#product_name'+counter+'').rcm_autoComplete('<?php echo base_url();?>index.php/common/getProductList',$productList,param,getProductName);
    $('#product_name'+counter+'').focus();
  $('#product_name'+counter+'').click(function(){
       $("#productname").val('');
   });   
    $('#product_name'+counter+'').change(function(){

     setTimeout(function(){  
     var a = $("#productname").val();
     if(a ==='')
        { 
         $('#product_name'+counter+'').val('');
         var options1 = {
         'title': 'Error',
         'style': 'error',
         'message': 'Product Not Exist....!',
         'icon': 'warning',
         };
          var n1 = new notify(options1);  

          if(a === '') {
             n1.show();
           }

       }
    }, 1000);
    });
	});	
counter++;	
}
$(document).on("blur",'.amountclass',function(){
        var counterId = $(this).attr("id");
        var counter = counterId.substr(counterId.length - 1);
        var quantity = $('#pquantity'+counter+'').val();
        var amount = $('#pprice'+counter+'').val();
        //alert(amount);
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
        var tax_id = $('#taxClass').val();
        var include_tax = $('#include_tax').val();
        //alert(include_tax);
        if(include_tax == '1'){
        var tax;
        
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
                                     //alert(netTotalAmount1);
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
            }
         else {
                $(".NetTotalAmount").css('display','block');
                $('#netTax').html(parseFloat(0.00).toFixed(2));
                $('#netAmount').html(parseFloat(netTotalAmount).toFixed(2));
                $('#grand_total').html(parseFloat(netTotalAmount).toFixed(2));
                $('#tax_class').html(parseFloat(0));
               // $('#tax_total').val(parseFloat(tax).toFixed(2));
         }
        //$(".NetTotalAmount").css('display','block');
        //$('#netAmount').html(parseFloat(netTotalAmount).toFixed(2));
    })
    
  var response = $("#response").val();
  if(response){
      console.log(response,'response');
      var options = $.parseJSON(response);
      noty(options);
      }
      
$( "#purchase_invoice_no" ).keypress(function() {
            $table.ajax.reload();
});
$( "#vendor_name" ).keypress(function() {
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

    $table = $('#product_details_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			],
        "ajax": {
            "url": "<?php echo base_url();?>index.php/purchase/get/",
            "type": "POST",
            "data" : function (d) {
				d.purchase_invoice_no = $("#purchase_invoice_no").val();
                                d.vendor_name = $("#vendor_name").val();
                                d.start_date = $("#pmsDateStart").val();
                                d.end_date = $("#pmsDateEnd").val();

           }
        },
        "createdRow": function ( row, data, index ) {
          
            $('td',row).eq(0).html(index+1);
                        $('td', row).eq(9).html('<center><a target ="_blank" href="<?php echo base_url();?>index.php/purchase/view/'+data['purchase_invoice_no']+'/'+data['vendor_id']+'"><i class="fa fa-eye" ></i></a> &nbsp;&nbsp;&nbsp; <a target ="_blank"  href="<?php echo base_url();?>index.php/purchase/invoice/'+data['purchase_invoice_no']+'/'+data['vendor_id']+'"><i class="fa  fa-file iconFontSize-medium" ></i></a></center>');
			$('td', row).eq(10).html('<center><a href="<?php echo base_url();?>index.php/purchase/edit/'+data['purchase_invoice_no']+'/'+data['vendor_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['purchase_invoice_no']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a title="Generate bar code" href="<?php echo base_url();?>index.php/barcode/generate/'+data['purchase_id']+'"></a> </center>');
          
        },

        "columns": [
            { "data": "purchase_id", "orderable": false },
            { "data": "purchase_invoice_no", "orderable": false },
            { "data": "vendor_name", "orderable": false },
            { "data": "vendor_phone", "orderable": false },
            { "data": "vender_mail", "orderable": false },
            { "data": "purchase_date", "orderable": false },
            { "data": "purchase_count", "orderable": false },
            { "data": "pur_totalPrice", "orderable": false },
            { "data": "purchase_remarks", "orderable": false },
            { "data": "purchase_invoice_no", "orderable": false },
            { "data": "purchase_invoice_no", "orderable": false }
            
            
        ]
        
    } );
    
    
  });
  
// Auto Searching//


$(document).on("click","#customer_name",function(){
    var param='';
      console.log("customer name append");
      var $customerList=[ {'columnName':'vendor_name','label':'Name'}];
      $('#customer_name').rcm_autoComplete('<?php echo base_url();?>index.php/common/getVendorList',$customerList,param,getCustomerName);
    
  });

  function getCustomerName(el,event,item){
        console.log(item);
        if(item.vendor_id){
            el.val(item.vendor_name);
            $("#vendor_id").val(item.vendor_id);
            $("#vendor_address").val(item.vendor_address);
            $("#vender_mail").val(item.vender_mail);
            $("#vendor_phone").val(item.vendor_phone);
            $("#vendor_tin").val(item.vendor_tin);
            $("#vendor_pin").val(item.vendor_pin);
            
        }
    }
$(document).on("click","#Product_name",function(){
    var param='';
      console.log("customer name append");
      var $productName=[ {'columnName':'product_name','label':'Product'},{'columnName':'category_name','label':'Categry'},{'columnName':'subcategory_name','label':'Subcategry'},{'columnName':'size_name','label':'Size'},{'columnName':'color_name','label':'Color'} ];;
      $('#Product_name').rcm_autoComplete('<?php echo base_url();?>index.php/common/getProductList',$productName,param,getProductNameEdit);
    
  });
  
   function getProductNameEdit(el,event,item){
        console.log(item);
        if(item.product_id){
            el.val(item.product_name);
            $("#Category_name").val(item.category_name);
            $("#Size_name").val(item.size_name);
            $("#Color_name").val(item.color_name);
            $("#Product_id").val(item.product_id);  
        }
    }
    
function confirmDelete(purchase_invoice_no){
    var conf = confirm("Do you want to Delete Purchase Details ?");
    
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>index.php/purchase/delete",
            data:{purchase_invoice_no:purchase_invoice_no},
            
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
	
	$('#search').click(function () {
        
        $table.ajax.reload();
    });
	
	function getProductName(el,event,item){
       
       console.log(el);
       console.log(el.next());
       
        if(item.product_id){
            el.val(item.product_name);
            var productId = el.next().attr("id");
            //alert(item.subcategory_name);
            var lastChar = productId.substr(productId.length - 1);
            $("#"+el.next().attr("id")).val(item.product_id);
            $("#amount"+lastChar).val(item.product_id);
            $("#product_category"+lastChar).val(item.category_name);
            $("#category_id"+lastChar).val(item.category_id_fk);
            $("#subcategory"+lastChar).val(item.subcategory_name);
            $("#subcategory_id"+lastChar).val(item.subcategory_id);
            $("#size"+lastChar).val(item.size_name);
            $("#size_id_fk"+lastChar).val(item.size_id_fk);
            $("#color"+lastChar).val(item.color_name);
            $("#color_id"+lastChar).val(item.color_id_fk);
            $("#productname").val(item.product_name);
            var check = $("#product_id"+lastChar).val();
                        for(var i=1;i<=counter;i++)
                        {
                            if(i==lastChar)
                            {
                            }else{
                                if($('#product_id'+i+'').val() == check)
                                { 
                                    
                                    $("#product_id"+lastChar).val('');
                                    $("#product_name"+lastChar).val('');
                                    $("#amount"+lastChar).val('');
                                    $("#product_category"+lastChar).val('');
                                    $("#category_id"+lastChar).val('');
                                    $("#size"+lastChar).val('');
                                    $("#size_id_fk"+lastChar).val('');
                                    $("#color"+lastChar).val('');
                                    $("#color_id"+lastChar);
                                    
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
                                  }
                                  
                                }
                            }
                        }
			}
                        
    }
	$(document).on("blur",".amountclass",function(){
        var quantity = $("#quantity").val();
        var amount = $("#amount").val();
        if(quantity != '' && amount !=''){
            totalamount = parseFloat(quantity) * parseFloat(amount);
        }
        else{
            totalamount = 0;
        }
        $("#totalAmount").html(parseFloat(totalamount).toFixed(2));
        $("#total_price").val(parseFloat(totalamount).toFixed(2));
    })
	
	$(document).ready(function() {
    $('.select1').toggle();
    $(document).click(function(e) {
  $('.select1').attr('size',0);
});
});
$(document).on('change','#include_tax', function(){
    var includeTax = $("#include_tax").val();
    if(includeTax =='1'){
        $('#taxClass').show();
    }
    else {
       $('#taxClass').hide();
       //$('taxClass').val(2);
   }
    });
function deleteRow() {
	$('DIV.product-item').each(function(index, item){
		jQuery(':checkbox', this).each(function () {
            if ($(this).is(':checked')) {
				$(item).remove();
            }
        });
	});
}
function printDiv(divName) {
    var printContents = document.getElementById('divName').innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
$(document).on('click','#update', function(){
    var conf = confirm("Do you want to Edit details?");
    //alert(conf);
    var vendor_id = $("#vendor_id").val();
    var customer_name = $("#customer_name").val();
    var vendor_address = $("#vendor_address").val();
    var vender_mail = $("#vender_mail").val();
    var vendor_phone = $("#vendor_phone").val();
    var vendor_tin = $("#vendor_tin").val();
    var vendor_pin = $("#vendor_pin").val();
    var date = $("#date").val();
    var purchase_remarks = $("#purchase_remarks").val();
    var tax_type = $("#taxtype").val();
    var invoice_no = $("#invoice_no").val();
    if(tax_type == 2){
        var tax_id_fk = 0;
    }
    else{
    var tax_id_fk = $("#taxClass").val();
    }
    //alert(invoice_no);
    if(conf == true){
        $.ajax({
            url:"<?php echo base_url();?>index.php/purchase/edit_vendor",
            data:{
                vendor_id:vendor_id,
                customer_name:customer_name,
                vendor_address:vendor_address,
                vender_mail:vender_mail,
                vendor_phone:vendor_phone,
                vendor_tin:vendor_tin,
                vendor_pin:vendor_pin,
                date:date,
                tax_id_fk:tax_id_fk,
                purchase_remarks:purchase_remarks,
                invoice_no:invoice_no
                
            },
            
            method:"POST",
            datatype:"json",
            success:function(data){
               // var options = $.parseJSON(data);
               // noty(options);
                //location.reload();
            },
            error:function(e){
            console.log("error");
        }
        });

    }
    else{
    //location.reload();
    }
    
    
    });
    //var i=0;
    function confirmUpdate(id){
    var conf = confirm("Do you want to Edit details?");
    if(conf){
        $('#EditPurchase').modal();
        $.ajax({
        url:"<?php echo base_url();?>index.php/purchase/editRow",
        type: 'POST',
       data:{purchase_id:id},
        dataType: 'json',
        success:
        function(data)
        {
             //alert(data[0]['product_id']);
               document.getElementById('Purchase_id').value=data[0]['purchase_id'];
               document.getElementById('Product_name').value=data[0]['product_name'];
               document.getElementById('Product_id').value=data[0]['product_id'];
               document.getElementById('Category_name').value=data[0]['category_name'];
               document.getElementById('Size_name').value=data[0]['size_name'];
               document.getElementById('Color_name').value=data[0]['color_name'];
               document.getElementById('Purchase_qty').value=data[0]['product_purchase_quantity'];
               document.getElementById('Purchase_rte').value=data[0]['purchase_price'];
               document.getElementById('Sale_price').value=data[0]['sale_price'];
               document.getElementById('Total_purchase').value=data[0]['purchase_total_price'];
               $("#PurchaseTotal").html(data[0]['purchase_total_price']);
               //document.getElementById('Description').value=data[0]['purchase_remarks'];
               
        },
        error:function(e){
        console.log("error");
        }
      
      });
      
       
    }
    //var product_id = $("#product_id"+i).val();
    //alert(id);
   // var i++;
	}
$(document).on('change','#Purchase_qty', function(){
        var  Purchase_qty= $("#Purchase_qty").val();
               var  Purchase_rte= $("#Purchase_rte").val();
               //var tax = $("#taxClass").val();
               //alert(tax);
               var total = Purchase_qty * Purchase_rte;
               $("#Total_purchase").val(parseFloat(total).toFixed(2));
               //alert(total);
});

$(document).on('change','#Purchase_rte', function(){
        var  Purchase_qty= $("#Purchase_qty").val();
               var  Purchase_rte= $("#Purchase_rte").val();
               var total = Purchase_qty * Purchase_rte;
               $("#Total_purchase").val(parseFloat(total).toFixed(2));
               //alert(total);
});
$(document).on("blur","#EditPurchase",function(){
        var quantity = $('#Purchase_qty').val();
        var price = $('#Purchase_rte').val();
        //var disc = $('#Sale_discount').val();
        var sub_total = quantity * price;
        //var total = sub_total - disc;
        $("#Total_purchase").val(parseFloat(sub_total).toFixed(2));
        $("#PurchaseTotal").html(parseFloat(sub_total).toFixed(2));
        //alert(total);
    })

  function AddPurchase(){
  var Purchase_id = $('#Purchase_id').val();
  var Product_id = $('#Product_id').val();
  var Purchase_qty =$("#Purchase_qty").val();
  var Purchase_rte = $("#Purchase_rte").val();
  var Sale_rate = $("#Sale_price").val();
  var Total_purchase = $("#Total_purchase").val();
  var Tax_class = $("#taxClass").val();
  if(!/^[0-9]+$/.test(Purchase_qty) || !/^[0-9]+$/.test(Purchase_rte) || !/^[0-9]+$/.test(Sale_rate)){ 
//     $('#EditSale').modal('hide');
  }
  else if(Purchase_qty ==='' || Purchase_rte ==='' || Sale_rate ==='')
  {
      
  }
  //alert(Sale_rate);
 // alert(Total_purchase);
 else{
      $('#EditPurchase').modal('hide');
  if(Purchase_id)
  {
      $.ajax({
        url:"<?php echo base_url();?>index.php/Purchase/editUpdate",
        
            data:{purchase_id:Purchase_id,
                  product_id:Product_id,
                  product_purchase_quantity:Purchase_qty,
                  purchase_price:Purchase_rte,
                  sale_price:Sale_rate,
                  purchase_total_price:Total_purchase,
                  tax_id_fk:Tax_class
                 
              },
                      
            method:"POST",
            datatype:"json",
            success:function(data){
                var options = $.parseJSON(data);
                noty(options);
                location.reload();
            },
        error:function(e){
        console.log("error");
        }

      });
  }
  }
}
        
 function comfirmDeleteRow(id){
    
    var conf = confirm("Do you want to Delete Details?");
    //alert(id);
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>index.php/purchase/delete_id",
            data:{purchase_id:id},
            
            method:"POST",
            datatype:"json",
            success:function(data){
                var options = $.parseJSON(data);
                noty(options);
               location.reload();
            }
        });

    }
   // var i++;
	}
      
function send()
{document.theform.submit()}

</script>
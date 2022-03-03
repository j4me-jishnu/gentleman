<script>


  var response = $("#response").val();
  if(response){
      console.log(response,'response');
      var options = $.parseJSON(response);
      noty(options);
  }
  var param = '';
  //var $customerList=[ {'columnName':'customer_name','label':'Customer'} ];
  var $productList=[ {'columnName':'product_name','label':'Product'},{'columnName':'category_name','label':'Categry'},{'columnName':'subcategory_name','label':'Subcategry'},{'columnName':'size_name','label':'Size'},{'columnName':'color_name','label':'Color'} ];
  $('#Product_name').rcm_autoComplete('<?php echo base_url();?>index.php/common/getPurchaseListusingID',$productList,param,getProductName);

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

 //Date picker
    $('#date').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy'
    });
	
	$('#search').click(function () {
        
        $table.ajax.reload();
    });
	
	function getProductName(el,event,item){
       console.log(item);
        if(item.product_id){
            el.val(item.product_name);
            $("#Product_id").val(item.product_id);
            $("#Category_name").val(item.category_name);
            $("#Size_name").val(item.size_name);
            $("#Color_name").val(item.color_name);
            $("#Subcategory_name").val(item.subcategory_name);
            $("#Sale_price").val(item.sale_price);
            //alert(item.subcategory_name);
        }
    }
	$(document).on("blur","#EditSale",function(){
        var quantity = $('#Sale_qty').val();
        var price = $('#Sale_price').val();
        var disc = $('#Sale_discount').val();
        var sub_total = quantity * price;
        var total = sub_total - disc;
        $("#Sale_total_price").val(parseFloat(total).toFixed(2));
        $("#SaleTotal").html(parseFloat(total).toFixed(2));
        //alert(total);
    })
	
	$(document).ready(function() {
    $('.select1').toggle();
    $(document).click(function(e) {
  $('.select1').attr('size',0);
});
});

function comfirmDeleteRow(id){
    
    var conf = confirm("Do you want to Delete Details?");
    //alert(id);
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>index.php/sale/delete_id",
            data:{sale_id:id},
            
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
        function confirmUpdate(id){
    var conf = confirm("Do you want to Edit details?");
    if(conf){
        $('#EditSale').modal();
        $.ajax({
        url:"<?php echo base_url();?>index.php/sale/editRow",
        type: 'POST',
       data:{sale_id:id},
        dataType: 'json',
        success:
        function(data)
        {
             //alert(data[0]['subcategory_name']);
               document.getElementById('Sale_id').value=data[0]['sale_id'];
               document.getElementById('Product_name').value=data[0]['product_name'];
               document.getElementById('Product_id').value=data[0]['product_id'];
               document.getElementById('Category_name').value=data[0]['category_name'];
               //document.getElementById('Subcategory_name').value=data[0]['subcategory_name'];
               document.getElementById('Size_name').value=data[0]['size_name'];
               document.getElementById('Color_name').value=data[0]['color_name'];
               document.getElementById('Sale_qty').value=data[0]['sale_quantity'];
               document.getElementById('Sale_price').value=data[0]['sale_price'];
               document.getElementById('Sale_discount').value=data[0]['sale_discount'];
               document.getElementById('Sale_total_price').value=data[0]['sale_total_price'];
               $("#SaleTotal").html(data[0]['sale_total_price']);
               document.getElementById('Description').value=data[0]['sale_remarks'];
               
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
function AddSale(){
  var sale_id = $('#Sale_id').val();
  var Product_id = $('#Product_id').val();
  var sale_qty =$("#Sale_qty").val();
  var sale_rte = $("#Sale_price").val();
  var sale_discount = $("#Sale_discount").val();
  var Total_sale = $("#Sale_total_price").val();
  var Tax_class = $("#taxClass").val();
  var description = $("#Description").val();
  if(!/^[0-9]+$/.test(sale_qty) || !/^[0-9]+$/.test(sale_discount) || !/^[0-9]+$/.test(sale_rte)){ 
//     $('#EditSale').modal('hide');
  }
  else if(sale_qty ==='' || sale_discount ==='' || sale_rte ==='')
  {
      
  }
  else{
      $('#EditSale').modal('hide'); 
      if(sale_id)
  {
      $.ajax({
        url:"<?php echo base_url();?>index.php/Sale/editUpdate",
        
            data:{sale_id:sale_id,
                  product_id:Product_id,
                  product_sale_quantity:sale_qty,
                  sale_price:sale_rte,
                  sale_discount:sale_discount,
                  sale_total_price:Total_sale,
                  tax_id_fk:Tax_class,
                  sale_remarks:description
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

$(document).on('click','#update', function(){
    var conf = confirm("Do you want to Edit details?");
    //alert(conf);
    var remarks = $("#remarks").val();
    var tax_id_fk = $("#taxClass").val();
    var date = $("#date").val();
    var invoice_no = $("#invoice_no").val();
    
    if(conf == true){
        $.ajax({
            url:"<?php echo base_url();?>index.php/sale/edit_basic",
            data:{
                remarks:remarks,
                tax_id_fk:tax_id_fk,
                date:date,
                invoice_no:invoice_no
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
    else{
    //location.reload();
    }
    
    
    });
function send()
{document.theform.submit()}

</script>
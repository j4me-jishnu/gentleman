<script>

function sizemodalclose()
{
    $('#addsize').modal('hide');
    $('#size_id_fk').val('').change(); 
    $('#size').val('');
    $('#size_remarks').val('');
}
function colourmodalclose()
{
    $('#addcolour').modal('hide');
    $('#color_id_fk').val('').change(); 
    $('#color_name').val('');
    $('#color_remarks').val('');
}
function categorymodalclose()
{
    $('#addcategory').modal('hide');
    $('#category').val('').change(); 
    $('#subcategory').val('').change();
    $('#Category_name').val('');
    $('#Category_desc').val('');
}
function subcategorymodalclose()
{
    $('#addsubcategory').modal('hide');
    $('#subcategory').val('').change(); 
    $('#subCategory_name').val('');
    $('#subCategory_desc').val('');
} 
function Addsubcategory(){
  var subCategory_name = $('#subCategory_name').val();
  var subCategory_desc = $('#subCategory_desc').val();
  var categoryidfk = $('#category').val();
  if(subCategory_name)
  {
        $.ajax({
        url:"<?php echo base_url();?>index.php/Subcategory/newsubcategory",
        type: 'POST',
        data:{categoryidfk:categoryidfk,subCategory_name:subCategory_name,subCategory_desc:subCategory_desc},
        dataType: 'json',
        success:
        function(data)
        {
          $("#subcategory option:last").after('<option value='+data[0]['subcategory_id']+'>'+data[0]['subcategory_name']+'</option>');
          $('#subcategory').val(data[0]['subcategory_id']).change(); 
          $('#subCategory_name').val('');
          $('#subCategory_desc').val('');
        
        },
        error:function(e){
        console.log("error");
        }

      });
  }
}
            // To make auto focus on modals

$('#addcolour').on('shown.bs.modal', function () {
    $('#color_name').focus();
})
$('#addsize').on('shown.bs.modal', function () {
    $('#size').focus();
})
$('#addcategory').on('shown.bs.modal', function () {
    $('#Category_name').focus();
})
$('#addsubcategory').on('shown.bs.modal', function () {
    $('#subCategory_name').focus();
})
$(document).on('change','#subcategory',function(){
    var subcategory = $('#subcategory').val();
    if(subcategory=='+')
    {
        $('#addsubcategory').modal();
 
    }
   
});
  function Addcategory(){
  var Category_name = $('#Category_name').val();
  var Category_desc = $('#Category_desc').val();
  if(Category_name)
  {
      $.ajax({
        url:"<?php echo base_url();?>index.php/Category/newcategory",
        type: 'POST',
        data:{Category_name:Category_name,Category_desc:Category_desc},
        dataType: 'json',
        success:
        function(data)
        {
          $("#category option:first").after('<option value='+data[0]['category_id']+'>'+data[0]['category_name']+'</option>');
          $('#category').val(data[0]['category_id']).change(); 
          $('#Category_name').val('');
          $('#Category_desc').val('');
        },
        error:function(e){
        console.log("error");
        }

      });
  }
}
$(document).on('change','#category',function(){
    var category = $('#category').val();
    if(category=='+')
    {
        $('#addcategory').modal();
    }
});
  function rate(){
  var size = $('#size').val();
  var size_remarks = $('#size_remarks').val();
  if(size)
  {
      
        $.ajax({
        url:"<?php echo base_url();?>index.php/Size/newSize",
        type: 'POST',
        data:{size:size,size_remarks:size_remarks},
        dataType: 'json',
        success:
        function(data)
        {
          $("#size_id_fk option:last").after('<option value='+data[0]['size_id']+'>'+data[0]['size_name']+'</option>');
          $('#size_id_fk').val(data[0]['size_id']).change(); 
          $('#size').val('');
          $('#size_remarks').val('');
        },
        error:function(e){
        console.log("error");
        }

      });
  }
}
$(document).on('change','#size_id_fk',function(){
   var a = $('#size_id_fk').val();
   if(a =='+')
   {
       $('#addsize').modal();
   }
});
function srate(){
  var remarks = $('#color_remarks').val();
  var color_name = $('#color_name').val();
  if(color_name)
  {
      
        $.ajax({
        url:"<?php echo base_url();?>index.php/Color/newclour",
        type: 'POST',
        data:{color_name:color_name,remarks:remarks},
        dataType: 'json',
        success:
        function(data)
        {
          $("#color_id_fk option:last").after('<option value='+data[0]['color_id']+'>'+data[0]['color_name']+'</option>');
          $('#color_id_fk').val(data[0]['color_id']).change(); 
          $('#color_name').val('');
          $('#color_remarks').val('');
        },
        error:function(e){
        console.log("error");
        }

      });
  }
}
$(document).on('change','#color_id_fk',function(){
   var a = $('#color_id_fk').val();
   if(a =='+')
   {
       $('#addcolour').modal();
   }
});
$(document).ready(function(){
 var id = $('#product_id').val();
 var categoryname = $('#categoryname').val();
 
 if(id)
 {
    $("#subcategory option:last").after('<option value="+">+Add New</option>'); 
    $("#category").val(categoryname).change();
    

 }
 $('#category').append('<option value="+">+Add New</option>');
 $('#category').change(function(){ //any select change on the dropdown with id country trigger this code
 var a = $('#category').val();
 if(a!=='+')
 {   
 $("#subcategory > option").remove(); //first of all clear select items
 var category_id = $('#category').val(); // here we are taking country id of the selected one.
 $.ajax({
 type: "POST",
 url: "<?php echo base_url();?>index.php/product/subcategory/"+category_id, //here we are calling our user controller and get_cities method with the country_id
 
 success: function(cities) //we're calling the response json array 'cities'
 {
 $('#subcategory').append('<option value="">---Select---</option>');
 if((a!=='+')||(a!=='')) 
  {
      $('#subcategory').append('<option value="+">+Add New</option>');
  }
 $.each(cities,function(id,city) //here we're doing a foeach loop round each city with id as the key and city as the value
 {
 var opt = $('<option />'); // here we're creating a new select option with for each city
 opt.val(id);
 opt.text(city);
 $('#subcategory').append(opt); //here we will append these new select options to a dropdown with the id 'cities'
                
});					
 }
 });
 }
 else
 {
    $("#subcategory > option").remove();
 }
 });
 }); 
 
  var response = $("#response").val();
  if(response){
      console.log(response,'response');
      var options = $.parseJSON(response);
      noty(options);
  }
//  var param = '';
//  var $productList=[ {'columnName':'product_name','label':'Product'}];
//  $('#product_name').rcm_autoComplete('<?php echo base_url();?>index.php/common/getProductList',$productList,param,getProductName);
//function getProductName(el,event,item){
//       console.log(item);
//        if(item.product_id){
//            el.val(item.product_name);
//        }
//    }
// Auto Searching//
$( "#product_name" ).keypress(function() {
            $table.ajax.reload();
});

$( "#category_name" ).keypress(function() {
            $table.ajax.reload();
});

$( "#subcategory_name" ).keypress(function() {
            $table.ajax.reload();
});

$( "#size_name" ).keypress(function() {
            $table.ajax.reload();
});

$( "#color_name" ).keypress(function() {
            $table.ajax.reload();
});

  $(function () {
    $(".select2").select2();
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
            "url": "<?php echo base_url();?>index.php/product/get/",
            "type": "POST",
            "data" : function (d) {
                d.product_name = $("#product_name").val();
                d.category_name = $("#category_name").val();
                d.subcategory_name = $("#subcategory_name").val();
				d.size_name = $("#size_name").val();
                d.color_name = $("#color_name").val();
                //d.end_date = $("#pmsDateEnd").val();
			}
        },
        "createdRow": function ( row, data, index ) {
          
            $('td',row).eq(0).html(index+1);
            $('td', row).eq(9).html('<center><a href="<?php echo base_url();?>index.php/product/edit/'+data['product_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['product_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
          
        },

        "columns": [
            { "data": "product_id", "orderable": false },
            { "data": "product_name", "orderable": false },
            { "data": "category_name", "orderable": false },
            { "data": "subcategory_name", "orderable": false },
            { "data": "color_name", "orderable": false },
            { "data": "size_name", "orderable": false },
            { "data": "product_brand", "orderable": false },
            { "data": "product_reorderqty", "orderable": false },
            { "data": "product_description", "orderable": false },
            { "data": "product_status", "orderable": false }
            
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
function confirmDelete(product_id){
    var conf = confirm("Do you want to Delete Product ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>index.php/product/delete",
            data:{product_id:product_id},
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
$(document).on("click","#category",function(){	
	var id = document.getElementById("check").value;
	if(id== null)
	{$("#category option[value='']").remove();}
    else{$("#category option[value='']").remove();}
	$("#category option[value=name]").remove();
});
// $(document).on("click","#subcategory_id",function(){	

    // $("#category option[value='']").remove();
	// $("#category option[value=name]").remove();
// });
</script>
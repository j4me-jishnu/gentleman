<script>

  var response = $("#response").val();
  if(response){
      console.log(response,'response');
      var options = $.parseJSON(response);
      noty(options);
  }
  var param = '';
  var arMonth = {'2':'Supervisor','3':'Accountant','4':'employees'};
  var $customerList=[ {'columnName':'customer_name','label':'Customer'} ];

function confirmUpdate(id){
    var conf = confirm("Do you want to Edit details?");
    if(conf){
        $('#EditUser').modal();
        $.ajax({
        url:"<?php echo base_url();?>index.php/User/get_data",
        type: 'POST',
       data:{id:id},
        dataType: 'json',
        success:
        function(data)
        {
             //alert(data['id']);
               document.getElementById('Id').value=data['id'];
               document.getElementById('Shop_name').value=data['shop_name'];
               document.getElementById('Address').value=data['shop_address'];
               document.getElementById('Tin_no').value=data['tin_no'];
               document.getElementById('Phone_number').value=data['phone_no'];
               document.getElementById('User_name').value=data['user_name'];
               document.getElementById('Password').value=data['admin_password'];
               document.getElementById('Admin_email').value=data['admin_email'];
               
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

function EditUser(){
  var id = $('#Id').val();
  var shop_name = $('#Shop_name').val();
  var address =$("#Address").val();
  var tin_no = $("#Tin_no").val();
  var phone_number = $("#Phone_number").val();
  var admin_email = $("#Admin_email").val();
  var user_name = $("#User_name").val();
  var password = $("#Password").val();
  
  if(id) {
      
 if(shop_name == ""){
          
          $('#response').val("Please");
        var data = {"text":"Deleted successfully","type":"success","layout":"topRight"};
        if(data){
            var options = $.parseJSON(data);
        noty(options);
        }
       
      }
     else {
     $.ajax({
       url:"<?php echo base_url();?>index.php/User/editUpdate",
       
            data:{id:id,                  
        shop_name:shop_name,                  
        address:address,                  
        tin_no:tin_no,
        phone_number:phone_number,                  
        admin_email:admin_email,                  
        user_name:user_name,
        password:password
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


$(document).on('change','#adwork', function(e){
   if(e.target.checked){
     $('#category').show();
   }
});

  
</script>
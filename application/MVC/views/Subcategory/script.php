<script>
function categorymodalclose()
{
    $('#addcategory').modal('hide');
    $('#category_id_fk').val('').change(); 
    $('#Category_name').val('');
    $('#Category_desc').val('');
}
  var response = $("#response").val();
  if(response){
      console.log(response,'response');
      var options = $.parseJSON(response);
      noty(options);
  }
  var param = '';
  var $customerList=[ {'columnName':'customer_name','label':'Customer'} ];
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

    $table = $('#category_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			],
        "ajax": {
            "url": "<?php echo base_url();?>index.php/subcategory/get/",
            "type": "POST",
            "data" : function (d) {
            
           }
        },
        "createdRow": function ( row, data, index ) {
          
            $('td',row).eq(0).html(index+1);
            //$('td',row).eq(4).html(enquiry_type[data['type']]);
            $('td', row).eq(4).html('<center><a href="<?php echo base_url();?>index.php/subcategory/edit/'+data['subcategory_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['subcategory_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
          //$('td', row).eq(4).html('<center><a onclick="return confirmDelete('+data['category_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i> </a></center>');
        },

        "columns": [
            { "data": "subcategory_id", "orderable": false },
            { "data": "subcategory_name", "orderable": false },
            { "data": "category_name", "orderable": false },
            { "data": "subcategory_remarks", "orderable": false },
            //{ "data": "category_description", "orderable": false },
            { "data": "subcategory_status", "orderable": false }
            
        ]
        
    } );
    
    
  });
  
  $('#addcategory').on('shown.bs.modal', function () {
    $('#Category').focus();
})  
  
  $(document).on('change','#category_id_fk',function(){
   var a = $('#category_id_fk').val();
   //alert(a);
   if(a =='+')
   {
       
       $('#addcategory').modal();
     
   }
});
function rate(){
  var Category_name = $('#Category').val();
  var Category_desc = $('#Category_remarks').val();
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
         $("#category_id_fk option:last").after('<option value='+data[0]['category_id']+'>'+data[0]['category_name']+'</option>');
          $('#category_id_fk').val(data[0]['category_id']).change(); 
          $('#Category').val('');
          $('#Category_remarks').val('');
        },
        error:function(e){
        console.log("error");
        }

      });
  }
}
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
	function confirmDelete(subcategory_id){
    var conf = confirm("Do you want to Delete Sub Category ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>index.php/subcategory/delete",
            data:{subcategory_id:subcategory_id},
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
	function send()
{document.theform.submit()}


  
</script>
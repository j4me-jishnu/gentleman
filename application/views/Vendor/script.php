<script>
  var response = $("#response").val();
  if(response){
      console.log(response,'response');
      var options = $.parseJSON(response);
      noty(options);
  }
  var param = '';
  var $customerList=[ {'columnName':'customer_name','label':'Customer'} ];
  $(function () {
	
    var enquiry_type = {'J':'Job','C':'Complaint','F':'Follow-up'};
    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Date picker
    $('#start_date').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy'
    });
	$('#end_date').datepicker({
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

    $table = $('#Vendor_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [ 1, 2, 3, 4 , 5, 6,7,8]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 1, 2, 3, 4 , 5, 6,7,8]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 1, 2, 3, 4 , 5, 6,7,8]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 1, 2, 3, 4 , 5, 6,7,8]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [ 1, 2, 3, 4 , 5, 6,7,8]
                }
            },
        ],
        "ajax": {
            "url": "<?php echo base_url();?>Vendor/get",
            "type": "POST",
            "data" : function (d) {
            
           }
        },
        "createdRow": function ( row, data, index ) {
          
			$table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
      var balance = data['total'] - data['paid_amount'];
      var perc = 0; 
      if(data['total'] != 0){
      var perc = parseInt((data['paid_amount'] / data['total'])*100)+'%';
     }
      if(data['total'] == 0)
      {
        $('td', row).eq(10).html('<center><b>'+balance+'</b><br/></center>');
      }
      else if(balance == 0){
         $('td', row).eq(10).html('<center><?php $u = $this->session->userdata('user_type');  ?><b><a href="<?php echo base_url();?>Vendor/paymentHistory/'+data['vendor_id']+'">'+balance+'</b><br/></center>');
      }
      else{
        $('td', row).eq(10).html('<center><?php $u = $this->session->userdata('user_type');  ?><b><a href="<?php echo base_url();?>Vendor/paymentHistory/'+data['vendor_id']+'">'+balance+'</b><br/><a href="<?php echo base_url();?>Vendor/addPayment/'+data['vendor_id']+'/'+data['total']+'">Add payment</a></center>');
      }
      $('td', row).eq(9).html('<center><b>'+perc+'</b><br/></center>');
			$('td', row).eq(11).html('<center><?php $u = $this->session->userdata('user_type'); if($u != 'S'){ ?><a href="<?php echo base_url();?>Vendor/edit/'+data['vendor_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a>&nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['vendor_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a><?php } ?> </center>');
      $('td', row).eq(12).html('<center>&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>Vendor/viewPurchase/'+data['vendor_id']+'"><i class="fa fa-eye" ></i></a></center>');
        },

        "columns": [
            { "data": "vendorstatus", "orderable": true },
            { "data": "vendorname", "orderable": false },
            { "data": "vendoraddress", "orderable": false },
            { "data": "vendorphone", "orderable": false },
			      { "data": "vendoremail", "orderable": false },
      			{ "data": "vendorpan", "orderable": false },
            { "data": "vendorgst", "orderable": false },
            { "data": "total", "orderable": false },
            { "data": "paid_amount", "orderable": false },
            { "data": "vendorgst", "orderable": false },
            { "data": "vendorgst", "orderable": false },
      			{ "data": "vendor_id", "orderable": false },
            { "data": "vendor_id", "orderable": false }
        ]
        
    } );
    
    
  });

 function confirmDelete(vendor_id){
    var conf = confirm("Do you want to Delete Vendor Details ?");
    if(conf){
        $.ajax({
            url:"<?php echo base_url();?>Vendor/delete",
            data:{vendor_id:vendor_id},
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
</script>
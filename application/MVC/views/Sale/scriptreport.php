
<script>

var counter = 0;
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

    $table = $('#sale_report_table').DataTable( {
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
                                total_amount = 0.00;
				d.sale_invoice_number = $("#sale_invoice_number").val();
                                d.sale_totalPrice = $("#sale_totalPrice").val();
                                d.start_date = $("#pmsDateStart").val();
                                d.end_date = $("#pmsDateEnd").val();
                                if(total_amount == 0.00){
                                     total_amount1=0.00;
                                     $("#page_amount").html(total_amount1);
                                    }
            
           }
        },
        "createdRow": function ( row, data, index ) {
            total_amount = parseFloat(total_amount)+ parseFloat(data['sale_totalPrice']);
                                    total_amount = total_amount;
                                    $("#page_amount").html(total_amount);
                                    //alert(total_amount);
            $('td',row).eq(0).html(index+1);
                        $('td', row).eq(5).html('<center><a href="<?php echo base_url();?>index.php/sale/view/'+data['sale_invoice_number']+'/'+data['cust_details']+'"><i class="fa fa-eye" ></i></a> &nbsp;&nbsp;&nbsp; <a href="<?php echo base_url();?>index.php/sale/invoice/'+data['cust_details']+'"><i class="fa  fa-file iconFontSize-medium" ></i></a></center>');
			$('td', row).eq(6).html('<center><a href="<?php echo base_url();?>index.php/sale/edit/'+data['sale_invoice_number']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['sale_invoice_number']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a></center>');
          
        },

        "columns": [
            { "data": "sale_id", "orderable": false },
            { "data": "sale_invoice_number", "orderable": false },
            { "data": "sale_date", "orderable": false },
            { "data": "sale_count", "orderable": false },
            { "data": "sale_totalPrice", "orderable": false },
            { "data": "sale_id", "orderable": false },
            { "data": "sale_id", "orderable": false }
         
            
        ]
        
    } );
    
    
  });
$('#search').click(function () {
        
        $table.ajax.reload();
    });
	

</script>
 

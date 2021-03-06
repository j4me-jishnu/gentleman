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

    $table = $('#mail_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "pagination":false,
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [ 1, 2, 3, 4 , 5, 6]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 1, 2, 3, 4 , 5, 6]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 1, 2, 3, 4 , 5, 6]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 1, 2, 3, 4 , 5, 6]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [ 1, 2, 3, 4 ]
                }
            },
        ],
        "ajax": {
            "url": "<?php echo base_url();?>SetMail/get",
            "type": "POST",
            "data" : function (d) {
            
           }
        },
        "createdRow": function ( row, data, index ) {
          
			$table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
    
			$('td', row).eq(2).html('<center><a href="<?php echo base_url();?>SetMail/edit/'+data['id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a></center>');
        },

        "columns": [
           
            { "data": "status", "orderable": false },
            { "data": "email", "orderable": false },
      		
            { "data": "status", "orderable": false }
        ]
        
    } );
    
    
  });

</script>
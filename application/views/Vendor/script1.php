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

    $table = $('#purchase_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5 ]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5 ]
                }
            },
        ],
        "ajax": {
            "url": "<?php echo base_url();?>Vendor/getPurchase/<?php echo $id ;?>",
            "type": "POST",
            "data" : function (d) {
            
           }
        },
        "createdRow": function ( row, data, index ) {
          
      $table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
     $('td',row).eq(7).html('<center><a href="<?php echo base_url();?>/Orders/'+data['order_file']+'" width="10px" target="_blank"><center>view</center></a></center>');
      
        },

        "columns": [
            { "data": "pr_id", "orderable": true },
            { "data": "invoice_no", "orderable": false },
            { "data": "item_name", "orderable": false },
            { "data": "item_quantity", "orderable": false },
            { "data": "item_total", "orderable": false },
            { "data": "amount_paid", "orderable": false },
            { "data": "item_date", "orderable": false },
            { "data": "order_file", "orderable": false }
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
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
    $(document).on('change','#branch',function () {
	$table.ajax.reload();	
	});

    $table = $('#branch_benchmark').DataTable( {
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "pagination":false,
          dom: 'lBfrtip',
      buttons: [
        {
          extend: 'copy',
          exportOptions: {
            columns: [ 1,2, 3 , 4 ,5]
          }
        },
        {
          extend: 'excel',
          exportOptions: {
            columns: [1,2, 3 , 4 ,5]
          }
        },
        {
          extend: 'pdf',
          exportOptions: {
            columns: [ 1,2, 3 , 4 ,5]
          }
        },
        {
          extend: 'print',
          exportOptions: {
            columns: [ 1,2, 3 , 4 ,5]
          }
        },
        {
          extend: 'csv',
          exportOptions: {
            columns: [1,2, 3 , 4 ,5]
          }
        },
      ],
       
        "ajax": {
            "url": "<?php echo base_url();?>SetBenchmark/get",
            "type": "POST",
            "data" : function (d) {
                d.item = $("#item").val();
                d.branch = $("#branch").val(); 
                d.idate = $("#idate").val(); 
                d.fdate = $("#fdate").val(); 
            
           }
        },
        "createdRow": function ( row, data, index ) {
          
			$table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
    
			
        },

        "columns": [
           
            { "data": "id", "orderable": false },
            { "data": "branch_name", "orderable": false },
            { "data": "item_name", "orderable": false },
            { "data": "benchmark", "orderable": false },
            { "data": "initial_date", "orderable": false },
            { "data": "final_date", "orderable": false }
        ]
        
    } );
    
    
  });


  $table1 = $('#stock_move').DataTable( {
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "pagination":false,
          dom: 'lBfrtip',
      buttons: [
        {
          extend: 'copy',
          exportOptions: {
            columns: [ 1,2, 3 , 4 ]
          }
        },
        {
          extend: 'excel',
          exportOptions: {
            columns: [1,2, 3 , 4]
          }
        },
        {
          extend: 'pdf',
          exportOptions: {
            columns: [ 1,2, 3 , 4 ]
          }
        },
        {
          extend: 'print',
          exportOptions: {
            columns: [ 1,2, 3 , 4 ]
          }
        },
        {
          extend: 'csv',
          exportOptions: {
            columns: [1,2, 3 , 4]
          }
        },
      ],
       
        "ajax": {
            "url": "<?php echo base_url();?>SetBenchmark/getStockmove",
            "type": "POST",
            "data" : function (d) {
                d.item = $("#item").val();
                d.branch = $("#branch").val(); 
                d.idate = $("#idate").val(); 
                d.fdate = $("#fdate").val(); 
            
           }
        },
        "createdRow": function ( row, data, index ) {
          
      $table1.column(0).nodes().each(function(node,index,dt){
            $table1.cell(node).data(index+1);
            });
    
      
        },

        "columns": [
           
            { "data": "issue_id", "orderable": false },
            { "data": "branch_name", "orderable": false },
            { "data": "item_name", "orderable": false },
            { "data": "updated_date", "orderable": false },
            { "data": "item_quantity", "orderable": false },
            
        ]
        
    } );

  $table2 = $('#user_benchmark').DataTable( {
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "pagination":false,
          dom: 'lBfrtip',
      buttons: [
        {
          extend: 'copy',
          exportOptions: {
            columns: [ 1,2, 3 , 4 ]
          }
        },
        {
          extend: 'excel',
          exportOptions: {
            columns: [1,2, 3 , 4,5,6]
          }
        },
        {
          extend: 'pdf',
          exportOptions: {
            columns: [ 1,2, 3 , 4 ,5,6]
          }
        },
        {
          extend: 'print',
          exportOptions: {
            columns: [ 1,2, 3 , 4 ,5,6]
          }
        },
        {
          extend: 'csv',
          exportOptions: {
            columns: [1,2, 3 , 4,5,6]
          }
        },
      ],
       
        "ajax": {
            "url": "<?php echo base_url();?>SetBenchmark/getUserBenchmark",
            "type": "POST",
            "data" : function (d) {
                d.item = $("#item").val();
                d.branch = $("#branch").val(); 
                d.idate = $("#idate").val(); 
                d.fdate = $("#fdate").val(); 
            
           }
        },
        "createdRow": function ( row, data, index ) {
          
      $table2.column(0).nodes().each(function(node,index,dt){
            $table2.cell(node).data(index+1);
            });
    
      
        },

        "columns": [
           
            { "data": "id", "orderable": false },
            { "data": "branch_name", "orderable": false },
            { "data": "item_name", "orderable": false },
            { "data": "username", "orderable": false },
            { "data": "benchmark", "orderable": false },
            { "data": "initial_date", "orderable": false },
            { "data": "final_date", "orderable": false },
            
        ]
        
    } );

  $table3 = $('#issue_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "pagination":false,
          dom: 'lBfrtip',
      buttons: [
        {
          extend: 'copy',
          exportOptions: {
            columns: [ 1,2, 3 , 4 ,5]
          }
        },
        {
          extend: 'excel',
          exportOptions: {
            columns: [1,2, 3 , 4 ,5]
          }
        },
        {
          extend: 'pdf',
          exportOptions: {
            columns: [ 1,2, 3 , 4 ,5]
          }
        },
        {
          extend: 'print',
          exportOptions: {
            columns: [ 1,2, 3 , 4 ,5]
          }
        },
        {
          extend: 'csv',
          exportOptions: {
            columns: [1,2, 3 , 4]
          }
        },
      ],
       
        "ajax": {
            "url": "<?php echo base_url();?>SetBenchmark/getUserissue",
            "type": "POST",
            "data" : function (d) {
                d.item = $("#item").val();
                d.branch = $("#branch").val(); 
                d.idate = $("#idate").val(); 
                d.fdate = $("#fdate").val(); 
            
           }
        },
        "createdRow": function ( row, data, index ) {
          
      $table3.column(0).nodes().each(function(node,index,dt){
            $table3.cell(node).data(index+1);
            });
    
      
        },

        "columns": [
           
            { "data": "issue_id", "orderable": false },
            { "data": "branch_name", "orderable": false },
            { "data": "item_name", "orderable": false },
            { "data": "username", "orderable": false },
            { "data": "issue_quantity", "orderable": false },
            { "data": "issue_date", "orderable": false }
            
            
        ]
        
    } );
    
    
  
  $('#search').click(function () {
    $table.ajax.reload();
    $table1.ajax.reload();
    $table2.ajax.reload();
    $table3.ajax.reload();
});

$(document).on('change','#table',function () {
 var id = $('#table').val();
 if(id==1){
   
  $('#1').show();
  $('#2').hide();
  $('#3').hide();
  $('#4').hide();

 }

 else if(id==2){
   
   $('#1').hide();
   $('#2').show();
   $('#3').hide();
   $('#4').hide();
 
  }

  else if(id==3){
   
   $('#1').hide();
   $('#2').hide();
   $('#3').show();
   $('#4').hide();
 
  }

  if(id==4){
   
   $('#1').hide();
   $('#2').hide();
   $('#3').hide();
   $('#4').show();
 
  }

});



</script>
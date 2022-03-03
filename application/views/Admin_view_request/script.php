<script>
$table = $('#requesttable').DataTable( {
  "processing": true,
  "serverSide": true,
  "bDestroy" : true,
  aLengthMenu: ["All",100,50,25,10],
  dom: 'lBfrtip',
  buttons: [
    {
      extend: 'copy',
      exportOptions: {
        columns: [ 1, 2, 3 , 4]
      }
    },
    {
      extend: 'excel',
      exportOptions: {
        columns: [ 1, 2, 3 , 4 ]
      }
    },
    {
      extend: 'pdf',
      exportOptions: {
        columns: [ 1, 2, 3 , 4 ]
      }
    },
    {
      extend: 'print',
      exportOptions: {
        columns: [ 1, 2, 3 , 4 ]
      }
    },
    {
      extend: 'csv',
      exportOptions: {
        columns: [ 1, 2, 3 , 4 ]
      }
    },
  ],
  "ajax": {
    "url": "<?php echo base_url();?>Admin_view_Request/getRequest/",
    "type": "POST",
    "data" : function (d) {
      d.branch = $("#branch").val();
    }
  },
  "createdRow": function ( row, data, index ) {

    $table.column(0).nodes().each(function(node,index,dt){
      $table.cell(node).data(index+1);
    });

    $('td', row).eq(5).html('<center><button id="modal_button" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-dark" data-quantity='+data['request_quantity']+' data-id='+data['request_id']+' >Edit quantity</button></center>');

    if (data['request_status'] == 0) {
      $('td', row).eq(6).html('<center><a onclick=" checkapp('+data['request_id']+')">&nbsp;&nbsp;Approved &nbsp;&nbsp;&nbsp;</a><div id="app"></center>');
    }
    else if (data['request_status'] == 2) {
      $('td', row).eq(6).html('<center><a onclick=" checkreject('+data['request_id']+')">&nbsp;&nbsp;Rejected &nbsp;&nbsp;&nbsp;</a><div id="rej"></center>');
    }

    else{
      $('td', row).eq(6).html('<center><a href="<?php echo base_url();?>Admin_view_Request/updateToapprove/'+data['request_id']+'">Approve<a onclick="checkapp('+data['request_id']+')"><div id="cp"></div></a> <a onclick="reject('+data['request_id']+')" ><font color="red">Reject</font></a></center><br><center><a href="<?php echo base_url();?>Admin_view_Request/edit/'+data['request_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a></center>');
    }
  },

  "columns": [
    { "data": "item_id", "orderable": true },
    { "data": "branch_name", "orderable": true },
    { "data": "item_name", "orderable": false },
    { "data": "request_date", "orderable": false },
    { "data": "request_quantity", "orderable": false},
    { "data": "request_id", "orderable": false},
    { "data": "request_id", "orderable": false}
  ]
} );

// ###################################################Modal########################################################
$(document).on('click','#modal_button',function(){
  // var x = this.getAttribute("data-id");
  document.getElementById("req_id").value = parseFloat(this.getAttribute("data-id"));
  document.getElementById("req_quantity").value = parseFloat(this.getAttribute("data-quantity"));
})
// ################################################################################################################

function reject(request_id){
  $("#request_id").val(request_id);
  $('#myModal').modal('show');
  $('#req_id').val(request_id);
}

function modal_submit(){
  var request_id=$('#req_id').val();
  var reason = $('#reject_reason').val();
  $.ajax({
    url:"<?php echo base_url();?>Admin_view_Request/updateToreject",
    type: 'POST',
    data:{
      req_id:request_id,
      reason:reason
    },
    dataType: 'json',
    success:function(data){
      location.reload();
    }
  });
}
function checkapp(request_id){
  var rt = request_id;
  //alert(pr);
  $.ajax({
    url:"<?php echo base_url();?>Admin_view_Request/get_operator_aprove",
    type: 'POST',
    data:{request_id:request_id},
    dataType: 'json',
    success:function(data){
      $('#app').html();
    }


  });
}
function checkreject(request_id){
  var rt = request_id;
  //alert(pr);
  $.ajax({
    url:"<?php echo base_url();?>Admin_view_Request/get_operator",
    type: 'POST',
    data:{request_id:request_id},
    dataType: 'json',
    success:function(data){
      console.log(data);

      alert(data)
      $('#rej').html();

    }


  });
}

$(document).on('change','#itemid',function(){
  var itemid = $(this).val();
  if(itemid!=''){
    $.ajax({
      url:"<?php echo base_url()?>Stockmovement/checkstock",
      type: 'POST',
      data: {itemid:itemid},
      dataType: 'json',
      success:
      function(data)
      {
        console.log(data);
        $('#avail').html(data);
        $('#available').show();
      },
      error:function(e){
        console.log("error");
      }
    });
  }
});

$(document).on('change','#quantity',function(){
  var quantity = parseFloat($(this).val());
  var avialable = parseFloat($('#avail').html());
  var sum = parseFloat($('#sum').val());
  var benchmark = parseFloat($('#benchmark').val());
  var sum1=sum+quantity;
  console.log('quantity',quantity);
  console.log('availaaaa',avialable);
  console.log('sum',sum);
  console.log('benchmark',benchmark);
  if(quantity >= avialable || quantity <= 0)
  {
    var options1 = {
      'title': 'Error',
      'style': 'error',
      'message': 'Input Below or equal Available....!',
      'icon': 'warning',
    };
    var n1 = new notify(options1);
    n1.show();
    setTimeout(function(){
      n1.hide();
    }, 3000);
    $('#quantity').val('');
  }

  else if(benchmark !=0 && sum1>benchmark)
  {
    var options1 = {
      'title': 'Error',
      'style': 'error',
      'message': 'Input Exceeds the Benchmark...!',
      'icon': 'warning',
    };
    var n1 = new notify(options1);
    n1.show();
    setTimeout(function(){
      n1.hide();
    }, 3000);
    $('#quantity').val('');
  }
});

var response = $("#response").val();
if(response){
  console.log(response,'response');
  var options = $.parseJSON(response);
  noty(options);
}

</script>


<script>

$(function () {

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



  $table = $('#designation_table').DataTable( {

    "processing": true,

    "serverSide": false,

    "bDestroy" : true,

    dom: 'lBfrtip',
    aLengthMenu: [
        [100, 200, 300, 400, -1],
        [100, 200, 300, 400, "All"]
    ],

    buttons: [

      {

        extend: 'copy',

        exportOptions: {

          columns: [ 1, 2]

        }

      },

      {

        extend: 'excel',

        exportOptions: {

          columns: [ 1, 2]

        }

      },

      {

        extend: 'pdf',

        exportOptions: {

          columns: [ 1, 2]

        }

      },

      {

        extend: 'print',

        exportOptions: {

          columns: [ 1, 2]

        }

      },

      {

        extend: 'csv',

        exportOptions: {

          columns: [ 1, 2]

        }

      },

    ],

    "ajax": {

      "url": "<?php echo base_url();?>NewMaster/getPurchaseList/",

      'dataSrc':"",

      "type": "POST",

      "data" : function (d) {



      }

    },

    "createdRow": function ( row, data, index ) {



      $table.column(0).nodes().each(function(node,index,dt){

        $table.cell(node).data(index+1);

      });

      $('td', row).eq(9).html('<center><?php $u = $this->session->userdata('user_type'); if($u != 'S'){ ?><a href="<?php echo base_url();?>designation/edit/'+data['purcahse_id']+'"><i class="fa fa-edit iconFontSize-medium" ></i></a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['purcahse_id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a><?php } ?></center>');

    },



    "columns": [

      { "data": "purchase_status", "orderable": true },

      { "data": "vendor_name", "orderable": false },

      { "data": "item_name", "orderable": false },

      { "data": "purchase_bill_no", "orderable": false },

      { "data": "purchase_gst_no", "orderable": false },

      { "data": "purchase_qty", "orderable": false },

      { "data": "purchase_price", "orderable": false },

      { "data": "purchase_tax", "orderable": false },

      { "data": "purchase_date", "orderable": false },

      { "data": null, "defaultContent":""},

    ]

  } );

});

function confirmDelete(purcahse_id){

  var conf = confirm("Do you want to Delete Purchase Details ?");

  if(conf){

    $.ajax({

      url:"<?php echo base_url();?>NewMaster/deletePurchaseDetails",

      data:{purcahse_id:purcahse_id},

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

var response = $("#response").val();

if(response){

  // console.log(response,'response');

  var options = $.parseJSON(response);

  noty(options);

}



function addMore()
  {
    var count=$('#counter').val();
    var counter = parseFloat(count) + 1;
    var cust_id=$('#cust').val();
        var cmp_id = $('#company').val();
    $.ajax({
            url:"<?php echo base_url();?>NewMaster/ajaxItemList",
            type:'POST',
            dataType:"json",
            success:function(data){
              var html = '<option>SELECT</option>';
                var code = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].item_id+'>'+data[i].item_name+'</option>';
                    }
                    $('#productid_'+counter+'').html(html);
                }
            });

    var htmlVal='<DIV class="product-item box box-info id="list_'+counter+'"><div class="row"><div class="col-md-1"><br><input type="checkbox" name="item_index[]"/></div><div class="col-md-2"><br><select name="item_list_id[]" class="form-control select2" data-pms-required="true" data-pms-type="dropDown"  id="productid_'+counter+'" autofocus /></select></div><div class="col-md-2"><br><input type="text" name="pur_qty[]" class="form-control" id="quantity_'+counter+'" placeholder="Quantity" onkeyup="getSum('+counter+');"></div><div class="col-md-2"><br><input type="text" name="pur_price[]" class="form-control" id="price_'+counter+'" placeholder="Price" onkeyup="getSum('+counter+');"></div><div class="col-md-2"><br><input type="text" name="pur_tax[]" class="form-control" id="tax_'+counter+'" placeholder="%" onkeyup="getSum('+counter+');"></div><div class="col-md-2"><br><input type="text" name="pur_total[]" class="form-control" id="total_'+counter+'" placeholder="Total Price"></div>';
    $("#service").append(htmlVal);
    $('#counter').val(counter);        
  }

  function deleteRow() {
    $('DIV.product-item').each(function(index, item){
        jQuery(':checkbox', this).each(function () {
            if ($(this).is(':checked')) {
                $(item).remove();
                var counter = $('#counter').val();
                counter = counter - 1;
                $('#counter').val(counter);
                getNetTotal();
            }
        });
    });
}


function getSum(row_id)
	{
    var totals;
    var total;
    var tax_amt;
		var quantity=$('#quantity_'+row_id+'').val();
        if (! quantity)
        {
            alert('Please enter quantity');
        }
        else
        {
            var price=$('#price_'+row_id+'').val();
            var tax = $('#tax_'+row_id+'').val();
           
            total = parseFloat(price) * parseFloat(quantity);
            tax_amt = parseFloat(total) * parseFloat(tax)/100;
            totals = parseFloat(total) + parseFloat(tax_amt);

            $('#total_'+row_id+'').val(totals);

        }
	}


</script>


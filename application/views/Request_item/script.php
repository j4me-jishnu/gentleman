<script>
  var param = '';
  var $nameList = [{
    'columnName': 'username',
    'label': 'Name'
  }];
  $('#emp_name').rcm_autoComplete('<?php echo base_url(); ?>common/getEmployeeList', $nameList, param, getEmplyeName);

  function getEmplyeName(el, event, item) {
    console.log(el);
    console.log(el.next());
    if (item.user_id) {
      el.val(item.username);
      $("#userid").val(item.user_id).change();
    }
  }
  $(document).on('change', '#itemid', function() {
    var itemid = $(this).val();
    if (itemid != '') {
      $.ajax({
        url: "<?php echo base_url() ?>issueitem/checkstock",
        type: 'POST',
        data: {
          itemid: itemid
        },
        dataType: 'json',
        success: function(data) {
          $('#avail').html(data['total']);
          $('#available').show();
        },
        error: function(e) {
          console.log("error");
        }
      });
    }
  });
  $(document).on('change', '#quantity', function() {
    var q = $(this).val();
    var itemid = $('#itemid').val();
    if (itemid == '') {
      var options1 = {
        'title': 'Error',
        'style': 'error',
        'message': 'Please Select Item....!',
        'icon': 'warning',
      };
      var n1 = new notify(options1);
      n1.show();
      setTimeout(function() {
        n1.hide();
      }, 3000);
      $('#quantity').val('');
    } else if (q != '') {
      $.ajax({
        url: "<?php echo base_url() ?>issueitem/checkstock",
        type: 'POST',
        data: {
          itemid: itemid
        },
        dataType: 'json',
        success: function(data) {

          if (parseFloat(q) >= data['issuedqua']) {
            var options1 = {
              'title': 'Error',
              'style': 'error',
              'message': 'Input Below or equal Available....!',
              'icon': 'warning',
            };
            var n1 = new notify(options1);
            n1.show();
            setTimeout(function() {
              n1.hide();
            }, 3000);
            $('#quantity').val('');
          }

        },
        error: function(e) {
          console.log("error");
        }
      });
    }
  });
  $('#date').datepicker({
    autoclose: true,
    format: 'dd/mm/yyyy'
  });
  var response = $("#response").val();
  if (response) {
    console.log(response, 'response');
    var options = $.parseJSON(response);
    noty(options);
  }
  $table = $('#requestable').DataTable({
    "processing": true,
    "serverSide": true,
    "bDestroy": true,
    dom: 'lBfrtip',
    buttons: [{
        extend: 'copy',
        exportOptions: {
          columns: [1, 2, 3]
        }
      },
      {
        extend: 'excel',
        exportOptions: {
          columns: [1, 2, 3]
        }
      },
      {
        extend: 'pdf',
        exportOptions: {
          columns: [1, 2, 3]
        }
      },
      {
        extend: 'print',
        exportOptions: {
          columns: [1, 2, 3]
        }
      },
      {
        extend: 'csv',
        exportOptions: {
          columns: [1, 2, 3]
        }
      },
    ],
    "ajax": {
      "url": "<?php echo base_url(); ?>Request_item/get/",
      "type": "POST",
      "data": function(d) {

      }
    },
    "createdRow": function(row, data, index) {

      $table.column(0).nodes().each(function(node, index, dt) {
        $table.cell(node).data(index + 1);
      });
      if (data['request_status'] == 0) {
        $('td', row).eq(4).html('<a onclick="checkop(' + data['request_id'] + ')"><center>Approved</center></a>');
      } else if (data['request_status'] == 2) {
        $('td', row).eq(4).html('<a onclick="checkopreject(' + data['request_id'] + ')"><center><font color="red">Rejected</font></center></a>');
      } else {
        $('td', row).eq(4).html('<a onclick="checkoppending(' + data['request_id'] + ')"><center>Pending</center></a>');
      }
    },

    "columns": [{
        "data": "request_id",
        "orderable": true
      },
      {
        "data": "item_name",
        "orderable": false
      },
      {
        "data": "request_quantity",
        "orderable": false
      },
      {
        "data": "request_date",
        "orderable": false
      },
      {
        "data": "request_date",
        "orderable": false
      }


    ]
  });

  function confirmDelete(request_id) {
    var conf = confirm("Do you want to Delete Request Details ?");
    if (conf) {
      $.ajax({
        url: "<?php echo base_url(); ?>Request_item/delete",
        data: {
          request_id: request_id
        },
        method: "POST",
        datatype: "json",
        success: function(data) {
          var options = $.parseJSON(data);
          noty(options);
          $table.ajax.reload();
        }
      });

    }
  }


  function checkop(request_id) {

    var request_id = request_id;
    //alert(pr);
    $.ajax({
      url: "<?php echo base_url(); ?>Request_item/get_operator",
      type: 'POST',
      data: {
        request_id: request_id
      },
      dataType: 'json',
      success: function(data) {
        console.log(data);

        alert('Approved by ' + data)



        $('#op').html();

      }


    });



  }

  function checkopreject(request_id) {

    var request_id = request_id;
    //alert(pr);
    $.ajax({
      url: "<?php echo base_url(); ?>Request_item/get_operator",
      type: 'POST',
      data: {
        request_id: request_id
      },
      dataType: 'json',
      success: function(data) {
        console.log(data);

        alert('Rejected by ' + data)



        $('#op').html();

      }


    });


  }

  function checkoppending(request_id) {

    var request_id = request_id;
    //alert(pr);
    $.ajax({
      url: "<?php echo base_url(); ?>Request_item/get_operator",
      type: 'POST',
      data: {
        request_id: request_id
      },
      dataType: 'json',
      success: function(data) {
        console.log(data);

        alert('Pending by ' + data)



        $('#op').html();

      }


    });


  }
</script>

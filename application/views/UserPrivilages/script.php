<script>
$(function () {
  var branchtype = $('#branchtype').val();
  if(branchtype!=0){$('#branch_type').val(branchtype).change();}
  var isactive = $('#isactive').val();
  if(isactive){$('#is_active').attr('checked', true);}
  var ishead = $('#ishead').val();
  if(ishead!=0){$('#is_head').attr('checked', true);}
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

  $table = $('#branch_table').DataTable( {
    "processing": true,
    "serverSide": true,
    "bDestroy" : true,
    "ajax": {
      "url": "<?php echo base_url();?>UserPrivilages/get/",
      "type": "POST",
      "data" : function (d) {
      }
    },
    "createdRow": function ( row, data, index ) {

      $table.column(0).nodes().each(function(node,index,dt){
        $table.cell(node).data(index+1);
      });
      var h = data['is_head'];
      if(h==1){ var head='head office'; }else{head=''}
      $('td', row).eq(5).html('<center><?php $u = $this->session->userdata('user_type'); if($u != 'S'){ ?><a href="<?php echo base_url();?>UserPrivilages/edit/'+data['id']+'"><i class="fa fa-edit iconFontSize-medium" ></i>Change Privilage</a> &nbsp;&nbsp;&nbsp;<a onclick="return confirmDelete('+data['id']+')"><i class="fa fa-trash-o iconFontSize-medium" ></i></a><?php } ?></center>');
    },

    "columns": [
      { "data": "user_name", "orderable": true },
      { "data": "user_name", "orderable": false },
      { "data": "user_email", "orderable": false },
      { "data": "user_branch", "orderable": false },
      { "data": "user_type", "orderable": false },
      { "data": "user_type", "orderable": false },
    ]
  } );
});
function confirmDelete(emp_id){
  var conf = confirm("Do you want to Delete User ?");
  if(conf){
    $.ajax({
      url:"<?php echo base_url();?>UserPrivilages/delete",
      data:{emp_id:emp_id},
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
  console.log(response,'response');
  var options = $.parseJSON(response);
  noty(options);
}
</script>

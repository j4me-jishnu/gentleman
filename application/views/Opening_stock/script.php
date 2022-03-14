<script>
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

    var htmlVal='<DIV class="product-item box box-info id="list_'+counter+'"><div class="row"><div class="col-md-1"><br><input type="checkbox" name="item_index[]"/></div><div class="col-md-4"><br><input type="text" name="item_names[]" class="form-control" id="quantity_'+counter+'" placeholder="Item Name" style="text-transform:uppercase;"></div><div class="col-md-4"><br><input type="text" name="quantities[]" class="form-control" id="price_'+counter+'" placeholder="Quantity"></div>';
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
</script>
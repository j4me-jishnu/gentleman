<script type="text/javascript">

$('#addstock').click(function(){
  $.ajax({
    url: "<?php echo base_url(); ?>NewCommon/getItemList",
    dataType: "json",
    type: "Post",
    async: true,
    data: {},
    success: function (data) {
      $.each(data, function(key, value) {
        $('#mySelect')
        .append($("<option></option>")
        .attr("value", value.item_id)
        .text(value.item_name));
      });
    },
  });
})

</script>

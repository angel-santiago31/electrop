$(function() {
   $('#updateOrderStatus').click(function() {
       if($('#updateOrderStatus').prop('enabled')){
            $('#modalS').modal('show')
           .find('#modalContent')
           .load($(this).attr('value'));
       }
   });
});

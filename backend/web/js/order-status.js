$(function() {
   $('#updateOrderStatus').click(function() {
            $('#modalS').modal('show')
           .find('#modalContent')
           .load($(this).attr('value'));
   });
});

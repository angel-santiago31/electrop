$(function() {
   // get the click for updating personal data
   $('#updatePhoneNumber').click(function() {
       $('#modal').modal('show')
           .find('#modalContent')
           .load($(this).attr('value'));
       //document.getElementById(‘modalHeader’).innerHTML = ‘<h4>’ + $(this).attr(‘title’) + ‘</h4>’;
   });
});

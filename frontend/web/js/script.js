$(function() {
$('.phone_us').mask('(000) 000-0000');

$('.sid').mask('000-00-0000');

$('.krajee-datepicker').mask('00/AAA/0000', { selectOnFocus: true });

$('.date-picker').mask('00-00-0000', { 'translation': { 0: { pattern: /[0-9*]/ } } });
});
});
$(document).on('click', '.ajaxLoad', function(e){
        e.preventDefault();
        $('#main-content').load($(this).attr('url'));
        return false;
});
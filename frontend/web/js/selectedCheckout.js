$(document).ready(function(){
    var chk;
    $("#grid input[type=radio]").click(function(){
        chk = this.value;
    });

    $("#submit-order").click(function(){
        var data = { checked: chk };

        $("#payment_field").val(chk);
    });

});
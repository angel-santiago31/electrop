$(document).ready(function(){
    $("#grid input[type=radio]").click(function(){
        var keys = $('#grid').yiiGridView('getSelectedRows');
        var chk = this.child;
        console.log(keys);
        console.log(chk);
    });
});
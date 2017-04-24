$(document).ready(function() {
    var quantity = $('#item-quantity').val();
    var price = $('#item-gross_price').val();
    var qtyRemaining = parseInt($('#qtyRemaining').text(), 10);

    $("#decrementar").click(function(e) {
        quantity--;

        if (quantity <= 1) {
            quantity = 1;
            $('#decrementar').attr('disabled', true);
        }

        $('#item-quantity').val(quantity);

        var t = quantity * price;
        p = t.toFixed(2);
        $("#precioDisplay").text(p.toString());

        $("#qtyD").text(quantity.toString());

        if($('#incrementar').prop('disabled')){
            $('#incrementar').attr('disabled', false);
        }
    });

    $("#incrementar").click(function() {
                
        quantity++;

        $('#item-quantity').val(quantity);

        var t = quantity * price;
        p = t.toFixed(2);
        $("#precioDisplay").text(p.toString());

        $("#qtyD").text(quantity.toString());

        if(quantity === (qtyRemaining + 1)){
            $(this).prop('disabled', true);
        }

        if (quantity > 1) {
            $('#decrementar').attr('disabled', false);
        }
        
    });
});
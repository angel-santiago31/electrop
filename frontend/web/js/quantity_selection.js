$(document).ready(function(){
    var quantity = $('#item-quantity').val();
    var price = $('#item-gross_price').val();

    $("#decrementar").click(function(){
        quantity--;

        if (quantity < 1) {
            quantity = 1;
        }

        $('#item-quantity').val(quantity);

        var t = quantity * price;
        p = t.toFixed(2);
        $("#precioDisplay").text(p.toString());

        $("#qtyD").text(quantity.toString());
    });

    $("#incrementar").click(function(){
        quantity++;

        $('#item-quantity').val(quantity);

        var t = quantity * price;
        p = t.toFixed(2);
        $("#precioDisplay").text(p.toString());

        $("#qtyD").text(quantity.toString());
    });
});

//Variable to control quantities.
var quantity = 1;

//Request at page's first load"
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("quantity").innerHTML = quantity;
    }
};
xmlhttp.open("GET", "index.php?r=item%2Fdetails&id=4", true);
xmlhttp.send();

var basePrice = Number(document.getElementById('precioDisplay').innerText);

//If the user decreases, delete one from the variable and update in the view.
$('#decrementar').click(function() {
    if (quantity !== 0) {
        quantity = quantity - 1;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("quantity").innerHTML = quantity;
                document.getElementById("precioDisplay").innerHTML = (basePrice * quantity).toFixed(2);
            }
        };
        xmlhttp.open("GET", "index.php?r=item%2Fdetails&id=4", true);
        xmlhttp.send();

        var data = { qty: quantity };

        $.post('index.php?r=item%2Fdetails&id=4', data, function(returnedData) {
        // do something here with the returnedData
        console.log(returnedData);
    });
    }
});

//If the user increases, add one on the variable and update in the view.
$('#incrementar').click(function() {
    quantity = quantity + 1;

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("quantity").innerHTML = quantity;
            document.getElementById("precioDisplay").innerHTML = (basePrice * quantity).toFixed(2);
        }
    };
    xmlhttp.open("GET", "index.php?r=item%2Fdetails&id=4", true);
    xmlhttp.send();

    var data = { qty: quantity };

    $.post('index.php?r=item%2Fdetails&id=4', data, function(returnedData) {
    // do something here with the returnedData
    console.log(returnedData);
});
});
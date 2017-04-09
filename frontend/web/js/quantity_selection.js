//Variable to control quantities.
var quantity = 1;
// Stores the base price of the item
var basePrice = Number(("#basePrice").val());

//Request at page's first load"
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("quantity").innerHTML = quantity;
    }
};
xmlhttp.open("GET", "index.php?r=item%2Fdetails&id=4", true);
xmlhttp.send();

//If the user decreases, delete one from the variable and update in the view.
$('#decrementar').click(function() {
    if (quantity !== 0) {
        quantity = quantity - 1;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("quantity").innerHTML = basePrice * quantity;
                document.getElementById("precioDisplay").innerHTML = basePrice * quantity;
            }
        };
        xmlhttp.open("GET", "index.php?r=item%2Fdetails&id=4", true);
        xmlhttp.send();
    }
});

//If the user increases, add one on the variable and update in the view.
$('#incrementar').click(function() {
    quantity = quantity + 1;

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("quantity").innerHTML = basePrice * quantity;
            document.getElementById("precioDisplay").innerHTML = basePrice * quantity;
        }
    };
    xmlhttp.open("GET", "index.php?r=item%2Fdetails&id=4", true);
    xmlhttp.send();
});
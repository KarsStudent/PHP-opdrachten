<?php

include "./phpsheets/arrayPizza's.php";

function displayPizza() {
    global $arrayPizza;

    foreach ($arrayPizza as $pizzaNaam => $pizzaPrijs) {
        echo "<span class='pizzaKader'>";
        echo "<label for='$pizzaNaam' class='pizzaNaam'>$pizzaNaam:</label>";
        echo "<img src='./images/DefaultPizzaImage.jpg' alt='Pizza $pizzaNaam' class='pizzaImage'>";
        echo "<p class='pizzaPrijs'>".prijs($pizzaNaam)."</p>";
        echo "<input type='number' placeholder='$pizzaNaam' min='0' max='10' id='$pizzaNaam' name='$pizzaNaam' value='0' class='hoeveelheid'><br>";
        echo "</span>";
    }
}

function prijs($pizza) {
    global $arrayPizza;

    return "€".number_format($arrayPizza[$pizza], 2, ",", ".");
}

function normalePrijs() {
    global $arrayPizza;

    foreach ($arrayPizza as $pizzaNaam => $pizzaPrijs) {
        echo "<p>$pizzaNaam: €".number_format($pizzaPrijs, 2, ",", ".")."</p>";
    }
}

function vrijdagPrijs() {
    global $arrayPizza;

    foreach ($arrayPizza as $pizzaNaam => $pizzaPrijs) {
        $pizzaTotaal = $pizzaPrijs * 0.85;

        echo "<p>$pizzaNaam: €".number_format($pizzaTotaal, 2, ",", ".")."</p>";
    }
}

?>
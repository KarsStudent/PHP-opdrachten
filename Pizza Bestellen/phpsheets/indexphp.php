<?php

include "./phpsheets/arrayPizza's.php";

function prijs($pizza) {
    global $arrayPizza;

    if (date("l") == "Monday") {
        return "€7,50";
    } else if (date("l") == "Friday") {
        $prijs = $arrayPizza[$pizza] * 0.85;
        return "€".number_format($prijs, 2, ",", ".");
    } else {
        return "€".number_format($arrayPizza[$pizza], 2, ",", ".");
    }
}

foreach ($arrayPizza as $pizzaNaam => $pizzaPrijs) {
    echo "<span class='pizzaKader'>";
    echo "<label for='$pizzaNaam' class='pizzaNaam'>$pizzaNaam:</label>";
    echo "<img src='./images/Hawaii.jpg' alt='Pizza $pizzaNaam' class='pizzaImage'>";
    echo "<p class='pizzaPrijs'>".prijs("$pizzaNaam")."</p>";
    echo "<input type='number' placeholder='$pizzaNaam' min='0' max='10' id='$pizzaNaam' name='$pizzaNaam' value='0' class='hoeveelheid'><br>";
    echo "</span>";
}

?>
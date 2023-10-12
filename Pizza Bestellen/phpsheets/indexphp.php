<?php

$pizzaPrijs = array (
    "Margarita" => 12.50,
    "Funghi" => 12.50,
    "Marina" => 13.95,
    "Hawaii" => 11.50,
    "Formaggi" => 14.50
);

function prijs($pizza) {
    global $pizzaPrijs;
    if (date("l") == "Monday") {
        return "€7,50";
    } else if (date("l") == "Friday") {
        $prijs = $pizzaPrijs[$pizza] * 0.85;
        return "€".number_format($prijs, 2, ",", ",");
    } else {
        return "€".number_format($pizzaPrijs[$pizza], 2, ",", ",");
    }
}

?>
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

function tenminste1Pizza() {
    global $pizzaPrijs;

    if (isset($_POST["keuze_opslaan"])) {
        $aantalPizzas = 0;

        foreach ($pizzaPrijs as $pizzaNaam => $placeholder) {
            $aantalPizzas += $_POST[$pizzaNaam];
        }

        if ($aantalPizzas <= 0) {
            echo "<h3 class='tenminste1Pizza'>Kies tenminste 1 pizza!</h3>";
        }
    }
}

function doorsturen() {
    global $pizzaPrijs;

    $aantalPizzas = 0;

    if (isset($_POST["keuze_opslaan"])) {
        foreach ($pizzaPrijs as $pizzaNaam => $placeholder) {
            $aantalPizzas += $_POST[$pizzaNaam];
        }

        if ($aantalPizzas >= 0) {
            echo "./bevestiging.php";
        }
    }
}

?>
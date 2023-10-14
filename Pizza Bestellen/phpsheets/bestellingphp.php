<?php

if (isset($_POST["keuze_opslaan"])) {

    $pizzaPrijs = array (
        "Margarita" => 12.50,
        "Funghi" => 12.50,
        "Marina" => 13.95,
        "Hawaii" => 11.50,
        "Formaggi" => 14.50
    );

    $aantalPizzas = 0;

    foreach ($pizzaPrijs as $pizzaNaam => $placeholder) {
        $aantalPizzas += $_POST[$pizzaNaam];
    }

    if ($aantalPizzas <= 0) {
        echo "<h3>Kies tenminste 1 pizza!</h3>";
        echo "<a href='./index.php'><button>Terug</button></a>";
        exit;
    }

    $totaalPrijs = 0;

    echo ("<h2>Pizza's:</h2>");

    if (date("l") == "Monday") {
        foreach ($pizzaPrijs as $pizzaNaam => $pizzaPrijs) {
            $pizzaTotaal = 7.50 * $_POST[$pizzaNaam];

            $totaalPrijs += $pizzaTotaal;

            echo "<p>$pizzaNaam: Aantal: ".$_POST[$pizzaNaam]." €".number_format($pizzaTotaal, 2, ",", ".")."</p>";
        }
    } else if (date("l") == "Friday") {
        foreach ($pizzaPrijs as $pizzaNaam => $pizzaPrijs) {
            $pizzaTotaal = $pizzaPrijs * 0.85 * $_POST[$pizzaNaam];

            $totaalPrijs += $pizzaTotaal;

            echo "<p>$pizzaNaam: Aantal: ".$_POST[$pizzaNaam]." €".number_format($pizzaTotaal, 2, ",", ".")."</p>";
        }
    } else {
        foreach ($pizzaPrijs as $pizzaNaam => $pizzaPrijs) {
            $pizzaTotaal = $pizzaPrijs * $_POST[$pizzaNaam];

            $totaalPrijs += $pizzaTotaal;

            echo "<p>$pizzaNaam: Aantal: ".$_POST[$pizzaNaam]." €".number_format($pizzaTotaal, 2, ",", ".")."</p>";
        }
    }

    if ($_POST["bezorgen"] == "Bezorgen") {
        $totaalPrijs += 5;

        echo "Bezorg kosten: €5,00";
    }

    echo ("<p class='totaal'>Totaal: €".number_format($totaalPrijs, 2, ",", ".")."</p>");
}

?>
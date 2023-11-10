<?php

if (isset($_POST["keuze_opslaan"])) {
    include "arrayPizza's.php";

    $aantalPizzas = 0;
    $totaalPrijs = 0;

    $datum = strtotime($_POST["datum"]);
    $dag = date("l", $datum);

    echo ("<h2>Bestelling:</h2>");

    foreach ($arrayPizza as $pizzaNaam => $pizzaPrijs) {
        if ($dag == "Monday") {
            $pizzaTotaal = 7.50 * $_POST[$pizzaNaam];

            $totaalPrijs += $pizzaTotaal;

            if ($_POST[$pizzaNaam] > 0) {
                echo "<p>Aantal: ".$_POST[$pizzaNaam]." $pizzaNaam: €".number_format($pizzaTotaal, 2, ",", ".")."</p>";
            }
        } else if ($dag == "Friday") {
            $pizzaTotaal = $pizzaPrijs * 0.85 * $_POST[$pizzaNaam];

            $totaalPrijs += $pizzaTotaal;

            if ($_POST[$pizzaNaam] > 0) {
                echo "<p>Aantal: ".$_POST[$pizzaNaam]." $pizzaNaam: €".number_format($pizzaTotaal, 2, ",", ".")."</p>";
            }
        } else {
            $pizzaTotaal = $pizzaPrijs * $_POST[$pizzaNaam];

            $totaalPrijs += $pizzaTotaal;

            if ($_POST[$pizzaNaam] > 0) {
                echo "<p>Aantal: ".$_POST[$pizzaNaam]." $pizzaNaam: €".number_format($pizzaTotaal, 2, ",", ".")."</p>";
            }
        }
    }

    if ($_POST["bezorgen"] == "Bezorgen") {
        $totaalPrijs += 5;

        echo "Bezorg kosten: €5,00";
    }

    echo ("<p class='totaal'>Totaal: €".number_format($totaalPrijs, 2, ",", ".")."</p>");
}

?>
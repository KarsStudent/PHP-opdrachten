<?php

include "arrayPizza's.php";

function eenPizza() {
    global $arrayPizza;

    if (isset($_POST["keuze_opslaan"])) {        
        $aantalPizzas = 0;

        foreach ($arrayPizza as $pizzaNaam => $placeholder) {
            $aantalPizzas += $_POST[$pizzaNaam];
        }

        if ($aantalPizzas <= 0) {
            echo "<h1>Kies tenminste 1 pizza!</h1>";
            echo "<a href='./index.php'><button>Terug</button></a>";
            exit;
        } else {
            echo "<h1>Bedankt voor uw bestelling!</h1>";
        }
    }
}

function bestelling() {
    global $arrayPizza;

    if (isset($_POST["keuze_opslaan"])) {
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
}

function gegevens() {
    $datum = str_replace("T", " ", $_POST["datum"]);

    echo ("<h2>Gegevens:</h2>");
    echo ("<p>Naam: ".$_POST["naam"]."</p>");
    echo ("<p>Adres: ".$_POST["adres"]."</p>");
    echo ("<p>Postcode: ".$_POST["postcode"]."</p>");
    echo ("<p>Plaats: ".$_POST["plaats"]."</p>");
    echo ("<p>Bezorgdatum: $datum</p>");
    echo ("<p>Afhalen of bezorgen: ".$_POST["bezorgen"]."</p>");
}

?>
<?php

$datum = str_replace("T", " ", $_POST["datum"]);

echo ("<h2>Gegevens:</h2>");
echo ("<p>Naam: ".$_POST["naam"]."</p>");
echo ("<p>Adres: ".$_POST["adres"]."</p>");
echo ("<p>Postcode: ".$_POST["postcode"]."</p>");
echo ("<p>Plaats: ".$_POST["plaats"]."</p>");
echo ("<p>Bezorgdatum: $datum</p>");
echo ("<p>Afhalen of bezorgen: ".$_POST["bezorgen"]."</p>");

?>
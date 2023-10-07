<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza la Zoltar</title>
</head>
<body>
    <form action="./index.php" method="post">
        Naam:
        <input type="text" placeholder="Naam" name="naam" maxlength="20" required><br>

        Adres:
        <input type="text" placeholder="Adres" name="adres" maxlength="20" required><br>

        Postcode:
        <input type="text" placeholder="Postcode" name="postcode" maxlength="6" required><br>

        Plaats:
        <input type="text" placeholder="Plaats" name="plaats" maxlength="20" required><br>

        Besteldatum:
        <input type="datetime-local" name="datum" value="<?= Date("Y-m-d\TH:i") ?>"><br>

        Bezorgen of afhalen:
        <br>
        Afhalen:<input type="radio" name="bezorgen" value="afhalen" checked="checked"><br>
        Bezorgen:<input type="radio" name="bezorgen" value="bezorgen">
        <br><br>

        Pizza's:<br>
        Margarita:<input type="number" placeholder="Margarita" min="0" max="10" name="Margarita" value="0"><br>
        Funghi:<input type="number" placeholder="Funghi" min="0" max="10" name="Funghi" value="0"><br>
        Marina:<input type="number" placeholder="Marina" min="0" max="10" name="Marina" value="0"><br>
        Hawaii:<input type="number" placeholder="Hawaii" min="0" max="10" name="Hawaii" value="0"><br>
        Quatro Formaggi:<input type="number" placeholder="Quatro Formaggi" min="0" max="10" name="Formaggi" value="0"><br>

        <br>
        <input type="submit" value="submit" name="submit">
    </form>

    <?php

    if (isset($_POST["submit"])) {

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
        }

        $totaalPrijs = 0;

        echo ("<h2>Pizza's:</h2>");

        if (date("l") == "Monday") {
            foreach ($pizzaPrijs as $pizzaNaam => $pizzaPrijs) {
                $pizzaTotaal = 7.50 * $_POST[$pizzaNaam];

                $totaalPrijs += $pizzaTotaal;

                echo "<p>$pizzaNaam: Aantal: ".$_POST[$pizzaNaam]." ".number_format($pizzaTotaal, 2, ",", ",")."</p>";
            }
        } else if (date("l") == "Friday") {
            foreach ($pizzaPrijs as $pizzaNaam => $pizzaPrijs) {
                $pizzaTotaal = $pizzaPrijs * 0.85 * $_POST[$pizzaNaam];

                $totaalPrijs += $pizzaTotaal;

                echo "<p>$pizzaNaam: Aantal: ".$_POST[$pizzaNaam]." ".number_format($pizzaTotaal, 2, ",", ",")."</p>";
            }
        } else {
            foreach ($pizzaPrijs as $pizzaNaam => $pizzaPrijs) {
                $pizzaTotaal = $pizzaPrijs * $_POST[$pizzaNaam];

                $totaalPrijs += $pizzaTotaal;

                echo "<p>$pizzaNaam: Aantal: ".$_POST[$pizzaNaam]." ".number_format($pizzaTotaal, 2, ",", ",")."</p>";
            }
        }

        if ($_POST["bezorgen"] == "bezorgen") {
            $totaalPrijs += 5;
        }

        $totaalPrijs = number_format($totaalPrijs, 2, ",", ",");

        echo ("<h2>Totaal: €$totaalPrijs</h2>");

        echo ("<h2>Gegevens:</h2>");
        echo ("<p>Naam: ".$_POST["naam"]."</p>");
        echo ("<p>Adres: ".$_POST["adres"]."</p>");
        echo ("<p>Postcode: ".$_POST["postcode"]."</p>");
        echo ("<p>Plaats: ".$_POST["plaats"]."</p>");
        echo ("<p>Besteldatum: ".$_POST["datum"]."</p>");
        echo ("<p>Afhalen of bezorgen: ".$_POST["bezorgen"]."</p>");
    }

    ?>

</body>
</html>
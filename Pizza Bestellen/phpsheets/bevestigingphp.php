<?php

$servername = "localhost";
$dbname = "pizza bestellen";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully!";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

function eenPizza() {
    global $pizzas;

    if (isset($_POST["keuze_opslaan"])) {
        $aantalPizzas = 0;

        foreach ($pizzas as $pizza) {
            $aantalPizzas += $_POST[$pizzaNaam];
        }

        if ($aantalPizzas <= 0) {
            echo "<h1>Kies tenminste 1 pizza!</h1>";
            echo "<a href='./index.php'><button>Terug</button></a>";
            exit;
        } else if ($_POST["datum"] < date("Y-m-d\TH:i")) {
            echo "<h1>Kies een datum in de toekomst!</h1>";
            echo "<a href='./index.php'><button>Terug</button></a>";
            exit;
        } else {
            echo "<h1>Bedankt voor uw bestelling!</h1>";
        }
    }
}

function bestelling() {
    global $conn;

    if (isset($_POST["keuze_opslaan"])) {
        $aantalPizzas = 0;
        $totaalPrijs = 0;

        $datum = strtotime($_POST["datum"]);
        $dag = date("l", $datum);

        echo ("<h2>Bestelling:</h2>");

        $query = "SELECT pizza, prijs FROM pizza";

        $data = $conn->prepare($query);
        $data->execute(array());
        $pizzas = $data->fetchALL(PDO::FETCH_ASSOC);

        foreach ($pizzas as $pizza) {
            if ($dag == "Monday") {
                $pizzaTotaal = 7.50 * $_POST[$pizza["pizza"]];

                $totaalPrijs += $pizzaTotaal;
            } else if ($dag == "Friday") {
                $pizzaTotaal = $pizzaPrijs * 0.85 * $_POST[$pizza["pizza"]];

                $totaalPrijs += $pizzaTotaal;
            } else {
                $pizzaTotaal = $pizza["prijs"] * $_POST[$pizza["pizza"]];

                $totaalPrijs += $pizzaTotaal;
            }

            if ($_POST[$pizza["pizza"]] > 0) {
                echo "<p>Aantal: ".$_POST[$pizzaNaam]." $pizzaNaam: €".number_format($pizzaTotaal, 2, ",", ".")."</p>";
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

function sendData() {
    global $conn;

    if (isset($_POST["keuze_opslaan"])) {
        $naam = $_POST["naam"];
        $adres = $_POST["adres"];
        $postcode = $_POST["postcode"];
        $plaats = $_POST["plaats"];
        $datum = $_POST["datum"];
        $bezorgen = $_POST["bezorgen"];

        $sql = "INSERT INTO bestellingen (naam, adres, plaats, postcode, bezorgdatum, bezorgen) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$naam, $adres, $plaats, $postcode, $datum, $bezorgen]);
    }
}

?>
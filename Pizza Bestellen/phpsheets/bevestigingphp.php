<?php

include "./phpsheets/conn.php";

session_start();

try {
    $query = "SELECT * FROM pizza";
    $pizzas = $conn->prepare($query);
    $pizzas->execute(array());
    $pizzas = $pizzas->fetchALL(PDO::FETCH_ASSOC);

    $query = "SELECT orders.order_id, gebruikers.naam, gebruikers.adres, gebruikers.plaats, gebruikers.postcode, orders.bezorgdatum, orders.bezorgen FROM orders INNER JOIN gebruikers ON orders.gebruikers_id = gebruikers.gebruikers_id WHERE orders.order_id = (SELECT MAX(order_id) FROM orders)";
    $fetchOrderDetails = $conn->prepare($query);
    $fetchOrderDetails->execute(array());
    $fetchOrderDetails = $fetchOrderDetails->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $query . "<br>" . $e->getMessage();
}

function eenPizza() {
    global $pizzas;

    if (isset($_POST["keuze_opslaan"])) {
        $aantalPizzas = 0;

        foreach ($pizzas as $pizza) {
            $pizzaKey = str_replace(" ", "_", $pizza["pizza naam"]);

            $aantalPizzas += $_POST[$pizzaKey];
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
    global $pizzas;
    global $fetchOrderDetails;

    if (isset($_SESSION["keuze_opslaan"])) {
        $aantalPizzas = 0;
        $totaalPrijs = 0;

        $datum = strtotime($fetchOrderDetails["bezorgdatum"]);
        $dag = date("l", $datum);

        echo ("<h2>Bestelling:</h2>");

        foreach ($pizzas as $pizza) {
            $pizzaKey = str_replace(" ", "_", $pizza["pizza naam"]);

            if ($_SESSION["aantal: $pizzaKey"] > 0) {
                echo "<p>Aantal: " . $_SESSION["aantal: $pizzaKey"] . " " . $pizza["pizza naam"] . ": €" . number_format($_SESSION["pizzaPrice: $pizzaKey"], 2, ",", ".") . "</p>";
            }
        }

        echo ("<p class='totaal'>Totaal: €" . number_format($_SESSION["totalPrice"], 2, ",", ".") . "</p>");
    }
}

function gegevens() {
    global $fetchOrderDetails;

    $bezorgen = "Nee";

    if ($_SESSION["bezorgen"] == "Bezorgen") {
        $bezorgen = "Ja";
    }

    echo ("<h2>Gegevens:</h2>");
    echo ("<p>Naam: " . $fetchOrderDetails["naam"] . "</p>");
    echo ("<p>Adres: " . $fetchOrderDetails["adres"] . "</p>");
    echo ("<p>Postcode: " . $fetchOrderDetails["postcode"] . "</p>");
    echo ("<p>Plaats: " . $fetchOrderDetails["plaats"] . "</p>");
    echo ("<p>Bezorgdatum: " . $fetchOrderDetails["bezorgdatum"] . "</p>");
    echo ("<p>Afhalen of bezorgen: " . $bezorgen . "</p>");
}

?>
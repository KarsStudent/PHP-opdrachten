<?php

include "./phpsheets/conn.php";

$query = "SELECT * FROM pizza";
$data = $conn->prepare($query);
$data->execute(array());
$pizzas = $data->fetchALL(PDO::FETCH_ASSOC);

$query = "INSERT INTO gebruikers (naam, adres, plaats, postcode) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($query);

$query = "SELECT naam FROM gebruikers WHERE naam = :naam";
$something = $conn->prepare($query);

function displayPizza() {
    global $pizzas;

    foreach ($pizzas as $pizza) {
        echo "<span class='pizzaKader'>";
        echo "<label for='" . $pizza["pizza naam"] . "' class='pizzaNaam'>" . $pizza["pizza naam"] . ":</label>";
        echo "<img src='./images/placeholder.jpg' alt='Pizza " . $pizza["pizza naam"] . "' class='pizzaImage'>";
        echo "<p class='pizzaPrijs'>€" . number_format($pizza["prijs"], 2, ",", ".") . "</p>";
        echo "<input type='number' placeholder='" . $pizza["pizza naam"] . "' min='0' max='10' id='" . $pizza["pizza naam"] . "' name='" . $pizza["pizza naam"] . "' value='0' class='hoeveelheid'><br>";
        echo "</span>";
    }
}

function prijs() {
    global $pizzas;

    foreach ($pizzas as $pizza) {
        echo "<p>" . $pizza["pizza naam"] . ": €" . number_format($pizza["prijs"], 2, ",", ".") . "</p>";
    }
}

function sendData() {
    global $stmt;
    global $pizzas;
    global $something;

    if (isset($_POST["keuze_opslaan"])) {
        $aantalPizzas = 0;

        $naam = htmlspecialchars($_POST["naam"]);
        $adres = htmlspecialchars($_POST["adres"]);
        $postcode = htmlspecialchars($_POST["postcode"]);
        $plaats = htmlspecialchars($_POST["plaats"]);
        $datum = htmlspecialchars($_POST["datum"]);
        $bezorgen = htmlspecialchars($_POST["bezorgen"]);

        foreach ($pizzas as $pizza) {
            $pizzaKey = str_replace(" ", "_", $pizza["pizza naam"]);

            $aantalPizzas += $_POST[$pizzaKey];
        }

        $something->bindParam(":naam", $naam);
        $something->execute();
        $something = $something->fetch(PDO::FETCH_ASSOC);

        if ($aantalPizzas > 0) {
            if (!$something) {
                $stmt->execute([$naam, $adres, $plaats, $postcode]);

                header("Location: bevestiging.php");
            }
        }
    }
}

?>
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

    $query = "SELECT * FROM pizza";

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

        $naam = $_POST["naam"];
        $adres = $_POST["adres"];
        $postcode = $_POST["postcode"];
        $plaats = $_POST["plaats"];
        $datum = $_POST["datum"];
        $bezorgen = $_POST["bezorgen"];

        $something->bindParam(':naam', $naam, PDO::PARAM_STR);
        $something->execute();
        $userExists = $something->rowCount() > 0;

        if ($aantalPizzas > 0) {
            if (!$userExists) {
                $stmt->execute([$naam, $adres, $plaats, $postcode]);

                header("Location: bevestiging.php");
            }
        } elseif ($aantalPizzas > 0) {
             
        }
    }
}

?>
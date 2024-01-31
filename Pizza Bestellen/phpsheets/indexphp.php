<?php

$servername = "localhost";
$dbname = "pizza bestellen";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Database has connecteded succesfully!";
} catch(PDOException $e) {
    echo "Connection failed: ".$e->getMessage();
}

function displayPizza() {
    global $conn;

    $query = "SELECT * FROM pizza";

    $data = $conn->prepare($query);
    $data->execute(array());
    $pizzas = $data->fetchALL(PDO::FETCH_ASSOC);

    foreach ($pizzas as $pizza) {
        echo "<span class='pizzaKader'>";
        echo "<label for='".$pizza["pizza"]."' class='pizzaNaam'>".$pizza["pizza"].":</label>";
        echo "<img src='./images/DefaultPizzaImage.jpg' alt='Pizza ".$pizza["pizza"]."' class='pizzaImage'>";
        echo "<p class='pizzaPrijs'>€".number_format($pizza["prijs"], 2, ",", ".")."</p>";
        echo "<input type='number' placeholder='".$pizza["pizza"]."' min='0' max='10' id='".$pizza["pizza"]."' name='".$pizza["pizza"]."' value='0' class='hoeveelheid'><br>";
        echo "</span>";
    }
}

function prijs() {
    global $conn;

    $query = "SELECT * FROM pizza";

    $data = $conn->prepare($query);
    $data->execute(array());
    $pizzas = $data->fetchALL(PDO::FETCH_ASSOC);

    foreach ($pizzas as $pizza) {
        echo "<p>".$pizza["pizza"].": €".number_format($pizza["prijs"], 2, ",", ".")."</p>";
    }
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
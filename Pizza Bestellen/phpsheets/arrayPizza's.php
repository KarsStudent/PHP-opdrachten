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

$query = "SELECT pizza, prijs FROM pizza";

$data = $conn->prepare($query);
$data->execute(array());
$pizzas = $data->fetchALL(PDO::FETCH_ASSOC);

?>
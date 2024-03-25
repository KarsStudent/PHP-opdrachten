<?php

include "./phpsheets/conn.php";

$query = "SELECT orders.order_id, gebruikers.naam, gebruikers.adres, gebruikers.plaats, gebruikers.postcode, orders.bezorgdatum, orders.bezorgen FROM orders INNER JOIN gebruikers ON orders.gebruikers_id=gebruikers.gebruikers_id";
$fetchOrderDetails = $conn->prepare($query);
$fetchOrderDetails->execute(array());
$fetchOrderDetails = $data->fetchALL(PDO::FETCH_ASSOC);

function bestellingen() {
    global $fetchOrderDetails;

    foreach ($fetchOrderDetails as $fetchOrderDetails) {
        echo "<tr>";
        echo "<td>" . $fetchOrderDetails["order_id"] . "</td>";
        echo "<td>" . $fetchOrderDetails["naam"] . "</td>";
        echo "<td>" . $fetchOrderDetails["adres"] . "</td>";
        echo "<td>" . $fetchOrderDetails["plaats"] . "</td>";
        echo "<td>" . $fetchOrderDetails["postcode"] . "</td>";
        echo "<td>" . $fetchOrderDetails["bezorgdatum"] . "</td>";
        echo "<td>" . $fetchOrderDetails["bezorgen"] . "</td>";
        echo "<td>Geen waarde</td>";
        echo "<td>Geen waarde</td>";
        echo "</tr>";
    }
}

?>
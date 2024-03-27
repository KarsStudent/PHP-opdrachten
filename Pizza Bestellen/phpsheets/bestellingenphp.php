<?php

include "./phpsheets/conn.php";

$query = "SELECT orders.order_id, gebruikers.naam, gebruikers.adres, gebruikers.plaats, gebruikers.postcode, orders.bezorgdatum, orders.bezorgen FROM orders INNER JOIN gebruikers ON orders.gebruikers_id=gebruikers.gebruikers_id ORDER BY orders.order_id DESC LIMIT 10";
$fetchOrderDetails = $conn->prepare($query);
$fetchOrderDetails->execute(array());
$fetchOrderDetails = $fetchOrderDetails->fetchALL(PDO::FETCH_ASSOC);

function bestellingen() {
    global $fetchOrderDetails;

    foreach ($fetchOrderDetails as $orderDetail) {
        $bezorgen = $orderDetail["bezorgen"];

        if ($bezorgen == "1") {
            $bezorgen = "Ja";
        } else {
            $bezorgen = "Nee";
        }

        echo "<tr>";
        echo "<td>" . $orderDetail["order_id"] . "</td>";
        echo "<td>" . $orderDetail["naam"] . "</td>";
        echo "<td>" . $orderDetail["adres"] . "</td>";
        echo "<td>" . $orderDetail["plaats"] . "</td>";
        echo "<td>" . $orderDetail["postcode"] . "</td>";
        echo "<td>" . $orderDetail["bezorgdatum"] . "</td>";
        echo "<td>" . $bezorgen . "</td>";
        echo "<td>No Value</td>";
        echo "<td>No Value</td>";
        echo "</tr>";
    }
}

?>
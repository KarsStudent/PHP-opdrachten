<?php

include "./phpsheets/conn.php";

$query = "SELECT * FROM bestellingen ORDER BY bestelling_id DESC LIMIT 10";
$data = $conn->prepare($query);
$data->execute(array());
$gegevens = $data->fetchALL(PDO::FETCH_ASSOC);

function bestellingen() {
    global $gegevens;

    foreach ($gegevens as $gegeven) {
        echo "<tr>";
        echo "<td>" . $gegeven["bestelling_id"] . "</td>";
        echo "<td>" . $gegeven["naam"] . "</td>";
        echo "<td>" . $gegeven["adres"] . "</td>";
        echo "<td>" . $gegeven["plaats"] . "</td>";
        echo "<td>" . $gegeven["postcode"] . "</td>";
        echo "<td>" . $gegeven["bezorgdatum"] . "</td>";
        echo "<td>" . $gegeven["bezorgen"] . "</td>";
        echo "<td>Geen waarde</td>";
        echo "<td>Geen waarde</td>";
        echo "</tr>";
    }
}

?>
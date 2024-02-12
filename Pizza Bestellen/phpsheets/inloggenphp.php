<?php

include "./phpsheets/conn.php";

$query = "SELECT gebruikersnaam, wachtwoord FROM gebruikers";
$data = $conn->prepare($query);

function gebruikersnaam() {
    global $conn;
    global $data;

    if (isset($_POST["login"])) {
        $data->execute();
        $gebruikers = $data->fetch(PDO::FETCH_ASSOC);

        if ($gebruikers["gebruikersnaam"] == $_POST["gebruikersnaam"] && $gebruikers["wachtwoord"] == $_POST["wachtwoord"]) {
            header("Location: bestellingen.php");
        } else {
            echo "<p class='error'>Gebruikersnaam of wachtwoord onjuist!</p>";
        }
    }
}

?>
<?php

include "./phpsheets/conn.php";

$query = "SELECT * FROM gebruikers WHERE gebruikersnaam = `?`";
$data = $conn->prepare($query);

function gebruikersnaam() {
    global $data;

    if (isset($_POST["login"])) {
        $gebruiker = $data->execute($_POST["gebruikersnaam"]);

        if ($_POST["gebruikersnaam"] == $gebruiker) {
            echo "het bestaatttttttt yay";
        } else {
            echo "bestaat niet ;(";
        }
    }
}

?>
<?php

if (isset($_POST["keuze_opslaan"])) {
    $pizzaPrijs = array (
        "Margarita" => 12.50,
        "Funghi" => 12.50,
        "Marina" => 13.95,
        "Hawaii" => 11.50,
        "Formaggi" => 14.50
    );

    $aantalPizzas = 0;

    foreach ($pizzaPrijs as $pizzaNaam => $placeholder) {
        $aantalPizzas += $_POST[$pizzaNaam];
    }

    if ($aantalPizzas <= 0) {
        echo "<h1>Kies tenminste 1 pizza!</h1>";
        echo "<a href='./index.php'><button>Terug</button></a>";
        exit;
    } else {
        echo "<h1>Bedankt voor uw bestelling!</h1>";
    }
}

?>
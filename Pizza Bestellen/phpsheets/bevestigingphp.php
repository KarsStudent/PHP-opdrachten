<?php

include "arrayPizza's.php";

if (isset($_POST["keuze_opslaan"])) {        
    $aantalPizzas = 0;
        
    foreach ($arrayPizza as $pizzaNaam => $placeholder) {
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
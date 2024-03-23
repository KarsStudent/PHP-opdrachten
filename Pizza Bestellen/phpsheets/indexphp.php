<?php

include "./phpsheets/conn.php";

try {
    $query = "SELECT * FROM pizza";
    $data = $conn->prepare($query);
    $data->execute(array());
    $pizzas = $data->fetchALL(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

function displayPizza() {
    global $pizzas;

    foreach ($pizzas as $pizza) {
        echo "<span class='pizzaKader'>";
        echo "<label for='" . $pizza["pizza naam"] . "' class='pizzaNaam'>" . $pizza["pizza naam"] . ":</label>";
        echo "<img src='./images/DefaultPizzaImage.jpg' alt='Pizza " . $pizza["pizza naam"] . "' class='pizzaImage'>";
        echo "<p class='pizzaPrijs'>€" . number_format($pizza["prijs"], 2, ",", ".") . "</p>";
        echo "<input type='number' placeholder='" . $pizza["pizza naam"] . "' min='0' max='10' id='" . $pizza["pizza naam"] . "' name='" . $pizza["pizza naam"] . "' value='0' class='hoeveelheid'><br>";
        echo "</span>";
    }
}

function prijs() {
    global $pizzas;

    foreach ($pizzas as $pizza) {
        echo "<p>" . $pizza["pizza naam"] . ": €" . number_format($pizza["prijs"], 2, ",", ".") . "</p>";
    }
}

function sendData() {
    global $pizzas;
    global $conn;

    if (isset($_POST["keuze_opslaan"])) {
        $naam = htmlspecialchars($_POST["naam"]);
        $adres = htmlspecialchars($_POST["adres"]);
        $postcode = htmlspecialchars($_POST["postcode"]);
        $plaats = htmlspecialchars($_POST["plaats"]);
        $datum = htmlspecialchars($_POST["datum"]);

        $bezorgen = 0;
        if ($_POST["bezorgen"] == "Bezorgen") {
            $bezorgen = 1;
        }

        $aantalPizzas = 0;
        foreach ($pizzas as $pizza) {
            $pizzaKey = str_replace(" ", "_", $pizza["pizza naam"]);

            $aantalPizzas += $_POST[$pizzaKey];
        }

        if ($aantalPizzas > 0) {
            try {
                $query = "SELECT naam FROM gebruikers WHERE naam = :naam";
                $fetchNaam = $conn->prepare($query);
                $fetchNaam->bindParam(":naam", $naam);
                $fetchNaam->execute();
                $fetchNaam = $fetchNaam->fetch(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
            
            if (!$fetchNaam) {
                try {
                    $query = "INSERT INTO gebruikers (naam, adres, plaats, postcode) VALUES (?, ?, ?, ?)";
                    $insertGebruiker = $conn->prepare($query);
                    $insertGebruiker->execute([$naam, $adres, $plaats, $postcode]);
    
                    $gebruikersID = $conn->lastInsertId();
    
                    $query = "INSERT INTO orders (gebruikers_id, besteldatum, bezorgen) VALUES (?, ?, ?)";
                    $insertOrder = $conn->prepare($query);
                    $insertOrder->execute([$gebruikersID, $datum, $bezorgen]);
    
                    $orderID = $conn->lastInsertId();
                } catch(PDOException $e) {
                    echo $sql . "<br>" . $e->getMessage();
                }

                foreach ($pizzas as $pizza) {
                    $pizzaKey = str_replace(" ", "_", $pizza["pizza naam"]);

                    $hoeveelheid = $_POST[$pizzaKey];

                    if ($_POST[$pizzaKey] > 0) {
                        try {
                            $pizzaID = $conn->prepare("SELECT pizza_id FROM pizza WHERE `pizza naam` = :pizza_naam");
                            $pizzaID->bindParam(":pizza_naam", $pizza["pizza naam"]);
                            $pizzaID->execute();
                            $pizzaID = $pizzaID->fetchColumn();
    
                            $query = "INSERT INTO order_regels (order_id, pizza_id, aantal) VALUES (?, ?, ?)";
                            $insertOrderRegel = $conn->prepare($query);
                            $insertOrderRegel->execute([$orderID, $pizzaID, $hoeveelheid]);
                        } catch(PDOException $e) {
                            echo $sql . "<br>" . $e->getMessage();
                        }
                    }
                }

                //header("Location: bevestiging.php");
            }
        }
    }
}

?>
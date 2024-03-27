<?php

include "./phpsheets/conn.php";

try {
    $query = "SELECT * FROM pizza";
    $pizzas = $conn->prepare($query);
    $pizzas->execute(array());
    $pizzas = $pizzas->fetchALL(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $query . "<br>" . $e->getMessage();
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
                $query = "SELECT gebruikers_id, naam FROM gebruikers WHERE naam = :naam";
                $fetchNaam = $conn->prepare($query);
                $fetchNaam->bindParam(":naam", $naam);
                $fetchNaam->execute();
                $fetchNaam = $fetchNaam->fetch(PDO::FETCH_ASSOC);

                $query = "INSERT INTO gebruikers (naam, adres, plaats, postcode) VALUES (?, ?, ?, ?)";
                $insertGebruiker = $conn->prepare($query);

                $query = "INSERT INTO orders (gebruikers_id, bezorgdatum, bezorgen) VALUES (?, ?, ?)";
                $insertOrder = $conn->prepare($query);

                $query = "SELECT pizza_id FROM pizza WHERE `pizza naam` = :pizza_naam";
                $pizzaID = $conn->prepare($query);

                $query = "INSERT INTO order_regels (order_id, pizza_id, aantal) VALUES (?, ?, ?)";
                $insertOrderRegel = $conn->prepare($query);
            } catch (PDOException $e) {
                echo $query . "<br>" . $e->getMessage();
            }

            if (!$fetchNaam) {
                try {
                    $insertGebruiker->execute([$naam, $adres, $plaats, $postcode]);

                    $gebruikersID = $conn->lastInsertId();

                    $insertOrder->execute([$gebruikersID, $datum, $bezorgen]);

                    $orderID = $conn->lastInsertId();
                } catch (PDOException $e) {
                    echo $query . "<br>" . $e->getMessage();
                }
            } elseif ($fetchNaam) {
                $gebruikersID = $fetchNaam["gebruikers_id"];

                try {
                    $insertOrder->execute([$gebruikersID, $datum, $bezorgen]);

                    $orderID = $conn->lastInsertId();
                } catch (PDOException $e) {
                    echo $query . "<br>" . $e->getMessage();
                }
            }

            foreach ($pizzas as $pizza) {
                $pizzaKey = str_replace(" ", "_", $pizza["pizza naam"]);

                $aantal = $_POST[$pizzaKey];

                if ($aantal > 0) {
                    try {
                        $pizzaID->bindParam(":pizza_naam", $pizza["pizza naam"], PDO::PARAM_STR);
                        $pizzaID->execute();
                        $pizzaID_value = $pizzaID->fetchColumn();

                        $insertOrderRegel->execute([$orderID, $pizzaID_value, $aantal]);
                    } catch (PDOException $e) {
                        echo $query . "<br>" . $e->getMessage();
                    }
                }
            }
            header('Location: ./bevestiging.php');
        }
    }
}

function session() {
    global $pizzas;

    if (isset($_POST["keuze_opslaan"])) {
        session_start();

        $datum = strtotime($_POST["datum"]);
        $dag = date("l", $datum);

        $_SESSION["totalPrice"] = 0;

        foreach ($pizzas as $pizza) {
            $pizzaKey = str_replace(" ", "_", $pizza["pizza naam"]);

            $_SESSION["keuze_opslaan"] = $_POST["keuze_opslaan"];

            $_SESSION["aantal: $pizzaKey"] = $_POST[$pizzaKey];

            $_SESSION["bezorgen"] = $_POST["bezorgen"];

            if ($dag == "Monday") {
                $_SESSION["pizzaPrice: $pizzaKey"] = 7.50 * $_POST[$pizzaKey];

                $_SESSION["totalPrice"] += $_SESSION["pizzaPrice: $pizzaKey"];
            } elseif ($dag == "Friday") {
                $_SESSION["pizzaPrice: $pizzaKey"] = $pizza["prijs"] * 0.85 * $_POST[$pizzaKey];

                $_SESSION["totalPrice"] += $_SESSION["pizzaPrice: $pizzaKey"];
            } else {
                $_SESSION["pizzaPrice: $pizzaKey"] = $pizza["prijs"] * $_POST[$pizzaKey];

                $_SESSION["totalPrice"] += $_SESSION["pizzaPrice: $pizzaKey"];
            }
        }
    }
}

?>
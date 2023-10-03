<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP opdracht - vertaler</title>
</head>
<body>

    <form method="post" action="">
        Naam: <input type="text" name="naam" placeholder="Uw naam" required><br>

        Land:
        <select name="land" required>
            <option value="">Maak uw keuze</option>
            <option value="NL" <?php selected("NL") ?>>Nederland</option>
            <option value="DE" <?php selected("DE") ?>>Duitsland</option>
            <option value="EN" <?php selected("EN") ?>>Engeland</option>
            <option value="FR" <?php selected("FR") ?>>Frankrijk</option>
            <option value="ES" <?php selected("ES") ?>>Spanje</option>
            <option value="IT" <?php selected("IT") ?>>Italië</option>
        </select>
        <br>
        <input type="submit" name="submit" value="gegevens versturen">
    </form>

    <?php

        if(isset($_POST["submit"])) {
            $naam = $_POST["naam"];
            $land = $_POST["land"];

            if($land == "NL") {
                echo "<p>Goedemorgen $naam</p>";
            } elseif($land == "DE") {
                echo "<p>Guten morgen $naam</p>";
            } elseif ($land == "EN") {
                echo "<p>Good morning $naam</p>";
            } elseif ($land == "FR") {
                echo "<p>Bonjour $naam</p>";
            } elseif ($land == "ES") {
                echo "<p>Buen día $naam</p>";
            } elseif ($land == "IT") {
                echo "<p>Buongiorno $naam</p>";
            }
        }

        function selected($selected) {
            if(isset($_POST["submit"])) {
                $land = $_POST["land"];

                if($selected == $land) {
                    echo "selected";
                }
            }
        }
    ?>

</body>
</html>
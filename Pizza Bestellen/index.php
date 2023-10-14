<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza dela Zoltar</title>
    <link rel="stylesheet" href="./stylesheets/index.css">
    <script>
        <?php include "./phpsheets/indexphp.php" ?>
    </script>
</head>
<body>
    <form action="<?php doorsturen() ?>" method="post">
        <div class="pizzaContainer">
            <h1 class="titel">Pizza's:</h1>

            <span class="pizzaKader">
                <label for="Margarita" class="pizzaNaam">Margarita:</label>
                <img src="./images/margarita.jpg" alt="Pizza Margarita" class="pizzaImage">
                <p class="pizzaPrijs"><?= prijs("Margarita"); ?></p>
                <input type="number" placeholder="Margarita" min="0" max="10" id="Margarita" name="Margarita" value="0" class="hoeveelheid"><br>
            </span>
            <span class="pizzaKader">
                <label for="Funghi" class="pizzaNaam">Funghi:</label>
                <img src="./images/funghi.jpg" alt="Pizza Funghi" class="pizzaImage">
                <p class="pizzaPrijs"><?= prijs("Funghi"); ?></p>
                <input type="number" placeholder="Funghi" min="0" max="10" id="Funghi" name="Funghi" value="0" class="hoeveelheid"><br>
            </span>
            <span class="pizzaKader">
                <label for="Marina" class="pizzaNaam">Marina:</label>
                <img src="./images/marina.jpg" alt="Pizza Marina" class="pizzaImage">
                <p class="pizzaPrijs"><?= prijs("Marina"); ?></p>
                <input type="number" placeholder="Marina" min="0" max="10" id="Marina" name="Marina" value="0" class="hoeveelheid"><br>
            </span>
            <span class="pizzaKader">
                <label for="Hawaii" class="pizzaNaam">Hawaii:</label>
                <img src="./images/hawaii.jpg" alt="Pizza Hawaii" class="pizzaImage">
                <p class="pizzaPrijs"><?= prijs("Hawaii"); ?></p>
                <input type="number" placeholder="Hawaii" min="0" max="10" id="Hawaii" name="Hawaii" value="0" class="hoeveelheid"><br>
            </span>
            <span class="pizzaKader">
                <label for="Formaggi" class="pizzaNaam">Quatro Formaggi:</label>
                <img src="./images/quatro formaggi.jpg" alt="Pizza Quatro Formaggi" class="pizzaImage">
                <p class="pizzaPrijs"><?= prijs("Formaggi"); ?></p>
                <input type="number" placeholder="Quatro Formaggi" min="0" max="10" id="Formaggi" name="Formaggi" value="0" class="hoeveelheid"><br><br>
            </span>
        </div>

        <div class="optiesContainer">
            <div class="gegevens">
                <h2>Gegevens:</h2>

                <div>
                    <br>
                    <label for="naam">Naam:</label><br>
                    <input type="text" placeholder="Naam" id="naam" name="naam" maxlength="10" required><br><br>
                </div>
                <div>
                    <label for="adres">Adres:</label><br>
                    <input type="text" placeholder="Adres" id="adres" name="adres" maxlength="20" required><br><br>
                </div>
                <div>
                    <label for="postcode">Postcode:</label><br>
                    <input type="text" placeholder="Postcode" id="postcode" name="postcode" maxlength="6" required><br><br>
                </div>
                <div>
                    <label for="plaats">Plaats:</label><br>
                    <input type="text" placeholder="Plaats" id="plaats" name="plaats" maxlength="20" required><br><br>
                </div>
                <div>
                    <label for="datum">Besteldatum:</label><br>
                    <input type="datetime-local" id="datum" name="datum" value="<?= date("Y-m-d\TH:i") ?>">
                </div>
            </div>
            <div class="bezorgen">
                <h2>Bezorgen of afhalen:</h2>

                <div>
                    <br>
                    <label for="afhalen">Afhalen:</label>
                    <input type="radio" id="afhalen" name="bezorgen" value="Afhalen" checked="checked"><br>
                </div>
                <div>
                    <label for="bezorgen">Bezorgen: €5,00</label>
                    <input type="radio" id="bezorgen" name="bezorgen" value="Bezorgen">
                </div>
            </div>
            <div class="tenminste1PizzaContainer">
                <?php tenminste1Pizza() ?>
            </div>

            <div class="opslaanContainer"><input type="submit" value="Opslaan" name="keuze_opslaan" class="opslaan"></div>
        </div>
    </form>
</body>
</html>
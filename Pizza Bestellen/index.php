<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./stylesheets/index.css">
    <title>Pizza dela Zoltar</title>
    <?php include "./phpsheets/indexphp.php" ?>
    <?php sendData() ?>
    <?php session() ?>
</head>
<body>
    <nav>
        <a href="./inloggen.php" class="inloggen">inloggen</a>
    </nav>

    <form action="" method="post">
        <div class="pizzaContainer">
            <h1 class="titel">Bestellen:</h1>

            <?php displayPizza() ?>
        </div>

        <div class="optiesContainer">
            <div class="gegevens">
                <h2>Gegevens:</h2>

                <div>
                    <br>
                    <label for="naam">Naam:</label><br>
                    <input type="text" placeholder="Naam" id="naam" name="naam" maxlength="20" required><br><br>
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
                    <label for="datum">Bezorgdatum:</label><br>
                    <input type="datetime-local" id="datum" name="datum" required>
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

            <div class="opslaanContainer">
                <input type="submit" value="Opslaan" name="keuze_opslaan" class="opslaan">
            </div>
        </div>
    </form>

    <div class="prijzen">
        <h2 class="containerTitel">Prijzenlijst:</h2>

        <div class="dag">
            <h2>Normale prijzen:</h2>
            <?php prijs() ?>
        </div>

        <div class="dag">
            <h2>Prijzen op maandag:</h2>
            <p>Alle pizza's voor €7,50!</p>
        </div>

        <div class="dag">
            <h2>Prijzen op vrijdag:</h2>
            <p>Alle pizza's hebben 15% korting!</p>
        </div>
    </div>
</body>
</html>
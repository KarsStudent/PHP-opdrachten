<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza dela Zoltar</title>
    <link rel="stylesheet" href="./stylesheets/bevestiging.css">
    <?php include "./phpsheets/bevestigingphp.php" ?>
    <?php sendData() ?>
</head>
<body>
    <img src="./images/italie.png" alt="Vlag van Italië" class="vlagItalie">

    <div class="verwerkingsKader">
        <div class="bedankt">
            <?php eenPizza() ?>
        </div>
        <div class="bestellingKader">
            <?php bestelling() ?>
        </div>
        <div class="gegevensKader">
            <?php gegevens() ?>
        </div>
    </div>

    <a href="./index.php"><button class="terugKnop">Terug</button></a>
</body>
</html>
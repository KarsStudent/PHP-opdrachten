<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./stylesheets/bestellingen.css">
    <title>Bestellingen</title>
    <?php include "./phpsheets/bestellingenphp.php" ?>
</head>
<body>
    <nav>
        <a href="./inloggen.php" class="uitloggen">Uitloggen</a>
    </nav>

    <div class="bestellingen">
        <h1 class="titel">Admin functies:</h1>

        <div class="tabel">
            <table>
                <caption class="formTitel">Bestellingen:</caption>
                <tr>
                    <th>Bestelnummer</th>
                    <th>Naam</th>
                    <th>Adres</th>
                    <th>Plaats</th>
                    <th>Postcode</th>
                    <th>Bezorgdatum</th>
                    <th>Bestelling</th>
                    <th>Bezorgen</th>
                    <th>Te betalen</th>
                </tr>
                <?php bestellingen() ?>
            </table>
        </div>
    </div>

    <div class="toevoegenPizza">

    </div>
</body>
</html>
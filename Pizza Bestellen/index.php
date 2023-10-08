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
    <form action="./bestelling.php" method="post">
        Naam:
        <input type="text" placeholder="Naam" name="naam" maxlength="20" required><br>

        Adres:
        <input type="text" placeholder="Adres" name="adres" maxlength="20" required><br>

        Postcode:
        <input type="text" placeholder="Postcode" name="postcode" maxlength="6" required><br>

        Plaats:
        <input type="text" placeholder="Plaats" name="plaats" maxlength="20" required><br>

        Besteldatum:
        <input type="datetime-local" name="datum" value="<?= Date("Y-m-d\TH:i") ?>"><br>

        Bezorgen of afhalen:
        <br>
        Afhalen:<input type="radio" name="bezorgen" value="Afhalen" checked="checked"><br>
        Bezorgen: €5,00 <input type="radio" name="bezorgen" value="Bezorgen">
        <br><br>

        Pizza's:<br>
        Margarita:<?= prijs("Margarita"); ?><input type="number" placeholder="Margarita" min="0" max="10" name="Margarita" value="0"><br>
        Funghi:<?= prijs("Funghi"); ?><input type="number" placeholder="Funghi" min="0" max="10" name="Funghi" value="0"><br>
        Marina:<?= prijs("Marina"); ?><input type="number" placeholder="Marina" min="0" max="10" name="Marina" value="0"><br>
        Hawaii:<?= prijs("Hawaii"); ?><input type="number" placeholder="Hawaii" min="0" max="10" name="Hawaii" value="0"><br>
        Quatro Formaggi:<?= prijs("Formaggi"); ?><input type="number" placeholder="Quatro Formaggi" min="0" max="10" name="Formaggi" value="0"><br>

        <br>
        <input type="submit" value="Opslaan" name="keuze_opslaan">
    </form>
</body>
</html>
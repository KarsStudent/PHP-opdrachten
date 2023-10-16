<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rente Berekenen</title>
    <link rel="stylesheet" href="./index.css">
</head>
<body>
    <form action="" method="post">
        <label for="bedrag">Ingelegd bedrag: </label>
        <input type="text" name="bedrag" id="bedrag" required><br><br>

        <label for="rentepercentage">Rentepercentage: </label>
        <input type="text" name="rentepercentage" id="rentepercentage" required><br><br>

        <input type="radio" name="berekening" id="10Jaar" value="10Jaar" checked="checked">
        <label for="10Jaar">Eindbedrag na 10 jaar</label><br>

        <input type="radio" name="berekening" id="verdubbeld" value="verdubbeld">
        <label for="verdubbeld">Eindbedrag verdubbeld</label><br><br>

        <input type="submit" name="submit" value="Bereken">
    </form>

    <?php include "./indexphp.php" ?>
</body>
</html>
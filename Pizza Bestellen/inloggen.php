<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./stylesheets/inloggen.css">
    <title>Inloggen</title>
    <?php include "./phpsheets/inloggenphp.php" ?>
</head>
<body>
    <nav>
        <a href="./index.php" class="terug">Terug</a>
    </nav>

    <div class="kader">
        <div class="inloggen">
            <form action="" method="POST">
                <h1 class="titel">Log in:</h1><br>
                <input type="text" placeholder="Gebruikersnaam" name="gebruikersnaam"><br>
                <input type="password" placeholder="Wachtwoord" name="wachtwoord"><br>
                <input type="submit" value="Inloggen" name="login">
            </form>
            <?php gebruikersnaam() ?>
        </div>
    </div>
</body>
</html>
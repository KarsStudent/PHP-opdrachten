<?php

if (isset($_POST["submit"])) {
    $bedrag = str_replace(",", ".", $_POST["bedrag"]);
    $rentepercentage = str_replace(",", ".", $_POST["rentepercentage"]);

    if (!is_numeric($bedrag) || !is_numeric($rentepercentage)) {
        exit ("Alleen getallen!");
    }

    echo "<p>Het ingelegde bedrag is: ".$_POST["bedrag"]."</p>";
    echo "<p>Het rente percentage is: ".$_POST["rentepercentage"]."%</p><br>";

    if ($_POST["berekening"] == "10Jaar") {
        echo "<p>Het eindbedrag na 10 jaar:</p>";
    } elseif ($_POST["berekening"] == "verdubbeld") {
        echo "<p>Het eindbedrag verdubbeld:</p>";
    }

    $nwBedrag = $bedrag * (1 + str_replace(",", ".", $_POST["rentepercentage"]) / 100);
    $bedragDubbel = $bedrag * 2;
    $jaar = 1;

    echo "<table>";
    echo "<tr>";
    echo "<th>Jaar</th>";
    echo "<th>Bedrag</th>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>$jaar</td>";
    echo "<td>€".number_format($nwBedrag, 2, ",", ".")."</td>";
    echo "</tr>";

    if ($_POST["berekening"] == "10Jaar") {
        for ($index = 0; $index < 9; $index++) {
            $nwBedrag = $nwBedrag * (1 + $rentepercentage / 100);
            $jaar++;

            echo "<tr>";
            echo "<td>$jaar</td>";
            echo "<td>€".number_format($nwBedrag, 2, ",", ".")."</td>";
            echo "</tr>";
        } 
    } elseif ($_POST["berekening"] == "verdubbeld") {
        while ($nwBedrag < $bedragDubbel) {
            $nwBedrag = $nwBedrag * (1 + $rentepercentage / 100);
            $jaar++;

            echo "<tr>";
            echo "<td>$jaar</td>";
            echo "<td>€".number_format($nwBedrag, 2, ",", ".")."</td>";
            echo "</tr>";
        }
    }

    echo "<table>";
}

?>
<?php

session_start();

include "keys.php";


if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit();
}
if (isset($_POST['tc']) && isset($_POST['td']) && isset($_POST['tp']) && isset($_POST['tz'])) {
    $tc = $_POST['tc']; // IMIENNY-OKAZICIEL
    $td = $_POST['td']; // NORMALNY-ULGOWY
    $tp = $_POST['tp']; // 30-90-150
    $tz = $_POST['tz']; // STREFA 1-STREFA 2-STREFA 1+2
    echo "Rodzaj: " . $tc . "\nUlga: " . $td . "\nOkres: " . $tp . "\nStrefa: " . $tz . "\n\n\n";
    $connection = new mysqli($host, $db_user, $db_password, $db_name);
    $result = $connection->query("SELECT ticket_price FROM tickets 
        WHERE 
        ticket_category = '$tc' && 
        ticket_discount = '$td' && 
        ticket_period = '$tp' && 
        ticket_zone = '$tz'");
    while ($row = $result->fetch_assoc()) {
        echo "<br><br><br>" . $row['ticket_price'] . "<br>";
    }
} else {
    echo "Niepoprawny wybór";
}


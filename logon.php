<?php
$mail = $_POST["mail"];
$pass = $_POST["password"];

echo("Your input: <br><br> mail: $mail <br><br> password: $pass <br><br>");

if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    echo "Email address '$mail' is considered valid.\n";
} else {
    echo "Email address '$mail' is considered invalid.\n";
}
?>
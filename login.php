<?php
$mail = $_POST["mail"];
$pass = $_POST["password"];
//$remember = ;

echo "Your input: <br><br> mail: $mail <br><br> password: $pass <br><br> remember: ";

if(!empty($_POST["rememberMe"])){
    echo "Yes <br><br>";
} else {
    echo "No <br><br>";
}

if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    echo "email address '$mail' is valid.\n";
} else {
    echo "email address '$mail' is invalid.\n";
}
?>
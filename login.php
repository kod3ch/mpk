<?php

session_start();

if ((!isset($_POST['mail'])) || (!isset($_POST['password']))) {
	header('Location: index.php');
	exit();
}

require_once "keys.php";

$connection = @new mysqli($host, $db_user, $db_password, $db_name);

if ($connection->connect_errno != 0) {
	echo "Błąd: " . $connection->connect_errno;
} else {
	$mail = $_POST['mail'];
	$pass = $_POST['password'];

	$mail = htmlentities($mail, ENT_QUOTES, "UTF-8");

	if ($result = @$connection->query(
		sprintf(
			"SELECT * FROM users WHERE mail='%s'",
			mysqli_real_escape_string($connection, $mail)
		)
	)) {
		$ilu_userow = $result->num_rows;
		if ($ilu_userow > 0) {

			$row = $result->fetch_assoc();

			if (password_verify($pass, $row['password'])) {

				$_SESSION['loggedin'] = true;


				$_SESSION['id'] = $row['id'];
				$_SESSION['name'] = $row['name'];
				$_SESSION['surname'] = $row['surname'];
				$_SESSION['pesel'] = $row['pesel'];
				$_SESSION['phone'] = $row['phone'];
				$_SESSION['mail'] = $row['mail'];
				$_SESSION['password'] = $row['password'];
				$_SESSION['isadmin'] = $row['admin'];

				unset($_SESSION['blad']);
				$result->free_result();
				header('Location: main.php');
			} else {

				$_SESSION['blad'] = '<span style="color:red">Niepoprawny mail lub hasło!</span>';
				header('Location: index.php');
			}
		} else {

			$_SESSION['blad'] = '<span style="color:red">Niepoprawny mail lub hasło!</span>';
			header('Location: index.php');
		}
	}

	$connection->close();
}

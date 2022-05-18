<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="dark_bus.png" id="light-scheme-icon">
    <link rel="icon" href="bus.ico" id="dark-scheme-icon">
    <link rel="stylesheet" href="main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Główna | MPK</title>
    <script>
        matcher = window.matchMedia('(prefers-color-scheme: dark)');
        matcher.addListener(onUpdate);
        lightSchemeIcon = document.querySelector('link#light-scheme-icon');
        darkSchemeIcon = document.querySelector('link#dark-scheme-icon');

        function onUpdate() {
            if (matcher.matches) {
                lightSchemeIcon.remove();
                document.head.append(darkSchemeIcon);
            } else {
                document.head.append(lightSchemeIcon);
                darkSchemeIcon.remove();
            }
        }
        onUpdate();
    </script>
</head>

<body>
    <nav class="navbar navbar-dark shadow vw-100" style="background-color: #2032b3;">
        <div class="container-sm">
            <a class="navbar-brand" href="#">
                <img src="bus.ico" alt="" width="30" height="24" class="d-inline-block align-text-top">
                &nbsp;MPK | System biletowy
            </a>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-dark padding-top shadow vw-100 py-0" style="background-color: #384de8; ">
        <div class="container-sm">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between mx-auto" id="navbarNav">
                <ul class="navbar-nav top-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Główna</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="buy.php">Zakup biletów</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="prices.php">Cennik</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Regulaminy
                        </a>
                        <ul class="dropdown-menu rounded-0 py-0" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Pierwszy</a></li>
                            <li><a class="dropdown-item" href="#">Drugi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Instrukcja obsługi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Kontakt</a>
                    </li>
                </ul>
                <form>
                    <ul class="navbar-nav top-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Wyloguj się</a>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </nav>

    <!-- Content -->

    <main class="flex-shrink-0">
        <?php
        echo "<p>Witaj, ".$_SESSION['name']." ".$_SESSION['surname']."</p>";
        ?>
    </main>

    <!-- Footer -->

    <nav class="navbar navbar-expand-lg fixed-bottom navbar-dark bg-dark shadow vw-100">
        <div class="container-sm">
            <div class="navbar-collapse justify-content-between pt-3" id="footer">
                <p>&copy; 2022 MPK</p>
                <p>Wszelkie prawa zastrzeżone</p>
            </div>
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>
<!-- ! -->
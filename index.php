<?php

	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: main.php');
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
  <script src='https://www.google.com/recaptcha/api.js'></script>
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

    function checkboxChangeInput(){
      if (document.getElementById('checkPesel').checked)
    {
      document.getElementById("peselInput").disabled = true;
      document.getElementById("bDate").classList.remove('invisible');
    } else
    {
      document.getElementById("peselInput").disabled = false;
      document.getElementById("bDate").classList.add('invisible');
    }
    }
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
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
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
              <a class="nav-link" data-bs-toggle="modal" href="#logowanieModalToggle">Logowanie</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="modal" href="#rejestracjaModalToggle">Rejestracja</a>
            </li>
          </ul>
        </form>
      </div>
    </div>
  </nav>

  <!-- Content -->

  <main class="flex-shrink-0">
    <?php
	  if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
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

  <!-- Modals -->
  <!-- Logowanie -->

  <div class="modal fade" id="logowanieModalToggle" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-hidden="true" aria-labelledby="logowanieModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="logowanieModalToggleLabel">Logowanie</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Content -->
          <div class="container">
            <div class="row justify-content-md-center">
                <form action="login.php" method="POST" >
                  <div class="mb-3">
                    <label for="loginInputEmail" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="loginInputEmail" aria-describedby="emailHelp"
                      placeholder="E-mail" name="mail">
                  </div>
                  <div class="mb-3">
                    <label for="loginInputPassword" class="form-label">Hasło</label>
                    <input type="password" class="form-control" id="loginInputPassword" name="password" placeholder="Hasło">
                  </div>
                  <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="loginRememberCheck" name="rememberMe">
                    <label class="form-check-label" for="loginRememberCheck">Zapamiętaj mnie</label>
                  </div>
                  <button type="submit" class="btn btn-primary">Zaloguj się</button>
                  <br><br>Nie masz konta? <a href="register.php" class="link-primary"
                    data-bs-target="#rejestracjaModalToggle" data-bs-toggle="modal">Rejestracja</a>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Rejestracja -->

  <div class="modal fade" id="rejestracjaModalToggle" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-hidden="true" aria-labelledby="rejestracjaModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg" data-bs-backdrop="static">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="rejestracjaModalToggleLabel">Rejestracja</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Content -->
          <form class="row g-12" method="POST">
            <div class="col-md-6 pt-2">
              <label for="nameInput" class="form-label">Imię</label>
              <input type="text" class="form-control " id="nameInput" placeholder="Jan">
            </div>
            <div class="col-md-6 pt-2">
              <label for="surnameInput" class="form-label">Nazwisko</label>
              <input type="text" class="form-control " id="surnameInput" placeholder="Kowalski">
            </div>
            <div class="col-md-6 pt-2">
              <label for="peselInput" class="form-label">PESEL</label>
              <input type="text" class="form-control " id="peselInput" placeholder="00012300099">
            </div>
            <div class="col-md-6 pt-2">
              <br>
              <input class="form-check-input" type="checkbox" value="" id="checkPesel" onclick="checkboxChangeInput()">
              <label class="form-check-label" for="checkPesel">
                Nie posiadam numeru PESEL
              </label>
            </div>
            <div class="col-md-6 pt-2">
              <label for="phoneInput" class="form-label">Telefon</label>
              <input type="text" class="form-control " id="phoneInput" placeholder="123456789">
            </div>
            <div class="col-md-6 pt-2 invisible" id="bDate">
              <!--<label for="bDateInput" class="form-label">Data urodzenia</label>
              <input type="text" class="form-control " id="bDateInput">-->
              <label for="bDateInput" class="form-label">Data urodzenia</label>
              <input id="startDate" class="form-control" type="date" id="bDateInput" name="bDate"/>
            </div>
            <div class="col-md-6 pt-2">
              <label for="mailInput" class="form-label">E-mail</label>
              <input type="text" class="form-control " id="mailInput" placeholder="poczta@wp.pl">
            </div>
            <div class="col-md-6 pt-2">
              <label for="confirmMailInput" class="form-label">Potwierdź adres E-mail</label>
              <input type="text" class="form-control " id="confirmMailInput" placeholder="poczta@wp.pl">
            </div>
            <div class="col-md-6 pt-2">
              <label for="passInput" class="form-label">Hasło</label>
              <input type="password" class="form-control " id="passInput" placeholder="Hasło">
            </div>
            <div class="col-md-6 pt-2">
              <label for="confirmPassInput" class="form-label">Potwierdź hasło</label>
              <input type="password" class="form-control " id="confirmPassInput" placeholder="Potwierdź hasło">
            </div>
            <!--
            <br><br>
            <div class="g-recaptcha" data-sitekey=""></div>
            -->
            <div class="col-12">
              <br>
              <button class="btn btn-primary" type="submit">Zarejestruj się</button>
            </div>
            <div class="col-12">
              <br> Nie masz konta? <a href="register.php" class="link-primary"
                data-bs-target="#logowanieModalToggle" data-bs-toggle="modal">Logowanie</a>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
</body>

</html>
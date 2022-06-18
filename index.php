<?php

session_start();

include "keys.php";

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true)) {
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

    function checkboxChangeInput() {
      if (document.getElementById('checkPesel').checked) {
        document.getElementById("peselInput").disabled = true;
        document.getElementById("bDateInput").disabled = false;
        document.getElementById("peselInput").value = "";
      } else {
        document.getElementById("peselInput").disabled = false;
        document.getElementById("bDateInput").disabled = true;
        document.getElementById("bDateInput").value = "";
      }
    }
  </script>
  <script src="https://www.google.com/recaptcha/api.js"></script>
</head>

<body class="bg">
  <nav class="fixed-top">
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
                <a class="nav-link"  href="register.php">Rejestracja</a>
              </li>
            </ul>
          </form>
        </div>
      </div>
    </nav>
  </nav>

  <!-- Content -->

  <div class="container-sm d-flex flex-column" style="margin-top:96px;">
    <div class="d-flex justify-content-center">
      <div id="carouselExampleCaptions" class="carousel carousel slide justify-content-center" data-bs-ride="false"
        style="width: 50rem;">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner rounded mt-3">
          <div class="carousel-item active">
            <img src="img/elektro.jpg" class="d-block w-100">

          </div>
          <div class="carousel-item">
            <img src="img/troll.jpg" class="d-block w-100">

          </div>
          <div class="carousel-item">
            <img src="img/bus.jpg" class="d-block w-100">

          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
          data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
          data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
    <div class="d-flex justify-content-center mt-3">
      <p class="h2">MPK</p>
    </div>
    <div class="d-flex justify-content-between">
      <div class="card mt-2" style="width: 18rem;">
        <div class="card-body bg-mydark rounded">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
            content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
      <div class="card mt-2 " style="width: 18rem;">
        <div class="card-body bg-mydark rounded">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
            content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
      <div class="card mt-2" style="width: 18rem;">
        <div class="card-body bg-mydark rounded">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
            content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->

  <nav class="navbar navbar-expand-lg  navbar-dark bg-dark shadow mt-3">
    <div class="container-sm">
      <div class="navbar-collapse justify-content-between pt-3" id="footer">
        <p>&copy; 2022 MPK</p>
        <p>Wszelkie prawa zastrzeżone</p>
      </div>
    </div>
  </nav>

  <!-- Modals -->
  <!-- Logowanie -->

  <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="logowanieModalToggle"
    aria-hidden="true" aria-labelledby="logowanieModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="logowanieModalToggleLabel">Logowanie</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="login.php" class="px-5 py-3" method="POST" id="form-k">
          <div class="row">
            <label for="mailInput" class="form-label">E-mail</label>
            <input type="mail" class="form-control " id="mailLoginInput" placeholder="jankowalski@wp.pl" name="mail"
              require>
          </div>
          <div class="row pt-3">
            <label for="passInput" class="form-label">Hasło</label>
            <input type="password" class="form-control " id="passLoginInput" placeholder="qwerty123" name="password"
              require>
          </div>
          <div class="col-12">
            <br>
            <button class="btn btn-primary" type="submit">Zaloguj się</button>
          </div>
          <div class="col-12">
            <br> Nie masz konta? <a href="register.php" class="link-primary" data-bs-target="#rejestracjaModalToggle"
              data-bs-toggle="modal">Rejestracja</a>
          </div>
        </form>
      </div>
    </div>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
</body>

</html>
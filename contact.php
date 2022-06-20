<?php

session_start();

?>
<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="img/dark_bus.png" id="light-scheme-icon">
  <link rel="icon" href="img/bus.ico" id="dark-scheme-icon">
  <link rel="stylesheet" href="assets/main.css">
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Kontakt | MPK</title>
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
  <script src="https://www.google.com/recaptcha/api.js"></script>
</head>

<body class="bg">
  <!-- NAVBAR -->
  <nav class="fixed-top">
    <nav class="navbar navbar-dark shadow vw-100" style="background-color: #2032b3;">
      <div class="container-sm">
        <a class="navbar-brand" href="index.php">
          <img src="img/bus.ico" alt="" width="30" height="24" class="d-inline-block align-text-top">
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
                Instrukcje i regulaminy
              </a>
              <ul class="dropdown-menu rounded-0 py-0" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="terms.php">Regulamin Usługi</a></li>
                <li><a class="dropdown-item" href="instruction.php">Instrukcja Obsługi</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.php">Kontakt</a>
            </li>
          </ul>
          <form>
            <?php 
            if (isset($_SESSION['loggedin'])) {
              echo '
              <ul class="navbar-nav top-nav">
                  <li class="nav-item">
                      <a class="nav-link" href="logout.php">Wyloguj się</a>
                  </li>
              </ul>';
          } else {
            echo '
              <ul class="navbar-nav top-nav">
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="modal" href="#logowanieModalToggle">Logowanie</a>
              </li>
              <li class="nav-item">
                <a class="nav-link"  href="register.php">Rejestracja</a>
              </li>
              </ul>';
          }
          ?>
          </form>
        </div>
      </div>
    </nav>
  </nav>


  <div class="container-sm d-flex flex-column" style="margin-top:125px;">

    <div class="d-flex justify-content-between">
      <div class="d-flex flex-column justify-content-start">
        <h3>Adres</h3>
        <h5 style="text-align: center;">MPK w Lublinie</h5>
        <h5 style="text-align: center;">ul. Bursaki, 12</h5>
        <h5 style="text-align: center;">20-150, Lublin</h5>
        <h5 style="text-align: center;">NIP 712-23-92-737</h5>
        <h5 style="text-align: center;">REGON 430977957</h5>
        <h5 style="text-align: center;">Skrytka ePUAP: /mpk_lublin/SkrytkaESP</h5>
        <h3>Dojazd</h3>
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d883.3209031323283!2d22.624106987242737!3d51.22996563795314!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x472256ec72dac4df%3A0x473a3e8131c578c!2sMPK%20Lublin%20Sp.%20z%20o.o.!5e0!3m2!1spl!2spl!4v1655751562629!5m2!1spl!2spl"
          width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <div class="contact-us" style="width: 25rem;">
        <h3>Napisz do nas:</h3>
        <form method="POST">
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Imię i Nazwisko</label>
            <input type="name" class="form-control" id="exampleFormControlInput1" placeholder="Jan Kowalski">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="jan@wp.pl">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Treść</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="6"></textarea>
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Wyślij</button>
          </div>
        </form>
      </div>
    </div>

  </div>
  <!-- FOOTER -->

  <nav class="navbar navbar-expand-lg fixed-bottom navbar-dark bg-dark shadow vw-100">
    <div class="container-sm">
      <div class="navbar-collapse justify-content-between pt-3" id="footer">
        <p>&copy; 2022 MPK</p>
        <p>Wszelkie prawa zastrzeżone</p>
      </div>
    </div>
  </nav>

  <!-- LOGGING MODAL -->

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
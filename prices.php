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
  <title>Cennik | MPK</title>
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
            <a class="nav-link" aria-current="page" href="index.php">G????wna</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="buy.php">Zakup bilet??w</a>
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
              <li><a class="dropdown-item" href="terms.php">Regulamin Us??ugi</a></li>
              <li><a class="dropdown-item" href="instruction.php">Instrukcja Obs??ugi</a></li>
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
                      <a class="nav-link" href="logout.php">Wyloguj si??</a>
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


  <div class="container-sm d-flex flex-column" style="margin-top:96px;">

  <?php 
  include "keys.php";
  $connection = new mysqli($host, $db_user, $db_password, $db_name);
  $query = "SELECT ticket_id, ticket_category, ticket_discount, ticket_period, ticket_zone, ticket_price FROM tickets";
  $result = mysqli_query($connection, $query) or die("database error:". mysqli_error($conn));
  
?>
      <table class="table table-striped">                     
      <div class="table responsive">
          <thead>
              <tr>
                <th>ID</th>
                <th>Typ</th>
                <th>Ulga</th>
                <th>Okres</th>
                <th>Strefa</th>
                <th>Cena</th>
              </tr>
          </thead>
          <tbody>
          <?php 
          $connection = new mysqli($host, $db_user, $db_password, $db_name);
          $query = "SELECT ticket_id, ticket_category, ticket_discount, ticket_period, ticket_zone, ticket_price FROM tickets";
          $result = mysqli_query($connection, $query) or die("database error:". mysqli_error($conn));
          
          if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
          echo '<tr>
                    <td scope="row">' . $row["ticket_id"]. '</td>
                    <td>' . $row["ticket_category"] .'</td>
                    <td> '.$row["ticket_discount"] .'</td>
                    <td> '.$row["ticket_period"] .'</td>
                    <td> '.$row["ticket_zone"] .'</td>
                    <td> '.$row["ticket_price"] .'</td>
                  </tr>';
              }
          } else {
              echo "0 results";
          } 
          ?>
        </tbody>
          </div>
      </table>
    </div>

  <!-- FOOTER -->

  <nav class="navbar navbar-expand-lg fixed-bottom navbar-dark bg-dark shadow vw-100">
        <div class="container-sm">
            <div class="navbar-collapse justify-content-between pt-3" id="footer">
                <p>&copy; 2022 MPK</p>
                <p>Wszelkie prawa zastrze??one</p>
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
            <label for="passInput" class="form-label">Has??o</label>
            <input type="password" class="form-control " id="passLoginInput" placeholder="qwerty123" name="password"
              require>
          </div>
          <div class="col-12">
            <br>
            <button class="btn btn-primary" type="submit">Zaloguj si??</button>
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
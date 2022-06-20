<script src="assets/jquery-3.6.0.min.js"></script>
<?php

session_start();

include "keys.php";

if (!isset($_SESSION['loggedin'])) {
  header('Location: index.php');
  exit();
}

if(isset($_POST['buy'])){

  echo "<script type='text/javascript'>
  $(document).ready(function(){
  $('#successModalToggle').modal('show');
  });
  </script>";
  $connection = new mysqli($host, $db_user, $db_password, $db_name);
  $id = $_SESSION['id'];
  $price=$_SESSION['price'];
  $ti = $_SESSION['ti'];
  $c=$_SESSION['c'];
  date_default_timezone_set('Europe/Warsaw');
  $info = getdate();
  $day = $info['mday'];
  $month = $info['mon'];
  $year = $info['year'];
  $hour = $info['hours'];
  $min = $info['minutes'];
  $sec = $info['seconds'];
  $current_date = "$year-$month-$day $hour:$min:$sec";
  $connection->query("
  INSERT INTO transactions (trans_date, trans_user_id, trans_tickets_id, trans_quantity, trans_price) VALUES 
  ('$current_date', '$id', '$ti', '$c', '$price')
  ");

} elseif (isset($_POST['tc']) && isset($_POST['td']) && isset($_POST['tp']) && isset($_POST['tz'])) {
  $OK = true;

  $tc = $_POST['tc']; // IMIENNY-OKAZICIEL
  $td = $_POST['td']; // NORMALNY-ULGOWY
  $tp = $_POST['tp']; // 30-90-150
  $tz = $_POST['tz']; // STREFA 1-STREFA 2-STREFA 1+2
  $c = $_POST['count']; // 1-20

  $t1 = "Rodzaj: " . $tc . "<br>" . "\nUlga: " . $td . "<br>" . "\nOkres: " . $tp . " dni<br>" . "\nStrefa: " . $tz . "<br>Ilość: " . $c . "<br><br>";
  $connection = new mysqli($host, $db_user, $db_password, $db_name);
  $result = $connection->query("SELECT ticket_price, ticket_id FROM tickets 
        WHERE 
        ticket_category = '$tc' && 
        ticket_discount = '$td' && 
        ticket_period = '$tp' && 
        ticket_zone = '$tz'");
  while ($row = $result->fetch_assoc()) {
        $price.=$row['ticket_price'];
        $ti = $row['ticket_id'];
    }
  $price*=$c;
  echo "<script type='text/javascript'>
  $(document).ready(function(){
  $('#ticketConfirmModalToggle').modal('show');
  });
  </script>";
  $_SESSION['price']=$price;
  $_SESSION['c']=$c;
  $_SESSION['ti']=$ti;
} else {
  $err = "Zaznacz wszystkie pola!";
  echo "<script type='text/javascript'>
  $(document).ready(function(){
  $('#wrongInputModalToggle').modal('show');
  });
  </script>";
}


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
  <title>Zakup biletów | MPK</title>
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

  <!-- Content -->

  <div class="container-sm d-flex flex-column" style="margin-top:125px;">
    <!-- TEXT -->

    <div class="d-flex justify-content-center">
      <h2><?php echo "<p>Witaj, " . $_SESSION['name'] . " " . $_SESSION['surname'] . "</p>"; ?></h2>
    </div>
    <div class="d-flex justify-content-center">
      <h2>Skonfiguruj swój bilet:</h2>
    </div>

    <!-- TICKETS -->

    <form method="POST" class="pt-4">
      <div class="row g-3">
        <div class="col-6">
          <select class="form-select" aria-label="RODZAJ BILETU" name="tc">
            <option selected disabled>RODZAJ BILETU</option>
            <option value="IMIENNY">IMIENNY</option>
            <option value="OKAZICIEL">OKAZICIEL</option>
          </select>
        </div>

        <div class="col-6">
          <select class="form-select" aria-label="RODZAJ ULGI" name="td">
            <option selected disabled>RODZAJ ULGI</option>
            <option value="NORMALNY">NORMALNY</option>
            <option value="ULGOWY">ULGOWY</option>
          </select>
        </div>

        <div class="col-6">
          <select class="form-select" aria-label="LICZBA DNI" name="tp">
            <option selected disabled>LICZBA DNI</option>
            <option value="30">30</option>
            <option value="90">90</option>
            <option value="150">150</option>
          </select>
        </div>

        <div class="col-6">
          <select class="form-select" aria-label="STREFA" name="tz">
            <option selected disabled>STREFA</option>
            <option value="STREFA 1">STREFA 1</option>
            <option value="STREFA 2">STREFA 2</option>
            <option value="STREFA 1+2">STREFA 1+2</option>
          </select>
        </div>

        <div class="d-flex justify-content-center">
          <br>
          <h4>Ilość:&nbsp;</h4>
          <input type="number" min="1" max="20" value="1" name="count"><br>
        </div>
        <div class="d-flex justify-content-center">
          <button class="btn btn-primary w-3" type="submit">Przejdź do podsumawania</button>
        </div>
      </div>
    </form>

  </div>

  <!-- CONFIRM AND COUNT TOGGLE -->

  <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="ticketConfirmModalToggle"
    aria-hidden="true" aria-labelledby="ticketConfirmModalToggleLabel" hidden.bs.modal="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ticketConfirmModalToggleLabel">Potwierdź koszyk:</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php
        echo $t1 . " Do zapłaty: " . $price . " zł.";
        ?>
        </div>
        <div class="modal-footer">
          <form method="POST">
            <input type="submit" name="buy" value="KUP"/>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- ERROR TOGGLE -->

  <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="wrongInputModalToggle"
    aria-hidden="true" aria-labelledby="wrongInputModalToggleLabel" hidden.bs.modal="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="wrongInputModalToggleLabel">Wstąpił błąd:</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php
        echo $err;
        ?>
        </div>
      </div>
    </div>
  </div>

  <!-- SUCCESSFULL PURCHASE -->
  <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="successModalToggle"
    aria-hidden="true" aria-labelledby="successModalToggleLabel" hidden.bs.modal="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="successModalToggleLabel">Udany zakup!</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h4>Dziękujemy za dokonanie zakupu! <?php $price ?></h4>
        </div>
        <div class="modal-footer">
          <a href="main.php"><button type="button" class="btn btn-primary">Menu</button></a>
        </div>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
</body>

</html>
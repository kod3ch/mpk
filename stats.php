<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['isadmin']==0) {
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
  <link rel="icon" href="img/dark_bus.png" id="light-scheme-icon">
  <link rel="icon" href="img/bus.ico" id="dark-scheme-icon">
  <link rel="stylesheet" href="assets/main.css">
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Statystyki | MPK</title>
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
<?php 
  include "keys.php";
  $connection = new mysqli($host, $db_user, $db_password, $db_name);
  $query = "SELECT trans_id, trans_date, trans_user_id, trans_tickets_id, trans_quantity, trans_price FROM transactions";
  $result = mysqli_query($connection, $query) or die("database error:". mysqli_error($conn));
  
?>
    <div class="container-sm">
      <h4 style="margin-top: 150px;">Ilość sprzedanych biletów: 
        <?php 
        $summ=0;
        $qa=0;
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $summ+=$row['trans_price'];
            $qa+=$row['trans_quantity'];
        }}
        echo $qa;
        ?>
    </h4>
      <h4>Zysk: <?php echo $summ; ?> zł.</h4> <br><br>
      <table class="table table-striped">                     
      <div class="table responsive">
          <thead>
              <tr>
                <th>Nr.</th>
                <th>Data Transakcji</th>
                <th>Użytkownik Nr.</th>
                <th>Bilet Nr.</th>
                <th>Ilość Biletów</th>
                <th>Cena</th>
              </tr>
          </thead>
          <tbody>
          <?php 
          $connection = new mysqli($host, $db_user, $db_password, $db_name);
          $query = "SELECT trans_id, trans_date, trans_user_id, trans_tickets_id, trans_quantity, trans_price FROM transactions";
          $result = mysqli_query($connection, $query) or die("database error:". mysqli_error($conn));
          
          if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
          echo '<tr>
                    <td scope="row">' . $row["trans_id"]. '</td>
                    <td>' . $row["trans_date"] .'</td>
                    <td> '.$row["trans_user_id"] .'</td>
                    <td> '.$row["trans_tickets_id"] .'</td>
                    <td> '.$row["trans_quantity"] .'</td>
                    <td> '.$row["trans_price"] .'</td>
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
                <p>Wszelkie prawa zastrzeżone</p>
            </div>
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>
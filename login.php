<?php 

?>
<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="travel_bus.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="main.css">
  <title>Logowanie | MPK</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">MPK</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Główna</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="buy.php">Zakup biletów</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="prices.php">Cennik</a>
          </li>
        </ul>
      </div>
      <form class="justify-content-start">
        <button class="btn btn-primary btn-outline-light" type="button" href="login.php">Logowanie</button>
        <button class="btn btn-primary btn-outline-light" type="button" href="register.php">Rejestracja</button>
      </form>
    </div>
  </nav>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col col-lg-5">
        <br><br><br>
        <h1 class="display-6">Logowanie</h1>
        <form action="logon.php" method="POST">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="name@example.com" name="mail">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label" >Hasło</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Zapamiętaj mnie</label>
          </div>
          <button type="submit" class="btn btn-primary">Zaloguj się</button>
          <br><br>Nie masz konta? <a href="register.php" class="link-primary">Rejestracja</a>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
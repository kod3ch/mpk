<script src="jquery-3.6.0.min.js"></script>
<?php

session_start();

include "keys.php";

// SPRAWDZENIE LOGOWANIA

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true)) {
    header('Location: main.php');
    exit();
}

// REJESTRACJA

if (isset($_POST['i_Name'])) {
    $OK = true;

    //name
    $name = $_POST['i_Name'];
    if ((strlen($name) < 3) || (strlen($name) > 25)) {
        $OK = false;
        $_SESSION['err_name'] = "Niepoprawne imię.";
    }
    if (ctype_alpha($name) == false) {
        $OK = false;
        $_SESSION['err_name'] = "Tylko litery w imieniu.";
    }
    //surname
    $surname = $_POST['i_Surname'];
    if ((strlen($surname) < 3) || (strlen($surname) > 35)) {
        $OK = false;
        $_SESSION['err_surname'] = "Niepoprawne nazwisko.";
    }
    if (ctype_alpha($surname) == false) {
        $OK = false;
        $_SESSION['err_surname'] = "Tylko litery w nazwisku.";
    }
    // pesel
    $pesel = $_POST['i_Pesel'];
    if (strlen($pesel) != 11) {
        $OK = false;
        $_SESSION['err_pesel'] = "PESEL ma 11 cyfr.";
    }
    if (ctype_digit($pesel) == false) {
        $OK = false;
        $_SESSION['err_pesel'] = "Tylko cyfry PESEL.";
    }
    // phone
    $phone = $_POST['i_phone']; // 
    if (ctype_digit($phone) == false) {
        $OK = false;
        $_SESSION['err_phone'] = "Tylko cyfry nr. telefonu.";
    }
    if (strlen($phone) != 9) {
        $OK = false;
        $_SESSION['err_phone'] = "Niepoprawny numer telefonu";
    }
    // mail
    $mail1 = $_POST['i_mail1'];
    $mail2 = $_POST['i_mail2'];
    if ($mail2 != $mail1) {
        $OK = false;
        $_SESSION['err_mail'] = " Różne maile.";
    }
    $mail1S = filter_var($mail1, FILTER_SANITIZE_EMAIL);
    if ((filter_var($mail1S, FILTER_VALIDATE_EMAIL) == false) || ($mail1S != $mail1)) {
        $OK = false;
        $_SESSION['err_mail'] = " Niepoprawny mail.";
    }
    // pass
    $pass1 = $_POST['i_pass1'];
    $pass2 = $_POST['i_pass2'];
    if (strlen($pass1) < 8) {
        $OK = false;
        $_SESSION['err_pass'] = "Hasło musi zawierać conajmniej 8 znaków";
    }
    if ($pass1 != $pass2) {
        $OK = false;
        $_SESSION['err_pass'] = "Różne hasła.";
    }
    $pass_hash = password_hash($pass1, PASSWORD_DEFAULT);
    // terms
    if (!isset($_POST['i_terms'])) {
        $OK = false;
        $_SESSION['err_terms'] = "Zaakceptuj regulamin.";
    }
    // reCaptcha
    $c_bot = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $recaptcha_secret_key . '&response=' . $_POST['g-recaptcha-response']);
    $response = json_decode($c_bot);

    if ($response->success == false) {
        $OK = false;
        $_SESSION['err_bot'] = "Potwierdź, że nie jesteś botem!";
    }
    // save input
    $_SESSION['li_name'] = $name;
    $_SESSION['li_surname'] = $surname;
    $_SESSION['li_pesel'] = $pesel;
    $_SESSION['li_phone'] = $phone;
    $_SESSION['li_mail'] = $mail1;
    $_SESSION['li_mail2'] = $mail2;
    $_SESSION['li_pass1'] = $pass1;
    $_SESSION['li_terms'] = $pass2;
    $_SESSION['li_terms'] = $_POST['i_terms'];

    try {
        $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
        if ($polaczenie->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            // mail
            $rezultat = $polaczenie->query("SELECT id FROM users WHERE mail='$mail1'");

            if (!$rezultat) throw new Exception($polaczenie->error);

            $ile_takich_maili = $rezultat->num_rows;
            if ($ile_takich_maili > 0) {
                $OK = false;
                $_SESSION['err_mail'] = "Istnieje już konto przypisane do tego adresu e-mail!";
            }
            // phone
            $rezultat = $polaczenie->query("SELECT id FROM users WHERE phone='$phone'");

            if (!$rezultat) throw new Exception($polaczenie->error);

            $ile_takich_maili = $rezultat->num_rows;
            if ($ile_takich_maili > 0) {
                $OK = false;
                $_SESSION['err_phone'] = "Istnieje już konto przypisane do tego telefonu!";
            }
            // pesel
            $rezultat = $polaczenie->query("SELECT id FROM users WHERE pesel='$pesel'");

            if (!$rezultat) throw new Exception($polaczenie->error);

            $ile_takich_maili = $rezultat->num_rows;
            if ($ile_takich_maili > 0) {
                $OK = false;
                $_SESSION['err_pesel'] = "Istnieje już konto przypisane do tego PESELu!";
            }
            if ($OK == true) {
                //Hurra, wszystkie testy zaliczone, dodajemy gracza do bazy

                if ($polaczenie->query("INSERT INTO users VALUES (NULL, '$name', '$surname', '$pesel', '$phone', '$mail1', '$pass_hash')")) {
                    echo "<script type='text/javascript'>
                        $(document).ready(function(){
                        $('#Modal').modal('show');
                        });
                        </script>";
                    $_SESSION['registerok'] = true;
                } else {
                    throw new Exception($polaczenie->error);
                }
            }
        }
    } catch (Exception $e) {
        $e;
    }
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
    <title>Rejestracja | MPK</title>
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
    <nav class="fixed-top">
        <nav class="navbar navbar-dark shadow vw-100" style="background-color: #2032b3;">
            <div class="container-sm">
                <a class="navbar-brand" href="index.php">
                    <img src="bus.ico" alt="" width="30" height="24" class="d-inline-block align-text-top">
                    &nbsp;MPK | System biletowy
                </a>
            </div>
        </nav>
        <nav class="navbar navbar-expand-lg navbar-dark padding-top shadow vw-100 py-0"
            style="background-color: #384de8; ">
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
                                <a class="nav-link" data-bs-toggle="modal" href="#logowanieModalToggle">Logowanie</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="register.php">Rejestracja</a>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </nav>
    </nav>



    <!-- CONTENT -->

    <div class="container-sm">
        <!-- Wyświetlenie błędów -->
        <main class="pt-3 error" style="margin-top:80px;">
            <?php
            if (isset($_SESSION['blad']))  echo $_SESSION['blad'];
            ?>
        </main>


        <!-- Formularz rejestracji -->
        <form method="POST" class="pt-4">
            <div class="row g-3">
                <div class="col-6">
                    <label for="nameInput" class="form-label">Imię <div class="error">
                            <?php if (isset($_SESSION['err_name'])) echo ($_SESSION['err_name']); ?></div></label>
                    <input type="text" class="form-control" id="nameInput" placeholder="Jan" name="i_Name" value="<?php
                if (isset($_SESSION['li_name'])) {
                    echo $_SESSION['li_name'];
                    unset($_SESSION['li_name']);
                }
                ?>">
                </div>

                <div class="col-6">
                    <label for="surnameInput" class="form-label">Nazwisko <div class="error">
                            <?php if (isset($_SESSION['err_surname'])) echo ($_SESSION['err_surname']); ?></div></label>
                    <input type="text" class="form-control" id="surnameInput" placeholder="Kowalski" name="i_Surname"
                        value="<?php
                            if (isset($_SESSION['li_surname'])) {
                                echo $_SESSION['li_surname'];
                                unset($_SESSION['li_surname']);
                            }
                            ?>">
                </div>
                <div class="col-6">
                    <label for="peselInput" class="form-label">PESEL <div class="error">
                            <?php if (isset($_SESSION['err_pesel'])) echo ($_SESSION['err_pesel']); ?></div></label>
                    <input type="text" class="form-control " id="peselInput" placeholder="00012300099" name="i_Pesel"
                        value="<?php
                            if (isset($_SESSION['li_pesel'])) {
                                echo $_SESSION['li_pesel'];
                                unset($_SESSION['li_pesel']);
                            }
                            ?>">
                </div>
                <div class="col-6">
                    <label for="phoneInput" class="form-label">Telefon <div class="error">
                            <?php if (isset($_SESSION['err_phone'])) echo ($_SESSION['err_phone']); ?></div></label>
                    <input type="text" class="form-control" id="phoneInput" placeholder="123456789" name="i_phone"
                        value="<?php
                            if (isset($_SESSION['li_phone'])) {
                                echo $_SESSION['li_phone'];
                                unset($_SESSION['li_phone']);
                            }
                            ?>">
                </div>
                <div class="col-6">
                    <label for="mailInput" class="form-label">E-mail <div class="error">
                            <?php if (isset($_SESSION['err_mail'])) echo ($_SESSION['err_mail']); ?></div></label>
                    <input type="text" class="form-control " id="mailRegInput" placeholder="poczta@wp.pl" name="i_mail1"
                        value="<?php
                            if (isset($_SESSION['li_mail'])) {
                                echo $_SESSION['li_mail'];
                                unset($_SESSION['li_mail']);
                            }
                            ?>">
                </div>
                <div class="col-6">
                    <label for="confirmMailInput" class="form-label">Potwierdź adres E-mail <div class="error">
                            <?php if (isset($_SESSION['err_mail'])) echo ($_SESSION['err_mail']); ?></div></label>
                    <input type="text" class="form-control " id="confirmMailRegInput" placeholder="poczta@wp.pl"
                        name="i_mail2" value="<?php
                            if (isset($_SESSION['li_mail2'])) {
                                echo $_SESSION['li_mail2'];
                                unset($_SESSION['li_mail2']);
                            }
                            ?>">
                </div>
                <div class="col-6">
                    <label for="passInput" class="form-label">Hasło <div class="error">
                            <?php if (isset($_SESSION['err_pass'])) echo ($_SESSION['err_pass']); ?></div></label>
                    <input type="password" class="form-control " id="passRegInput" placeholder="Hasło" name="i_pass1"
                        value="<?php
                            if (isset($_SESSION['li_pass1'])) {
                                echo $_SESSION['li_pass1'];
                                unset($_SESSION['li_pass1']);
                            }
                            ?>">
                </div>
                <div class="col-6">
                    <label for="confirmPassInput" class="form-label">Potwierdź hasło <div class="error">
                            <?php if (isset($_SESSION['err_pass'])) echo ($_SESSION['err_pass']); ?></div></label>
                    <input type="password" class="form-control " id="confirmPassRegInput" placeholder="Potwierdź hasło"
                        name="i_pass2" value="<?php
                            if (isset($_SESSION['li_pass2'])) {
                                echo $_SESSION['li_pass2'];
                                unset($_SESSION['li_pass2']);
                            }
                            ?>">
                </div>
                <div class="col-6">
                    <input class="form-check-input" type="checkbox" value="" id="termsCheck" name="i_terms" value="<?php
                            if (isset($_SESSION['li_terms'])) {
                                echo $_SESSION['li_terms'];
                                unset($_SESSION['li_terms']);
                            }
                            ?>">
                    <label for="termsCheck" class="form-label">Oświadczam, że zapoznałem/am się z <a
                            href="#">Regulaminem
                            Usługi</a> i akceptuję
                        wszystkie zawarte
                        w nim warunki.<div class="error">
                            <?php if (isset($_SESSION['err_terms'])) echo ($_SESSION['err_terms']); ?></div></label>
                </div>
                <div class="col-6">
                    <!-- RECAPTCHA -->

                    <div class="col-6 pt-3 ps-3">
                        <div class="g-recaptcha" data-sitekey="<?php echo ($recaptcha_site_key) ?>">
                        </div>
                        <div class="error"> <?php if (isset($_SESSION['err_bot'])) echo ($_SESSION['err_bot']); ?></div>
                    </div>

                    <div class="col-3 ">
                        <br>
                        <button class="btn btn-primary" type="submit">Zarejestruj się</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Footer -->

    <nav class="navbar navbar-expand-lg  navbar-dark bg-dark shadow" style="margin-top:249px;">
        <div class="container-sm">
            <div class="navbar-collapse justify-content-between pt-3" id="footer">
                <p>&copy; 2022 MPK</p>
                <p>Wszelkie prawa zastrzeżone</p>
            </div>
        </div>
    </nav>

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
    

    <div class="modal fade" id="Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Udana rejestracja!</h5>
                </div>
                <div class="modal-body">
                    Udało ci się zarejestrować! Wejdź do konta przez stronę główną.
                </div>
                <div class="modal-footer">
                    <a href="index.php"><button type="button" class="btn btn-primary">Główna</button></a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>
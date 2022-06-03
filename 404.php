<?php 

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
  <title>404 - Nie znaleziono | MPK</title>
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
  <div class="position-absolute top-50 start-50 translate-middle">
    <h1 class="text-center">404 | Nie znaleziono takiej strony</h1>
    <h1 class="text-center"><a href="index.php">Główna</a></h1>
  </div>
</body>

</html>
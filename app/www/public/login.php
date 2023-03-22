<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: ../profile.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="css/index.css" />
    <link rel="stylesheet" href="css/reset.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Приемная комиссия</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php">Приемная комиссия</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link"  href="index.php">Главная</a>
              </li>
              <li class="nav-item">
                <a class="nav-link"  href="#">Абитуриенту</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Личный кабинет
                </a>
                  <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="login.php">
                              <?php if ((isset($_SESSION["user"])) or isset($_SESSION["employer"]))
                              {
                                  echo "<a class=\"dropdown-item\" href=\"profile.php\">Профиль</a>";
                              }
                              else{
                                  echo "<a class=\"dropdown-item\" href=\"login.php\">Войти</a>";
                              }?></a></li>

                      <li><a class="dropdown-item" href="register.php">
                              <?php if ((isset($_SESSION["user"])) or isset($_SESSION["employer"]))
                              {
                                  echo "<a href=\"vendor/logout.php\" class=\"dropdown-item\">Выйти</a>";}
                              else{
                                  echo "<a class=\"dropdown-item\" href=\"register.php\">Зарегестрироваться</a>";
                              }?>
                          </a></li>

                      <!-- <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Выйти</a></li> -->
                  </ul>
              </li>
            </ul>
            <span class="navbar-brand">
                Авторизация
              </span>
          </div>
        </div>
      </nav>
      <div class="container">
          <form action="vendor/signing.php" method="post">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="email"name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
              <?php
              if (isset($_SESSION['message'])) {
                  echo '<p class="msg" style="color: red;"> ' . $_SESSION['message'] . ' </p>';
              }
              unset($_SESSION['message']);

              ?>
            <button type="submit" class="btn btn-primary">Готово</button>
          </form>
          <p></p>
          <a class="back-button" href="http://localhost/index.php" style="color: black;">Вернуться на главную</a>
      </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
</html> 
<?php
require_once("vendor/db_connect.php");
session_start();
if (isset($_SESSION['user'])) {
    header('Location: login.php');
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
                <a class="nav-link"  href="entrant.php">Абитуриенту</a>
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
                Регистрация
              </span>
          </div>
        </div>
      </nav>
      <div class="container">
        <h2>Заполните регистрационную форму для доступа в личный кабинет абитуриента.</h2>

        <p>Уже есть учетная запись абитуриента? <a href="#">Войти</a></p>
        <p>Забыли пароль? <a href="#">Сбросить</a></p>

        <p>Если у Вас возникли трудности при работе с Информационной системой "Абитуриент-студент", обращайтесь: <a href="">orginfo@mephi.ru</a></p>

        <form class="row g-3 needs-validation" action="vendor/signup.php" method="post" enctype="multipart/form-data" novalidate>

            <div class="col-md-4">
              <label for="inputName" class="form-label">Имя</label>
              <input type="text" class="form-control" name="inputName" id="inputName" value="" required>
              <div class="invalid-feedback">
                Некорректные данные!
            </div>
              <div class="valid-feedback">
                Заполнено!
              </div>
            </div>

            <div class="col-md-4">
              <label for="inputSurname" class="form-label">Фамилия</label>
              <input type="text" class="form-control" name="inputSurname" id="inputSurname" value="" required>
              <div class="invalid-feedback">
                Некорректные данные!
            </div>
              <div class="valid-feedback">
                Заполнено!
              </div>
            </div>

            <div class="col-md-4">
              <label for="inputPatronymic" class="form-label">Отчество</label>
              <input type="text" class="form-control" name="inputPatronymic" id="inputPatronymic" value="" required>
              <div class="invalid-feedback">
                  В случае отсутствия введите: "Без отчества"
            </div>
              <div class="valid-feedback">
                Заполнено!
              </div>
            </div>

            <div class="row g-3 align-items-center">
              <div class="col-auto">
                <label for="inputBirthday" class="form-label">Дата рождения</label>
                <div class="input-group has-validation">
                  <input type="date" class="form-control" name="inputBirthday" id="inputBirthday" required>
                  <div class="invalid-feedback">
                  </div>
                </div>
              </div>

            </div>


            <div class="col-md-6">
              <label for="inputMail" class="form-label">Почта</label>
              <div class="input-group has-validation">
                <input type="email" class="form-control" name="inputMail" id="inputMail" placeholder="name@example.com" aria-describedby="inputGroupPrepend" required>
                <div class="invalid-feedback">
                    Некорректные данные!
                </div>
              </div>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                  <label for="registerInputPassword" class="form-label">Пароль</label>
                  <div class="input-group has-validation">
                    <input type="password" class="form-control" name="registerInputPassword" id="registerInputPassword" required>
                    <div class="invalid-feedback">
                      Некорректные данные!
                    </div>
                  </div>
                </div>
                <div class="col-auto">
                  <label for="registerInputPasswordConfirm" class="form-label">Подтверждение пароля</label>
                  <div class="input-group has-validation">
                    <input type="password" class="form-control" name="registerInputPasswordConfirm" id="registerInputPasswordConfirm" required>
                    <div class="invalid-feedback">
                      Некорректные данные!
                    </div>
                  </div>
                </div>
            </div>
            
          
            <div class="col-12">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                <label class="form-check-label" for="invalidCheck">
                Я согласен на обработку моих персональных данных
                </label>
                <div class="invalid-feedback">
                </div>
              </div>
            </div>
            <div class="col-12">
              <button class="btn btn-primary" type="submit">Готово</button>
            </div>
          </form>
          <?php
          if (isset($_SESSION['message'])) {
              echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
          }
          unset($_SESSION['message']);
          ?>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
</html> 
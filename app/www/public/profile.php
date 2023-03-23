<?php
session_start();
require_once("vendor/db_connect.php");
include("vendor/requests_fetching.php");
include("vendor/auto_exit.php");

if (!isset($_SESSION['user'])) {
    unset($_SESSION['employer']);
    header('Location: http://localhost/login.php');

}
//auto_exit();
?>


<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
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
                <a class="nav-link "  href="entrant.php">Абитуриенту</a>
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
          </div>
        </div>
        <span class="navbar-brand">
            Профиль
          </span>

      </nav>

      <section style="background-color: #eee;">
        <div class="container py-5">
          <div class="row">
            <div class="col">
              <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="index.html">Главная</a></li>
                  <li class="breadcrumb-item"><a href="#">Личный кабинет</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Профиль</li>
                </ol>
              </nav>
            </div>
          </div>

          <div class="row">
            <h3>Профиль</h3>
            <div class="col-lg-8">
              <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="./uploads/ava6.webp" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                    <h5 class="my-3"> <span><?= @$_SESSION['user']['name'] ?> </span> <span><?= @$_SESSION['user']['surname'] ?> </span></h5>
                  <p class="text-muted mb-1">Абитуриент</p>
<!--                  <p class="text-muted mb-4"><span>--><?//= @$_SESSION['user']['email'] ?><!-- </span></p>-->
                </div>
              </div>
            </div>

            <h3>Личные данные</h3>
                <div class="col-lg-8">
                      <div class="card mb-4">
                        <div class="card-body ">
                            <form name="editEmailForm" method="post" onsubmit="return submitForm();" validate>
                                  <div class="row ">
                                    <div class="col-sm-3">
                                      <p class="mb-0">ФИО</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><span><?= @$_SESSION['user']['name'] ?> </span> <span><?php @$_SESSION['user']['surname'] ?> </span> <span><?= @$_SESSION['user']['patronymic'] ?> </span></p>
                                        <p style="display: none;" id="entrantId"><?php $_SESSION['user']['id_entrant'] ?></p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Почта</p>
                                    </div>

                                    <div class="col-sm-9 ">
                                            <p id="currentEmail" class="text-muted mb-0"><span><?= @$_SESSION['user']['email'] ?> </span></p>
                                            <br style="display: none" id ="current-new-email-spacing">
                                            <p id="ajaxResponse" class="text-muted mb-0"></p>
                                        <input style="visibility: hidden; position: absolute;" type="email" class="form-control" id="editEmailInput" aria-describedby="emailHelp" required>
                                        <div id="successEditEmail" style="display: none" class="alert alert-success" role="alert">
                                            Успешная смена почты!
                                        </div>
                                        <div id="failEditEmail" style="display: none" class="alert alert-danger" role="alert">
                                            Некорректный email адрес!
                                        </div>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Телефон</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0"><span><?= @$_SESSION['user']['phone'] ?> </span></p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Пол</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0"><span><? if (@$_SESSION['user']['sex'] == 'male'){ echo "Мужской";} else echo "Женский"; ?> </span></p>
                                    </div>
                                  </div>
                                    <div class="d-flex justify-content-end mb-2">
                                        <button style="visibility: hidden" id="cancel" class="mx-2 btn btn-secondary">Отмена</button>
                                        <button style="visibility: hidden" id="save" style="display: none" type="submit" class="btn btn-success">Готово</button>
                                        <button id="edit" class="btn btn-primary">Изменить</button>
                                    </div>
                            </form>
                    </div>
                  </div>
              <div class="row">
                <h3>Заявления</h3>
                  <div class="accordion" id="accordionExample">
                      <div class="accordion-item">
                          <h2 class="accordion-header" id="headingOne">
                              <button class="accordion-button collapsed" <?php if (isset($_SESSION['request_empty'])){
                                  echo 'disabled';}?> type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                 <?php show_request_num();?>
                              </button>
                          </h2>
                          <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                              <div class="accordion-body">
                                  <p>Данные к поступлению</p>
                                  <ul class="list-group list-group-flush">
                                      <?php show_requests();?>
                                  </ul>
                                  <div class="d-flex justify-content-end " role="group" aria-label="Button group">
                                      <div class="d-flex justify-content-end mb-2">
                                          <button id="dropRequest" type="button" style="margin-right: 10px;" class="btn btn-danger">Отозвать заявление</button>
                                      </div>
                                      <div class="d-flex justify-content-end mb-2">
                                          <button id="changeFaculty" type="button" style="margin-left: 10px; " class="btn btn-primary">Изменить факультет</button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </section>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    <script src="js/ajax-form.js"></script>
    <script src="js/script.js"></script>
</body>

</html>
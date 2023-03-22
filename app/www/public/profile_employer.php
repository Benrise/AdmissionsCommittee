<?php
session_start();
require_once("vendor/db_connect.php");
include("vendor/requests_fetching.php");

if (!isset($_SESSION['employer'])) {
    unset($_SESSION['user']);
    header('Location: http://localhost/login.php');

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
                    <h5 class="my-3"> <span><?= @$_SESSION['employer']['name'] ?> </span> <span><?= @$_SESSION['employer']['surname'] ?> </span></h5>
                  <p class="text-muted mb-1"> <span><?= @$_SESSION['employer']['role_name'] ?> </span></p>
                  <p class="text-muted mb-4"> <span><?= @$_SESSION['employer']['work_email'] ?> </span></p>
                </div>
              </div>
            </div>

            <h3>Личные данные</h3>
            <div class="col-lg-8">
              <div class="card mb-4">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">ФИО</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0"><span><?= @$_SESSION['employer']['name'] ?> </span> <span><?= @$_SESSION['employer']['surname'] ?> </span> <span><?= @$_SESSION['employer']['patronymic'] ?> </span></p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Почта</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0"><span><?= @$_SESSION['employer']['work_email'] ?> </span></p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Пол</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0"><span><? if (@$_SESSION['employer']['sex'] == 'male'){ echo "Мужской";} else echo "Женский"; ?> </span></p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <h3>Заявления на рассмотрение</h3>
                  <div class="accordion accordion-flush" id="accordionFlushExample">
                              <?php
                              fetch_employer_requests();
                              if (isset($_SESSION['employer_requests'])) {
                                  foreach (@$_SESSION['employer_requests'] as $request_num => $request) {
                                      echo '<div class="accordion-item">';
                                        echo '<h2 class="accordion-header" id="flush-heading'.$request_num.'">';
                                            echo '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse'.$request_num.'" aria-expanded="false" aria-controls="flush-collapse'.$request_num.'">';
                                      foreach ($request as $field => $value) {
                                          if ($field == 'id_request') {
                                              $num = $value;
                                              echo 'Заявление №'.$num;
                                              echo '</button>';
                                              break;
                                          }
                                      }
                                        echo '</h2>';
                                        echo '<div id="flush-collapse'.$request_num.'" class="accordion-collapse collapse" aria-labelledby="flush-heading'.$request_num.'" data-bs-parent="#accordionFlushExample">';
                                            echo '<div class="accordion-body">';
                                                echo '<ul class="list-group list-group-flush">';
                                              foreach ($request as $field => $value) {
                                                  switch ($field) {
                                                      case 'id_request':
                                                          break;
                                                      case 'date_of_submission':
                                                          echo "<li class=\"list-group-item\">"."<p>Дата подачи</p>".$value."</li>";
                                                          break;
                                                      case 'id_entrant':
                                                          echo "<li class=\"list-group-item\">"."<p>Код абитуриента</p>".$value."</li>";
                                                          break;
                                                      case 'id_faculty':
                                                          echo "<li class=\"list-group-item\">"."<p>Код факультета</p>".$value."</li>";
                                                          break;
                                                      case 'id_status':
                                                          echo "<li class=\"list-group-item\">"."<p>Код статуса</p>".$value."</li>";
                                                          break;
                                                      case 'id_employer':
                                                          echo "<li class=\"list-group-item border-bottom border-dark border-1\">"."<p>Код обслуживающего сотрудника</p>".$value."</li>";
                                                          break;
                                                      case 'date_of_submission':
                                                          echo "<li class=\"list-group-item \">"."<p>Дата подачи заявления</p>".$value."</li>";
                                                          break;
                                                      case 'entrant_name':
                                                          echo "<li class=\"list-group-item \">"."<p>Имя</p>".$value."</li>";
                                                          break;
                                                      case 'surname':
                                                          echo "<li class=\"list-group-item \">"."<p>Фамилия</p>".$value."</li>";
                                                          break;
                                                      case 'patronymic':
                                                          echo "<li class=\"list-group-item \">"."<p>Отчество</p>".$value."</li>";
                                                          break;
                                                      case 'birthday':
                                                          echo "<li class=\"list-group-item \">"."<p>Дата рождения</p>".$value."</li>";
                                                          break;
                                                      case 'sex':
                                                          echo "<li class=\"list-group-item \">"."<p>Пол</p>".$value."</li>";
                                                          break;
                                                      case 'edu_institution':
                                                          echo "<li class=\"list-group-item \">"."<p>Учебное заведение</p>".$value."</li>";
                                                          break;
                                                      case 'grad_date_edu_institution':
                                                          echo "<li class=\"list-group-item \">"."<p>Дата окончания учебного заведения</p>".$value."</li>";
                                                          break;
                                                      case 'has_gold_medal':
                                                          echo "<li class=\"list-group-item \">"."<p>Наличие золотой медали</p>".$value."</li>";
                                                          break;
                                                      case 'certificate_number':
                                                          echo "<li class=\"list-group-item \">"."<p>Номер аттестата</p>".$value."</li>";
                                                          break;
                                                      case 'phone':
                                                          echo "<li class=\"list-group-item \">"."<p>Номер телефона</p>".$value."</li>";
                                                          break;
                                                      case 'email':
                                                          echo "<li class=\"list-group-item \">"."<p>Электронная почта</p>".$value."</li>";
                                                          break;
                                                      case 'faculty_name':
                                                          echo "<li class=\"list-group-item \">"."<p>Выбранный факультет</p>".$value."</li>";
                                                          break;
                                                      case 'status_name':
                                                          echo "<li class=\"list-group-item \">"."<p>Статус</p>".$value."</li>";
                                                          break;
                                                      case 'comment':
                                                          echo "<li class=\"list-group-item \">"."<p>Комментарий</p>".$value."</li>";
                                                          break;

                                                  }
                                              }

                                              echo '<form style="margin-top: 10px;" class="input-group" name="idRequest" value ="'.$num.'" action="vendor/request_update.php" method="post" >
                                                      <span class="input-group-text ">Комментарий</span>
                                                      <textarea name="inputComment" class="form-control" aria-label="With textarea" required></textarea>
                                                      <input type="text" value="'.$num.'"  name="idRequest" class="form-control visually-hidden">
                                                      <select class="form-select" name="inputStatus" id="inputGroupSelect04" aria-label="Select with button addon" required>
                                                    <option selected disabled value="" >Установить статус...</option>
                                                    <option value="1">В обработке</option>
                                                    <option value="2">Получен ответ</option>
                                                    <option value="3">На рассторжении</option>
                                                    <option value="4">Отклонено</option>
                                                  </select>
                                                  <button class="btn btn-primary" type="submit">Готово</button>
                                                    </form>';
                                              echo '</ul>';
                                            echo '</div>';
                                        echo '</div>';
                                      echo '</div>';
                                  }
                              }
                              ?>
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </section>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>

</html>

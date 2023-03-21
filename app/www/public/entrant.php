<?php
session_start();
require_once("vendor/db_connect.php");
include("vendor/faculties_fetching.php");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
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
                <a class="nav-link active" aria-current="page" href="#">Абитуриенту</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Личный кабинет
                </a>
                  <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="login.php">
                              <?php if (isset($_SESSION["user"])){
                                  echo "<a class=\"dropdown-item\" href=\"profile.php\">Профиль</a>";
                              }
                              else{
                                  echo "<a class=\"dropdown-item\" href=\"login.php\">Войти</a>";
                              }?></a></li>

                      <li><a class="dropdown-item" href="register.php">
                              <?php if (isset($_SESSION["user"])){
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
      </nav>

      <div class="container">
        <div class="col g-3">
          <div class="col-auto">
            <h1  style="padding-top: 20px;"> Факультеты</h1>
              <div class="container ">
                  <div class="row" >
                      <?php
                      show_faculties();
                      ?>
                  </div>
              </div>
          </div>

          <div class="col-auto">
            <h1  style="padding-top: 20px;"> Подать заявление</h1>


            <p>Поменять факультет или внести другие изменения в отправленное заявление можно в <a href="#">личном кабинете абитуриента.</a></p>
            
            <p>Если у Вас возникли трудности при работе с Информационной системой "Абитуриент-студент", обращайтесь: <a href="">orginfo@mephi.ru</a></p>



            <p> Заполните необходимые данные и подайте заявление на интересующий факультет:</p>

            <p></p>

            <form class="row g-4 needs-validation" action="vendor/new_request.php" method="post" novalidate>
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
                      <input type="date" class="form-control"name="inputBirthday" id="inputBirthday" required>
                      <div class="invalid-feedback">
                      </div>
                    </div>
                  </div>
                </div>


                <div class="col-mb-4">
                  <label for="inputSex" class="form-label">Пол</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="inputSex" id="inputSexMale" value="male" required>
                    <label class="form-check-label" for="inputSexMale">
                      Мужской
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="inputSex" value="female" id="inputSexFemale" >
                    <label class="form-check-label" for="inputSexFemale">
                      Женский
                    </label>
                  </div>
                </div>

                <p></p>
                <div class="mb-3">
                  <label for="passport" class="form-label">Паспортные данные</label>
                  <div class="input-group">
                    <input type="number" class="form-control" name="inputPassportNum" placeholder="Номер паспорта" aria-label="Passport num">
                    <input type="number" class="form-control" name="inputPassportSerial" placeholder="Серия паспорта" aria-label="Passport serial">
                  </div>
                  <div class="input-group">
                    <span class="input-group-text">Кем выдан</span>
                    <textarea class="form-control" name="inputGivenOutByWhom" aria-label="With textarea"></textarea>
                  </div>
                  <div class="input-group ">
                    <span class="input-group-text">Когда выдан</span>
                    <input type="date" class="form-control" name="inputWhenGivenOut" aria-label="With textarea"></input>
                  </div>
                </div>
                
                <p></p>

                <div class="mb-3">
                  <label for="eduInstitution" class="form-label">Учебное заведение</label>
                  <textarea class="form-control" name="eduInstitution" id="eduInstitution" rows="2"  required></textarea>
                </div>

                <div class="mb-3">
                  <div class="col-auto">
                    <label for="inputGradDateEduInstitution" class="form-label">Дата окончания учебного заведения</label>
                    <div class="input-group has-validation">
                      <input type="date" class="form-control" name="inputGradDateEduInstitution" id="inputGradDateEduInstitution" required>
                      <div class="invalid-feedback">
                      </div>
                    </div>
                  </div>
                </div>

                

                <div class="mb-3">
                  <label for="certificateNumber" class="form-label">Номер аттестата</label>
                  <div class="input-group has-validation">
                    <input type="number" class="form-control" name="certificateNumber" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        Некорректные данные!
                    </div>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" name="hasGoldMedal" id="hasGoldMedal" >
                    <label class="form-check-label" for="hasGoldMedal">
                      Наличие золотой медали
                    </label>
                  </div>
                </div>

                <div class="mb-3">
                  <label for="inputFaculty" class="form-label">Факультет</label>
                  <select class="form-select" name="inputFaculty" id='inputFaculty'>
                    <option selected>Выберете факультет</option>
                    <option value="1">ИНСТИТУТ ЯДЕРНОЙ ФИЗИКИ И ТЕХНОЛОГИЙ</option>
                    <option value="2">ИНСТИТУТ ЛАЗЕРНЫХ И ПЛАЗМЕННЫХ ТЕХНОЛОГИЙ</option>
                    <option value="3">ИНЖЕНЕРНО-ФИЗИЧЕСКИЙ ИНСТИТУТ БИОМЕДИЦИНЫ</option>
                  </select>
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

                <div class="col-md-6">
                  <label for="inputPhone" class="form-label">Телефон</label>
                  <div class="input-group has-validation">
                    <input type="number" class="form-control" name="inputPhone" id="inputPhone" placeholder="В формате +7 800 555 65 65" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        Некорректные данные!
                    </div>
                  </div>
                </div>

                


                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                      <label for="registerInputPassword" class="form-label">Пароль</label>
                      <div class="input-group has-validation">
                        <input type="password" name="registerInputPassword" class="form-control" id="registerInputPassword" required >
                        <div class="invalid-feedback">
                          Некорректные данные!
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <label for="registerInputPasswordConfirm" class="form-label">Подтверждение пароля</label>
                      <div class="input-group has-validation">
                        <input type="password" name="registerInputPasswordConfirm" class="form-control" id="registerInputPasswordConfirm" required>
                        <div class="invalid-feedback">
                          Некорректные данные!
                        </div>
                      </div>
                    </div>
                </div>
                
                
              
                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="termsCheck" required>
                    <label class="form-check-label" for="termsCheck">
                    Я согласен на обработку моих персональных данных
                    </label>
                    <div class="invalid-feedback">
                    </div>
                  </div>
                </div>

                <div class="col-12">
                  <button class="btn btn-primary" type="submit">Готово</button>
                </div>

                <p></p>
            </form>
              <?php
              if (isset($_SESSION['message'])) {
                  echo '<p class="msg" style="color: red;"> ' . $_SESSION['message'] . ' </p>';
              }
              unset($_SESSION['message']);

              ?>

          </div>
      
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
  
</html> 
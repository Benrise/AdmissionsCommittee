<?php

session_start();
require_once 'db_connect.php';

$name = $_POST['inputName'];
$surname = $_POST['inputSurname'];
$patronymic = $_POST['inputPatronymic'];
$birthday = $_POST['inputBirthday'];
$email = $_POST['inputMail'];
$password = $_POST['registerInputPassword'];
$password_confirm = $_POST['registerInputPasswordConfirm'];

if ($password === $password_confirm) {

//    $password = md5($password);

    $mail_check = mysqli_query($connect, "SELECT * FROM `entrants` WHERE email = '$email'");
    if (mysqli_num_rows($mail_check) > 0) {
        $_SESSION['message'] = 'Пользователь с такой почтой уже зарегестрирован!';
        header('Location: register.php');
    }


    mysqli_query($connect, "INSERT INTO `entrants` (id_entrant, name, surname, patronymic, birthday, email, password) 
                                    VALUES (NULL, '$name', '$surname','$patronymic', '$birthday','$email','$password')");

    $_SESSION['message'] = 'Регистрация прошла успешно!';
    header('Location: ../profile.php');


} else {
    $_SESSION['message'] = 'Пароли не совпадают';
    header('Location: ../register.php');
}
?>
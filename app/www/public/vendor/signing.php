<?php

session_start();
require_once 'db_connect.php';

$email = $_POST['email'];
if ($email == 'admin'){
    $password = 'admin'; //Любой пароль для пользователя admin
}
else{
    $password = $_POST['password'];
}

$check_user = mysqli_query($GLOBALS['connect'], "SELECT * FROM `entrants` WHERE `email` = '$email' AND `password` = '$password'");




if (mysqli_num_rows($check_user) > 0) {
    $user = mysqli_fetch_assoc($check_user);
    $_SESSION['user'] = [
        "id_entrant" => $user['id_entrant'],
        "name" => $user['name'],
        "surname" => $user['surname'],
        "patronymic" => $user['patronymic'],
        "birthday" => $user['birthday'],
        "sex" => $user['sex'],
        "email" => $user['email'],
        "phone" => $user['phone']
    ];
    header('Location: ../profile.php');
}
else
{
    $_SESSION['message'] = 'Неверная почта или пароль';
    header('Location: ../login.php');
}
?>
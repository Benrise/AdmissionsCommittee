<?php
require_once 'db_connect.php';

$inputName = $_POST['inputName'];
$inputSurname = $_POST['inputSurname'];
$inputPatronymic = $_POST['inputPatronymic'];
$inputBirthday = $_POST['inputBirthday'];
$inputSex = $_POST['inputSex'];
$inputPassportNum = intval($_POST['inputPassportNum']);
$inputPassportSerial = intval($_POST['inputPassportSerial']);
$inputGivenOutByWhom = $_POST['inputGivenOutByWhom'];
$inputWhenGivenOut = $_POST['inputWhenGivenOut'];
$eduInstitution = $_POST['eduInstitution'];
$inputGradDateEduInstitution = $_POST['inputGradDateEduInstitution'];
$certificateNumber = intval($_POST['certificateNumber']);
@$hasGoldMedal = $_POST['hasGoldMedal'];
$inputFaculty = $_POST['inputFaculty'];
$inputMail = $_POST['inputMail'];
$inputPhone = intval($_POST['inputPhone']);
$registerInputPassword = $_POST['registerInputPassword'];
$registerInputPasswordConfirm  = $_POST['registerInputPasswordConfirm'];

if (!$hasGoldMedal){
    $hasGoldMedal = 0;
}
else{
    $hasGoldMedal = 1;
}



// ==============================Смена факультета====================


//$sql_query_mail_check = "SELECT e.id_entrant
//                    FROM Entrants e
//                    JOIN Requests r ON e.id_entrant = r.id_entrant
//                    WHERE e.email = '$inputMail'";
//$check_user = mysqli_query($GLOBALS['connect'], $sql_query_mail_check);
//$user = mysqli_fetch_assoc($check_user);

//if (mysqli_num_rows($check_user) > 0) {
//    $id_entrant = $user['id_entrant'];
//    $date = date('d.m.Y');
//    $sql_query_insert = "INSERT INTO Requests VALUES (NULL, '$date', $id_entrant, $inputFaculty, 1, 2)";
//    mysqli_query($GLOBALS['connect'], $sql_query_insert);
//}
// ===================================================================


if ($registerInputPassword === $registerInputPasswordConfirm) {

//    $password = md5($password);

    $mail_check = mysqli_query($connect, "SELECT * FROM `entrants` WHERE email = '$inputMail'");
    if (mysqli_num_rows($mail_check) > 0) {
        $_SESSION['message'] = 'Пользователь с такой почтой уже зарегестрирован!';
        header('Location: ../entrant.php');
    }


    mysqli_query($connect, "INSERT INTO `entrants` VALUES (NULL, '$inputName', 
                               '$inputSurname',
                               '$inputPatronymic', 
                               '$inputBirthday',
                               '$inputSex', 
                               '$eduInstitution', 
                               '$inputGradDateEduInstitution', 
                               '$hasGoldMedal',
                               '$certificateNumber',
                               '$inputMail', 
                               '$inputPhone',
                               '$registerInputPassword')");

    $mail_check = mysqli_query($connect, "SELECT id_entrant FROM entrants WHERE email = '$inputMail'");
    $id_entrant = mysqli_fetch_assoc($mail_check);
    $id_entrant = $id_entrant['id_entrant'];

    mysqli_query($connect, "INSERT INTO Passports VALUES (NULL, 
                              '$inputGivenOutByWhom', 
                              '$inputWhenGivenOut', 
                              '$inputPassportNum', 
                              '$inputPassportSerial', 
                              '$id_entrant')");


    $date = date('d.m.Y');
    $sql_query_insert = "INSERT INTO Requests VALUES (NULL, '$date',NULL, $id_entrant, $inputFaculty, 1, 2)";
    mysqli_query($GLOBALS['connect'], $sql_query_insert);

    $_SESSION['message'] = 'Регистрация прошла успешно! Статус заявления можете посмотреть в личном кабинете! ';
    die();
    header('Location: ../entrant.php');


}
else {
    $_SESSION['message'] = 'Пароли не совпадают';
    header('Location: ../entrant.php');
}


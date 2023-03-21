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

$sql_query_check = "SELECT id_entrant, NULL AS id_employer
                    FROM Entrants
                    WHERE email = '$email' AND password = '$password'
                    UNION
                    SELECT NULL AS id_entrant, id_employer
                    FROM Employer
                    WHERE work_email = '$email' AND password = '$password'";

$check_user = mysqli_query($GLOBALS['connect'], $sql_query_check);






if (mysqli_num_rows($check_user) > 0) {
    $user = mysqli_fetch_assoc($check_user);
    if ($user['id_employer']){
        $id_employer = $user['id_employer'];
        $query = mysqli_query($GLOBALS['connect'], "SELECT e.*, r.name AS role_name
FROM Employer e
JOIN Role r ON e.id_role = r.id_role
WHERE e.id_employer = '$id_employer';");
        $user = mysqli_fetch_assoc($query);
        $_SESSION['employer'] = [
            "id_employer" => $user['id_employer'],
            "role_name" => $user['role_name'],
            "name" => $user['name'],
            "surname" => $user['surname'],
            "patronymic" => $user['patronymic'],
            "work_email" => $user['work_email']
        ];
        header('Location: ../profile_employer.php');
    }
    else if ($user['id_entrant']) {
        $id_entrant = $user['id_entrant'];
        $query = mysqli_query($GLOBALS['connect'], "SELECT * FROM `entrants` WHERE id_entrant = '$id_entrant'");
        $user = mysqli_fetch_assoc($query);
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
}
else
{
    $_SESSION['message'] = 'Неверная почта или пароль';
    header('Location: ../login.php');
}
?>
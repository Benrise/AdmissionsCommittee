<?php

function show_requests()
{
    $id_entrant = $_SESSION['user']['id_entrant'];
    $requests_check = mysqli_query($GLOBALS['connect'], "SELECT * FROM Requests WHERE id_entrant='$id_entrant'");
    $join_query = mysqli_query($GLOBALS['connect'],
        "SELECT r.id_request, 
                r.date_of_submission, 
                e.name as entrant_name,
                e.surname,
                e.patronymic,
                e.birthday,
                e.sex,
                e.edu_institution,
                e.grad_date_edu_institution,
                e.has_gold_medal,
                e.certificate_number,
                e.email, 
                e.phone, 
                f.name as faculty_name, 
                s.status_name
                FROM Requests r
                JOIN Entrants e ON r.id_entrant = e.id_entrant
                JOIN Faculties f ON r.id_faculty = f.id_faculty
                JOIN Status s ON r.id_status = s.id_status WHERE r.id_entrant=$id_entrant;");


    if (mysqli_num_rows($requests_check) <= 0) {
        $_SESSION['request_empty'] = "Активных заявлений не обнаружено";
    }
    else if (mysqli_num_rows($requests_check) > 0) {
        while ($request = mysqli_fetch_assoc($join_query)) {
            $_SESSION['id_request'] = $request['id_request'];
            echo "<li class=\"list-group-item\">"."<p>Дата подачи заявления</p>".$request['date_of_submission']."</li>";
            echo "<li class=\"list-group-item\">"."<p>Имя</p>".$request['entrant_name']."</li>";
            echo "<li class=\"list-group-item\">"."<p>Фамилия</p>".$request['surname']."</li>";
            echo "<li class=\"list-group-item\">"."<p>Отчество</p>".$request['patronymic']."</li>";
            echo "<li class=\"list-group-item\">"."<p>Дата рождения</p>".$request['birthday']."</li>";
            echo "<li class=\"list-group-item\">"."<p>Пол</p>".$request['sex']."</li>";
            echo "<li class=\"list-group-item\">"."<p>Учебное заведение</p>".$request['edu_institution']."</li>";
            echo "<li class=\"list-group-item\">"."<p>Дата окончания учебного заведения</p>".$request['grad_date_edu_institution']."</li>";
            if ($request['has_gold_medal']){
                echo "<li class=\"list-group-item\">"."<p>Наличие золотой медали</p>Да</li>";
            }
            else{
                echo "<li class=\"list-group-item\">"."<p>Наличие золотой медали</p>Нет</li>";
            }
            echo "<li class=\"list-group-item\">"."<p>Номер аттестата</p>".$request['certificate_number']."</li>";
            echo "<li class=\"list-group-item\">"."<p>Электронная почта</p>".$request['email']."</li>";
            echo "<li class=\"list-group-item\">"."<p>Номер телефона</p>".$request['phone']."</li>";
            echo "<li class=\"list-group-item\">"."<p>Желаемый факультет</p>".$request['faculty_name']."</li>";
            echo "<li class=\"list-group-item\">"."<p>Статус заявления</p>".$request['status_name']."</li>";
//            foreach ($request as $field => $value){
//                echo "<li class=\"list-group-item\">".$value."</li>";
//            }
        }
    }
    else{
        echo "Ошибка. Не удалось выгрузить заявления с базы данных.";
    }

}

function show_request_num(){
    if (isset($_SESSION['request_empty'])) {
        echo @$_SESSION['request_empty'];
    } else {
        echo "Заявление №";
        echo @$_SESSION['id_request'];
    }
}


function fetch_employer_requests(){
    $id_employer = $_SESSION['employer']['id_employer'];
    if (isset($_SESSION['employer_requests'])) unset($_SESSION['employer_requests']);

    $join_query = "SELECT r.id_request, 
    r.date_of_submission, 
    r.comment, 
    e.name as employer_name, 
    e.id_employer,
    f.name as faculty_name,
    f.id_faculty,
    s.status_name,
    s.id_status,
    en.*
    FROM Requests r
    JOIN Employer e ON r.id_employer = e.id_employer
    JOIN Faculties f ON r.id_faculty = f.id_faculty
    JOIN Status s ON r.id_status = s.id_status
    JOIN Entrants en ON r.id_entrant = en.id_entrant
    WHERE e.id_employer = 1;";

//    $request_query = "SELECT * FROM requests where id_employer='$id_employer';";
    $check_user = mysqli_query($GLOBALS['connect'], $join_query);
    if (mysqli_num_rows($check_user) > 0) {
        while ($user = $check_user->fetch_assoc()) {
            $_SESSION['employer_requests'][] = [
                "id_request" => $user['id_request'],
                "date_of_submission" => $user['date_of_submission'],
                "id_faculty" => $user['id_faculty'],
                "id_status" => $user['id_status'],
                "id_entrant" => $user['id_entrant'],
                "id_employer" => $user['id_employer'],
                'date_of_submission' => $user['date_of_submission'],
                'name' => $user['name'],
                'surname' => $user['surname'],
                'patronymic' => $user['patronymic'],
                'birthday' => $user['birthday'],
                'sex' => $user['sex'],
                'edu_institution' => $user['edu_institution'],
                'grad_date_edu_institution' => $user['grad_date_edu_institution'],
                'has_gold_medal' => $user['has_gold_medal'],
                'certificate_number' => $user['certificate_number'],
                'email' => $user['email'],
                'phone' => $user['phone'],
                'faculty_name' => $user['faculty_name'],
                'status_name' => $user['status_name'],
                'comment' => $user['comment']

            ];
        }
    }
}
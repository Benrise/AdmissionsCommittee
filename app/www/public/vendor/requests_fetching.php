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
                JOIN Status s ON r.id_status = s.id_status WHERE r.id_entrant=1;");


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


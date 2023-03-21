<?php

function show_faculties(){
    $faculties_check = mysqli_query($GLOBALS['connect'], "SELECT * FROM `faculties`");
    if (mysqli_num_rows($faculties_check) > 0) {
        while ($faculty = mysqli_fetch_assoc($faculties_check)) {
            echo "<div class=\"card\" style=\"width: 300px; margin: 20px 20px 0px 0px;\">";
                echo "<img src=\"...\" class=\"card-img-top\" alt=\"...\">";
                echo "<div class=\"d-flex flex-column justify-content-between card-body\">";
                    echo "<h5 class=\"card-title\">".$faculty['name']."</h5>";
                    echo "<p class=\"card-text\">".$faculty['description'] ."</p>";
                    echo "<a href=\"#\" class=\"btn btn-primary\">Подробнее</a>";
                echo "</div>";
            echo "</div>";
        }
    }
    else if (mysqli_num_rows($faculties_check) <= 0) {
        echo "Факультетов не обнаружено";
    }
    else{
        echo "Ошибка. Не удалось выгрузить факультеты с базы данных.";
    }
}

?>


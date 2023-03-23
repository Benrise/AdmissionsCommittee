<?php
session_start();
require_once 'db_connect.php';
if (isset($_POST["newEmail"]) && isset($_SESSION["user"]['id_entrant'])) {
    $new_email = $_POST['newEmail'];
    $id_entrant = $_SESSION['user']['id_entrant'];
    $sql_query = "UPDATE Entrants SET email='$new_email' WHERE id_entrant=$id_entrant";

    if (mysqli_query($GLOBALS['connect'], $sql_query)) {
        $response["status"] = "success";
        $response["message"] = "Email successfully updated!";
        $_SESSION['user']['email'] = $new_email;
    } else {
        $response["status"] = "error";
        $response["message"] = "Error updating email: " . mysqli_error($GLOBALS['connect']);
    }

    echo json_encode($response);
}


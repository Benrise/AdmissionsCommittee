<?php
require_once 'db_connect.php';
$inputComment = $_POST['inputComment'];
$idRequest = $_POST['idRequest'];
$inputStatus = $_POST['inputStatus'];
$query_update = "UPDATE Requests SET comment = '$inputComment', id_status = '$inputStatus' WHERE id_request = '$idRequest';";

mysqli_query($GLOBALS['connect'], $query_update);

header('Location: ../profile_employer.php');


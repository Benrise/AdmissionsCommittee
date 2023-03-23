<?php
require_once 'db_connect.php';
$idFaculty = $_POST['inputFaculty'];
$idRequest = $_POST['idRequest'];
$inputComment = $_POST['inputComment'];
$query_update = "UPDATE Requests SET id_faculty = '$idFaculty', id_status = 1, comment='$inputComment' WHERE id_request = '$idRequest';";

mysqli_query($GLOBALS['connect'], $query_update);

header('Location: ../profile.php');

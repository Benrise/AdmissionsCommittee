<?php
$connect = mysqli_connect('database', 'root', 'tiger', 'AdmissionsCommittee');

if (!$connect) {
    die('Error connect to DataBase, connection may in progress!');
}


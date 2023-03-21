<?php
require_once("db_connect.php");
session_start();
unset($_SESSION['user']);
unset($_SESSION['id_request']);
unset($_SESSION['request_empty']);
session_destroy();
header('Location: ../login.php');
<?php

session_start();
if(isset($_SESSION) && isset($_SESSION['userID'])) {
    require_once 'connections/sql.php';
    require_once 'db/master-list.php';
    $userID = $_SESSION['userID'];
    $USER = db_getUserProfile($userID);
} else {
    $USER = null;
}

if (SECURE && $USER == null) {
    header('Location: login.php');
}

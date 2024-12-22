<?php
include "connection.php";
session_start();
    unset($_SESSION['id_Login']);
    unset($_SESSION['role']);
    session_destroy();
    header("Location: login.php");
    exit();
?>
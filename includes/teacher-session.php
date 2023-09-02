<?php ob_start(); ?>

<?php session_start(); ?>

<?php

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'teacher') {
    header("Location: ../login.php");
}

?>
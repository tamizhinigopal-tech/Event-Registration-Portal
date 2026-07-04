<?php
session_start();

if (!isset($_SESSION['student'])) {
    header("Location: ../login.html");
    exit();
}
?>
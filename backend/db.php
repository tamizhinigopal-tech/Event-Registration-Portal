<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "event_registration";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>
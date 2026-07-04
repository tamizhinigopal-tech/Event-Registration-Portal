<?php
session_start();

include "db.php";

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM students WHERE email='$email' AND password='$password'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $student = $result->fetch_assoc();

    $_SESSION['id'] = $student['id'];
    $_SESSION['student'] = $student['full_name'];
    $_SESSION['email'] = $student['email'];
    $_SESSION['department'] = $student['department'];
    $_SESSION['year'] = $student['year'];

    header("Location: ../dashboard.php");
    exit();

} else {

    echo "<script>
        alert('Invalid Email or Password');
        window.location='../login.html';
    </script>";

}

$conn->close();
?>
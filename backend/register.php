<?php

include "db.php";

// Get form data
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$department = $_POST['department'];
$year = $_POST['year'];

// Insert into database
$sql = "INSERT INTO students (full_name, email, password, department, year)
VALUES ('$full_name', '$email', '$password', '$department', '$year')";

if ($conn->query($sql) === TRUE) {

    echo "<h2>Registration Successful!</h2>";
    echo "<a href='../login.html'>Go to Login</a>";

} else {

    echo "Error: " . $conn->error;

}

$conn->close();

?>
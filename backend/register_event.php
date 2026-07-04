<?php
session_start();

include "db.php";

// Check if student is logged in
if (!isset($_SESSION['id'])) {
    header("Location: ../login.html");
    exit();
}

$student_id = $_SESSION['id'];

if (!isset($_GET['event_id'])) {
    die("Invalid Event.");
}

$event_id = $_GET['event_id'];

// Check if already registered
$check = "SELECT * FROM registrations
          WHERE student_id='$student_id'
          AND event_id='$event_id'";

$result = mysqli_query($conn, $check);

if (mysqli_num_rows($result) > 0) {

    echo "<script>
            alert('You have already registered for this event.');
            window.location='../events.html';
          </script>";
    exit();

}

// Register student
$sql = "INSERT INTO registrations(student_id, event_id)
        VALUES('$student_id','$event_id')";

if (mysqli_query($conn, $sql)) {

    echo "<script>
            alert('Event Registration Successful!');
            window.location='../dashboard.php';
          </script>";

} else {

    echo "Registration Failed.";

}

mysqli_close($conn);
?>
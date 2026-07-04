<?php
include "backend/session.php";
include "backend/db.php";

$student_id = $_SESSION['id'];

$sql = "SELECT events.event_name
        FROM registrations
        INNER JOIN events
        ON registrations.event_id = events.id
        WHERE registrations.student_id = '$student_id'
        LIMIT 1";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $registeredEvent = $row['event_name'];
}else{
    $registeredEvent = "Not Registered Yet";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Student Dashboard | College Event Registration Portal</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<!-- Navigation -->

<nav>

<h2>🎓 College Event Portal</h2>

<ul>

<li><a href="index.html">🏠 Home</a></li>

<li><a href="events.html">📅 Events</a></li>

<li><a href="dashboard.php">👤 Dashboard</a></li>

<li><a href="backend/logout.php">🚪 Logout</a></li>

</ul>

</nav>

<section>

<h2>Student Dashboard</h2>

<div class="dashboard-card">

<h3>👋 Welcome, <?php echo $_SESSION['student']; ?></h3>

<hr style="margin:20px 0;">

<p>🆔 <strong>Student ID :</strong> <?php echo $_SESSION['id']; ?></p>

<p>👤 <strong>Student Name :</strong> <?php echo $_SESSION['student']; ?></p>

<p>📧 <strong>Email :</strong> <?php echo $_SESSION['email']; ?></p>

<p>🏫 <strong>Department :</strong> <?php echo strtoupper($_SESSION['department']); ?></p>

<p>🎓 <strong>Year :</strong> <?php echo $_SESSION['year']; ?></p>

<p>🎯 <strong>Registered Event :</strong> <?php echo $registeredEvent; ?></p>

<p>
🟢 <strong>Status :</strong>
<span style="color:green;font-weight:bold;">
Active
</span>
</p>

<hr style="margin:25px 0;">

<a href="download_slip.php">

<button id="downloadBtn">

📄 Download Registration Slip

</button>

</a>

</div>

</section>

<footer>

<p>

© 2026 College Event Registration Portal | All Rights Reserved

</p>

</footer>

</body>

</html>
<?php
include "backend/db.php";

// Total Students
$studentCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM students"));

// Total Events
$eventCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM events"));

// Total Registrations
$registrationCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM registrations"));

// Registered Students
$sql = "SELECT
students.full_name,
students.email,
events.event_name
FROM registrations
JOIN students
ON registrations.student_id = students.id
JOIN events
ON registrations.event_id = events.id";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Administrator Dashboard</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<!-- Navigation -->

<nav>

<h2>🎓 Administrator Panel</h2>

<ul>

<li><a href="index.html">🏠 Home</a></li>

<li><a href="events.html">📅 Events</a></li>

<li><a href="dashboard.php">👤 Student Dashboard</a></li>

<li><a href="backend/logout.php">🚪 Logout</a></li>

</ul>

</nav>

<!-- Dashboard -->

<section>

<h2>Administrator Dashboard</h2>

<p style="font-size:18px;color:#555;margin-bottom:35px;">
Monitor student registrations and event statistics.
</p>

<div class="event-container">

<div class="card">

<h3>👨‍🎓 Total Students</h3>

<h1 style="color:#2563eb;">
<?php echo $studentCount; ?>
</h1>

</div>

<div class="card">

<h3>🎯 Total Events</h3>

<h1 style="color:#16a34a;">
<?php echo $eventCount; ?>
</h1>

</div>

<div class="card">

<h3>📝 Total Registrations</h3>

<h1 style="color:#dc2626;">
<?php echo $registrationCount; ?>
</h1>

</div>

</div>

</section>

<!-- Registered Students -->

<section>

<h2>Registered Students</h2>

<table>

<thead>

<tr>

<th>Student Name</th>

<th>Email</th>

<th>Registered Event</th>

<th>Status</th>

</tr>

</thead>

<tbody>

<?php

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td><?php echo $row['full_name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['event_name']; ?></td>

<td style="color:green;font-weight:bold;">
✔ Registered
</td>

</tr>

<?php

}

?>

</tbody>

</table>

</section>

<footer>

<p>

© 2026 College Event Registration Portal | All Rights Reserved

</p>

</footer>

</body>

</html>
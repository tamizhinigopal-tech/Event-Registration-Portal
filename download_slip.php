<?php
include "backend/session.php";
include "backend/db.php";

$student_id = $_SESSION['id'];

$sql = "SELECT
            registrations.id AS registration_id,
            students.full_name,
            students.email,
            students.department,
            students.year,
            events.event_name,
            events.event_date,
            events.venue,
            registrations.registered_at
        FROM registrations
        JOIN students
            ON registrations.student_id = students.id
        JOIN events
            ON registrations.event_id = events.id
        WHERE registrations.student_id = '$student_id'
        LIMIT 1";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 0){
    die("No registration found.");
}

$row = mysqli_fetch_assoc($result);

$registrationID = "REG-" . str_pad($row['registration_id'], 4, "0", STR_PAD_LEFT);

$eventDate = date("d F Y", strtotime($row['event_date']));
$registeredDate = date("d F Y, h:i A", strtotime($row['registered_at']));
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Registration Slip</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<section>

<div class="slip">

<h1>VSB Engineering College, Karur</h1>

<h2>College Event Registration Portal</h2>

<h3 style="text-align:center;color:#2563eb;margin-top:10px;">
Official Registration Slip
</h3>

<hr style="margin:20px 0;">

<table>

<tr>
<td><strong>Registration ID</strong></td>
<td><?php echo $registrationID; ?></td>
</tr>

<tr>
<td><strong>Student Name</strong></td>
<td><?php echo $row['full_name']; ?></td>
</tr>

<tr>
<td><strong>Email</strong></td>
<td><?php echo $row['email']; ?></td>
</tr>

<tr>
<td><strong>Department</strong></td>
<td><?php echo strtoupper($row['department']); ?></td>
</tr>

<tr>
<td><strong>Year</strong></td>
<td><?php echo $row['year']; ?></td>
</tr>

<tr>
<td><strong>Registered Event</strong></td>
<td><?php echo $row['event_name']; ?></td>
</tr>

<tr>
<td><strong>Event Date</strong></td>
<td><?php echo $eventDate; ?></td>
</tr>

<tr>
<td><strong>Venue</strong></td>
<td><?php echo $row['venue']; ?></td>
</tr>

<tr>
<td><strong>Registration Date</strong></td>
<td><?php echo $registeredDate; ?></td>
</tr>

<tr>
<td><strong>Status</strong></td>
<td style="color:green;font-weight:bold;">
✔ REGISTERED
</td>
</tr>

</table>

<button class="print-btn" onclick="window.print()">
🖨 Print / Save as PDF
</button>

<br>

<a href="dashboard.php">
<button class="print-btn" style="background:#0d3b66;">
⬅ Back to Dashboard
</button>
</a>

</div>

</section>

</body>

</html>
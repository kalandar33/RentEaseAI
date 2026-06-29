<?php

include("db.php");

// Total Vehicles
$vehicles=mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS total FROM vehicles"));

// Total Users
$users=mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS total FROM users"));

// Total Bookings
$bookings=mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS total FROM bookings"));

// Total Revenue
$revenue=mysqli_fetch_assoc(mysqli_query($conn,
"SELECT SUM(total_price) AS total FROM bookings"));

if($revenue['total']=="")
{
    $revenue['total']=0;
}

// Available Vehicles
$available=mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS total FROM vehicles
WHERE availability='Available'"));

// Booked Vehicles
$booked=mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS total FROM vehicles
WHERE availability='Booked'"));

// Pending Bookings
$pending=mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS total FROM bookings
WHERE status='Pending'"));

// Completed Bookings
$completed=mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS total FROM bookings
WHERE status='Completed'"));

?>
<!DOCTYPE html>

<html>

<head>

<title>Reports</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{

background:linear-gradient(135deg,#eef2ff,#dbeafe,#f8fafc);

}

.card{

border:none;

border-radius:20px;

box-shadow:0 12px 30px rgba(0,0,0,.12);

transition:.3s;

}

.card:hover{

transform:translateY(-5px);

}

.card i{

font-size:35px;

margin-bottom:10px;

}

</style>

</head>

<body>

<div class="container py-5">

<h2 class="text-center mb-5">

📊 RentEase AI Reports Dashboard

</h2>

<div class="row g-4">

<div class="col-md-3">

<div class="card text-center p-4">

<i class="bi bi-car-front-fill text-primary"></i>

<h5>Total Vehicles</h5>

<h2><?php echo $vehicles['total']; ?></h2>

</div>

</div>

<div class="col-md-3">

<div class="card text-center p-4">

<i class="bi bi-people-fill text-success"></i>

<h5>Total Users</h5>

<h2><?php echo $users['total']; ?></h2>

</div>

</div>

<div class="col-md-3">

<div class="card text-center p-4">

<i class="bi bi-calendar-check-fill text-warning"></i>

<h5>Total Bookings</h5>

<h2><?php echo $bookings['total']; ?></h2>

</div>

</div>

<div class="col-md-3">

<div class="card text-center p-4">

<i class="bi bi-currency-rupee text-danger"></i>

<h5>Total Revenue</h5>

<h2>₹<?php echo $revenue['total']; ?></h2>

</div>

</div>

<div class="col-md-3">

<div class="card text-center p-4">

<i class="bi bi-check-circle-fill text-success"></i>

<h5>Available Vehicles</h5>

<h2><?php echo $available['total']; ?></h2>

</div>

</div>

<div class="col-md-3">

<div class="card text-center p-4">

<i class="bi bi-x-circle-fill text-danger"></i>

<h5>Booked Vehicles</h5>

<h2><?php echo $booked['total']; ?></h2>

</div>

</div>

<div class="col-md-3">

<div class="card text-center p-4">

<i class="bi bi-hourglass-split text-warning"></i>

<h5>Pending</h5>

<h2><?php echo $pending['total']; ?></h2>

</div>

</div>

<div class="col-md-3">

<div class="card text-center p-4">

<i class="bi bi-trophy-fill text-primary"></i>

<h5>Completed</h5>

<h2><?php echo $completed['total']; ?></h2>

</div>

</div>

</div>

<?php

$top=mysqli_query($conn,"
SELECT vehicles.vehicle_name,
COUNT(bookings.id) AS total
FROM bookings
INNER JOIN vehicles
ON bookings.vehicle_id=vehicles.id
GROUP BY vehicle_id
ORDER BY total DESC
LIMIT 1
");

$topVehicle=mysqli_fetch_assoc($top);

?>

<div class="card mt-5 p-4">

<h3 class="mb-3">

🏆 Most Booked Vehicle

</h3>

<?php

if($topVehicle)
{

?>

<h4 class="text-success">

<?php echo $topVehicle['vehicle_name']; ?>

</h4>

<p>

Total Bookings:

<b>

<?php echo $topVehicle['total']; ?>

</b>

</p>

<?php

}
else
{

echo "<p>No bookings found.</p>";

}

?>

</div>

<div class="text-center mt-4">

<a

href="admin_dashboard.php"

class="btn btn-primary btn-lg">

⬅ Back to Dashboard

</a>

</div>

</div>

</body>

</html>
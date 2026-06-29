<?php

session_start();

include("db.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: ../frontend/login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

$total = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) total FROM bookings WHERE user_id='$user_id'"));

$approved = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) total FROM bookings WHERE user_id='$user_id' AND status='Approved'"));

$pending = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) total FROM bookings WHERE user_id='$user_id' AND status='Pending'"));

$cancelled = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) total FROM bookings WHERE user_id='$user_id' AND status='Cancelled'"));

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>User Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{

background:linear-gradient(135deg,#eef2ff,#f8fafc,#dbeafe);

min-height:100vh;

}

.hero{

background:linear-gradient(135deg,#2563eb,#7c3aed);

color:white;

padding:50px;

border-radius:0 0 30px 30px;

margin-bottom:40px;

text-align:center;

}

.card{

border:none;

border-radius:20px;

box-shadow:0 15px 35px rgba(0,0,0,.12);

transition:.3s;

}

.card:hover{

transform:translateY(-8px);

}

.card i{

font-size:45px;

color:#2563eb;

margin-bottom:15px;

}

</style>

</head>

<body>

<div id="loader">

<div class="spinner"></div>

</div>

<div class="hero">

<h1>

Welcome,

<?php echo $_SESSION['name']; ?>

👋

</h1>

<p>

Manage your rentals quickly and easily.

</p>

</div>

<div class="container">

<div class="row mb-4">

<div class="col-md-3">

<div class="card text-center p-3">

<h5>Total Bookings</h5>

<h2 class="text-primary">

<?php echo $total['total']; ?>

</h2>

</div>

</div>

<div class="col-md-3">

<div class="card text-center p-3">

<h5>Approved</h5>

<h2 class="text-success">

<?php echo $approved['total']; ?>

</h2>

</div>

</div>

<div class="col-md-3">

<div class="card text-center p-3">

<h5>Pending</h5>

<h2 class="text-warning">

<?php echo $pending['total']; ?>

</h2>

</div>

</div>

<div class="col-md-3">

<div class="card text-center p-3">

<h5>Cancelled</h5>

<h2 class="text-danger">

<?php echo $cancelled['total']; ?>

</h2>

</div>

</div>

</div>

<div class="row g-4">

<div class="col-md-4">

<div class="card text-center p-4">

<i class="bi bi-car-front-fill"></i>

<h4>Browse Vehicles</h4>

<p>

Explore available cars, bikes and scooters.

</p>

<a

href="vehicles.php"

class="btn btn-primary">

View Vehicles

</a>

</div>

</div>

<div class="col-md-4">

<div class="card text-center p-4">

<i class="bi bi-clock-history"></i>

<h4>Booking History</h4>

<p>

View all your previous bookings.

</p>

<a

href="booking_history.php"

class="btn btn-success">

My Bookings

</a>

</div>

</div>

<div class="col-md-4">

<div class="card text-center p-4">

<i class="bi bi-person-circle"></i>

<h4>My Profile</h4>

<p>

View your account details.

</p>

<a

href="profile.php"

class="btn btn-info text-white">

My Profile

</a>

</div>

</div>

<div class="col-md-6">

<div class="card text-center p-4">

<i class="bi bi-plus-circle-fill"></i>

<h4>Book a Vehicle</h4>

<p>

Choose your favorite vehicle and make a booking.

</p>

<a

href="vehicles.php"

class="btn btn-warning">

Book Now

</a>

</div>

</div>

<div class="col-md-6">

<div class="card text-center p-4">

<i class="bi bi-box-arrow-right"></i>

<h4>Logout</h4>

<p>

Securely sign out of your account.

</p>

<a

href="logout.php"

class="btn btn-danger">

Logout

</a>

</div>

</div>

</div>

<footer class="text-center mt-5 mb-4">

<hr>

<p class="text-muted">

© <?php echo date("Y"); ?> RentEase AI | Smart Vehicle Rental Platform

</p>

</footer>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

window.addEventListener("load",function(){

document.getElementById("loader").style.display="none";

});

</script>

</body>

</html>
<?php

session_start();

include("db.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: ../frontend/login.html");
    exit();
}

$user_id=$_SESSION['user_id'];

$sql="SELECT * FROM users WHERE id='$user_id'";

$result=mysqli_query($conn,$sql);

$user=mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>My Profile</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<style>

body{

background:linear-gradient(135deg,#eef2ff,#f8fafc,#dbeafe);

min-height:100vh;

}

.profile-card{

border:none;

border-radius:25px;

box-shadow:0 15px 35px rgba(0,0,0,.12);

overflow:hidden;

}

.profile-header{

background:linear-gradient(135deg,#2563eb,#7c3aed);

color:white;

padding:40px;

text-align:center;

}

.avatar{

width:120px;

height:120px;

border-radius:50%;

background:white;

color:#2563eb;

font-size:55px;

display:flex;

align-items:center;

justify-content:center;

margin:auto;

box-shadow:0 5px 15px rgba(0,0,0,.2);

}

.info-card{

background:#f8fafc;

border-radius:15px;

padding:15px;

margin-bottom:15px;

}

.info-title{

font-size:14px;

color:gray;

margin-bottom:5px;

}

.info-value{

font-size:18px;

font-weight:bold;

}

</style>

</head>

<body>

<div class="container py-5">

<div class="row justify-content-center">

<div class="col-lg-7">

<div class="card profile-card">

<div class="profile-header">

<div class="avatar">

<i class="bi bi-person-fill"></i>

</div>

<h2 class="mt-3">

<?php echo $user['name']; ?>

</h2>

<p>

RentEase AI Member

</p>

</div>

<div class="card-body p-4">

<div class="info-card">

<div class="info-title">

<i class="bi bi-envelope-fill"></i>

Email

</div>

<div class="info-value">

<?php echo $user['email']; ?>

</div>

</div>

<?php if(isset($user['phone']) && !empty($user['phone'])) { ?>

<div class="info-card">

<div class="info-title">

<i class="bi bi-telephone-fill"></i>

Phone

</div>

<div class="info-value">

<?php echo $user['phone']; ?>

</div>

</div>

<?php } ?>

<div class="d-grid gap-3 mt-4">

<a

href="dashboard.php"

class="btn btn-primary btn-lg">

<i class="bi bi-speedometer2"></i>

Back to Dashboard

</a>

<a

href="booking_history.php"

class="btn btn-success btn-lg">

<i class="bi bi-clock-history"></i>

My Bookings

</a>

</div>

</div>

</div>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
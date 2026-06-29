<?php

session_start();

include("db.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: ../frontend/login.html");
    exit();
}

$id = $_GET['id'];

$sql = "SELECT

bookings.*,

users.name,

users.email,

vehicles.vehicle_name,

vehicles.brand,

vehicles.price_per_day,

bookings.payment_method,

bookings.transaction_id,

bookings.payment_status

FROM bookings

INNER JOIN users

ON bookings.user_id = users.id

INNER JOIN vehicles

ON bookings.vehicle_id = vehicles.id

WHERE bookings.id='$id'";

$result = mysqli_query($conn,$sql);

$data = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>

<html>

<head>

<title>Booking Invoice</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{

background:#f4f6f9;

}

.invoice{

max-width:850px;

margin:40px auto;

background:white;

padding:40px;

border-radius:15px;

box-shadow:0 10px 30px rgba(0,0,0,.15);

}

</style>

</head>

<body>

<div class="invoice">

<div class="d-flex justify-content-between">

<div>

<h2>

🚗 RentEase AI

</h2>

<p>

Smart Vehicle Rental Platform

</p>

</div>

<div class="text-end">

<h4>

INVOICE

</h4>

<p>

Booking ID :

<?php echo $data['id']; ?>

</p>

</div>

</div>

<hr>

<div class="row mt-4">

<div class="col-md-6">

<h5 class="text-primary">

Customer Details

</h5>

<table class="table">

<tr>

<th>Name</th>

<td>

<?php echo $data['name']; ?>

</td>

</tr>

<tr>

<th>Email</th>

<td>

<?php echo $data['email']; ?>

</td>

</tr>

</table>

</div>

<div class="col-md-6">

<h5 class="text-primary">

Booking Details

</h5>

<table class="table">

<tr>

<th>Vehicle</th>

<td>

<?php echo $data['vehicle_name']; ?>

</td>

</tr>

<tr>

<th>Brand</th>

<td>

<?php echo $data['brand']; ?>

</td>

</tr>

<tr>

<th>Start Date</th>

<td>

<?php echo $data['start_date']; ?>

</td>

</tr>

<tr>

<th>End Date</th>

<td>

<?php echo $data['end_date']; ?>

</td>

</tr>

<tr>

<th>Total Days</th>

<td>

<?php echo $data['total_days']; ?>

</td>

</tr>

<tr>

<th>Price / Day</th>

<td>

₹<?php echo $data['price_per_day']; ?>

</td>

</tr>

<tr>

<th>Total Amount</th>

<td>

<b class="text-success">

₹<?php echo $data['total_price']; ?>

</b>

</td>

</tr>

<tr>

<th>Status</th>

<td>

<?php echo $data['status']; ?>

</td>

</tr>

<tr>

<th>Payment Method</th>

<td>

<?php echo $data['payment_method']; ?>

</td>

</tr>

<tr>

<th>Transaction ID</th>

<td>

<?php echo $data['transaction_id']; ?>

</td>

</tr>

<tr>

<th>Payment Status</th>

<td>

<?php

if($data['payment_status']=="Paid")
{
    echo "<span class='badge bg-success'>Paid</span>";
}
else
{
    echo "<span class='badge bg-warning text-dark'>Pending</span>";
}

?>

</td>

</tr>

</table>

</div>

</div>

<hr>

<h5>

Terms & Conditions

</h5>

<ul>

<li>Vehicle must be returned on time.</li>

<li>Carry a valid Driving License.</li>

<li>Damage charges will be extra.</li>

<li>Thank you for choosing RentEase AI.</li>

</ul>

<div class="text-center mt-5">

<button

onclick="window.print()"

class="btn btn-success btn-lg me-3">

🖨 Print Invoice

</button>

<a

href="booking_history.php"

class="btn btn-primary btn-lg">

⬅ Back

</a>

</div>

</div>

<hr>

<div class="text-center mt-4">

<button
onclick="window.print()"
class="btn btn-success me-2">

🖨 Print Invoice

</button>

<a
href="dashboard.php"
class="btn btn-primary">

🏠 Dashboard

</a>

</div>

</body>

</html>
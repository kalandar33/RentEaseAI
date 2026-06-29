<?php

session_start();

include("db.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: ../frontend/login.html");
    exit();
}

$booking_id = $_POST['booking_id'];

$method = isset($_POST['method']) ? $_POST['method'] : "";

if($method == "Cash on Pickup")
{
    $transaction_id = "N/A";
    $payment_status = "Pending";
}
else
{
    $transaction_id = "TXN".rand(10000000,99999999);
    $payment_status = "Paid";
}

/* Update Booking */

if($method == "Cash on Pickup")
{
    $status = "Pending";
}
else
{
    $status = "Approved";
}

$sql = "UPDATE bookings
SET
status='$status',
payment_method='$method',
transaction_id='$transaction_id',
payment_status='$payment_status'
WHERE id='$booking_id'";

mysqli_query($conn,$sql);

/* Fetch Booking */

$sql="SELECT
bookings.*,
vehicles.vehicle_name

FROM bookings

INNER JOIN vehicles

ON bookings.vehicle_id=vehicles.id

WHERE bookings.id='$booking_id'";

$result=mysqli_query($conn,$sql);

$data=mysqli_fetch_assoc($result);

$payment_status = $data['payment_status'];

$isCash = ($method == "Cash on Pickup");

?>

<!DOCTYPE html>

<html>

<head>

<title>Payment Successful</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{

background:linear-gradient(135deg,#dcfce7,#d1fae5);

}

.card{

border:none;

border-radius:20px;

box-shadow:0 15px 35px rgba(0,0,0,.15);

}

.success{

font-size:70px;

}

</style>

</head>

<body>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-7">

<div class="card p-5 text-center">

<div class="success">

<?php echo $isCash ? "📅" : "✅"; ?>

</div>

<h2 class="<?php echo $isCash ? 'text-warning' : 'text-success'; ?>">

<?php
if($isCash)
{
    echo "Booking Confirmed";
}
else
{
    echo "Payment Successful";
}
?>

</h2>

<p>

<?php
if($isCash)
{
    echo "Your booking has been confirmed. Please complete the payment when you pick up the vehicle.";
}
else
{
    echo "Your payment has been completed successfully and your booking is confirmed.";
}
?>

</p>

<hr>

<h4>

<?php echo $data['vehicle_name']; ?>

</h4>

<p>

Booking ID :

<b>

<?php echo $booking_id; ?>

</b>

</p>

<p>

Transaction ID :

<b>

<?php echo $transaction_id; ?>

</b>

</p>

<p>

Payment Method :

<b>

<?php echo $method; ?>

</b>

</p>

<p>

Payment Status :

<?php if($payment_status == "Paid") { ?>

<span class="badge bg-success">

<?php echo $payment_status; ?>

</span>

<?php } else { ?>

<span class="badge bg-warning text-dark">

<?php echo $payment_status; ?>

</span>

<?php } ?>

</p>

<p>

<?php
if($isCash)
{
    echo "Amount to Pay at Pickup :";
}
else
{
    echo "Amount Paid :";
}
?>

<b class="<?php echo $isCash ? 'text-warning' : 'text-success'; ?> fs-4">

₹<?php echo $data['total_price']; ?>

</b>

</p>

<div class="d-grid gap-3 mt-4">

<?php if(!$isCash){ ?>

<a
href="invoice.php?id=<?php echo $booking_id; ?>"
class="btn btn-primary btn-lg">

📄 Download Invoice

</a>

<?php } ?>

<a
href="booking_history.php"
class="btn btn-success">

📅 My Bookings

</a>

</div>

</div>

</div>

</div>

</div>

</body>

</html>
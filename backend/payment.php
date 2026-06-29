<?php

session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: ../frontend/login.html");
    exit();
}

include("db.php");

if(!isset($_GET['booking_id']))
{
    die("Invalid Booking.");
}

$booking_id = $_GET['booking_id'];

$sql="SELECT bookings.*,vehicles.vehicle_name

FROM bookings

INNER JOIN vehicles

ON bookings.vehicle_id=vehicles.id

WHERE bookings.id='$booking_id'";

$result=mysqli_query($conn,$sql);

$data=mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>

<html>

<head>

<title>Payment</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{

background:linear-gradient(135deg,#dbeafe,#eef2ff);

}

.card{

border:none;

border-radius:20px;

box-shadow:0 15px 35px rgba(0,0,0,.15);

}

/* Payment Options */

.form-check{

transition:.3s;

cursor:pointer;

padding:15px;

border:1px solid #ddd;

border-radius:12px;

margin-bottom:15px;

}

.form-check:hover{

background:#eef4ff;

border-color:#0d6efd;

transform:scale(1.02);

}

/* Button */

button{

border-radius:12px;

font-weight:bold;

}

/* Amount */

.text-success{

font-size:28px;

font-weight:bold;

}

/* Vehicle Name */

h4{

font-weight:700;

}

</style>

</head>

<body>

<div id="loader">

<div class="spinner"></div>

</div>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card p-4">

<h2 class="text-center mb-4">

💳 Payment

</h2>

<h4>

<?php echo $data['vehicle_name']; ?>

</h4>

<hr>

<p>

Booking ID :

<b>

<?php echo $data['id']; ?>

</b>

</p>

<p>

Amount :

<b class="text-success">

₹<?php echo $data['total_price']; ?>

</b>

</p>

<form action="payment_success.php" method="POST">

<input
type="hidden"
name="booking_id"
value="<?php echo $data['id']; ?>">

<h5 class="mb-3">

Choose Payment Method

</h5>

<div class="form-check border rounded p-3 mb-3">

<input
class="form-check-input"
type="radio"
name="method"
value="UPI"
id="upi"
checked>

<label class="form-check-label w-100" for="upi">

📱 UPI (Google Pay / PhonePe / Paytm)

</label>

</div>

<div class="form-check border rounded p-3 mb-3">

<input
class="form-check-input"
type="radio"
name="method"
value="Credit Card"
id="credit">

<label class="form-check-label w-100" for="credit">

💳 Credit Card

</label>

</div>

<div class="form-check border rounded p-3 mb-3">

<input
class="form-check-input"
type="radio"
name="method"
value="Debit Card"
id="debit">

<label class="form-check-label w-100" for="debit">

💳 Debit Card

</label>

</div>

<div class="form-check border rounded p-3 mb-3">

<input
class="form-check-input"
type="radio"
name="method"
value="Net Banking"
id="net">

<label class="form-check-label w-100" for="net">

🏦 Net Banking

</label>

</div>

<div class="form-check border rounded p-3 mb-4">

<input
class="form-check-input"
type="radio"
name="method"
value="Cash on Pickup"
id="cash">

<label class="form-check-label w-100" for="cash">

💵 Cash on Pickup

</label>

</div>

<div class="d-grid">

<button
class="btn btn-success btn-lg">

🔒 Pay Securely

</button>

</div>

</form>

</div>

</div>

</div>

</div>

<script>

window.addEventListener("load",function(){

document.getElementById("loader").style.display="none";

});

</script>

</body>

</html>
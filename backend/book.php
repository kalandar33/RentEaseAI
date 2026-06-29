<?php

include("db.php");

$vehicle_id=$_GET['vehicle_id'];

$sql="SELECT * FROM vehicles WHERE id='$vehicle_id'";

$result=mysqli_query($conn,$sql);

$vehicle=mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Book Vehicle</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<link rel="stylesheet" href="/RentEaseAI/assets/css/style.css">

<style>

body{

background:linear-gradient(135deg,#eef2ff,#f8fafc,#dbeafe);

}

.booking-card{

background:white;

border:none;

border-radius:22px;

box-shadow:0 15px 40px rgba(0,0,0,.12);

overflow:hidden;

}

.vehicle-img{

width:100%;

height:420px;

object-fit:cover;

}

.price{

font-size:36px;

font-weight:bold;

color:#0d6efd;

}

.summary{

background:#f8fafc;

border-radius:15px;

padding:20px;

margin-top:20px;

}

</style>

</head>

<body>

<div class="container mt-5 mb-5">

<div class="card booking-card">

<div class="row g-0">

<div class="col-lg-6">

<img

src="../uploads/vehicles/<?php echo rawurlencode($vehicle['image']); ?>"

class="vehicle-img"

alt="Vehicle">

</div>

<div class="col-lg-6 p-5">

<h2 class="fw-bold">

<?php echo $vehicle['vehicle_name']; ?>

</h2>

<p class="text-muted">

<?php echo $vehicle['brand']; ?>

• <?php echo $vehicle['vehicle_type']; ?>

• <?php echo $vehicle['fuel_type']; ?>

</p>

<div class="price">

₹<?php echo $vehicle['price_per_day']; ?>

<small class="fs-6 text-muted">/day</small>

</div>

<hr>

<form action="save_booking.php" method="POST">

<input

type="hidden"

name="vehicle_id"

value="<?php echo $vehicle['id']; ?>">

<div class="mb-3">

<label class="form-label">

<i class="bi bi-calendar-event-fill"></i>

Start Date

</label>

<input

type="date"

class="form-control"

id="startDate"

name="start_date"

required>

</div>

<div class="mb-3">

<label class="form-label">

<i class="bi bi-calendar-check-fill"></i>

End Date

</label>

<input

type="date"

class="form-control"

id="endDate"

name="end_date"

required>

</div>

<div class="summary">

<h5 class="mb-3">

📋 Booking Summary

</h5>

<div class="d-flex justify-content-between">

<span>Price Per Day</span>

<strong>

₹<?php echo $vehicle['price_per_day']; ?>

</strong>

</div>

<hr>

<div class="d-flex justify-content-between">

<span>Total Days</span>

<strong id="days">

0

</strong>

</div>

<hr>

<div class="d-flex justify-content-between">

<span>Total Amount</span>

<h4 class="text-primary">

₹<span id="amount">0</span>

</h4>

</div>

</div>

<div class="d-grid mt-4">

<button

type="submit"

class="btn btn-primary btn-lg">

<i class="bi bi-check-circle-fill"></i>

Confirm Booking

</button>

</div>

<a

href="vehicle_details.php?id=<?php echo $vehicle['id']; ?>"

class="btn btn-outline-secondary w-100 mt-3">

<i class="bi bi-arrow-left"></i>

Back to Vehicle

</a>

</form>

</div>

</div>

</div>

</div>

<footer class="text-center mt-5 mb-4">

<p class="text-muted">

© <?php echo date("Y"); ?> RentEase AI • Smart Vehicle Rental Platform

</p>

</footer>

<script>

const pricePerDay = <?php echo $vehicle['price_per_day']; ?>;

const startDate = document.getElementById("startDate");

const endDate = document.getElementById("endDate");

const daysText = document.getElementById("days");

const amountText = document.getElementById("amount");

// Set minimum date to today
const today = new Date().toISOString().split("T")[0];

startDate.min = today;
endDate.min = today;

function calculateBooking(){

if(startDate.value=="" || endDate.value=="")
{
return;
}

let start = new Date(startDate.value);

let end = new Date(endDate.value);

if(end < start)
{

alert("End Date cannot be earlier than Start Date.");

endDate.value="";

daysText.innerHTML="0";

amountText.innerHTML="0";

return;

}

let diff = Math.ceil((end-start)/(1000*60*60*24))+1;

let total = diff * pricePerDay;

daysText.innerHTML = diff;

amountText.innerHTML = total;

}

startDate.addEventListener("change",calculateBooking);

endDate.addEventListener("change",calculateBooking);

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
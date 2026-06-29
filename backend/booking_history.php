<?php

session_start();

include("db.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: ../frontend/login.html");
    exit();
}

$user_id=$_SESSION['user_id'];

$sql="SELECT
bookings.*,
vehicles.vehicle_name,
vehicles.brand,
vehicles.image

FROM bookings

INNER JOIN vehicles

ON bookings.vehicle_id=vehicles.id

WHERE bookings.user_id='$user_id'

ORDER BY bookings.id DESC";

$result=mysqli_query($conn,$sql);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Booking History</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<link rel="stylesheet" href="/RentEaseAI/assets/css/style.css">

<style>

body{
background:linear-gradient(135deg,#eef2ff,#f8fafc,#dbeafe);
}

.hero{

background:linear-gradient(135deg,#2563eb,#7c3aed);

color:white;

padding:60px 20px;

border-radius:0 0 30px 30px;

margin-bottom:40px;

}

.booking-card{

background:white;

border:none;

border-radius:22px;

overflow:hidden;

box-shadow:0 15px 35px rgba(0,0,0,.12);

transition:.35s;

}

.booking-card:hover{

transform:translateY(-8px);

}

.booking-img{

width:100%;

height:240px;

object-fit:cover;

}

.info{

padding:8px 0;

font-size:16px;

}

.search-box{

max-width:500px;

margin:auto;

margin-top:20px;

}

</style>

</head>

<body>

<div class="hero text-center">

<h1>

📋 My Booking History

</h1>

<p>

View all your bookings in one place

</p>

<div class="search-box">

<input

type="text"

id="bookingSearch"

class="form-control form-control-lg"

placeholder="🔍 Search bookings...">

</div>

</div>

<div class="container">

    <?php

if(mysqli_num_rows($result)>0)
{

while($row=mysqli_fetch_assoc($result))
{

?>

<div class="card booking-card mb-4 booking-item">

<div class="row g-0">

<div class="col-lg-4">

<?php

if(!empty($row['image']))
{

?>

<img

src="../uploads/vehicles/<?php echo rawurlencode($row['image']); ?>"

class="booking-img"

alt="Vehicle">

<?php

}

else

{

?>

<img

src="https://via.placeholder.com/500x300?text=No+Image"

class="booking-img"

alt="No Image">

<?php

}

?>

</div>

<div class="col-lg-8">

<div class="card-body p-4">

<h3 class="fw-bold">

<?php echo $row['vehicle_name']; ?>

</h3>

<span class="badge bg-primary">

<?php echo $row['brand']; ?>

</span>

<hr>

<div class="row">

<div class="col-md-6">

<p class="info">

📅 <strong>Start Date:</strong>

<?php echo $row['start_date']; ?>

</p>

<p class="info">

🏁 <strong>End Date:</strong>

<?php echo $row['end_date']; ?>

</p>

<p class="info">

🗓️ <strong>Total Days:</strong>

<?php echo $row['total_days']; ?>

</p>

</div>

<div class="col-md-6">

<p class="info">

💰 <strong>Amount:</strong>

₹<?php echo $row['amount']; ?>

</p>

<p class="info">

💳 <strong>Total Price:</strong>

₹<?php echo $row['total_price']; ?>

</p>

<p class="info">

📌 <strong>Status:</strong>

<?php

if($row['status']=="Approved")
{
echo "<span class='badge bg-success'>Approved</span>";
}
elseif($row['status']=="Pending")
{
echo "<span class='badge bg-warning text-dark'>Pending</span>";
}
elseif($row['status']=="Cancelled")
{
echo "<span class='badge bg-danger'>Cancelled</span>";
}
elseif($row['status']=="Completed")
{
echo "<span class='badge bg-primary'>Completed</span>";
}
else
{
echo "<span class='badge bg-secondary'>".$row['status']."</span>";
}

?>

</p>

<a

href="invoice.php?id=<?php echo $row['id']; ?>"

class="btn btn-outline-primary">

📄 View Invoice

</a>

</div>

</div>

</div>

</div>

</div>

</div>

<?php

}

}

else

{

?>

<div class="alert alert-info text-center">

<h4>No Bookings Found</h4>

<p>

You haven't booked any vehicles yet.

</p>

<a

href="vehicles.php"

class="btn btn-primary">

Browse Vehicles

</a>

</div>

<?php

}

?>  

<div class="text-center mt-5">

<a

href="dashboard.php"

class="btn btn-primary btn-lg me-3">

<i class="bi bi-speedometer2"></i>

Dashboard

</a>

<a

href="vehicles.php"

class="btn btn-success btn-lg">

<i class="bi bi-car-front-fill"></i>

Book Another Vehicle

</a>

</div>

</div>

<footer class="mt-5 py-4 text-center">

<hr>

<p class="text-muted mb-0">

© <?php echo date("Y"); ?> RentEase AI | Smart Vehicle Rental Platform

</p>

</footer>

<script>

const search=document.getElementById("bookingSearch");

search.addEventListener("keyup",function(){

let value=this.value.toLowerCase();

let cards=document.querySelectorAll(".booking-item");

cards.forEach(function(card){

if(card.innerText.toLowerCase().includes(value))
{
card.style.display="block";
}
else
{
card.style.display="none";
}

});

});

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
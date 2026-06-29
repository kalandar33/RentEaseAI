<?php

include("db.php");

$id = $_GET['id'];

$sql = "SELECT * FROM vehicles WHERE id='$id'";

$result = mysqli_query($conn,$sql);

$row = mysqli_fetch_assoc($result);

/* AI Recommendation */

$vehicle_name = $row['vehicle_name'];

$command = 'python ../ml/recommend_api.py "' . $vehicle_name . '"';

$output = shell_exec($command);

$recommendations = json_decode($output,true);

// -------------------------
// Load Reviews
// -------------------------

$review_sql = "SELECT

reviews.*,

users.name

FROM reviews

INNER JOIN users

ON reviews.user_id = users.id

WHERE vehicle_id='$id'

ORDER BY id DESC";

$review_result = mysqli_query($conn,$review_sql);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php echo $row['vehicle_name']; ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<link rel="stylesheet" href="/RentEaseAI/assets/css/style.css">

<style>

body{
background:linear-gradient(135deg,#eef2ff,#f8fafc,#dbeafe);
}

.details-card{
background:white;
border:none;
border-radius:22px;
overflow:hidden;
box-shadow:0 15px 40px rgba(0,0,0,.12);
}

.vehicle-img{
width:100%;
height:450px;
object-fit:cover;
}

.price{
font-size:42px;
font-weight:bold;
color:#0d6efd;
}

.feature{
padding:10px 18px;
background:#f1f5f9;
border-radius:12px;
margin-bottom:12px;
font-weight:500;
}

.recommend-card{
border:none;
border-radius:18px;
overflow:hidden;
box-shadow:0 10px 25px rgba(0,0,0,.08);
transition:.3s;
}

.recommend-card:hover{
transform:translateY(-6px);
}

.recommend-card img{
height:170px;
object-fit:cover;
}

</style>

</head>

<body>

<div class="container mt-5 mb-5">

<div class="card details-card">

<div class="row g-0">

<div class="col-lg-6">

<img

src="../uploads/vehicles/<?php echo rawurlencode($row['image']); ?>"

class="vehicle-img">

</div>

<div class="col-lg-6 p-5">

<h1 class="fw-bold">

<?php echo $row['vehicle_name']; ?>

</h1>

<p class="text-muted fs-5">

Premium Rental Vehicle

</p>

<div class="price">

₹<?php echo $row['price_per_day']; ?>

<span style="font-size:18px;color:#666;">

/day

</span>

</div>

<hr>

<div class="feature">

🚗 Brand :
<strong>

<?php echo $row['brand']; ?>

</strong>

</div>

<div class="feature">

🚗 Type :
<strong>

<?php echo !empty($row['vehicle_type']) ? $row['vehicle_type'] : "N/A"; ?>

</strong>

</div>

<div class="feature">

⛽ Fuel :
<strong>

<?php echo !empty($row['fuel_type']) ? $row['fuel_type'] : "N/A"; ?>

</strong>

</div>

<div class="feature">

⭐ Rating :
<strong>

4.8 / 5

</strong>

</div>

<div class="feature">

📍 Status :
<strong>

<?php

if($row['availability']=="Available")
{
    echo "<span class='badge bg-success'>Available</span>";
}
else
{
    echo "<span class='badge bg-danger'>Booked</span>";
}

?>

</strong>

</div>

<div class="mt-4">

<a

href="book.php?vehicle_id=<?php echo $row['id']; ?>"

class="btn btn-primary btn-lg">

<i class="bi bi-calendar-check-fill"></i>

Book Now

</a>

<a

href="vehicles.php"

class="btn btn-outline-secondary btn-lg">

Back

</a>

</div>

</div>

</div>

</div>

<hr class="my-5">

<h2 class="text-center fw-bold mb-4">

🤖 AI Recommended Vehicles

</h2>

<div class="row">

<?php

if(!empty($recommendations))
{

foreach($recommendations as $vehicle)

{

?>

<div class="col-lg-4 col-md-6 mb-4">

<div class="card recommend-card h-100">

<?php

if(!empty($vehicle['image']))
{

?>

<img

src="../uploads/vehicles/<?php echo rawurlencode($vehicle['image']); ?>"

class="card-img-top"

alt="Vehicle">

<?php

}

else

{

?>

<img

src="https://via.placeholder.com/500x300?text=No+Image"

class="card-img-top"

alt="No Image">

<?php

}

?>

<div class="card-body">

<h5 class="fw-bold">

<?php echo $vehicle['vehicle_name']; ?>

</h5>

<div class="mb-2">

<span class="badge bg-primary">

<?php echo $vehicle['brand']; ?>

</span>

<span class="badge bg-success">

<?php echo $vehicle['vehicle_type']; ?>

</span>

<span class="badge bg-warning text-dark">

<?php echo $vehicle['fuel_type']; ?>

</span>

</div>

<h4 class="text-primary">

₹<?php echo $vehicle['price_per_day']; ?>

<small class="text-muted fs-6">

/day

</small>

</h4>

<div class="d-grid mt-3">

<a

href="vehicle_details.php?id=<?php echo $vehicle['id']; ?>"

class="btn btn-outline-primary">

<i class="bi bi-eye-fill"></i>

View Details

</a>

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

<div class="col-12">

<div class="alert alert-info text-center">

No AI recommendations available.

</div>

</div>

<?php

}

?>

</div>

<hr class="mt-5">

<div class="card border-0 shadow-lg mt-4">

<div class="card-body text-center p-5">

<h3 class="fw-bold">

💎 Why Rent with RentEase AI?

</h3>

<div class="row mt-4">

<div class="col-md-3">

<h1>🚗</h1>

<h5>Premium Vehicles</h5>

<p class="text-muted">

Well-maintained and sanitized vehicles.

</p>

</div>

<div class="col-md-3">

<h1>💰</h1>

<h5>Affordable Pricing</h5>

<p class="text-muted">

Best rental prices with no hidden charges.

</p>

</div>

<div class="col-md-3">

<h1>🤖</h1>

<h5>AI Recommendations</h5>

<p class="text-muted">

Smart vehicle suggestions based on your interests.

</p>

</div>

<div class="col-md-3">

<h1>🛡️</h1>

<h5>Secure Booking</h5>

<p class="text-muted">

Fast, reliable and secure online booking.

</p>

<hr class="mt-5">

<h2 class="mb-4">

⭐ Customer Reviews

</h2>

<?php

if(mysqli_num_rows($review_result)>0)
{

while($review=mysqli_fetch_assoc($review_result))
{

?>

<div class="card shadow mb-3">

<div class="card-body">

<h5>

<?php echo htmlspecialchars($review['name']); ?>

</h5>

<p style="font-size:22px;color:orange;">

<?php

for($i=1;$i<=$review['rating'];$i++)
{
    echo "⭐";
}

?>

</p>

<p>

<?php echo htmlspecialchars($review['comment']); ?>

</p>

</div>

</div>

<?php

}

}
else
{

?>

<div class="alert alert-info">

No reviews yet.

</div>

<?php

}

?>

<a

href="review.php?vehicle_id=<?php echo $row['id']; ?>"

class="btn btn-warning btn-lg mt-3">

⭐ Write a Review

</a>

</div>

</div>

</div>

</div>

</div>

<footer class="text-center mt-5 mb-4">

<p class="text-muted">

© <?php echo date("Y"); ?> RentEase AI • Smart Vehicle Rental Platform

</p>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
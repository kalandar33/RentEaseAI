<?php include 'includes/header.php'; ?>

<?php include 'includes/navbar.php'; ?>

<section
class="hero text-white d-flex align-items-center"
style="
height:90vh;
background:
linear-gradient(rgba(0,0,0,.55),rgba(0,0,0,.55)),
url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1600&q=80');
background-size:cover;
background-position:center;
">

<div class="container text-center">

<h1 class="display-3 fw-bold">

Rent Your Dream Vehicle

</h1>

<p class="lead">

Book Cars, Bikes & Scooters in Minutes with AI Recommendations.

</p>

<a
href="backend/vehicles.php"
class="btn btn-warning btn-lg me-3">

Explore Vehicles

</a>

<a
href="frontend/register.html"
class="btn btn-outline-light btn-lg">

Register

</a>

</div>

</section>

<section class="container mt-5">

<h2 class="text-center mb-4">

Featured Vehicles

</h2>

<div class="row">

<?php

include("backend/db.php");

$sql = "SELECT * FROM vehicles LIMIT 3";

$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result))
{

?>

<div class="col-md-4 mb-4">

<div class="card shadow">

<?php

$image = !empty($row['image'])
? "uploads/vehicles/".$row['image']
: "https://via.placeholder.com/400x220?text=No+Image";

?>

<img
src="<?php echo $image; ?>"
class="card-img-top"
style="height:220px;object-fit:cover;">

<div class="card-body">

<h4>

<?php echo $row['vehicle_name']; ?>

</h4>

<p>

Brand:
<?php echo $row['brand']; ?>

</p>

<p>

Type:
<?php echo $row['vehicle_type']; ?>

</p>

<p>

₹
<?php echo $row['price_per_day']; ?>

/ day

</p>

<a
href="backend/vehicles.php"
class="btn btn-primary">

Book Now

</a>

</div>

</div>

</div>

<?php

}

?>

</div>

</section>

<section class="container mt-5">

<h2 class="text-center mb-5">

Why Choose RentEase AI?

</h2>

<div class="row text-center">

<div class="col-md-3">

<div class="card p-4 shadow">

<h1>🚗</h1>

<h4>Wide Selection</h4>

<p>

Cars, Bikes and Scooters available anytime.

</p>

</div>

</div>

<div class="col-md-3">

<div class="card p-4 shadow">

<h1>🤖</h1>

<h4>AI Recommendation</h4>

<p>

Smart suggestions based on user preferences.

</p>

</div>

</div>

<div class="col-md-3">

<div class="card p-4 shadow">

<h1>💰</h1>

<h4>Affordable Price</h4>

<p>

Transparent pricing with no hidden charges.

</p>

</div>

</div>

<div class="col-md-3">

<div class="card p-4 shadow">

<h1>🛡️</h1>

<h4>Secure Booking</h4>

<p>

Fast and secure online booking experience.

</p>

</div>

</div>

</div>

</section>

<section class="bg-dark text-white mt-5 p-5">

<div class="container">

<div class="row text-center">

<div class="col-md-3">

<h1>500+</h1>

<p>Happy Customers</p>

</div>

<div class="col-md-3">

<h1>120+</h1>

<p>Vehicles</p>

</div>

<div class="col-md-3">

<h1>1500+</h1>

<p>Bookings</p>

</div>

<div class="col-md-3">

<h1>4.9★</h1>

<p>Average Rating</p>

</div>

</div>

</div>

</section>

<section class="container mt-5 mb-5">

<h2 class="text-center">

Customer Reviews

</h2>

<div class="row mt-4">

<div class="col-md-4">

<div class="card shadow p-3">

<h5>⭐⭐⭐⭐⭐</h5>

<p>

"Booking was quick and the scooter was in excellent condition."

</p>

<strong>- Ayaan</strong>

</div>

</div>

<div class="col-md-4">

<div class="card shadow p-3">

<h5>⭐⭐⭐⭐⭐</h5>

<p>

"Affordable prices and very friendly service."

</p>

<strong>- Priya</strong>

</div>

</div>

<div class="col-md-4">

<div class="card shadow p-3">

<h5>⭐⭐⭐⭐⭐</h5>

<p>

"The AI recommendations helped me choose the right vehicle."

</p>

<strong>- Rahul</strong>

</div>

</div>

</div>

</section>

<section class="bg-primary text-white p-5">

<div class="container text-center">

<h2>Ready to Ride?</h2>

<p>
Book your favourite vehicle in just a few clicks.
</p>

<a
href="backend/vehicles.php"
class="btn btn-light btn-lg">

Book Now

</a>

</div>

</section>

<?php include 'includes/footer.php'; ?>
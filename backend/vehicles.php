<?php

include("db.php");

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn,$_GET['search']) : "";
$type = isset($_GET['type']) ? mysqli_real_escape_string($conn,$_GET['type']) : "";
$fuel = isset($_GET['fuel']) ? mysqli_real_escape_string($conn,$_GET['fuel']) : "";
$status = isset($_GET['status']) ? mysqli_real_escape_string($conn,$_GET['status']) : "";

$sql = "SELECT * FROM vehicles WHERE 1=1";

if($search!="")
{
    $sql .= " AND (
        vehicle_name LIKE '%$search%'
        OR brand LIKE '%$search%'
    )";
}

if($type!="")
{
    $sql .= " AND vehicle_type='$type'";
}

if($fuel!="")
{
    $sql .= " AND fuel_type='$fuel'";
}

if($status!="")
{
    $sql .= " AND availability='$status'";
}

$sql .= " ORDER BY id DESC";

$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>RentEase AI | Vehicles</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<link rel="stylesheet" href="/RentEaseAI/assets/css/style.css">

<style>

body{

background:linear-gradient(135deg,#eef2ff,#f8fafc,#dbeafe);

}

/* Hero */

.hero{

background:linear-gradient(135deg,#2563eb,#7c3aed);

color:white;

padding:70px 20px;

border-radius:0 0 35px 35px;

margin-bottom:40px;

}

.hero h1{

font-size:48px;

font-weight:700;

}

.hero p{

font-size:18px;

opacity:.9;

}

/* Search */

.search-box{

max-width:600px;

margin:auto;

margin-top:25px;

}

/* Vehicle Card */

.vehicle-card{

background:rgba(255,255,255,.92);

border:none;

border-radius:22px;

overflow:hidden;

box-shadow:0 12px 35px rgba(0,0,0,.10);

transition:.35s;

}

.vehicle-card:hover{

transform:translateY(-10px);

box-shadow:0 25px 50px rgba(37,99,235,.25);

}

.vehicle-card img{

height:230px;

object-fit:cover;

}

.price{

font-size:24px;

font-weight:bold;

color:#0d6efd;

}

.badge{

font-size:13px;

margin-right:6px;

}

</style>

</head>

<body>

<div id="loader">

<div class="spinner"></div>

</div>

<div class="hero text-center">

<h1>

🚗 Explore Our Vehicles

</h1>

<p>

Choose the perfect ride for your journey.

</p>

<form method="GET">

<div class="row g-3 mt-3">

<div class="col-md-4">
<input type="text"
name="search"
class="form-control form-control-lg"
placeholder="🔍 Search Vehicle"
value="<?php echo $search; ?>">
</div>

<div class="col-md-2">
<select name="type" class="form-select form-select-lg">
<option value="">All Types</option>
<option value="Car">Car</option>
<option value="Bike">Bike</option>
<option value="Scooter">Scooter</option>
</select>
</div>

<div class="col-md-2">
<select name="fuel" class="form-select form-select-lg">
<option value="">Fuel Type</option>
<option value="Petrol">Petrol</option>
<option value="Diesel">Diesel</option>
<option value="Electric">Electric</option>
</select>
</div>

<div class="col-md-2">
<select name="status" class="form-select form-select-lg">
<option value="">Status</option>
<option value="Available">Available</option>
<option value="Booked">Booked</option>
</select>
</div>

<div class="col-md-2">
<button class="btn btn-warning btn-lg w-100">
<i class="bi bi-funnel-fill"></i> Filter
</button>
</div>

</div>

</form>
</div>

<div class="container">

<div class="row"

id="vehicleContainer">

<?php

while($row=mysqli_fetch_assoc($result))
{

?>

<div class="col-lg-4 col-md-6 mb-4 vehicle-item">

<div class="card vehicle-card h-100">

<?php

if(!empty($row['image']))
{

?>

<img

src="../uploads/vehicles/<?php echo rawurlencode($row['image']); ?>"

class="card-img-top"

alt="Vehicle">

<?php

}

else

{

?>

<img

src="https://via.placeholder.com/600x400?text=No+Image"

class="card-img-top"

alt="No Image">

<?php

}

?>

<div class="card-body">

<h4 class="fw-bold mb-3">

<?php echo $row['vehicle_name']; ?>

</h4>

<div class="mb-3">

<span class="badge bg-primary">

<?php echo $row['brand']; ?>

</span>

<span class="badge bg-success">

<?php echo $row['vehicle_type']; ?>

</span>

<span class="badge bg-warning text-dark">

<?php echo $row['fuel_type']; ?>

</span>

</div>

<p class="price">

₹<?php echo $row['price_per_day']; ?>

<span style="font-size:15px;font-weight:400;color:#666;">

/ day

</span>

</p>

<?php

if($row['availability']=="Available")
{

?>

<span class="badge bg-success mb-3">

✅ Available

</span>

<?php

}

else

{

?>

<span class="badge bg-danger mb-3">

❌ Not Available

</span>

<?php

}

?>

<hr>

<div class="d-grid">

<a

href="vehicle_details.php?id=<?php echo $row['id']; ?>"

class="btn btn-primary btn-lg">

<i class="bi bi-calendar-check-fill"></i>

Book Now

</a>

</div>

</div>

</div>

</div>

<?php

}

?>

</div>

</div>

<script>

const searchInput = document.getElementById("searchVehicle");

searchInput.addEventListener("keyup", function(){

let filter = searchInput.value.toLowerCase();

let cards = document.querySelectorAll(".vehicle-item");

cards.forEach(function(card){

let text = card.innerText.toLowerCase();

if(text.indexOf(filter) > -1)
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

<script>

window.addEventListener("load",function(){

document.getElementById("loader").style.display="none";

});

</script>

</body>

</html>
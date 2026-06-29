<?php

include("db.php");

$sql = "SELECT * FROM vehicles ORDER BY id DESC";

$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Manage Vehicles</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{

background:linear-gradient(135deg,#eef2ff,#f8fafc,#dbeafe);

min-height:100vh;

}

.card{

border:none;

border-radius:20px;

box-shadow:0 15px 35px rgba(0,0,0,.12);

}

.table img{

border-radius:10px;

}

.search-box{

max-width:350px;

}

.table thead{

background:linear-gradient(135deg,#2563eb,#7c3aed);

color:white;

}

.table tbody tr:hover{

background:#eef5ff;

transition:.3s;

}

.badge{

font-size:14px;

padding:8px 12px;

}

</style>

</head>

<body>

<div class="container py-5">

<div class="card">

<div class="card-body">

<div class="d-flex justify-content-between align-items-center flex-wrap mb-4">

<h2>

🚗 Manage Vehicles

</h2>

<div class="search-box">

<input

type="text"

id="vehicleSearch"

class="form-control"

placeholder="🔍 Search Vehicle...">

</div>

<a

href="add_vehicle.php"

class="btn btn-success">

<i class="bi bi-plus-circle-fill"></i>

Add Vehicle

</a>

</div>

<div class="table-responsive">

<table class="table table-hover align-middle">

<thead>

<tr>

<th>ID</th>

<th>Image</th>

<th>Vehicle</th>

<th>Brand</th>

<th>Type</th>

<th>Fuel</th>

<th>Price/Day</th>

<th>Status</th>

<th>Action</th>

</tr>

</thead>

<tbody>

<?php

while($row=mysqli_fetch_assoc($result))

{

?>

<tr class="vehicle-row">

<td>

<?php echo $row['id']; ?>

</td>

<td>

<?php

if(!empty($row['image']))
{

?>

<img

src="../uploads/vehicles/<?php echo rawurlencode($row['image']); ?>"

width="90"

height="65"

style="object-fit:cover;">

<?php

}

else

{

echo "No Image";

}

?>

</td>

<td>

<strong>

<?php echo $row['vehicle_name']; ?>

</strong>

</td>

<td>

<?php echo $row['brand']; ?>

</td>

<td>

<?php echo $row['vehicle_type']; ?>

</td>

<td>

<?php echo $row['fuel_type']; ?>

</td>

<td>

<strong class="text-primary">

₹<?php echo $row['price_per_day']; ?>

</strong>

</td>

<td>

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

</td>

<td>

<a

href="edit_vehicle.php?id=<?php echo $row['id']; ?>"

class="btn btn-warning btn-sm">

<i class="bi bi-pencil-fill"></i>

</a>

<a

href="delete_vehicle.php?id=<?php echo $row['id']; ?>"

class="btn btn-danger btn-sm"

onclick="return confirm('Are you sure you want to delete this vehicle?')">

<i class="bi bi-trash-fill"></i>

</a>

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>

<div class="d-flex justify-content-between align-items-center mt-4">

<a

href="admin_dashboard.php"

class="btn btn-primary">

<i class="bi bi-arrow-left-circle"></i>

Back to Dashboard

</a>

<a

href="add_vehicle.php"

class="btn btn-success">

<i class="bi bi-plus-circle"></i>

Add New Vehicle

</a>

</div>

</div>

</div>

</div>

<script>

const search=document.getElementById("vehicleSearch");

search.addEventListener("keyup",function(){

let value=this.value.toLowerCase();

let rows=document.querySelectorAll(".vehicle-row");

rows.forEach(function(row){

if(row.innerText.toLowerCase().includes(value))
{

row.style.display="";

}

else

{

row.style.display="none";

}

});

});

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
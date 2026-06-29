<?php

include("db.php");

// ---------------- TOTAL VEHICLES ----------------
$vehicle_query = mysqli_query($conn,"SELECT COUNT(*) AS total FROM vehicles");
$vehicle = mysqli_fetch_assoc($vehicle_query);

// ---------------- TOTAL USERS ----------------
$user_query = mysqli_query($conn,"SELECT COUNT(*) AS total FROM users");
$user = mysqli_fetch_assoc($user_query);

// ---------------- TOTAL BOOKINGS ----------------
$booking_query = mysqli_query($conn,"SELECT COUNT(*) AS total FROM bookings");
$booking = mysqli_fetch_assoc($booking_query);

// ---------------- TOTAL REVENUE ----------------
$revenue_query = mysqli_query($conn,"SELECT SUM(total_price) AS revenue FROM bookings");
$revenue = mysqli_fetch_assoc($revenue_query);

if(empty($revenue['revenue']))
{
    $revenue['revenue']=0;
}

// ---------------- BOOKING STATUS ----------------
$status_query = mysqli_query($conn,"
SELECT status,COUNT(*) AS total
FROM bookings
GROUP BY status
");

$status_labels=[];
$status_data=[];

while($row=mysqli_fetch_assoc($status_query))
{
    $status_labels[]=$row['status'];
    $status_data[]=$row['total'];
}

// ---------------- LATEST VEHICLES ----------------
$latest=mysqli_query($conn,"
SELECT *
FROM vehicles
ORDER BY id DESC
LIMIT 5
");

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Admin Dashboard</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link
rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{
background:#eef2f7;
margin:0;
font-family:Arial,sans-serif;
}

/* Sidebar */

.sidebar{

position:fixed;

left:0;

top:0;

width:240px;

height:100%;

background:#1f2937;

overflow:auto;

}

.sidebar h3{

color:white;

text-align:center;

padding:20px 10px;

margin:0;

border-bottom:1px solid rgba(255,255,255,.15);

}

.sidebar a{

display:block;

color:white;

padding:15px 22px;

text-decoration:none;

transition:.3s;

}

.sidebar a:hover{

background:#2563eb;

padding-left:30px;

}

/* Main */

.main{

margin-left:240px;

padding:30px;

}

/* Cards */

.stat-card{

border:none;

border-radius:18px;

box-shadow:0 10px 25px rgba(0,0,0,.08);

transition:.3s;

}

.stat-card:hover{

transform:translateY(-6px);

}

.chart-card{

background:white;

border-radius:18px;

box-shadow:0 10px 25px rgba(0,0,0,.08);

padding:25px;

margin-top:35px;

}

.chart-container{

width:320px;

height:320px;

margin:auto;

}

.table{

background:white;

border-radius:15px;

overflow:hidden;

}

</style>

</head>

<body>

<div class="sidebar">

<h3>🚗 RentEase AI</h3>

<a href="admin_dashboard.php">
<i class="bi bi-speedometer2"></i>
 Dashboard
</a>

<a href="manage_vehicles.php">
<i class="bi bi-car-front-fill"></i>
 Manage Vehicles
</a>

<a href="add_vehicle.php">
<i class="bi bi-plus-circle-fill"></i>
 Add Vehicle
</a>

<a href="manage_bookings.php">
<i class="bi bi-calendar-check-fill"></i>
 Manage Bookings
</a>

<a href="view_contacts.php">

<i class="bi bi-envelope-fill"></i>

Contact Messages

</a>

<a href="manage_users.php">
<i class="bi bi-people-fill"></i>
 Manage Users
</a>

<a href="reports.php">
<i class="bi bi-bar-chart-fill"></i>
 Reports
</a>

<a href="logout.php">
<i class="bi bi-box-arrow-right"></i>
 Logout
</a>

</div>

<div class="main">

<h1 class="fw-bold">

🚗 RentEase AI Admin Dashboard

</h1>

<p class="text-secondary">

Vehicle Rental Management System

</p>

<div class="row mt-4">

<div class="col-md-3 mb-4">

<div class="card stat-card bg-primary text-white p-4">

<h5>Total Vehicles</h5>

<h2><?php echo $vehicle['total']; ?></h2>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card stat-card bg-success text-white p-4">

<h5>Total Users</h5>

<h2><?php echo $user['total']; ?></h2>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card stat-card bg-warning p-4">

<h5>Total Bookings</h5>

<h2><?php echo $booking['total']; ?></h2>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card stat-card bg-danger text-white p-4">

<h5>Total Revenue</h5>

<h2>₹<?php echo $revenue['revenue']; ?></h2>

</div>

</div>

</div>

<!-- Quick Actions -->

<div class="card stat-card p-4 mb-4">

<h4 class="mb-3">

⚡ Quick Actions

</h4>

<a href="add_vehicle.php" class="btn btn-primary me-2 mb-2">

<i class="bi bi-plus-circle"></i>

Add Vehicle

</a>

<a href="manage_vehicles.php" class="btn btn-success me-2 mb-2">

<i class="bi bi-car-front-fill"></i>

Manage Vehicles

</a>

<a href="manage_bookings.php" class="btn btn-warning me-2 mb-2">

<i class="bi bi-calendar-check-fill"></i>

Manage Bookings

</a>

<a href="logout.php" class="btn btn-danger mb-2">

<i class="bi bi-box-arrow-right"></i>

Logout

</a>

</div>


<!-- Booking Status Chart -->

<div class="chart-card">

<h3 class="text-center mb-4">

📊 Booking Status Overview

</h3>

<div class="chart-container">

<canvas id="statusChart"></canvas>

</div>

</div>


<!-- Latest Vehicles -->

<div class="card stat-card mt-5 p-4">

<h3 class="mb-4">

🚗 Latest Vehicles

</h3>

<div class="table-responsive">

<table class="table table-hover table-bordered align-middle">

<thead class="table-dark">

<tr>

<th>ID</th>

<th>Image</th>

<th>Name</th>

<th>Brand</th>

<th>Type</th>

<th>Fuel</th>

<th>Price/Day</th>

<th>Status</th>

</tr>

</thead>

<tbody>

<?php

while($row=mysqli_fetch_assoc($latest))
{

?>

<tr>

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

height="70"

style="object-fit:cover;border-radius:10px;">

<?php

}

else

{

?>

<img

src="https://via.placeholder.com/90x70?text=No+Image"

style="border-radius:10px;">

<?php

}

?>

</td>

<td>

<?php echo $row['vehicle_name']; ?>

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

₹ <?php echo $row['price_per_day']; ?>

</td>

<td>

<?php

$status=$row['availability'];

if($status=="Available")
{

echo "<span class='badge bg-success'>Available</span>";

}

else

{

echo "<span class='badge bg-danger'>$status</span>";

}

?>

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('statusChart').getContext('2d');

new Chart(ctx, {

    type: 'doughnut',

    data: {

        labels: <?php echo json_encode($status_labels); ?>,

        datasets: [{

            label: 'Bookings',

            data: <?php echo json_encode($status_data); ?>,

            backgroundColor: [

                '#0d6efd',
                '#198754',
                '#ffc107',
                '#dc3545',
                '#6f42c1',
                '#20c997'

            ],

            borderColor: '#ffffff',

            borderWidth: 3,

            hoverOffset: 15

        }]

    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        plugins: {

            legend: {

                position: 'bottom',

                labels: {

                    padding: 20,

                    font: {

                        size: 14

                    }

                }

            }

        }

    }

});

</script>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
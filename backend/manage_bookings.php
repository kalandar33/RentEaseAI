<?php

include("db.php");

$sql="SELECT

bookings.id,

users.name,

vehicles.vehicle_name,

bookings.start_date,

bookings.end_date,

bookings.total_days,

bookings.amount,

bookings.status

FROM bookings

INNER JOIN users

ON bookings.user_id=users.id

INNER JOIN vehicles

ON bookings.vehicle_id=vehicles.id

ORDER BY bookings.id DESC";

$result=mysqli_query($conn,$sql);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Manage Bookings</title>

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

.search-box{

max-width:350px;

}

</style>

</head>

<body>

<div class="container py-5">

<div class="card">

<div class="card-body">

<div class="d-flex justify-content-between align-items-center flex-wrap mb-4">

<h2>

📅 Manage Bookings

</h2>

<div class="search-box">

<input

type="text"

id="bookingSearch"

class="form-control"

placeholder="🔍 Search Booking...">

</div>

</div>

<div class="table-responsive">

<table class="table table-hover align-middle">

<thead>

<tr>

<th>ID</th>

<th>User</th>

<th>Vehicle</th>

<th>Start Date</th>

<th>End Date</th>

<th>Total Days</th>

<th>Amount</th>

<th>Status</th>

<th>Actions</th>

</tr>

</thead>

<tbody>

<?php

while($row=mysqli_fetch_assoc($result))

{

?>

<tr class="booking-row">

<td><?php echo $row['id']; ?></td>

<td><strong><?php echo $row['name']; ?></strong></td>

<td><?php echo $row['vehicle_name']; ?></td>

<td><?php echo $row['start_date']; ?></td>

<td><?php echo $row['end_date']; ?></td>

<td><?php echo $row['total_days']; ?></td>

<td>

<strong class="text-primary">

₹<?php echo $row['amount']; ?>

</strong>

</td>

<td>

<?php

if($row['status']=="Pending")
{
echo "<span class='badge bg-warning text-dark'>Pending</span>";
}
elseif($row['status']=="Approved")
{
echo "<span class='badge bg-success'>Approved</span>";
}
elseif($row['status']=="Cancelled")
{
echo "<span class='badge bg-danger'>Cancelled</span>";
}
else
{
echo "<span class='badge bg-primary'>Completed</span>";
}

?>

</td>

<td>

<a

href="update_booking.php?id=<?php echo $row['id']; ?>&status=Approved"

class="btn btn-success btn-sm mb-1">

<i class="bi bi-check-circle-fill"></i>

</a>

<a

href="update_booking.php?id=<?php echo $row['id']; ?>&status=Cancelled"

class="btn btn-danger btn-sm mb-1">

<i class="bi bi-x-circle-fill"></i>

</a>

<a

href="update_booking.php?id=<?php echo $row['id']; ?>&status=Completed"

class="btn btn-primary btn-sm mb-1">

<i class="bi bi-flag-fill"></i>

</a>

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>

<div class="d-flex justify-content-between align-items-center mt-4 flex-wrap">

<a

href="admin_dashboard.php"

class="btn btn-primary">

<i class="bi bi-arrow-left-circle"></i>

Back to Dashboard

</a>

<a

href="manage_vehicles.php"

class="btn btn-success">

<i class="bi bi-car-front-fill"></i>

Manage Vehicles

</a>

</div>

</div>

</div>

</div>

<script>

const bookingSearch=document.getElementById("bookingSearch");

bookingSearch.addEventListener("keyup",function(){

let value=this.value.toLowerCase();

let rows=document.querySelectorAll(".booking-row");

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
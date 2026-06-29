<?php

include("db.php");

$search="";

if(isset($_GET['search']))
{
    $search=mysqli_real_escape_string($conn,$_GET['search']);
}

$sql="SELECT * FROM users
WHERE
name LIKE '%$search%'
OR
email LIKE '%$search%'
OR
phone LIKE '%$search%'
ORDER BY id DESC";

$result=mysqli_query($conn,$sql);

?>

<!DOCTYPE html>

<html>

<head>

<title>Manage Users</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{

background:linear-gradient(135deg,#eef2ff,#dbeafe,#f8fafc);

}

.card{

border:none;

border-radius:20px;

box-shadow:0 15px 35px rgba(0,0,0,.12);

}

.table{

margin-bottom:0;

}

</style>

</head>

<body>

<div class="container mt-5">

<div class="card p-4">

<div class="d-flex justify-content-between align-items-center mb-4">

<h2>

👥 Manage Users

</h2>

<a href="admin_dashboard.php"

class="btn btn-primary">

Dashboard

</a>

</div>

<form method="GET" class="mb-4">

<div class="input-group">

<input

type="text"

name="search"

class="form-control"

placeholder="Search by Name, Email or Phone"

value="<?php echo $search; ?>">

<button

class="btn btn-primary">

Search

</button>

</div>

</form>

<table class="table table-hover table-bordered">

<thead class="table-dark">

<tr>

<th>ID</th>

<th>Name</th>

<th>Email</th>

<th>Phone</th>

<th>Action</th>

</tr>

</thead>

<tbody>

<?php

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td>

<a

href="delete_user.php?id=<?php echo $row['id']; ?>"

class="btn btn-danger btn-sm"

onclick="return confirm('Delete this user?')">

<i class="bi bi-trash-fill"></i>

Delete

</a>

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>

</div>

</body>

</html>
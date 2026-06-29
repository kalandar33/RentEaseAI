<?php

include("db.php");

$sql="SELECT * FROM contact_messages ORDER BY id DESC";

$result=mysqli_query($conn,$sql);

?>

<!DOCTYPE html>

<html>

<head>

<title>Contact Messages</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{

background:#f4f6f9;

}

table{

background:white;

}

</style>

</head>

<body>

<div class="container mt-5">

<div class="d-flex justify-content-between align-items-center mb-4">

<h2>

📩 Contact Messages

</h2>

<a

href="admin_dashboard.php"

class="btn btn-primary">

⬅ Dashboard

</a>

</div>

<table class="table table-bordered table-hover shadow">

<thead class="table-dark">

<tr>

<th>ID</th>

<th>Name</th>

<th>Email</th>

<th>Subject</th>

<th>Message</th>

<th>Date</th>

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

<td><?php echo $row['subject']; ?></td>

<td style="max-width:300px">

<?php echo $row['message']; ?>

</td>

<td><?php echo $row['created_at']; ?></td>

<td>

<a

href="delete_contact.php?id=<?php echo $row['id']; ?>"

class="btn btn-danger btn-sm"

onclick="return confirm('Delete this message?')">

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

</body>

</html>
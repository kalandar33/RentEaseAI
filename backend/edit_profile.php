<?php

session_start();

include("db.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: ../frontend/login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id='$user_id'";

$result = mysqli_query($conn,$sql);

$user = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>

<html>

<head>

<title>Edit Profile</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h3>Edit Profile</h3>

</div>

<div class="card-body">

<form action="update_profile.php" method="POST">

<div class="mb-3">

<label>Name</label>

<input
type="text"
name="name"
class="form-control"
value="<?php echo $user['name']; ?>"
required>

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
value="<?php echo $user['email']; ?>"
required>

</div>

<?php if(isset($user['phone'])) { ?>

<div class="mb-3">

<label>Phone</label>

<input
type="text"
name="phone"
class="form-control"
value="<?php echo $user['phone']; ?>">

</div>

<?php } ?>

<button class="btn btn-success">

Update Profile

</button>

<a href="profile.php" class="btn btn-secondary">

Cancel

</a>

</form>

</div>

</div>

</div>

</body>

</html>
<?php

session_start();

include("db.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: ../frontend/login.html");
    exit();
}

$user_id=$_SESSION['user_id'];

$vehicle_id=$_GET['vehicle_id'];

if(isset($_POST['submit']))
{

$rating=$_POST['rating'];

$comment=$_POST['comment'];

$sql="INSERT INTO reviews(user_id,vehicle_id,rating,comment)

VALUES

('$user_id','$vehicle_id','$rating','$comment')";

if(mysqli_query($conn,$sql))
{
    echo "<script>alert('Thank you for your review!');</script>";
}

}

?>

<!DOCTYPE html>

<html>

<head>

<title>Rate Vehicle</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{

background:linear-gradient(135deg,#4f46e5,#06b6d4);

min-height:100vh;

display:flex;

justify-content:center;

align-items:center;

}

.card{

width:550px;

border:none;

border-radius:20px;

padding:30px;

box-shadow:0 15px 35px rgba(0,0,0,.25);

}

</style>

</head>

<body>

<div class="card">

<h2 class="text-center mb-4">

⭐ Vehicle Review

</h2>

<form method="POST">

<label class="form-label">

Rating

</label>

<select

name="rating"

class="form-select"

required>

<option value="">Choose Rating</option>

<option value="5">⭐⭐⭐⭐⭐ Excellent</option>

<option value="4">⭐⭐⭐⭐ Very Good</option>

<option value="3">⭐⭐⭐ Good</option>

<option value="2">⭐⭐ Fair</option>

<option value="1">⭐ Poor</option>

</select>

<br>

<label class="form-label">

Comment

</label>

<textarea

name="comment"

class="form-control"

rows="5"

placeholder="Write your experience..."

required>

</textarea>

<br>

<button

type="submit"

name="submit"

class="btn btn-primary w-100">

Submit Review

</button>

</form>

</div>

</body>

</html>
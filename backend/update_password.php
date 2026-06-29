<?php

session_start();
include("db.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: ../frontend/login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

$current = $_POST['current_password'];
$new = $_POST['new_password'];
$confirm = $_POST['confirm_password'];

if($new != $confirm)
{
    die("New Password and Confirm Password do not match.");
}

$sql = "SELECT password FROM users WHERE id='$user_id'";
$result = mysqli_query($conn,$sql);
$user = mysqli_fetch_assoc($result);

if($user['password'] != $current)
{
    die("Current Password is incorrect.");
}

$update = "UPDATE users
SET password='$new'
WHERE id='$user_id'";

if(mysqli_query($conn,$update))
{
    echo "<script>
    alert('Password Changed Successfully');
    window.location='profile.php';
    </script>";
}
else
{
    echo mysqli_error($conn);
}

?>
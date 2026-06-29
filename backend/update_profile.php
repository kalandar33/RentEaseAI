<?php

session_start();

include("db.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: ../frontend/login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

$name = $_POST['name'];
$email = $_POST['email'];

$sql = "UPDATE users
SET
name='$name',
email='$email'
WHERE id='$user_id'";

if(mysqli_query($conn,$sql))
{
    $_SESSION['name'] = $name;

    header("Location: profile.php");
    exit();
}
else
{
    echo mysqli_error($conn);
}

?>
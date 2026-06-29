<?php

include("db.php");

if(isset($_GET['id']))
{

$id = $_GET['id'];

// Delete user's bookings first (to avoid foreign key errors)
mysqli_query($conn,"DELETE FROM bookings WHERE user_id='$id'");

// Delete user's reviews
mysqli_query($conn,"DELETE FROM reviews WHERE user_id='$id'");

// Delete user
mysqli_query($conn,"DELETE FROM users WHERE id='$id'");

}

header("Location: manage_users.php");

exit();

?>
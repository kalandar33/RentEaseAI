<?php

include("db.php");

$id = $_GET['id'];
$status = $_GET['status'];

$sql = "UPDATE bookings
        SET status='$status'
        WHERE id=$id";

if(mysqli_query($conn, $sql))
{
    header("Location: manage_bookings.php");
    exit();
}
else
{
    echo mysqli_error($conn);
}

?>
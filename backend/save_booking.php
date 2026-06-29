<?php

session_start();

include("db.php");

if(!isset($_SESSION['user_id']))
{
    die("Please login first.");
}

$user_id = $_SESSION['user_id'];

$vehicle_id = $_POST['vehicle_id'];

$start_date = $_POST['start_date'];

$end_date = $_POST['end_date'];


// Get vehicle price

$sql = "SELECT price_per_day
        FROM vehicles
        WHERE id=$vehicle_id";

$result = mysqli_query($conn,$sql);

$vehicle = mysqli_fetch_assoc($result);

$price = $vehicle['price_per_day'];


// Calculate total days

$start = strtotime($start_date);

$end = strtotime($end_date);

$total_days = ($end - $start) / (60 * 60 * 24) + 1;


// Calculate amount

$amount = $price * $total_days;


// Save booking

$sql = "INSERT INTO bookings
(
user_id,
vehicle_id,
start_date,
end_date,
total_days,
amount,
total_price,
status,
booking_date
)
VALUES
(
'$user_id',
'$vehicle_id',
'$start_date',
'$end_date',
'$total_days',
'$amount',
'$amount',
'Pending',
CURDATE()
)";


if(mysqli_query($conn,$sql))
{
    $booking_id = mysqli_insert_id($conn);

    header("Location: payment.php?booking_id=".$booking_id);

    exit();
}
else
{
    echo mysqli_error($conn);
}

?>
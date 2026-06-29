<?php

include("db.php");

// Get form data
$id = $_POST['id'];
$vehicle_name = $_POST['vehicle_name'];
$brand = $_POST['brand'];
$vehicle_type = $_POST['vehicle_type'];
$fuel_type = $_POST['fuel_type'];
$price_per_day = $_POST['price_per_day'];

// Get current image
$result = mysqli_query($conn, "SELECT image FROM vehicles WHERE id='$id'");
$row = mysqli_fetch_assoc($result);

$image = $row['image'];

// Check if new image is uploaded
if(isset($_FILES['image']) && $_FILES['image']['name'] != "")
{
    $image = $_FILES['image']['name'];
    $temp = $_FILES['image']['tmp_name'];

    move_uploaded_file(
        $temp,
        "../uploads/vehicles/".$image
    );
}

// Update database
$sql = "UPDATE vehicles SET

vehicle_name='$vehicle_name',
brand='$brand',
vehicle_type='$vehicle_type',
fuel_type='$fuel_type',
price_per_day='$price_per_day',
image='$image'

WHERE id='$id'";

if(mysqli_query($conn,$sql))
{
    echo "<script>

    alert('Vehicle Updated Successfully');

    window.location='manage_vehicles.php';

    </script>";
}
else
{
    echo mysqli_error($conn);
}

?>
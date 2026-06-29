<?php

include("db.php");

// Get form data
$vehicle_name = $_POST['vehicle_name'];
$brand = $_POST['brand'];
$vehicle_type = $_POST['vehicle_type'];
$fuel_type = $_POST['fuel_type'];
$price_per_day = $_POST['price_per_day'];

// Check if image is selected
if(isset($_FILES['image']) && $_FILES['image']['error'] == 0)
{
    $image = basename($_FILES['image']['name']);
    $temp_name = $_FILES['image']['tmp_name'];

    // Upload folder
    $upload_dir = "../uploads/vehicles/";

    // Create folder if it doesn't exist
    if(!is_dir($upload_dir))
    {
        mkdir($upload_dir, 0777, true);
    }

    // Full path
    $target_file = $upload_dir . $image;

    // Move uploaded image
    if(move_uploaded_file($temp_name, $target_file))
    {
        // Save data into database
        $sql = "INSERT INTO vehicles
        (
            vehicle_name,
            brand,
            vehicle_type,
            fuel_type,
            price_per_day,
            image
        )
        VALUES
        (
            '$vehicle_name',
            '$brand',
            '$vehicle_type',
            '$fuel_type',
            '$price_per_day',
            '$image'
        )";

        if(mysqli_query($conn, $sql))
        {
            echo "<h2 style='color:green;'>Vehicle Added Successfully</h2>";

            echo "<p><strong>Uploaded Image:</strong></p>";

            echo "<img src='../uploads/vehicles/$image' width='250'><br><br>";

            echo "<a href='admin_dashboard.php'>⬅ Back To Dashboard</a>";
        }
        else
        {
            echo "<h3 style='color:red;'>Database Error</h3>";
            echo mysqli_error($conn);
        }
    }
    else
    {
        echo "<h3 style='color:red;'>Failed to upload image.</h3>";
    }
}
else
{
    echo "<h3 style='color:red;'>Please select an image.</h3>";
}

?>
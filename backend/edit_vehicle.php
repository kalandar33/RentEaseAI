<?php

include("db.php");

$id = $_GET['id'];

$sql = "SELECT * FROM vehicles WHERE id='$id'";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Vehicle</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow p-4">

<h2>Edit Vehicle</h2>

<form action="update_vehicle.php" method="POST" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<div class="mb-3">

<label class="form-label">Vehicle Name</label>

<input
type="text"
name="vehicle_name"
class="form-control"
value="<?php echo $row['vehicle_name']; ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">Brand</label>

<input
type="text"
name="brand"
class="form-control"
value="<?php echo $row['brand']; ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">Vehicle Type</label>

<select name="vehicle_type" class="form-control">

<option <?php if($row['vehicle_type']=="Scooter") echo "selected"; ?>>Scooter</option>

<option <?php if($row['vehicle_type']=="Bike") echo "selected"; ?>>Bike</option>

<option <?php if($row['vehicle_type']=="Car") echo "selected"; ?>>Car</option>

</select>

</div>

<div class="mb-3">

<label class="form-label">Fuel Type</label>

<input
type="text"
name="fuel_type"
class="form-control"
value="<?php echo $row['fuel_type']; ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">Price Per Day</label>

<input
type="number"
name="price_per_day"
class="form-control"
value="<?php echo $row['price_per_day']; ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">Current Image</label>

<br>

<?php

if(!empty($row['image']))
{

?>

<img
src="../uploads/vehicles/<?php echo rawurlencode($row['image']); ?>"
width="180">

<?php

}

?>

</div>

<div class="mb-3">

<label class="form-label">

Upload New Image (Optional)

</label>

<input
type="file"
name="image"
class="form-control">

</div>

<button
type="submit"
class="btn btn-success">

Update Vehicle

</button>

<a
href="manage_vehicles.php"
class="btn btn-secondary">

Cancel

</a>

</form>

</div>

</div>

</body>

</html>
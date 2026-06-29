<?php
include("db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Vehicles</title>

    <style>

        body{
            font-family:Arial;
            margin:40px;
            background:#f5f5f5;
        }

        h1,h2{
            text-align:center;
        }

        .search-box{
            text-align:center;
            margin-bottom:30px;
        }

        input[type=text]{
            width:300px;
            padding:10px;
        }

        button{
            padding:10px 20px;
            background:#007bff;
            color:white;
            border:none;
            cursor:pointer;
        }

        a{
            text-decoration:none;
            font-weight:bold;
            margin:10px;
        }

        .card{
            background:white;
            border:1px solid #ddd;
            padding:20px;
            margin:15px auto;
            width:450px;
            border-radius:10px;
            box-shadow:0 2px 8px rgba(0,0,0,0.1);
        }

    </style>

</head>

<body>

<h1>Search & Filter Vehicles</h1>

<hr>

<h2>Filter By Category</h2>

<div class="search-box">

<a href="search.php">All</a> |

<a href="search.php?type=Car">Car</a> |

<a href="search.php?type=Bike">Bike</a> |

<a href="search.php?type=Scooter">Scooter</a>

</div>

<hr>

<div class="search-box">

<form method="GET" action="search.php">

<input
type="text"
name="search"
placeholder="Search Vehicle Name / Brand / Type">

<button type="submit">

Search

</button>

</form>

</div>

<?php

// SEARCH

if(isset($_GET['search']))
{

$search=$_GET['search'];

$sql="SELECT * FROM vehicles
WHERE
vehicle_name LIKE '%$search%'
OR
brand LIKE '%$search%'
OR
vehicle_type LIKE '%$search%'";

$result=mysqli_query($conn,$sql);

echo "<h2>Search Results</h2>";

while($row=mysqli_fetch_assoc($result))
{

?>

<div class="card">

<h3><?php echo $row['vehicle_name']; ?></h3>

<p><b>Brand :</b> <?php echo $row['brand']; ?></p>

<p><b>Type :</b> <?php echo $row['vehicle_type']; ?></p>

<p><b>Fuel :</b> <?php echo $row['fuel_type']; ?></p>

<p><b>Price :</b> ₹<?php echo $row['price_per_day']; ?>/day</p>

</div>

<?php

}

}

// FILTER

elseif(isset($_GET['type']))
{

$type=$_GET['type'];

$sql="SELECT * FROM vehicles
WHERE vehicle_type='$type'";

$result=mysqli_query($conn,$sql);

echo "<h2>$type Vehicles</h2>";

while($row=mysqli_fetch_assoc($result))
{

?>

<div class="card">

<h3><?php echo $row['vehicle_name']; ?></h3>

<p><b>Brand :</b> <?php echo $row['brand']; ?></p>

<p><b>Type :</b> <?php echo $row['vehicle_type']; ?></p>

<p><b>Fuel :</b> <?php echo $row['fuel_type']; ?></p>

<p><b>Price :</b> ₹<?php echo $row['price_per_day']; ?>/day</p>

</div>

<?php

}

}

// SHOW ALL VEHICLES

else
{

$sql="SELECT * FROM vehicles";

$result=mysqli_query($conn,$sql);

echo "<h2>All Vehicles</h2>";

while($row=mysqli_fetch_assoc($result))
{

?>

<div class="card">

<h3><?php echo $row['vehicle_name']; ?></h3>

<p><b>Brand :</b> <?php echo $row['brand']; ?></p>

<p><b>Type :</b> <?php echo $row['vehicle_type']; ?></p>

<p><b>Fuel :</b> <?php echo $row['fuel_type']; ?></p>

<p><b>Price :</b> ₹<?php echo $row['price_per_day']; ?>/day</p>

</div>

<?php

}

}

?>

</body>

</html>
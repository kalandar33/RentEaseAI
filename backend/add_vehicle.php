<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Add Vehicle</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{

background:linear-gradient(135deg,#eef2ff,#f8fafc,#dbeafe);

min-height:100vh;

}

.card{

border:none;

border-radius:20px;

box-shadow:0 15px 35px rgba(0,0,0,.12);

}

.card-header{

background:linear-gradient(135deg,#2563eb,#7c3aed);

color:white;

padding:25px;

text-align:center;

font-size:28px;

font-weight:bold;

border-radius:20px 20px 0 0;

}

.form-control,

.form-select{

height:50px;

border-radius:12px;

}

.btn-save{

background:#2563eb;

color:white;

height:50px;

font-size:18px;

font-weight:bold;

border:none;

border-radius:12px;

transition:.3s;

}

.btn-save:hover{

background:#1d4ed8;

transform:translateY(-2px);

}

.preview{

display:none;

margin-top:15px;

max-height:220px;

border-radius:12px;

object-fit:cover;

width:100%;

}

</style>

</head>

<body>

<div class="container py-5">

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="card">

<div class="card-header">

🚗 Add New Vehicle

</div>

<div class="card-body p-4">

<form

action="save_vehicle.php"

method="POST"

enctype="multipart/form-data">

<div class="mb-3">

<label class="form-label">

Vehicle Name

</label>

<input

type="text"

name="vehicle_name"

class="form-control"

placeholder="Enter vehicle name"

required>

</div>

<div class="mb-3">

<label class="form-label">

Brand

</label>

<input

type="text"

name="brand"

class="form-control"

placeholder="Enter brand"

required>

</div>

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">

Vehicle Type

</label>

<select

name="vehicle_type"

class="form-select">

<option>Scooter</option>

<option>Bike</option>

<option>Car</option>

</select>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Fuel Type

</label>

<input

type="text"

name="fuel_type"

class="form-control"

placeholder="Petrol / Diesel / Electric"

required>

</div>

</div>

<div class="mb-3">

<label class="form-label">

Price Per Day (₹)

</label>

<input

type="number"

name="price_per_day"

class="form-control"

placeholder="Enter rental price"

required>

</div>

<div class="mb-4">

<label class="form-label">

Vehicle Image

</label>

<input

type="file"

name="image"

id="image"

class="form-control"

accept="image/*"

required>

<img

id="preview"

class="preview"

alt="Image Preview">

</div>

<div class="d-grid gap-3">

<button

type="submit"

class="btn btn-save">

<i class="bi bi-check-circle-fill"></i>

Save Vehicle

</button>

<a

href="admin_dashboard.php"

class="btn btn-outline-secondary">

<i class="bi bi-arrow-left-circle"></i>

Back to Dashboard

</a>

</div>

</form>

</div>

</div>

</div>

</div>

</div>

<script>

const imageInput=document.getElementById("image");

const preview=document.getElementById("preview");

imageInput.addEventListener("change",function(){

const file=this.files[0];

if(file)
{

preview.src=URL.createObjectURL(file);

preview.style.display="block";

}

});

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
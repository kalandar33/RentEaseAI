<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Contact Us | RentEase AI</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<style>

body{

background:linear-gradient(135deg,#eef2ff,#dbeafe,#f8fafc);

}

.contact-card{

background:white;

border:none;

border-radius:20px;

padding:40px;

box-shadow:0 15px 40px rgba(0,0,0,.12);

margin-top:50px;

}

</style>

</head>

<body>

<div class="container">

<div class="row justify-content-center">

<div class="col-md-8">

<div class="contact-card">

<h2 class="text-center mb-4">

📞 Contact RentEase AI

</h2>

<form action="../backend/contact.php" method="POST">

<div class="mb-3">

<label>Name</label>

<input

type="text"

name="name"

class="form-control"

required>

</div>

<div class="mb-3">

<label>Email</label>

<input

type="email"

name="email"

class="form-control"

required>

</div>

<div class="mb-3">

<label>Subject</label>

<input

type="text"

name="subject"

class="form-control"

required>

</div>

<div class="mb-3">

<label>Message</label>

<textarea

name="message"

class="form-control"

rows="5"

required>

</textarea>

</div>

<button

class="btn btn-primary w-100 btn-lg">

Send Message

</button>

</form>

<hr>

<div class="text-center mt-4">

<p>

<i class="bi bi-geo-alt-fill"></i>

Mangalore, Karnataka, India

</p>

<p>

<i class="bi bi-envelope-fill"></i>

support@renteaseai.com

</p>

<p>

<i class="bi bi-telephone-fill"></i>

+91 9876543210

</p>

</div>

</div>

</div>

</div>

</div>

</body>

</html>
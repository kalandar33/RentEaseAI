<!DOCTYPE html>
<html>

<head>

<title>Forgot Password</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{

background:linear-gradient(135deg,#2563eb,#7c3aed);

height:100vh;

display:flex;

justify-content:center;

align-items:center;

}

.card{

width:420px;

border:none;

border-radius:20px;

padding:30px;

box-shadow:0 15px 40px rgba(0,0,0,.25);

}

</style>

</head>

<body>

<div class="card">

<h2 class="text-center mb-4">

🔑 Forgot Password

</h2>

<form action="reset_password.php" method="POST">

<div class="mb-3">

<label>Email Address</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<button
class="btn btn-primary w-100">

Continue

</button>

</form>

<br>

<a href="../frontend/login.html">

← Back to Login

</a>

</div>

</body>

</html>
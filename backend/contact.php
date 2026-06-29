<?php

include("db.php");

if($_SERVER["REQUEST_METHOD"]=="POST")
{

$name=mysqli_real_escape_string($conn,$_POST['name']);

$email=mysqli_real_escape_string($conn,$_POST['email']);

$subject=mysqli_real_escape_string($conn,$_POST['subject']);

$message=mysqli_real_escape_string($conn,$_POST['message']);

$sql="INSERT INTO contact_messages
(name,email,subject,message)
VALUES
('$name','$email','$subject','$message')";

if(mysqli_query($conn,$sql))
{

?>

<!DOCTYPE html>

<html>

<head>

<title>Message Sent</title>

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

border:none;

border-radius:20px;

padding:40px;

max-width:600px;

text-align:center;

box-shadow:0 15px 40px rgba(0,0,0,.25);

}

</style>

</head>

<body>

<div class="card">

<h1 class="text-success">

✅ Message Sent

</h1>

<p class="mt-3">

Thank you for contacting RentEase AI.

Our team will respond to your message as soon as possible.

</p>

<a href="../index.php"

class="btn btn-primary mt-3">

Back to Home

</a>

</div>

</body>

</html>

<?php

}

else

{

echo mysqli_error($conn);

}

}

?>
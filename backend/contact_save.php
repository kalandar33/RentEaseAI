<?php

$name=$_POST['name'];

$email=$_POST['email'];

$subject=$_POST['subject'];

$message=$_POST['message'];

?>

<!DOCTYPE html>

<html>

<head>

<title>Message Sent</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="alert alert-success text-center p-5">

<h2>

✅ Thank You!

</h2>

<p>

Your message has been received successfully.

</p>

<a

href="index.php"

class="btn btn-primary">

Back to Home

</a>

</div>

</div>

</body>

</html>
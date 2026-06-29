<?php

include("db.php");

$email = $_POST['email'];

$result = mysqli_query($conn,
"SELECT * FROM users WHERE email='$email'");

?>

<!DOCTYPE html>

<html>

<head>

<title>Reset Password</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<?php

if(mysqli_num_rows($result)>0)
{

?>

<div class="alert alert-success text-center p-5">

<h3>✅ Email Found</h3>

<p>

This is a demo project.

Password reset email functionality is not implemented.

</p>

<a
href="../frontend/login.html"
class="btn btn-primary">

Back to Login

</a>

</div>

<?php

}
else
{

?>

<div class="alert alert-danger text-center p-5">

<h3>❌ Email Not Found</h3>

<a
href="forgot_password.php"
class="btn btn-secondary">

Try Again

</a>

</div>

<?php

}

?>

</div>

</body>

</html>
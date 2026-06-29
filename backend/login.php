<?php

session_start();

include("db.php");

// Allow only POST requests
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../frontend/login.html");
    exit();
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users
        WHERE email='$email'
        AND password='$password'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1)
{
    $user = mysqli_fetch_assoc($result);

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['name'] = $user['name'];

    header("Location: dashboard.php");
    exit();
}
else
{
    echo "Invalid Email or Password";
}

?>
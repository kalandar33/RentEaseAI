<?php

include("db.php");

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];

$sql = "INSERT INTO users
(name,email,phone,password)

VALUES

('$name','$email','$phone','$password')";

if(mysqli_query($conn,$sql))
{
    echo " Registration Successful";
}
else
{
    echo "Error : " . mysqli_error($conn);
}

mysqli_close($conn);

?>
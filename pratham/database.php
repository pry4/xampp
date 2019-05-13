<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$db = "sample1";

// Create connection
$con = mysqli_connect($servername, $username, $password);

// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Select Database 
mysqli_select_db($con,$db)  or die("Could connect to Database");

?>
<?php
// Database connection settings
$host = "localhost";
$user = "sa";
$password = "123Aruna@";
$database = "doa_organic";

// Create a connection to the MySQL database
$con = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

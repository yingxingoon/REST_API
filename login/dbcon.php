<?php
// Enter your Host, username, password, and database name below
$host = "localhost";
$username = "root";
$password = "password";
$database = "salarycalculator";

// Create a MySQL connection
$con = mysqli_connect($host, $username, $password, $database);

// Check the connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
?>

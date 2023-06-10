<?php
$host = "localhost";
$username = "root";
$password = "password";
$database = "salaryCalculator";

$con = mysqli_connect($host, $username, $password);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Create the schema if it doesn't exist
$query = "CREATE SCHEMA IF NOT EXISTS `salaryCalculator` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
if (!mysqli_query($con, $query)) {
    echo "Error creating schema: " . mysqli_error($con);
    exit();
}

// Select the database
if (!mysqli_select_db($con, $database)) {
    echo "Error selecting database: " . mysqli_error($con);
    exit();
}

echo "Connected to the database.";
?>

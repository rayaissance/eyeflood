<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";  // Assuming no password for XAMPP
$dbname = "flood-monitor";  // Correct database name

// Create the connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<?php


// Database connection details
$servername = "localhost";
$username = "root";  // Replace with your MySQL username
$password = "";      // Replace with your MySQL password
$dbname = "nextstep"; // Replace with your database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

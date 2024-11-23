<?php
session_start();

$servername = "localhost";
$username = "root"; // Adjust to your MySQL credentials
$password = "";
$dbname = "nextstep";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_email = mysqli_real_escape_string($conn, $_POST['admin']);
    $admin_password = mysqli_real_escape_string($conn, $_POST['admin_password']); // Fixing the POST key

    // Query to find the admin by email and password directly (no hashing)
    $sql = "SELECT * FROM admin WHERE email = '$admin_email' AND password = '$admin_password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Successful login
        $_SESSION['admin_email'] = $admin_email;
        echo "<script>alert('Login Successful!'); window.location.href='admin_dashboard.php';</script>";
    } else {
        // Invalid email or password
        echo "<script>alert('Invalid email or password! Please try again.'); window.location.href='admin.html';</script>";
    }
}

$conn->close();
?>

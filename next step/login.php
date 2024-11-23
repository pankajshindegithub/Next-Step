<?php
session_start();
require 'con.php';  // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the input from the login form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prevent SQL Injection by using prepared statements
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the user data
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Successful login, store user info in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['fullName'];
            $_SESSION['user_email'] = $user['email'];

            // Redirect to a dashboard or homepage
            header("Location: student.html");
            exit();
        } else {
            // Password is incorrect
            echo "<script>alert('Invalid email or password. Please try again.');</script>";
        }
    } else {
        // No user found with this email
        echo "<script>alert('Invalid email or password. Please try again.');</script>";
    }

    $stmt->close();
}

$conn->close();
?>

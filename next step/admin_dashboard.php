<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_email'])) {
    header("Location: admin_login.php"); // Redirect to login if not logged in
    exit();
}

$servername = "localhost";
$username = "root"; // Adjust as needed
$password = "";
$dbname = "nextstep";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch student data
$sql = "SELECT id, name, email, phone, qualification, course FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #7f6eff;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<h2>Student Registration Data</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th>Qualification</th>
        <th>Course</th>
        <th>Resume</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["phone"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["qualification"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["course"]) . "</td>";
            echo '<td><a href="retrieve.php?id=' . $row["id"] . '">Download Resume</a></td>';
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No students found.</td></tr>";
    }
    ?>
</table>

</body>
</html>

<?php
$conn->close();
?>

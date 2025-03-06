<?php
session_start();

// Debugging: Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if 'id' is set in the POST request
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    } else {
        die("Invalid ID provided.");
    }
} else {
    die("Form not submitted.");
}

// Database connection parameters
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password (usually empty)
$dbname = "personal_data_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete the record from the database
$sql = "DELETE FROM personal_data WHERE id=?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $id);
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

$stmt->close();
$conn->close();

header("Location: dashboard.php"); // Redirect back to the dashboard
exit;
?>
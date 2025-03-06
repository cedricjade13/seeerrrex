<?php
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

// Fetch data from the database
$sql = "SELECT * FROM personal_data"; // Adjust the query based on your table structure
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Data Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
            display: flex;
        }
        .sidebar {
            width: 200px;
            background-color: #333;
            color: white;
            padding: 15px;
            height: 100vh;
        }
        .sidebar h2 {
            color: #fff;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .sidebar a:hover {
            background-color: #575757;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #45a049; /* Darker green */
        }
        .edit-button {
            background-color: #2196F3; /* Blue */
        }
        .edit-button:hover {
            background-color: #0b7dda; /* Darker blue */
        }
        .delete-button {
            background-color: #f44336; /* Red */
        }
        .delete-button:hover {
            background-color: #da190b; /* Darker red */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Navigation</h2>
    <a href="index.php">Home</a>
    <a href="add_entry.php">Add New Entry</a>
    <a href="view_all.php">View All Entries</a>
    <a href="settings.php">Settings</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">
    <h1>Personal Data Management</h1>

    <!-- Button to Add New Entry -->
    <form action="index.php" method="get">
        <input type="submit" class="button" value="Add New Form">
    </form>

    <!-- Table for Personal Data -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Middle Initial</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Civil Status</th>
                <th>Nationality</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Check if there are results and display them
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row["id"]) . "</td>
                        <td>" . htmlspecialchars($row["last_name"]) . "</td>
                        <td>" . htmlspecialchars($row["first_name"]) . "</td>
                        <td>" . htmlspecialchars($row["middle_initial"]) . "</td>
                        <td>" . htmlspecialchars($row["date_of_birth"]) . "</td>
                        <td>" . htmlspecialchars($row["gender"]) . "</td>
                        <td>" . htmlspecialchars($row["civil_status"]) . "</td>
                        <td>" . htmlspecialchars($row["nationality"]) . "</td>
                        <td>
                            <form action='edit_item.php' method='get' style='display:inline;'>
                                <input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>
                                <input type='submit' class='button edit-button' value='Edit'>
                            </form>
                            <form action='delete_item.php' method='post' style='display:inline;'>
                                <input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>
                                <input type='submit' class='button delete-button' value='Delete'>
                            </form>
                            <form action='view.php' method='get' style='display:inline;'>
                                <input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>
                                <input type='submit' class='button' value='View'>
                            </form>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No entries found</td></tr>";
        }
        // Close the database connection
        $conn->close();
        ?>
        </tbody>
    </table>
</div>

</body>
</html>
<?php
// Database connection parameters
require 'config.php';
require 'conf.php';

// Fetch data from the database
$sql = "SELECT * FROM personal_data";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Data Management</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff; /* White */
            color: #000000; /* Black text */
            display: flex;
        }

        /* Header */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color:rgb(255, 255, 255); /* Red */
            color:rgb(0, 0, 0); /* White */
            padding: 15px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            z-index: 1000;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 60px;
            width: 250px;
            height: calc(100vh - 60px);
            background-color: #D32F2F; /* Red */
            color: #ffffff; /* White */
            padding: 20px;
            overflow-y: auto;
        }
        .sidebar ul {
            list-style: none;
        }
        .sidebar ul li {
            margin: 15px 0;
        }
        .sidebar ul li a {
            color: #ffffff; /* White */
            text-decoration: none;
            display: block;
            padding: 10px;
            background-color: #ffffff; /* White */
            color: #000000; /* Black text */
            border-radius: 5px;
            transition: background 0.3s;
            text-align: center;
        }
        .sidebar ul li a:hover {
            background-color: #f5f5f5; /* Light White */
        }

        /* Main Content */
        .content {
            margin-left: 270px;
            margin-top: 80px;
            padding: 20px;
            flex: 1;
            overflow-y: auto;
            height: calc(100vh - 100px);
        }

        /* Footer */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color:rgb(255, 255, 255); /* Red */
            color:rgb(0, 0, 0); /* White */
            text-align: center;
            padding: 10px;
            z-index: 1000;
        }

        /* Button Styling */
        .button {
            background-color: #D32F2F; /* Red */
            border: none;
            color: #ffffff; /* White */
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .button:hover {
            background-color: #b71c1c; /* Darker Red */
        }
        .edit-button { background-color: #ffffff; color: #000000; } /* White with Black Text */
        .edit-button:hover { background-color: #f5f5f5; } /* Light White */
        .delete-button { background-color: #D32F2F; } /* Red */
        .delete-button:hover { background-color: #b71c1c; } /* Darker Red */

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            color: #000000; /* Black text */
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #D32F2F; /* Red */
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

<!-- Header -->
<div class="header">
    Personal Data Management
</div>

<!-- Sidebar -->
<div class="sidebar">
    <ul>
        <li><a href="index.php">Dashboard</a></li>
        <li><a href="form.php">Add New Entry</a></li>
        <li><a href="index.php">View Forms</a></li>
        <li><a href="settings.php">Settings</a></li>
    </ul>
</div>

<!-- Main Content -->
<div class="content">
    <h1>Manage Your Data</h1>

    <!-- Button to Add New Entry -->
    <form action="form.php" method="get">
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
        if ($result->num_rows > 0) {
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
        $conn->close();
        ?>
        </tbody>
    </table>
</div>

<!-- Footer -->
<div class="footer">
    &copy; <?php echo date("Y"); ?> Personal Data Management System. All Rights Reserved.
</div>

</body>
</html>

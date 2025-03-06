<?php
session_start();

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

// Get the ID from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the specific data based on the ID
$sql = "SELECT * FROM personal_data WHERE id = $id"; // Adjust the query based on your needs
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Didact+Gothic&family=Lilita+One&family=Sigmar&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-size: cover;
            color: rgb(255, 255, 255);
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto;
            overflow: auto; /* Allow scrolling if content overflows */
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent background for contrast */
            padding: 20px;
            border-radius: 10px;
            max-width: 1000px; /* Increase the width of the container */
            width: 100%; /* Full width on smaller screens */
        }

        h2 {
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgb(0, 0, 0);
            margin: 10px 0;
            font-size: 50px;
            font-family: "Sigmar", serif;
            font-weight: 400;
            font-style: normal;
        }

        .section {
            margin: 20px 0; /* Space between sections */
            border: 1px solid rgb(22, 22, 22); /* Light border */
            border-radius: 5px; /* Rounded corners */
            padding: 10px; /* Padding inside the section */
            position: relative; /* Position relative for absolute positioning of the heading */
        }

        .section h3 {
            color: rgb(0, 0, 0);
            position: relative; /* Use relative positioning */
            top: 0; /* Reset top to 0 to avoid overlap */
            left: 10px; /* Align the heading with the left padding of the section */
            font-size: 25px; /* Adjust font size if needed */          
            font-family: "Lilita One", serif;
            font-weight: 400;
            font-style: normal;
        }

        .data-grid {
            display: flex;
            flex-wrap: wrap; /* Allow items to wrap to the next line */
            margin: 0; /* Remove margin to occupy all available space */
            padding: 0; /* Optional: Remove padding if needed */
            width: 100%; /* Ensure it occupies the full width of the parent */
        }

        .data-item {
            flex: 1 1 30%; /* Flex-grow, flex-shrink, and basis for responsive layout */
            margin: 5px; /* Space between items */
            padding: 10px;
            border-radius: 5px;
            background-color: rgba(238, 230, 230, 0.8); /* Light background for readability */
            color: rgb(32, 30, 30); /* Text color */
            font-size: 16px; /* Set the font size */
            font-weight: normal; /* Set the font weight (normal, bold, etc.) */
            line-height: 1.5; /* Optional: Adjust line height for better readability */
            font-family: "Didact Gothic", serif; /* Font family */
        }

        strong {
            font-family: "Anton", serif;
            font-weight: 400;
            font-style: normal;
            color: rgb(0, 0, 0); /* Color for emphasis */
        }

        .head {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .name {
            color: rgb(0, 0, 0); /* Color for subheadings */
            font-family: "Anton", serif;
            font-weight: 400;
            font-style: normal;
            font-size: 18px;
            margin-top: 0px;
            margin-bottom: 0px;
        }

        .names {
            color: rgb(0, 0, 0); /* Color for subheadings */
            font-family: "Anton", serif;
            font-weight: 400;
            font-style: normal;
            font-size: 18px;
            margin-top: 5px;
            margin-bottom: 0px;
        }

        .fa-user, .fa-hospital, .fa-house, .fa-address-card {
            display: flex;
            padding-right: 20px;
            font-size: 25px;
            color: black;
        }

        @media (max-width: 800px) {
            .data-item {
                flex: 1 1 45%; /* Adjust item width for medium screens */
            }
        }

        @media (max-width: 600px) {
            .data-item {
                flex: 1 1 100%; /* Stack items vertically on small screens */
            }
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Submitted Personal Data</h2>
    <?php if ($result->num_rows > 0): ?>
        <div class="section">
            <div class="head">
                <h3>Personal Information</h3>
                <i class="fa-solid fa-user"></i>
            </div>
            
            <div class="data-grid">
                <?php
                // Output data of the last row
                $row = $result->fetch_assoc();
                ?>
                <div class="data-item first">
                    <strong>Last Name</strong>
                    <div><?php echo htmlspecialchars($row['last_name']); ?></div>
                </div>
                <div class="data-item">
                    <strong>First Name</strong>
                    <div><?php echo htmlspecialchars($row['first_name']); ?></div>
                </div>
                <div class="data-item">
                    <strong>Middle Initial</strong>
                    <div><?php echo htmlspecialchars($row['middle_initial']); ?></div>
                </div>
                <div class="data-item first">
                    <strong>Age</strong>
                    <div><?php echo isset($row['date_of_birth']) ? (new DateTime())->diff(new DateTime($row['date_of_birth']))->y : 'N/A'; ?></div>
                </div>
                <div class="data-item">
                    <strong>Civil Status</strong>
                    <div><?php echo htmlspecialchars($row['civil_status']); ?></div>
                </div>
                <div class="data-item">
                    <strong>Sex</strong>
                    <div><?php echo htmlspecialchars($row['gender']); ?></div>
                </div>
                <div class="data-item first">
                    <strong>TIN</strong>
                    <div><?php echo htmlspecialchars($row['tax_identification_number']); ?></div>
                </div>
                <div class="data-item">
                    <strong>Nationality</strong>
                    <div><?php echo htmlspecialchars($row['nationality']); ?></div>
                </div>
                <div class="data-item">
                    <strong>Religion</strong>
                    <div><?php echo htmlspecialchars($row['religion']); ?></div>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="head">
                <h3>Place of Birth</h3>
                <i class="fa-solid fa-hospital"></i>
            </div>
            
            <div class="data-grid">
                <div class="data-item">
                    <strong>RM/FLR/Unit No. & Bldg. Name</strong>
                    <div><?php echo htmlspecialchars($row['place_of_birth_rm_flr_unit']); ?></div>
                </div>
                <div class="data-item">
                    <strong>House/Lot & Blk. No</strong>
                    <div><?php echo htmlspecialchars($row['place_of_birth_house_lot_blk']); ?></div>
                </div>
                <div class="data-item">
                    <strong>Street Name</strong>
                    <div><?php echo htmlspecialchars($row['place_of_birth_street_name']); ?></div>
                </div>
                <div class="data-item">
                    <strong>Subdivision</strong>
                    <div><?php echo htmlspecialchars($row['place_of_birth_subdivision']); ?></div>
                </div>
                <div class="data-item">
                    <strong>Barangay/District/Locality</strong>
                    <div><?php echo htmlspecialchars($row['place_of_birth_barangay']); ?></div>
                </div>
                <div class="data-item">
                    <strong>City / Municipality</strong>
                    <div><?php echo htmlspecialchars($row['place_of_birth_city']); ?></div>
                </div>
                <div class="data-item">
                    <strong>Province</strong>
                    <div><?php echo htmlspecialchars($row['place_of_birth_province']); ?></div>
                </div>
                <div class="data-item">
                    <strong>Country</strong>
                    <div><?php echo htmlspecialchars($row['place_of_birth_country']); ?></div>
                </div>
                <div class="data-item">
                    <strong>Zip Code</strong>
                    <div><?php echo htmlspecialchars($row['place_of_birth_zip_code']); ?></div>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="head">
                <h3>Home Address</h3>
                <i class="fa-solid fa-house"></i>
            </div>
            <div class="data-grid">
                <div class="data-item">
                    <strong>RM/FLR/Unit No. & Bldg. Name</strong>
                    <div><?php echo htmlspecialchars($row['home_address_rm_flr_unit']); ?></div>
                </div>
                <div class="data-item">
                    <strong>House/Lot & Blk. No</strong>
                    <div><?php echo htmlspecialchars($row['home_address_house_lot_blk']); ?></div>
                </div>
                <div class="data-item">
                    <strong>Street Name</strong>
                    <div><?php echo htmlspecialchars($row['home_address_street_name']); ?></div>
                </div>
                <div class="data-item">
                    <strong>Subdivision</strong>
                    <div><?php echo htmlspecialchars($row['home_address_subdivision']); ?></div>
                </div>
                <div class="data-item">
                    <strong>Barangay/District/Locality</strong>
                    <div><?php echo htmlspecialchars($row['home_address_barangay']); ?></div>
                </div>
                <div class="data-item">
                    <strong>City/Municipality</strong>
                    <div><?php echo htmlspecialchars($row['home_address_city']); ?></div>
                </div>
                <div class="data-item">
                    <strong>Province</strong>
                    <div><?php echo htmlspecialchars($row['home_address_province']); ?></div>
                </div>
                <div class="data-item">
                    <strong>Country</strong>
                    <div><?php echo htmlspecialchars($row['home_address_country']); ?></div>
                </div>
                <div class="data-item">
                    <strong>Zip Code</strong>
                    <div><?php echo htmlspecialchars($row['home_address_zip_code']); ?></div>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="head">
                <h3>Contact Information</h3>
                <i class="fa-solid fa-address-card"></i>
            </div>
            <div class="data-grid">
                <div class="data-item">
                    <strong>Mobile / Cellphone Number</strong>
                    <div><?php echo htmlspecialchars($row['mobile_number']); ?></div>
                </div>
                <div class="data-item">
                    <strong>E-mail Address</strong>
                    <div><?php echo htmlspecialchars($row['email_address']); ?></div>
                </div>
                <div class="data-item">
                    <strong>Telephone Number</strong>
                    <div><?php echo htmlspecialchars($row['telephone_number']); ?></div>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="head">
                <h3>Parents' Information</h3>
                <i class="fa-solid fa-user"></i>
            </div>
            <h4 class="name">Father's Name</h4>
            <div class="data-grid">
                <div class="data-item">
                    <strong>Last Name</strong>
                    <div><?php echo htmlspecialchars($row['father_last_name']); ?></div>
                </div>
                <div class="data-item">
                    <strong>First Name</strong>
                    <div><?php echo htmlspecialchars($row['father_first_name']); ?></div>
                </div>
                <div class="data-item">
                    <strong>Middle Name</strong>
                    <div><?php echo htmlspecialchars($row['father_middle_name']); ?></div>
                </div>
            </div>

            <h4 class="names">Mother's Maiden Name</h4>
            <div class="data-grid">
                <div class="data-item">
                    <strong>Last Name</strong>
                    <div><?php echo htmlspecialchars($row['mother_last_name']); ?></div>
                </div>
                <div class="data-item">
                    <strong>First Name</strong>
                    <div><?php echo htmlspecialchars($row['mother_first_name']); ?></div>
                </div>
                <div class="data-item">
                    <strong>Middle Name</strong>
                    <div><?php echo htmlspecialchars($row['mother_middle_name']); ?></div>
                </div>
            </div>
        </div>
        <?php else: ?>
        <p>No data found for the specified ID.</p>
    <?php endif; ?>

</div>

</body>
</html>
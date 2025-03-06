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
$sql = "SELECT * FROM personal_data WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Didact+Gothic&family=Lilita+One&family=Sigmar&display=swap" rel="stylesheet">

    <title>Edit Personal Data</title>
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

        input[type="submit"] {
            background-color: #ff0000; /* Red background */
            color: white; /* White text color */
            border: none; /* No border */
            padding: 10px 20px; /* Padding for top/bottom and left/right */
            text-align: center; /* Center the text */
            text-decoration: none; /* No underline */
            display: inline-block; /* Inline-block for proper spacing */
            font-size: 16px; /* Font size */
            margin: 4px 2px; /* Margin for spacing */
            cursor: pointer; /* Pointer cursor on hover */
            border-radius: 5px; /* Rounded corners */
            transition: background-color 0.3s; /* Smooth transition for hover effect */
        }

        .s{
            display: flex;
            justify-content: center;
            align-items: center;
        }

        input[type="submit"]:hover {
            background-color: rgb(189, 20, 20); /* Darker red on hover */
        }

        input[type="date"] {
            width: 100%; /* Full width */
            max-width: 250px; /* Maximum width */
            padding: 10px; /* Padding inside the input */
            border: 2px solid #0f0e0e; /* Green border */
            border-radius: 5px; /* Rounded corners */
            font-size: 16px; /* Font size */
            color: #333; /* Text color */
            background-color: #f9f9f9; /* Light background color */
            transition: border-color 0.3s, box-shadow 0.3s; /* Smooth transition for focus effect */
        }

        input[type="date"]::placeholder {
            color: #aaa; /* Placeholder text color */
            opacity: 1; /* Ensure full opacity */
        }

        input[type="date"]:focus {
            border-color: #ff0000; /* Darker green border on focus */
            box-shadow: 0 0 5px rgba(29, 31, 30, 0.5); /* Shadow effect on focus */
            outline: none; /* Remove default outline */
        }

        input[type="email"] {
            width: 100%; /* Full width */
            max-width: 250px; /* Maximum width */
            padding: 10px; /* Padding inside the input */
            border: 2px solid #0f0e0e; /* Green border */
            border-radius: 5px; /* Rounded corners */
            font-size: 16px; /* Font size */
            color: #333; /* Text color */
            background-color: #f9f9f9; /* Light background color */
            transition: border-color 0.3s, box-shadow 0.3s; /* Smooth transition for focus effect */
        }

        input[type="email"]::placeholder {
            color: #aaa; /* Placeholder text color */
            opacity: 1; /* Ensure full opacity */
        }

        input[type="email"]:focus {
            border-color: #ff0000; /* Darker green border on focus */
            outline: none; /* Remove default outline */
        }

        input[type="text"] {
            width: 100%; /* Full width */
            max-width: 250px; /* Maximum width */
            padding: 10px; /* Padding inside the input */
            border: 2px solid #0f0e0e; /* Green border */
            border-radius: 5px; /* Rounded corners */
            font-size: 16px; /* Font size */
            color: #333; /* Text color */
            background-color: #f9f9f9; /* Light background color */
            transition: border-color 0.3s, box-shadow 0.3s; /* Smooth transition for focus effect */
        }

        input[type="text"]::placeholder {
            color: #aaa; /* Placeholder text color */
            opacity: 1; /* Ensure full opacity */
        }

        input[type="text"]:focus {
            border-color: #ff0000; /* Darker green border on focus */
            outline: none; /* Remove default outline */
        }

        input[type="text"]:hover {
            border-color: #ff0000; /* Darker green border on hover */
        }

        input[type="email"]:hover {
            border-color: #ff0000; /* Darker green border on hover */
        }

        input[type="date"]:hover {
            border-color: #ff0000; /* Darker green border on hover */
        }

        .ocv{
            margin-top: 5px;
        }

        select {
            width: 100%; /* Full width */
            max-width: 275px; /* Maximum width */
            padding: 10px; /* Padding inside the select */
            border: 2px solid #0f0e0e; /* Green border */
            border-radius: 5px; /* Rounded corners */
            font-size: 16px; /* Font size */
            color: #333; /* Text color */
            background-color: #f9f9f9; /* Light background color */
            appearance: none; /* Remove default arrow */
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10"><polygon points="0,0 10,0 5,5" fill="%234CAF50"/></svg>'); /* Custom arrow */
            background-repeat: no-repeat; /* No repeat */
            background-position: right 10px center; /* Position the arrow */
            background-size: 10px; /* Size of the arrow */
            transition: border-color 0.3s, box-shadow 0.3s; /* Smooth transition for focus effect */
        }

        select:focus {
            border-color: #ff0000; /* Darker green border on focus */
            outline: none; /* Remove default outline */
        }

        select:hover {
            border-color: #ff0000; /* Darker green border on hover */
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

    <script>
        // Function to toggle the visibility of the other_civil_status input
        function toggleOtherCivilStatus() {
            var civilStatusSelect = document.getElementById('civil_status');
            var otherCivilStatusInput = document.getElementById('other_civil_status');
            if (civilStatusSelect.value === 'Others') {
                otherCivilStatusInput.style.display = 'block'; // Show the input field
            } else {
                otherCivilStatusInput.style.display = 'none'; // Hide the input field
                otherCivilStatusInput.value = ''; // Clear the input if hidden
            }
        }

        // Add event listener to the civil status dropdown
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('civil_status').addEventListener('change', toggleOtherCivilStatus);
            toggleOtherCivilStatus(); // Call it on page load to set the initial state
        });
    </script>
</head>
<body>
<div class="container">   
    <h2>Edit Personal Data</h2>
    <form action="update_item.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
        <div class="section">
        <div class="head">
                <h3>Personal Information</h3>
                <i class="fa-solid fa-user"></i>
            </div>
        <div class="data-grid">
            <div class="data-item">
                <strong>Last Name</strong>
                <div>            
                    <input type="text" name="last_name" value="<?php echo htmlspecialchars($row['last_name']); ?>" required><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>First Name</strong>
                <div>
                    <input type="text" name="first_name" value="<?php echo htmlspecialchars($row['first_name']); ?>" required><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Middle Initial</strong>
                <div>
                    <input type="text" name="middle_initial" value="<?php echo htmlspecialchars($row['middle_initial']); ?>"><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Date of Birth</strong>
                <div>
                    <input type="date" name="date_of_birth" value="<?php echo htmlspecialchars($row['date_of_birth']); ?>"><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Gender</strong>
                <div>
                    <select name="gender">
                        <option value="Male" <?php echo ($row['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo ($row['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                    </select><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Civil Status</strong>
                <div>
                    <select name="civil_status" id="civil_status">
                        <option value="" disabled selected>Select your status</option>
                        <option value="Single" <?php echo ($row['civil_status'] == 'Single') ? 'selected' : ''; ?>>Single</option>
                        <option value="Married" <?php echo ($row['civil_status'] == 'Married') ? 'selected' : ''; ?>>Married</option>
                        <option value="Widowed" <?php echo ($row['civil_status'] == 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
                        <option value="Legally Separated" <?php echo ($row['civil_status'] == 'Legally Separated') ? 'selected' : ''; ?>>Legally Separated</option>
                        <option value="Others" <?php echo ($row['civil_status'] == 'Others') ? 'selected' : ''; ?>>Others</option>
                    </select>
                    <input class="ocv" type="text" id="other_civil_status" name="other_civil_status" placeholder="Please specify" title="Please specify your civil status" value="<?php echo htmlspecialchars($row['other_civil_status']); ?>" style="display: <?php echo ($row['civil_status'] == 'Others') ? 'block' : 'none'; ?>;" />
                </div>
            </div>
            
            <div class="data-item">
                <strong>Tax Identification Number</strong>
                <div>
                    <input type="text" name="tax_identification_number" value="<?php echo htmlspecialchars($row['tax_identification_number']); ?>"><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Nationality</strong>
                <div>
                    <input type="text" name="nationality" value="<?php echo htmlspecialchars($row['nationality']); ?>"><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Religion</strong>
                <div>
                    <input type="text" name="religion" value="<?php echo htmlspecialchars($row['religion']); ?>"><br>
                </div>
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
                <strong>Place of Birth RM/FLR/Unit No. & Bldg. Name</strong>
                <div>
                    <input type="text" name="place_of_birth_rm_flr_unit" value="<?php echo htmlspecialchars($row['place_of_birth_rm_flr_unit']); ?>"><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Place of Birth House/Lot & Blk. No</strong>
                <div>
                    <input type="text" name="place_of_birth_house_lot_blk" value="<?php echo htmlspecialchars($row['place_of_birth_house_lot_blk']); ?>"><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Place of Birth Street Name</strong>
                <div>
                    <input type="text" name="place_of_birth_street_name" value="<?php echo htmlspecialchars($row['place_of_birth_street_name']); ?>"><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Place of Birth Subdivision</strong>
                <div>
                    <input type="text" name="place_of_birth_subdivision" value="<?php echo htmlspecialchars($row['place_of_birth_subdivision']); ?>"><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Place of Birth Barangay</strong>
                <div>
                    <input type="text" name="place_of_birth_barangay" value="<?php echo htmlspecialchars($row['place_of_birth_barangay']); ?>"><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Place of Birth City</strong>
                <div>
                    <input type="text" name="place_of_birth_city" value="<?php echo htmlspecialchars($row['place_of_birth_city']); ?>"><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Place of Birth Province</strong>
                <div>
                    <input type="text" name="place_of_birth_province" value="<?php echo htmlspecialchars($row['place_of_birth_province']); ?>"><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Place of Birth Country</strong>
                <div>
                    <input type="text" name="place_of_birth_country" value="<?php echo htmlspecialchars($row['place_of_birth_country']); ?>"><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Place of Birth Zip Code</strong>
                <div>
                    <input type="text" name="place_of_birth_zip_code" value="<?php echo htmlspecialchars($row['place_of_birth_zip_code']); ?>"><br>
                </div>
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
                <strong>Home Address RM/FLR/Unit No. & Bldg. Name</strong>
                <div>
                    <input type="text" name="home_address_rm_flr_unit" value="<?php echo htmlspecialchars($row['home_address_rm_flr_unit']); ?>"><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Home Address House/Lot & Blk. No</strong>
                <div>
                    <input type="text" name="home_address_house_lot_blk" value="<?php echo htmlspecialchars($row['home_address_house_lot_blk']); ?>"><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Home Address Street Name</strong>
                <div>
                    <input type="text" name="home_address_street_name" value="<?php echo htmlspecialchars($row['home_address_street_name']); ?>"><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Home Address Subdivision</strong>
                <div>
                    <input type="text" name="home_address_subdivision" value="<?php echo htmlspecialchars($row['home_address_subdivision']); ?>"><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Home Address Barangay</strong>
                <div>
                    <input type="text" name="home_address_barangay" value="<?php echo htmlspecialchars($row['home_address_barangay']); ?>"><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Home Address City</strong>
                <div>
                    <input type="text" name="home_address_city" value="<?php echo htmlspecialchars($row['home_address_city']); ?>"><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Home Address Province</strong>
                <div>
                    <input type="text" name="home_address_province" value="<?php echo htmlspecialchars($row['home_address_province']); ?>"><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Home Address Country</strong>
                <div>
                    <input type="text" name="home_address_country" value="<?php echo htmlspecialchars($row['home_address_country']); ?>"><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Home Address Zip Code</strong>
                <div>
                    <input type="text" name="home_address_zip_code" value="<?php echo htmlspecialchars($row['home_address_zip_code']); ?>"><br>
                </div>
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
                <strong>Mobile Number</strong>
                <div>
                    <input type="text" name="mobile_number" value="<?php echo htmlspecialchars($row['mobile_number']); ?>"><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Email Address</strong>
                <div>
                    <input type="email" name="email_address" value="<?php echo htmlspecialchars($row['email_address']); ?>"><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Telephone Number</strong>
                <div>
                    <input type="text" name="telephone_number" value="<?php echo htmlspecialchars($row['telephone_number']); ?>"><br>
                </div>
            </div>
        </div>
        </div>
        
        <div class="section">
        <div class="head">
                <h3>Parents' Information</h3>
                <i class="fa-solid fa-user"></i>
            </div>
        <div class="data-grid">
            <div class="data-item">
                <strong>Father's Last Name</strong>
                <div>
                    <input type="text" name="father_last_name" value="<?php echo htmlspecialchars($row['father_last_name']); ?>"><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Father's First Name</strong>
                <div>
                    <input type="text" name="father_first_name" value="<?php echo htmlspecialchars($row['father_first_name']); ?>"><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Father's Middle Name</strong>
                <div>
                    <input type="text" name="father_middle_name" value="<?php echo htmlspecialchars($row['father_middle_name']); ?>"><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Mother's Last Name</strong>
                <div>
                    <input type="text" name="mother_last_name" value="<?php echo htmlspecialchars($row['mother_last_name']); ?>"><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Mother's First Name</strong>
                <div>
                    <input type="text" name="mother_first_name" value="<?php echo htmlspecialchars($row['mother_first_name']); ?>"><br>
                </div>
            </div>
            
            <div class="data-item">
                <strong>Mother's Middle Name</strong>
                <div>
                    <input type="text" name="mother_middle_name" value="<?php echo htmlspecialchars($row['mother_middle_name']); ?>"><br>
                </div>
            </div>
        </div>
        </div>
        
        <div class="s">
            <input type="submit" value="Update">
        </div>
        
    </form>
</div>
</body>
</html>
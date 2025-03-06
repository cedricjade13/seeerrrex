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

// Get the data from the POST request
$id = $_POST['id'];
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$middle_initial = $_POST['middle_initial'];
$date_of_birth = $_POST['date_of_birth'];
$gender = $_POST['gender'];
$civil_status = $_POST['civil_status'];
$other_civil_status = $_POST['other_civil_status'];
$tax_identification_number = $_POST['tax_identification_number'];
$nationality = $_POST['nationality'];
$religion = $_POST['religion'];
$place_of_birth_rm_flr_unit = $_POST['place_of_birth_rm_flr_unit'];
$place_of_birth_house_lot_blk = $_POST['place_of_birth_house_lot_blk'];
$place_of_birth_street_name = $_POST['place_of_birth_street_name'];
$place_of_birth_subdivision = $_POST['place_of_birth_subdivision'];
$place_of_birth_barangay = $_POST['place_of_birth_barangay'];
$place_of_birth_city = $_POST['place_of_birth_city'];
$place_of_birth_province = $_POST['place_of_birth_province'];
$place_of_birth_country = $_POST['place_of_birth_country'];
$place_of_birth_zip_code = $_POST['place_of_birth_zip_code'];
$home_address_rm_flr_unit = $_POST['home_address_rm_flr_unit'];
$home_address_house_lot_blk = $_POST['home_address_house_lot_blk'];
$home_address_street_name = $_POST['home_address_street_name'];
$home_address_subdivision = $_POST['home_address_subdivision'];
$home_address_barangay = $_POST['home_address_barangay'];
$home_address_city = $_POST['home_address_city'];
$home_address_province = $_POST['home_address_province'];
$home_address_country = $_POST['home_address_country'];
$home_address_zip_code = $_POST['home_address_zip_code'];
$mobile_number = $_POST['mobile_number'];
$email_address = $_POST['email_address'];
$telephone_number = $_POST['telephone_number'];
$father_last_name = $_POST['father_last_name'];
$father_first_name = $_POST['father_first_name'];
$father_middle_name = $_POST['father_middle_name'];
$mother_last_name = $_POST['mother_last_name'];
$mother_first_name = $_POST['mother_first_name'];
$mother_middle_name = $_POST['mother_middle_name'];

// Update the database
$sql = "UPDATE personal_data SET last_name=?, first_name=?, middle_initial=?, date_of_birth=?, gender=?, civil_status=?, other_civil_status=?, tax_identification_number=?, nationality=?, religion=?, place_of_birth_rm_flr_unit=?, place_of_birth_house_lot_blk=?, place_of_birth_street_name=?, place_of_birth_subdivision=?, place_of_birth_barangay=?, place_of_birth_city=?, place_of_birth_province=?, place_of_birth_country=?, place_of_birth_zip_code=?, home_address_rm_flr_unit=?, home_address_house_lot_blk=?, home_address_street_name=?, home_address_subdivision=?, home_address_barangay=?, home_address_city=?, home_address_province=?, home_address_country=?, home_address_zip_code=?, mobile_number=?, email_address=?, telephone_number=?, father_last_name=?, father_first_name=?, father_middle_name=?, mother_last_name=?, mother_first_name=?, mother_middle_name=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssssssssssssssssssssssssssssss", 
    $last_name, $first_name, $middle_initial, $date_of_birth, $gender, $civil_status, $other_civil_status, $tax_identification_number, $nationality, $religion, 
    $place_of_birth_rm_flr_unit, $place_of_birth_house_lot_blk, $place_of_birth_street_name, $place_of_birth_subdivision, $place_of_birth_barangay, 
    $place_of_birth_city, $place_of_birth_province, $place_of_birth_country, $place_of_birth_zip_code, $home_address_rm_flr_unit, 
    $home_address_house_lot_blk, $home_address_street_name, $home_address_subdivision, $home_address_barangay, $home_address_city, 
    $home_address_province, $home_address_country, $home_address_zip_code, $mobile_number, $email_address, $telephone_number, 
    $father_last_name, $father_first_name, $father_middle_name, $mother_last_name, $mother_first_name, $mother_middle_name, $id);
$stmt->execute();

$stmt->close();
$conn->close();

header("Location: dashboard.php"); // Redirect back to the dashboard
exit;
?>
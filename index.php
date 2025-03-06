<?php
session_start();

class CountryDropdown {
    private $countries;

    public function __construct() {
        $this->countries = [
            'Afghanistan', 'Albania', 'Algeria', 'Andorra', 'Angola', 'Antigua and Barbuda', 'Argentina', 'Armenia', 'Australia', 'Austria', 'Azerbaijan', 'Bahamas', 'Bahrain', 'Bangladesh', 'Barbados', 'Belarus', 'Belgium', 'Belize', 'Benin', 'Bhutan', 'Bolivia', 'Bosnia and Herzegovina', 'Botswana', 'Brazil', 'Brunei', 'Bulgaria', 'Burkina Faso', 'Burundi', 'Cambodia', 'Cameroon', 'Canada', 'Central African Republic', 'Chad', 'Chile', 'China', 'Colombia', 'Comoros', 'Congo', 'Costa Rica', 'Côte d\'Ivoire', 'Croatia', 'Cuba', 'Cyprus', 'Czech Republic', 'Denmark', 'Djibouti', 'Dominica', 'Dominican Republic', 'Ecuador', 'Egypt', 'El Salvador', 'Equatorial Guinea', 'Eritrea', 'Estonia', 'Ethiopia', 'Fiji', 'Finland', 'France', 'Gabon', 'Gambia', 'Georgia', 'Germany', 'Ghana', 'Greece', 'Grenada', 'Guatemala', 'Guinea', 'Guinea-Bissau', 'Guyana', 'Haiti', 'Honduras', 'Hungary', 'Iceland', 'India', 'Indonesia', 'Iran', 'Iraq', 'Ireland', 'Israel', 'Italy', 'Jamaica', 'Japan', 'Jordan', 'Kazakhstan', 'Kenya', 'Kiribati', 'North Korea', 'South Korea', 'Kosovo', 'Kuwait', 'Kyrgyzstan', 'Laos', 'Latvia', 'Lebanon', 'Lesotho', 'Liberia', 'Libya', 'Lithuania', 'Luxembourg', 'Macedonia', 'Madagascar', 'Malawi', 'Malaysia', 'Maldives', 'Mali', 'Malta', 'Marshall Islands', 'Mauritania', 'Mauritius', 'Mexico', 'Micronesia', 'Moldova', 'Monaco', 'Mongolia', 'Montenegro', 'Morocco', 'Mozambique', 'Myanmar', 'Namibia', 'Nauru', 'Nepal', 'Netherlands', 'New Zealand', 'Nicaragua', 'Niger', 'Nigeria', 'Norway', 'Oman', 'Pakistan', 'Palau', 'Panama', 'Papua New Guinea', 'Paraguay', 'Peru', 'Philippines', 'Poland', 'Portugal', 'Qatar', 'Romania', 'Russia', 'Rwanda', 'Saint Kitts and Nevis', 'Saint Lucia', 'Saint Vincent and the Grenadines', 'Samoa', 'San Marino', 'Sao Tome and Principe', 'Saudi Arabia', 'Senegal', 'Serbia', 'Seychelles', 'Sierra Leone', 'Singapore', 'Sint Maarten', 'Slovakia', 'Slovenia', 'Solomon Islands', 'Somalia', 'South Africa', 'South Sudan', 'Spain', 'Sri Lanka', 'Sudan', 'Suriname', 'Swaziland', 'Sweden', 'Switzerland', 'Syria', 'Tajikistan', 'Tanzania', 'Thailand', 'Timor-Leste', 'Togo', 'Tonga', 'Trinidad and Tobago', 'Tunisia', 'Turkey', 'Turkmenistan', 'Tuvalu', 'Uganda', 'Ukraine', 'United Arab Emirates', 'United Kingdom', 'United States', 'Uruguay', 'Uzbekistan', 'Vanuatu', 'Vatican City', 'Venezuela', 'Vietnam', 'Yemen', 'Zambia', 'Zimbabwe'
        ];
    }

    public function getDropdown($selectedCountry = '', $name = 'place_of_birth_country') {
        $dropdown = '<select name="' . $name . '" id="' . $name . '">';
        $dropdown .= '<option value="" disabled ' . ($selectedCountry ? '' : 'selected') . '>Select your country</option>';
        foreach ($this->countries as $country) {
            $selected = ($country === $selectedCountry) ? 'selected' : '';
            $dropdown .= '<option value="' . $country . '" ' . $selected . '>' . $country . '</option>';
        }
        $dropdown .= '</select>';
        return $dropdown;
    }
}

class PersonalData {
    private $data;

    public function __construct() {
        $this->data = [
            'last_name' => '',
            'first_name' => '',
            'middle_initial' => '',
            'date_of_birth' => '',
            'gender' => '',
            'civil_status' => '',
            'other_civil_status' => '',
            'tax_identification_number' => '',
            'nationality' => '',
            'religion' => '',
            'place_of_birth_rm_flr_unit' => '',
            'place_of_birth_house_lot_blk' => '',
            'place_of_birth_street_name' => '',
            'place_of_birth_subdivision' => '',
            'place_of_birth_barangay' => '',
            'place_of_birth_city' => '',
            'place_of_birth_province' => '',
            'place_of_birth_country' => '',
            'place_of_birth_zip_code' => '',
            'home_address_rm_flr_unit' => '',
            'home_address_house_lot_blk' => '',
            'home_address_street_name' => '',
            'home_address_subdivision' => '',
            'home_address_barangay' => '',
            'home_address_city' => '',
            'home_address_province' => '',
            'home_address_country' => '',
            'home_address_zip_code' => '',
            'mobile_number' => '',
            'email_address' => '',
            'telephone_number' => '',
            'father_last_name' => '',
            'father_first_name' => '',
            'father_middle_name' => '',
            'mother_last_name' => '',
            'mother_first_name' => '',
            'mother_middle_name' => '',
        ];
    }

    public function setCivilStatus($civilStatus, $otherCivilStatus) {
        if ($civilStatus === 'Others' && !empty($otherCivilStatus)) {
            $this->data['civil_status'] = $otherCivilStatus; // Use the specified value
            $this->data['other_civil_status'] = $otherCivilStatus; // Save the specified value
        } else {
            $this->data['civil_status'] = $civilStatus; // Use the selected value
            $this->data['other_civil_status'] = ''; // Clear the other civil status if not used
        }
    }


    public function save() {
        // Database connection parameters
        $servername = "localhost";
        $username = "root"; // Default XAMPP username
        $password = ""; // Default XAMPP password (usually empty)
        $dbname = "personal_data_db"; // Your database name
    
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        // Check connection
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }
    
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO personal_data (last_name, first_name, middle_initial, date_of_birth, gender, civil_status, other_civil_status, tax_identification_number, nationality, religion, place_of_birth_rm_flr_unit, place_of_birth_house_lot_blk, place_of_birth_street_name, place_of_birth_subdivision, place_of_birth_barangay, place_of_birth_city, place_of_birth_province, place_of_birth_country, place_of_birth_zip_code, home_address_rm_flr_unit, home_address_house_lot_blk, home_address_street_name, home_address_subdivision, home_address_barangay, home_address_city, home_address_province, home_address_country, home_address_zip_code, mobile_number, email_address, telephone_number, father_last_name, father_first_name, father_middle_name, mother_last_name, mother_first_name, mother_middle_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
        // Check if the statement was prepared successfully
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
    
        // Bind parameters
        $stmt->bind_param("sssssssssssssssssssssssssssssssssssss", 
            $this->data['last_name'],
            $this->data['first_name'],
            $this->data['middle_initial'],
            $this->data['date_of_birth'],
            $this->data['gender'],
            $this->data['civil_status'],
            $this->data['other_civil_status'],
            $this->data['tax_identification_number'],
            $this->data['nationality'],
            $this->data['religion'],
            $this->data['place_of_birth_rm_flr_unit'],
            $this->data['place_of_birth_house_lot_blk'],
            $this->data['place_of_birth_street_name'],
            $this->data['place_of_birth_subdivision'],
            $this->data['place_of_birth_barangay'],
            $this->data['place_of_birth_city'],
            $this->data['place_of_birth_province'],
            $this->data['place_of_birth_country'],
            $this->data['place_of_birth_zip_code'],
            $this->data['home_address_rm_flr_unit'],
            $this->data['home_address_house_lot_blk'],
            $this->data['home_address_street_name'],
            $this->data['home_address_subdivision'],
            $this->data['home_address_barangay'],
            $this->data['home_address_city'],
            $this->data['home_address_province'],
            $this->data['home_address_country'],
            $this->data['home_address_zip_code'],
            $this->data['mobile_number'],
            $this->data['email_address'],
            $this->data['telephone_number'],
            $this->data['father_last_name'],
            $this->data['father_first_name'],
            $this->data['father_middle_name'],
            $this->data['mother_last_name'],
            $this->data['mother_first_name'],
            $this->data['mother_middle_name']
        );
    
        // Execute the statement
        if (!$stmt->execute()) {
            throw new Exception("Error: " . $stmt->error);
        }
    
        // Close connections
        $stmt->close();
        $conn->close();
    }

    public function getData() {
        return $this->data;
    }

    public function setData($key, $value) {
        $this->data[$key] = $value;
    }
}

$countryDropdown = new CountryDropdown();
$personalData = new PersonalData();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {

        
        // Set data from POST request
        $personalData->setData('last_name', $_POST['last_name']);
        $personalData->setData('first_name', $_POST['first_name']);
        $personalData->setData('middle_initial', $_POST['middle_initial']);
        $personalData->setData('date_of_birth', $_POST['date_of_birth']);
        $personalData->setData('gender', $_POST['gender']);

        $personalData->setCivilStatus($_POST['civil_status'], $_POST['other_civil_status']);

        $personalData->setData('tax_identification_number', $_POST['tax_identification_number']);
        $personalData->setData('nationality', $_POST['nationality']);
        $personalData->setData('religion', $_POST['religion']);
        $personalData->setData('place_of_birth_rm_flr_unit', $_POST['place_of_birth_rm_flr_unit']);
        $personalData->setData('place_of_birth_house_lot_blk', $_POST['place_of_birth_house_lot_blk']);
        $personalData->setData('place_of_birth_street_name', $_POST['place_of_birth_street_name']);
        $personalData->setData('place_of_birth_subdivision', $_POST['place_of_birth_subdivision']);
        $personalData->setData('place_of_birth_barangay', $_POST['place_of_birth_barangay']);
        $personalData->setData('place_of_birth_city', $_POST['place_of_birth_city']);
        $personalData->setData('place_of_birth_province', $_POST['place_of_birth_province']);
        $personalData->setData('place_of_birth_country', $_POST['place_of_birth_country']);
        $personalData->setData('place_of_birth_zip_code', $_POST['place_of_birth_zip_code']);
        $personalData->setData('home_address_rm_flr_unit', $_POST['home_address_rm_flr_unit']);
        $personalData->setData('home_address_house_lot_blk', $_POST['home_address_house_lot_blk']);
        $personalData->setData('home_address_street_name', $_POST['home_address_street_name']);
        $personalData->setData('home_address_subdivision', $_POST['home_address_subdivision']);
        $personalData->setData('home_address_barangay', $_POST['home_address_barangay']);
        $personalData->setData('home_address_city', $_POST['home_address_city']);
        $personalData->setData('home_address_province', $_POST['home_address_province']);
        $personalData->setData('home_address_country', $_POST['home_address_country']);
        $personalData->setData('home_address_zip_code', $_POST['home_address_zip_code']);
        $personalData->setData('mobile_number', $_POST['mobile_number']);
        $personalData->setData('email_address', $_POST['email_address']);
        $personalData->setData('telephone_number', $_POST['telephone_number']);
        $personalData->setData('father_last_name', $_POST['father_last_name']);
        $personalData->setData('father_first_name', $_POST['father_first_name']);
        $personalData->setData('father_middle_name', $_POST['father_middle_name']);
        $personalData->setData('mother_last_name', $_POST['mother_last_name']);
        $personalData->setData('mother_first_name', $_POST['mother_first_name']);
        $personalData->setData('mother_middle_name', $_POST['mother_middle_name']);

        // Call the save method
        $personalData->save();

        
        
        // Store the data in session and redirect to display.php
        $_SESSION['personalData'] = $personalData->getData();
        header("Location: display.php");
        exit;
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Didact+Gothic&family=Lilita+One&family=Sigmar&display=swap" rel="stylesheet">

    <title>Personal Data Form</title>
    <script>
        function validateForm() {
            const inputs = document.querySelectorAll("input, select");
            let allFilled = true;

            inputs.forEach(input => {
                if (!input.value.trim() && input.style.display !== 'none') { // Check only visible fields
                    allFilled = false;
                    input.style.borderColor = "red"; // Highlight empty fields
                } else {
                    input.style.borderColor = ""; // Reset border color if valid
                }
            });

            return allFilled;
        }

        function handleSubmit(event) {
            event.preventDefault();
            if (validateForm()) {
                document.getElementById('personalDataForm').submit();
            }
        }

        // Function to toggle the visibility of the other_civil_status input
        function toggleOtherCivilStatus() {
            var civilStatusSelect = document.getElementById('civil_status');
            var otherCivilStatusInput = document.getElementById('other_civil_status');
            if (civilStatusSelect.value === 'Others') {
                otherCivilStatusInput.style.display = 'block';
            } else {
                otherCivilStatusInput.style.display = 'none';
                otherCivilStatusInput.value = ''; // Clear the input if hidden
            }
        }

        // Add event listener to the civil status dropdown
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('civil_status').addEventListener('change', toggleOtherCivilStatus);
            toggleOtherCivilStatus(); // Call it on page load to set the initial state
        });

        function validateInput(input) {
            const lastNamePattern = /^[A-Za-z\s]*$/; // Pattern for last and first names
            const middleInitialPattern = /^[A-Za-z]?$/; // Pattern for middle initial

            if (input.id === 'middle_initial') {
                if (!middleInitialPattern.test(input.value)) {
                    input.setCustomValidity('Please enter only a single letter.');
                } else {
                    input.setCustomValidity('');
                }
            } else {
                if (!lastNamePattern.test(input.value)) {
                    input.setCustomValidity('Please enter only letters.');
                } else {
                    input.setCustomValidity('');
                }
            }
        }

        function validateAge(input) {
            const today = new Date();
            const selectedDate = new Date(input.value);
            const age = today.getFullYear() - selectedDate.getFullYear();
            const monthDiff = today.getMonth() - selectedDate.getMonth();
            
            // Check if the user is under 18
            if (age < 18 || (age === 18 && monthDiff < 0) || (age === 18 && monthDiff === 0 && today.getDate() < selectedDate.getDate())) {
                input.setCustomValidity('You must be at least 18 years old.');
            } else {
                input.setCustomValidity('');
            }
        }

        // Attach the validation function to the date input
        window.onload = function() {
            const dateInput = document.getElementById('date_of_birth');
            dateInput.oninput = function() {
                validateAge(this);
            };
        };

        function validateTIN(input) {
            const tinPattern = /^\d*$/; // Pattern to allow only digits

            if (!tinPattern.test(input.value)) {
                input.setCustomValidity('Please enter only numbers.');
            } else {
                input.setCustomValidity('');
            }
        }

        function validateZipCode(input) {
            const zipCodePattern = /^\d*$/; // Pattern to allow only digits

            if (!zipCodePattern.test(input.value)) {
                input.setCustomValidity('Please enter only numbers.');
            } else {
                input.setCustomValidity('');
            }
        }

        function validateMobileNumber(input) {
            const mobilePattern = /^\d{11,15}$/; // Pattern to allow only 11 to 15 digits

            if (!mobilePattern.test(input.value)) {
                input.setCustomValidity('Please enter a valid mobile number (11 to 15 digits).');
            } else {
                input.setCustomValidity('');
            }
        }

        function validateEmail(input) {
            // Regular expression for validating email format
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            if (!emailPattern.test(input.value)) {
                input.setCustomValidity('Please enter a valid email address.');
            } else {
                input.setCustomValidity('');
            }
        }
    </script>
</head>
<body>
<div>   
    <div class="container">
    
    <h2>Personal Data Form</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <div style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form id="personalDataForm" action="" method="POST" onsubmit="handleSubmit(event)">
        <div class="section">
            <div class="head">
                <h3>Personal Information</h3>
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="data-grid">
                <div class="data-item">
                    <strong for="last_name">Last Name</strong>
                    <div>
                        <input type="text" id="last_name" name="last_name" placeholder="Last Name" title="Enter your last name" autocomplete="family-name" 
                            value="<?php echo htmlspecialchars($personalData->getData()['last_name']); ?>" 
                            oninput="validateInput(this);">
                    </div>
                </div>
                <div class="data-item">
                    <strong for="first_name">First Name</strong>
                    <div>
                        <input type="text" id="first_name" name="first_name" placeholder="First Name" title="Enter your first name" autocomplete="given-name" 
                            value="<?php echo htmlspecialchars($personalData->getData()['first_name']); ?>" 
                            oninput="validateInput(this);">
                    </div>
                </div>
                <div class="data-item">
                    <strong for="middle_initial">Middle Initial</strong>
                    <div>
                        <input type="text" id="middle_initial" name="middle_initial" placeholder="Middle Initial" title="Enter your middle initial" autocomplete="additional-name" 
                            value="<?php echo htmlspecialchars($personalData->getData()['middle_initial']); ?>" 
                            oninput="validateInput(this);">
                    </div>
                </div>
                <div class="data-item">
                    <strong for="date_of_birth">Date Of Birth</strong>
                    <div>
                        <input type="date" id="date_of_birth" name="date_of_birth" title="Select your date of birth" 
                            value="<?php echo htmlspecialchars($personalData->getData()['date_of_birth']); ?>" 
                            min="" oninput="validateAge(this);">
                    </div>
                </div>
                <div class="data-item">
                    <strong for="civil_status">Civil Status</strong>
                    <div>
                        <select name="civil_status" id="civil_status">
                            <option value="" disabled selected>Select your status</option>
                            <option value="Single" <?php echo $personalData->getData()['civil_status'] == 'Single' ? 'selected' : ''; ?>>Single</option>
                            <option value="Married" <?php echo $personalData->getData()['civil_status'] == 'Married' ? 'selected' : ''; ?>>Married</option>
                            <option value="Widowed" <?php echo $personalData->getData()['civil_status'] == 'Widowed' ? 'selected' : ''; ?>>Widowed</option>
                            <option value="Legally Separated" <?php echo $personalData->getData()['civil_status'] == 'Legally Separated' ? 'selected' : ''; ?>>Legally Separated</option>
                            <option value="Others" <?php echo $personalData->getData()['civil_status'] == 'Others' ? 'selected' : ''; ?>>Others</option>
                        </select>
                        <input class ="ocv" type="text" id="other_civil_status" name="other_civil_status" placeholder="Please specify" title="Please specify your civil status" value="<?php echo htmlspecialchars($personalData->getData()['other_civil_status']); ?>" style="display: <?php echo $personalData->getData()['civil_status'] == 'Others' ? 'block' : 'none'; ?>;" />
                    </div>
                </div>
                <div class="data-item">
                    <strong>Sex</strong>
                    <div>
                        <input type="radio" name="gender" value="Male" <?php echo $personalData->getData()['gender'] == 'Male' ? 'checked' : ''; ?>> Male
                        <input type="radio" name="gender" value="Female" <?php echo $personalData->getData()['gender'] == 'Female' ? 'checked' : ''; ?>> Female
                    </div>
                </div>
                <div class="data-item">
                    <strong for="tax_identification_number">TIN</strong>
                    <div>
                        <input type="text" id="tax_identification_number" name="tax_identification_number" placeholder="TIN" title="Enter your Tax Identification Number" 
                            value="<?php echo htmlspecialchars($personalData->getData()['tax_identification_number']); ?>" 
                            oninput="validateTIN(this);" pattern="^\d*$" required>
                    </div>
                </div>
                <div class="data-item">
                    <strong for="nationality">Nationality</strong>
                <div>
                        <input type="text" id="nationality" name="nationality" placeholder="Nationality" title="Enter your nationality" value="<?php echo htmlspecialchars($personalData->getData()['nationality']); ?>">
                    </div>
                </div>
                <div class="data-item">
                    <strong for="religion">Religion</strong>
                    <div>
                        <input type="text" id="religion" name="religion" placeholder="Religion" title="Enter your religion" value="<?php echo htmlspecialchars($personalData->getData()['religion']); ?>">
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
                    <strong for="place_of_birth_rm_flr_unit">RM/FLR/Unit No. & Bldg. Name</strong>
                    <div>
                        <input type="text" id="place_of_birth_rm_flr_unit" name="place_of_birth_rm_flr_unit" placeholder="RM/FLR/Unit No. & Bldg. Name" title="Enter RM/FLR/Unit No. & Bldg. Name" value="<?php echo htmlspecialchars($personalData->getData()['place_of_birth_rm_flr_unit']); ?>">
                    </div>
                </div>
                <div class="data-item">
                    <strong for="place_of_birth_house_lot_blk">House/Lot & Blk. No</strong>
                    <div>
                        <input type="text" id="place_of_birth_house_lot_blk" name="place_of_birth_house_lot_blk" placeholder="House/Lot & Blk. No" title="Enter House/Lot & Blk. No" value="<?php echo htmlspecialchars($personalData->getData()['place_of_birth_house_lot_blk']); ?>">
                    </div>
                </div>
                <div class="data-item">
                    <strong for="place_of_birth_street_name">Street Name</strong>
                    <div>
                        <input type="text" id="place_of_birth_street_name" name="place_of_birth_street_name" placeholder="Street Name" title="Enter Street Name" value="<?php echo htmlspecialchars($personalData->getData()['place_of_birth_street_name']); ?>">
                    </div>
                </div>
                <div class="data-item">
                    <strong for="place_of_birth_subdivision">Subdivision</strong>
                    <div>
                        <input type="text" id="place_of_birth_subdivision" name="place_of_birth_subdivision" placeholder="Subdivision" title="Enter Subdivision" value="<?php echo htmlspecialchars($personalData->getData()['place_of_birth_subdivision']); ?>">
                    </div>
                </div>
                <div class="data-item">
                    <strong for="place_of_birth_barangay">Barangay/District/Locality</strong>
                    <div>
                        <input type="text" id="place_of_birth_barangay" name="place_of_birth_barangay" placeholder="Barangay/District/Locality" title="Enter Barangay/District/Locality" value="<?php echo htmlspecialchars($personalData->getData()['place_of_birth_barangay']); ?>">
                    </div>
                </div>
                <div class="data-item">
                    <strong for="place_of_birth_city">City/Municipality</strong>
                    <div>
                        <input type="text" id="place_of_birth_city" name="place_of_birth_city" placeholder="City/Municipality" title="Enter City/Municipality" value="<?php echo htmlspecialchars($personalData->getData()['place_of_birth_city']); ?>">
                    </div>
                </div>
                <div class="data-item">
                    <strong for="place_of_birth_province">Province</strong>
                    <div>
                        <input type="text" id="place_of_birth_province" name="place_of_birth_province" placeholder="Province" title="Enter Province" value="<?php echo htmlspecialchars($personalData->getData()['place_of_birth_province']); ?>">
                    </div>
                </div>
                <div class="data-item">
                    <strong for="place_of_birth_country">Country</strong>
                    <div>
                        <?php echo $countryDropdown->getDropdown($personalData->getData()['place_of_birth_country'], 'place_of_birth_country'); ?>
                    </div>
                </div>
                <div class="data-item">
                    <strong for="place_of_birth_zip_code">Zip Code</strong>
                    <div>
                        <input type="text" id="place_of_birth_zip_code" name="place_of_birth_zip_code" placeholder="Zip Code" title="Enter Zip Code" 
                            value="<?php echo htmlspecialchars($personalData->getData()['place_of_birth_zip_code']); ?>" 
                            oninput="validateZipCode(this);" pattern="^\d*$" required>
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
                    <strong for="home_address_rm_flr_unit">RM/FLR/Unit No. & Bldg. Name</strong>
                    <div>
                        <input type="text" id="home_address_rm_flr_unit" name="home_address_rm_flr_unit" placeholder="RM/FLR/Unit No. & Bldg. Name" title="Enter RM/FLR/Unit No. & Bldg. Name" value="<?php echo htmlspecialchars($personalData->getData()['home_address_rm_flr_unit']); ?>">
                    </div>
                </div>
                <div class="data-item">
                    <strong for="home_address_house_lot_blk">House/Lot & Blk. No</strong>
                    <div>
                        <input type="text" id="home_address_house_lot_blk" name="home_address_house_lot_blk" placeholder="House/Lot & Blk. No" title="Enter House/Lot & Blk. No" value="<?php echo htmlspecialchars($personalData->getData()['home_address_house_lot_blk']); ?>">
                    </div>
                </div>
                <div class="data-item">
                    <strong for="home_address_street_name">Street Name</strong>
                    <div>
                        <input type="text" id="home_address_street_name" name="home_address_street_name" placeholder="Street Name" title="Enter Street Name" value="<?php echo htmlspecialchars($personalData->getData()['home_address_street_name']); ?>">
                    </div>
                </div>
                <div class="data-item">
                    <strong for="home_address_subdivision">Subdivision</strong>
                    <div>
                        <input type="text" id="home_address_subdivision" name="home_address_subdivision" placeholder="Subdivision" title="Enter Subdivision" value="<?php echo htmlspecialchars($personalData->getData()['home_address_subdivision']); ?>">
                    </div>
                </div>
                <div class="data-item">
                    <strong for="home_address_barangay">Barangay/District/Locality</strong>
                    <div>
                        <input type="text" id="home_address_barangay" name="home_address_barangay" placeholder="Barangay/District/Locality" title="Enter Barangay/District/Locality" value="<?php echo htmlspecialchars($personalData->getData()['home_address_barangay']); ?>">
                    </div>
                </div>
                <div class="data-item">
                    <strong for="home_address_city">City/Municipality</strong>
                    <div>
                        <input type="text" id="home_address_city" name="home_address_city" placeholder="City/Municipality" title="Enter City/Municipality" value="<?php echo htmlspecialchars($personalData->getData()['home_address_city']); ?>">
                    </div>
                </div>
                <div class="data-item">
                    <strong for="home_address_province">Province</strong>
                    <div>
                        <input type="text" id="home_address_province" name="home_address_province" placeholder="Province" title="Enter Province" value="<?php echo htmlspecialchars($personalData->getData()['home_address_province']); ?>">
                    </div>
                </div>
                <div class="data-item">
                    <strong for="home_address_country">Country</strong>
                    <div>
                        <?php echo $countryDropdown->getDropdown($personalData->getData()['home_address_country'], 'home_address_country'); ?>
                    </div>
                </div>
                <div class="data-item">
                    <strong for="home_address_zip_code">Zip Code</strong>
                    <div>
                        <input type="text" id="home_address_zip_code" name="home_address_zip_code" placeholder="Zip Code" title="Enter Zip Code" 
                            value="<?php echo htmlspecialchars($personalData->getData()['home_address_zip_code']); ?>" 
                            oninput="validateZipCode(this);" pattern="^\d*$" required>
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
                    <strong for="mobile_number">Mobile / Cellphone Number</strong>
                    <div>
                        <input type="text" id="mobile_number" name="mobile_number" placeholder="Mobile / Cellphone Number" title="Enter your mobile number" 
                            value="<?php echo htmlspecialchars($personalData->getData()['mobile_number']); ?>" 
                            oninput="validateMobileNumber(this);" pattern="^\d{11,15}$" required>
                    </div>
                </div>
                <div class="data-item">
                    <strong for="email_address">E-mail Address</strong>
                    <div>
                        <input type="email" id="email_address" name="email_address" placeholder="E-mail Address" title="Enter your email address" 
                            value="<?php echo htmlspecialchars($personalData->getData()['email_address']); ?>" 
                            oninput="validateEmail(this);" required>
                    </div>
                </div>
                <div class="data-item">
                    <strong for="telephone_number">Telephone Number</strong>
                    <div>
                        <input type="text" id="telephone_number" name="telephone_number" placeholder="Telephone Number" title="Enter your telephone number" value="<?php echo htmlspecialchars($personalData->getData()['telephone_number']); ?>">
                    </div>
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
                    <strong for="father_last_name">Last Name</strong>
                    <div>
                        <input type="text" id="father_last_name" name="father_last_name" placeholder="Father's Last Name" title="Enter your father's last name" 
                            value="<?php echo htmlspecialchars($personalData->getData()['father_last_name']); ?>" 
                            oninput="validateInput(this);">
                    </div>
                </div>
                <div class="data-item">                            
                    <strong for="father_first_name">First Name</strong>
                    <div>
                        <input type="text" id="father_first_name" name="father_first_name" placeholder="Father's First Name" title="Enter your father's first name" 
                            value="<?php echo htmlspecialchars($personalData->getData()['father_first_name']); ?>" 
                            oninput="validateInput(this);">
                    </div>
                </div>
                <div class="data-item">
                    <strong for="father_middle_name">Middle Name</strong>
                    <div>
                        <input type="text" id="father_middle_name" name="father_middle_name" placeholder="Father's Middle Name" title="Enter your father's middle name" 
                            value="<?php echo htmlspecialchars($personalData->getData()['father_middle_name']); ?>" 
                            oninput="validateInput(this);">
                    </div>
                </div>
            </div>

            <h4 class="names">Mother's Maiden Name</h4>
            <div class="data-grid">
                <div class="data-item">
                    <strong for="mother_last_name">Last Name</strong>
                    <div>
                        <input type="text" id="mother_last_name" name="mother_last_name" placeholder="Mother's Last Name" title="Enter your mother's last name" 
                            value="<?php echo htmlspecialchars($personalData->getData()['mother_last_name']); ?>" 
                            oninput="validateInput(this);">
                    </div>
                </div>
                <div class="data-item">
                    <strong for="mother_first_name">First Name</strong>
                    <div>
                        <input type="text" id="mother_first_name" name="mother_first_name" placeholder="Mother's First Name" title="Enter your mother's first name" 
                            value="<?php echo htmlspecialchars($personalData->getData()['mother_first_name']); ?>" 
                            oninput="validateInput(this);">
                    </div>
                </div>
                <div class="data-item">
                    <strong for="mother_middle_name">Middle Name</strong>
                    <div>
                        <input type="text" id="mother_middle_name" name="mother_middle_name" placeholder="Mother's Middle Name" title="Enter your mother's middle name" 
                            value="<?php echo htmlspecialchars($personalData->getData()['mother_middle_name']); ?>" 
                            oninput="validateInput(this);">
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="button">
            <button type="submit">Submit</button>
        </div>
    
</form>

    <div id="output"></div>

    
</div>
</body>
</html>
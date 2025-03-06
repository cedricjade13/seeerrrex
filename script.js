
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
 
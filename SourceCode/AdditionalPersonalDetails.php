<?php
session_start();
// Check if user ID is not set in session
if (!isset($_SESSION['user_id'])) {
    // Redirect to LoginPage.php
    header("Location: LoginPage.php");
    exit; // Stop further execution
}
// Check if the user ID is set in the session
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
} else {
    // If user ID is not set, set it to 0
    $userId = 0;
}

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bgverification";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables with default values
$townOfBirth = $countryOfBirth = $nationality = $mothersMaidenFamilyname = $ukNationalInsuranceNumber = $passport = $countryOfPassportIssue = $drivingLicence = $countryOfDrivingLicenceIssue = $nationalInsuranceNumber = $drivingLicenceNumber = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $townOfBirth = $conn->real_escape_string($_POST['townOfBirth']);
    $countryOfBirth = $conn->real_escape_string($_POST['countryOfBirth']);
    $nationality = $conn->real_escape_string($_POST['nationality']);
    $mothersMaidenFamilyname = $conn->real_escape_string($_POST['mothersMaidenFamilyname']);
    $ukNationalInsuranceNumber = isset($_POST['ukNationalInsuranceNumber']) ? 'yes' : 'no';
    $passport = isset($_POST['passport']) ? 'yes' : 'no';
    $countryOfPassportIssue = $conn->real_escape_string($_POST['countryOfPassportIssue']);
    $drivingLicence = isset($_POST['drivingLicence']) ? 'yes' : 'no';
    $countryOfDrivingLicenceIssue = $conn->real_escape_string($_POST['countryOfDrivingLicenceIssue']);
    $drivingLicenceNumber = $conn->real_escape_string($_POST['drivingLicenceNumber']);
	$nationalInsuranceNumber = $conn->real_escape_string($_POST['nationalInsuranceNumber']);

    // Check if the user ID is valid (not equal to 0)
    if ($userId != 0) {
        // Check if the user already has additional personal details in the database
        $sql_check_user = "SELECT * FROM additionalpersonaldetails WHERE UserId = $userId";
        $result = $conn->query($sql_check_user);
        if ($result->num_rows > 0) {
            // Update existing additional personal details
            $sql_update = "UPDATE additionalpersonaldetails SET TownOfBirth = '$townOfBirth', CountryOfBirth = '$countryOfBirth', Nationality = '$nationality', MothersMaidenFamilyName = '$mothersMaidenFamilyname', UKNationalInsuranceNumber = '$ukNationalInsuranceNumber', Passport = '$passport', CountryOfPassportIssue = '$countryOfPassportIssue', DrivingLicence = '$drivingLicence', CountryOfDrivingLicenceIssue = '$countryOfDrivingLicenceIssue', DrivingLicenceNumber = '$drivingLicenceNumber', NationalInsuranceNumber = '$nationalInsuranceNumber' WHERE UserId = $userId";
            if ($conn->query($sql_update) === TRUE) {
                $message = "Personal Details Updated Successfully";                
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            // Insert new additional personal details
            $sql_insert = "INSERT INTO additionalpersonaldetails (UserId, TownOfBirth, CountryOfBirth, Nationality, MothersMaidenFamilyName, UKNationalInsuranceNumber, Passport, CountryOfPassportIssue, DrivingLicence, CountryOfDrivingLicenceIssue, DrivingLicenceNumber, NationalInsuranceNumber) VALUES ($userId, '$townOfBirth', '$countryOfBirth', '$nationality', '$mothersMaidenFamilyname', '$ukNationalInsuranceNumber', '$passport', '$countryOfPassportIssue', '$drivingLicence', '$countryOfDrivingLicenceIssue', '$drivingLicenceNumber','$nationalInsuranceNumber')";
            if ($conn->query($sql_insert) === TRUE) {
                $message = "Personal Details Saved Successfully";                
            } else {
                echo "Error inserting record: " . $conn->error;
            }
        }
    } else {
        echo "Invalid user ID.";
    }
}

// Fetch data from the database if user ID is valid
if ($userId != 0) {
    $sql_fetch_user = "SELECT * FROM additionalpersonaldetails WHERE UserId = $userId";
    $result = $conn->query($sql_fetch_user);
    if ($result->num_rows > 0) {
        // Fetch data and store it in variables
        $row = $result->fetch_assoc();
        $townOfBirth = $row['TownOfBirth'];
        $countryOfBirth = $row['CountryOfBirth'];
        $nationality = $row['Nationality'];
        $mothersMaidenFamilyname = $row['MothersMaidenFamilyName'];
        $ukNationalInsuranceNumber = $row['UKNationalInsuranceNumber'];
        $passport = $row['Passport'];
        $countryOfPassportIssue = $row['CountryOfPassportIssue'];
        $drivingLicence = $row['DrivingLicence'];
        $countryOfDrivingLicenceIssue = $row['CountryOfDrivingLicenceIssue'];
        $drivingLicenceNumber = $row['DrivingLicenceNumber'];
		$nationalInsuranceNumber = $row['NationalInsuranceNumber'];
    } 
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Personal Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .form-group {
            flex: 0 0 calc(50% - 10px);
            margin-bottom: 10px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        .checkbox-label {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .checkbox-label input[type="checkbox"] {
            margin-right: 5px;
        }
        .button-container {
            ddisplay: flex;
            justify-content: flex-start; /* Align buttons to the right */
            margin-top: 20px;
            // width: 100%; /* Make the button container full width */
            // box-sizing: border-box; /* Include padding and border in width calculation */
            // padding-right: 20px;
        }
        input[type="submit"],
        #nextButton,
        #previousButton {
            width: auto; /* Adjusted width */
            padding: 8px; /* Decreased padding */
            border: none;
            border-radius: 3px;
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 14px; /* Decreased font size */
            margin-left: 5px; /* Added margin to separate buttons */
			padding-right: 10px;
        }
        input[type="submit"]:hover,
        #nextButton:hover {
            background-color: #45a049;
        }
        .message {
            margin-top: 20px;
            padding: 10px;
            background-color: #dff0d8;
            border: 1px solid #d6e9c6;
            color: #3c763d;
            border-radius: 3px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Additional Personal Details</h2>
        <!-- Display the message if set -->
        <?php if(!empty($message)): ?>
            <div class="message" id="successMessage"><?php echo $message; ?></div>
        <?php endif; ?>
        <form action="AdditionalPersonalDetails.php" method="post">
            <div class="form-group">
                <label for="townOfBirth">Town of Birth:</label>
                <input type="text" id="townOfBirth" name="townOfBirth" value="<?php echo htmlspecialchars($townOfBirth); ?>" required>
            </div>
            <div class="form-group">
                <label for="countryOfBirth">Country of Birth:</label>
                <input type="text" id="countryOfBirth" name="countryOfBirth" value="<?php echo htmlspecialchars($countryOfBirth); ?>" required>
            </div>
            <div class="form-group">
                <label for="nationality">Nationality:</label>
                <input type="text" id="nationality" name="nationality" value="<?php echo htmlspecialchars($nationality); ?>" required>
            </div>
            <div class="form-group">
                <label for="mothersMaidenFamilyname">Mother’s Maiden Familyname:</label>
                <input type="text" id="mothersMaidenFamilyname" name="mothersMaidenFamilyname" value="<?php echo htmlspecialchars($mothersMaidenFamilyname); ?>" required>
            </div>
            <div class="form-group checkbox-label">
                <input type="checkbox" id="ukNationalInsuranceNumber" name="ukNationalInsuranceNumber" value="1" <?php echo $ukNationalInsuranceNumber == 1 ? 'checked' : ''; ?>>
                <label for="ukNationalInsuranceNumber">Do you have a UK National Insurance Number?</label>
            </div>
			<div class="form-group">
                <label for="nationalInsuranceNumber">National Insurance Number:</label>
                <input type="text" id="nationalInsuranceNumber" name="nationalInsuranceNumber" value="<?php echo htmlspecialchars($nationalInsuranceNumber); ?>">
            </div>
            <div class="form-group checkbox-label">
                <input type="checkbox" id="passport" name="passport" value="1" <?php echo $passport == 1 ? 'checked' : ''; ?>>
                <label for="passport">Do you have a Passport?</label>
            </div>
            <div class="form-group">
                <label for="countryOfPassportIssue">Country of Passport Issue:</label>
                <input type="text" id="countryOfPassportIssue" name="countryOfPassportIssue" value="<?php echo htmlspecialchars($countryOfPassportIssue); ?>">
            </div>
            <div class="form-group checkbox-label">
                <input type="checkbox" id="drivingLicence" name="drivingLicence" value="1" <?php echo $drivingLicence == 1 ? 'checked' : ''; ?>>
                <label for="drivingLicence">Do you have a Driving Licence?</label>
            </div>
            <div class="form-group">
                <label for="countryOfDrivingLicenceIssue">Country of Driving Licence Issue:</label>
                <input type="text" id="countryOfDrivingLicenceIssue" name="countryOfDrivingLicenceIssue" value="<?php echo htmlspecialchars($countryOfDrivingLicenceIssue); ?>">
            </div>
            <div class="form-group">
                <label for="drivingLicenceNumber">Driving Licence Number:</label>
                <input type="text" id="drivingLicenceNumber" name="drivingLicenceNumber" value="<?php echo htmlspecialchars($drivingLicenceNumber); ?>">
            </div>
            <div class="button-container">
                <button type="button" id="previousButton" onclick="window.location.href='PersonalDetails.php';">Previous</button>
                <input type="submit" value="Submit">
                <button type="button" id="nextButton" onclick="window.location.href='AddressHistory.php';">Next</button>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var messageDiv = document.getElementById('successMessage');
            // Hide message after 5 seconds
            setTimeout(function() {
                messageDiv.style.display = 'none';
            }, 5000);
        });
    </script>
</body>
</html>


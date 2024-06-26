<?php
session_start();
// Check if user ID is not set in session
if (!isset($_SESSION['user_id'])) {
    // Redirect to LoginPage.php
    header("Location: LoginPage.php");
    exit; // Stop further executionff
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
    <link href="personaldetailsform-style.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            /* background-color: #333;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            position: fixed; */
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            position: fixed;
            top: 0;
            width: 100%;
            display: flex;
        }

        header img {
            width: 40px;
            margin-right: 20px;
        }

        header h1 {
            margin: 0;
            font-size: 28px;
        }

        nav {
            background-color: #444;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            position: fixed;
            top: 10%;
            width: 100%;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
        }

        nav a {
            text-decoration: none;
            color: #fff;
            padding: 10px 0;
            margin: 0 5px;
            border-radius: 5px;
            background-color: #555;
            transition: background-color 0.3s;
            flex-grow: 1;
            max-width: calc(100% / 5 - 10px); /* Adjust according to the number of links */
        }

        nav a:hover {
            background-color: #777;
        }

         .container {
             margin: 20px auto;
             padding: 80px;
             width: 86%;
             max-width: 1200px;
             background-color: #fff;
             border-radius: 10px;
             box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
         }

        .logout-btn {
            background-color: #f00;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #900;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body class="additionalpersonaldetails">
<header>
        <img src="Accenture.Jpg" alt="Company Logo">
        <h1>Background Verification</h1>
    </header>
    <nav>
        <a href="#" onclick="window.location.href='PersonalDetails.php';">Personal Details</a>
        <a href="#" onclick="window.location.href='AdditionalPersonalDetails.php';">Additional Personal Details</a>
        <a href="#" onclick="window.location.href='AddressHistory.php';">Address History</a>
        <a href="#" onclick="window.location.href='EmploymentHistory.php';">Employment History</a>
        <a href="#" onclick="window.location.href='Qualifications.php';">Qualifications</a>
        <button class="logout-btn" onclick="window.location.href='LogOut.php';">Logout</button>
    </nav>
    <div class="container">
    <!-- <div class="button-top">
        <form method="post" >            
            <button type="submit" name="logout" id="logout">Log Out</button>
        </form> 
        </div>-->
       
        <h2>Additional Personal Details</h2>      
        <!-- Display the message if set -->
        <?php if(!empty($message)): ?>
            <div class="message" id="successMessage"><?php echo $message; ?></div>
        <?php endif; ?>
        <form action="AdditionalPersonalDetails.php" method="post">
            <div class="form-group">
                <label for="townOfBirth">Town of Birth:</label>
                <input type="text" id="townOfBirth" name="townOfBirth"  value="<?php echo htmlspecialchars($townOfBirth); ?>" required>
            </div>
            <div class="form-group">
                <label for="countryOfBirth">Country of Birth:</label>
                <input type="text" id="countryOfBirth" name="countryOfBirth" value="<?php echo htmlspecialchars($countryOfBirth); ?>" required>
            </div>
            <div class="form-group">
                <label for="nationality">Nationality:</label>
                <input type="text" id="nationality" name="nationality" placeholder="Nationality" value="<?php echo htmlspecialchars($nationality); ?>" required>
            </div>
            <div class="form-group">
                <label for="mothersMaidenFamilyname">Mother's Maiden Familyname:</label>
                <input type="text" id="mothersMaidenFamilyname" name="mothersMaidenFamilyname" placeholder="Mother's Maiden Familyname" value="<?php echo htmlspecialchars($mothersMaidenFamilyname); ?>" required>
            </div>
            <div class="form-group checkbox-label">
                <input type="checkbox" id="ukNationalInsuranceNumber" name="ukNationalInsuranceNumber" value="1" <?php echo $ukNationalInsuranceNumber == 1 ? 'checked' : ''; ?>>
                <label for="ukNationalInsuranceNumber">Do you have a UK National Insurance Number?</label>
            </div>
			<div class="form-group">
                <label for="nationalInsuranceNumber">National Insurance Number:</label>
                <input type="text" id="nationalInsuranceNumber" name="nationalInsuranceNumber" placeholder="National Insurance Number" value="<?php echo htmlspecialchars($nationalInsuranceNumber); ?>">
            </div>
            <div class="form-group checkbox-label">
                <input type="checkbox" id="passport" name="passport" value="1" <?php echo $passport == 1 ? 'checked' : ''; ?>>
                <label for="passport">Do you have a Passport?</label>
            </div>
            <div class="form-group">
                <label for="countryOfPassportIssue">Country of Passport Issue:</label>
                <input type="text" id="countryOfPassportIssue" name="countryOfPassportIssue" placeholder="Country of Passport Issue" value="<?php echo htmlspecialchars($countryOfPassportIssue); ?>">
            </div>
            <div class="form-group checkbox-label">
                <input type="checkbox" id="drivingLicence" name="drivingLicence" value="1" <?php echo $drivingLicence == 1 ? 'checked' : ''; ?>>
                <label for="drivingLicence">Do you have a Driving Licence?</label>
            </div>
            <div class="form-group">
                <label for="countryOfDrivingLicenceIssue">Country of Driving Licence Issue:</label>
                <input type="text" id="countryOfDrivingLicenceIssue" name="countryOfDrivingLicenceIssue" placeholder="Country of Driving Licence Issue" value="<?php echo htmlspecialchars($countryOfDrivingLicenceIssue); ?>">
            </div>
            <div class="form-group">
                <label for="drivingLicenceNumber">Driving Licence Number:</label>
                <input type="text" id="drivingLicenceNumber" name="drivingLicenceNumber" placeholder="Driving Licence Number" value="<?php echo htmlspecialchars($drivingLicenceNumber); ?>">
            </div>
            <div class="button-container">
                <button type="button" id="previousButton" onclick="window.location.href='PersonalDetails.php';">Previous</button>
                <input type="submit" value="Submit">
                <button type="button" id="nextButton" onclick="window.location.href='AddressHistory.php';">Next</button>
            </div>
        </form>
    </div>
    <footer>
        &copy; 2024 Company Name. All rights reserved.
    </footer>
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


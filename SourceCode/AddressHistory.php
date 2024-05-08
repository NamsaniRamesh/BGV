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
$database = "bgverification";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables with default values
$currentAddress = $currentTownCity = $currentPostcode = $currentCountry = $movedInDate = $previousAddress = $previousTownCity = $previousPostcode = $previousCountry = $previousMovedInDate = "";
$previousAddress1 = $previousTownCity1 = $previousPostcode1 = $previousCountry1 = $previousMovedInDate1 = "";
$previousAddress2 = $previousTownCity2 = $previousPostcode2 = $previousCountry2 = $previousMovedInDate2 = "";



// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $currentAddress = $conn->real_escape_string($_POST['current-address']);
    $currentTownCity = $conn->real_escape_string($_POST['current-town-city']);
    $currentPostcode = $conn->real_escape_string($_POST['current-postcode']);
    $currentCountry = $conn->real_escape_string($_POST['current-country']);
    $movedInDate = $conn->real_escape_string($_POST['moved-in-date']);
    $previousAddress = $conn->real_escape_string($_POST['previous-address']);
    $previousTownCity = $conn->real_escape_string($_POST['previous-town-city']);
    $previousPostcode = $conn->real_escape_string($_POST['previous-postcode']);
    $previousCountry = $conn->real_escape_string($_POST['previous-country']);
    $previousMovedInDate = $conn->real_escape_string($_POST['previous-moved-in-date']);
    /////////////////    
    $previousAddress1 = $conn->real_escape_string($_POST['previous-address1']);
    $previousTownCity1 = $conn->real_escape_string($_POST['previous-town-city1']);
    $previousPostcode1 = $conn->real_escape_string($_POST['previous-postcode1']);
    $previousCountry1 = $conn->real_escape_string($_POST['previous-country1']);
    $previousMovedInDate1 = $conn->real_escape_string($_POST['previous-moved-in-date1']);
    ////////////////
    $previousAddress2 = $conn->real_escape_string($_POST['previous-address2']);
    $previousTownCity2 = $conn->real_escape_string($_POST['previous-town-city2']);
    $previousPostcode2 = $conn->real_escape_string($_POST['previous-postcode2']);
    $previousCountry2 = $conn->real_escape_string($_POST['previous-country2']);
    $previousMovedInDate2 = $conn->real_escape_string($_POST['previous-moved-in-date2']);

    // Check if the user ID is valid (not equal to 0)
    if ($userId != 0) {
        // Check if the user already has address history in the database
        $sql_check_user = "SELECT * FROM addresshistory WHERE UserId = $userId";
        $result = $conn->query($sql_check_user);
        if ($result->num_rows > 0) {
            // Update existing address history
            $sql_update = "UPDATE addresshistory 
            SET CurrentAddress = '$currentAddress',
             CurrentTownCity = '$currentTownCity', 
             CurrentPostCode = '$currentPostcode', 
             CurrentCountry = '$currentCountry', 
             MovedinDate = '$movedInDate', 
             PreviousAddress = '$previousAddress', 
             PreviousTownCity = '$previousTownCity', 
             PreviousPostCode = '$previousPostcode', 
             PreviousCountry = '$previousCountry', 
             PreviousMovedinDate = '$previousMovedInDate',
             
             PreviousAddress1 = '$previousAddress1', 
             PreviousTownCity1 = '$previousTownCity1', 
             PreviousPostCode1 = '$previousPostcode1', 
             PreviousCountry1 = '$previousCountry1', 
             PreviousMovedinDate = '$previousMovedInDate',
             
             PreviousAddress2 = '$previousAddress2', 
             PreviousTownCity2 = '$previousTownCity2', 
             PreviousPostCode2 = '$previousPostcode2', 
             PreviousCountry2 = '$previousCountry2', 
             PreviousMovedinDate2 = '$previousMovedInDate2'  
             WHERE UserId = $userId";
            if ($conn->query($sql_update) === TRUE) {
                $message = "Address History Updated Successfully";                
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            // Insert new address history
            $sql_insert = "INSERT INTO addresshistory (UserId, CurrentAddress, CurrentTownCity, CurrentPostCode, CurrentCountry, MovedinDate, PreviousAddress, PreviousTownCity, PreviousPostCode, PreviousCountry, PreviousMovedinDate,
            PreviousAddress1, PreviousTownCity1, PreviousPostCode1, PreviousCountry1, PreviousMovedinDate1,
            PreviousAddress2, PreviousTownCity2, PreviousPostCode2, PreviousCountry2, PreviousMovedinDate2) 
            VALUES ($userId, '$currentAddress', '$currentTownCity', '$currentPostcode', '$currentCountry', '$movedInDate', '$previousAddress', '$previousTownCity', '$previousPostcode', '$previousCountry', '$previousMovedInDate',
            '$previousAddress1', '$previousTownCity1', '$previousPostcode1', '$previousCountry1', '$previousMovedInDate1',
            '$previousAddress2', '$previousTownCity2', '$previousPostcode2', '$previousCountry2', '$previousMovedInDate2')";
            if ($conn->query($sql_insert) === TRUE) {
                $message = "Address History Saved Successfully";               
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
    $sql_fetch_user = "SELECT * FROM addresshistory WHERE UserId = $userId";
    $result = $conn->query($sql_fetch_user);
    if ($result->num_rows > 0) {
        // Fetch data and store it in variables
        $row = $result->fetch_assoc();
        $currentAddress = $row['CurrentAddress'];
        $currentTownCity = $row['CurrentTownCity'];
        $currentPostcode = $row['CurrentPostCode'];
        $currentCountry = $row['CurrentCountry'];
        $movedInDate = $row['MovedinDate'];
        $previousAddress = $row['PreviousAddress'];
        $previousTownCity = $row['PreviousTownCity'];
        $previousPostcode = $row['PreviousPostCode'];
        $previousCountry = $row['PreviousCountry'];
        $previousMovedInDate = $row['PreviousMovedinDate'];
        //////////////
        $previousAddress1 = $row['PreviousAddress1'];
        $previousTownCity1 = $row['PreviousTownCity1'];
        $previousPostcode1 = $row['PreviousPostCode1'];
        $previousCountry1 = $row['PreviousCountry1'];
        $previousMovedInDate1 = $row['PreviousMovedinDate1'];
        ////////////////////////
        $previousAddress2 = $row['PreviousAddress2'];
        $previousTownCity2 = $row['PreviousTownCity2'];
        $previousPostcode2 = $row['PreviousPostCode2'];
        $previousCountry2 = $row['PreviousCountry2'];
        $previousMovedInDate2 = $row['PreviousMovedinDate2'];
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
    <title>Address History</title>
    <link href="personaldetailsform-style.css" rel="stylesheet">
    
</head>
<body>
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
    <div class="container addresspage">
        <h2>Address History</h2>
		<!-- Display the message if set -->
        <?php if(!empty($message)): ?>
            <div class="message" id = "successMessage"><?php echo $message; ?></div>
        <?php endif; ?>
        <form action="AddressHistory.php" method="post">
            <div class="current-address">
                <div class="sub-header">Current Address:</div>
                <div class="row">
                    <div class="form-group">
                        <label for="current-address">Address:</label>
                        <input type="text" id="current-address" name="current-address"
			        value="<?php echo htmlspecialchars($currentAddress); ?>">
                    </div>
                    <div class="form-group">
                        <label for="current-town-city">Town/City:</label>
                        <input type="text" id="current-town-city" name="current-town-city"
                          value="<?php echo htmlspecialchars($currentTownCity); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="current-postcode">Postcode:</label>
                        <input type="text" id="current-postcode" name="current-postcode"
                         value="<?php echo htmlspecialchars($currentPostcode); ?>">
                    </div>
                    <div class="form-group">
                        <label for="current-country">Country (if not UK):</label>
                        <input type="text" id="current-country" name="current-country"
                         value="<?php echo htmlspecialchars($currentCountry); ?>">
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group">
                        <label for="moved-in-date">Moved in:</label>
                        <input type="date" id="moved-in-date" name="moved-in-date"
                          value="<?php echo htmlspecialchars($movedInDate); ?>">
                    </div>
                </div>                
            </div>
            <div class="previous-addresses">
                <div class="sub-header"><h2>Previous Addresses:</h2></div>
                <!-- You can add more fields for previous addresses here -->
                <div class="row">
                    <div class="form-group">
                        <label for="previous-address">Address:</label>
                        <input type="text" id="previous-address" name="previous-address"
                         value="<?php echo htmlspecialchars($previousAddress); ?>">
                    </div>
                    <div class="form-group">
                        <label for="previous-town-city">Town/City:</label>
                        <input type="text" id="previous-town-city" name="previous-town-city"
                         value="<?php echo htmlspecialchars($previousTownCity); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="previous-postcode">Postcode:</label>
                        <input type="text" id="previous-postcode" name="previous-postcode"
                         value="<?php echo htmlspecialchars($previousPostcode); ?>">
                    </div>
                    <div class="form-group">
                        <label for="previous-country">Country (if not UK):</label>
                        <input type="text" id="previous-country" name="previous-country"
                         value="<?php echo htmlspecialchars($previousCountry); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="previous-moved-in-date">Moved in:</label>
                        <input type="date" id="previous-moved-in-date" name="previous-moved-in-date"
                         value="<?php echo htmlspecialchars($previousMovedInDate); ?>">
                    </div>
                </div> 
                <!-------------------------------------->
                <div class="sub-header"><h2>Previous Addresses:</h2></div>
                <!-- You can add more fields for previous addresses here -->
                <div class="row">
                    <div class="form-group">
                        <label for="previous-address1">Address:</label>
                        <input type="text" id="previous-address1" name="previous-address1"
                         value="<?php echo htmlspecialchars($previousAddress1); ?>">
                    </div>
                    <div class="form-group">
                        <label for="previous-town-city1">Town/City:</label>
                        <input type="text" id="previous-town-city1" name="previous-town-city1"
                         value="<?php echo htmlspecialchars($previousTownCity1); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="previous-postcode1">Postcode:</label>
                        <input type="text" id="previous-postcode1" name="previous-postcode1"
                         value="<?php echo htmlspecialchars($previousPostcode1); ?>">
                    </div>
                    <div class="form-group">
                        <label for="previous-country1">Country (if not UK):</label>
                        <input type="text" id="previous-country1" name="previous-country1"
                         value="<?php echo htmlspecialchars($previousCountry1); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="previous-moved-in-date1">Moved in:</label>
                        <input type="date" id="previous-moved-in-date1" name="previous-moved-in-date1"
                         value="<?php echo htmlspecialchars($previousMovedInDate1); ?>">
                    </div>
                </div> 
                <!------------------------------------------------>
                <div class="sub-header"><h2>Previous Addresses:</h2></div>
                <!-- You can add more fields for previous addresses here -->
                <div class="row">
                    <div class="form-group">
                        <label for="previous-address2">Address:</label>
                        <input type="text" id="previous-address2" name="previous-address2"
                         value="<?php echo htmlspecialchars($previousAddress2); ?>">
                    </div>
                    <div class="form-group">
                        <label for="previous-town-city2">Town/City:</label>
                        <input type="text" id="previous-town-city2" name="previous-town-city2"
                         value="<?php echo htmlspecialchars($previousTownCity2); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="previous-postcode2">Postcode:</label>
                        <input type="text" id="previous-postcode2" name="previous-postcode2"
                         value="<?php echo htmlspecialchars($previousPostcode2); ?>">
                    </div>
                    <div class="form-group">
                        <label for="previous-country2">Country (if not UK):</label>
                        <input type="text" id="previous-country2" name="previous-country2"
                         value="<?php echo htmlspecialchars($previousCountry2); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="previous-moved-in-date2">Moved in:</label>
                        <input type="date" id="previous-moved-in-date2" name="previous-moved-in-date2"
                         value="<?php echo htmlspecialchars($previousMovedInDate2); ?>">
                    </div>
                </div>                
            </div>
            <div class="button-container">
                <button type="submit">Submit</button>
                <div>
                <button type="button" id="previousButton" onclick="window.location.href='AdditionalPersonalDetails.php';">Previous</button>
                <button type="button" id ="nextButton" onclick="window.location.href='EmploymentHistory.php';">Next</button>
        </div>
            </div>
        </form>
		<script>
        document.addEventListener('DOMContentLoaded', function () {            
			var messageDiv = document.getElementById('successMessage');            
			 // Hide message after 5 seconds
			setTimeout(function() {
                messageDiv.style.display = 'none';
            }, 5000);
        });
    </script>
    </div>
    <footer>
        &copy; 2024 Company Name. All rights reserved.
    </footer>  
</body>
</html>

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

    // Check if the user ID is valid (not equal to 0)
    if ($userId != 0) {
        // Check if the user already has address history in the database
        $sql_check_user = "SELECT * FROM addresshistory WHERE UserId = $userId";
        $result = $conn->query($sql_check_user);
        if ($result->num_rows > 0) {
            // Update existing address history
            $sql_update = "UPDATE addresshistory SET CurrentAddress = '$currentAddress', CurrentTownCity = '$currentTownCity', CurrentPostCode = '$currentPostcode', CurrentCountry = '$currentCountry', MovedinDate = '$movedInDate', PreviousAddress = '$previousAddress', PreviousTownCity = '$previousTownCity', PreviousPostCode = '$previousPostcode', PreviousCountry = '$previousCountry', PreviousMovedinDate = '$previousMovedInDate' WHERE UserId = $userId";
            if ($conn->query($sql_update) === TRUE) {
                $message = "Address History Updated Successfully";                
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            // Insert new address history
            $sql_insert = "INSERT INTO addresshistory (UserId, CurrentAddress, CurrentTownCity, CurrentPostCode, CurrentCountry, MovedinDate, PreviousAddress, PreviousTownCity, PreviousPostCode, PreviousCountry, PreviousMovedinDate) VALUES ($userId, '$currentAddress', '$currentTownCity', '$currentPostcode', '$currentCountry', '$movedInDate', '$previousAddress', '$previousTownCity', '$previousPostcode', '$previousCountry', '$previousMovedInDate')";
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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
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
        .sub-header {
            font-size: 18px;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 20px;
            width: 48%; /* Each field takes up nearly half of the container */
            display: inline-block;
            vertical-align: top;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="date"],
        select {
            width: calc(100% - 22px); /* Adjusting width to fit two fields in a row */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        .row::after {
            content: "";
            display: table;
            clear: both;
        }
        .row .form-group {
            float: left; /* Float the fields to place them side by side */
            margin-right: 4%; /* Add a right margin for spacing */
        }
        .row .form-group:last-child {
            margin-right: 0; /* Remove the right margin from the last field in each row */
        }
        .button-container {
            display: flex;
            justify-content: space-between;
        }
        .button-container button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
            //margin-right: 300px;            
        }
        .button-container button:hover {
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
                <div class="sub-header">Previous Addresses:</div>
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
            </div>
            <div class="button-container">
                <button type="submit">Submit</button>
                <button type="button" onclick="window.location.href='EmploymentHistory.php';">Next</button>
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
</body>
</html>

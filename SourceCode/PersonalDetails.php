<?php
session_start();

// // Check if user ID is not set in session
 if (!isset($_SESSION['user_id'])) {
    //Redirect to LoginPage.php
     header("Location: LoginPage.php");
     exit; // Stop further execution
 }

// Database connection details
$servername = "localhost:3306";
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
$title = $firstName = $middleName = $familyName = $dob = $differentNameOption = $pFirstName = $pMiddleName = $pFamilyName = $dateOfChange = "";
$message = ""; // Initialize message variable

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data
    $title = $_POST['title'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $familyName = $_POST['familyName'];
    $dob = $_POST['dob'];
    $differentNameOption = isset($_POST['differentNameOption']) ? $_POST['differentNameOption'] : 'no';
    $pFirstName = isset($_POST['pFirstName']) ? $_POST['pFirstName'] : '';
    $pMiddleName = isset($_POST['pMiddleName']) ? $_POST['pMiddleName'] : '';
    $pFamilyName = isset($_POST['pFamilyName']) ? $_POST['pFamilyName'] : '';
    $dateOfChange = isset($_POST['dateOfChange']) ? $_POST['dateOfChange'] : '';

    // Check if user ID is set in session
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        // Check if user exists in database
        $sql_check_user = "SELECT * FROM userdetails WHERE id = $userId";
        $result = $conn->query($sql_check_user);
        if ($result->num_rows > 0) {
            // Update user details if user exists
            $sql_update = "UPDATE userdetails SET Title = '$title', FirstName = '$firstName', MiddleName = '$middleName', FamilyName = '$familyName', DateofBirth = '$dob', DifferentName = '$differentNameOption', PreviousFirstName = '$pFirstName', PreviousMiddleName = '$pMiddleName', PreviousFamilyName = '$pFamilyName', DateofChange = '$dateOfChange' WHERE id = $userId";
            if ($conn->query($sql_update) === TRUE) {
                // Set success message
                $message = "Personal Details Saved Successfully";
            } else {
                $message = "Error updating record: " . $conn->error;
            }
        } else {
            // Insert new user details if user does not exist
            $sql_insert = "INSERT INTO userdetails (Title, FirstName, MiddleName, FamilyName, DateofBirth, DifferentName, PreviousFirstName, PreviousMiddleName, PreviousFamilyName, DateofChange) VALUES ('$title', '$firstName', '$middleName', '$familyName', '$dob', '$differentNameOption', '$pFirstName', '$pMiddleName', '$pFamilyName', '$dateOfChange')";
            if ($conn->query($sql_insert) === TRUE) {
                // Set success message
                $message = "Personal Details Saved Successfully";
            } else {
                $message = "Error inserting record: " . $conn->error;
            }
        }
    } 
}

// Fetch saved details from the database
if(isset($_GET['id'])) {
    // Retrieve the value of 'id' from the URL and store it in a session variable
    $_SESSION['user_id'] = $_GET['id'];
   $userId = $_SESSION['user_id'];
}

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    // Fetch user details from the database
    $sql_fetch_user = "SELECT * FROM userdetails WHERE id = $userId";
    $result = $conn->query($sql_fetch_user);
    if ($result->num_rows > 0) {
        // Fetch data and store it in variables
        $row = $result->fetch_assoc();
        $title = $row['Title'];
        $firstName = $row['FirstName'];
        $middleName = $row['MiddleName'];
        $familyName = $row['FamilyName'];
        $dob = $row['DateofBirth'];
        $differentNameOption = $row['DifferentName'];
        $pFirstName = $row['PreviousFirstName'];
        $pMiddleName = $row['PreviousMiddleName'];
        $pFamilyName = $row['PreviousFamilyName'];
        $dateOfChange = $row['DateofChange'];
    } else {
        $message = "No records found.";
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
    <title>Add Employee Details</title>
    <link href="personaldetailsForm-style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Personal Details</h2>
        <!-- Display the message if set -->
        <?php if(!empty($message)): ?>
            <div class="message" id = "successMessage"><?php echo $message; ?></div>
        <?php endif; ?>
        <form action="PersonalDetails.php" method="post" id="employeeForm">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" required>
            </div>
            <div= class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>" required>
            </div=>
            <div class="form-group">
                <label for="middleName">Middle Name:</label>
                <input type="text" id="middleName" name="middleName" value="<?php echo htmlspecialchars($middleName); ?>">
            </div>
            <div class="form-group">
                <label for="familyName">Family Name:</label>
                <input type="text" id="familyName" name="familyName" value="<?php echo htmlspecialchars($familyName); ?>" required>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($dob); ?>" required>
            </div>
            <div class="form-group perviousabove">
                <label>Have you ever been known by a different name? If YES, please enter them below:</label>
                <div class="">
                    <input type="checkbox" id="differentNameOptionYes" name="differentNameOption" value="yes" <?php if(isset($differentNameOption) && $differentNameOption === 'yes') echo 'checked'; ?>>
                    <label for="differentNameOptionYes">Yes</label>
                </div>
                <div>
                    <input type="checkbox" id="differentNameOptionNo" name="differentNameOption" value="no" <?php if(isset($differentNameOption) && $differentNameOption === 'no') echo 'checked'; ?>>
                    <label for="differentNameOptionNo">No</label>
                </div>
            </div>
            <div class="previous-names-header"><h2>Previous Names</h2></div>
            <div class="previous-names-container" id="previousNamesContainer">
                
                <div class="form-group">
                    <label for="pFirstName">Previous First Name:</label>
                    <input type="text" id="pFirstName" name="pFirstName" value="<?php echo htmlspecialchars($pFirstName); ?>">
                </div>
                <div class="form-group">
                    <label for="pMiddleName">Previous Middle Name:</label>
                    <input type="text" id="pMiddleName" name="pMiddleName" value="<?php echo htmlspecialchars($pMiddleName); ?>">
                </div>
                <div class="form-group">
                    <label for="pFamilyName">Previous Family Name:</label>
                    <input type="text" id="pFamilyName" name="pFamilyName" value="<?php echo htmlspecialchars($pFamilyName); ?>">
                </div>
                <div class="form-group">
                    <label for="dateOfChange">Date of Change:</label>
                    <input type="date" id="dateOfChange" name="dateOfChange" value="<?php echo htmlspecialchars($dateOfChange); ?>">
                </div>
            </div>
            <div class="buttons">
                <button type="submit">Submit</button>
                <button type="button" id="nextButton" onclick="window.location.href='AdditionalPersonalDetails.php';">Next</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var checkboxYes = document.getElementById('differentNameOptionYes');
            var checkboxNo = document.getElementById('differentNameOptionNo');
            var previousNamesContainer = document.getElementById('previousNamesContainer');
			var messageDiv = document.getElementById('successMessage');

            function togglePreviousNamesContainer() {
                previousNamesContainer.style.display = checkboxYes.checked ? 'block' : 'none';
            }

            checkboxYes.addEventListener('change', function () {
                if (this.checked) {
                    checkboxNo.checked = false; // Uncheck "No" checkbox
                }
                togglePreviousNamesContainer();
            });

            checkboxNo.addEventListener('change', function () {
                if (this.checked) {
                    checkboxYes.checked = false; // Uncheck "Yes" checkbox
                }
                togglePreviousNamesContainer();
            });

            // Call togglePreviousNamesContainer initially to set the initial state
            togglePreviousNamesContainer();
			 // Hide message after 5 seconds
			setTimeout(function() {
                messageDiv.style.display = 'none';
            }, 5000);
        });
    </script>
</body>
</html>

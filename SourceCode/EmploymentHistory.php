<?php
session_start();
// Check if user ID is not set in session
if (!isset($_SESSION['user_id'])) {
    // Redirect to LoginPage.php
    header("Location: LoginPage.php");
    exit; // Stop further execution
}
// user id from sessions
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    // Now you can use $userId in your SQL queries or other parts of your code
} 
// else blocked to pass userid 0 when session is expired.
else
{
$userId = 0;
}

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "bgverification";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// variable declaring
            $employer = "";
            $address = "";
            $phone = "";
            $jobTitle = "";
            $startDate = "";
            $leavingDate = "";
            $reasonLeaving = "";
            $refereeName = "";
            $refereeJobTitle = "";
            $refereeContact = "";
	    $email = "";
            $canContact = "";
	               

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employer = $conn->real_escape_string($_POST['employer']);
    $address = $conn->real_escape_string($_POST['address']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $jobTitle = $conn->real_escape_string($_POST['job-title']);
    $startDate = $conn->real_escape_string($_POST['start-date']);
    $leavingDate = $conn->real_escape_string($_POST['leaving-date']);
    $reasonLeaving = $conn->real_escape_string($_POST['reason-leaving']);
    $refereeName = $conn->real_escape_string($_POST['referee-name']);
    $refereeJobTitle = $conn->real_escape_string($_POST['referee-job-title']);
    $refereeContact = $conn->real_escape_string($_POST['referee-contact']);
    $email = $conn->real_escape_string($_POST['email']);
    $canContact = $conn->real_escape_string($_POST['can-contact']);

    $sql_check = "SELECT * FROM employmenthistory WHERE UserId = $userId";
    $result = $conn->query($sql_check);
	
    if ($result->num_rows > 0) {
        $sql = "UPDATE employmenthistory SET	     
	    Employer = '$employer',
            Address = '$address',
            PhoneNumber = '$phone',
            YourJobTitle = '$jobTitle',
            StartDate = '$startDate',
            LeavingDate = '$leavingDate',
            ReasonforLeaving = '$reasonLeaving',
            RefereeName = '$refereeName',
            RefereeJobTitle = '$refereeJobTitle',
            RefereePhone = '$refereeContact',
            Email = '$email',
	    CanwecontactthisEmployer = '$canContact'
            WHERE UserId = $userId";

        $action = "Employment History updated successfully";
    } else {
        $sql = "INSERT INTO employmenthistory (UserId, Employer, Address, PhoneNumber, YourJobTitle,     	StartDate, LeavingDate, ReasonforLeaving, RefereeName, RefereeJobTitle, RefereePhone, Email,
	CanwecontactthisEmployer)
            VALUES ($userId, '$employer', '$address', '$phone', '$jobTitle', '$startDate', '$leavingDate',   		'$reasonLeaving', '$refereeName', '$refereeJobTitle', '$refereeContact','$email', '$canContact')";

        $action = "Employment History inserted successfully";
    }

    if ($conn->query($sql) === TRUE) {
        $message = $action;        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
// Fetch data from the database
$sql = "SELECT * FROM employmenthistory Where UserId = $userId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch data and store it in variables
    $row = $result->fetch_assoc();
    $employer = $row['Employer'];
    $address = $row['Address'];
    $phone = $row['PhoneNumber'];
    $jobTitle = $row['YourJobTitle'];
    $startDate = $row['StartDate'];
    $leavingDate = $row['LeavingDate'];
    $reasonLeaving = $row['ReasonforLeaving'];
    $refereeName = $row['RefereeName'];
    $refereeJobTitle = $row['RefereeJobTitle'];
    $refereeContact = $row['RefereePhone'];
    $email = $row['Email'];
    $canContact = $row['CanwecontactthisEmployer'];
   } 

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employment History</title>
    <link href="personaldetailsForm-style.css" rel="stylesheet">
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
             padding: 100px;
             width: 82%;
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
    <div class="container Emphistory">
        <h2>Employment History</h2>
		<!-- Display the message if set -->
        <?php if(!empty($message)): ?>
            <div class="message" id = "successMessage"><?php echo $message; ?></div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="row">
                <div class="form-group">
                    <label for="employer">Employer:</label>
                    <input type="text" id="employer" name="employer"
                     value="<?php echo htmlspecialchars($employer); ?>">
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address"
                     value="<?php echo htmlspecialchars($address); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="text" id="phone" name="phone"
                     value="<?php echo htmlspecialchars($phone); ?>">
                </div>
                <div class="form-group">
                    <label for="job-title">Your Job Title:</label>
                    <input type="text" id="job-title" name="job-title"
                      value="<?php echo htmlspecialchars($jobTitle); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="start-date">Start Date:</label>
                    <input type="date" id="start-date" name="start-date"
                     value="<?php echo htmlspecialchars($startDate); ?>">
                </div>
                <div class="form-group">
                    <label for="leaving-date">Leaving Date:</label>
                    <input type="date" id="leaving-date" name="leaving-date"
                     value="<?php echo htmlspecialchars($leavingDate); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="reason-leaving">Reason for Leaving:</label>
                    <input type="text" id="reason-leaving" name="reason-leaving"
                     value="<?php echo htmlspecialchars($reasonLeaving); ?>">
                </div>
                <div class="form-group">
                    <label for="referee-name">Referee Name:</label>
                    <input type="text" id="referee-name" name="referee-name"
                      value="<?php echo htmlspecialchars($refereeName); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="referee-job-title">Referee Job Title:</label>
                    <input type="text" id="referee-job-title" name="referee-job-title"
                     value="<?php echo htmlspecialchars($refereeJobTitle); ?>">
                </div>
                <div class="form-group">
                    <label for="referee-contact">Referee Phone:</label>
                    <input type="text" id="referee-contact" name="referee-contact"
                      value="<?php echo htmlspecialchars($refereeContact); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email"
                      value="<?php echo htmlspecialchars($email); ?>">
                </div>
                <div class="form-group">
                    <label for="can-contact">Can we contact this employer?</label>
                    <input type="text" id="can-contact" name="can-contact"
                      value="<?php echo htmlspecialchars($canContact); ?>">
                 </div>
            </div>
            <div class="row mb20">
                    <div class="button-container">
                    <button> + </button>
                    </div>
                </div>
            <div class="button-container">
                <button type="submit">Submit</button>
                <div>
                <button type="button" id="previousButton" onclick="window.location.href='AddressHistory.php';">Previous</button>
                <button type="button" id ="nextButton" onclick="window.location.href='Qualifications.php';">Next</button>
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

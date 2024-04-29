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
            width: 48%;
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
            width: calc(100% - 22px);
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
            float: left;
            margin-right: 4%;
        }
        .row .form-group:last-child {
            margin-right: 0;
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
            margin-right: 10px;
        }
        .button-container button:last-child {
            margin-right: 0;
        }
        .button-container button:hover {
            background-color: #45a049;
        }
        //.button-container button.next {
        //    position: absolute;
          //  right: 20px;
        //}
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
            <div class="button-container">
                <button type="submit">Submit</button>
                <button type="button" class="next" onclick="window.location.href='Qualifications.php';">Next</button>
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

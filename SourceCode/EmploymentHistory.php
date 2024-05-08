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
            //////////////
            $employer1 = "";
            $address1 = "";
            $phone1 = "";
            $jobTitle1 = "";
            $startDate1 = "";
            $leavingDate1 = "";
            $reasonLeaving1 = "";
            $refereeName1 = "";
            $refereeJobTitle1 = "";
            $refereeContact1 = "";
	        $email1 = "";
            $canContact1 = "";
            ////////
            $employer2 = "";
            $address2 = "";
            $phone2 = "";
            $jobTitle2 = "";
            $startDate2 = "";
            $leavingDate2 = "";
            $reasonLeaving2 = "";
            $refereeName2 = "";
            $refereeJobTitle2 = "";
            $refereeContact2 = "";
	        $email2 = "";
            $canContact2 = "";
            ////////
            $employer3 = "";
            $address3 = "";
            $phone3 = "";
            $jobTitle3 = "";
            $startDate3 = "";
            $leavingDate3 = "";
            $reasonLeaving3 = "";
            $refereeName3 = "";
            $refereeJobTitle3 = "";
            $refereeContact3 = "";
	        $email3 = "";
            $canContact3 = "";
            /////////////
            $employer4 = "";
            $address4 = "";
            $phone4 = "";
            $jobTitle4 = "";
            $startDate4 = "";
            $leavingDate4 = "";
            $reasonLeaving4 = "";
            $refereeName4 = "";
            $refereeJobTitle4 = "";
            $refereeContact4 = "";
	        $email4 = "";
            $canContact4 = "";
	               

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
    ////////////////////////
    $employer1 = $conn->real_escape_string($_POST['employer1']);
    $address1 = $conn->real_escape_string($_POST['address1']);
    $phone1 = $conn->real_escape_string($_POST['phone1']);
    $jobTitle1 = $conn->real_escape_string($_POST['job-title1']);
    $startDate1 = $conn->real_escape_string($_POST['start-date1']);
    $leavingDate1 = $conn->real_escape_string($_POST['leaving-date1']);
    $reasonLeaving1 = $conn->real_escape_string($_POST['reason-leaving1']);
    $refereeName1 = $conn->real_escape_string($_POST['referee-name1']);
    $refereeJobTitle1 = $conn->real_escape_string($_POST['referee-job-title1']);
    $refereeContact1 = $conn->real_escape_string($_POST['referee-contact1']);
    $email1 = $conn->real_escape_string($_POST['email1']);
    $canContact1 = $conn->real_escape_string($_POST['can-contact1']);
    ///////////////////
    $employer2 = $conn->real_escape_string($_POST['employer2']);
    $address2 = $conn->real_escape_string($_POST['address2']);
    $phone2 = $conn->real_escape_string($_POST['phone2']);
    $jobTitle2 = $conn->real_escape_string($_POST['job-title2']);
    $startDate2 = $conn->real_escape_string($_POST['start-date2']);
    $leavingDate2 = $conn->real_escape_string($_POST['leaving-date2']);
    $reasonLeaving2 = $conn->real_escape_string($_POST['reason-leaving2']);
    $refereeName2 = $conn->real_escape_string($_POST['referee-name2']);
    $refereeJobTitle2 = $conn->real_escape_string($_POST['referee-job-title2']);
    $refereeContact2 = $conn->real_escape_string($_POST['referee-contact2']);
    $email2 = $conn->real_escape_string($_POST['email2']);
    $canContact2 = $conn->real_escape_string($_POST['can-contact2']);
    //////////////////////////////
    $employer3 = $conn->real_escape_string($_POST['employer3']);
    $address3 = $conn->real_escape_string($_POST['address3']);
    $phone3 = $conn->real_escape_string($_POST['phone3']);
    $jobTitle3 = $conn->real_escape_string($_POST['job-title3']);
    $startDate3 = $conn->real_escape_string($_POST['start-date3']);
    $leavingDate3 = $conn->real_escape_string($_POST['leaving-date3']);
    $reasonLeaving3 = $conn->real_escape_string($_POST['reason-leaving3']);
    $refereeName3 = $conn->real_escape_string($_POST['referee-name3']);
    $refereeJobTitle3 = $conn->real_escape_string($_POST['referee-job-title3']);
    $refereeContact3 = $conn->real_escape_string($_POST['referee-contact3']);
    $email3 = $conn->real_escape_string($_POST['email3']);
    $canContact3 = $conn->real_escape_string($_POST['can-contact3']);
    ///////////////////////////////
    $employer4 = $conn->real_escape_string($_POST['employer4']);
    $address4 = $conn->real_escape_string($_POST['address4']);
    $phone4 = $conn->real_escape_string($_POST['phone4']);
    $jobTitle4 = $conn->real_escape_string($_POST['job-title4']);
    $startDate4 = $conn->real_escape_string($_POST['start-date4']);
    $leavingDate4 = $conn->real_escape_string($_POST['leaving-date4']);
    $reasonLeaving4 = $conn->real_escape_string($_POST['reason-leaving4']);
    $refereeName4 = $conn->real_escape_string($_POST['referee-name4']);
    $refereeJobTitle4 = $conn->real_escape_string($_POST['referee-job-title4']);
    $refereeContact4 = $conn->real_escape_string($_POST['referee-contact4']);
    $email4 = $conn->real_escape_string($_POST['email4']);
    $canContact4 = $conn->real_escape_string($_POST['can-contact4']);

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
	        CanwecontactthisEmployer = '$canContact',
            ----------
            Employer1 = '$employer1',
            Address1 = '$address1',
            PhoneNumber1 = '$phone1',
            YourJobTitle1 = '$jobTitle1',
            StartDate1 = '$startDate1',
            LeavingDate1 = '$leavingDate1',
            ReasonforLeaving1 = '$reasonLeaving1',
            RefereeName1 = '$refereeName1',
            RefereeJobTitle1 = '$refereeJobTitle1',
            RefereePhone1 = '$refereeContact1',
            Email1 = '$email1',
	        CanwecontactthisEmployer1 = '$canContact1',
            ----------
            Employer2 = '$employer2',
            Address2 = '$address2',
            PhoneNumber2 = '$phone2',
            YourJobTitle2 = '$jobTitle2',
            StartDate2 = '$startDate2',
            LeavingDate2 = '$leavingDate2',
            ReasonforLeaving2 = '$reasonLeaving2',
            RefereeName2 = '$refereeName2',
            RefereeJobTitle2 = '$refereeJobTitle2',
            RefereePhone2 = '$refereeContact2',
            Email2 = '$email2',
	        CanwecontactthisEmployer2 = '$canContact2',
            -------------------
            Employer3 = '$employer3',
            Address3 = '$address3',
            PhoneNumber3 = '$phone3',
            YourJobTitle3 = '$jobTitle3',
            StartDate3 = '$startDate3',
            LeavingDate3 = '$leavingDate3',
            ReasonforLeaving3 = '$reasonLeaving3',
            RefereeName3 = '$refereeName3',
            RefereeJobTitle3 = '$refereeJobTitle3',
            RefereePhone3 = '$refereeContact3',
            Email3 = '$email3',
	        CanwecontactthisEmployer3 = '$canContact3',
            ---------------------
            Employer4 = '$employer4',
            Address4 = '$address4',
            PhoneNumber4 = '$phone4',
            YourJobTitle4 = '$jobTitle4',
            StartDate4 = '$startDate4',
            LeavingDate4 = '$leavingDate4',
            ReasonforLeaving4 = '$reasonLeaving4',
            RefereeName4 = '$refereeName4',
            RefereeJobTitle4 = '$refereeJobTitle4',
            RefereePhone4 = '$refereeContact4',
            Email4 = '$email4',
	        CanwecontactthisEmployer4 = '$canContact4'
            WHERE UserId = $userId";

        $action = "Employment History updated successfully";
    } else {
        $sql = "INSERT INTO employmenthistory (UserId, Employer, Address, PhoneNumber, YourJobTitle, StartDate, LeavingDate, ReasonforLeaving, RefereeName, RefereeJobTitle, RefereePhone, Email,
	            CanwecontactthisEmployer,
                Employer1, Address1, PhoneNumber1, YourJobTitle1, StartDate1, LeavingDate1, ReasonforLeaving1, RefereeName1, RefereeJobTitle1, RefereePhone1, Email1,
	            CanwecontactthisEmployer1,
                Employer2, Address2, PhoneNumber2, YourJobTitle2, StartDate2, LeavingDate2, ReasonforLeaving2, RefereeName2, RefereeJobTitle2, RefereePhone2, Email2,
	            CanwecontactthisEmployer2,
                Employer3, Address3, PhoneNumber3, YourJobTitle3, StartDate3, LeavingDate3, ReasonforLeaving3, RefereeName3, RefereeJobTitle3, RefereePhone3, Email3,
	            CanwecontactthisEmployer3,
                Employer4, Address4, PhoneNumber4, YourJobTitle4, StartDate4, LeavingDate4, ReasonforLeaving4, RefereeName4, RefereeJobTitle4, RefereePhone4, Email4,
	            CanwecontactthisEmployer4)
            VALUES ($userId, '$employer', '$address', '$phone', '$jobTitle', '$startDate', '$leavingDate', '$reasonLeaving', '$refereeName', '$refereeJobTitle', '$refereeContact','$email', '$canContact',
            '$employer1', '$address1', '$phone1', '$jobTitle1', '$startDate1', '$leavingDate1', '$reasonLeaving1', '$refereeName1', '$refereeJobTitle1', '$refereeContact1','$email1', '$canContact1',
            '$employer2', '$address2', '$phone2', '$jobTitle2', '$startDate2', '$leavingDate2', '$reasonLeaving2', '$refereeName2', '$refereeJobTitle2', '$refereeContact2','$email2', '$canContact2',
            '$employer3', '$address3', '$phone3', '$jobTitle3', '$startDate3', '$leavingDate3', '$reasonLeaving3', '$refereeName3', '$refereeJobTitle3', '$refereeContact3','$email3', '$canContact3',
            '$employer4', '$address4', '$phone4', '$jobTitle4', '$startDate4', '$leavingDate4', '$reasonLeaving4', '$refereeName4', '$refereeJobTitle4', '$refereeContact4','$email4', '$canContact4')";

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
    /////////////////
    $employer1 = $row['Employer1'];
    $address1 = $row['Address1'];
    $phone1 = $row['PhoneNumber1'];
    $jobTitle1 = $row['YourJobTitle1'];
    $startDate1 = $row['StartDate1'];
    $leavingDate1 = $row['LeavingDate1'];
    $reasonLeaving1 = $row['ReasonforLeaving1'];
    $refereeName1 = $row['RefereeName1'];
    $refereeJobTitle1 = $row['RefereeJobTitle1'];
    $refereeContact1 = $row['RefereePhone1'];
    $email1 = $row['Email1'];
    $canContact1 = $row['CanwecontactthisEmployer1'];
    ////////////////
    $employer2 = $row['Employer2'];
    $address2 = $row['Address2'];
    $phone2 = $row['PhoneNumber2'];
    $jobTitle2 = $row['YourJobTitle2'];
    $startDate2 = $row['StartDate2'];
    $leavingDate2 = $row['LeavingDate2'];
    $reasonLeaving2 = $row['ReasonforLeaving2'];
    $refereeName2 = $row['RefereeName2'];
    $refereeJobTitle2 = $row['RefereeJobTitle2'];
    $refereeContact2 = $row['RefereePhone2'];
    $email2 = $row['Email2'];
    $canContact2 = $row['CanwecontactthisEmployer2'];
    /////////////////////////////
    $employer3 = $row['Employer3'];
    $address3 = $row['Address3'];
    $phone3 = $row['PhoneNumber3'];
    $jobTitle3 = $row['YourJobTitle3'];
    $startDate3 = $row['StartDate3'];
    $leavingDate3 = $row['LeavingDate3'];
    $reasonLeaving3 = $row['ReasonforLeaving3'];
    $refereeName3 = $row['RefereeName3'];
    $refereeJobTitle3 = $row['RefereeJobTitle3'];
    $refereeContact3 = $row['RefereePhone3'];
    $email3 = $row['Email3'];
    $canContact3 = $row['CanwecontactthisEmployer3'];
    //////////////////////
    $employer4 = $row['Employer4'];
    $address4 = $row['Address4'];
    $phone4 = $row['PhoneNumber4'];
    $jobTitle4 = $row['YourJobTitle4'];
    $startDate4 = $row['StartDate4'];
    $leavingDate4 = $row['LeavingDate4'];
    $reasonLeaving4 = $row['ReasonforLeaving4'];
    $refereeName4 = $row['RefereeName4'];
    $refereeJobTitle4 = $row['RefereeJobTitle4'];
    $refereeContact4 = $row['RefereePhone4'];
    $email4 = $row['Email4'];
    $canContact4 = $row['CanwecontactthisEmployer4'];
   } 

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employment History</title>
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
            <!---------------------------------------->
            <h2>Previous Employment History</h2>
            <div class="row">
                <div class="form-group">
                    <label for="employer1">Employer:</label>
                    <input type="text" id="employer1" name="employer1"
                     value="<?php echo htmlspecialchars($employer1); ?>">
                </div>
                <div class="form-group">
                    <label for="address1">Address:</label>
                    <input type="text" id="address1" name="address1"
                     value="<?php echo htmlspecialchars($address1); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="phone1">Phone Number:</label>
                    <input type="text" id="phone1" name="phone1"
                     value="<?php echo htmlspecialchars($phone1); ?>">
                </div>
                <div class="form-group">
                    <label for="job-title1">Your Job Title:</label>
                    <input type="text" id="job-title1" name="job-title1"
                      value="<?php echo htmlspecialchars($jobTitle1); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="start-date1">Start Date:</label>
                    <input type="date" id="start-date1" name="start-date1"
                     value="<?php echo htmlspecialchars($startDate1); ?>">
                </div>
                <div class="form-group">
                    <label for="leaving-date1">Leaving Date:</label>
                    <input type="date" id="leaving-date1" name="leaving-date1"
                     value="<?php echo htmlspecialchars($leavingDate1); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="reason-leaving1">Reason for Leaving:</label>
                    <input type="text" id="reason-leaving1" name="reason-leaving1"
                     value="<?php echo htmlspecialchars($reasonLeaving1); ?>">
                </div>
                <div class="form-group">
                    <label for="referee-name1">Referee Name:</label>
                    <input type="text" id="referee-name1" name="referee-name1"
                      value="<?php echo htmlspecialchars($refereeName1); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="referee-job-title1">Referee Job Title:</label>
                    <input type="text" id="referee-job-title" name="referee-job-title1"
                     value="<?php echo htmlspecialchars($refereeJobTitle1); ?>">
                </div>
                <div class="form-group">
                    <label for="referee-contact1">Referee Phone:</label>
                    <input type="text" id="referee-contact1" name="referee-contact1"
                      value="<?php echo htmlspecialchars($refereeContact1); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="email1">Email:</label>
                    <input type="text" id="email1" name="email1"
                      value="<?php echo htmlspecialchars($email1); ?>">
                </div>
                <div class="form-group">
                    <label for="can-contact1">Can we contact this employer?</label>
                    <input type="text" id="can-contact1" name="can-contact1"
                      value="<?php echo htmlspecialchars($canContact1); ?>">
                 </div>
            </div>
            <!------------------------------->
            <h2>Previous Employment History</h2>
            <div class="row">
                <div class="form-group">
                    <label for="employer2">Employer:</label>
                    <input type="text" id="employer2" name="employer2"
                     value="<?php echo htmlspecialchars($employer2); ?>">
                </div>
                <div class="form-group">
                    <label for="address2">Address:</label>
                    <input type="text" id="address2" name="address2"
                     value="<?php echo htmlspecialchars($address2); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="phone2">Phone Number:</label>
                    <input type="text" id="phone2" name="phone2"
                     value="<?php echo htmlspecialchars($phone2); ?>">
                </div>
                <div class="form-group">
                    <label for="job-title2">Your Job Title:</label>
                    <input type="text" id="job-title2" name="job-title2"
                      value="<?php echo htmlspecialchars($jobTitle2); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="start-date2">Start Date:</label>
                    <input type="date" id="start-date2" name="start-date2"
                     value="<?php echo htmlspecialchars($startDate2); ?>">
                </div>
                <div class="form-group">
                    <label for="leaving-date2">Leaving Date:</label>
                    <input type="date" id="leaving-date2" name="leaving-date2"
                     value="<?php echo htmlspecialchars($leavingDate2); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="reason-leaving2">Reason for Leaving:</label>
                    <input type="text" id="reason-leaving2" name="reason-leaving2"
                     value="<?php echo htmlspecialchars($reasonLeaving2); ?>">
                </div>
                <div class="form-group">
                    <label for="referee-name2">Referee Name:</label>
                    <input type="text" id="referee-name2" name="referee-name2"
                      value="<?php echo htmlspecialchars($refereeName2); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="referee-job-title2">Referee Job Title:</label>
                    <input type="text" id="referee-job-title2" name="referee-job-title2"
                     value="<?php echo htmlspecialchars($refereeJobTitle2); ?>">
                </div>
                <div class="form-group">
                    <label for="referee-contact2">Referee Phone:</label>
                    <input type="text" id="referee-contact2" name="referee-contact2"
                      value="<?php echo htmlspecialchars($refereeContact2); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="email2">Email:</label>
                    <input type="text" id="email2" name="email2"
                      value="<?php echo htmlspecialchars($email2); ?>">
                </div>
                <div class="form-group">
                    <label for="can-contact2">Can we contact this employer?</label>
                    <input type="text" id="can-contact2" name="can-contact2"
                      value="<?php echo htmlspecialchars($canContact2); ?>">
                 </div>
            </div>
            <!------------------------------------>
            <h2>Previous Employment History</h2>
            <div class="row">
                <div class="form-group">
                    <label for="employer3">Employer:</label>
                    <input type="text" id="employer3" name="employer3"
                     value="<?php echo htmlspecialchars($employer3); ?>">
                </div>
                <div class="form-group">
                    <label for="address3">Address:</label>
                    <input type="text" id="address3" name="address3"
                     value="<?php echo htmlspecialchars($address3); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="phone3">Phone Number:</label>
                    <input type="text" id="phone3" name="phone3"
                     value="<?php echo htmlspecialchars($phone3); ?>">
                </div>
                <div class="form-group">
                    <label for="job-title3">Your Job Title:</label>
                    <input type="text" id="job-title3" name="job-title3"
                      value="<?php echo htmlspecialchars($jobTitle3); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="start-date3">Start Date:</label>
                    <input type="date" id="start-date3" name="start-date3"
                     value="<?php echo htmlspecialchars($startDate3); ?>">
                </div>
                <div class="form-group">
                    <label for="leaving-date3">Leaving Date:</label>
                    <input type="date" id="leaving-date3" name="leaving-date3"
                     value="<?php echo htmlspecialchars($leavingDate3); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="reason-leaving3">Reason for Leaving:</label>
                    <input type="text" id="reason-leaving3" name="reason-leaving3"
                     value="<?php echo htmlspecialchars($reasonLeaving3); ?>">
                </div>
                <div class="form-group">
                    <label for="referee-name3">Referee Name:</label>
                    <input type="text" id="referee-name3" name="referee-name3"
                      value="<?php echo htmlspecialchars($refereeName3); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="referee-job-title3">Referee Job Title:</label>
                    <input type="text" id="referee-job-title" name="referee-job-title3"
                     value="<?php echo htmlspecialchars($refereeJobTitle3); ?>">
                </div>
                <div class="form-group">
                    <label for="referee-contact3">Referee Phone:</label>
                    <input type="text" id="referee-contact3" name="referee-contact3"
                      value="<?php echo htmlspecialchars($refereeContact3); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="email3">Email:</label>
                    <input type="text" id="email3" name="email3"
                      value="<?php echo htmlspecialchars($email3); ?>">
                </div>
                <div class="form-group">
                    <label for="can-contact3">Can we contact this employer?</label>
                    <input type="text" id="can-contact3" name="can-contact3"
                      value="<?php echo htmlspecialchars($canContact3); ?>">
                 </div>
            </div>
            <!--------------------------------------------->
            <h2>Previous Employment History</h2>
            <div class="row">
                <div class="form-group">
                    <label for="employer4">Employer:</label>
                    <input type="text" id="employer4" name="employer4"
                     value="<?php echo htmlspecialchars($employer4); ?>">
                </div>
                <div class="form-group">
                    <label for="address4">Address:</label>
                    <input type="text" id="address4" name="address4"
                     value="<?php echo htmlspecialchars($address4); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="phone4">Phone Number:</label>
                    <input type="text" id="phone4" name="phone4"
                     value="<?php echo htmlspecialchars($phone4); ?>">
                </div>
                <div class="form-group">
                    <label for="job-title">Your Job Title:</label>
                    <input type="text" id="job-title4" name="job-title4"
                      value="<?php echo htmlspecialchars($jobTitle4); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="start-date4">Start Date:</label>
                    <input type="date" id="start-date4" name="start-date4"
                     value="<?php echo htmlspecialchars($startDate4); ?>">
                </div>
                <div class="form-group">
                    <label for="leaving-date4">Leaving Date:</label>
                    <input type="date" id="leaving-date4" name="leaving-date4"
                     value="<?php echo htmlspecialchars($leavingDate4); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="reason-leaving4">Reason for Leaving:</label>
                    <input type="text" id="reason-leaving4" name="reason-leaving4"
                     value="<?php echo htmlspecialchars($reasonLeaving4); ?>">
                </div>
                <div class="form-group">
                    <label for="referee-name4">Referee Name:</label>
                    <input type="text" id="referee-name4" name="referee-name4"
                      value="<?php echo htmlspecialchars($refereeName4); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="referee-job-title4">Referee Job Title:</label>
                    <input type="text" id="referee-job-title4" name="referee-job-title4"
                     value="<?php echo htmlspecialchars($refereeJobTitle4); ?>">
                </div>
                <div class="form-group">
                    <label for="referee-contact4">Referee Phone:</label>
                    <input type="text" id="referee-contact4" name="referee-contact4"
                      value="<?php echo htmlspecialchars($refereeContact4); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="email4">Email:</label>
                    <input type="text" id="email4" name="email4"
                      value="<?php echo htmlspecialchars($email4); ?>">
                </div>
                <div class="form-group">
                    <label for="can-contact4">Can we contact this employer?</label>
                    <input type="text" id="can-contact4" name="can-contact4"
                      value="<?php echo htmlspecialchars($canContact4); ?>">
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

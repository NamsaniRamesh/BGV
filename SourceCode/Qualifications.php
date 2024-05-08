<?php
session_start();
// Check if user ID is not set in session
 if (!isset($_SESSION['user_id'])) {
      //Redirect to LoginPage.php
     header("Location: LoginPage.php");
     exit; // Stop further execution
 }
// user id from sessions
//$userId = 0;
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

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}// declaring variables
$uniCollege1 = $startDate1 = $leavingDate1 = $courseStudied1 = $qualification1 = $gradeAwarded1 = "";
$uniCollege2 = $startDate2 = $leavingDate2 = $courseStudied2 = $qualification2 = $gradeAwarded2 = "";
$uniCollege3 = $startDate3 = $leavingDate3 = $courseStudied3 = $qualification3 = $gradeAwarded3 = "";
$uniCollege4 = $startDate4 = $leavingDate4 = $courseStudied4 = $qualification4 = $gradeAwarded4 = "";



// Check if the user already has qualifications
$sql_check = "SELECT * FROM qualifications WHERE UserId = $userId"; 
$result = $conn->query($sql_check);

if ($result->num_rows > 0) {
    // User has existing qualifications, update them
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Escape user inputs for security
        $uniCollege1 = $conn->real_escape_string($_POST['uni-college-1']);
        $startDate1 = $conn->real_escape_string($_POST['start-date-1']);
        $leavingDate1 = $conn->real_escape_string($_POST['leaving-date-1']);
        $courseStudied1 = $conn->real_escape_string($_POST['course-studied-1']);
        $qualification1 = $conn->real_escape_string($_POST['qualification-1']);
        $gradeAwarded1 = $conn->real_escape_string($_POST['grade-awarded-1']);

        $uniCollege2 = $conn->real_escape_string($_POST['uni-college-2']);
        $startDate2 = $conn->real_escape_string($_POST['start-date-2']);
        $leavingDate2 = $conn->real_escape_string($_POST['leaving-date-2']);
        $courseStudied2 = $conn->real_escape_string($_POST['course-studied-2']);
        $qualification2 = $conn->real_escape_string($_POST['qualification-2']);
        $gradeAwarded2 = $conn->real_escape_string($_POST['grade-awarded-2']);

        $uniCollege3 = $conn->real_escape_string($_POST['uni-college-3']);
        $startDate3 = $conn->real_escape_string($_POST['start-date-3']);
        $leavingDate3 = $conn->real_escape_string($_POST['leaving-date-3']);
        $courseStudied3 = $conn->real_escape_string($_POST['course-studied-3']);
        $qualification3 = $conn->real_escape_string($_POST['qualification-3']);
        $gradeAwarded3 = $conn->real_escape_string($_POST['grade-awarded-3']);

        $uniCollege4 = $conn->real_escape_string($_POST['uni-college-4']);
        $startDate4 = $conn->real_escape_string($_POST['start-date-4']);
        $leavingDate4 = $conn->real_escape_string($_POST['leaving-date-4']);
        $courseStudied4 = $conn->real_escape_string($_POST['course-studied-4']);
        $qualification4 = $conn->real_escape_string($_POST['qualification-4']);
        $gradeAwarded4 = $conn->real_escape_string($_POST['grade-awarded-4']);

        // SQL query to update existing qualifications
        $sql_update = "UPDATE qualifications 
                        SET UniCollege = '$uniCollege1', StartDate = '$startDate1', LeavingDate = '$leavingDate1', 	
                        CourseStudied = '$courseStudied1',Qualification = '$qualification1', GradeAwarded = '$gradeAwarded1',
                        UniCollegeOne = '$uniCollege2', StartDateOne = '$startDate2', 
                        LeavingDateOne = '$leavingDate2', CourseStudiedOne = '$courseStudied2', 
			            QualificationOne = '$qualification2',GradeAwardedOne = '$gradeAwarded2',

                        UniCollege2 = '$uniCollege3', StartDate2 = '$startDate3', 
                        LeavingDate2 = '$leavingDate3', CourseStudied2 = '$courseStudied3', 
			            Qualification2 = '$qualification3',GradeAwarded2 = '$gradeAwarded3',
                        
                        UniCollege3 = '$uniCollege4', StartDate3 = '$startDate4', 
                        LeavingDate3 = '$leavingDate4', CourseStudied3 = '$courseStudied4', 
			            Qualification3 = '$qualification4',GradeAwarded3 = '$gradeAwarded4'";
                        

        // Execute the update query
        if ($conn->query($sql_update) === TRUE) {
            $message = "Qualifications updated successfully";
        } else {
            echo "Error updating qualifications: " . $conn->error;
        }
    }
} else {
    // User does not have existing qualifications, insert new records
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Escape user inputs for security
        $uniCollege1 = $conn->real_escape_string($_POST['uni-college-1']);
        $startDate1 = $conn->real_escape_string($_POST['start-date-1']);
        $leavingDate1 = $conn->real_escape_string($_POST['leaving-date-1']);
        $courseStudied1 = $conn->real_escape_string($_POST['course-studied-1']);
        $qualification1 = $conn->real_escape_string($_POST['qualification-1']);
        $gradeAwarded1 = $conn->real_escape_string($_POST['grade-awarded-1']);

        $uniCollege2 = $conn->real_escape_string($_POST['uni-college-2']);
        $startDate2 = $conn->real_escape_string($_POST['start-date-2']);
        $leavingDate2 = $conn->real_escape_string($_POST['leaving-date-2']);
        $courseStudied2 = $conn->real_escape_string($_POST['course-studied-2']);
        $qualification2 = $conn->real_escape_string($_POST['qualification-2']);
        $gradeAwarded2 = $conn->real_escape_string($_POST['grade-awarded-2']);

        $uniCollege3 = $conn->real_escape_string($_POST['uni-college-3']);
        $startDate3 = $conn->real_escape_string($_POST['start-date-3']);
        $leavingDate3 = $conn->real_escape_string($_POST['leaving-date-3']);
        $courseStudied3 = $conn->real_escape_string($_POST['course-studied-3']);
        $qualification3 = $conn->real_escape_string($_POST['qualification-3']);
        $gradeAwarded3 = $conn->real_escape_string($_POST['grade-awarded-3']);

        $uniCollege4 = $conn->real_escape_string($_POST['uni-college-4']);
        $startDate4 = $conn->real_escape_string($_POST['start-date-4']);
        $leavingDate4 = $conn->real_escape_string($_POST['leaving-date-4']);
        $courseStudied4 = $conn->real_escape_string($_POST['course-studied-4']);
        $qualification4 = $conn->real_escape_string($_POST['qualification-4']);
        $gradeAwarded4 = $conn->real_escape_string($_POST['grade-awarded-4']);

        // SQL query to insert new qualifications
        $sql_insert = "INSERT INTO qualifications (UserId, UniCollege, StartDate, LeavingDate, CourseStudied, 
        Qualification, GradeAwarded,
        UniCollegeOne, StartDateOne, LeavingDateOne, CourseStudiedOne, QualificationOne, 	GradeAwardedOne,
        UniCollege2, StartDate2, LeavingDate2, CourseStudied2, Qualification2, 	GradeAwarded2,
        UniCollege3, StartDate3, LeavingDate3, CourseStudied3, Qualification3, 	GradeAwarded3)
        VALUES ($userId, '$uniCollege1', '$startDate1', '$leavingDate1', '$courseStudied1', '$qualification1', '$gradeAwarded1',
        '$uniCollege2', '$startDate2', '$leavingDate2', '$courseStudied2', '$qualification2', '$gradeAwarded2',
        '$uniCollege3','$startDate3', '$leavingDate3', '$courseStudied3', '$qualification3', '$gradeAwarded3',
        '$uniCollege3','$startDate4', '$leavingDate4', '$courseStudied4', '$qualification4', '$gradeAwarded4')";

        // Execute the insert query
        if ($conn->multi_query($sql_insert) === TRUE) {
             $message = "Qualifications saved successfully";
        } else {
            echo "Error inserting qualifications: " . $conn->error;
        }
    }
}
// Fetch data from the database
$sql = "SELECT * FROM Qualifications Where UserId = $userId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch data and store it in variables
    $row = $result->fetch_assoc();
    $uniCollege1 = $row['UniCollege'];
    $startDate1 = $row['StartDate'];
    $leavingDate1 = $row['LeavingDate'];
    $courseStudied1 = $row['CourseStudied'];
    $qualification1 = $row['Qualification'];
    $gradeAwarded1 = $row['GradeAwarded'];
    $uniCollege2 = $row['UniCollegeOne'];
    $startDate2 = $row['StartDateOne'];
    $leavingDate2 = $row['LeavingDateOne'];
    $courseStudied2 = $row['CourseStudiedOne'];
    $qualification2 = $row['QualificationOne'];
    $gradeAwarded2 = $row['GradeAwardedOne']; 
    
    $uniCollege3 = $row['UniCollege2'];
    $startDate3 = $row['StartDate2'];
    $leavingDate3 = $row['LeavingDate2'];
    $courseStudied3 = $row['CourseStudied2'];
    $qualification3 = $row['Qualification2'];
    $gradeAwarded3 = $row['GradeAwarded2']; 

    $uniCollege4 = $row['UniCollege3'];
    $startDate4 = $row['StartDate3'];
    $leavingDate4 = $row['LeavingDate3'];
    $courseStudied4 = $row['CourseStudied3'];
    $qualification4 = $row['Qualification3'];
    $gradeAwarded4 = $row['GradeAwarded3']; 
} 
//destroy the session

// Close connection
$conn->close();
//session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qualifications</title>
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
    <div class="container qualifications">
        <h2>Qualifications</h2>
		<!-- Display the message if set -->
        <?php if(!empty($message)): ?>
            <div class="message" id = "successMessage"><?php echo $message; ?></div>
        <?php endif; ?>
        <form action="Qualifications.php" method="post">
            <div class="qualification-1">
                <h3>Qualification 1:</h3>
                <div class="form-group">
                    <label for="uni-college-1">University / College:</label>
                    <input type="text" id="uni-college-1" name="uni-college-1" value="<?php echo htmlspecialchars($uniCollege1); ?>">
                </div>
                <div class="form-group">
                    <label for="start-date-1">Start Date:</label>
                    <input type="date" id="start-date-1" name="start-date-1" value="<?php echo htmlspecialchars($startDate1); ?>">
                </div>
                <div class="form-group">
                    <label for="leaving-date-1">Leaving Date:</label>
                    <input type="date" id="leaving-date-1" name="leaving-date-1" value="<?php echo htmlspecialchars($leavingDate1); ?>">
                </div>
                <div class="form-group">
                    <label for="course-studied-1">Course Studied:</label>
                    <input type="text" id="course-studied-1" name="course-studied-1" value="<?php echo 					htmlspecialchars($courseStudied1); ?>">
                </div>
                <div class="form-group">
                    <label for="qualification-1">Qualification:</label>
                    <input type="text" id="qualification-1" name="qualification-1" value="<?php echo htmlspecialchars($qualification1); ?>">
                </div>
                <div class="form-group">
                    <label for="grade-awarded-1">Grade Awarded:</label>
                    <input type="text" id="grade-awarded-1" name="grade-awarded-1" value="<?php echo htmlspecialchars($gradeAwarded1); ?>">
                </div>
            </div>            
            <div class="qualification-2">
                <h3>Qualification 2:</h3>
                <div class="form-group">
                    <label for="uni-college-2">University / College:</label>
                    <input type="text" id="uni-college-2" name="uni-college-2" value="<?php echo htmlspecialchars($uniCollege2); ?>">
                </div>
                <div class="form-group">
                    <label for="start-date-2">Start Date:</label>
                    <input type="date" id="start-date-2" name="start-date-2" value="<?php echo htmlspecialchars($startDate2); ?>">
                </div>
                <div class="form-group">
                    <label for="leaving-date-2">Leaving Date:</label>
                    <input type="date" id="leaving-date-2" name="leaving-date-2" value="<?php echo htmlspecialchars($leavingDate2); ?>">
                </div>
                <div class="form-group">
                    <label for="course-studied-2">Course Studied:</label>
                    <input type="text" id="course-studied-2" name="course-studied-2" value="<?php echo htmlspecialchars($courseStudied2); ?>">
                </div>
                <div class="form-group">
                    <label for="qualification-2">Qualification:</label>
                    <input type="text" id="qualification-2" name="qualification-2" value="<?php echo htmlspecialchars($qualification2); ?>">
                </div>
                <div class="form-group">
                    <label for="grade-awarded-2">Grade Awarded:</label>
                    <input type="text" id="grade-awarded-2" name="grade-awarded-2" value="<?php echo htmlspecialchars($gradeAwarded2); ?>">
                </div>
            </div>
            <div class="qualification-2">
                <h3>Qualification 3:</h3>
                <div class="form-group">
                    <label for="uni-college-3">University / College:</label>
                    <input type="text" id="uni-college-3" name="uni-college-3" value="<?php echo htmlspecialchars($uniCollege3); ?>">
                </div>
                <div class="form-group">
                    <label for="start-date-3">Start Date:</label>
                    <input type="date" id="start-date-3" name="start-date-3" value="<?php echo htmlspecialchars($startDate3); ?>">
                </div>
                <div class="form-group">
                    <label for="leaving-date-3">Leaving Date:</label>
                    <input type="date" id="leaving-date-3" name="leaving-date-3" value="<?php echo htmlspecialchars($leavingDate3); ?>">
                </div>
                <div class="form-group">
                    <label for="course-studied-3">Course Studied:</label>
                    <input type="text" id="course-studied-3" name="course-studied-3" value="<?php echo htmlspecialchars($courseStudied3); ?>">
                </div>
                <div class="form-group">
                    <label for="qualification-3">Qualification:</label>
                    <input type="text" id="qualification-3" name="qualification-3" value="<?php echo htmlspecialchars($qualification3); ?>">
                </div>
                <div class="form-group">
                    <label for="grade-awarded-3">Grade Awarded:</label>
                    <input type="text" id="grade-awarded-3" name="grade-awarded-3" value="<?php echo htmlspecialchars($gradeAwarded3); ?>">
                </div>
            </div>
            <div class="qualification-2">
                <h3>Qualification 4:</h3>
                <div class="form-group">
                    <label for="uni-college-4">University / College:</label>
                    <input type="text" id="uni-college-4" name="uni-college-4" value="<?php echo htmlspecialchars($uniCollege4); ?>">
                </div>
                <div class="form-group">
                    <label for="start-date-4">Start Date:</label>
                    <input type="date" id="start-date-4" name="start-date-4" value="<?php echo htmlspecialchars($startDate4); ?>">
                </div>
                <div class="form-group">
                    <label for="leaving-date-4">Leaving Date:</label>
                    <input type="date" id="leaving-date-4" name="leaving-date-4" value="<?php echo htmlspecialchars($leavingDate4); ?>">
                </div>
                <div class="form-group">
                    <label for="course-studied-4">Course Studied:</label>
                    <input type="text" id="course-studied-4" name="course-studied-4" value="<?php echo htmlspecialchars($courseStudied4); ?>">
                </div>
                <div class="form-group">
                    <label for="qualification-4">Qualification:</label>
                    <input type="text" id="qualification-4" name="qualification-4" value="<?php echo htmlspecialchars($qualification4); ?>">
                </div>
                <div class="form-group">
                    <label for="grade-awarded-4">Grade Awarded:</label>
                    <input type="text" id="grade-awarded-4" name="grade-awarded-4" value="<?php echo htmlspecialchars($gradeAwarded4); ?>">
                </div>
            </div>
            <div class="button-container">
                <button type="submit">Submit</button>
                <div>
                <button type="button" id="previousButton" onclick="window.location.href='EmploymentHistory.php';">Previous</button>
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

<?php
session_start();
// Check if user ID is not set in session
 if (!isset($_SESSION['user_id'])) {
      //Redirect to LoginPage.php
     header("Location: LoginPage.php");
     exit; // Stop further execution
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            position: relative;
        }
        .header-container {
            position: sticky;
            top: 0;
            background-color: Green;
            z-index: 1;
color: white;
        }
        .header-container h2 {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            white-space: nowrap;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: green;//#f2f2f2
            font-weight: bold;
            color: white;//#333
        }
        tr:hover {
            background-color: #f5f5f5;
            cursor: pointer;
        }
        .export-btn {
        position: absolute;
        top: 8px;
        right: 20px;
        padding: 0; /* Remove padding */
        background: White; /* Remove background color */
        border: none; /* Remove border */
        cursor: pointer;
}
        .export-btn:hover {
            background-color: #45a049;
        }
		.search-container {
            position: absolute;
        top: 8px;
        right: 80px;
        padding: 0; /* Remove padding */
        //background: White; /* Remove background color */
        border: none; /* Remove border */
        cursor: pointer;
        }
		.user-container {
        position: absolute;
		top: 8px;
		right: 280px;
		padding: 7px 12px; /* Increased padding */
		background-color: #4caf50; /* Background color */
		border: none;
		cursor: pointer;
		color: white; /* Text color */
		font-size: 16px; /* Adjusted font size */
		border-radius: 4px;
        }
        .logout-container {
        position: absolute;
		top: 8px;
		right: 410px;
		padding: 7px 12px; /* Increased padding */
		background-color: #4caf50; /* Background color */
		border: none;
		cursor: pointer;
		color: white; /* Text color */
		font-size: 16px; /* Adjusted font size */
		border-radius: 4px;
        }
        input[type="text"] {
            padding: 8px;
            width: 90%;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="header-container">
        <h2>User Details</h2>
         <button class="export-btn" onclick="exportToExcel()"><img src="ExporttoExcel.png" alt="Export to Excel"   	style="width: 32px; height: 32px;">   	</button>
		<div class="search-container">
         <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for user...">
        </div>
		<div class="user-container">
         <button type="button" onclick="window.location.href='CreateUser.php';">Create user</button>
        </div>
        <div class="logout-container">
         <button type="button" onclick="window.location.href='LogOut.php';">LogOut</button>
        </div>
	</div>
    <div style="overflow-x: auto;">
        <table id="user-details-table">
            <tr>
                <th>Title</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Family Name</th>
                <th>Date of Birth</th>
                <th>Different Name Option</th>
                <th>Previous First Name</th>
                <th>Previous Middle Name</th>
                <th>Previous Family Name</th>
                <th>Date of Change</th>
                <th>Town of Birth</th>
                <th>Country of Birth</th>
                <th>Nationality</th>
                <th>Mother's Maiden Familyname</th>
                <th>UK National Insurance Number</th>
                <th>Passport</th>
                <th>Country of Passport Issue</th>
                <th>Driving Licence</th>
                <th>Country of Driving Licence Issue</th>
                <th>Driving Licence Number</th>
                <th>Employer</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Your Job Title</th>
                <th>Start Date</th>
                <th>Leaving Date</th>
                <th>Reason for Leaving</th>
                <th>Referee Name</th>
                <th>Referee Job Title</th>
                <th>Referee Phone</th>
                <th>Email</th>
                <th>Can we contact this Employer</th>
                <th>Current Address</th>
                <th>Current Town/City</th>
                <th>Current Postcode</th>
                <th>Current Country</th>
                <th>Moved In Date</th>
                <th>Previous Address</th>
                <th>Previous Town/City</th>
                <th>Previous Postcode</th>
                <th>Previous Country</th>
                <th>Previous Moved In Date</th>
            </tr>
            <?php
			
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

            // Fetch saved details from the database
            $sql_fetch_user = "SELECT *, usr.ID AS SingleUserID 
            FROM userdetails usr 
            LEFT JOIN additionalpersonaldetails dap ON usr.ID = dap.ID
            LEFT JOIN employmenthistory emphst ON usr.id = emphst.UserID
            LEFT JOIN addresshistory addhst ON usr.id = addhst.UserID";
            $result = $conn->query($sql_fetch_user);

            // Loop through each user's details
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Extract user details from the current row
                    $userId = $row['SingleUserID'];
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

                    // Display user details in a table row with navigation to PersonalDetails.php
                    echo "<tr onclick=\"window.location='PersonalDetails.php?id=$userId';\">";
                    echo "<td>$title</td>";
                    echo "<td>$firstName</td>";
                    echo "<td>$middleName</td>";
                    echo "<td>$familyName</td>";
                    echo "<td>$dob</td>";
                    echo "<td>$differentNameOption</td>";
                    echo "<td>$pFirstName</td>";
                    echo "<td>$pMiddleName</td>";
                    echo "<td>$pFamilyName</td>";
                    echo "<td>$dateOfChange</td>";
                    echo "<td>$townOfBirth</td>";
                    echo "<td>$countryOfBirth</td>";
                    echo "<td>$nationality</td>";
                    echo "<td>$mothersMaidenFamilyname</td>";
                    echo "<td>$ukNationalInsuranceNumber</td>";
                    echo "<td>$passport</td>";
                    echo "<td>$countryOfPassportIssue</td>";
                    echo "<td>$drivingLicence</td>";
                    echo "<td>$countryOfDrivingLicenceIssue</td>";
                    echo "<td>$drivingLicenceNumber</td>";
                    echo "<td>$employer</td>";
                    echo "<td>$address</td>";
                    echo "<td>$phone</td>";
                    echo "<td>$jobTitle</td>";
                    echo "<td>$startDate</td>";
                    echo "<td>$leavingDate</td>";
                    echo "<td>$reasonLeaving</td>";
                    echo "<td>$refereeName</td>";
                    echo "<td>$refereeJobTitle</td>";
                    echo "<td>$refereeContact</td>";
                    echo "<td>$email</td>";
                    echo "<td>$canContact</td>";
                    echo "<td>$currentAddress</td>";
                    echo "<td>$currentTownCity</td>";
                    echo "<td>$currentPostcode</td>";
                    echo "<td>$currentCountry</td>";
                    echo "<td>$movedInDate</td>";
                    echo "<td>$previousAddress</td>";
                    echo "<td>$previousTownCity</td>";
                    echo "<td>$previousPostcode</td>";
                    echo "<td>$previousCountry</td>";
                    echo "<td>$previousMovedInDate</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='44'>No records found.</td></tr>";
            }

            // Close connection
            $conn->close();
            ?>
        </table>
    </div>
    <script>
        function exportToExcel() {
            // Reference the table
            var table = document.getElementById("user-details-table");

            // Create a new Excel file content
            var excelContent = '';

            // Add table headers
            for (var i = 0; i < table.rows[0].cells.length; i++) {
                excelContent += table.rows[0].cells[i].innerHTML + '\t';
            }
            excelContent += '\n';

            // Add table data
            for (var i = 1; i < table.rows.length; i++) {
                for (var j = 0; j < table.rows[i].cells.length; j++) {
                    excelContent += table.rows[i].cells[j].innerHTML + '\t';
                }
                excelContent += '\n';
            }

            // Create a Blob containing the Excel file data
            var blob = new Blob([excelContent], { type: 'application/vnd.ms-excel' });

            // Create a link element to download the Excel file
            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = 'user_details.xls';
            link.click();
        }
		 function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("user-details-table");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                tds = tr[i].getElementsByTagName("td");
                for (var j = 0; j < tds.length; j++) {
                    td = tds[j];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
        }
    </script>
</body>
</html>

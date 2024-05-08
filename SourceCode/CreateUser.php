<?php
session_start();
 if (!isset($_SESSION['user_id'])) {
      //Redirect to LoginPage.php
     header("Location: LoginPage.php");
     exit; // Stop further execution
 }
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $servername = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "bgverification";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    // $firstname = $_POST["first_name"];
    // $lastname = $_POST["last_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
	$role = $_POST["role"];
    $companyName = $_POST["companyName"];

    // Hash the password (for security)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement to insert user data into the database
            $sql_insert = "INSERT INTO userdetails (Email, Password, Role, CompanyName) VALUES ('$email', '$hashed_password','$role','$companyName')";
	
			if ($conn->query($sql_insert) === TRUE) {
                $message = "User Created Successfully";               
            } else {
                echo "Error inserting record: " . $conn->error;
            }

    // Close statement and connection
    //$stmt->close();
    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <style>
        

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
            /* background-color: #444;
            color: #fff;
            padding: 10px 0;
            text-align: center; */
            background-color: #444;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            position: fixed;
            top: 8.9%;
            width: 100%;            
        }

        nav a {
            text-decoration: none;
            color: #fff;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 5px;
            background-color: #555;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #777;
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
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            max-width: 80%; /* Adjusted maximum width */
        }
        h2 {
            text-align: center;
            margin-bottom: 20px; /* Added margin */
            margin-top: -5px; 
        }
        label {
            display: block;
            margin-bottom: 0px; /* Reduced margin */
            
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px; /* Increased padding */
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s; /* Added transition */
        }
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #4caf50; /* Highlight on focus */
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 12px 20px; /* Increased padding */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s; /* Added transition */
        }
        input[type="submit"]:hover {
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
<header>
        <img src="Accenture.Jpg" alt="Company Logo">
        <h1>Background Verification</h1>
    </header>
    <nav>
        <a href="#" onclick="window.location.href='UserList.php';">User List</a>        
        <button class="logout-btn" onclick="window.location.href='LogOut.php';">Logout</button>
    </nav>
    <form action="Createuser.php" method="POST">
        <?php if(!empty($message)): ?>
            <div class="message" id="successMessage"><?php echo $message; ?></div>
        <?php endif; ?>
        <h2>Create User</h2>        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        <label for="role">Role:</label>
        <input type="text" id="role" name="role"> <!-- Changed input type to "text" -->
        <label for="companyName">Company Name:</label>
        <input type="text" id="companyName" name="companyName" required>
        <input type="submit" value="Create User">
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
    <footer>
        &copy; 2024 Company Name. All rights reserved.
    </footer>
</body>
</html>


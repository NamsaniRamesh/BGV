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

    // Hash the password (for security)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement to insert user data into the database
            $sql_insert = "INSERT INTO userdetails (Email, Password, Role) VALUES ('$email', '$hashed_password','$role')";
	
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
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
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
        }
        label {
            display: block;
            margin-bottom: 8px; /* Reduced margin */
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
        <input type="text" id="role" name="role" required> <!-- Changed input type to "text" -->

        <input type="submit" value="Create User">
    </form>
</body>
</html>


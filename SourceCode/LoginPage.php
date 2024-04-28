<?php
session_start(); // Start session

// Check if the form is submitted
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

    // Escape user inputs for security
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // SQL query to retrieve the hashed password for the given username
    $sql = "SELECT id,Role, Password FROM userdetails WHERE Email='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User found, verify password
        $row = $result->fetch_assoc();
        $hashed_password = $row['Password'];
        if (password_verify($password, $hashed_password)) {
            // Password is correct, set session variables and redirect to PersonalDetails.php
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $row['id']; // Store user ID in session
            if ($row['Role'] == 'Admin') {
                header("Location: UserList.php");
            } else {
                header("Location: PersonalDetails.php");
            }
            exit; // Prevent further execution
        }
    }

    // Invalid username or password, redirect back to login page with error message
    $_SESSION['message'] = "Invalid username or password";
    header("Location: LoginPage.php");

    // Close connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('pexels-ketut-subiyanto-4246182.jpg'); /* Background image from Unsplash */
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: rgba(255, 255, 255, 0.5); /* Semi-transparent background */
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        label {
            display: flex;
            align-items: center; /* Align text and icon vertically */
            margin-bottom: 5px;
            color: #666;
        }
        label img {
            margin-right: 10px; /* Add space between icon and text */
            width: 20px; /* Adjust icon size */
        }
        input[type="text"],
        input[type="password"] {
            width: calc(100% - 30px); /* Adjust input width to accommodate icon */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            background-color: transparent; /* Transparent background */
            margin-bottom: 10px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #4caf50; /* Highlight border color on focus */
            outline: none;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5); /* Highlight shadow on focus */
        }
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php
        // Display error message if present
        if (isset($_SESSION['message'])) {
            echo '<p class="error-message">' . $_SESSION['message'] . '</p>';
            unset($_SESSION['message']); // Clear the message after displaying it
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="username"><img src="UserNameIcon.png" alt="Username icon"> Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password"><img src="PasswordIcon.png" alt="Password icon"> Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Login">
            </div>
        </form>
    </div>
</body>
</html>

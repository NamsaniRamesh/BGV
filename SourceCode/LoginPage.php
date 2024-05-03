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
        else{
            $message = "Please Enter Valid User Id/Password";
        }
    }
    else{
        $message = "Please Enter Valid User Id/Password";
    }
    

    // Invalid username or password, redirect back to login page with error message
    // $message = "Please Enter Valid User Id/Password";
    // header("Location: LoginPage.php");

    // Close connection
    $conn->close();
}
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="login-style.css" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if(!empty($message)): ?>
            <div class="message" id = "successMessage"><?php echo $message; ?></div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="username"><img src="UserNameIcon.png" alt="Username icon"> User Id:</label>
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

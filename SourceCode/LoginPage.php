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


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

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

<?php
session_start();

// Check if logout button is clicked
if (isset($_POST['logout'])) {
    // Destroy session
    session_destroy();
    // Redirect to login page
    header("Location: LoginPage.php");
    exit; // Stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Example</title>
</head>
<body>
    <div style="text-align: center;">
        <!-- Logout button -->
        <form method="post">
            <button type="submit" name="logout">Log Out</button>
        </form>
    </div>
    <!-- Your page content here -->
</body>
</html>

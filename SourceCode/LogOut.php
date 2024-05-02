<?php
session_start();

// Check if logout button is clicked

    // Destroy session
    session_destroy();
    // Redirect to login page
    header("Location: LoginPage.php");
    exit; // Stop further execution

?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Example</title>
    <link href="login-style.css" rel="stylesheet">
</head>
<body>
    <div style="text-align: center;">
        Logout button 
<div><h4>Click to LogOut button Redirect to Login page</h4></div>
        <form method="post">
            
            <button type="submit" name="logout" class="logout">Log Out</button>
        </form>
    </div>
    Your page content here 
</body>
</html> -->

<?php
// Database connection
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "backgroundverification";

// Create connection
$conn = @mysqli_connect($servername, $username, $password);

 if($conn) {
	//echo "connected";
		if(mysqli_select_db($conn , $dbname))
			{
			echo "connected to bd";
			}
		else{
			echo "not connected to db";
			}
	}else
	{
		echo "could not connect to server";
	}
?>

<?php	


function ConnectToServer()
{
	$servername = "mysql.cs.mtsu.edu";
	$username = "vr2m";
	$password = "Password";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password);

	// Check connection
	if (!$conn) 
		die("Connection to DB failed: " . mysqli_connect_error());

	return $conn;
}

?>
<?php

// start session
session_start();

require_once ("functions.php");


// Send a raw HTTP header with the media type
header("Content-Type: text/html;charset=utf-8");


if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$login = $_POST['login'];
	$passw = md5($_POST['pass']);


	$_SESSION['login'] = $login;
	$_SESSION['passw'] = $passw;


	// Create connection
	$conn = ConnectToServer(); 
	// connect to database
	mysqli_query($conn, "use db_project");


	// query type of the user
	$sql = "SELECT Usertype FROM LOGIN_USER WHERE Username = '" . $login . "' and Password = '" . $passw . "'";
	$result = mysqli_query($conn, $sql);

	$row = mysqli_fetch_assoc($result);

	$_SESSION['Usertype'] = $row["Usertype"];

	if (mysqli_num_rows($result) > 0)
	{
		if ($row["Usertype"] == 'T')
			header('Location: teacher.php');
		if ($row["Usertype"] == 'S')
			header('Location: student.php');
	}
	else
		echo "Login or Password is wrong";
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<body>

<h1>Database project</h1>

<!-- form with login and password -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	login<br/>     <input type="text" name="login" /><br/>
	password<br/>  <input type="text" name="pass"  /><br/>
	<br />
	<input type="submit" value="Enter" />
</form>

</body>
</html>
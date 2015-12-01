<?php

// start session
session_start();

require_once ("functions.php");


// Send a raw HTTP header with the media type
header("Content-Type: text/html;charset=utf-8");


$login = $_SESSION['login'];
$passw = $_SESSION['passw'];


// if user is not logged in redirect him to login page
if(empty($_SESSION['login'])) 
	header('Location: index.php');
if( $_SESSION['Usertype'] == 'T' )
	header('Location: teacher.php');
elseif ( $_SESSION['Usertype'] != 'S' )
{
	session_destroy();
	header('Location: index.php');
}


// Create connection
$conn = ConnectToServer(); 
// connect to database
mysqli_query($conn, "use db_project");

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	if(isset($_POST['SignOut'])) 
	{ 
		session_destroy();
		header('Location: index.php');
	}
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
<style>
	table, th, td 
	{
		border: 1px solid black;
	}
</style>
</head>

<body>

<h1>Student page</h1>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="submit" name="SignOut" value="Sign out" />
</form>
</br>

<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	if (isset($_POST['ViewAllAlerts'])) 
	{ 
		echo "<h3>Email Alerts</h3>";
		$sql = "call ShowEmailAlert('".$login."')";
		$result = mysqli_query($conn, $sql);

		echo "<table> <tr><th> Course Name</th> <th>CRN</th> <th>Name</th>";
		echo "</td>";
		if (mysqli_num_rows($result) > 0) 
		{
   			// output data of each row
   			while($row = mysqli_fetch_assoc($result)) 
				echo "<tr><th>".$row["CourseNum"]."</th> <th>".$row["CRN"]."</th> <th>".$row["Name"]."</th>";
		}
		echo "</table>";
	} 
	elseif(isset($_POST['AddEmailAlert'])) 
	{ 
		$sql = "call AddEmailAlert('".$login."','".$_POST['Coursework_name']."', '".$_POST['CRN']."')";
		$result = mysqli_query($conn, $sql);
	}
	elseif(isset($_POST['DeleteEmailAlert'])) 
	{ 
		$sql = "call DeleteEmailAlert('".$login."','".$_POST['Coursework_name']."', '".$_POST['CRN']."')";
		$result = mysqli_query($conn, $sql);
	}  
	else
	{
		if(isset($_POST['ViewAllAvailable'])) 
		{ 
			echo "<h3>Available Coursework</h3>";
			$sql = "call showAllAvailCourseWork('".$login."')";
			$result = mysqli_query($conn, $sql);
		} 
		if(isset($_POST['ViewAvailableProjects'])) 
		{ 
			echo "<h3>Available Projects</h3>";
			$sql = "call showAvailCourseWork('".$login."','PJ')";
			$result = mysqli_query($conn, $sql);
		} 
		if(isset($_POST['ViewAvailableHW'])) 
		{ 
			echo "<h3>Available Homeworks</h3>";
			$sql = "call showAvailCourseWork('".$login."','HW')";
			$result = mysqli_query($conn, $sql);
		} 
		if(isset($_POST['ViewAvailableCL'])) 
		{ 
			echo "<h3>Available Closed labs</h3>";
			$sql = "call showAvailCourseWork('".$login."','CL')";
			$result = mysqli_query($conn, $sql);
		} 
		if(isset($_POST['ViewAvailablePR'])) 
		{ 
			echo "<h3>Available Presentations</h3>";
			$sql = "call showAvailCourseWork('".$login."','PR')";
			$result = mysqli_query($conn, $sql);
		} 
		if(isset($_POST['ViewAvailableRP'])) 
		{ 
			echo "<h3>Available Research projects</h3>";
			$sql = "call showAvailCourseWork('".$login."','RP')";
			$result = mysqli_query($conn, $sql);
		} 
		if(isset($_POST['ViewAvailableSV'])) 
		{ 
			echo "<h3>Available Surveys</h3>";
			$sql = "call showAvailCourseWork('".$login."','SV')";
			$result = mysqli_query($conn, $sql);
		} 
		if(isset($_POST['ViewAvailableOT'])) 
		{ 
			echo "<h3>Available Other</h3>";
			$sql = "call showAvailCourseWork('".$login."','OT')";
			$result = mysqli_query($conn, $sql);
		} 
		//////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////
		if(isset($_POST['ViewAllActive'])) 
		{ 
			echo "<h3>Active CourseWork</h3>";
			$sql = "call showAllAvailCourseWork('".$login."')";
			$result = mysqli_query($conn, $sql);
		} 
		if(isset($_POST['ViewActiveProjects'])) 
		{ 
			echo "<h3>Active Projects</h3>";
			$sql = "call showAvailCourseWork('".$login."','PJ')";
			$result = mysqli_query($conn, $sql);
		} 
		if(isset($_POST['ViewActiveHW'])) 
		{ 
			echo "<h3>Active Homeworks</h3>";
			$sql = "call showAvailCourseWork('".$login."','HW')";
			$result = mysqli_query($conn, $sql);
		} 
		if(isset($_POST['ViewActiveCL'])) 
		{ 
			echo "<h3>Active Closed labs</h3>";
			$sql = "call showAvailCourseWork('".$login."','CL')";
			$result = mysqli_query($conn, $sql);
		} 
		if(isset($_POST['ViewActivePR'])) 
		{ 
			echo "<h3>Active Presentations</h3>";
			$sql = "call showAvailCourseWork('".$login."','PR')";
			$result = mysqli_query($conn, $sql);
		} 
		if(isset($_POST['ViewActiveRP'])) 
		{ 
			echo "<h3>Active Research projects</h3>";
			$sql = "call showAvailCourseWork('".$login."','RP')";
			$result = mysqli_query($conn, $sql);
		} 
		if(isset($_POST['ViewActiveSV'])) 
		{ 
			echo "<h3>Active Surveys</h3>";
			$sql = "call showAvailCourseWork('".$login."','SV')";
			$result = mysqli_query($conn, $sql);
		} 
		if(isset($_POST['ViewActiveOT'])) 
		{ 
			echo "<h3>Active Other</h3>";
			$sql = "call showAvailCourseWork('".$login."','OT')";
			$result = mysqli_query($conn, $sql);
		} 

		echo "<table> <tr><th>Course</th> <th>CRN</th> <th>Name</th> <th>Assign_date</th> <th>Due_date</th> <th>Description</th> </tr>";
		echo "</td>";
		if (mysqli_num_rows($result) > 0) 
		{
		   	// output data of each row
    		while($row = mysqli_fetch_assoc($result)) 
				echo "<tr><th>".$row["eCourseNum"]."</th> <th>".$row["eCRN"]."</th> <th>".$row["Name"]."</th> <th>".$row["Assign_date"]."</th> <th>".$row["Due_date"]."</th> <th>". "<a href='".$row["eDescription"]."'>Description</a>" ."</th> </tr>";
		}
		echo "</table>";
	}
}
?>


<h3>Add email alert</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="text" name="CRN"/> CRN <br/>
	<input type="text" name="Coursework_name"/> Coursework name <br/>
	<input type="submit" name="AddEmailAlert" value="Enter" />
</form>


<h3>Delete email alert</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="text" name="CRN"/> CRN <br/>
	<input type="text" name="Coursework_name"/> Coursework name <br/>
	<input type="submit" name="DeleteEmailAlert" value="Enter" />
</form>
</br>
</br>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="submit" name="ViewAllAlerts" value="View all email alerts" style="width:200px" />
</form>
</br>


<h3>View available</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="submit" name="ViewAllAvailable" value="Coursework" style="width:200px" />
</form>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="submit" name="ViewAvailableProjects" value="Projects" style="width:200px" />
</form>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="submit" name="ViewAvailableHW" value="Homework" style="width:200px" />
</form>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="submit" name="ViewAvailableCL" value="Closed Labs" style="width:200px" />
</form>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="submit" name="ViewAvailablePR" value="Presentations" style="width:200px" />
</form>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="submit" name="ViewAvailableRP" value="Research Papers" style="width:200px" />
</form>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="submit" name="ViewAvailableSV" value="Surveys" style="width:200px" />
</form>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="submit" name="ViewAvailableOT" value="Other" style="width:200px" />
</form>
</br>
</br>


<h3>View active</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="submit" name="ViewAllActive" value="Coursework" style="width:200px" />
</form>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="submit" name="ViewActiveProjects" value="Projects" style="width:200px" />
</form>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="submit" name="ViewActiveHW" value="Homework" style="width:200px" />
</form>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="submit" name="ViewActiveCL" value="Closed Labs" style="width:200px" />
</form>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="submit" name="ViewActivePR" value="Presentations" style="width:200px" />
</form>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="submit" name="ViewActiveRP" value="Research Papers" style="width:200px" />
</form>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="submit" name="ViewActiveSV" value="Surveys" style="width:200px" />
</form>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="submit" name="ViewActiveOT" value="Other" style="width:200px" />
</form>
 
</body>
</html>
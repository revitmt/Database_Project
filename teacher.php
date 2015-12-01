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
if( $_SESSION['Usertype'] == 'S' )
	header('Location: student.php');
elseif ( $_SESSION['Usertype'] != 'T' )
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
table, th, td {
     border: 1px solid black;
}
</style>
</head>

<body>

<h1>Instructor page</h1>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="submit" name="SignOut" value="Sign out" />
</form>
</br>

<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	{
		if(isset($_POST['CreateCourseWork'])) 
		{ 
			$sql =  "call addCourseWork('".$_POST['cNum']."','".$_POST['cName']."','".$_POST['sNum']."','".$_POST['eDes']."','".$_POST['aDate']."','".$_POST['dDate']."','".$_POST['wtype']."')";
			$result = mysqli_query($conn, $sql);
		} 
		if(isset($_POST['EditCourseWork'])) 
		{ 
			$sql =  "call editAssignDueDate('".$_POST['cName']."','".$_POST['c_crn']."','".$_POST['aDate']."','".$_POST['dDate']."')";
			$result = mysqli_query($conn, $sql);
		} 
		if(isset($_POST['DeleteCourseWork'])) 
		{ 
			$sql =  "call deleteCourseWork('".$_POST['cName']."','".$_POST['crnNum']."')";
			$result = mysqli_query($conn, $sql);
		} 
		if(isset($_POST['ViewAllCourseWork'])) 
		{ 
			$sql =  "call courseWorkOfInstructor('".$login."')";
			$result = mysqli_query($conn, $sql);

			echo "<table> <tr><th>Course</th><th>CRN</th> <th>Section</th> <th>Name</th> <th>Assign_date</th> <th>Due_date</th>  <th>Description</th> </tr>";
			echo "</td>";
			if (mysqli_num_rows($result) > 0) 
			{
	   			// output data of each row
    			while($row = mysqli_fetch_assoc($result)) 
					echo "<tr><th>".$row["CourseNum"]."</th><th>".$row["eCRN"]."</th> <th>".$row["eSectionNum"]."</th> <th>".$row["Name"]."</th> <th>".$row["Assign_date"]."</th> <th>".$row["Due_date"]."</th> <th>". "<a href='".$row["eDescription"]."'>Description</a>" ."</th> </tr>";
			}
			echo "</table>";
		} 

	}

}
?>
<br/>
<br/>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="submit" name="ViewAllCourseWork" value="View all coursework" />
</form>
<br/>
<br/>


<h3>Create Coursework</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="text" name="cName"/> Coursework name <br/>
	<input type="text" name="cNum" /> Course #<br/>
	<input type="text" name="sNum" /> Section #<br/>
	<input type="text" name="eDes" /> Description file<br/>
	<input type="text" name="aDate"/> Available date<br/>
	<input type="text" name="dDate"/> Due date<br/>
	<input type="text" name="wtype"/> Work type<br/>
	<input type="submit" name="CreateCourseWork" value="Enter" />
</form>
<br/>
<br/>


<h3>Edit Coursework</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="text" name="cName"/>Coursework name <br/>
	<input type="text" name="c_crn"/>CRN<br/>
	<input type="text" name="aDate"/>Available date<br/>
	<input type="text" name="dDate"/>Due date<br/>
	<input type="submit" name="EditCourseWork" value="Enter" />
</form>
<br/>
<br/>

<h3>Delete Coursework</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="text" name="cName"/>Coursework name<br/>
	<input type="text" name="crnNum"/>CRN<br/>
	<input type="submit" name="DeleteCourseWork" value="Enter" />
</form>
<br/>
<br/>


</body>
</html>
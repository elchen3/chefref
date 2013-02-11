<?php
session_start();
include("dbconnect.php"); 

$user = $_POST['user'];
$pass = $_POST['pass'];
$result = mysql_query("SELECT * FROM user");
$count = mysql_num_rows($result);
$user_id = mysql_query("INSERT into user values($count, '$user', '$pass')")
or die(mysql_error());  
$_SESSION['logged'] = $count;


if (isset($_SESSION['tosave'])) {							// if user got here by attempting to save a recipe
	include("savemeal.php");
} else {													// else
	header("Location: index.php"); 							//     after user verification, redirect back
}

?>
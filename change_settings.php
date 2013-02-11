<?php
session_start();
include("dbconnect.php"); 

function verify_pass($user, $pass){ 
	$user_id = mysql_query("SELECT id FROM user WHERE user_id = '$user' and password='$pass';")
	or die(mysql_error());  
	while ($row = mysql_fetch_assoc($user_id)) {
		return true;
	}
	return false;
}; 

$user = $_SESSION['logged'];
$newpass = $_POST['newpass'];
if (verify_pass($user, $_POST['oldpass'])) { 	
	$user_id = mysql_query("UPDATE user SET password = '$newpass' WHERE id = $user")			
	or die(mysql_error());  
	$_SESSION["msg"] = "Password changed!";
	header("Location: settings.php"); 							//     after user verification, redirect back
} else {														// if user/pass incorrect
	$_SESSION["msg"] = "Credentials incorrect. Please reenter";
	header("Location: settings.php");						
}

?>
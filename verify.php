<?php
session_start();
include("dbconnect.php"); 

function verify_pass($user, $pass){ 
	$user_id = mysql_query("SELECT id FROM user WHERE user_name = '$user' and password='$pass';")
	or die(mysql_error());  
	while ($row = mysql_fetch_assoc($user_id)) {
		$_SESSION['logged'] = $row['id'];
		return true;
	}
	return false;
}; 


if (verify_pass($_POST['user'], $_POST['pass'])) { 				// if user/pass correct

	if (isset($_SESSION['tosave'])) {							// if user got here by attempting to save a recipe
		include("savemeal.php");
	} else {													// else
		header("Location: index.php"); 							//     after user verification, redirect back
	}
} else {														// if user/pass incorrect
	$_SESSION["msg"] = "Username and password do not match";
	header("Location: login.php");						
}

?>
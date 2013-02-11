<?php

session_start();
include("dbconnect.php"); 

function check_logged(){ 
    global $_SESSION; 		
	if (!isset($_SESSION['logged'])) { 				//if not logged in, then direct to login
		header("Location: login.php"); 
	} else {										//logged in, so go ahead and save
		include("savemeal.php");
	}
}; 

if (isset($_POST['save'])) {						//if user opted to save, check for login then save
	$public = FALSE;
	
	$title = $_POST['title'];
	$rating = $_POST['rating'];
	$comments = $_POST['comments'];
	$meals = array();				
	foreach ($_SESSION['dishes'] as $key) {
		echo $meals[] = $key;
	}
	$_SESSION['tosave'] = array($public, $title, $meals, $rating, $comments);
	check_logged(); 							
} else {											//if user opted to skip, send to index
	unset($_SESSION['dishes']);
	header( 'Location: index.php' ) ;
}
mysql_close($dbhandle);
?>


<?php

session_start();
include("dbconnect.php"); 
if (empty($_GET['mealdishes'])) header('Location: index.php');


header('Location: index.php');
mysql_close($dbhandle);
?>


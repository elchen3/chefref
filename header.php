<?php 
session_start();
?>
<html>
<head>
	<title>ChefRef</title>
	
	<meta http-equiv='cache-control' content='no-cache'>
	<meta http-equiv='expires' content='0'>
	<meta http-equiv='pragma' content='no-cache'>
	<meta name="viewport" content="width=device-width, initial-scale=1"> 

	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.css" />
	<link rel="stylesheet" type="text/css" href="style.css" />
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.js"></script>
	<script language="javascript">
		function toggleDiv(divid){
			if(document.getElementById(divid).style.display == 'none'){
			  document.getElementById(divid).style.display = 'block';
			}else{
			  document.getElementById(divid).style.display = 'none';
			}
		}
		function HideLabel(txtField){
			if(txtField.name=='query'){
				if(txtField.value=='Search for dishes ...')
					txtField.value = '';
				else
					txtField.select();
			}
		}
	</script>
</head>
<body>

<div id="header">
	<?php	
	if (isset($_SESSION["logged"])) {
		//echo "<a href='index.php'><img src='images/icon.png' /></a>";
		//echo "<a href='cookbook.php' data-icon='star'>My Cookbook</a>";
		echo "<a href='index.php'>&nbsp; <img src='images/title.png' /></a>";
		echo "<a href='logout.php' class='right' style='line-height: 49px;'>Logout &nbsp;</a>";
		echo "<a href='cookbook.php' class='right' style='line-height: 49px;'>Cookbook &nbsp; | &nbsp;</a>";
	} else {
		echo "<a href='index.php'><img src='images/icon.png' /></a>";
		echo "<a href='index.php'><img src='images/title.png' /></a>";
		echo "<a href='login.php' class='right' style='line-height: 49px;'>LOGIN &nbsp;</a>";
	}
	?>
</div>

<div id="bodywrapper">

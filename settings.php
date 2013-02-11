<?php include("header.php");

	function check_logged(){ 
		 global $_SESSION, $USERS; 
		 if (!isset($_SESSION['logged'])) { 
			header("Location: index.php"); 
		 }; 
	}; 
	check_logged() 
?>
	<p style='color: red'><?php if(isset($_SESSION["error_msg"])) {
				echo $_SESSION["error_msg"];
				unset($_SESSION["error_msg"]);
			}
		?></p>
<div id="body">
<h1>My Settings</h1>
	<h4>Change password:</h4>
	<form action="change_settings.php" method="post">
	<label for="dish"><h3>&nbsp;OLD PASSWORD:</h3></label>
		<input class="mainform" name="oldpass" type="text" />
	<label for="dish"><h3>&nbsp;NEW PASSWORD:</h3></label>
		<input class="mainform" name="newpass" type="password" />
		<input class="mainform" id="dish" type="submit" value="REGISTER"/>
	</form>
	
	<br />
	

</body>
</html>
	
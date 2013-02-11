<?php include("header.php");

	function check_logged(){ 
		 global $_SESSION, $USERS; 
		 if (isset($_SESSION['logged'])) { 
			header("Location: index.php"); 
		 }; 
	}; 

	check_logged() 
?>

<div id="bodywrapper">
<div id="body">
	<form action="verify_register.php" method="post">
	<label for="dish"><h3>&nbsp;USERNAME:</h3></label>
		<input class="mainform" name="user" type="text" />
	<label for="dish"><h3>&nbsp;PASSWORD:</h3></label>
		<input class="mainform" name="pass" type="password" />
		<input class="mainform" id="dish" type="submit" value="REGISTER"/>
	</form>
	
	<br />
	
</diV>
</div>

</body>
</html>
	
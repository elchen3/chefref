<?php include("header.php");

function check_logged(){ 
     global $_SESSION, $USERS; 
     if (isset($_SESSION['logged'])) { 
        header("Location: index.php"); 
     }; 
}; 

check_logged() 
?>

<div id="body">
	<?php 
	if (isset($_SESSION["msg"])) {
		echo $_SESSION["msg"];
		unset($_SESSION["msg"]);
	}
	?>
	<p class='error'>For demo purposes, you may use username 'code' and password 'chef'.</p>
	<form action="verify.php" method="post">
	<label for="dish"><h3>&nbsp;USERNAME:</h3></label>
		<input class="mainform" name="user" type="text" />
	<label for="dish"><h3>&nbsp;PASSWORD:</h3></label>
		<input class="mainform" name="pass" type="password" />
		<input class="mainform" id="dish" type="submit" value="LOGIN"/>
	</form>
	<center>
	<p class="green curved" style="width: 100px;"><a href="register.php" style="color: white">Register</p>
	</center>
</div>

</body>
</html>
	
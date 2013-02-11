<?php include("header.php"); 
	
	include("dbconnect.php");
 ?>
<div id="body">
	<h1 class="textshadow">Bon Appetit!</h1>
	<div class="content" style="padding: 10px;">
		 <span class="gray">You're done! <br /> &nbsp; You just cooked:
		<ul>
			<?php		
			foreach ($_SESSION['dishes'] as $index => $id) {$result = mysql_query("SELECT recipe_name FROM recipe WHERE id = $id")
				or die(mysql_error());  
				while ($row = mysql_fetch_assoc($result)) {
					$name = $row['recipe_name'];
					echo "<li>$name</li>";
				}
			}
			?>
		</ul> </span>
		<form method="post" action="save.php">
		<div class="box" style="padding: 20px">
		<fieldset>
		<input id="save" name="save" type="checkbox" value="save" /> 
		<label for="save"> Save to cookbook</label><br />
		<!--
		<input id="public" name="public" type="checkbox" value="public" /> <label for="public"> Publish to public database</label><br />
		-->

		Title:<br />
		<input name="title" type="text" /><br />
		Rate this meal: <br />
		<!--<img src="images/star.png"/><img src="images/star.png"/><img src="images/star.png"/><img src="images/star.png"/><br />-->
		<select name="rating">
		  <option value="1">&#9733;</option>
		  <option value="2">&#9733;&#9733;</option>
		  <option value="3">&#9733;&#9733;&#9733;</option>
		  <option value="4" selected>&#9733;&#9733;&#9733;&#9733;</option>
		</select><br />
		Comments: <br />
		<textarea name="comments" style="width:100%; height: 80px;"></textarea>
		</fieldset>
		</div>
		<input id="search" type="submit" value="DONE!" style="float:none" />
		</form>
	</div>
	
</diV>
</div>

</body>
</html>
	
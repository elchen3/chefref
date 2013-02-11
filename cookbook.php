<?php include("header.php"); include("dbconnect.php"); 
$user = $_SESSION["logged"];
?>
<div id="body">
	<h1 class="textshadow">My Cookbook</h1>
	<p style='color: red'><?php if(isset($_SESSION["success_msg"])) {
				echo "&nbsp; " . $_SESSION["success_msg"];
				unset($_SESSION["success_msg"]);
			}
		?></p>
		<?php
		$ingredients = mysql_query("SELECT meal.id, meal_name, rating, comments FROM cookbook, meal WHERE meal.id = cookbook.meal_id and user_id = $user")
		or die(mysql_error());  
		$countmeals = 0;
		while ($row = mysql_fetch_assoc($ingredients)) {
			$countmeals++;
			$id = $row['id'];
			$name = $row['meal_name'];
			$rating = $row['rating'];
			$comments = $row['comments'];
			?>
			
			<div data-role="collapsible" data-content-theme="c" style="font-size: 80%; width: 88%; margin-left: 20px; display: inline-block">
			   <h3><?php echo $name; ?></h3>
			   
					<?php
					$recipes = mysql_query("SELECT recipe_name, id FROM meal_recipe, recipe WHERE meal_recipe.meal_id = $id and recipe_id = recipe.id")
					or die(mysql_error());  
					echo "<p>Recipe: <ul>";
					$dishesstr = "";
					while ($row = mysql_fetch_assoc($recipes)) {
						$recipe = $row['recipe_name'];
						$id = $row['id'];
						if (empty($dishesstr)) $dishesstr = "" . $id;
						else $dishesstr = $dishesstr . "_$id";
						echo "<li>$recipe</li>";
					}
					echo "</ul></p>";
					echo "<p>Rating: $rating</p>";
					echo "<p>Comments: &quot; $comments &quot;</p>";
					?>
					<!--
					<form id="<?php echo $id; ?>" method="post" action="index.php">
						<input type="hidden" name="mealdishes" value="<?php echo $dishesstr; ?>" />
						<input type="hidden" name="dishesstr" value="<?php echo $dishesstr; ?>" />
						<button type="submit" data-theme="b" name="submit" value="submit-value">Cook meal</button>
					</form> 
					-->
				
			</div>	
		
		<?php
		}
		if ($countmeals == 0) echo "<br /><br /><br /><span class='gray'>No meals have been added yet.<br /><br /><br /></span>";
		mysql_close($dbhandle);
		?>
</div>


<!-- Footer -->
<div data-role="footer" data-position="fixed">
	<div data-role="navbar">
		<ul>
			<li><a href="index.php" data-icon="home">Home</a></li>
		</ul>
	</div><!-- /navbar -->
</div>
</body>
</html>
	
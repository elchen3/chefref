<?php  
include("dbconnect.php");
session_start();
?>
<html>
<head>
	<title>CODECHEFS</title>
	
	<meta http-equiv='cache-control' content='no-cache'>
	<meta http-equiv='expires' content='0'>
	<meta http-equiv='pragma' content='no-cache'>
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.css" />
	<link rel="stylesheet" type="text/css" href="style.css" />
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.js"></script>

</head>
<body>

<div id="body">
	<div data-role="header" data-theme="e">
		<h5>Details</h5>
	</div><!-- /header -->

	<div data-role="content" data-theme="e">
		<?php	// IF MEAL
		if (isset($_GET['type'])) {
			$mealId = $_GET['query'];
			$result = mysql_query("SELECT * FROM public_meals where id = $mealId")
			or die(mysql_error());  
			while ($row = mysql_fetch_assoc($result)) {
				$mealname = $row['name']; 	
				$photo = $row['photo']; 	
				$description = $row['description']; 	
				$mealstr = $row['recipes'];
				$dishes = explode(" ", $mealstr);	
				echo "<div style='width: 250px; margin: 0 auto;'><img src='images/thumbs/$photo.jpg' style='width: 250px; border: 1px solid #ccc;'>	</div>";
				echo "<h3>$mealname</h3>";
				echo "<h5>&#9658; Dishes</h5>";
				echo "<ul class='small'>";
				foreach($dishes as $dishId) {
					$result_dish = mysql_query("SELECT * FROM recipe where id = '$dishId'")
					or die(mysql_error());  
					while ($row_dish = mysql_fetch_assoc($result_dish)) {
						$photo = $row_dish['photo'];
						$name = $row_dish['recipe_name'];
						echo "<li>$name</li>";
					}
				}
				echo "</ul>";
				echo "<h5>&#9658; Description</h5>";
				echo "<p>$description</p>";
			} ?>
			<form method="post" action="index.php">		  
				<input type="hidden" name="meal" value="<?php echo $mealId; ?>" />
				<input type="hidden" name="mealstr" value="<?php echo $mealstr; ?>" />
				<input type="hidden" name="mealname" value="<?php echo $mealname; ?>" />
				<input type="submit" name="add" value="Add this meal!" data-theme="b" />   	
			</form> 	
			<?php
		} else {
			$recipeId = $_GET['query'];
			$result = mysql_query("SELECT * FROM recipe where id = $recipeId")
			or die(mysql_error());  
			while ($row = mysql_fetch_assoc($result)) {
				$recipeName = $row['recipe_name']; 
				$photo = $row['photo']; 
				$time = $row['time']; 		
				echo "<div style='width: 250px; margin: 0 auto;'><img src='images/thumbs/$photo.jpg' style='width: 250px; border: 1px solid #ccc;'>	</div>";
				echo "<h3>$recipeName</h3>";
				echo "<span style='float: right; font-style:italic'><small>~$time</small></span>";
				echo "<h5>&#9658; Ingredients</h5>";
				echo "<ul class='small'>";
				$ingredients = mysql_query("SELECT ingredient_name FROM recipe_ingredient, ingredient WHERE recipe_ingredient.recipe_id = $recipeId and ingredient.id=recipe_ingredient.ingredient_id")
				or die(mysql_error());  
				while ($row = mysql_fetch_assoc($ingredients)) {
					$ingr = $row['ingredient_name'];
					echo "<li>$ingr</li>";
				}
				echo "</ul>";
			} ?>
			<form method="post" action="index.php">		  
				<input type="hidden" name="addDishId" value="<?php echo $recipeId; ?>" />
				<input type="hidden" name="addDishName" value="<?php echo $recipeName; ?>" />
				<input type="submit" name="add" value="Add to my meal!" data-theme="b" />   	
			</form> 	
			<?php
		}
		?>
		<!--
		<h5>&#9658; Nutrition Facts</h5>
		<p class="small"><strong>The good: </strong>This food is low in Saturated Fat. It is also a good source of Riboflavin and Phosphorus, and a very good source of Protein and Selenium.
		<br /><br /><strong>The bad: </strong> This food is high in Cholesterol, and very high in Sodium.</p>
		-->
		<a href="index.php" data-role="button" data-theme="b" data-rel="back">Close</a>   
	</div>
</div>
</body>
</html>
	
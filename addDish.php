<?php include("header.php"); 
	include("dbconnect.php");?>
<div id="body" style="padding: 0">
	<?php $query =  $_GET["query"]; ?>
	<h1 class="textshadow"><a href="index.php" class="text" style="color: white;">Add Dish</a> &raquo; "<?php echo $query; ?>"</h1>
	<ul data-role="listview">
	<?php
	// Search for query among recipe titles
	echo "<li>DISHES</li>";
	$result = mysql_query("SELECT * FROM recipe where recipe_name like '%$query%'")
	or die(mysql_error());  
	$count = 0;
	
	while ($row = mysql_fetch_assoc($result)) {
		$count++;
		$recipeId = $row['id']; 
		$recipeName = $row['recipe_name']; 
		$photo = $row['photo']; 
		$time = $row['time']; 
		echo "<li><a href='dish_details.php?query=$recipeId' data-rel='dialog' data-transition='pop'>" .
			"<img src='images/thumbs/$photo.png' />" .
			"<h3>$recipeName</h3>" .
			"<p>$time</p>".
			"</a></li>";		
	}
	if ($count == 0) echo "<li>No dishes found.</li>";
	
	echo "<li>MEALS</li>";
	
	$result = mysql_query("SELECT * FROM public_meals where tags like '%$query%'")
	or die(mysql_error());  
	$count = 0;
	
	while ($row = mysql_fetch_assoc($result)) {
		$count++;
		$meal_id = $row['id']; 
		$meal_name = $row['name']; 
		$meal_dishes_str = $row['recipes']; 
		$dishes = explode(" ", $meal_dishes_str);
		$name_str = "";
		echo "<li><a href='dish_details.php?type=meal&query=$meal_id' data-rel='dialog' data-transition='pop'>";
		foreach($dishes as $dishId) {
			$result_dish = mysql_query("SELECT * FROM recipe where id = '$dishId'")
			or die(mysql_error());  
			while ($row_dish = mysql_fetch_assoc($result_dish)) {
				$photo = $row_dish['photo'];
				$name = $row_dish['recipe_name'];
				$name_str .= $name . " ";
			}
		}
		echo "<img src='images/thumbs/$photo.png' />" .
			"<h3>$meal_name</h3><p>$name_str</p></a></li>";	
	}
	if ($count == 0) echo "<li>No meals found.</li>";
	mysql_close($dbhandle);
	?>
	</ul>
</div> <!--END BODY -->

<div data-role="footer" class="ui-bar">
	<a href="index.php" data-role="button" data-icon="back">Back</a>
</div>
</body>
</html>
	
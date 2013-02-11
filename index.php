<?php 
include("header.php");
include("dbconnect.php");
//unset($_SESSION['dishes']);
if(isset($_SESSION['dishes'])) {
	if (isset($_POST["add"])) {												// if user came to page through the addDish page
		if (isset($_POST["meal"])) {		
			// IF MEAL
			$mealId = $_POST["meal"];
			$mealname = $_POST["mealname"];
			$mealstr = $_POST["mealstr"];
			$dishes = explode(" ", $mealstr);
			foreach($dishes as $dishId) {
				if (!in_array($dishId, $_SESSION['dishes'])) $_SESSION['dishes'][] = $dishId;			
			}
		} else {	
			// IF DISH
			if (in_array($_POST["addDishId"], $_SESSION['dishes'])) {		// first check if it's already added
				$dish_name = $_POST["addDishName"];
				$err_msg = "'$dish_name' has already been added";
			} else {
				$_SESSION['dishes'][] = $_POST["addDishId"];				// append dish to array
			}
		}
	}
	if (isset($_POST["delete"])) {	
		foreach ($_SESSION['dishes'] as $index=>$id) {
			if ($id == $_POST["deleteDish"]) {
				unset($_SESSION['dishes'][$index]);
			}
		}
		$_SESSION['dishes'] = array_values($_SESSION['dishes']);	// re-index array after deletion
	}
	if (isset($_POST['mealdishes'])) {
		$pieces = explode("_", $_POST['dishesstr']);
		$count=0;
		foreach ($pieces as $piece) {
			$_SESSION['dishes'][] = $pieces[$count];
			$count++;
		}	
	}
} else {
	$_SESSION['dishes'] = array();
}

?>
<br />
<div id="body" style="padding: 0 0 0 0">

	<div id="main_pic">	
	<!--
	<img src='images/label.png' style="margin-top: 40px" />
	-->
	</div>
	<div style="width: 100%; background: url('images/grad_top.png') repeat-x 0 -60px; height: 40px;">
	</div>
	<!-- PRINT ANY ERROR MSG -->
	<?php if (isset($err_msg)) echo "<p class='error'>$err_msg</p>"; ?>
		
	<!-- ADD DISH FORM -->
	<form action="addDish.php" method="get">
		<div data-role="fieldcontain" style="padding: 0;">
			<table style="width: 100%"><tr><td width="90%">
			<input class="default" name="query" type="text" value="Search dishes, meals..." onblur="if (this.value=='') this.value = 'Search dishes, meals...'" onfocus="if (this.value=='Search dishes, meals...') this.value = ''"  />
			</td><td>
			<button id="search" type="submit" data-theme="c" data-role="button" data-icon="search" data-iconpos="notext" ></button>
			<br />
			</td></tr>
			<tr><td>
			<small>Ex: <i>Turkey, Potatoes, Sauce</i></small></td></tr>
			</table>				
		</div>
	</form>
	<!-- PRINT DISHES -->
	<?php
	if (!empty($_SESSION['dishes'])) {
		echo "<h5 style='background: black; line-height: 40px; margin: 0'>&nbsp;Dishes to cook:</h5><ol class='message_list'>";
		foreach ($_SESSION['dishes'] as $index=>$id) {
			$result = mysql_query("SELECT * FROM recipe WHERE id = $id")
			or die(mysql_error());  
			while ($row = mysql_fetch_assoc($result)) {
				$recipeName = $row['recipe_name']; 
				$photo = $row['photo']; 
				$time = $row['time']; 
			}
			$divID = 'div'.$id;
	?>		
			<li>
			<table class="listDishes" cellspacing=0><tr><td style="" class="delete">
				<tr><td style="width: 90%;">
				<div class="message_head">
				<a class="dishlist" href="javascript:;" onmousedown="if(document.getElementById('<?php echo $divID; ?>').style.display == 'none'){ document.getElementById('<?php echo $divID; ?>').style.display = 'block'; }else{ document.getElementById('<?php echo $divID; ?>').style.display = 'none'; }"><span class='green'>&#9658;</span> <?php echo $recipeName; ?></a>
				</div>
				<div id="<?php echo $divID; ?>" style="display:none" class="message_body" >
					<table>
						<tr>
						<td><img src="images/thumbs/<?php echo $photo; ?>.png" /><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;~<?php echo $time; ?></td>
						<td><h3>Ingredients:</h3>
						<?php
						$ingredients = mysql_query("SELECT ingredient_name FROM recipe_ingredient, ingredient WHERE recipe_ingredient.recipe_id = $id and ingredient.id=recipe_ingredient.ingredient_id")
						or die(mysql_error());  
						while ($row = mysql_fetch_assoc($ingredients)) {
							$ingr = $row['ingredient_name'];
							echo "&raquo; $ingr<br />";
						}
						?>
						</td>
						</tr>
					</table>
				</div>
				</td><td class="delete">
				<form id="<?php echo $id; ?>" method="post" action="index.php">
					<input type="hidden" name="deleteDish" value="<?php echo $id; ?>" />
					<button id="delete" name="delete" type="submit" data-theme="c" data-role="button" data-icon="delete" data-iconpos="notext" ></button>
				</form> 
				</td></tr>
			</table>
			</li>
	<?php
		}
		echo "</ol>";
	}
	mysql_close($dbhandle);
	?>
	

</div>
</div>


<!-- Footer -->
<?php if (count($_SESSION['dishes']) > 0) { ?>
<div data-role="footer">
	<div data-role="navbar">
		<ul>
			<li><a href="timing.php" data-icon="forward" class="ui-btn-active" style="background: #333">Set Schedule</a></li>
		</ul>
	</div><!-- /navbar -->
</div>
<?php } ?>
</body>
</html>
	
<?php include("header.php"); include("dbconnect.php"); 

?>

<div id="body">
	<h1 class="textshadow">You Will Need...</h1>
	<div class="box" style="padding: 10px; background: #fbfbfb; font-size: 85%">
		Ingredients:
			<ul>
			<?php
			$array_ingredient_names = array();
			$array_ingredient_quantities = array();
			foreach ($_SESSION['dishes'] as $index=>$id) {
				$ingredients = mysql_query("SELECT ingredient.ingredient_name, quantity from recipe_ingredient, ingredient WHERE recipe_id = $id and ingredient_id = ingredient.id")
				or die(mysql_error());  
				while ($row = mysql_fetch_assoc($ingredients)) {
					$ingr = $row['ingredient_name'];
					$measurement = $row['quantity'];
					
					/* Check for repeated equipment */
					if (in_array($ingr, $array_ingredient_names)) {
						$index = 0;
						foreach ($array_ingredient_names as $ingredient) {
							if (strcmp($ingredient, $ingr)) {
								/* Append new quantity */
								$array_ingredient_quantities[$index] .= " + ".$measurement;
								break;
							}
							++$index;
						}
					}
					/* Else this is the first occurance, so add the equipment */
					else {
						$array_ingredient_names[] = $ingr;
						$array_ingredient_quantities[] = $measurement;
					}
				}
			}
			/* Print out the quantities and equipments */
			$index = 0;
			foreach ($array_ingredient_names as $ingredient) {
				echo "<li>" . $array_ingredient_quantities[$index] . " " . $array_ingredient_names[$index] . "</li>";
				++$index;
			}
	
			?>
			</ul>		
	</div>
	<div class="box" style="padding: 10px; background: #fbfbfb; font-size: 85%">
		Equipment:
			<ul>
			<?php
			$array_equipment_names = array();
			$array_equipment_quantities = array();
			foreach ($_SESSION['dishes'] as $index=>$id) {
				$ingredients = mysql_query("SELECT equipment.equipment_name, quantity from recipe_equipment, equipment WHERE recipe_id = $id and equipment_id = equipment.id")
				or die(mysql_error());  
				while ($row = mysql_fetch_assoc($ingredients)) {
					$ingr = $row['equipment_name'];
					$measurement = $row['quantity'];
					
					/* Check for repeated equipment */
					if (in_array($ingr, $array_equipment_names)) {
						/* Check if new quantity is larger */
						$index = 0;
						foreach ($array_equipment_names as $equipment) {
							if (strcmp($equipment, $ingr)) {
								/* Choose the larger quantity */
								if ($measurement > $array_equipment_quantities[$index]) {
									$array_equipment_quantities[$index] = $measurement;
								}
								break;
							}
							++$index;
						}
					}
					/* Else this is the first occurance, so add the equipment */
					else {
						$array_equipment_names[] = $ingr;
						$array_equipment_quantities[] = $measurement;
					}
				}
			}
			/* Print out the quantities and equipments */
			$index = 0;
			foreach ($array_equipment_names as $equipment) {
				echo "<li>" . $array_equipment_quantities[$index] . " " . $array_equipment_names[$index] . "</li>";
				++$index;
			}
			mysql_close($dbhandle);
	
			?>
			</ul>		
	</div>
	
	
</div>

<!-- Footer -->
<div data-role="footer" data-position="fixed">
	<div data-role="navbar">
		<ul>
			<li><a href="timing.php" data-icon="back" data-direction="reverse">Set Schedule</a></li>
			<li><a href="display.php" data-icon="forward" class="ui-btn-active">Start cooking!</a></li>
		</ul>
	</div><!-- /navbar -->
</div>

</body>
</html>
	
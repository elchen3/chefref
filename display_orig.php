<?php include("header.php"); 
	
	include("dbconnect.php");
 ?>
<div id="body" style="background: #222; width: 100%; padding: 0px; margin: 0px;">

<div class="box" style="background: #333; border: 1px solid #666; color: white; width: 300px; margin: 0 auto; ">
	<div style="float: left; width: 25%; line-height: 40px; margin: 10px;"><h3>Color Key:</h3></div>
	<div class="colorkey" style="float: right; margin: 10px; width: 60%; font-size: 80%; line-height: 120%; color: white;">
		<div class="curved one" style="padding: 5px">Trad. Mashed Potatoes</div>
		<div class="curved two" style="padding: 5px">Herb Turkey</div>
		<div class="curved three" style="padding: 5px">Cranberry Sauce</div>
	</div>
	<div style="clear: both;"></div>
</div>

<div style="width: 300px; margin: 0 auto; background: #222 url('images/dot.gif') repeat-y; background-position: 4% 0%;">

<table class="display" cellspacing=4>
<tr>
<td class="time">1 min</td>
<td class="task two" style="height: 20px">
	<strong>Thaw turkey</strong>
	<span>Remove turkey from wrapper and let sit.</span>
</td>
</tr>
<tr><td></td><td></td></tr>
<tr>
<td class="time">5 min</td>
<td class="task one" style="height: 50px">
	<strong>Peel 6 potatoes</strong>
	<span>Using the potato peeler, remove as many of the eyes as possible with the tip of your peeler.</span>
</td>
</tr>
<tr><td></td><td></td></tr>
<tr>
<td class="time">1 min</td>
<td class="task one" style="height: 20px">
	<strong>Cube potatoes</strong>
	<span>Cut into chunks ~1.5 inches wide.</span>
</tr>
<tr><td></td><td></td></tr>
<tr>
<td class="time">5 min</td>
<td class="task" style="height: 100px; padding: 0px;">
	<div class="curved one" style="float: left; height: 100%; width: 44%;">
	<strong>Boil</strong>
	<span>Place potatoes in pot and cover with water. Place lid on top and bring to boil.</span>
	</div>

	<div class="curved three" style="width: 44%; height: 100%; float: right;">
	<strong>Dissolve</strong>
	<span>In a medium saucepan over medium heat, dissolve the sugar in the orange juice.</span>
	</div>
</td>
</tr>
<tr><td></td><td></td></tr>
<tr>
<td class="time">5 min</td>
<td class="task one" style="height: 100px">
	<strong>Simmer</strong>
	<span>Reduce heat to simmer and let cook until potatoes are tender.</span>
</td>
</tr>
<tr><td></td><td></td></tr>
<tr>
<td class="time">1 min</td>
<td class="task one" style="height: 50px">
	<strong>Drain</strong>
	<span>Remove from heat and drain immediately using a strainer.</span>
</td>
</tr>
<tr><td></td><td></td></tr>
<tr>
<td class="time">10 min</td>
<td class="task" style="height: 200px; padding: 0px">
	<div class="curved two" style="float: left; height: 100%; width: 44%;">
	<strong>Preheat</strong>
	<span>Preheat oven to 200 degrees F. Grease your baking sheet.</span>
	</div>

	<div class="curved one" style="width: 44%; height: 100%; float: right;">
	<strong>Mash</strong>
	<span>Add milk, butter, salt, and pepper. Mash until light and fluffy.</span>
	</div>
	
</td>
</tr>
<tr><td></td><td></td></tr>
<tr>
<td class="time">4 min</td>
<td class="task one" style="height: 100px">
	<strong>Saute</strong>
	<span>Saute garlic in 2 tablespoons butter for 1 minute or until tender. Add the remaining butter; heat until melted.</span>
</td>
</tr>
<tr><td></td><td></td></tr>
<tr>
<td class="time">7 min</td>
<td class="task two" style="height: 100px">
	<strong>Baste</strong>
	<span>Combine olive oil, garlic powder, dried basil, salt, and black pepper. Apply the mixture to the turkey.</span>
</td>
</tr>
<tr><td></td><td></td></tr>
<tr>
<td class="time">3 hr</td>
<td class="task" style="height: 400px; padding: 0px">
	<div class="curved two" style="float: left; height: 100%; width: 44%;">
	<strong>Bake</strong>
	<span>Bake for 3 to 3 1/2 hours, or until the internal temperature of the thickest part of the thigh measures 180 degrees F</span>
	</div>

	<div class="curved three" style="width: 44%; height: 20%; float: right;">
	<strong>Cook</strong>
	<span>Stir in the cranberries and cook until they start to pop, then transfer to bowl to cool.</span>
	</div>
</td>
</tr>

</table>

</div>
</div>


<!-- Footer -->
<div data-role="footer" >
	<div data-role="navbar">
		<ul>
			<li><a href="needs.php" data-icon="back" data-direction="reverse">Review Needs</a></li>
			<li><a href="done.php" data-icon="forward" class="ui-btn-active">Rate/Save Meal</a></li>
		</ul>
	</div><!-- /navbar -->
</div>

</body>
</html>
	
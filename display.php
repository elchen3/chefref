<?php include("header.php"); 
	include("dbconnect.php");	
	include("display_algorithm.php");

/* Retrieve task passivities */
$array_task_passivities = array();
foreach ($array_task_ids as $task_id) {
	$query_task_passivities = "SELECT passive FROM task WHERE id = $task_id";
	$resource_task_passivities = mysql_query($query_task_passivities) or die(mysql_error());
	$task_passivity = mysql_fetch_array($resource_task_passivities);
	$array_task_passivities[] = $task_passivity['passive'];
}

/* Retrieve task durations */
$array_task_durations = array();
foreach ($array_task_ids as $task_id) {
	$query_task_durations = "SELECT duration FROM task WHERE id = $task_id";
	$resource_task_durations = mysql_query($query_task_durations) or die(mysql_error());
	$task_duration = mysql_fetch_array($resource_task_durations);
	$array_task_durations[] = $task_duration['duration'];
}

/* Determine task indentation */
$index = 0;
$passive_timer = 0;
$array_task_indentations = array();
foreach ($array_task_passivities as $task_passivity) {
	/* Convert from MySQL HH:MM:SS time format to minutes */
	$duration = substr($array_task_durations[$index], 3, 2);
	
	/* When the passive timer > 0, this task should be indented */
	if ($passive_timer > 0) {
		$array_task_indentations[] = 1;
		/* Reduce the time left on the passive timer */
		$passive_timer -= $duration;
	}
	/* Else tasks are currently not indented */
	else {
		$array_task_indentations[] = 0;
		/* If this task is passive, reset the passive timer */
		if ($task_passivity) {
			$passive_timer = $duration;
		} else {
			$passive_timer = 0;
		}
	}
	++$index;
}

$totaldishes = count($_SESSION['dishes']);
$totaltasks = count($array_task_ids) - 1;
/*
$index = 0;
foreach ($array_task_ids as $task_id) {
	echo "<span style='font-size: 10px;'>" . $array_task_descriptions[$index] . "</span><br /><br />";
	$index++;
}
*/
$index = 0;
$array_task_colors = array();
foreach ($array_task_origins as $task_id) {
	$color = 'red';
	if (isset($_SESSION['dishes'][0]) and $array_task_origins[$index] == $_SESSION['dishes'][0]) $color = 'red';
	else if (isset($_SESSION['dishes'][1]) and $array_task_origins[$index] == $_SESSION['dishes'][1]) $color = 'blue';
	else if (isset($_SESSION['dishes'][2]) and $array_task_origins[$index] == $_SESSION['dishes'][2]) $color = 'yellow';
	else if (isset($_SESSION['dishes'][3]) and $array_task_origins[$index] == $_SESSION['dishes'][3]) $color = 'green';
	else if (isset($_SESSION['dishes'][4]) and $array_task_origins[$index] == $_SESSION['dishes'][4]) $color = 'pink';
	else if (isset($_SESSION['dishes'][5]) and $array_task_origins[$index] == $_SESSION['dishes'][5]) $color = 'purple';
	$array_task_colors[] = $color;
	$index++;
}


?>


<div id="body" style="width: 100%; padding: 0px; margin: 0px;">

<div class="box" style="background: none; border: 1px solid #666; color: black; width: 300px; margin: 0 auto; ">
	<div style="float: left; width: 25%; margin: 10px;"><h5>Color Key:</h5></div>
	<div class="colorkey" style="float: right; margin: 10px; width: 60%; font-size: 80%; line-height: 120%; color: white;">
<?php
		$dishcount = 0;
		foreach ($_SESSION['dishes'] as $dish) {
			$count = 0;
			foreach ($array_task_origins as $task_id) {
				if ($array_task_origins[$count] == $dish) {
					$query_name = "SELECT recipe_name FROM recipe WHERE id = $dish";
					$resource_name = mysql_query($query_name) or die(mysql_error());
					$result = mysql_fetch_array($resource_name);
					$names[] = $result['recipe_name'];
					echo "<div class='curved $array_task_colors[$count]' style='padding: 5px'>$names[$dishcount]</div>";
					break;
				}
				$count++;
			}
			$dishcount++;
		}
?>
	</div>
	<div style="clear: both;"></div>
</div>

<div style="width: 300px; margin: 0 auto; background: #222 url('images/dot.gif') repeat-y; background-position: 4% 0%;">

<table class="display" cellspacing=4>
<?php

/* Task information is now stored in the following arrays.  The same index corresponds to the same task for all arrays.
	id		$array_task_ids
	name		$array_task_names
	recipe		$array_task_origins
	description	$array_task_descriptions
	passivity	$array_task_passivities
	duration	$array_task_durations
	indentation	$array_task_indentations
*/


$index = 0;
foreach ($array_task_ids as $task_id) {
	if (($index < $totaltasks and $array_task_indentations[$index + 1] == 0) or ($index==$totaltasks)) {
		$duration = intval(substr($array_task_durations[$index], 3, 2));
		$hours = intval(substr($array_task_durations[$index], 0, 2));
		if ($hours > 0) $duration = $duration + 60 * $hours;
		if ($duration > 20) $duration = 20;
		$height = $duration*25 + 'px';
		echo "<tr><td class='time'>$array_task_durations[$index]</td>
			  <td class='task'>
				<a href='task_details.php?index=$index' data-rel='dialog' data-transition='pop' class='white curved $array_task_colors[$index]' style='width: 95%; height: $height; overflow: hidden'>
					<p class='white'>
					<strong>$array_task_names[$index]</strong>
					<span>$array_task_descriptions[$index]</span>
					</p>
				</a>
			  </td>
			  </tr>
			  <tr><td></td><td></td></tr>";
		++$index;
	} else if ($index < $totaltasks) {
		$duration = intval(substr($array_task_durations[$index], 3, 2));
		$hours = intval(substr($array_task_durations[$index], 0, 2));
		if ($hours > 0) $duration = $duration + 60 * $hours;
		if ($duration > 20) $duration = 20;
		$height = $duration*25 + 'px';
		$next = $index + 1;
		echo "<tr>
				<td class='time'>$array_task_durations[$index]</td>
				<td class='task'> 
					<a href='task_details.php?index=$index' style='overflow: hidden; height: $height' data-rel='dialog' data-transition='pop' class='white curved $array_task_colors[$index]'>
						<p class='white'>
						<strong>$array_task_names[$index]</strong>
						<span>$array_task_descriptions[$index]</span>
						</p>
					</a>
					<a href='task_details.php?index=$next' style='float: right; overflow: hidden; height: $height' data-rel='dialog' data-transition='pop' class='white curved $array_task_colors[$next]'>
						<p class='white'>
						<strong>$array_task_names[$next]</strong>
						<span>$array_task_descriptions[$next]</span>
						</p>
					</a>
				</td>
			</tr>";
		$index = $next;
		++$index;
	}
}
?>
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
	
<?php
		/* Set dummy session information */
		/*
$_SESSION['dishes'] = array();
$_SESSION['dishes'][] = 4;
$_SESSION['dishes'][] = 6;
$_SESSION['dishes'][] = 3;
$_SESSION['dishes'][] = 5;
*/
$_SESSION['order'] = 'sequentialZ';
session_start();

/* Retrieve recipe ids */
$array_recipe_ids = array();
$recipe_count = 0;
foreach ($_SESSION['dishes'] as $id) {
	$array_recipe_ids[] = $id;
	++$recipe_count;
}

/* Retrieve recipe names */
$array_recipe_names = array();
foreach ($array_recipe_ids as $recipe_id) {
	$query_recipe_names = "SELECT recipe_name FROM recipe WHERE id = $recipe_id";
	$resource_recipe_names = mysql_query($query_recipe_names) or die(mysql_error());
	$recipe_name = mysql_fetch_array($resource_recipe_names);
	$array_recipe_names[] = $recipe_name['recipe_name'];
}

/* Determine task order */
/* If recipe order is sequential, display recipes in order. */
if ($_SESSION['order'] == 'sequential') {
	/* Retrieve task ids */
	$array_task_ids = array();
	$array_task_origins = array();
	$index = 0;
	foreach ($array_recipe_ids as $recipe_id) {
		$query_task_ids = "SELECT task_id FROM recipe_task WHERE recipe_id = $recipe_id";
		$resource_task_ids = mysql_query($query_task_ids) or die(mysql_error());
		while ($task_id = mysql_fetch_array($resource_task_ids)) {
			$array_task_ids[] = $task_id['task_id'];
			$array_task_origins[] = $index;
		}
		++$index;
	}
}
/* Else recipes should be finished around the same time. */
else {
	/* Compute the total duration of each recipe */
	$array_recipe_durations = array();
	$array_recipe_tasks = array();
	$index = 0;
	/* Find all tasks for each recipe */
	foreach ($array_recipe_ids as $recipe_id) {
		$query_task_ids = "SELECT task_id FROM recipe_task WHERE recipe_id = $recipe_id";
		$resource_task_ids = mysql_query($query_task_ids) or die(mysql_error());
		$array_recipe_durations[] = 0;
		$array_recipe_tasks[] = array();
		
		/* For each task, find its duration */
		while ($task_id = mysql_fetch_array($resource_task_ids)) {
			$found_task_id = $task_id['task_id'];
			
			/* Maintain tasks to be ordered later */
			$array_recipe_tasks[$index][] = $found_task_id;
			
			/* Query databse for task duration */
			$query_task_durations = "SELECT duration FROM task WHERE id = $found_task_id";
			$resource_task_durations = mysql_query($query_task_durations) or die(mysql_error());
			$task_duration = mysql_fetch_array($resource_task_durations);
			$found_task_duration = $task_duration['duration'];
			
			/* Convert from MySQL HH:MM:SS time format to minutes */
			$duration = substr($found_task_duration, 3, 2);
			
			/* Add to accumulated recipe duration */
			$array_recipe_durations[$index] += $duration;
		}
		++$index;
	}
	
	/* Continuously retrieve the next task from the recipe with the longest remaining duration */
	/* Finish once all tasks have been removed (all recipe durations = 0) */
	$array_task_ids = array();
	$array_task_origins = array();
	
	$total_remaining_duration = 0;
	foreach ($array_recipe_durations as $recipe_duration) {
		$total_remaining_duration += $recipe_duration;
	}
	while ($total_remaining_duration > 0) {
		/* Find recipe with the longest remaining duration */
		$index = 0;
		$longest_recipe_id = 0;
		$longest_duration = 0;
		foreach ($array_recipe_durations as $recipe_duration) {
			if ($recipe_duration > $longest_duration) {
				$longest_duration = $recipe_duration;
				$longest_recipe_id = $index;
			}
			++$index;
		}
		/* Retrieve the next task and remove it from its recipe's task list */
		$next_task_id = array_shift($array_recipe_tasks[$longest_recipe_id]);
		$array_task_ids[] = $next_task_id;
		
		/* Record the recipe this task belongs to */
		$array_task_origins[] = $array_recipe_ids[$longest_recipe_id];
		
		/* Find this task's duration */
		$query_task_durations = "SELECT duration FROM task WHERE id = $next_task_id";
		$resource_task_durations = mysql_query($query_task_durations) or die(mysql_error());
		$task_duration = mysql_fetch_array($resource_task_durations);
		$found_task_duration = $task_duration['duration'];
		
		/* Convert from MySQL HH:MM:SS time format to minutes */
		$duration = substr($found_task_duration, 3, 2);
		
		/* Subtract duration from recipe and total remaining durations */
		$array_recipe_durations[$longest_recipe_id] -= $duration;
		$total_remaining_duration -= $duration;
	}
}
	
/* Retrieve task names */
$array_task_names = array();
foreach ($array_task_ids as $task_id) {
	$query_task_names = "SELECT task_name FROM task WHERE id = $task_id";
	$resource_task_names = mysql_query($query_task_names) or die(mysql_error());
	$task_name = mysql_fetch_array($resource_task_names);
	$array_task_names[] = $task_name['task_name'];
}

/* Retreieve task descriptions */
$array_task_descriptions = array();
foreach ($array_task_ids as $task_id) {
	$query_task_descriptions = "SELECT description FROM task WHERE id = $task_id";
	$resource_task_descriptions = mysql_query($query_task_descriptions) or die(mysql_error());
	$task_description = mysql_fetch_array($resource_task_descriptions);
	$array_task_descriptions[] = $task_description['description'];
}
?>
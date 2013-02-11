<?php  
include("dbconnect.php");
include("display_algorithm2.php"); 
$index = $_GET['index'];

$task_id = $array_task_ids[$index];
$query_notes = "SELECT notes FROM task WHERE id = $task_id";
$resource_task_notes = mysql_query($query_notes) or die(mysql_error());
$result = mysql_fetch_array($resource_task_notes);
$notes[] = $result['notes'];

$task_id = $array_task_ids[$index];
$query_notes = "SELECT video FROM task WHERE id = $task_id";
$resource_task_notes = mysql_query($query_notes) or die(mysql_error());
$result = mysql_fetch_array($resource_task_notes);
$videos[] = $result['video'];
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
		<?php 
			echo "<h3 style='text-align: center'>$array_task_names[$index]</h3>";
			echo "<p>$array_task_descriptions[$index]</p>";
			echo "<p><strong>Tip:</strong> $notes[0]</p>";
			if (!empty($videos[0])) {
				echo "<p><strong>Video:</strong><br /><iframe width='250' height='150' src='$videos[0]' frameborder='0' allowfullscreen></iframe></p>";
			}
		?>
		<a href="display.php" data-role="button" data-theme="b" data-rel="back">Close</a>   
	</div>
</div>
</body>
</html>
	
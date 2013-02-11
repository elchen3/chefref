<?php include("header.php"); 
	if(isset($_POST['direction'])) {
		$_SESSION['schedule'] = "order";
		$direction = $_POST['direction'];
		$dishID = $_POST['dishID'];
		foreach ($_SESSION['dishes'] as $index=>$id) {
			if ($id == $dishID) {
				if ($direction == 'up' and ($index-1 >= 0)) {
					unset($_SESSION['dishes'][$index]);
					$_SESSION['dishes'] = array_values($_SESSION['dishes']);
					array_splice($_SESSION['dishes'], $index-1, 0, $id);
				}
				if ($direction == 'down' and ($index+1 < count($_SESSION['dishes']) )) {
					unset($_SESSION['dishes'][$index]);
					$_SESSION['dishes'] = array_values($_SESSION['dishes']);
					array_splice($_SESSION['dishes'], $index+1, 0, $id);
				}
			}
		}
	} 
	include("dbconnect.php");
?>
<script language="javascript"> 
<!-- 
// PLEASE DO NOT REMOVE THIS. THANKS 
// FIND GREATE JAVASCRIPT CODES AT http://www.wallpaperama.com 
var state = 'hidden'; 

function show(layer_ref) { 
	state = 'visible'; 
	if (document.all) { //IS IE 4 or 5 (or 6 beta) 
		eval( "document.all." + layer_ref + ".style.visibility = state"); 
	} 
	if (document.layers) { //IS NETSCAPE 4 or below 
		document.layers[layer_ref].visibility = state; 
	} 
	if (document.getElementById && !document.all) { 
		maxwell_smart = document.getElementById(layer_ref); 
		maxwell_smart.style.visibility = state; 
	} 
} 


function hide(layer_ref) { 
	state = 'hidden'; 
	if (document.all) { //IS IE 4 or 5 (or 6 beta) 
		eval( "document.all." + layer_ref + ".style.visibility = state"); 
	} 
	if (document.layers) { //IS NETSCAPE 4 or below 
		document.layers[layer_ref].visibility = state; 
	} 
	if (document.getElementById && !document.all) { 
		maxwell_smart = document.getElementById(layer_ref); 
		maxwell_smart.style.visibility = state; 
	} 
} 
//--> 
</script> 


<div id="body">
	<h1 class="textshadow">Scheduling</h1>	
	<div data-role="fieldcontain">
		<fieldset data-role="controlgroup">
			<span class="gray">I want my dishes done: </span><br />
			<input type="radio" name="radio-choice-1" id="radio-choice-1" value="choice-1" />
			<label for="radio-choice-1" onclick="hide('agent99');">All around the same time</label>
			<input type="radio" name="radio-choice-1" id="radio-choice-2" value="choice-2" checked="checked" />				
			<label for="radio-choice-2" onclick="show('agent99');" >In this order:</label>
		</fieldset>
		<div id="agent99" class="box" style="visibility:visible; margin-top: -18px;"> 
		<table style="width: 95%; margin: 0 auto">
		<?php
			$count = 1;
			$size = count($_SESSION['dishes']);
			foreach ($_SESSION['dishes'] as $id) {	
				echo "<tr><td class='bordered' style='padding: 10px;'>$count</td>";
				$result = mysql_query("SELECT recipe_name FROM recipe WHERE id = $id")
				or die(mysql_error());  
				while ($row = mysql_fetch_assoc($result)) {
					$name = $row['recipe_name'];
					echo "<td class='bordered'>$name</td>";
				}
				?>
				<td class="bordered">
				<form method="post" action="timing.php">
					<input type="hidden" name="dishID" value="<?php echo $id; ?>" />
					<input type="hidden" name="direction" value="up" />
					<?php 
					if ($count == 1) $disabled = "disabled='disabled '";
					else $disabled = "";
					echo "<button id='add' name='add' type='submit' $disabled data-theme='c' data-role='button' data-icon='arrow-u' data-iconpos='notext' ></button>"
					?>
				</form>	
				</td>
				<td class="bordered">
				<form method="post" action="timing.php">
					<input type="hidden" name="dishID" value="<?php echo $id; ?>" />
					<input type="hidden" name="direction" value="down" />
					
					<?php 
					if ($count == $size) $disabled = "disabled='disabled '";
					else $disabled = "";
					echo "<button id='add' name='add' type='submit' $disabled data-theme='c' data-role='button' data-icon='arrow-d' data-iconpos='notext' ></button>"
					?>
				</form>
				</td>	
				</tr>
				<?php
				$count++;
			}			
			mysql_close($dbhandle);
		?>
		</table>
		</div>
	</div>
	
</div>

<!-- Footer -->
<div data-role="footer" data-position="fixed">
	<div data-role="navbar">
		<ul>
			<li><a href="index.php" data-icon="back" data-direction="reverse">Add more dishes</a></li>
			<li><a href="needs.php" data-icon="forward" class="ui-btn-active">Get Started</a></li>
		</ul>
	</div><!-- /navbar -->
</div>

</body>
</html>	
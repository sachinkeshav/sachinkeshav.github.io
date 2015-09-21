<?php
	include("top.html");
	
	$name = filter_input(INPUT_GET, "name");
?>

<div>
	<p><strong>Thank you!</strong></p>
	<p>Welcome to NerdLuv, <?= $name ?>!</p>
	<p>Now <a href="matches.php">log in to see your matches!</a></p>
</div>

<?php include("bottom.html"); ?>
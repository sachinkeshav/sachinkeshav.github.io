<?php
	$name = filter_input(INPUT_POST, "name");
	
	if (!$name) {
		header("Location: matches.php");
		exit();
	}
	
	header("Location: matches-display.php?name=" . urlencode($name));
?>
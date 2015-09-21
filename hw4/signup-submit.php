<?php
	$name = filter_input(INPUT_POST, "name");
	$gender = filter_input(INPUT_POST, "gender");
	$age = filter_input(INPUT_POST, "age");
	$type = filter_input(INPUT_POST, "type");
	$os = filter_input(INPUT_POST, "os");
	$min = filter_input(INPUT_POST, "min");
	$max = filter_input(INPUT_POST, "max");
	
	if (!$name || !$gender || !$age || !$type || !$os || !$min || !$max) {
		header("Location: signup.php");
		exit();
	}
	
	file_put_contents("singles.txt", "$name,$gender,$age,$type,$os,$min,$max\n", FILE_APPEND | LOCK_EX);
	
	header("Location: signup-success.php?name=" . urlencode($name));
?>

<?php
	include ("db-connection.php");
	include("common.php");
	
	$name = filter_input(INPUT_POST, "name");
	$password = filter_input(INPUT_POST, "password");
	
	if (!$name || !$password) {
		header("Location: matches.php?error=Username+or+password+field+cannot+be+empty");
		exit();
	}
	
	$stmt = $db->prepare("SELECT * FROM singles WHERE name = :name");
	$stmt->execute(array(':name' => $name));
	$row = $stmt->fetch();
	
	if ($row != FALSE) {
		if (password_verify($password, $row["pass"])){
			header("Location: matches-display.php?name=" . urlencode($name));
		} else {
			header("Location: matches.php?error=Invalid+username+or+password");
			exit();
		}
	} else {
		header("Location: matches.php?error=Invalid+username+or+password");
		exit();
	}
?>
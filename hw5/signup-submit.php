<?php
	include ("db-connection.php");

	$name = filter_input(INPUT_POST, "name");
	$password = filter_input(INPUT_POST, "password");
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
	
// 	file_put_contents("singles.txt", "$name,$gender,$age,$type,$os,$min,$max\n", FILE_APPEND | LOCK_EX);
	
	$pass_hash = password_hash($password, PASSWORD_DEFAULT);
	$stmt = $db -> prepare("INSERT INTO singles VALUES (NULL, :name, :pass_hash, :gender, :age, :type1, :type2, :type3, :type4, :os, :min, :max)");
	$stmt -> execute(array(
			':name' => $name,
			':pass_hash' => $pass_hash,
			':gender' => $gender,
			':age' => $age,
			':type1' => $type[0],
			':type2' => $type[1],
			':type3' => $type[2],
			':type4' => $type[3],
			':os' => $os,
			':min' => $min,
			':max' => $max
	));
	
	header("Location: signup-success.php?name=" . urlencode($name));
?>

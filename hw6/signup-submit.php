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
	
	session_start();
	
	if (!$name || !$gender || !$age || !$type || !$os || !$min || !$max) {
		$_SESSION['error'] = "Fields cannot be empty";
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
	
	session_regenerate_id();
	$_SESSION['username'] = $name;
		
	$match_stmt = $db->prepare ( "SELECT * FROM singles WHERE gender <> :gender AND age >= :min AND age <= :max
					AND os = :os AND (type1 = :type1 OR type2 = :type2 OR type3 = :type3 OR type4 = :type4)" );
	$match_stmt->execute ( array (
			':gender' => $gender,
			':min' => $min,
			':max' => $max,
			':os' => $os,
			':type1' => $type[0],
			':type2' => $type[1],
			':type3' => $type[2],
			':type4' => $type[3]
	) );
		
	$m = 0;
	$matches = array();
	while(($match_row = $match_stmt->fetch()) != FALSE) {
		$matches[$m]["name"] = $match_row["name"];
		$matches[$m]["gender"] = $match_row["gender"];
		$matches[$m]["age"] = $match_row["age"];
		$matches[$m]["type"] = $match_row["type1"] . $match_row["type2"] . $match_row["type3"] . $match_row["type4"];
		$matches[$m]["os"] = $match_row["os"];
		$m++;
	}
		
	$_SESSION['matches'] = $matches;
	
	header("Location: thank-you.php");
?>

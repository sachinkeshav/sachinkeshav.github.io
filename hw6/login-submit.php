<?php
	include ("db-connection.php");
	
	$name = filter_input(INPUT_POST, "name");
	$password = filter_input(INPUT_POST, "password");
	
	session_start();
	
	if (!$name || !$password) {
		$_SESSION['error'] = "Username or password field cannot be empty";
		header("Location: login.php");
		exit();
	}
	
	$stmt = $db->prepare("SELECT * FROM singles WHERE name = :name");
	$stmt->execute(array(':name' => $name));
	$row = $stmt->fetch();
	
	if ($row) {
		if (password_verify($password, $row["pass"])){
			session_regenerate_id();
			$_SESSION['username'] = $name;
			
			$match_stmt = $db->prepare ( "SELECT * FROM singles WHERE gender <> :gender AND age >= :min AND age <= :max
					AND os = :os AND (type1 = :type1 OR type2 = :type2 OR type3 = :type3 OR type4 = :type4)" );
			$match_stmt->execute ( array (
					':gender' => $row ["gender"],
					':min' => $row ["min"],
					':max' => $row ["max"],
					':os' => $row ["os"],
					':type1' => $row ["type1"],
					':type2' => $row ["type2"],
					':type3' => $row ["type3"],
					':type4' => $row ["type4"]
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
			header("Location: view-match.php");
		} else {
			$_SESSION['error'] = "Invalid username or password";
			header("Location: login.php");
			exit();
		}
	} else {
		$_SESSION['error'] = "Invalid username or password";
		header("Location: login.php");
		exit();
	}
?>
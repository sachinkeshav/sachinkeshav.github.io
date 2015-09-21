<?php

function getUserDetail($name) {
	$user_detail = array();
	$all_users = file("singles.txt");
	
	foreach ($all_users as $user) {
		$user_detail_array = explode(",", $user);
		
		if ($name === $user_detail_array[0]) {
			$user_detail["name"] = $user_detail_array[0];
			$user_detail["gender"] = $user_detail_array[1];
			$user_detail["age"] = $user_detail_array[2];
			$user_detail["type"] = $user_detail_array[3];
			$user_detail["os"] = $user_detail_array[4];
			$user_detail["seeking"]["min"] = $user_detail_array[5];
			$user_detail["seeking"]["max"] = $user_detail_array[6];
			
			break;
		}
	}
	
	return $user_detail;
}

function getMatches($user_detail) {
	$matches = array();
	$all_users = file("singles.txt");
	$count = 0;
	
	foreach ($all_users as $user) {
		$user_detail_array = explode(",", $user);
		
		$type_flag = false;
		
		for ($i = 0; $i < 4; $i++){
			if ($user_detail["type"][$i] === $user_detail_array[3][$i]){
				$type_flag = true;
				break;
			}
		}
		
		if ($user_detail["gender"] != $user_detail_array[1]
				&& ($user_detail["age"] >= $user_detail_array[5] && $user_detail["age"] <= $user_detail_array[6])
				&& ($user_detail_array[2] >= $user_detail["seeking"]["min"] && $user_detail_array[2] <= $user_detail["seeking"]["max"])
				&& $user_detail["os"] === $user_detail_array["4"]
				&& $type_flag === true) {
			
			$matches[$count]["name"] = $user_detail_array[0];
			$matches[$count]["gender"] = $user_detail_array[1];
			$matches[$count]["age"] = $user_detail_array[2];
			$matches[$count]["type"] = $user_detail_array[3];
			$matches[$count]["os"] = $user_detail_array[4];
			
			$count++;
		}
	}
	
	return $matches;
}
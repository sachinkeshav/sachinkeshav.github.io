<?php
	$db = new PDO ( "mysql:dbname=nerdluv;host=localhost", "root", "root" );
	$db->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
?>
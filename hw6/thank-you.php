<?php
	session_start();
	if (isset($_SESSION['username'])) {
		$username = $_SESSION['username'];
	}
	
	include("top.html");
?>

<div>
	<p><strong>Thank you!</strong></p>
	<p>Welcome to NerdLuv, <?= $username ?>!</p>
	<p>Now continue on to see your matches <a href="view-match.php">matches</a>!</p>
</div>

<?php include("bottom.html"); ?>
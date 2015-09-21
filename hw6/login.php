<?php
session_start();
if (isset($_SESSION['error'])) {
	$error = $_SESSION['error'];
	unset($_SESSION['error']);
}

if (isset($_SESSION['username'])) {
	header("Location: view-match.php");
	exit();
}

include("top.html");
?>

<div>
	<form action="login-submit.php" method="post">
	  <fieldset>
	    <legend>Returning User:</legend>
	    <?php if($error) : ?>
	    <p class="error"><?= $error ?></p>
	    <?php endif; ?>
	    <strong>Name: </strong><input type="text" name="name" size="16"/><br>
	    <strong>Password: </strong><input type="password" name="password" size="16"/>
	    <input type="submit" value="View My Matches" />
	  </fieldset>
	</form>
</div>

<?php include("bottom.html"); ?>
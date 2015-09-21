<?php include("top.html"); ?>

<?php
if(isset($_GET['error']))
	$error = $_GET['error'];
?>

<div>
	<form action="matches-submit.php" method="post">
	  <fieldset>
	    <legend>Returning User:</legend>
	    <?php if(isset($error)) : ?>
	    <p class="error"><?= $error ?></p>
	    <?php endif; ?>
	    <strong>Name: </strong><input type="text" name="name" size="16"/><br>
	    <strong>Password: </strong><input type="password" name="password" size="16"/>
	    <input type="submit" value="View My Matches" />
	  </fieldset>
	</form>
</div>

<?php include("bottom.html"); ?>
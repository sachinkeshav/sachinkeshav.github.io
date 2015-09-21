<?php
session_start();
if (isset($_SESSION['error'])){
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
	<form action="signup-submit.php" method="post">
	  <fieldset>
	    <legend>New User Signup:</legend>
	    <?php if($error) : ?>
	    <p class="error"><?= $error ?></p>
	    <?php endif; ?>
	    <strong>Name: </strong><input type="text" name="name" size="16" /><br>
	    <strong>Password: </strong><input type="password" name="password" size="16" /><br>
	    <strong>Gender: </strong><label><input type="radio" name="gender" value="M" />Male</label>
	    						<label><input type="radio" name="gender" value="F" />Female</label><br>
	    <strong>Age: </strong><input type="text" name="age" size="6" /><br>
	    <strong>Personality type: </strong><input type="text" name="type" size="6" />
	    	<span>(<a href="http://www.humanmetrics.com/cgi-win/jtypes2.asp">Don't know your type?</a>)</span><br>
	    <strong>Favorite OS: </strong><select name="os">
			<option value="Windows" selected>Windows</option>
			<option value="Mac OS X">Mac OS X</option>
			<option value="Linux">Linux</option>
			</select> <br />
		<strong>Seeking age: </strong>
			<input type="text" name="min" size="6" placeholder="min" maxlength="2" /><span> to</span>
			<input type="text" name="max" size="6" placeholder="max" maxlength="2" /><br>
	    <input type="submit" value="Sign Up" />
	  </fieldset>
	</form>
</div>

<?php include("bottom.html"); ?>
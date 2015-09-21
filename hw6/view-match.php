<?php
	session_start();
	if (isset($_SESSION['username'])) {
		$username = $_SESSION['username'];
		
		if (isset($_SESSION['matches'])) {
			$matches = $_SESSION['matches'];
			$total_matches = count($matches);
			if (isset($_GET['match'])) {
				$m = $_GET['match'];
			} else $m = 0;
			
			$tn = $m;
			$tp = $m;
			$n = $m < $total_matches - 1 ? ++$tn : $m;
			$p = $m > 0 ? --$tp : $m;
		}
	} else {
	    $_SESSION['error'] = "Please login first";
	    header("Location: login.php");
	    exit();
	}
	
	include("top.html");
?>

<div>
	<h1>Matches for <?= $username ?><span> (<a href="logout.php">Logut</a>)</span></h1>
	
		<?php if ($matches) : ?>
		<div class="match">
			<p>
				<img src="images/user.jpg" alt="photo">
				<?= $matches[$m]["name"] ?>			
			</p>
			<ul>
				<li><strong>gender:</strong>  <?= $matches[$m]["gender"] ?></li>
				<li><strong>age:</strong>     <?= $matches[$m]["age"] ?></li>
				<li><strong>type:</strong>    <?= $matches[$m]["type"] ?></li>
				<li><strong>OS:</strong>      <?= $matches[$m]["os"] ?></li>
			</ul>
		</div>
		<div>
			<p>
				<span id="<?php if ($m == 0) echo "hidden"; else echo "previous-match"; ?>"><a href="view-match.php?match=<?= $p ?>">Previous Match</a></span>
				<span id="<?php if ($m == $total_matches - 1) echo "hidden"; else echo "next-match"; ?>"><a href="view-match.php?match=<?= $n ?>">Next Match</a></span>
			</p>
		</div>
		<?php else : ?>
		<div>Sorry, no match found!</div>
		<?php endif; ?>
</div>

<?php include("bottom.html"); ?>
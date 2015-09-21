<?php
	include("top.html");
	
	include("common.php");
	$name = filter_input(INPUT_GET, "name");
	$user_detail = getUserDetail($name);
	$matches = getMatches($user_detail);
?>

<div>
	<h1>Matches for <?= $name ?></h1>
	
	<?php
	for ($i = 0; $i < count($matches); $i++) { ?>
		<div class="match">
			<p>
				<img src="images/user.jpg" alt="photo">
				<?= $matches[$i]["name"] ?>			
			</p>
			<ul>
				<li><strong>gender:</strong>  <?= $matches[$i]["gender"] ?></li>
				<li><strong>age:</strong>     <?= $matches[$i]["age"] ?></li>
				<li><strong>type:</strong>    <?= $matches[$i]["type"] ?></li>
				<li><strong>OS:</strong>      <?= $matches[$i]["os"] ?></li>
			</ul>
		</div>
	<?php } ?>
</div>

<?php include("bottom.html"); ?>
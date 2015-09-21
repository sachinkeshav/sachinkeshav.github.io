<?php
	include("top.html");
	include ("db-connection.php");
	
	$name = filter_input(INPUT_GET, "name");
	
	$stmt = $db->prepare("SELECT * FROM singles WHERE name = :name");
	$stmt->execute(array(':name' => $name));
	$row = $stmt->fetch();
	
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
	
	$match_rows = $match_stmt->fetchAll ();
?>

<div>
	<h1>Matches for <?= $name ?></h1>
	
	<?php
	foreach ($match_rows as $match) { ?>
		<div class="match">
			<p>
				<img src="images/user.jpg" alt="photo">
				<?= $match["name"] ?>			
			</p>
			<ul>
				<li><strong>gender:</strong>  <?= $match["gender"] ?></li>
				<li><strong>age:</strong>     <?= $match["age"] ?></li>
				<li><strong>type:</strong>    <?= $match["type1"] . $match["type2"] . $match["type3"] . $match["type4"] ?></li>
				<li><strong>OS:</strong>      <?= $match["os"] ?></li>
			</ul>
		</div>
	<?php } ?>
</div>

<?php include("bottom.html"); ?>
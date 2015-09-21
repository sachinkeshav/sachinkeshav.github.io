<?php
	$number_of_songs = 5678;
	$hours = intval($number_of_songs / 10);
	$number_of_top_music = filter_input(INPUT_GET, "newspages") == 0 ? 5 : filter_input(INPUT_GET, "newspages");
// 	if($number_of_top_music == 0) $number_of_top_music = 5;
// 	$favorite_artist = array("Britney Spears", "Christina Aguilera", "Justin Bieber", "Lady Gaga");
	$favorite_artist = file("favorite.txt");
?>
<!DOCTYPE html>
<html>
	<!--
	Web Programming Step by Step
	Lab #3, PHP
	-->

	<head>
		<title>Music Viewer</title>
		<meta charset="utf-8" />
		<link href="viewer.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<h1>My Music Page</h1>
		
		<!-- Exercise 1: Number of Songs (Variables) -->
		<p>
			I love music.
			I have <?= $number_of_songs ?> total songs,
			which is over <?= $hours ?> hours of music!
		</p>

		<!-- Exercise 2: Top Music News (Loops) -->
		<!-- Exercise 3: Query Variable -->
		<div class="section">
			<h2>Yahoo! Top Music News</h2>
		
			<ol>
				<?php for($i = 1; $i <= $number_of_top_music; $i++) { ?>
					<li><a href="http://music.yahoo.com/news/archive/<?= $i ?>.html">Page <?= $i ?></a></li>
					
				<?php } ?>
				

<!-- 				<li><a href="http://music.yahoo.com/news/archive/1.html">Page 1</a></li> -->
<!-- 				<li><a href="http://music.yahoo.com/news/archive/2.html">Page 2</a></li> -->
<!-- 				<li><a href="http://music.yahoo.com/news/archive/3.html">Page 3</a></li> -->
<!-- 				<li><a href="http://music.yahoo.com/news/archive/4.html">Page 4</a></li> -->
<!-- 				<li><a href="http://music.yahoo.com/news/archive/5.html">Page 5</a></li> -->

			</ol>
		</div>

		<!-- Exercise 4: Favorite Artists (Arrays) -->
		<!-- Exercise 5: Favorite Artists from a File (Files) -->
		<div class="section">
			<h2>My Favorite Artists</h2>
		
			<ol>
				<?php for($i = 0; $i < count($favorite_artist); $i++) { ?>
					<li><a href="http://music.yahoo.com/videos/<?php $artist = strtolower($favorite_artist[$i]);
							$a = explode(" ", $artist);
							$artist_link = implode("-", $a);
							echo(trim($artist_link)); ?>/"></a><?= $favorite_artist[$i] ?>
					</li>
				<?php } ?>
<!-- 				<li>Britney Spears</li> -->
<!-- 				<li>Christina Aguilera</li> -->
<!-- 				<li>Justin Bieber</li> -->
			</ol>
		</div>
		
		<!-- Exercise 6: Music (Multiple Files) -->
		<!-- Exercise 7: MP3 Formatting -->
		<div class="section">
			<h2>My Music and Playlists</h2>

			<ul id="musiclist">
				<?php
					$mp3_file_path = glob("songs/*.mp3");
					shuffle($mp3_file_path);
					foreach($mp3_file_path as $mp3file) {
						$mp3_file_name = basename($mp3file);
						?>
						<li class="mp3item">
							<a href="<?= implode("%20", explode(" ", $mp3file)) ?>"><?php
								$file_size = intval(filesize($mp3file) / 1024);
								echo($mp3_file_name) ?></a><?= ' ('.$file_size. ' KB'.')' ?>
								<audio controls="controls">
									<source src="<?= implode("%20", explode(" ", $mp3file)) ?>" />
								</audio>
						</li>
				<?php } ?>
				
<!--
				<li class="mp3item">
					<a href="http://mumstudents.org/cs472/Labs/3/songs/be-more.mp3">be-more.mp3</a>
				</li>
				
				<li class="mp3item">
					<a href="http://mumstudents.org/cs472/Labs/3/songs/just-because.mp3">just-because.mp3</a>
				</li>

				<li class="mp3item">
					<a href="http://mumstudents.org/cs472/Labs/3/songs/drift-away.mp3">drift-away.mp3</a>
				</li>
-->

				<!-- Exercise 8: Playlists (Files) -->
				
				<?php
					$playlist_path = glob("songs/*.m3u");
					shuffle($playlist_path);
					foreach($playlist_path as $playlist) {
						$playlist_name = basename($playlist);
						$mp3_files = file($playlist);
						shuffle($mp3_files);
						
						?><li class="playlistitem"><?= $playlist_name ?>:
						<ul><?php
						
						foreach($mp3_files as $mp3) {
							$mp3_pos = strpos($mp3, "#");
							if($mp3_pos !== 0) {
								?>
								<li><?= $mp3 ?></li>
							<?php } ?>
						<?php } ?>
						</ul>
						</li>
				<?php } ?>
<!--
				<li class="playlistitem">472-mix.m3u:
					<ul>
						<li>Hello.mp3</li>
						<li>Be More.mp3</li>
						<li>Drift Away.mp3</li>
						<li>190M Rap.mp3</li>
						<li>Panda Sneeze.mp3</li>
					</ul>
				</li>
-->
			</ul>
		</div>

		<div>
			<a href="http://validator.w3.org/check/referer">
				<img src="http://mumstudents.org/cs472/Labs/3/w3c-html.png" alt="Valid HTML5" />
			</a>
			<a href="http://jigsaw.w3.org/css-validator/check/referer">
				<img src="http://mumstudents.org/cs472/Labs/3/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>


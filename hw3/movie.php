<?php
	include 'movieutil.php';
	$movie = filter_input(INPUT_GET, "film");
	
	$title = getTitle($movie);
	$year = getYear($movie);
	$overall_review = getOverallReview($movie);
	$overview_image_src = getOverviewImageSrc($movie);
	$overall_review_image_src = getOverallReviewImageSrc($movie);
	$movie_overview = getMovieOverview($movie);
	$left_column_reviews = getLeftColumnReviews($movie);
	$right_column_reviews = getRightColumnReviews($movie);
	$review_count = getReviewCount($movie);
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?= $title ?> - Rancid Tomatoes</title>

		<meta charset="utf-8" />
		<link href="movie.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<div id="banner-background">
			<img id="banner" src="images/banner.png" alt="Rancid Tomatoes" />
		</div>

		<h1 id="movie-title"><?= $title." (".$year.")" ?></h1>
		
		<div id="main-content">
			<div id="content-right">
				<div id="overview">
					<img src="<?= $overview_image_src ?>" alt="general overview" />
				</div>
		
				<dl>
					<?php
					foreach ($movie_overview as $overview) {
						$overview_array = explode(":", $overview);
						if ($overview_array[0] === "LINKS") { ?>
							<dt><?= trim($overview_array[0]) ?></dt>
							<dd>
								<ul>
									<li><?= $overview_array[1] ?></li>
								</ul>
							</dd>
						<?php } else { ?>
							<dt><?= trim($overview_array[0]) ?></dt>
							<dd><?= $overview_array[1] ?></dd>
						<?php } ?>
					<?php } ?>
				</dl>
			</div>
	
			<div id="content-left">
				<div id="content-left-top">
					<img src="<?= $overall_review_image_src ?>" alt="Rotten" />
					<span id="review-percentage"><?= $overall_review ?>%</span>
				</div>
				
				<div id="left-comment-block">
					<?php
					foreach ($left_column_reviews as $left_review){
						$review_details = file($left_review); ?>
						<p class="comment">
							<img src="images/<?= trim(strtolower($review_details[1])) ?>.gif" alt="<?= trim(strtolower($review_details[1])) ?>" />
							<q><?= trim($review_details[0]) ?></q>
						</p>
						<p class="user">
							<img src="images/critic.gif" alt="Critic" />
							<?= trim($review_details[2]) ?> <br />
							<?= trim($review_details[3]) ?>
						</p>
					<?php } ?>
				</div>
		
				<div id="right-comment-block">
					<?php
					foreach ($right_column_reviews as $right_review){
						$review_details = file($right_review); ?>
						<p class="comment">
							<img src="images/<?= trim(strtolower($review_details[1])) ?>.gif" alt="<?= trim(strtolower($review_details[1])) ?>" />
							<q><?= trim($review_details[0]) ?></q>
						</p>
						<p class="user">
							<img src="images/critic.gif" alt="Critic" />
							<?= trim($review_details[2]) ?> <br />
							<?= trim($review_details[3]) ?>
						</p>
					<?php } ?>
				</div>
			</div>
	
			<div id="footer">
				<p>(1-<?= $review_count ?>) of <?= $review_count ?></p>
			</div>
		</div>

		<div id="validator" >
			<a href="http://validator.w3.org/check/referer"><img src="images/w3c-html.png" alt="Valid HTML5" /></a> <br />
			<a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="images/w3c-css.png" alt="Valid CSS" /></a>
		</div>
	</body>
</html>
<?php

function getTitle($movie) {
	$info = file($movie."/info.txt");
	return trim($info[0]);
}

function getYear($movie) {
	$info = file($movie."/info.txt");
	return trim($info[1]);
}

function getOverviewImageSrc($movie) {
	return trim(glob($movie."/overview.png")[0]);
}

function getOverallReview($movie) {
	$info = file($movie."/info.txt");
	return trim($info[2]);
}

function getOverallReviewImageSrc($movie) {
	$review_percentage = getOverallReview($movie);
	
	if ($review_percentage >= 60)
		return trim(glob("images/freshbig.png")[0]);
	else return trim(glob("images/rottenbig.png")[0]);
}

function getMovieOverview($movie) {
	$overview = file($movie."/overview.txt");
	return $overview;
}

function getLeftColumnReviews($movie) {
	$review_files = getReviewFiles($movie);
	$left_review_count = intval(count($review_files) / 2);
	$left_column_reviews = array();
	
	for ($i = 0; $i < $left_review_count; $i++) {
		$left_column_reviews[$i] = $review_files[$i];
	}
	
	return $left_column_reviews;
}

function getRightColumnReviews($movie) {
	$review_files = getReviewFiles($movie);
	$no_of_reviews = count($review_files);
	$right_review_count = intval($no_of_reviews / 2);
	$right_column_reviews = array();
	
	for ($i = 0, $j = $right_review_count; $j < $no_of_reviews; $i++, $j++) {
		$right_column_reviews[$i] = $review_files[$j];
	}
	
	return $right_column_reviews;
}

function getReviewCount($movie) {
	return count(getReviewFiles($movie));
}

function getReviewFiles($movie) {
	$review_files = glob($movie."/review*.txt");
	return $review_files;
}
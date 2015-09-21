/*  
 * This is the JavaScript for a solution to the first "exercise" of the Maze lab.
 * You can use this code as a starting point for the Maze lab, which should take
 * less than an hour to complete.  kl9/22/2013
 * 
 * This lab is pretty straightforward if you follow the lab steps.  The only part
 * I found tricky was checking for players going outside the Maze after starting
 * a game.  Hint:  If you are not sure of where the Maze border is, you can
 * color it by adding something like --  border: 20px solid green; -- to the 
 * #maze { css rule.  
 * 
 * Instructions from Maze Lab, first "exercise":
 * Write code so that when the user moves the mouse onto a single one of the maze's walls (mouseover), that wall will turn red. 
 * Use the top-left wall; it is easier because it has an id of boundary1.
 
 Write your JS code unobtrusively, without modifying maze.html.
 Write a $(document).ready(); handler that sets up any event handlers.
 Handle the event on the wall by making it turn red.
 Turn the wall red by setting it to have the provided CSS class youlose, using jQuery's addClass method.
 
 */

$(function() {
	"use strict";
	var boundaryTouched = false;
	var gameStarted = false;

	$(document).ready(function() {
		// event handler on top-left wall should get class youlose on mouseover
		$('.boundary').mouseenter(turnRedHandler);
		$('.boundary').mouseleave(resetRedHandler);
		$('#end').click(displayMsg);
		$('#start').click(startGame);
	});

	// adds class of youlose to turn background red on triggering object
	function turnRedHandler() {
		if (gameStarted) {
			$('.boundary').addClass('youlose');
			boundaryTouched = true;
		}
	}

	function resetRedHandler() {
		if (gameStarted && boundaryTouched) {
			$('.boundary').removeClass('youlose');
		}
	}

	function startGame() {
		gameStarted = true;

		if (boundaryTouched) {
			$('.boundary').removeClass('youlose');
			boundaryTouched = false;
		}

		// var startOffsetX = $(this).offset().left;
		// var startOffsetY = $(this).offset().top;
		// $('#start').mouseleave(function(event) {
		// 	var mouseX = event.pageX;
		// 	var mouseY = event.pageY;
		// 	if (mouseX < startOffsetX) {
		// 		gameLost();
		// 	}
		// });
		
		$('#maze').mouseleave(function() {
				gameLost();
		});
	}

	function gameLost() {
		turnRedHandler();
		displayMsg();
	}

	function displayMsg() {
		if (gameStarted) {
			gameStarted = false;
			var status = $('#status');
			
			if (boundaryTouched) {
				status.text("Sorry, you lost. :[");
			} else {
				status.text("You win! :]");
			}
			
			setTimeout(function(){
				status.text("Click the \"S\" to begin.");
				$('.boundary').removeClass('youlose');
			}, 3000);
		}
	}
});

$(function() {
	"use strict";

	var timer = 0;
	var divscom;

	$(document).ready(function() {
		init();
		divscom = divcom();
		$("#shufflebutton").click(shuffle);
		$(".puzzlepiece").hover(hoverOnPiece);
		$(".puzzlepiece").click(clickPiece);
	});

	var init = function() {
		var divs = $("#puzzlearea div");

		for (var i = 0; i < divs.length; i++) {
			var div = divs[i];
			var x = ((i % 4) * 100);
			var y = (Math.floor(i / 4) * 100);
			$(div).addClass("puzzlepiece");
			$(div).css({
				"left" : x + "px",
				"top" : y + "px",
				"background-image" : "url(\"cat.jpg\")",
				"background-position" : -x + "px " + (-y) + "px"
			});
			div.x = x;
			div.y = y;
		}
	};

	var divcom = function() {
		var d = [];
		var c = $(".puzzlepiece");
		for (var i = 0; i < c.length; i++) {
			d[i] = {
				x : $(c[i]).position().left,
				y : $(c[i]).position().top
			};
		}
		return d;
	};

	var emptytop = 300;
	var emptyleft = 300;

	function shifttoempty(current) {
		var pos = current.position();
		current.css("top", emptytop + "px");
		current.css("left", emptyleft + "px");
		emptyleft = pos.left;
		emptytop = pos.top;

	}

	function checkwin() {
		var divnow = function() {
			var d = [];
			var c = $(".puzzlepiece");

			for (var i = 0; i < c.length; i++) {
				d[i] = {
					x : $(c[i]).position().left,
					y : $(c[i]).position().top
				};
			}
			return d;
		};

		var complete = true;
		var divsnow = divnow();
		for (var i = 0; i < divscom.length; i++) {
			if ((Math.floor(divscom[i].x) !== Math.floor(divsnow[i].x)) || (Math.floor(divscom[i].y) !== Math.floor(divsnow[i].y))) {
				complete = false;
			}
		}

		if (complete) {
			clearInterval(timer);
			alert("You Won! HURRAY!!");

		}
	}

	var clickPiece = function() {
		var current = $(this).position();
		if ((emptytop === current.top && (emptyleft === current.left + 100 || emptyleft === current.left - 100)) || (emptyleft === current.left && (emptytop === current.top + 100 || emptytop === current.top - 100))) {
			shifttoempty($(this));
			checkwin();
		}
	};

	var hoverOnPiece = function() {
		var current = $(this).position();
		if ((emptytop === current.top && (emptyleft === current.left + 100 || emptyleft === current.left - 100)) || (emptyleft === current.left && (emptytop === current.top + 100 || emptytop === current.top - 100))) {
			$(this).addClass("movablepiece");
		} else {
			$(this).removeClass("movablepiece");

		}
	};

	var shuffle = function() {
		var t = 0;
		for (var i = 0; i < 100; i++) {
			var allpiece = $(".puzzlepiece");
			var pice = [];
			var k = 0;
			for (var j = 0; j < allpiece.length; j++) {

				if ((emptytop === Math.floor($(allpiece[j]).position().top) && (emptyleft === Math
						.floor($(allpiece[j]).position().left + 100) || emptyleft === Math
						.floor($(allpiece[j]).position().left - 100))) || (emptyleft === Math
								.floor($(allpiece[j]).position().left) && (emptytop === Math
								.floor($(allpiece[j]).position().top + 100) || emptytop === Math
								.floor($(allpiece[j]).position().top - 100)))) {
					pice[k] = $(allpiece[j]);
					k++;
				}
			}
			shifttoempty($(pice[Math.floor(Math.random() * (pice.length))]));
		}

		$("#timer").text("Time : " + t + " seconds");
		clearInterval(timer);
		timer = setInterval(function() {
			t++;
			$("#time").text("Time :" + t + "seconds");
		}, 1000);
	};
});
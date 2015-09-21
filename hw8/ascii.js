(function() {
	"use strict";

	var intervalId;
	function allAnimationFrames() {
		document.getElementById("text-area").innerHTML = ANIMATIONS[document
				.getElementById("actors").value];
	}

	function startAnimation() {
		document.getElementById("start-button").disabled = true;
		document.getElementById("stop-button").disabled = false;
		var animation = ANIMATIONS[document.getElementById("actors").value];
		var splitAnimation = animation.split("=====\n");
		var speed = document.getElementById("chkbox").checked ? 50 : 250;
		var i = 0;
		intervalId = setInterval(
				function() {
					document.getElementById("text-area").innerHTML = splitAnimation[i++];
					if (i === splitAnimation.length) {
						i = 0;
					}
				}, speed);
	}

	function stopAnimation() {
		document.getElementById("stop-button").disabled = true;
		document.getElementById("start-button").disabled = false;
		clearInterval(intervalId);
	}

	function changeSize() {
		var size = document.getElementById("size").value;
		var fontSize = 12;
		switch (size) {
		case "tiny":
			fontSize = 7;
			break;
		case "small":
			fontSize = 10;
			break;
		case "medium":
			fontSize = 12;
			break;
		case "large":
			fontSize = 16;
			break;
		case "extralarge":
			fontSize = 24;
			break;
		case "xxl":
			fontSize = 32;
			break;
		default:
			fontSize = 12;
		}
		document.getElementById("text-area").style.fontSize = fontSize + "pt";

	}

	function turbo() {
		if (document.getElementById("start-button").disabled) {
			stopAnimation();
			startAnimation();
		}
	}

	window.onload = function() {
		document.getElementById("start-button").onclick = startAnimation;
		document.getElementById("stop-button").onclick = stopAnimation;
		document.getElementById("start-button").disabled = false;
		document.getElementById("stop-button").disabled = true;
		document.getElementById("actors").onchange = allAnimationFrames;
		document.getElementById("size").onchange = changeSize;
		document.getElementById("chkbox").onchange = turbo;
	};
})();
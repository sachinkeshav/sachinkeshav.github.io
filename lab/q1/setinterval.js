(function() {
	"use strict";
	
	var timer = null;
	
	var rudy = function() {
		document.getElementById("output").innerHTML += " Rudy!";
	};
	
	var rudyTimer = (function() {
		return function(){
			if (timer === null) {
				timer = setInterval(rudy, 1000);
			} else {
				clearInterval(timer);
				timer = null;
			}
		};
	})();
	
	window.onload = function() {
		document.getElementById("button").onclick = rudyTimer;
	};
})();
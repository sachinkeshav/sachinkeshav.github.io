(function() {
	"use strict";
	var timer = null;

	function biggerDecorations() {
		if (timer == null) {
		    timer = setInterval(biggerFont, 500);
		} else {
		    clearInterval(timer);
			timer = null;
		}
	}

	function biggerFont() {
		var textArea = document.getElementById("text-decorations");
		var size = parseInt(textArea.style.fontSize) ? parseInt(textArea.style.fontSize) : 12;
		size += 2;
  		textArea.style.fontSize =  size + "pt";
	}

	function changeFontWeight() {
		var textArea = document.getElementById("text-decorations");
		var body = document.body;

		if (!textArea.className || textArea.className === "normalFont") {
			textArea.className = "boldFont greenColor";
			body.className = "background";
		} else if (textArea.className === "boldFont greenColor") {
		    textArea.className = "normalFont";
		    body.className = "";
		}
	}

	window.onload = function() {
		document.getElementById("bigger-decorations").onclick = biggerDecorations;
		document.getElementById("bling").onchange = changeFontWeight;
	}
})();
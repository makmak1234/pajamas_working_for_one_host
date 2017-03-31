
  var b_canvas = document.getElementById("carousel");
  var b_context = b_canvas.getContext("2d");
 // b_context.fillRect(50, 25, 150, 100);

  window.onload = function() {
	var canvas = document.getElementById("carousel");
	var context = canvas.getContext("2d");
	var cat = document.getElementById("image1");
	context.translate(100, 0);
	context.drawImage(cat, 50, 50, 200, 160);
	//var sm = CanvasRenderingContext2D;
	context.scale(1.5, 1.5);
  };
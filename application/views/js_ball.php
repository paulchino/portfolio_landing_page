<html>
<head>
	<title>Javascript Box - OOP demo</title>
</head>

<style type="text/css">

/*body {
	-webkit-user-select: none; 
}*/
html {
	-webkit-user-select: none; 
}

#svg {
	height:100vh;
	min-width: 100vw;
	border-radius: 12px;
	-webkit-touch-callout: none;
	-webkit-user-select: none; /* Disable selection/copy in UIWebView */
}

</style>

<body>
	<svg id="svg" xmlns="http://www.w3.org/2000/svg"></svg>
</body>


	<script>
	alert("Click down the mouse button to create colorful circles. Hold down longer for larger cirlces!");

	var mobile = false;
	var rate = 6;

	if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		mobile = true;
		rate = 10;
		//need coords on touchstart
		var x_mobile, y_mobile;		
		//alert(navigator.userAgent);
	}

	var time_pressed;
	(function () {
		var mousedown_time;

		function getTime(){
			var date = new Date();
			return date.getTime();
		}

		function elapsed(init) {
			time_pressed = getTime() - init;
			time_pressed = time_pressed < 50 ? 50 : time_pressed;
			time_pressed = time_pressed > 1000 ? 1000 : time_pressed;
		}

		if (mobile) {
			document.addEventListener('touchstart', function(e) {
				x_mobile = e.touches[0].clientX;
				y_mobile = e.touches[0].clientY;
				mousedown_time = getTime();
			})

			document.addEventListener("touchend", function(e) {
				elapsed(mousedown_time);

				// time_pressed = getTime() - mousedown_time;
				// time_pressed = time_pressed < 50 ? 50 : time_pressed;
				// time_pressed = time_pressed > 1000 ? 1000 : time_pressed;
				playground.createNewCircle(x_mobile, y_mobile);
			})	
		} else {
			document.onmousedown = function(e) {
				mousedown_time = getTime();
			}

			document.onmouseup = function(e) {
				elapsed(mousedown_time);
				// time_pressed = getTime() - mousedown_time;
				// time_pressed = time_pressed < 50 ? 50 : time_pressed;
				// time_pressed = time_pressed > 1000 ? 1000 : time_pressed;
				//console.log(time_pressed);
				return time_pressed;
			}
		}
	})();

	document.touchstart = function(e) {
		alert('test');
	}

	function Circle(cx, cy, html_id) {
		function randomColor() {
			var letters = '0123456789ABCDEF'.split('');
			var color = '#';
			for (var i = 0; i < 6; i++ ) {
	    		color += letters[Math.floor(Math.random() * 16)];
	    	}
			return color;
		}

		function randomNumberBetween(min, max) {
			return Math.random()*(max-min) + min;
		}

		function makeSVG(tag, attrs) {
	        var el = document.createElementNS('http://www.w3.org/2000/svg', tag);
	        for (var k in attrs) {
	            el.setAttribute(k, attrs[k]);
	        }
	        return el;
	    }

		this.info = { 
			cx: cx,
			cy: cy,
			r: time_pressed/rate,
			id: html_id,
			style: 'fill:' + randomColor() 
		};

		//initialize includes the id, coord and add velocity, radius, and style
		this.initialize = function(){
			this.info.velocity = {
				x: randomNumberBetween(-1,1),
				y: randomNumberBetween(-1,1)
			}

			var circle = makeSVG('circle', 
				{ 	cx: this.info.cx,
				  	cy: this.info.cy,
				  	r:  this.info.r,
				  	id: html_id,
				  	style: this.info.style
				});

			document.getElementById('svg').appendChild(circle);
		}

		//this is the function that calls the circle
	    this.initialize();	

		this.update = function(time) {
			var el = document.getElementById(html_id);

			if( (this.info.cx + this.info.r) > document.body.clientWidth || (this.info.cx - this.info.r)  < 0) {
				this.info.velocity.x = this.info.velocity.x * -1;
			}

			if( (this.info.cy + this.info.r)> document.body.clientHeight || (this.info.cy -this.info.r)< 0) {
				this.info.velocity.y = this.info.velocity.y * -1;
			}

			this.info.cx = this.info.cx + this.info.velocity.x*time;
			this.info.cy = this.info.cy + this.info.velocity.y*time;

			el.setAttribute("cx", this.info.cx);
			el.setAttribute("cy", this.info.cy);
		}
	}

	function PlayGround() {

		var counter = 0;
		var circles = [ ]; 

		this.createNewCircle = function(x,y){
			var new_circle = new Circle(x,y,counter++);
			circles.push(new_circle);
		}

		this.loop = function() {
			for(circle in circles) {
				//update every millsecond
				circles[circle].update(1);
			}
			//check collisions
			collisions();
		}

		function collisions() {
			var id_i, id_j, ele_i, ele_j;
			for(var i = 0; i < circles.length; i++) {
				//console.log(circles[i].info.cx);
				for(var j = 0; j < circles.length; j++) {
					var x = Math.pow(circles[i].info.cx-circles[j].info.cx,2);
					var y = Math.pow(circles[i].info.cy-circles[j].info.cy,2);

					if ( Math.sqrt(x+y) <= (circles[i].info.r + circles[j].info.r) && (i!=j) ) {
						//
						id_i = circles[i].info.id;
						ele_i = document.getElementById(id_i);
						ele_i.parentNode.removeChild(ele_i);

						id_j = circles[j].info.id;
						ele_j = document.getElementById(id_j);
						ele_j.parentNode.removeChild(ele_j);

						
						// $("#"+circles[i].info.id).remove();
						// $("#"+circles[j].info.id).remove();

						//remove the circles from the array
						circles.splice(i,1);
						if(i > j) {
							circles.splice(j,1);
						} else {
							circles.splice(j-1,1);
						}
					}	
				}
			}
		}
	}

	var playground = new PlayGround();
	setInterval(playground.loop, 10);

	if (!mobile) {
		document.onclick = function(e) {
			playground.createNewCircle(e.x,e.y);
		}
	}
	</script>
</html>
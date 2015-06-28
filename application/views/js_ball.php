<html>
<head>
	<title>Javascript Box - OOP demo</title>
</head>

<script src="/assets/js/jquery.js"></script>

<!-- tasks 
	- minimum ball size
	- media queries if on mobile clicking ball produced same size
	- 50 mini for time pressed

 -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.7.0/underscore-min.js"></script> -->
<style type="text/css">

	#svg {
		height:100vh;
		min-width: 100vw;
		border: 1px solid black;
		border-radius: 12px;
	}

</style>

<body>
<!-- 	<h2> Click on Screen! Hold the mouse longer for larger circles!</h2> -->
	<svg id="svg" xmlns="http://www.w3.org/2000/svg"></svg>
	<script>
	
	var time_pressed;

	//action to determine record mouse time
	(function () {
		var mousedown_time;

		function getTime(){
			var date = new Date();
			return date.getTime();
		}

		document.onmousedown = function(e){
			mousedown_time = getTime();
		}
		document.onmouseup = function(e){
			time_pressed = getTime() - mousedown_time;
			if (time_pressed < 50) {
				time_pressed = 50;
			}
			if (time_pressed > 1000) {
				time_pressed = 1000;
			}
			//console.log('You held your mouse down for', time_pressed, 'miliseconds.');
			return time_pressed;
		}
	})();

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
			r: time_pressed/6,
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
			for(var i = 0; i < circles.length; i++) {
				//console.log(circles[i].info.cx);
				for(var j = 0; j < circles.length; j++) {
					var x = Math.pow(circles[i].info.cx-circles[j].info.cx,2);
					var y = Math.pow(circles[i].info.cy-circles[j].info.cy,2);

					if ( Math.sqrt(x+y) <= (circles[i].info.r + circles[j].info.r) && (i!=j) ) {
						$("#"+circles[i].info.id).remove();
						$("#"+circles[j].info.id).remove();

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
		//create one circle when the game starts
		//this.createNewCircle(document.body.clientWidth, document.body.clientHeight);
	}

	var playground = new PlayGround();
	setInterval(playground.loop, 10);

	document.onclick = function(e) {
		playground.createNewCircle(e.x,e.y);
	}
	
	</script>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Effective JavaScript: Frogger</title>
    <link href="/assets/css/frogger.css" rel="stylesheet">

</head>
<body>
	<div class="title">
		<h1> Frogger </h1>
		<h3>Your score is: <span id = "score"> 0 </span> </h3> 
		<h3>Your high score is: <span id = "highScore">  </span> </h3> 
	</div>
	<div class="container">
		<div class= "characters">
			<input type = "image" src="/assets/img/frogger/char-boy.png" class = 'char' alt = 'Char Boy'> 
			<input type = "image" src = "/assets/img/frogger/char-cat-girl.png" class = 'char' alt = 'Cat Girl'>
		</div>
		<div class = "tableScore">

		</div>
		<div class= "characters">
			<input type = "image" src = "/assets/img/frogger/char-horn-girl.png" class = 'char' alt = 'Horn Girl'>
			<input type = "image" src = "/assets/img/frogger/char-princess-girl.png" class = 'char' alt = 'Princess'>
		</div>		
	</div>
	<div class="keyboard">
		<button class="arrow up_arrow_btn"><img src="/assets/img/frogger/up_arrow.png"></button>
		<button class="arrow left_arrow_btn"><img src="/assets/img/frogger/left_arrow.png"></button>
		<button class="arrow down_arrow_btn"><img src="/assets/img/frogger/down_arrow.png"></button>
		<button class="arrow right_arrow_btn"><img src="/assets/img/frogger/right_arrow.png"></button>
	</div>

</body>
    <script type="text/javascript" src="/assets/js/jquery.js"></script>
    <script type="text/javascript" src="/assets/js/frogger/resources.js"></script>
    <script type="text/javascript" src="/assets/js/frogger/app.js"></script>
    <script type="text/javascript" src="/assets/js/frogger/engine.js"></script>  
</html>

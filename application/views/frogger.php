<!DOCTYPE html>
<html>
<head>
    <title>Effective JavaScript: Frogger</title>
<!--     <meta name="viewport" content="user-scalable=no">  -->
    <link href="/assets/dist/css/styles/frogger.min.css" rel="stylesheet">

</head>
<body>
	<div class="title">
		<h1> Frogger </h1>
		<h3>Your score is: <span id = "score"> 0 </span> </h3> 
		<h3>Your high score is: <span id = "highScore">  </span> </h3> 
	</div>
	<div class="container">
		<div class= "characters">
			<input type = "image" src="/assets/dist/img/frogger/char-boy.png" class = 'char' alt = 'Char Boy'> 
			<input type = "image" src = "/assets/dist/img/frogger/char-cat-girl.png" class = 'char' alt = 'Cat Girl'>
		</div>
		<div class = "tableScore">

		</div>
		<div class= "characters">
			<input type = "image" src = "/assets/dist/img/frogger/char-horn-girl.png" class = 'char' alt = 'Horn Girl'>
			<input type = "image" src = "/assets/dist/img/frogger/char-princess-girl.png" class = 'char' alt = 'Princess'>
		</div>		
	</div>
	<div class="keyboard">
		<input class="arrow up_arrow_btn" type="image" src="/assets/dist/img/frogger/up_arrow.png" />
		<input class="arrow left_arrow_btn" type="image" src="/assets/dist/img/frogger/left_arrow.png" />
		<input class="arrow down_arrow_btn" type="image" src="/assets/dist/img/frogger/down_arrow.png" />
		<input class="arrow right_arrow_btn" type="image" src="/assets/dist/img/frogger/right_arrow.png" />	
	</div>

</body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/dist/js/frogger/resources.min.js"></script>
    <script type="text/javascript" src="/assets/dist/js/frogger/app.min.js"></script>
    <script type="text/javascript" src="/assets/dist/js/frogger/engine.min.js"></script>  
</html>

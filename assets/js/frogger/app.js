//------- Enemy Class
var Enemy = function() {
    // Variables applied to each of our instances go here,
    // we've provided one for you to get started

    // The image/sprite for our enemies, this uses
    // a helper we've provided to easily load img
    this.sprite = '/assets/img/frogger/enemy-bug.png';
    this.x = 0;
    this.y = 0;
    this.speed = Math.floor(Math.random() * 100) + 100;
}

// Update the enemy's position, required method for game
// Parameter: dt, a time delta between ticks
Enemy.prototype.update = function(dt) {
    this.x += this.speed * dt;
    //Enemy is off the screen
    if (this.x > 600) {
        this.reset();
    }
    // You should multiply any movement by the dt parameter
    // which will ensure the game runs at the same speed for
    // all computers.
}

// Draw the enemy on the screen, required method for game
Enemy.prototype.render = function() {
    ctx.drawImage(Resources.get(this.sprite), this.x, this.y);
}

Enemy.prototype.reset = function() {
    this.x = -50;
    this.y = 83 * Math.floor(Math.random()*3) + 60;
}

var allEnemies = [];
for (var i = 0; i < 4; i++) {
    e = new Enemy;
    e.x = Math.random() * 450;
    e.y = 83 * (Math.floor(Math.random() * 3)) + 60;
    allEnemies.push(e);
}

// ---------- Player Class

var Player = function() {
    this.sprite = '/assets/img/frogger/char-cat-girl.png';
    this.x = 202;
    this.y = 332;
}

Player.prototype.update = function(dt) {
    //Player is in the water
    if (this.y < 83) {
        this.reset();
    }
}

Player.prototype.reset = function() {
    var xPos = [0,101,202,303,404];
    var randx = Math.floor(Math.random()*5);
    this.x = xPos[randx];
    this.y = 332;
}

Player.prototype.render = function() {
    ctx.drawImage(Resources.get(this.sprite), this.x, this.y);
}

Player.prototype.handleInput= function(keyCode) {
    if (keyCode == 'left') { 
        if (player.x >= 101) {
            player.x -= 101;
        }
    } 
    else if (keyCode == 'up') { 
        if (player.y >= 83) {
            player.y -= 83;
        } 
    }
    else if (keyCode == 'right') { 
        if (player.x <= 303) {
            player.x += 101;
        } 
    }
    else if (keyCode == 'down') { 
        if (player.y <= 332) {
            player.y += 83;
        } 
    }
}

var player = new Player;


$(".up_arrow_btn").on("mousedown", function() {
    console.log('hello');
    player.handleInput("up");
});

//click events for arrows fix
// $(".up_arrow_btn").click(function() {
//     player.handleInput("up");
// });

$(".left_arrow_btn").click(function() {
    player.handleInput("left");
})

$(".down_arrow_btn").click(function() {
    player.handleInput("down");
})

$(".right_arrow_btn").click(function() {
    player.handleInput("right");
})
function charSelect() {
    var link = $(this).attr("src");
    console.log(link);
    player.sprite = link;
}

$('.char').on('click', charSelect);

//------ Scoring

// -- init highscore
hasLocalStorage();
$("#highScore").html(localStorage.score);

function scoreReset() {
    curScore = 0;
    $("#score").text(parseInt(0));
}

var highScore = parseInt($("#highScore").text());
var curScore = parseInt($("#score").text());

function myTimer() {
    if (player.x >= 0 && player.x <= 404 && player.y >= 83 && player.y <= 249) {
        curScore += 10;
        $("#score").text(curScore); 
        if (curScore > highScore) {
            highScore = curScore;
            $("#highScore").text(curScore);
            if (hasLocalStorage()) {
                saveScore(curScore);
            }
            
        }
    } else {
        scoreReset();
    }
}

// ------ local storage for high score
function hasLocalStorage() {
    if( typeof(Storage) !== "undefined" ) {
        if ( typeof localStorage.score === "undefined") {
            localStorage.score = 0;
        }
        return true
    }
}

function saveScore(score) {
    if (score > localStorage.score) {
        localStorage.score = score;
    }
}

setInterval(function() { myTimer(); }, 1000);

//Gem Class
/*var Gem = function () {
    this.sprite = 'img/Gem-Blue.png';
    this.x = 202;
    this.y = 246.5;
}

Gem.prototype.render = function() {
    ctx.drawImage(Resources.get(this.sprite), this.x, this.y);


}
Gem.prototype.update = function() {
    window.setInterval(function() {
        this.x +=101
    }, 3000)
}

var blueGem = new Gem;
*/






//var blueGem = new Gem;


// This listens for key presses and sends the keys to your
// Player.handleInput() method. You don't need to modify this.
document.addEventListener('keyup', function(e) {
    var allowedKeys = {
        37: 'left',
        38: 'up',
        39: 'right',
        40: 'down'
    };
    player.handleInput(allowedKeys[e.keyCode]);
});

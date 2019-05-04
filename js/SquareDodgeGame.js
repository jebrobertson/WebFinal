// JavaScript source code
var timeUpdate = 10;
var time = 0;
var lastSpawn = -5000;
var hasPaused = false;
var interval;
var canvasWidth;
var canvasHeight;
var isDead = false;

class Shape {
    constructor(x, y, width, height, color, speed) {
        this.x = x;
        this.y = y;
        this.height = height;
        this.width = width;
        this.color = color;
        this.xVel = 0;
        this.yVel = 0;
        this.speed = speed;
    }



    touching(rect) {
        return (Math.abs(rect.x - this.x) <= rect.width / 2 + this.width / 2) && (Math.abs(rect.y - this.y) <= rect.height / 2 + this.height / 2);
    }

    setVel(x, y) {
        this.xVel = x;
        this.yVel = y;

        var speed = Math.sqrt(Math.pow(this.xVel, 2) + Math.pow(this.yVel, 2));
        if (speed < .5)
            return;
        this.xVel *= this.speed / speed;
        this.yVel *= this.speed / speed;
    }

    updatePosition(dtime) {

        if (this.x + this.xVel * dtime < this.width / 2 || this.x + this.xVel * dtime > canvasWidth - this.width / 2) {
            this.xVel = -this.xVel;
            return;
        }
        if (this.y + this.yVel * dtime < this.height / 2 || this.y + this.yVel * dtime > canvasHeight - this.height / 2) {
            this.yVel = -this.yVel;
            return;
        }

        this.x += dtime * this.xVel;
        this.y += dtime * this.yVel;
    }

}

class Rectangle extends Shape {
    drawRect(context) {
        context.beginPath();
        context.rect(this.x - this.width / 2, this.y - this.height / 2, this.width, this.height);
        context.fillStyle = this.color;
        context.fill();
        context.closePath();
    }
}

class Circle extends Shape {

    drawCircle(context) {
        context.beginPath();
        context.arc(this.x, this.y, this.width / 2, 0, Math.PI * 2);
        context.fillStyle = this.color;
        context.fill();
        context.closePath();
    }
}

var rightKey, leftKey, upKey, downKey;
$("html").keydown(function (e) {
    if (e.key == "Right" || e.key == "ArrowRight") {
        rightKey = true;
        e.preventDefault();
    }
    if (e.key == "Up" || e.key == "ArrowUp") {
        upKey = true;
        e.preventDefault();
    }
    if (e.key == "Left" || e.key == "ArrowLeft") {
        leftKey = true;
        e.preventDefault();
    }
    if (e.key == "Down" || e.key == "ArrowDown") {
        downKey = true
        e.preventDefault();
    }
});

$("html").keyup(function (e) {
    if (e.key == "Right" || e.key == "ArrowRight") {
        rightKey = false;
    }
    if (e.key == "Up" || e.key == "ArrowUp") {
        upKey = false;
    }
    if (e.key == "Left" || e.key == "ArrowLeft") {
        leftKey = false;
    }
    if (e.key == "Down" || e.key == "ArrowDown") {
        downKey = false;
    }
});

$(function () {
    interval = setInterval(drawImage, timeUpdate);
    loadLeaders();
    loadPersonalBest();
    getBallColor();
});

function gameOver() {
    isDead = true;
    clearInterval(interval);
    loadLeaders();
    loadPersonalBest();
    alert("Game Over! You lasted " + time / 1000 + " seconds!");
    if(!hasPaused)
        updateScore();
}

function handlePlayerMove(player, dtime) {
    var xVel = 0, yVel = 0;

    if (rightKey)
        xVel += 1;
    if (upKey)
        yVel -= 1;
    if (leftKey)
        xVel -= 1;
    if (downKey)
        yVel += 1;

    player.setVel(xVel, yVel);
    player.updatePosition(dtime);
}

function getRandomColor() {
    var color = "#";
    for (var i = 0; i < 6; i++) {
        color += (Math.floor(Math.random() * 16)).toString(16);
    }
    console.log(color);
    return color;
}

function spawnRectangle(player) {
    var x, y, width, height, color, vel;
    width = Math.random() * 120 + 30;
    height = Math.random() * 100 + 20;

    x = Math.random() * (canvasWidth / 2 - width) + width / 2;
    y = Math.random() * (canvasHeight / 2 - height) + height / 2;
    if (player.x < canvasWidth / 2)
        x += canvasWidth / 2;
    if (player.y < canvasHeight / 2)
        y += canvasHeight / 2;

    color = getRandomColor();

    vel = Math.random() * 800 - 400;
    dir = Math.random() * Math.PI * 2;
    var r = new Rectangle(x, y, width, height, color, vel);
    console.log(vel);
    r.setVel(vel * Math.cos(dir), vel * Math.sin(dir));
    console.log(r);
    return r;
}

function handleRectangles(rects, player, context, dtime) {

    rects.forEach(function (item, index, array) {

        item.updatePosition(dtime / 1000);
        item.drawRect(context);
        if (player.touching(item)) {
            gameOver();

        }
    });
}

function drawText(context) {

    context.font = "15px Sans Serif";
    context.fillStyle = "#000000";
    context.textAlign = "center";
    context.fillText("Time (sec): " + Math.floor(time / 1000), canvasWidth / 2, 20);


}

var rects = [];// = new Rectangle(200, 300, 100, 100, "#FF0000", 20);
var circle = new Circle(200, 400, 40, 40, "#0000FF", 800);
function drawImage() {
    time += timeUpdate;



    var canvas = document.getElementById("gameCanvas");
    canvasWidth = canvas.width;
    canvasHeight = canvas.height;
    var context = canvas.getContext("2d");

    if (time - lastSpawn > 5000) {
        rects.push(spawnRectangle(circle));
        lastSpawn = time;
    }

    drawText(context);

    context.clearRect(0, 0, canvas.width, canvas.height);
    handleRectangles(rects, circle, context, timeUpdate);

    handlePlayerMove(circle, timeUpdate / 1000);
    circle.drawCircle(context);

    drawText(context);
}


function pauseGame() {
    if(isDead)
        return;
    var buttonPause = document.getElementById("pauseStart");
    if (buttonPause.innerHTML == "Pause") {
        hasPaused = true;
        clearInterval(interval);
        buttonPause.innerHTML = "Restart";
    }
    else if (buttonPause.innerHTML == "Restart"){
        interval = setInterval(drawImage, timeUpdate);
        buttonPause.innerHTML = "Pause";
    }
}

function resetGame() {
    var buttonReset = document.getElementById("reset");
    time = 0;
    isDead = false;
    lastSpawn = -5000;
    hasPaused = false;
    rects = [];
    circle.x = 200;
    circle.y = 400;
    upKey = rightKey = leftKey = downKey = false;
    clearInterval(interval);
    interval = setInterval(drawImage, timeUpdate);
}

function loadLeaders(){
    $.get("getLeaders.php", function(data, status){
        if(status == "success"){
            var scores = JSON.parse(data);
            var data = "<tr><th>Username</th><th>Time</th></tr>";
            for(var i = 0; i < scores.length; i++)
            {
                data += "<tr><td>"+scores[i].username+"</td><td>"+scores[i].score+"</td></tr>"; 
            }
            $("#leaders").html(data);
       }
    });
}

function loadPersonalBest(){
    $.get("getPersonalBest.php", function(data, status){
        if(status == "success"){
            var scores = JSON.parse(data);
            var data = "<tr><th>Username</th><th>Time</th></tr>";
            for(var i = 0; i < scores.length; i++)
            {
                data += "<tr><td>"+scores[i].username+"</td><td>"+scores[i].score+"</td></tr>"; 
            }
            $("#personalBest").html(data);
       }
    });
}

function updateScore(){
    $.post("insertScore.php", {score: time/1000}, function(data, status){console.log(data, status);});
}

function getBallColor(){
    $.get("getColor.php", function(data, status){
        if(status == "success"){
            var color = JSON.parse(data);
            if(color[0].color != null)
                circle.color = color[0].color;
        }
    });
}


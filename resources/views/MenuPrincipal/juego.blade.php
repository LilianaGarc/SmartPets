<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perrito Runner 🐶</title>
    <style>
        body {
            margin: 0;
            background: #ffffff;
            overflow: hidden;
            font-family: 'Arial', sans-serif;
        }

        .game-container {
            width: 100%;
            height: 100vh;
            position: relative;
            overflow: hidden;
        }

        .ground-filler {
            position: absolute;
            bottom: 0;
            height: 200px;
            width: 100%;
            background-color: #343e46;
            z-index: 0;
        }

        .background {
            position: absolute;
            bottom: 200px;
            width: 200%;
            height: 160px;
            background-image: url(https://media.tenor.com/lN4vBkMnxSAAAAAi/nima1-nimakrmanji.gif);
            background-size: contain;
            background-repeat: repeat-x;
            animation: moveBg 100s linear infinite;
            z-index: 1;
        }

        @keyframes moveBg {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        #dog {
            width: 130px;
            height: 120px;
            position: absolute;
            bottom: 200px;
            left: 50px;
            background-image: url('https://media.tenor.com/f5IqNksAcW0AAAAj/woof-running.gif');
            background-size: cover;
            z-index: 2;
        }

        #obstacle {
            width: 70px;
            height: 70px;
            background-image: url('https://cdn-icons-png.flaticon.com/512/616/616408.png');
            background-size: cover;
            position: absolute;
            bottom: 200px;
            left: 100%;
            z-index: 2;
        }

        .jump {
            animation: jump 0.5s ease-out;
        }

        @keyframes jump {
            0% { bottom: 200px; }
            50% { bottom: 350px; }
            100% { bottom: 200px; }
        }

        .score {
            position: absolute;
            top: 120px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 22px;
            font-weight: bold;
            color: #1e4183;
            background: rgba(255,255,255,0.85);
            padding: 8px 14px;
            border-radius: 10px;
            box-shadow: 0 0 6px #ababab;
            z-index: 3;
        }

        .game-over {
            position: absolute;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 38px;
            color: #1e4183;
            display: none;
            text-align: center;
            background: white;
            padding: 25px 30px;
            border-radius: 20px;
            box-shadow: 0 0 25px rgba(0,0,0,0.3);
            z-index: 3;
        }

        .game-over button {
            margin-top: 20px;
            padding: 12px 24px;
            font-size: 18px;
            border: none;
            background-color: #1e4183;
            color: white;
            border-radius: 10px;
            cursor: pointer;
        }

        .game-over button:hover {
            background-color: #1a4cab;
        }
    </style>
</head>
<body>
@include('MenuPrincipal.Navbar')

<div class="game-container">
    <div class="ground-filler"></div>
    <div class="background"></div>
    <div class="score" id="score">Puntos: 0</div>
    <div id="dog"></div>
    <div id="obstacle"></div>
    <div class="game-over" id="gameOver">
        ¡Juego Terminado!<br>
        <span id="finalScore"></span><br>
        <span id="highScore"></span><br>
        <button onclick="location.reload()">Reintentar</button>
    </div>
</div>

<script>
    const dog = document.getElementById('dog');
    const obstacle = document.getElementById('obstacle');
    const scoreDisplay = document.getElementById('score');
    const gameOver = document.getElementById('gameOver');
    const finalScore = document.getElementById('finalScore');
    const highScoreDisplay = document.getElementById('highScore');

    let score = 0;
    let isGameOver = false;
    let obstacleX = window.innerWidth;
    let speed = 6;
    let frameRate = 1000 / 60;

    let highScore = sessionStorage.getItem('highScore') || 0;
    highScoreDisplay.innerText = `Puntaje más alto: ${highScore}`;

    document.addEventListener('keydown', function (e) {
        if ((e.code === 'Space' || e.key === ' ' || e.key === 'ArrowUp' || e.key === 'w') && !isGameOver) {
            jump();
        }
    });

    function jump() {
        if (!dog.classList.contains('jump')) {
            dog.classList.add('jump');
            setTimeout(() => {
                dog.classList.remove('jump');
            }, 500);
        }
    }

    function moveObstacle() {
        if (isGameOver) return;

        obstacleX -= speed;
        if (obstacleX < -70) {
            obstacleX = window.innerWidth;
        }

        obstacle.style.left = obstacleX + 'px';

        const dogBottom = parseInt(window.getComputedStyle(dog).getPropertyValue("bottom"));
        if (obstacleX < 130 && obstacleX > 30 && dogBottom < 240) {
            endGame();
        }

        requestAnimationFrame(moveObstacle);
    }

    function endGame() {
        isGameOver = true;
        gameOver.style.display = "block";
        finalScore.innerText = `Puntaje final: ${score}`;

        if (score > highScore) {
            highScore = score;
            sessionStorage.setItem('highScore', highScore);
            highScoreDisplay.innerText = `Puntaje más alto: ${highScore}`;
        }
    }

    requestAnimationFrame(moveObstacle);

    let scoreCounter = setInterval(() => {
        if (!isGameOver) {
            score++;
            scoreDisplay.innerText = `Puntos: ${score}`;

            if (score % 10 === 0) {
                speed += 0.5;
            }
        }
    }, 200);
</script>

</body>
</html>

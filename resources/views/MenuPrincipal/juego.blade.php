<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <title>Perrito Runner 🐶</title>
    <style>
        :root {
            font-size: 16px;
        }
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            height: 100vh;
            overflow: hidden;
            touch-action: manipulation;
        }
        .game-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }
        .game-container {
            width: 90vw;
            max-width: 80rem;
            height: 60vh;
            position: relative;
            background: #ffffff;
            box-shadow: 0 0 1.25rem rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transform-origin: top left;
        }
        .floating-squares-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
            pointer-events: none;
        }
        .squares {
            height: 100%;
            display: flex;
            justify-content: space-around;
            overflow: hidden;
        }
        .square {
            animation: squares 9.5s linear infinite;
            align-self: flex-end;
            width: 1em;
            height: 1em;
            transform: translateY(100%);
            background: #a8d0ff;
        }
        .square:nth-child(2) {
            height: 1.5em;
            width: 3em;
            animation-delay: 1s;
            animation-duration: 17s;
            background: #ffd3a3;
            filter: blur(5px);
        }
        .square:nth-child(3) {
            height: 2em;
            width: 1em;
            animation-delay: 1.5s;
            animation-duration: 8s;
            background: #ffffff;
        }
        .square:nth-child(4) {
            height: 1em;
            width: 1.5em;
            animation-delay: 0.5s;
            filter: blur(3px);
            background: #a8d0ff;
            animation-duration: 13s;
        }
        .square:nth-child(5) {
            height: 1.25em;
            width: 2em;
            animation-delay: 4s;
            filter: blur(2px);
            background: #ffd3a3;
            animation-duration: 11s;
        }
        .square:nth-child(6) {
            height: 2.5em;
            width: 2em;
            animation-delay: 2s;
            filter: blur(1px);
            background: #a8d0ff;
            animation-duration: 9s;
        }
        .square:nth-child(7) {
            height: 5em;
            width: 2em;
            filter: blur(2.5px);
            background: #ffd3a3;
            animation-duration: 12s;
        }
        .square:nth-child(8) {
            height: 1em;
            width: 3em;
            animation-delay: 5s;
            filter: blur(6px);
            background: #ffffff;
            animation-duration: 18s;
        }
        .square:nth-child(9) {
            height: 3em;
            width: 2.4em;
            animation-delay: 6s;
            background: #a8d0ff;
            filter: blur(0.5px);
            animation-duration: 12s;
        }
        @keyframes squares {
            from {
                transform: translateY(100%) rotate(-50deg);
            }
            to {
                transform: translateY(calc(-100vh - 100%)) rotate(20deg);
            }
        }
        .ground-filler {
            position: absolute;
            bottom: 0;
            height: 6vh;
            width: 100%;
            background-color: #343e46;
            z-index: 1;
        }
        .background {
            position: absolute;
            bottom: 6vh;
            width: 200%;
            height: 5vh;
            background-image: url('{{ asset('images/calle2.gif') }}');
            background-size: contain;
            background-repeat: repeat-x;
            animation: moveBg 100s linear infinite;
            z-index: 2;
        }
        @keyframes moveBg {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        #dog {
            width: 9rem;
            height: 7.5rem;
            position: absolute;
            bottom: 6vh;
            left: 3rem;
            background-image: url('https://media.tenor.com/f5IqNksAcW0AAAAi/woof-running.gif');
            background-size: cover;
            z-index: 3;
        }
        #obstacle, #obstacle2 {
            width: 4rem;
            height: 4rem;
            background-size: cover;
            position: absolute;
            bottom: 6vh;
            left: 100%;
            z-index: 3;
        }
        #obstacle {
            background-image: url('{{ asset('images/bebe.png') }}');
        }
        #obstacle2 {
            background-image: url('{{ asset('images/bebe2.png') }}');
        }
        .jump {
            animation: jump 0.5s ease-out;
        }
        @keyframes jump {
            0% { bottom: 6vh; }
            50% { bottom: 30vh; }
            100% { bottom: 6vh; }
        }

        .score {
            position: absolute;
            top: 1rem;
            left: 50%;
            transform: translateX(-50%);
            font-size: 1.3rem;
            font-weight: bold;
            color: #1e4183;
            background: rgba(255, 255, 255, 0.85);
            padding: 0.5rem 1rem;
            border-radius: 0.625rem;
            box-shadow: 0 0 0.4rem #ababab;
            z-index: 4;
        }
        .game-over {
            position: absolute;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 2rem;
            color: #1e4183;
            display: none;
            text-align: center;
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 0 1.5rem rgba(0, 0, 0, 0.3);
            z-index: 5;
        }
        .game-over button {
            margin-top: 1rem;
            padding: 0.8rem 1.5rem;
            font-size: 1.2rem;
            border: none;
            background-color: #1e4183;
            color: white;
            border-radius: 0.5rem;
            cursor: pointer;
        }
        .game-over button:hover {
            background-color: #1a4cab;
        }
        .sound-button {
            position: absolute;
            bottom: 1rem;
            right: 2rem;
            background-color: #1e4183;
            color: white;
            font-size: 1rem;
            padding: 0.6rem 1.2rem;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            z-index: 4;
        }
        .sound-button:hover {
            background-color: #1a4cab;
        }
        .level-up-effect {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 5rem;
            font-weight: 900;
            font-family: 'Arial Black', sans-serif;
            background: linear-gradient(135deg, #fff4cc, #ffd700, #f7b733, #fff4cc);
            background-size: 300% 300%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5), 0 0 20px rgba(255, 215, 0, 0.4), 2px 2px 8px rgba(0, 0, 0, 0.2);
            z-index: 10;
            opacity: 0;
            pointer-events: none;
            animation: goldPop 2s ease-out;
        }
        @keyframes goldPop {
            0% { transform: translate(-50%, -50%) scale(0); opacity: 0; }
            25% { transform: translate(-50%, -50%) scale(1.2); opacity: 1; }
            50% { transform: translate(-50%, -50%) scale(1); opacity: 1; }
            100% { transform: translate(-50%, -50%) scale(0); opacity: 0; }
        }
    </style>
</head>
<body class="light-mode">
@include('MenuPrincipal.Navbar')
<div class="game-wrapper">
    <div class="game-container">
        <div class="floating-squares-bg">
            <div class="squares">
                <div class="square"></div>
                <div class="square"></div>
                <div class="square"></div>
                <div class="square"></div>
                <div class="square"></div>
                <div class="square"></div>
                <div class="square"></div>
                <div class="square"></div>
                <div class="square"></div>
            </div>
        </div>
        <div class="ground-filler"></div>
        <div class="background"></div>
        <div id="levelUpEffect" class="level-up-effect"></div>
        <div class="score" id="score">Puntos: 0</div>
        <div id="dog"></div>
        <div id="obstacle"></div>
        <div id="obstacle2"></div>
        <div class="game-over" id="gameOver">
            ¡Juego Terminado!<br />
            <span id="finalScore"></span><br />
            <span id="highScore"></span><br />
            <button onclick="location.reload()">Reintentar</button>
        </div>
        <button class="sound-button" id="soundButton">Silenciar</button>
    </div>
</div>
<audio id="backgroundMusic" loop>
    <source src="{{ asset('images/carusel.mp3') }}" type="audio/mp3" />
    Tu navegador no soporta el elemento de audio.
</audio>
<script>
    const dog = document.getElementById('dog');
    const obstacle = document.getElementById('obstacle');
    const obstacle2 = document.getElementById('obstacle2');
    const scoreDisplay = document.getElementById('score');
    const gameOver = document.getElementById('gameOver');
    const finalScore = document.getElementById('finalScore');
    const highScoreDisplay = document.getElementById('highScore');
    const soundButton = document.getElementById('soundButton');
    const backgroundMusic = document.getElementById('backgroundMusic');
    let score = 0;
    let isGameOver = false;
    let obstacleX = window.innerWidth;
    let obstacle2X = window.innerWidth + 600;
    let speed = 5;
    let isMuted = false;
    const minSeparation = 500;
    const maxSeparation = 1400;
    function getRandomSeparation() {
        return Math.floor(Math.random() * (maxSeparation - minSeparation + 1)) + minSeparation;
    }
    const storedMuteState = sessionStorage.getItem('isMuted');
    isMuted = storedMuteState === 'true';
    function updateSound() {
        if (isMuted) {
            backgroundMusic.pause();
            soundButton.innerText = 'Activar Sonido';
        } else {
            backgroundMusic.play();
            soundButton.innerText = 'Silenciar';
        }
    }
    updateSound();
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
            setTimeout(() => dog.classList.remove('jump'), 500);
        }
    }
    let obstacleRotation = 0;
    let obstacle2Rotation = 0;
    function moveObstacles() {
        if (isGameOver) return;
        const deltaX1 = speed + Math.random() * 0.3;
        obstacleX -= deltaX1;
        if (obstacleX < -70) {
            let separation = getRandomSeparation();
            obstacleX = obstacle2X + separation;
        }
        const deltaX2 = speed + Math.random() * 0.3;
        obstacle2X -= deltaX2;
        if (obstacle2X < -70) {
            let separation = getRandomSeparation();
            obstacle2X = obstacleX + separation;
        }
        obstacle.style.left = obstacleX + 'px';
        obstacle2.style.left = obstacle2X + 'px';
        const obstacleRadius = 2 * 16;
        const rotationDegrees1 = -(deltaX1 / (2 * Math.PI * obstacleRadius)) * 360;
        obstacleRotation += rotationDegrees1;
        obstacle.style.transform = `rotate(${obstacleRotation}deg)`;
        const rotationDegrees2 = -(deltaX2 / (2 * Math.PI * obstacleRadius)) * 360;
        obstacle2Rotation += rotationDegrees2;
        obstacle2.style.transform = `rotate(${obstacle2Rotation}deg)`;
        const dogBottom = parseInt(window.getComputedStyle(dog).getPropertyValue("bottom"));
        if ((obstacleX < 130 && obstacleX > 30 && dogBottom < 140) ||
            (obstacle2X < 130 && obstacle2X > 30 && dogBottom < 140)) {
            endGame();
        }
        requestAnimationFrame(moveObstacles);
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
    requestAnimationFrame(moveObstacles);
    setInterval(() => {
        if (!isGameOver) {
            score++;
            scoreDisplay.innerText = `Puntos: ${score}`;
            if (score % 50 === 0) {
                showLevelUp(score);
                document.body.classList.toggle('dark-mode');
                document.body.classList.toggle('light-mode');
            }
            if (score % 20 === 0) {
                speed += 0.15;
            }
        }
    }, 200);
    soundButton.addEventListener('click', () => {
        isMuted = !isMuted;
        sessionStorage.setItem('isMuted', isMuted);
        updateSound();
    });
    function showLevelUp(score) {
        const effect = document.getElementById('levelUpEffect');
        effect.innerText = score;
        effect.style.animation = 'none';
        effect.offsetHeight;
        effect.style.animation = 'goldPop 2s ease-out';
    }
</script>
</body>
</html>

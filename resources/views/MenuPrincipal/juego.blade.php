<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perrito Runner 🐶</title>
    <style>
        body {
            margin: 0;
            background-color: #ffffff;
            background-repeat: repeat;
            font-family: 'Arial', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            height: 100vh;
            overflow: hidden;
        }

        .game-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        .game-container {
            width: 1000px;
            height: 500px;
            position: relative;
            background: #ffffff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transform-origin: top left;
        }

        @media (max-width: 1200px) {
            .game-container {
                transform: scale(0.9);
            }
        }

        @media (max-width: 1000px) {
            .game-container {
                transform: scale(0.8);
            }
        }

        @media (max-width: 820px) {
            .game-container {
                transform: scale(0.7);
            }
        }

        .ground-filler {
            position: absolute;
            bottom: 0;
            height: 100px;
            width: 100%;
            background-color: #343e46;
            z-index: 0;
        }

        .background {
            position: absolute;
            bottom: 100px;
            width: 200%;
            height: 50px;
            background-image: url('{{ asset('images/calle2.gif') }}');
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
            width: 140px;
            height: 120px;
            position: absolute;
            bottom: 100px;
            left: 50px;
            background-image: url('https://media.tenor.com/f5IqNksAcW0AAAAi/woof-running.gif');
            background-size: cover;
            z-index: 2;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        #obstacle {
            width: 70px;
            height: 70px;
            background-image: url('{{ asset('images/bebe.png') }}');
            background-size: cover;
            position: absolute;
            bottom: 100px;
            left: 100%;
            z-index: 2;
            animation: rotateObstacle 2s linear infinite;
        }

        @keyframes rotateObstacle {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .jump {
            animation: jump 0.5s ease-out;
        }

        @keyframes jump {
            0% { bottom: 100px; }
            50% { bottom: 220px; }
            100% { bottom: 100px; }
        }

        .score {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 22px;
            font-weight: bold;
            color: #1e4183;
            background: rgba(255, 255, 255, 0.85);
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
            font-size: 32px;
            color: #1e4183;
            display: none;
            text-align: center;
            background: white;
            padding: 25px 30px;
            border-radius: 20px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.3);
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

        body.dark-mode {
            background-color: #1a1a1a;
            background-image: none;
        }

        body.dark-mode .game-container {
            background-color: #2a2a2a;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
        }

        body.dark-mode .ground-filler {
            background-color: #343e46;
        }

        body.dark-mode .score,
        body.dark-mode .game-over {
            background: rgba(0, 0, 0, 0.7);
            color: #ffffff;
        }

        body.dark-mode .game-over button {
            background-color: #ffffff;
            color: #000000;
        }

        body.dark-mode .game-over button:hover {
            background-color: #dddddd;
        }

        .sound-button {
            position: absolute;
            bottom: 10px;
            right: 20px;
            background-color: #1e4183;
            color: white;
            font-size: 18px;
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            z-index: 4;
        }

        .sound-button:hover {
            background-color: #1a4cab;
        }

        body.light-mode {
            background-color: #ffffff;
            background-image: none;
        }

        body.light-mode .game-container {
            background-color: #ffffff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        body.light-mode .ground-filler {
            background-color: #343e46;
        }

        body.light-mode .score,
        body.light-mode .game-over {
            background: rgba(255, 255, 255, 0.85);
            color: #1e4183;
        }

        body.light-mode .game-over button {
            background-color: #1e4183;
            color: white;
        }

        body.light-mode .game-over button:hover {
            background-color: #1a4cab;
        }


    </style>
</head>
<body>

@include('MenuPrincipal.Navbar')
@include('MenuPrincipal.Navbar')

<div class="game-wrapper">
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
        <button class="sound-button" id="soundButton">Silenciar</button>
    </div>
</div>

<audio id="backgroundMusic" loop>
    <source src="{{ asset('images/carusel.mp3') }}" type="audio/mp3">
    Tu navegador no soporta el elemento de audio.
</audio>

<script>
    const dog = document.getElementById('dog');
    const obstacle = document.getElementById('obstacle');
    const scoreDisplay = document.getElementById('score');
    const gameOver = document.getElementById('gameOver');
    const finalScore = document.getElementById('finalScore');
    const highScoreDisplay = document.getElementById('highScore');
    const soundButton = document.getElementById('soundButton');
    const backgroundMusic = document.getElementById('backgroundMusic');

    let score = 0;
    let isGameOver = false;
    let obstacleX = 1000;
    let speed = 5;
    let isMuted = false;
    let discoMode = false;
    let discoInterval;

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
            setTimeout(() => {
                dog.classList.remove('jump');
            }, 500);
        }
    }

    function moveObstacle() {
        if (isGameOver) return;

        obstacleX -= speed + Math.random() * 0.5;

        if (obstacleX < -70) {
            obstacleX = 1000;
        }

        obstacle.style.left = obstacleX + 'px';

        const dogBottom = parseInt(window.getComputedStyle(dog).getPropertyValue("bottom"));
        if (obstacleX < 130 && obstacleX > 30 && dogBottom < 140) {
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

        clearInterval(discoInterval);
        document.body.classList.remove('dark-mode', 'light-mode');
    }

    function activateDiscoMode() {
        if (discoMode) return;
        discoMode = true;
        let isDark = true;

        discoInterval = setInterval(() => {
            if (isDark) {
                document.body.classList.remove('dark-mode');
                document.body.classList.add('light-mode');
            } else {
                document.body.classList.remove('light-mode');
                document.body.classList.add('dark-mode');
            }
            isDark = !isDark;
        }, 200);
    }

    requestAnimationFrame(moveObstacle);

    let scoreCounter = setInterval(() => {
        if (!isGameOver) {
            score++;
            scoreDisplay.innerText = `Puntos: ${score}`;

            if (score % 10 === 0) {
                speed += 0.3;
            }

            if (!discoMode) {
                if (score >= 200) {
                    activateDiscoMode();
                    document.body.classList.remove('dark-mode', 'light-mode');
                } else if ((score - 44) % 100 === 0) {
                    document.body.classList.add('dark-mode');
                    document.body.classList.remove('light-mode');
                } else if ((score - 44) % 100 === 50) {
                    document.body.classList.add('light-mode');
                    document.body.classList.remove('dark-mode');
                }
            }
        }
    }, 200);

    soundButton.addEventListener('click', () => {
        isMuted = !isMuted;
        sessionStorage.setItem('isMuted', isMuted);
        updateSound();
    });
</script>

</body>
</html>

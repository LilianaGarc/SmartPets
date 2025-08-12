<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <title>Perrito Runner 🐶</title>
    <style>
        :root {
            font-size: 16px;
        }
        body {
            margin: 0;
            padding-top: 15vh;
            font-family: 'Arial', sans-serif;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            overflow-y: auto;
            overflow-x: hidden;
            touch-action: manipulation;
            position: relative;
            height: 100vh;
        }

        .game-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        .game-container {
            width: 45%;
            height: 45vh;
            position: relative;
            background: #ffffff;
            overflow: hidden;
            transform-origin: top left;
            flex-shrink: 0;

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
            background-image: url('{{ asset('images/perritocorriendo.gif') }}');
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
            right: 2rem;
            font-size: 1.3rem;
            font-weight: bold;
            font-family: 'Poppins', sans-serif;
            color: #1e4183;
            background: none;
            padding: 0;
            border-radius: 0;
            box-shadow: none;
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

        .ranking-container {
            width: 60%;
            margin: 2rem auto;
            background-color: #fefefe;
            border-radius: 1rem;
            box-shadow: 0 0 1rem rgba(0,0,0,0.1);
            padding: 1rem 2rem;
            text-align: center;
            font-family: 'Arial', sans-serif;
        }

        .ranking-container h2 {
            margin-bottom: 1rem;
            color: #1e4183;
        }

        .ranking-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 1.1rem;
        }

        .ranking-table thead {
            background-color: #1e4183;
            color: #fff;
        }

        .ranking-table th, .ranking-table td {
            padding: 0.75rem;
            border-bottom: 1px solid #ddd;
        }

        .ranking-table tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .ranking-table tbody tr:hover {
            background-color: rgba(30, 65, 131, 0.13);
        }

        .ranking-table td:nth-child(1) {
            font-weight: bold;
        }
        ::-webkit-scrollbar {
            width: 13px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #e0e0e0;
            border-radius: 12px;
            box-shadow: inset 0 0 8px rgba(0,0,0,0.05);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #ff7c40, rgb(255, 160, 62));
            border-radius: 12px;
            box-shadow:
                inset 0 0 6px rgba(255, 255, 255, 0.7),
                0 0 6px rgb(255, 160, 62);
            transition: background 0.4s ease, box-shadow 0.4s ease;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #ff7c40, rgb(255, 160, 62));
            box-shadow:
                inset 0 0 8px rgba(255, 255, 255, 0.82),
                0 0 12px rgb(255, 160, 62);
        }
        .foto-perfil {
            width: 40px;
            height: 40px;
            background-size: cover;
            background-position: center;
            border-radius: 50%;
            display: inline-block;
            vertical-align: middle;
        }

        .ranking-table td:nth-child(2) {
            text-align: left;
            padding-left: 10rem;
        }

        .ranking-table tbody tr.first-place {
            color: #1e4183;
            font-weight: 900;
            font-size: 1.3rem;
        }

        .ranking-table tbody tr.first-place td:first-child {
            font-weight: 900;
            color: #1e4183;
        }

        .ranking-table tbody tr.second-place {
            color: #1e4183;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .ranking-table tbody tr.second-place td:first-child {
            font-weight: 700;
            color: #1e4183;
        }

        .ranking-table tbody tr.third-place {
            color: #1e4183;
            font-weight: 500;
            font-size: 1.1rem;
        }

        .ranking-table tbody tr.third-place td:first-child {
            font-weight: 500;
            color: #1e4183;
        }
        .medal {
            font-size: 2rem;
            margin-right: 0.7rem;
            vertical-align: middle;
        }

        .ranking-container > div {
            margin-top: 1rem;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
        }

        #prevPageBtn, #nextPageBtn {
            background-color: #1e4183;
            color: white;
            border: none;
            padding: 0.5rem 1.2rem;
            font-size: 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(30, 65, 131, 0.3);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        #prevPageBtn:disabled, #nextPageBtn:disabled {
            background-color: #8b9dc3;
            cursor: not-allowed;
            box-shadow: none;
        }

        #prevPageBtn:hover:not(:disabled), #nextPageBtn:hover:not(:disabled) {
            background-color: #16335c;
            box-shadow: 0 6px 10px rgba(22, 51, 92, 0.6);
        }

        #pageInfo {
            font-weight: 600;
            font-size: 1rem;
            color: #1e4183;
            min-width: 120px;
            text-align: center;
            user-select: none;
        }

    </style>
</head>
<body class="light-mode">
@include('MenuPrincipal.Navbar')
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

<div class="ranking-container">
    <h2>🏆 Ranking Global</h2>
    <table class="ranking-table" id="rankingTable">
        <thead>
        <tr>
            <th>Posición</th>
            <th>Jugador</th>
            <th>Puntaje</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <div style="margin-top:1rem;">
        <button id="prevPageBtn" disabled>Anterior</button>
        <span id="pageInfo"></span>
        <button id="nextPageBtn" disabled>Siguiente</button>
    </div>
</div>

<audio id="backgroundMusic" loop>
    <source src="{{ asset('images/intro.mp3') }}" type="audio/mp3" />
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

    let speedPxPerSec = 600;

    let isMuted = false;
    const minSeparation = 600;
    const maxSeparation = 1400;

    let obstacleRotation = 0;
    let obstacle2Rotation = 0;

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

    let lastTime = null;
    function moveObstacles(timestamp) {
        if (isGameOver) return;

        if (!lastTime) lastTime = timestamp;
        const deltaSec = (timestamp - lastTime) / 1000;
        lastTime = timestamp;

        const moveAmount = speedPxPerSec * deltaSec;

        obstacleX -= moveAmount;
        if (obstacleX < -70) {
            let separation = getRandomSeparation();
            obstacleX = obstacle2X + separation;
        }

        obstacle2X -= moveAmount;
        if (obstacle2X < -70) {
            let separation = getRandomSeparation();
            obstacle2X = obstacleX + separation;
        }

        obstacle.style.left = obstacleX + 'px';
        obstacle2.style.left = obstacle2X + 'px';

        const obstacleRadius = 2 * 16;
        const rotationDegrees = -(moveAmount / (2 * Math.PI * obstacleRadius)) * 360;
        obstacleRotation += rotationDegrees;
        obstacle2Rotation += rotationDegrees;
        obstacle.style.transform = `rotate(${obstacleRotation}deg)`;
        obstacle2.style.transform = `rotate(${obstacle2Rotation}deg)`;


        const dogBottom = parseInt(window.getComputedStyle(dog).getPropertyValue("bottom"));
        if ((obstacleX < 130 && obstacleX > 30 && dogBottom < 140) ||
            (obstacle2X < 130 && obstacle2X > 30 && dogBottom < 140)) {
            endGame();
        }

        requestAnimationFrame(moveObstacles);
    }

    async function guardarPuntaje(puntaje) {
        console.log("guardarPuntaje llamado con:", puntaje);
        try {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const response = await fetch("{{ route('puntaje.store') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                },
                body: JSON.stringify({ puntaje }),
            });
            if (!response.ok) {
                console.error('Error en respuesta al guardar puntaje');
                return;
            }
            const data = await response.json();
            console.log('Respuesta guardar puntaje:', data);
            cargarRanking();
        } catch (error) {
            console.error('Error guardando puntaje:', error);
        }
    }

    function endGame() {
        isGameOver = true;
        gameOver.style.display = "block";
        finalScore.innerText = `Puntaje final: ${score}`;
        console.log("Guardando puntaje final:", score);
        guardarPuntaje(score);
    }

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
                speedPxPerSec += 10;
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

    let currentPage = 1;
    const perPage = 10;

    async function cargarRanking(page = 1) {
        try {
            const response = await fetch(`{{ route('puntaje.rankingJson') }}?page=${page}&perPage=${perPage}`);
            if (!response.ok) {
                console.error('Error cargando ranking');
                return;
            }
            const result = await response.json();
            const ranking = result.data;
            const lastPage = result.lastPage;

            const tbody = document.querySelector('#rankingTable tbody');
            tbody.innerHTML = '';

            const defaultPhotoUrl = "{{ asset('images/fotodeperfil.webp') }}";

            ranking.forEach((item, index) => {
                const position = (page - 1) * perPage + index + 1;
                let medal = '';
                let rowClass = '';

                if (position === 1) {
                    medal = '<span class="medal">🥇</span>';
                    rowClass = 'first-place';
                } else if (position === 2) {
                    medal = '<span class="medal">🥈</span>';
                    rowClass = 'second-place';
                } else if (position === 3) {
                    medal = '<span class="medal">🥉</span>';
                    rowClass = 'third-place';
                }

                const photoUrl = item.fotoperfil || defaultPhotoUrl;
                const tr = document.createElement('tr');
                tr.className = rowClass;
                tr.innerHTML = `
                    <td>${medal} ${position}</td>
                    <td>
                        <div class="foto-perfil" style="background-image: url('${photoUrl}'); margin-right: 0.5rem; display: inline-block; vertical-align: middle;"></div>
                        <span style="vertical-align: middle;">${item.nombre}</span>
                    </td>
                    <td>${item.puntaje}</td>
                `;
                tbody.appendChild(tr);
            });

            document.getElementById('prevPageBtn').disabled = page <= 1;
            document.getElementById('nextPageBtn').disabled = page >= lastPage;
            document.getElementById('pageInfo').innerText = `Página ${page} de ${lastPage}`;

            currentPage = page;
        } catch (error) {
            console.error('Error cargando ranking:', error);
        }
    }

    document.getElementById('prevPageBtn').addEventListener('click', () => {
        if (currentPage > 1) {
            cargarRanking(currentPage - 1);
        }
    });
    document.getElementById('nextPageBtn').addEventListener('click', () => {
        cargarRanking(currentPage + 1);
    });

    cargarRanking();

    document.addEventListener('contextmenu', event => event.preventDefault());
    document.addEventListener('keydown', event => {
        if (event.key === "F12" ||
            (event.ctrlKey && event.shiftKey && event.key === "I") ||
            (event.ctrlKey && event.key === "U") ||
            (event.ctrlKey && event.shiftKey && event.key === "J")) {
            event.preventDefault();
        }
    });

    document.addEventListener('visibilitychange', function () {
        if (document.hidden) {
            isGameOver = true;
            backgroundMusic.pause();
        } else {
            location.reload();
        }
    });

    requestAnimationFrame(moveObstacles);
</script>

</body>
</html>

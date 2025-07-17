<a href="{{ route('chats.index') }}"
   class="chat-button"
   data-img-default="{{ asset('images/perritomens.webp') }}"
   data-img-hover="{{ asset('images/perritohi.webp') }}">
    <img src="{{ asset('images/perritomens.webp') }}" alt="Chat" />
    <span class="tooltip-text">Petchat</span>
    <span id="chat-notification-badge" class="notification-badge" style="display: none;">0</span>
    <audio id="chat-notification-sound" src="{{ asset('images/pika.mp3') }}" preload="auto"></audio>
</a>

<style>
    .chat-button {
        position: fixed;
        bottom: 24px;
        right: 24px;
        width: 110px;
        height: 110px;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        cursor: pointer;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        border-radius: 50%;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color: rgba(255,255,255,0);
        overflow: visible;
    }

    .chat-button img {
        max-width: 85%;
        max-height: 85%;
        object-fit: contain;
        transition: opacity 0.3s ease;
    }

    .chat-button:hover {
        transform: scale(1.15);
        box-shadow: 0 14px 30px rgba(0,0,0,0.35);
    }

    .tooltip-text {
        visibility: hidden;
        width: 80px;
        background-color: rgb(41, 94, 197);
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 6px 8px;
        position: absolute;
        bottom: 105%;
        right: 50%;
        transform: translateX(50%);
        opacity: 0;
        transition: opacity 0.3s ease;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 12px;
        pointer-events: none;
        box-shadow: 0 3px 6px rgba(0,0,0,0.2);
        z-index: 1001;
    }

    .chat-button:hover .tooltip-text  {
        visibility: visible;
        opacity: 1;
    }

    .chat-button:hover .notification-badge  {
        background-color: #ff7c40;
    }

    .notification-badge {
        position: absolute;
        top: 8px;
        right: 8px;
        background-color: #1e4183;
        color: white;
        font-size: 14px;
        font-weight: bold;
        padding: 2px 6px;
        border-radius: 999px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 22px;
        height: 22px;
        box-shadow: 0 0 0 2px white;
        z-index: 1002;
    }

    @keyframes chat-button-bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    .chat-button.bounce {
        animation: chat-button-bounce 0.6s ease;
    }


    @media (max-width: 767px), (hover: none) {
        .chat-button {
            width: 70px;
            height: 70px;
            bottom: 16px;
            right: 16px;
            transition: none;
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
            cursor: default;
        }
        .chat-button img {
            max-width: 80%;
            max-height: 80%;
            transition: none;
        }
        .chat-button:hover {
            transform: none !important;
            box-shadow: 0 6px 15px rgba(0,0,0,0.15) !important;
        }
        .chat-button:hover .tooltip-text {
            visibility: hidden !important;
            opacity: 0 !important;
        }
    }
</style>

<script>
    const chatButton = document.querySelector('.chat-button');

    function isMobile() {
        return window.matchMedia("(max-width: 767px)").matches;
    }

    if (!isMobile()) {
        chatButton.addEventListener('mouseover', () => {
            chatButton.querySelector('img').src = chatButton.dataset.imgHover;
        });
        chatButton.addEventListener('mouseout', () => {
            chatButton.querySelector('img').src = chatButton.dataset.imgDefault;
        });
    } else {
        chatButton.querySelector('img').src = chatButton.dataset.imgDefault;
    }

    window.addEventListener('resize', () => {
        if (isMobile()) {
            chatButton.querySelector('img').src = chatButton.dataset.imgDefault;
            chatButton.removeEventListener('mouseover', null);
            chatButton.removeEventListener('mouseout', null);
        } else {
            chatButton.addEventListener('mouseover', () => {
                chatButton.querySelector('img').src = chatButton.dataset.imgHover;
            });
            chatButton.addEventListener('mouseout', () => {
                chatButton.querySelector('img').src = chatButton.dataset.imgDefault;
            });
        }
    });
</script>
<script>
    let notificacionesAnteriores = 0;

    function actualizarContadorMensajesNoLeidos() {
        fetch('/usuarios-con-mensajes')
            .then(res => res.json())
            .then(data => {
                let totalNoLeidos = 0;
                data.usuariosConMensajes.forEach(item => {
                    totalNoLeidos += item.mensajes_no_leidos;
                });

                const badge = document.getElementById('chat-notification-badge');
                const sonido = document.getElementById('chat-notification-sound');
                const boton = document.querySelector('.chat-button');

                if (totalNoLeidos > 0) {
                    badge.textContent = totalNoLeidos > 99 ? '99+' : totalNoLeidos;
                    badge.style.display = 'flex';

                    if (totalNoLeidos > notificacionesAnteriores) {
                        const sonidoActivo = localStorage.getItem('chatSonidoActivo');
                        if (sonidoActivo !== 'false') {
                            sonido.currentTime = 0;
                            sonido.play().catch(() => {});
                        }

                        boton.classList.add('bounce');
                        setTimeout(() => boton.classList.remove('bounce'), 600);
                    }

                } else {
                    badge.style.display = 'none';
                }

                notificacionesAnteriores = totalNoLeidos;
            })
            .catch(console.error);
    }

    actualizarContadorMensajesNoLeidos();
    setInterval(actualizarContadorMensajesNoLeidos, 5000);
</script>



<a href="{{ route('chats.index') }}"
   class="chat-button"
   data-img-default="{{ asset('images/perritomens.webp') }}"
   data-img-hover="{{ asset('images/perritohi.webp') }}">
    <img src="{{ asset('images/perritomens.webp') }}" alt="Chat" />
    <span class="tooltip-text">Petchat</span>
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

    .chat-button:hover .tooltip-text {
        visibility: visible;
        opacity: 1;
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

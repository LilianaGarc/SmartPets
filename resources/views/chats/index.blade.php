<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Petchat</title>
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css"/>

</head>
<body class="{{ isset($chatActivo) ? 'show-chat' : '' }}">


@include('MenuPrincipal.Navbar')
@php
    if (!function_exists('esSoloNumeros')) {
        function esSoloNumeros($texto) {
            return preg_match('/^\d+$/', $texto);
        }
    }

    if (!function_exists('esSoloEmoji')) {
        function esSoloEmoji($texto) {
            return preg_match('/^\p{Emoji}+$/u', $texto);
        }
    }

    if (!function_exists('esSoloEmojiNoNumeros')) {
        function esSoloEmojiNoNumeros($texto) {
            return !esSoloNumeros($texto) && esSoloEmoji($texto);
        }
    }
@endphp
<div class="chat-container">
    <div class="chat-list">
        <div class="search-box">
            <input type="text" class="form-control" placeholder="Buscar usuario..." id="buscador"     maxlength="50"
            />
        </div>
        <div id="usuarios-lista">
            @forelse($usuariosConMensajes as $item)
                @php
                    $usuario = $item['usuario'];
                    $chat = $item['chat'];
                    $ultimoMensaje = $item['ultimo_mensaje'];
                @endphp

                <a href="{{ route('chats.iniciar', $usuario->id) }}" class="chat-user">
                    <img src="{{ $usuario->fotoperfil ? asset('storage/' . $usuario->fotoperfil) : asset('images/fotodeperfil.webp') }}" alt="Foto" />
                    <div class="user-details">
                        <strong class="d-flex align-items-center gap-1">
                            {{ $usuario->name }}
                            @if($usuario->en_linea)
                                <span class="estado-dot online" title="En línea"></span>
                            @else
                                <span class="estado-dot offline" title="Desconectado"></span>
                            @endif
                        </strong>
                        <small>
                            @php
                                $mostrarTexto = 'Empieza una conversación';

                                if ($ultimoMensaje) {
                                    $hayTexto = !is_null($ultimoMensaje->texto) && trim($ultimoMensaje->texto) !== '';
                                    $hayImagen = !is_null($ultimoMensaje->imagen);

                                    if ($hayTexto && $hayImagen) {
                                        $mostrarTexto = 'Foto y texto: ' . Str::limit($ultimoMensaje->texto, 20);
                                    } elseif ($hayImagen && !$hayTexto) {
                                        $mostrarTexto = 'Foto';
                                    } elseif ($hayTexto) {
                                        $mostrarTexto = Str::limit($ultimoMensaje->texto, 30);

                                    }
                                }
                            @endphp

                            <span class="{{ $item['mensajes_no_leidos'] > 0 ? 'ultimo-mensaje-no-leido' : '' }}">
                                {!! $mostrarTexto !!}
                            </span><br>
                        </small>
                    </div>
                    @if($item['mensajes_no_leidos'] > 0)
                        <span class="unread-badge">{{ $item['mensajes_no_leidos'] }}</span>
                    @endif
                </a>
            @empty
                <div style="text-align: center; padding: 40px 20px; color: #666;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#bbb" viewBox="0 0 24 24" style="margin-bottom: 16px;">
                        <path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                    <h3 style="margin: 10px 0; font-weight: 500; font-size: 20px;">No hay otros usuarios disponibles</h3>

                </div>
            @endforelse


        </div>
    </div>

    <div class="chat-messages">
        @if(isset($chatActivo))
            <div class="chat-header">
                @php
                    $usuarioChat = $chatActivo->id_usuario_1 === auth()->id() ? $chatActivo->usuario2 : $chatActivo->usuario1;
                    $fotoPerfil = $usuarioChat->fotoperfil
                        ? asset('storage/' . $usuarioChat->fotoperfil)
                        : asset('images/fotodeperfil.webp');
                @endphp

  <div>
    <span class="back-button" aria-label="Volver" role="button">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1E4183" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"></polyline>
        </svg>
    </span>
    <img src="{{ $fotoPerfil }}" alt="Foto Perfil" />

    <div>
        <a href="{{ route('users.perfil', $usuarioChat->id) }}" style="text-decoration: none; color: black;">
            {{ $usuarioChat->name }}
        </a>


    </div>

                </div>
                <div class="theme-wrapper">
                    <div class="theme-selector" tabindex="0" aria-label="Selector de tema">
                        Tema
                        <span class="arrow-down"></span>

                        <div class="theme-dropdown">
                            <label for="color-recibido">
                                Recibido
                                <input type="color" id="color-recibido" title="Color mensaje recibido" />
                            </label>
                            <label for="color-enviado">
                                Enviado
                                <input type="color" id="color-enviado" title="Color mensaje enviado" />
                            </label>
                        </div>
                    </div>
                </div>
            </div>


            <div class="messages-box" id="chat-box">
                @php
                    $lastDate = null;
                @endphp

                @foreach($mensajes as $mensaje)
                    @php
                        $esMio = $mensaje->usuario->id === auth()->id();
                        $claseWrapper = $esMio ? 'sent-message-wrapper' : 'received-message-wrapper';
                        $claseMensaje = $esMio ? 'sent-message' : 'received-message';
                        $foto = $mensaje->usuario->fotoperfil
                            ? asset('storage/' . $mensaje->usuario->fotoperfil)
                            : asset('images/fotodeperfil.webp');
                        $fechaMensaje = $mensaje->created_at->format('Y-m-d');
                    @endphp

                    @if ($lastDate !== $fechaMensaje)
                        <div style="text-align: center; margin: 20px 0;">
                            <span style="background-color: #ddd; color: #444; padding: 6px 16px; border-radius: 20px; font-size: 14px;">
                                {{ \Carbon\Carbon::parse($fechaMensaje)->translatedFormat('l, d \d\e F Y') }}
                            </span>
                        </div>
                        @php $lastDate = $fechaMensaje; @endphp
                    @endif

                    <div class="message-wrapper {{ $claseWrapper }}">
                        @if(!$esMio)
                            <img src="{{ $foto }}" class="message-photo" alt="Foto perfil" />
                        @endif
                            <div class="{{ $claseMensaje }} message-content-wrapper" data-id="{{ $mensaje->id }}">
                                @if ($mensaje->imagen)
                                    <img src="{{ asset('storage/' . $mensaje->imagen) }}" alt="Imagen enviada" style="max-width: 200px; max-height: 200px; border-radius: 10px;" />
                                @endif

                                @if (esSoloEmojiNoNumeros($mensaje->texto))
                                    <span class="emoji-large">{!! $mensaje->texto !!}</span>
                                @else
                                        <span class="message-text">{!! $mensaje->texto !!}</span>
                                @endif
                                <small class="message-small">{{ $mensaje->created_at->format('H:i') }}</small>


                            </div>


                    </div>
                @endforeach
            </div>

            <form id="mensaje-form" method="POST" action="{{ route('mensajes.store', $chatActivo->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="chat-input">
                    <div id="preview-container" style="text-align: center; margin-bottom: 8px; max-height: 120px; overflow: hidden;">
                    </div>
                    <div class="input-group">
                        <input
                            type="text"
                            name="texto"
                            id="texto"
                            class="form-control"
                            placeholder="Escribe tu mensaje..."
                            value="{{ old('texto', $mensajePredefinido ?? '') }}"
                            autocomplete="off"
                            maxlength="1000"
                        />

                        <label for="imagen" class="btn" title="Adjuntar imagen">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                                <circle cx="8.5" cy="8.5" r="1.5" />
                                <path d="M21 15l-5-5L5 21" />
                            </svg>
                        </label>
                        <input type="file" name="imagen" id="imagen" accept="image/*" style="display: none;" />
                        <button type="button" id="emoji-button" class="btn">😊</button>
                        <button class="btn" type="submit">➤</button>
                    </div>

                    <div id="emoji-picker" style="display:none;">
                        <button type="button" class="emoji" data-emoji="😸">😸</button>
                        <button type="button" class="emoji" data-emoji="😻">😻</button>
                        <button type="button" class="emoji" data-emoji="😹">😹</button>
                        <button type="button" class="emoji" data-emoji="😾">😾</button>
                    </div>
                </div>
            </form>

        @else
            <div class="d-flex align-items-center justify-content-center flex-grow-1 text-muted">
                <div class="empty-chat-message">
                    <div class="emoji-placeholder">
                        <img src="{{ asset('images/vacio.svg') }}" alt="No hay chat activo" class="mx-auto d-block mt-2" style="width: 150px; opacity: 0.7;" />
                    </div>
                    <h3 class="empty-chat-title">¡No hay chat activo!</h3>
                    <p class="empty-chat-description">Selecciona un usuario de la lista para comenzar a chatear.</p>
                </div>
            </div>
        @endif
    </div>
</div>


<div id="galeria-modal" class="galeria-overlay">
    <div class="galeria-content">
        <span class="cerrar-galeria">✖</span>

        <button class="galeria-prev" aria-label="Anterior">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#fff" viewBox="0 0 24 24">
                <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
            </svg>
        </button>

        <img id="galeria-imagen" src="" alt="Imagen del chat principal">

        <button class="galeria-next" aria-label="Siguiente">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#fff" viewBox="0 0 24 24">
                <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6z"/>
            </svg>
        </button>

        <div class="galeria-miniaturas" id="miniaturas-container">
        </div>
    </div>
</div>


<script>
    window.chatConfig = {
        chatActivoId: {{ $chatActivo ? $chatActivo->id : 'null' }},
        authId: {{ auth()->id() }},
        ultimoMensajeTimestamp: {!! isset($mensajes) && count($mensajes) > 0 ? json_encode($mensajes->last()->created_at->toDateTimeString()) : 'null' !!}
    };
</script>

<script src="{{ asset('js/chat.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputMensaje = document.getElementById('texto');
        if (inputMensaje) {
            inputMensaje.focus();
            inputMensaje.selectionStart = inputMensaje.selectionEnd = inputMensaje.value.length;
        }

        const chatBox = document.getElementById('chat-box');
        if (!chatBox) return;

        const images = chatBox.querySelectorAll('img');
        if (images.length === 0) {
            chatBox.scrollTop = chatBox.scrollHeight;
            return;
        }

        let loaded = 0;
        const tryScroll = () => {
            loaded++;
            if (loaded === images.length) {
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        };

        images.forEach(img => {
            if (img.complete) {
                tryScroll();
            } else {
                img.addEventListener('load', tryScroll);
                img.addEventListener('error', tryScroll);
            }
        });
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>

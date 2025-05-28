<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Petchat</title>
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}" />
</head>
<body>
@include('MenuPrincipal.Navbar')
<div class="chat-container">
    <div class="chat-list">
        <div class="search-box">
            <input type="text" class="form-control" placeholder="Buscar usuario..." id="buscador" />
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
                        <strong>{{ $usuario->name }}</strong>
                        <small>
                            @if($ultimoMensaje)
                                <span class="{{ $item['mensajes_no_leidos'] > 0 ? 'ultimo-mensaje-no-leido' : '' }}">
                                     {{ Str::limit($ultimoMensaje->texto, 30) }}
                                </span><br>
                            @else
                                Empieza una conversación
                            @endif
                        </small>
                    </div>

                    @if($item['mensajes_no_leidos'] > 0)
                        <span class="unread-badge">{{ $item['mensajes_no_leidos'] }}</span>
                    @endif
                </a>
            @empty
                <p class="p-3 text-muted">No hay otros usuarios.</p>
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

                <img src="{{ $fotoPerfil }}" alt="Foto Perfil" />
                <div>{{ $chatActivo->id_usuario_1 === auth()->id() ? $chatActivo->usuario2->name : $chatActivo->usuario1->name }}</div>
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

                        <div class="{{ $claseMensaje }}">
                            {{ $mensaje->texto }}
                            <small class="message-small">{{ $mensaje->created_at->format('H:i') }}</small>
                        </div>
                    </div>
                @endforeach
            </div>

            <form id="mensaje-form" method="POST" action="{{ route('mensajes.store', $chatActivo->id) }}">
                @csrf
                <div class="chat-input">
                    <div class="input-group">
                        <input
                            type="text"
                            name="texto"
                            id="texto"
                            class="form-control"
                            placeholder="Escribe tu mensaje..."
                            value="{{ old('texto', $mensajePredefinido ?? '') }}"
                            required
                        />
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
    });
</script>


</body>
</html>

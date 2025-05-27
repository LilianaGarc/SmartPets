<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
</head>
<body>
@include('MenuPrincipal.Navbar')
<div class="chat-container">
    <div class="chat-list">
        <div class="search-box">
            <input type="text" class="form-control" placeholder="Buscar usuario..." id="buscador">
        </div>

        @forelse($usuariosConMensajes as $item)
            @php
                $usuario = $item['usuario'];
                $chat = $item['chat'];
                $ultimoMensaje = $item['ultimo_mensaje'];
            @endphp

            <a href="{{ route('chats.iniciar', $usuario->id) }}" class="chat-user">
                <img src="{{ $usuario->fotoperfil ? asset('storage/' . $usuario->fotoperfil) : 'https://via.placeholder.com/45' }}" alt="Foto">
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

    <div class="chat-messages">
        @if(isset($chatActivo))
            <div class="chat-header">
                <img src="{{ $chatActivo->id_usuario_1 === auth()->id() ? $chatActivo->usuario2->fotoperfil : $chatActivo->usuario1->fotoperfil }}" alt="Foto Perfil">
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
                        $foto = $mensaje->usuario->fotoperfil ? asset('storage/' . $mensaje->usuario->fotoperfil) : 'https://via.placeholder.com/45';
                        $fechaMensaje = $mensaje->created_at->format('Y-m-d');
                    @endphp

                    {{-- Mostrar divisor de fecha si cambia el día --}}
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
                            <img src="{{ $foto }}" class="message-photo" alt="Foto perfil">
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
                        <input type="text" name="texto" id="texto" class="form-control" placeholder="Escribe tu mensaje..." required>
                        <button type="button" id="emoji-button" class="btn">😊</button>
                        <button class="btn" type="submit">➤</button>
                    </div>

                    <div id="emoji-picker">
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
                        <img src="{{ asset('images/vacio.svg') }}" alt="No hay chat activo"
                             class="mx-auto d-block mt-2" style="width: 150px; opacity: 0.7;">
                    </div>
                    <h3 class="empty-chat-title">¡No hay chat activo!</h3>
                    <p class="empty-chat-description">Selecciona un usuario de la lista para comenzar a chatear.</p>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    // Filtro por nombre de usuario
    document.getElementById('buscador').addEventListener('input', function () {
        const query = this.value.toLowerCase();
        document.querySelectorAll('.chat-user').forEach(function (el) {
            const nombre = el.textContent.toLowerCase();
            el.style.display = nombre.includes(query) ? '' : 'none';
        });
    });

    // Mostrar y ocultar el selector de emojis
    document.getElementById('emoji-button').addEventListener('click', function () {
        let emojiPicker = document.getElementById('emoji-picker');
        emojiPicker.style.display = emojiPicker.style.display === 'none' || emojiPicker.style.display === '' ? 'block' : 'none';
    });

    // Insertar el emoji en el campo de texto
    document.querySelectorAll('.emoji').forEach(function (emojiButton) {
        emojiButton.addEventListener('click', function () {
            let emoji = emojiButton.getAttribute('data-emoji');
            let textoInput = document.getElementById('texto');
            textoInput.value += emoji; // Agrega el emoji al final del mensaje
            textoInput.focus(); // Regresa al campo de texto
            document.getElementById('emoji-picker').style.display = 'none'; // Oculta el selector después de seleccionar un emoji
        });
    });

    let lastSenderId = null; // Variable para almacenar el último usuario que envió un mensaje

    // Enviar mensaje usando fetch
    document.getElementById('mensaje-form').addEventListener('submit', function (e) {
        e.preventDefault();

        let texto = document.getElementById('texto').value;
        let token = document.querySelector('input[name="_token"]').value;
        let action = this.getAttribute('action');

        fetch(action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({ texto: texto })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let chatBox = document.getElementById('chat-box');

                    // Usar el tiempo exacto desde el backend
                    let fecha = new Date(data.mensaje.created_at); // Asegúrate de que el backend envíe el created_at
                    let hora = fecha.getHours() + ":" + fecha.getMinutes();

                    // Determinar si se debe mostrar la foto
                    let showPhoto = lastSenderId !== data.mensaje.usuario.id; // Mostrar foto si el usuario es diferente al último que envió

                    let nuevoMensaje = `
                    <div class="message-wrapper sent-message-wrapper">
                        <div class="sent-message">
                            ${data.mensaje.texto}
                            <small class="message-small">${hora}</small>
                        </div>
                    </div>
`;



                    // Actualizar el último usuario que envió un mensaje
                    lastSenderId = data.mensaje.usuario.id;

                    // Añadir el nuevo mensaje al chat
                    chatBox.innerHTML += nuevoMensaje;

                    // Limpiar el campo de entrada de texto
                    document.getElementById('texto').value = '';

                    // Desplazar automáticamente al último mensaje
                    chatBox.scrollTop = chatBox.scrollHeight;
                }
            })
            .catch(error => {
                console.error('Error al enviar el mensaje:', error);
            });
    });

    // Desplazarse al final del chat automáticamente cuando se carga
    document.addEventListener('DOMContentLoaded', function () {
        const chatBox = document.getElementById('chat-box');

        // Desplazarse al final del chat automáticamente
        if (chatBox) {
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    });


</script>



</body>
</html>

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
                        <input type="text" name="texto" id="texto" class="form-control" placeholder="Escribe tu mensaje..." required />
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
    document.getElementById('buscador').addEventListener('input', function () {
        const query = this.value.toLowerCase();
        document.querySelectorAll('.chat-user').forEach(function (el) {
            const nombre = el.textContent.toLowerCase();
            el.style.display = nombre.includes(query) ? '' : 'none';
        });
    });

    document.getElementById('emoji-button').addEventListener('click', function () {
        let emojiPicker = document.getElementById('emoji-picker');
        emojiPicker.style.display = emojiPicker.style.display === 'none' || emojiPicker.style.display === '' ? 'block' : 'none';
    });

    document.querySelectorAll('.emoji').forEach(function (emojiButton) {
        emojiButton.addEventListener('click', function () {
            let emoji = emojiButton.getAttribute('data-emoji');
            let textoInput = document.getElementById('texto');
            textoInput.value += emoji;
            textoInput.focus();
            document.getElementById('emoji-picker').style.display = 'none';
        });
    });

    let lastSenderId = null;

    document.getElementById('mensaje-form')?.addEventListener('submit', function (e) {
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

                    let fecha = new Date(data.mensaje.created_at);
                    let hora = fecha.getHours().toString().padStart(2, '0') + ":" + fecha.getMinutes().toString().padStart(2, '0');

                    let nuevoMensaje = `
                    <div class="message-wrapper sent-message-wrapper">
                        <div class="sent-message">
                            ${data.mensaje.texto}
                            <small class="message-small">${hora}</small>
                        </div>
                    </div>
                `;

                    chatBox.innerHTML += nuevoMensaje;
                    lastSenderId = data.mensaje.usuario.id;
                    ultimoMensajeTimestamp = data.mensaje.created_at;

                    document.getElementById('texto').value = '';
                    chatBox.scrollTop = chatBox.scrollHeight;
                }
            })
            .catch(error => {
                console.error('Error al enviar el mensaje:', error);
            });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const chatBox = document.getElementById('chat-box');
        if (chatBox) {
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    });

    let chatActivoId = {{ $chatActivo ? $chatActivo->id : 'null' }};
    let ultimoMensajeTimestamp = null;

    @if(isset($chatActivo) && count($mensajes) > 0)
        ultimoMensajeTimestamp = '{{ $mensajes->last()->created_at->toDateTimeString() }}';
    @endif

    function actualizarMensajesNuevos() {
        if (!chatActivoId) return;

        fetch(`/chats/${chatActivoId}/mensajes/nuevos?ultimo_timestamp=${ultimoMensajeTimestamp}`)
            .then(res => res.json())
            .then(data => {
                if (data.mensajes.length > 0) {
                    const chatBox = document.getElementById('chat-box');

                    data.mensajes.forEach(mensaje => {
                        const esMio = mensaje.usuario.id === {{ auth()->id() }};
                        const claseWrapper = esMio ? 'sent-message-wrapper' : 'received-message-wrapper';
                        const claseMensaje = esMio ? 'sent-message' : 'received-message';

                        const divWrapper = document.createElement('div');
                        divWrapper.className = `message-wrapper ${claseWrapper}`;

                        if (!esMio) {
                            const img = document.createElement('img');
                            img.src = mensaje.usuario.fotoperfil ? `/storage/${mensaje.usuario.fotoperfil}` : '/images/fotodeperfil.webp';
                            img.className = 'message-photo';
                            img.alt = 'Foto perfil';
                            divWrapper.appendChild(img);
                        }

                        const divMensaje = document.createElement('div');
                        divMensaje.className = claseMensaje;
                        divMensaje.textContent = mensaje.texto;

                        const small = document.createElement('small');
                        let fechaMsg = new Date(mensaje.created_at);
                        let hora = fechaMsg.getHours().toString().padStart(2, '0') + ":" + fechaMsg.getMinutes().toString().padStart(2, '0');
                        small.className = 'message-small';
                        small.textContent = hora;
                        divMensaje.appendChild(small);

                        divWrapper.appendChild(divMensaje);
                        chatBox.appendChild(divWrapper);

                        ultimoMensajeTimestamp = mensaje.created_at;
                    });

                    chatBox.scrollTop = chatBox.scrollHeight;
                }
            })
            .catch(console.error);
    }

    let usuariosListaCache = '';

    function actualizarUsuariosConMensajes() {
        fetch('/usuarios-con-mensajes')
            .then(res => res.json())
            .then(data => {
                const lista = document.getElementById('usuarios-lista');
                const buscador = document.getElementById('buscador');
                const filtro = buscador.value.toLowerCase();

                let html = '';

                if (data.usuariosConMensajes.length === 0) {
                    html += `<p class="p-3 text-muted">No hay otros usuarios.</p>`;
                } else {
                    data.usuariosConMensajes.forEach(item => {
                        const usuario = item.usuario;
                        const ultimoMensaje = item.ultimo_mensaje;
                        const mensajesNoLeidos = item.mensajes_no_leidos;

                        if (!usuario.name.toLowerCase().includes(filtro)) return;

                        html += `
                        <a href="/chats/iniciar/${usuario.id}" class="chat-user">
                        <img src="${usuario.fotoperfil ? '/storage/' + usuario.fotoperfil : '/images/fotodeperfil.webp'}" alt="Foto" />
                            <div class="user-details">
                                <strong>${usuario.name}</strong>
                                <small>
                                    ${ultimoMensaje ? `<span class="${mensajesNoLeidos > 0 ? 'ultimo-mensaje-no-leido' : ''}">${ultimoMensaje.texto.length > 30 ? ultimoMensaje.texto.substring(0, 30) + '...' : ultimoMensaje.texto}</span><br>` : 'Empieza una conversación'}
                                </small>
                            </div>
                            ${mensajesNoLeidos > 0 ? `<span class="unread-badge">${mensajesNoLeidos}</span>` : ''}
                        </a>
                        `;
                    });
                }

                if (html !== usuariosListaCache) {
                    lista.innerHTML = html;
                    usuariosListaCache = html;
                }
            })
            .catch(console.error);
    }

    setInterval(() => {
        actualizarMensajesNuevos();
        actualizarUsuariosConMensajes();
    }, 1000);
</script>


</body>
</html>

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
        enviarMensaje(emoji);
        document.getElementById('emoji-picker').style.display = 'none';
    });
});

function enviarMensaje(texto) {
    let token = document.querySelector('input[name="_token"]').value;
    let action = document.getElementById('mensaje-form').getAttribute('action');

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
                agregarMensajeAlChat(data.mensaje);
                document.getElementById('texto').value = '';
                document.getElementById('texto').focus();
            }
        })
        .catch(error => {
            console.error('Error al enviar el mensaje:', error);
        });
}

document.getElementById('mensaje-form')?.addEventListener('submit', function (e) {
    e.preventDefault();
    const texto = document.getElementById('texto').value;
    enviarMensaje(texto);
});

function esSoloEmoji(texto) {
    const soloNumeros = /^[0-9]+$/.test(texto);
    if (soloNumeros) return false;
    return /^\p{Emoji}+$/u.test(texto);
}

function esSoloNumeros(texto) {
    return /^\d+$/.test(texto);
}

function esSoloEmojiNoNumeros(texto) {
    return !esSoloNumeros(texto) && /^\p{Emoji}+$/u.test(texto);
}

function agregarMensajeAlChat(mensaje) {
    const chatBox = document.getElementById('chat-box');
    const esMio = mensaje.usuario.id === authId;
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

    if (esSoloEmojiNoNumeros(mensaje.texto)) {
        divMensaje.innerHTML = `<span class="emoji-large">${mensaje.texto}</span>`;
    } else {
        divMensaje.textContent = mensaje.texto;
    }

    const small = document.createElement('small');
    let fechaMsg = new Date(mensaje.created_at);
    let hora = fechaMsg.getHours().toString().padStart(2, '0') + ":" + fechaMsg.getMinutes().toString().padStart(2, '0');
    small.className = 'message-small';
    small.textContent = hora;

    divMensaje.appendChild(small);
    divWrapper.appendChild(divMensaje);
    chatBox.appendChild(divWrapper);

    chatBox.scrollTop = chatBox.scrollHeight;
    ultimoMensajeTimestamp = mensaje.created_at;
}

document.addEventListener('DOMContentLoaded', function () {
    const chatBox = document.getElementById('chat-box');
    if (chatBox) {
        chatBox.scrollTop = chatBox.scrollHeight;

        const mensajes = chatBox.querySelectorAll('.sent-message, .received-message');
        mensajes.forEach(divMensaje => {
            let texto = divMensaje.textContent.trim();
            texto = texto.replace(/\s+/g, '');
            if (texto.length > 0 && esSoloEmojiNoNumeros(texto)) {
                divMensaje.innerHTML = `<span class="emoji-large">${texto}</span>`;
            }
        });
    }
});

let chatActivoId = window.chatConfig.chatActivoId;
let authId = window.chatConfig.authId;
let ultimoMensajeTimestamp = window.chatConfig.ultimoMensajeTimestamp || null;

function actualizarMensajesNuevos() {
    if (!chatActivoId) return;

    fetch(`/chats/${chatActivoId}/mensajes/nuevos?ultimo_timestamp=${ultimoMensajeTimestamp}`)
        .then(res => res.json())
        .then(data => {
            if (data.mensajes.length > 0) {
                data.mensajes.forEach(mensaje => {
                    agregarMensajeAlChat(mensaje);
                });
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

function getTextColor(backgroundColor) {
    const r = parseInt(backgroundColor.substring(1, 3), 16) / 255;
    const g = parseInt(backgroundColor.substring(3, 5), 16) / 255;
    const b = parseInt(backgroundColor.substring(5, 7), 16) / 255;
    const luminance = 0.299 * r + 0.587 * g + 0.114 * b;
    return luminance > 0.5 ? '#000000' : '#ffffff';
}

function aplicarTema(enviado, recibido) {
    const root = document.documentElement;
    root.style.setProperty('--bubble-sent-bg', enviado);
    root.style.setProperty('--bubble-sent-text-color', getTextColor(enviado));
    root.style.setProperty('--bubble-received-bg', recibido);
    root.style.setProperty('--bubble-received-text-color', getTextColor(recibido));
    root.style.setProperty('--circle-emoji-bg', enviado);
    root.style.setProperty('--send-button-bg', enviado);
}

document.addEventListener('DOMContentLoaded', function () {
    const chatId = window.chatConfig?.chatActivoId;
    if (!chatId) return;

    const inputEnviado = document.getElementById('color-enviado');
    const inputRecibido = document.getElementById('color-recibido');
    if (!inputEnviado || !inputRecibido) return;

    const storageKey = `chatColorTema_${chatId}`;

    const defaultColors = {
        enviado: '#4469b6',
        recibido: '#e5e5ea',
    };

    const saved = localStorage.getItem(storageKey);
    let colors;

    try {
        colors = saved ? JSON.parse(saved) : defaultColors;
    } catch (e) {
        colors = defaultColors;
    }

    inputEnviado.value = colors.enviado;
    inputRecibido.value = colors.recibido;

    aplicarTema(colors.enviado, colors.recibido);

    function onChange() {
        const nuevoTema = {
            enviado: inputEnviado.value,
            recibido: inputRecibido.value,
        };
        localStorage.setItem(storageKey, JSON.stringify(nuevoTema));
        aplicarTema(nuevoTema.enviado, nuevoTema.recibido);
    }

    inputEnviado.addEventListener('input', onChange);
    inputRecibido.addEventListener('input', onChange);
});

document.addEventListener('DOMContentLoaded', function () {
    const isMobile = window.matchMedia('(max-width: 768px)').matches;

    if (isMobile) {
        const chatUsers = document.querySelectorAll('.chat-user');
        const backButton = document.querySelector('.back-button');

        chatUsers.forEach(user => {
            user.addEventListener('click', () => {
                document.body.classList.add('show-chat');
            });
        });

        if (backButton) {
            backButton.addEventListener('click', () => {
                document.body.classList.remove('show-chat');
            });
        }
    }
});

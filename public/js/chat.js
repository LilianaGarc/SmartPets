const mensajesMostrados = new Set();

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
    const form = document.getElementById('mensaje-form');
    const inputImagen = document.getElementById('imagen');
    const token = document.querySelector('input[name="_token"]').value;
    const action = form.getAttribute('action');

    let formData = new FormData();
    formData.append('texto', texto);
    if (inputImagen.files.length > 0) {
        formData.append('imagen', inputImagen.files[0]);
    }

    fetch(action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                agregarMensajeAlChat(data.mensaje);
                document.getElementById('texto').value = '';
                inputImagen.value = '';
                document.getElementById('texto').focus();
            } else {
                console.error('Error al enviar mensaje:', data.message);
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
    if (mensajesMostrados.has(mensaje.id)) return;
    mensajesMostrados.add(mensaje.id);

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
    divMensaje.className = claseMensaje + ' message-content-wrapper';
    divMensaje.setAttribute('data-id', mensaje.id);

    if (mensaje.imagen) {
        const imagenMensaje = document.createElement('img');
        imagenMensaje.src = `/storage/${mensaje.imagen}`;
        imagenMensaje.alt = 'Imagen enviada';
        imagenMensaje.style.maxWidth = '200px';
        imagenMensaje.style.display = 'block';
        imagenMensaje.style.marginBottom = '6px';
        divMensaje.appendChild(imagenMensaje);
    }

    if (mensaje.texto) {
        if (esSoloEmojiNoNumeros(mensaje.texto)) {
            const spanEmoji = document.createElement('span');
            spanEmoji.className = 'emoji-large';
            spanEmoji.textContent = mensaje.texto;
            divMensaje.appendChild(spanEmoji);
        } else {
            const spanTexto = document.createElement('span');
            spanTexto.className = 'message-text';
            spanTexto.textContent = mensaje.texto;
            divMensaje.appendChild(spanTexto);
        }
    }

    const small = document.createElement('small');
    let fechaMsg = new Date(mensaje.created_at);
    let hora = fechaMsg.getHours().toString().padStart(2, '0') + ":" + fechaMsg.getMinutes().toString().padStart(2, '0');
    small.className = 'message-small';
    small.textContent = hora;

    divMensaje.appendChild(small);

    if (esMio) {
        const dropdown = document.createElement('div');
        dropdown.className = 'message-dropdown';
        dropdown.style.display = 'none';

        const btnEditar = document.createElement('button');
        btnEditar.className = 'editar-mensaje';
        btnEditar.textContent = '✏️ Editar';
        btnEditar.dataset.id = mensaje.id;

        const btnEliminar = document.createElement('button');
        btnEliminar.className = 'eliminar-mensaje';
        btnEliminar.textContent = '🗑️ Eliminar';
        btnEliminar.dataset.id = mensaje.id;

        dropdown.appendChild(btnEditar);
        dropdown.appendChild(btnEliminar);
        divMensaje.appendChild(dropdown);
    }

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
            const idMensaje = divMensaje.getAttribute('data-id');
            if (idMensaje) mensajesMostrados.add(parseInt(idMensaje));

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
            <strong class="d-flex align-items-center gap-1">
                ${usuario.name}
                ${usuario.en_linea
                        ? `<span class="estado-dot online" title="En línea"></span>`
                        : `<span class="estado-dot offline" title="Desconectado"></span>`}
            </strong>
            <small>
                ${ultimoMensaje
                        ? `<span class="${mensajesNoLeidos > 0 ? 'ultimo-mensaje-no-leido' : ''}">
                        ${ultimoMensaje.imagen && (!ultimoMensaje.texto || ultimoMensaje.texto.trim() === '')
                            ? 'Foto'
                            : (ultimoMensaje.texto.length > 30 ? ultimoMensaje.texto.substring(0, 30) + '...' : ultimoMensaje.texto)}
                    </span><br>`
                        : 'Empieza una conversación'}
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
}, 3000);

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

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.message-content-wrapper').forEach(function (wrapper) {
        wrapper.addEventListener('click', function (e) {
            document.querySelectorAll('.message-dropdown').forEach(menu => menu.style.display = 'none');

            const dropdown = wrapper.querySelector('.message-dropdown');
            if (dropdown) {
                dropdown.style.display = 'block';
                e.stopPropagation();
            }
        });
    });

    document.addEventListener('click', function () {
        document.querySelectorAll('.message-dropdown').forEach(menu => menu.style.display = 'none');
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const inputImagen = document.getElementById('imagen');
    const previewContainer = document.getElementById('preview-container');
    const formMensaje = document.getElementById('mensaje-form');

    if (inputImagen && previewContainer) {
        inputImagen.addEventListener('change', function () {
            previewContainer.innerHTML = '';

            const file = this.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = 'Vista previa de imagen';
                    img.title = 'Click para eliminar';

                    img.addEventListener('click', () => {
                        previewContainer.innerHTML = '';
                        inputImagen.value = '';
                    });

                    previewContainer.appendChild(img);
                };

                reader.readAsDataURL(file);
            }
        });
    }

    if (formMensaje && previewContainer && inputImagen) {
        formMensaje.addEventListener('submit', function () {
            previewContainer.innerHTML = '';
            inputImagen.value = '';
        });
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('galeria-modal');
    const imgViewer = document.getElementById('galeria-imagen');
    const cerrarBtn = document.querySelector('.cerrar-galeria');
    const prevBtn = document.querySelector('.galeria-prev');
    const nextBtn = document.querySelector('.galeria-next');
    const miniaturasContainer = document.getElementById('miniaturas-container');

    let imagenes = [];
    let indiceActual = 0;

    const imagenesEnChat = Array.from(document.querySelectorAll('.messages-box img'))
        .filter(img => img.src.includes('/storage/'));

    imagenes = imagenesEnChat.map(img => img.src);

    function renderMiniaturas() {
        miniaturasContainer.innerHTML = '';
        imagenes.forEach((src, i) => {
            const thumb = document.createElement('img');
            thumb.src = src;
            thumb.classList.add('miniatura');
            if (i === indiceActual) thumb.classList.add('active');
            thumb.addEventListener('click', () => {
                indiceActual = i;
                mostrarImagen(indiceActual);
            });
            miniaturasContainer.appendChild(thumb);
        });
    }

    function mostrarImagen(index) {
        if (index >= 0 && index < imagenes.length) {
            imgViewer.src = imagenes[index];
            indiceActual = index;
            modal.style.display = 'flex';
            renderMiniaturas();
        }
    }

    imagenesEnChat.forEach((img, index) => {
        img.addEventListener('click', function (e) {
            e.preventDefault();
            mostrarImagen(index);
        });
    });

    prevBtn.addEventListener('click', () => {
        indiceActual = (indiceActual - 1 + imagenes.length) % imagenes.length;
        mostrarImagen(indiceActual);
    });

    nextBtn.addEventListener('click', () => {
        indiceActual = (indiceActual + 1) % imagenes.length;
        mostrarImagen(indiceActual);
    });

    cerrarBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    modal.addEventListener('click', (e) => {
        const clickedInsideImage = e.target.closest('#galeria-imagen') !== null;
        const clickedInsideMiniaturas = e.target.closest('#miniaturas-container') !== null;
        const clickedInsideFlechas = e.target.closest('.galeria-prev, .galeria-next') !== null;

        if (!clickedInsideImage && !clickedInsideMiniaturas && !clickedInsideFlechas) {
            modal.style.display = 'none';
        }
    });
});

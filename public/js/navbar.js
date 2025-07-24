document.addEventListener('DOMContentLoaded', () => {
    // 🍔 Menú hamburguesa
    const hamburger = document.getElementById('hamburger');
    const menu = document.getElementById('menu');

    if (hamburger && menu) {
        hamburger.addEventListener('click', () => {
            menu.classList.toggle('open');
            hamburger.classList.toggle('open');
        });
    }

    const toggle = document.getElementById('notificationToggle');
    const dropdown = document.getElementById('notificationDropdown');
    const countBadge = document.getElementById('notificationCount');

    if (toggle && dropdown) {
        toggle.addEventListener('click', () => {
            const isShown = dropdown.classList.toggle('show');
            toggle.setAttribute('aria-expanded', isShown);
            toggle.classList.toggle('active', isShown);
            dropdown.setAttribute('aria-hidden', !isShown);
        });

        document.addEventListener('click', (e) => {
            if (!toggle.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.remove('show');
                toggle.classList.remove('active');
                toggle.setAttribute('aria-expanded', false);
                dropdown.setAttribute('aria-hidden', true);
            }
        });
    }

    const clearBtn = document.getElementById('clearNotificationsBtn');
    const list = document.getElementById('notificationList');

    if (clearBtn && list) {
        clearBtn.addEventListener('click', function () {
            fetch(window.Laravel.borrarNotificacionesUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': window.Laravel.csrfToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        list.innerHTML = `
            <li style="padding: 10px; text-align: center; color: #555;">
                <p>No hay notificaciones nuevas</p>
                <img src="/images/vacio.svg" alt="No hay adopciones"
                     class="mx-auto d-block mt-2" style="width: 80px; opacity: 0.7;">
            </li>
        `;
                        if (countBadge) countBadge.remove();
                        clearBtn.remove();
                    }
                })
                .catch(err => {
                    console.error('Error al borrar notificaciones:', err);
                });
        });
    }

    const notificationLinks = document.querySelectorAll('#notificationList .notification-item a');

    notificationLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            const li = this.closest('.notification-item');
            const notificationId = li?.dataset.notificationId;

            if (!notificationId) return;

            fetch(`/notificaciones/marcar-vista/${notificationId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': window.Laravel.csrfToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success && countBadge) {
                        let count = parseInt(countBadge.textContent);
                        if (count > 1) {
                            countBadge.textContent = count - 1;
                        } else {
                            countBadge.remove();
                        }

                        li.classList.add('notificacion-leida');
                    }
                })
                .catch(err => {
                    console.error('Error al marcar como vista:', err);
                });
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const toggleConfigBtn = document.getElementById('toggleConfigBtn');
    const notificationList = document.getElementById('notificationList');
    const notificationConfig = document.getElementById('notificationConfig');
    const recibirSwitch = document.getElementById('recibirNotificacionesSwitch');

    toggleConfigBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        const configVisible = notificationConfig.style.display === 'block';
        if (configVisible) {
            notificationConfig.style.display = 'none';
            notificationList.style.display = 'block';
            toggleConfigBtn.innerHTML = '<i class="fas fa-cog"></i>';
        } else {
            notificationConfig.style.display = 'block';
            notificationList.style.display = 'none';
            toggleConfigBtn.innerHTML = '<i class="fas fa-times"></i>';
        }
    });

    recibirSwitch.addEventListener('change', function () {
        fetch(window.Laravel.configurarNotificacionesUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': window.Laravel.csrfToken
            },
            body: JSON.stringify({
                recibir_notificaciones: recibirSwitch.checked
            })
        })
            .then(res => res.json())
            .then(data => {
                console.log(data.message);
            })
            .catch(err => {
                console.error('Error al actualizar configuración', err);
            });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const sonidoSwitch = document.getElementById('sonidoMensajesSwitch');

    const sonidoActivo = localStorage.getItem('chatSonidoActivo');
    sonidoSwitch.checked = sonidoActivo !== 'false';

    sonidoSwitch.addEventListener('change', () => {
        localStorage.setItem('chatSonidoActivo', sonidoSwitch.checked);
    });
});

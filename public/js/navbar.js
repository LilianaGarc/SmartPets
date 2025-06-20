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
                        list.innerHTML = `<li><a href="#" style="padding: 10px; display: block;">No hay notificaciones nuevas</a></li>`;
                        if (countBadge) countBadge.remove();
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

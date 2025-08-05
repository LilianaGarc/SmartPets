document.addEventListener("DOMContentLoaded", () => {
    const leftPanel = document.querySelector(".left");

    const isMobile = window.innerWidth <= 600;

    if (isMobile) {
        leftPanel.style.width = '100%';
        leftPanel.style.padding = '16px';
        leftPanel.style.opacity = '1';
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    leftPanel.classList.add("active");
                }, 1500);

                observer.unobserve(leftPanel);
            }
        });
    }, { threshold: 0.9 });

    observer.observe(leftPanel);
});



document.addEventListener("DOMContentLoaded", () => {
    if(window.USER_AUTHENTICATED) {
        document.getElementById('iamigopet-section').style.display = 'block';
        actualizarCreditos();
    }
});

const maxPreguntas = 5;

function actualizarContadorUsos(preguntasRestantes) {
    const contador = document.querySelector('.usage-counter');
    if (!contador) return;

    contador.textContent = `${preguntasRestantes}/${maxPreguntas}`;

    const btn = document.getElementById('btnPreguntar');
    btn.disabled = (preguntasRestantes === 0);
}

async function hacerPreguntaIA() {
    if (!window.USER_AUTHENTICATED) {
        window.location.href = "/login";
        return;
    }

    const pregunta = document.getElementById('preguntaIA').value.trim();
    const respuestaDiv = document.getElementById('respuestaIA');
    const infoCreditosDiv = document.getElementById('infoCreditos');

    if (!pregunta) {
        respuestaDiv.innerHTML = "❌ Por favor, escribe una pregunta.";
        return;
    }

    respuestaDiv.innerHTML = "⏳ Pensando...";
    infoCreditosDiv.innerHTML = "";

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    try {
        const response = await fetch('/preguntar-ia', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ pregunta })
        });

        const data = await response.json();

        if (data.respuesta) {
            respuestaDiv.innerHTML = data.respuesta;
            if (typeof data.preguntas_restantes !== 'undefined') {
                infoCreditosDiv.innerHTML = `Preguntas restantes hoy: ${data.preguntas_restantes}`;
                actualizarContadorUsos(data.preguntas_restantes);
            }
        } else if (data.error) {
            respuestaDiv.innerHTML = "❌ " + data.error;
            if (data.error.includes('límite')) {
                actualizarContadorUsos(0);
            }
        }
    } catch (error) {
        console.error(error);
        respuestaDiv.innerHTML = "❌ Hubo un problema al obtener la respuesta. Inténtalo más tarde.";
    }
}

function formatearTiempo(segundos) {
    const horas = Math.floor(segundos / 3600);
    const minutos = Math.ceil((segundos % 3600) / 60);

    let partes = [];
    if (horas > 0) partes.push(`${horas}h`);
    partes.push(String(minutos).padStart(2, '0') + 'm');

    return partes.join(' ');
}


async function actualizarCreditos() {
    try {
        const response = await fetch('/preguntas-restantes');
        const data = await response.json();
        if(data.preguntas_restantes !== undefined) {
            actualizarContadorUsos(data.preguntas_restantes);

            if (data.tiempo_restante !== null && data.preguntas_restantes === 0) {
                const infoCreditos = document.getElementById('infoCreditos');
                infoCreditos.innerHTML = `🔄 Tus créditos se restablecen en: ${formatearTiempo(data.tiempo_restante)}`;

                iniciarCuentaRegresiva(data.tiempo_restante);
            }
        }
    } catch (error) {
        console.error('No se pudo obtener preguntas restantes', error);
    }
}

function iniciarCuentaRegresiva(segundos) {
    const infoCreditos = document.getElementById('infoCreditos');
    let tiempoRestante = segundos;

    infoCreditos.innerHTML = `
      <span style="font-weight:bold; color:#1e4183;">🔄 Tus créditos se restablecen en:</span>
      <span style="font-family: monospace; background:#f0f0f0; padding: 2px 6px; border-radius: 4px;">
        ${formatearTiempo(tiempoRestante)}
      </span>`;

    const interval = setInterval(() => {
        tiempoRestante -= 60;
        if (tiempoRestante <= 0) {
            clearInterval(interval);
            infoCreditos.innerHTML = "✅ Créditos restablecidos. Recarga la página.";
            actualizarCreditos();
        } else {
            infoCreditos.innerHTML = `
              <span style="font-weight:bold; color:#1e4183;">🔄 Tus créditos se restablecen en:</span>
              <span style="font-family: monospace; background:#f0f0f0; padding: 2px 6px; border-radius: 4px;">
                ${formatearTiempo(tiempoRestante)}
              </span>`;
        }
    }, 60000);
}

const textarea = document.getElementById('preguntaIA');
const contador = document.getElementById('contadorCaracteres');
const btnBorrar = document.getElementById('btnBorrar');
const maxChars = 200;

textarea.addEventListener('input', () => {
    const length = textarea.value.length;
    contador.textContent = `${length} / ${maxChars}`;
});

btnBorrar.addEventListener('click', () => {
    textarea.value = '';
    contador.textContent = `0 / ${maxChars}`;
    textarea.focus();
});

btnBorrar.addEventListener('mouseenter', () => {
    btnBorrar.style.color = '#1e4183';
});
btnBorrar.addEventListener('mouseleave', () => {
    btnBorrar.style.color = '#999';
});

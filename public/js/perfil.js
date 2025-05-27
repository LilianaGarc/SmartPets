    function cambiarTab(tabId) {
    document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('activo'));
    document.querySelectorAll('.grid').forEach(grid => grid.classList.remove('activo'));
    document.getElementById(tabId).classList.add('activo');
    const botones = document.querySelectorAll('.tab');
    botones.forEach(btn => {
    if (btn.getAttribute('onclick').includes(tabId)) {
    btn.classList.add('activo');
}
});
}

    document.addEventListener('DOMContentLoaded', function () {
    cambiarTab('adopciones');
});

    lucide.createIcons();


    function animarContadores() {
    const duracion = 1500;

    document.querySelectorAll('.contador-numero').forEach(contador => {
    const valorFinal = parseInt(contador.getAttribute('data-numero'), 10);
    const inicio = performance.now();

    function actualizar(timestamp) {
    const progreso = timestamp - inicio;
    const porcentaje = Math.min(progreso / duracion, 1);
    const valorActual = Math.floor(porcentaje * valorFinal);

    contador.textContent = valorActual;

    if (progreso < duracion) {
    requestAnimationFrame(actualizar);
} else {
    contador.textContent = valorFinal;
}
}

    requestAnimationFrame(actualizar);
});
}

    document.addEventListener('DOMContentLoaded', function () {
    cambiarTab('adopciones');
    animarContadores();
});

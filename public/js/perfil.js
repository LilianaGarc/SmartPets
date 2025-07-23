    function cambiarTab(tabId) {
    document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('activo'));
    document.querySelectorAll('.grid').forEach(grid => grid.classList.remove('activo'));
    document.getElementById(tabId).classList.add('activo');

    document.querySelectorAll('.tab').forEach(btn => {
        if (btn.getAttribute('onclick').includes(tabId)) {
            btn.classList.add('activo');
        }
    });


        const cabecera = document.getElementById('cabecera-usuario');
        const marcador = document.querySelector('.marcador');
    if (tabId === 'petshop') {
        marcador.style.display = 'block';
        cargarProductosUsuario();
    }else{
        marcador.style.display = 'none';
    }

    /*const botones = document.querySelectorAll('.tab');
    botones.forEach(btn => {
    if (btn.getAttribute('onclick').includes(tabId)) {
    btn.classList.add('activo');
}

});*/
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

function cargarProductosUsuario() {
    const contenedor = document.getElementById('petshop');
    contenedor.innerHTML = '<p>Cargando...</p>';

    fetch('/mis-productos')
        .then(response => response.json())
        .then(data => {
            if (data.length === 0) {
                contenedor.innerHTML = '<p>No tienes productos en tu tienda.</p>';
            } else {
                contenedor.innerHTML = '';
                data.forEach(producto => {
                    const card = document.createElement('div');
                    card.classList.add('card');
                    card.innerHTML = `
                    <a href="/producto/${producto.id}">
                        <img src="/storage/${producto.imagen}" alt="${producto.nombre}">
                    </a>
                    <div class="overlay-info">
                        <h3>${producto.nombre}</h3>
                        <p>Precio: $${producto.precio}</p>
                        <p>Stock: ${producto.stock}</p>
                    </div>
                    `;
                    contenedor.appendChild(card);
                });
            }

        })
        .catch(error => {
            contenedor.innerHTML = '<p>Error al cargar los productos.</p>';
        });
}


document.addEventListener('DOMContentLoaded', function () {
    const checkboxes = document.querySelectorAll('.checkbox-eliminar');
    const inputNuevas = document.querySelector('input[name="imagenes_secundarias[]"]');
    const infoCupo = document.getElementById('info-cupo');
    const totalExistentes = parseInt(document.getElementById('total-imagenes-secundarias').textContent, 10);
    const maxTotal = 4;

    function calcularCupoDisponible() {
        const marcadasParaEliminar = document.querySelectorAll('.checkbox-eliminar:checked').length;
        return maxTotal - (totalExistentes - marcadasParaEliminar);
    }

    function actualizarCupo() {
        const disponibles = calcularCupoDisponible();

        if (disponibles <= 0) {
            infoCupo.textContent = `No puedes agregar más imágenes hasta eliminar algunas.`;
            infoCupo.style.color = 'red';
            inputNuevas.disabled = true;
        } else {
            infoCupo.textContent = `Puedes agregar hasta ${disponibles} imagen(es).`;
            infoCupo.style.color = 'green';
            inputNuevas.disabled = false;
        }
    }

    checkboxes.forEach(cb => {
        cb.addEventListener('change', function () {
            if (cb.checked) {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'Esta imagen será marcada para eliminar y no podrás deshacer esta acción.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const hidden = document.createElement('input');
                        hidden.type = 'hidden';
                        hidden.name = 'imagenes_secundarias_eliminar[]';
                        hidden.value = cb.value;
                        cb.parentNode.appendChild(hidden);

                        cb.checked = true;
                        cb.disabled = true;

                        cb.closest('.secondary-image-item').classList.add('imagen-marcada-para-eliminar');

                        actualizarCupo();
                    } else {
                        cb.checked = false;
                    }
                });
            }
        });
    });

    actualizarCupo();

    inputNuevas.addEventListener('change', function (event) {
        const previewContainer = document.getElementById('preview-nuevas-imagenes');
        previewContainer.innerHTML = '';

        const nuevas = event.target.files;
        const disponibles = calcularCupoDisponible();

        if (nuevas.length > disponibles) {
            Swal.fire({
                icon: 'warning',
                title: 'Límite excedido',
                text: `Puedes agregar solo ${disponibles} imagen(es).`,
                confirmButtonColor: '#ff7f50',
            });

            inputNuevas.value = '';
            previewContainer.innerHTML = '';
            return;
        }

        Array.from(nuevas).forEach(file => {
            if (!file.type.startsWith('image/')) return;

            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100px';
                img.style.height = 'auto';
                img.style.border = '1px solid #ccc';
                img.style.borderRadius = '4px';
                img.style.marginRight = '8px';
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });
});

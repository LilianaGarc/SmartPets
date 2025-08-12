document.addEventListener('DOMContentLoaded', function () {
    const checkboxes = document.querySelectorAll('.checkbox-eliminar');
    const inputNuevas = document.querySelector('input[name="imagenes_secundarias[]"]');
    const infoCupo = document.getElementById('info-cupo');

    function actualizarCupo() {
        const totalExistentes = JSON.parse(document.getElementById('total-imagenes-secundarias').textContent);

        let marcadasParaEliminar = 0;
        checkboxes.forEach(cb => {
            if (cb.checked) marcadasParaEliminar++;
        });
        const disponibles = 4 - (totalExistentes - marcadasParaEliminar);

        infoCupo.textContent = `Puedes agregar hasta ${disponibles} imagen(es) más.`;

        if (disponibles <= 0) {
            inputNuevas.disabled = true;
        } else {
            inputNuevas.disabled = false;
        }
    }

    checkboxes.forEach(cb => {
        cb.addEventListener('change', actualizarCupo);
    });

    actualizarCupo();
});

document.getElementById('imagenes_secundarias').addEventListener('change', function(event) {
    const previewContainer = document.getElementById('preview-nuevas-imagenes');
    previewContainer.innerHTML = '';

    const files = event.target.files;
    if (files.length > 0) {
        Array.from(files).forEach(file => {
            if (!file.type.startsWith('image/')) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100px';
                img.style.height = 'auto';
                img.style.border = '1px solid #ccc';
                img.style.borderRadius = '4px';
                previewContainer.appendChild(img);
            }
            reader.readAsDataURL(file);
        });
    }
});

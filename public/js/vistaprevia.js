function previewImage() {
    const file = document.getElementById('imagen_principal').files[0];
    const preview = document.getElementById('image-preview');
    const previewContainer = document.getElementById('image-preview-container');
    const reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
        previewContainer.style.display = 'block';
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "";
        previewContainer.style.display = 'none';
    }
}

document.getElementById('imagenes_secundarias').addEventListener('change', function () {
    const maxFiles = 4;
    const previewContainer = document.getElementById('secondary-preview-container');
    const imagesPreview = document.getElementById('secondary-images-preview');
    const files = this.files;

    // Validar la cantidad de archivos
    if (files.length > maxFiles) {
        Swal.fire({
            icon: 'warning',
            title: 'Límite excedido',
            text: 'Solo puedes subir un máximo de 4 imágenes adicionales.',
            confirmButtonColor: '#ff7f50',
        });

        this.value = '';
        previewContainer.style.display = 'none';
        imagesPreview.innerHTML = '';
        return;
    }

    imagesPreview.innerHTML = '';

    if (files.length > 0) {
        previewContainer.style.display = 'block';

        Array.from(files).forEach(file => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100px';
                    img.style.margin = '5px';
                    imagesPreview.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });
    } else {
        previewContainer.style.display = 'none';
    }
});




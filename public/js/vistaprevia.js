
function previewComprobante() {
    const file = document.getElementById('comprobante').files[0];
    const preview = document.getElementById('comprobante-preview');
    const reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "";
    }
}

function previewImage() {
    const file = document.getElementById('imagen').files[0];
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

function previewComprobante() {
    const file = document.getElementById('comprobante').files[0];
    const preview = document.getElementById('comprobante-preview');
    const container = document.getElementById('comprobante-preview-container');
    const reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
        container.style.display = 'block';
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "";
        container.style.display = 'none';
    }
}


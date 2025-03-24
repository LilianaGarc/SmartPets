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

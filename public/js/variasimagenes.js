function changeMainImage(imgElement) {
    var newSrc = imgElement.src;
    document.getElementById('mainImage').src = newSrc;
}

function openImageModal(imgElement) {
    var modal = document.getElementById("imageModal");
    var modalImage = document.getElementById("modalImage");

    modal.style.display = "block";
    modalImage.src = imgElement.src;
}

function closeModal() {
    document.getElementById("imageModal").style.display = "none";
}

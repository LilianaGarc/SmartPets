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

function changeMainImage(thumbnail) {
    const mainImage = document.querySelector('.adopcion-imgX');
    mainImage.src = thumbnail.src;

    const thumbnails = document.querySelectorAll('.imagen-secundariaX');
    thumbnails.forEach(img => img.classList.remove('active'));

    thumbnail.classList.add('active');

    if (window.innerWidth <= 600) {
        const offset = -250;
        const y = mainImage.getBoundingClientRect().top + window.pageYOffset + offset;
        window.scrollTo({ top: y, behavior: 'smooth' });
    }
}


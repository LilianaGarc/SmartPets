document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById("imageModal");
    var modalImg = document.getElementById("modalImage");
    var closeBtn = document.getElementsByClassName("close")[0];

    var images = document.querySelectorAll('.card-containerver .adopcion-img');

    function openImageModal() {
        modal.style.display = "block";
    }

    images.forEach(function (image) {
        image.addEventListener('click', function () {
            modal.style.display = "block";
            modalImg.src = image.src;
        });
    });

    closeBtn.onclick = function () {
        modal.style.display = "none";
    };

    window.onclick = function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    };
});

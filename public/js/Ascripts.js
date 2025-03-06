/* Modal imagen grande*/
document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById("imageModal");
    var modalImg = document.getElementById("modalImage");
    var closeBtn = document.getElementsByClassName("close")[0];

    var images = document.querySelectorAll('.adopcion-img');

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
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
});

document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.adopcion-card');

    cards.forEach((card, index) => {
        setTimeout(() => {
            card.classList.add('fade-in-up');
        }, index * 120);
    });
});


const reactionImgs = document.querySelectorAll('.reaction-img');

reactionImgs.forEach(img => {
    const originalSrc = img.src;

    img.addEventListener('mouseenter', function() {
        this.src = this.dataset.hover;
    });

    img.addEventListener('mouseleave', function() {
        this.src = originalSrc;
    });
});



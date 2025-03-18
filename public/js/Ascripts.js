

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



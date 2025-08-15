
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


function toggleOrden() {
    const ordenForm = document.getElementById('orden-form');
    const icon = document.getElementById('orden-icon');

    const style = window.getComputedStyle(ordenForm);
    const isHidden = style.display === 'none';

    ordenForm.style.display = isHidden ? 'block' : 'none';
    icon.classList.toggle('rotated', isHidden);
}

document.addEventListener('DOMContentLoaded', function () {
    const isAndroid = /Android/i.test(navigator.userAgent);
    const ordenForm = document.getElementById('orden-form');
    const toggleOrden = document.querySelector('.toggle-orden-dropdown');

    if (isAndroid) {
        ordenForm.style.display = 'block';

        if (toggleOrden) {
            toggleOrden.style.display = 'none';
        }
    }
});

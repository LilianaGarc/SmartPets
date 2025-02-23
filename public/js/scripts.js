/* jona: logica del carusel */
let currentIndex = 0;

const container = document.querySelector('.cuadrado-container');
const items = document.querySelectorAll('.cuadrado');
const totalItems = items.length;
const itemsVisible = 4;
const prevBtn = document.querySelector('.carousel-btn.prev');

function moveCarusel(direction) {
    const itemWidth = items[0].offsetWidth + parseFloat(getComputedStyle(items[0]).marginRight);

    if (direction === 'next') {
        currentIndex++;
        if (currentIndex > totalItems - itemsVisible) {
            currentIndex = 0;
        }
        prevBtn.style.display = 'block';
    } else if (direction === 'prev') {
        currentIndex--;
        if (currentIndex < 0) {
            currentIndex = totalItems - itemsVisible;
        }
    }

    const offset = -currentIndex * itemWidth;
    container.style.transform = `translateX(${offset}px)`;
}

/* jona: efecto del desenfoque de los demas cuadrados */
const cards = document.querySelectorAll('.cuadrado');
cards.forEach(card => {
    card.addEventListener('mouseenter', () => {
        cards.forEach(otherCard => {
            if (otherCard !== card) {
                otherCard.classList.add('not-hovered');
            }
        });
    });

    card.addEventListener('mouseleave', () => {
        cards.forEach(otherCard => {
            otherCard.classList.remove('not-hovered');
        });
    });
});




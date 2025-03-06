/* jona: logica del carusel */
let currentIndex = 0;

const container = document.querySelector('.cuadrado-container');
const items = document.querySelectorAll('.cuadrado');
const totalItems = items.length;
const itemsVisible = 4;
const prevBtn = document.querySelector('.carousel-btn.prev');
const nextBtn = document.querySelector('.carousel-btn.next');

function moveCarusel(direction) {
    const itemWidth = items[0].offsetWidth + parseFloat(getComputedStyle(items[0]).marginRight);

    if (direction === 'next') {
        if (currentIndex < totalItems - itemsVisible) {
            currentIndex++;
        }
    }
    else if (direction === 'prev') {
        if (currentIndex > 0) {
            currentIndex--;
        }
    }

    const offset = -currentIndex * itemWidth;
    container.style.transform = `translateX(${offset}px)`;

    if (currentIndex === 0) {
        prevBtn.style.display = 'none';
    } else {
        prevBtn.style.display = 'block';
    }

    if (currentIndex === totalItems - itemsVisible) {
        nextBtn.style.display = 'none';
    } else {
        nextBtn.style.display = 'block';
    }
}

moveCarusel();


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


/* parallax adopta y rescata*/
function onScroll() {
    const visionSection = document.querySelector('.vision');
    const misionSection = document.querySelector('.mision');

    const visionPosition = visionSection.getBoundingClientRect().top;
    const misionPosition = misionSection.getBoundingClientRect().top;

    if (visionPosition < window.innerHeight * 0.8) {
        visionSection.style.opacity = 1;
        visionSection.style.transform = 'translateY(0)';
    }

    if (misionPosition < window.innerHeight * 0.8) {
        misionSection.style.opacity = 1;
        misionSection.style.transform = 'translateY(0)';
    }
}

window.addEventListener('scroll', onScroll);

onScroll();

function setParallaxEffect() {
    let scrollPosition = window.pageYOffset;
    if (window.innerWidth > 768) {
        document.querySelector('.vision').style.backgroundPosition = `center ${scrollPosition * 0.5}px`;
        document.querySelector('.mision').style.backgroundPosition = `center ${scrollPosition * 0.5}px`;
    } else {
        document.querySelector('.vision').style.backgroundPosition = 'center top';
        document.querySelector('.mision').style.backgroundPosition = 'center top';
    }
}

window.addEventListener('scroll', setParallaxEffect);

setParallaxEffect();

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

/* Modal imagen grande*/
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById("imageModal");
    var modalImg = document.getElementById("modalImage");
    var closeBtn = document.getElementsByClassName("close")[0];

    var images = document.querySelectorAll('.adopcion-img');

    images.forEach(function(image) {
        image.addEventListener('click', function() {
            modal.style.display = "block";
            modalImg.src = image.src;
        });
    });

    closeBtn.onclick = function() {
        modal.style.display = "none";
    };

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
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

window.addEventListener('scroll', function() {
    let scrollPosition = window.pageYOffset;
    document.querySelector('.vision').style.backgroundPosition = `center ${scrollPosition * 0.5}px`;
    document.querySelector('.mision').style.backgroundPosition = `center ${scrollPosition * 0.5}px`;
});


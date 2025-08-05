
// jona: efecto del desenfoque de los demás cuadrados
const cards = document.querySelectorAll('.cuadrado');

function handleCardHover() {
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
}

if (window.innerWidth > 768) {
    handleCardHover();
}


function onScroll() {
    const visionSection = document.querySelector('.vision');
    const misionSection = document.querySelector('.mision');

    const visionPosition = visionSection.getBoundingClientRect().top;
    const misionPosition = misionSection.getBoundingClientRect().top;

    if (visionPosition < window.innerHeight * 0.8) {
        visionSection.style.opacity = 1;
        visionSection.style.transform = 'translateY(0)';
        document.querySelector('.vision h2').style.opacity = 1;
        document.querySelector('.vision h2').style.transform = 'translateY(0)';
        document.querySelector('.vision p').style.opacity = 1;
        document.querySelector('.vision p').style.transform = 'translateY(0)';
    }

    if (misionPosition < window.innerHeight * 0.8) {
        misionSection.style.opacity = 1;
        misionSection.style.transform = 'translateY(0)';
        document.querySelector('.mision h2').style.opacity = 1;
        document.querySelector('.mision h2').style.transform = 'translateY(0)';
        document.querySelector('.mision p').style.opacity = 1;
        document.querySelector('.mision p').style.transform = 'translateY(0)';
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




let currentIndex = 0;
const images = document.querySelectorAll('.image-item');
const dots = document.querySelectorAll('.dot');
const totalImages = images.length;

function changeImage() {
    const container = document.querySelector('.image-container');
    container.style.transform = `translateX(-${currentIndex * 33.3333}%)`;
    updateDots();
}

function updateDots() {
    dots.forEach(dot => dot.classList.remove('active'));
    dots[currentIndex].classList.add('active');
}

function goToImage(index) {
    currentIndex = index;
    changeImage();
}

dots.forEach(dot => {
    dot.addEventListener('click', (event) => {
        const index = event.target.getAttribute('data-index');
        goToImage(index);
    });
});

function checkScreenSize() {
    const screenWidth = window.innerWidth;

    if (screenWidth <= 768) {
        images.forEach((image, index) => {
            if (index !== 0) {
                image.style.display = 'none';
            } else {
                image.style.display = 'block';
            }
        });
        clearInterval(imageInterval);
    } else {
        images.forEach(image => {
            image.style.display = 'block';
        });
    }
}

let imageInterval;
checkScreenSize();

window.addEventListener('resize', checkScreenSize);

const revealElements = document.querySelectorAll('.reveal');

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('active');
        }
    });
}, { threshold: 0.15 });

revealElements.forEach(el => observer.observe(el));

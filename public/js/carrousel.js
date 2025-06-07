// carrousel --------------------------------------------------------------------------------------
const carousel = document.querySelector('.carousel');
const leftBtn = document.querySelector('.scroll-btn.left');
const rightBtn = document.querySelector('.scroll-btn.right');

if (carousel && leftBtn && rightBtn) {
    const slide = document.querySelector('.images-carousel > li');

    if (slide) {
        // Obtener ancho del slide
        const slideWidth = slide.offsetWidth;

        // Obtener gap entre slides (si usas gap en CSS)
        const carouselStyles = window.getComputedStyle(document.querySelector('.images-carousel'));
        const gap = parseInt(carouselStyles.getPropertyValue('gap')) || 0;

        // Calcular cuánto desplazarse (ancho slide + gap)
        const scrollAmount = slideWidth + gap;

        leftBtn.addEventListener('click', () => {
            carousel.scrollBy({
                left: -scrollAmount,
                behavior: 'smooth'
            });
        });

        rightBtn.addEventListener('click', () => {
            carousel.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        });
    }
}
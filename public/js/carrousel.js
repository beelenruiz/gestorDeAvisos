 // carrousel --------------------------------------------------------------------------------------
 const carousel = document.querySelector('.carousel');
 const leftBtn = document.querySelector('.scroll-btn.left');
 const rightBtn = document.querySelector('.scroll-btn.right');

 if (carousel && leftBtn && rightBtn) {
     leftBtn.addEventListener('click', () => {
         carousel.scrollBy({
             left: -950,
             behavior: 'smooth'
         });
     });

     rightBtn.addEventListener('click', () => {
         carousel.scrollBy({
             left: 950,
             behavior: 'smooth'
         });
     });
 }
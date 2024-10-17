document.addEventListener('DOMContentLoaded', (event) => {
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 1000,
        loop: true,
        centeredSlides: true,
        allowTouchMove: false,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

    function updateSlides() {
        const slides = document.querySelectorAll('.swiper-slide');
        const isSmallScreen = window.innerWidth <= 800;

        slides.forEach((slide) => {
            const image = slide.querySelector('.project-image-p1, .project-image-p2, .project-image-p3');
            const content = slide.querySelector('.project-content');

            if (slide.classList.contains('swiper-slide-active')) {
                image.style.width = isSmallScreen ? '10%' : '50%';
                content.style.opacity = '1';
            } else {
                image.style.width = '100%';
                content.style.opacity = '0'; 
            }
        });
    }

    updateSlides();

    swiper.on('slideChangeTransitionEnd', function () {
        updateSlides();
    });

    window.addEventListener('resize', updateSlides);
});

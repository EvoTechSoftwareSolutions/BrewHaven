const menu = document.querySelector('#mobile-menu');
const menuLinks = document.querySelector('.nav-links');

menu.addEventListener('click', function() {
    menu.classList.toggle('is-active');
    menuLinks.classList.toggle('active');
});

// Testimonials Slider Logic
document.addEventListener('DOMContentLoaded', function() {
    const track = document.querySelector('.testimonials-track');
    const slides = document.querySelectorAll('.testimonial-card');
    const dots = document.querySelectorAll('.dot');
    let currentSlide = 0;
    let sliderInterval;

    function updateSlider(index) {
        if (window.innerWidth <= 1024) {
            track.style.transform = `translateX(-${index * 100}%)`;
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });
            currentSlide = index;
        } else {
            track.style.transform = 'translateX(0)';
        }
    }

    function nextSlide() {
        let index = (currentSlide + 1) % slides.length;
        updateSlider(index);
    }

    function startSlider() {
        if (window.innerWidth <= 1024) {
            sliderInterval = setInterval(nextSlide, 5000);
        }
    }

    function stopSlider() {
        clearInterval(sliderInterval);
    }

    // Initialize dots click events
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            stopSlider();
            updateSlider(index);
            startSlider();
        });
    });

    // Pause on hover
    track.addEventListener('mouseenter', stopSlider);
    track.addEventListener('mouseleave', startSlider);

    // Initial start
    startSlider();

    // Handle window resize
    window.addEventListener('resize', () => {
        stopSlider();
        if (window.innerWidth > 1024) {
            track.style.transform = 'translateX(0)';
        } else {
            updateSlider(currentSlide);
            startSlider();
        }
    });
});

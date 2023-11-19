document.addEventListener("DOMContentLoaded", function() {
    const slider = document.querySelector(".slides");
    const slides = document.querySelectorAll(".slide");
    let currentIndex = 0;

    function updateSlider() {
        const slideWidth = slides[0].offsetWidth;
        slider.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
    }

    function nextSlide() {
        if (currentIndex < slides.length - 1) {
            currentIndex++;
        } else {
            currentIndex = 0;
        }
        updateSlider();
    }

    function prevSlide() {
        if (currentIndex > 0) {
            currentIndex--;
        } else {
            currentIndex = slides.length - 1;
        }
        updateSlider();
    }
    document.getElementById('prev').addEventListener("click", function() {
        prevSlide();
    });

    document.getElementById('next').addEventListener("click", function() {
        nextSlide();
    });
    setInterval(() => {
        nextSlide();
    }, 3000);
});

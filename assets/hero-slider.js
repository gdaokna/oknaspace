/* ===============================
   HERO SLIDER
=============================== */

(function () {
    const slider = document.getElementById('heroSlider');
    if (!slider) return;

    const slides = slider.querySelectorAll('.hero-slide');
    const dotsWrap = slider.querySelector('.hero-dots');
    const prevBtn = slider.querySelector('.hero-arrow.prev');
    const nextBtn = slider.querySelector('.hero-arrow.next');

    let current = 0;
    let timer;

    // точки
    slides.forEach((_, i) => {
        const dot = document.createElement('div');
        dot.className = 'hero-dot' + (i === 0 ? ' active' : '');
        dot.addEventListener('click', () => goTo(i));
        dotsWrap.appendChild(dot);
    });

    const dots = dotsWrap.querySelectorAll('.hero-dot');

    function goTo(index) {
        slides[current].classList.remove('active');
        dots[current].classList.remove('active');

        current = index;

        slides[current].classList.add('active');
        dots[current].classList.add('active');
        restart();
    }

    function next() {
        goTo((current + 1) % slides.length);
    }

    function prev() {
        goTo((current - 1 + slides.length) % slides.length);
    }

    function start() {
        timer = setInterval(next, 6000);
    }

    function restart() {
        clearInterval(timer);
        start();
    }

    nextBtn?.addEventListener('click', next);
    prevBtn?.addEventListener('click', prev);

    start();
})();



/* ===============================
   COUNTERS (WHY KABAN)
=============================== */

(function () {
    const counters = document.querySelectorAll('.counter');
    if (!counters.length) return;

    const options = {
        threshold: 0.4
    };

    const animateCounter = (el) => {
        const target = +el.dataset.target;
        let current = 0;
        const step = Math.max(1, Math.floor(target / 60));

        const timer = setInterval(() => {
            current += step;
            if (current >= target) {
                el.textContent = target;
                clearInterval(timer);
            } else {
                el.textContent = current;
            }
        }, 20);
    };

    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                obs.unobserve(entry.target);
            }
        });
    }, options);

    counters.forEach(counter => observer.observe(counter));
})();

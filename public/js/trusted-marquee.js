/**
 * Marquee monokrom "Dipercaya oleh" + hitungan angka statistik.
 * Markup: resources/views/partials/trusted-marquee.blade.php
 */
(function () {
    const section = document.querySelector('.vp-trusted');
    if (!section) return;

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const HOVER_SPEED = 0.08;
    const SPEED_LERP = 0.05;

    /* ---------- Marquee ---------- */
    const marquees = Array.from(section.querySelectorAll('.vp-marquee')).map((element) => {
        const track = element.querySelector('.vp-marquee-track');
        const baseSpeed = parseFloat(element.dataset.marqueeSpeed || '0.4');
        const direction = element.dataset.marqueeDirection === 'right' ? 1 : -1;
        const state = { element, track, baseSpeed, direction, speed: baseSpeed, targetSpeed: baseSpeed, offset: 0, loopWidth: 0 };

        element.addEventListener('pointerenter', () => {
            state.targetSpeed = HOVER_SPEED;
            element.classList.add('is-hovered');
        });
        element.addEventListener('pointerleave', () => {
            state.targetSpeed = baseSpeed;
            element.classList.remove('is-hovered');
        });

        return state;
    });

    /* Track berisi 2 salinan; setengah lebar track = satu putaran penuh */
    function measure() {
        marquees.forEach((marquee) => {
            marquee.loopWidth = marquee.track.scrollWidth / 2;
            if (marquee.direction === 1 && marquee.offset === 0) {
                marquee.offset = -marquee.loopWidth;
            }
            render(marquee);
        });
    }

    function render(marquee) {
        marquee.track.style.transform = `translate3d(${marquee.offset}px, 0, 0)`;
    }

    let animationFrameId = null;
    let lastTime = null;

    function tick(now) {
        const frameScale = lastTime === null ? 1 : Math.min((now - lastTime) / (1000 / 60), 3);
        lastTime = now;

        marquees.forEach((marquee) => {
            if (!marquee.loopWidth) return;
            marquee.speed += (marquee.targetSpeed - marquee.speed) * SPEED_LERP * frameScale;
            marquee.offset += marquee.direction * marquee.speed * frameScale;

            /* Wrap: geser kembali satu putaran tanpa terlihat putus */
            if (marquee.offset <= -marquee.loopWidth) marquee.offset += marquee.loopWidth;
            if (marquee.offset > 0) marquee.offset -= marquee.loopWidth;

            render(marquee);
        });

        animationFrameId = requestAnimationFrame(tick);
    }

    function startLoop() {
        if (prefersReducedMotion || animationFrameId !== null) return;
        lastTime = null;
        animationFrameId = requestAnimationFrame(tick);
    }

    function stopLoop() {
        if (animationFrameId === null) return;
        cancelAnimationFrame(animationFrameId);
        animationFrameId = null;
    }

    /* ---------- Hitungan angka (sekali saja) ---------- */
    const counters = Array.from(section.querySelectorAll('.vp-stat-count'));
    let hasCounted = false;

    function runCounters() {
        if (hasCounted) return;
        hasCounted = true;
        if (prefersReducedMotion) return;

        const duration = 1500;
        let startTime = null;
        const easeOutCubic = (t) => 1 - Math.pow(1 - t, 3);

        counters.forEach((counter) => {
            counter.textContent = '0';
        });

        function step(now) {
            /* Waktu mulai diambil dari frame pertama agar progress tidak pernah negatif */
            if (startTime === null) startTime = now;
            const progress = Math.min(Math.max((now - startTime) / duration, 0), 1);
            const eased = easeOutCubic(progress);
            counters.forEach((counter) => {
                const target = parseInt(counter.dataset.countTo, 10) || 0;
                counter.textContent = String(Math.round(target * eased));
            });
            if (progress < 1) {
                requestAnimationFrame(step);
            } else {
                measure();
            }
        }

        requestAnimationFrame(step);
    }

    /* ---------- Hanya jalan saat terlihat ---------- */
    new IntersectionObserver((entries) => {
        const isVisible = entries[0].isIntersecting;
        if (isVisible) {
            runCounters();
            startLoop();
        } else {
            stopLoop();
        }
    }, { threshold: 0.15 }).observe(section);

    window.addEventListener('resize', measure);
    if (document.fonts && document.fonts.ready) {
        document.fonts.ready.then(measure);
    }
    measure();
})();

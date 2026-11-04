/**
 * Latar footer: titik halftone putih (grid 7px) memenuhi seluruh lebar footer.
 * Dua pita gelombang diagonal: pita utama di kanan, pita kedua lebih tipis di kiri
 * dengan kemiringan berlawanan, plus lapisan titik sangat tipis di seluruh area.
 * Ukuran & opacity titik mengikuti jarak ke tengah pita (opacity maks. 0.4).
 * Markup: resources/views/partials/footer.blade.php (.vp-footer > .vp-footer-canvas).
 */
(function () {
    const footer = document.querySelector('.vp-footer');
    const canvas = footer ? footer.querySelector('.vp-footer-canvas') : null;
    if (!footer || !canvas) return;

    const ctx = canvas.getContext('2d');
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const GRID_SPACING = 7;
    const BASE_RADIUS = 0.6;
    const MAX_RADIUS = GRID_SPACING * 0.4;
    const BASE_ALPHA = 0.05;
    const MAX_ALPHA = 0.4;
    const ALPHA_LEVELS = 12;
    const TIME_STEP = 0.012;

    /**
     * Pita gelombang. centerX relatif terhadap lebar footer, angle dalam radian,
     * widthScale relatif terhadap pita utama, phase menggeser gelombang agar tidak seragam.
     */
    const BANDS = [
        { centerX: 0.8, angle: -1.05, widthScale: 1, phase: 0 },
        { centerX: 0.18, angle: 1.05, widthScale: 0.6, phase: 2.1 },
    ].map(function (band) {
        return Object.assign(band, { directionX: Math.cos(band.angle), directionY: Math.sin(band.angle) });
    });

    let width = 0;
    let height = 0;
    let dpr = 1;
    let time = 0;
    let animationFrameId = null;

    function resize() {
        const rect = footer.getBoundingClientRect();
        width = Math.max(1, Math.round(rect.width));
        height = Math.max(1, Math.round(rect.height));
        dpr = Math.min(window.devicePixelRatio || 1, 2);

        canvas.width = Math.round(width * dpr);
        canvas.height = Math.round(height * dpr);

        draw();
    }

    /** Intensitas 0..1 sebuah titik terhadap satu pita (1 = tepat di tengah pita) */
    function bandIntensity(band, x, y, mainHalfWidth) {
        const halfBandWidth = mainHalfWidth * band.widthScale;
        const waveAmplitude = halfBandWidth * 0.35;
        const relativeX = x - width * band.centerX;
        const relativeY = y - height * 0.5;

        const along = relativeX * band.directionX + relativeY * band.directionY;
        const across = -relativeX * band.directionY + relativeY * band.directionX;
        const wave = Math.sin(along * 0.012 + time + band.phase) * waveAmplitude
            + Math.sin(along * 0.027 - time * 0.6 + band.phase) * waveAmplitude * 0.35;

        const distance = Math.abs(across - wave) / halfBandWidth;
        if (distance >= 1) return 0;

        const falloff = 1 - distance;
        return falloff * falloff * (3 - 2 * falloff);
    }

    function draw() {
        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
        ctx.clearRect(0, 0, width, height);

        const mainHalfWidth = Math.max(70, Math.min(width, height) * 0.32) * (1 + 0.08 * Math.sin(time * 0.7));
        const buckets = Array.from({ length: ALPHA_LEVELS }, function () {
            return [];
        });

        for (let y = 0; y <= height; y += GRID_SPACING) {
            for (let x = 0; x <= width; x += GRID_SPACING) {
                let intensity = 0;
                BANDS.forEach(function (band) {
                    intensity = Math.max(intensity, bandIntensity(band, x, y, mainHalfWidth));
                });

                /* intensity 0 = lapisan dasar tipis, jadi tidak ada area kosong */
                const radius = BASE_RADIUS + (MAX_RADIUS - BASE_RADIUS) * intensity;
                const alpha = BASE_ALPHA + (MAX_ALPHA - BASE_ALPHA) * intensity;
                const level = Math.min(ALPHA_LEVELS - 1, Math.floor((alpha / MAX_ALPHA) * ALPHA_LEVELS));
                buckets[level].push(x, y, radius);
            }
        }

        /* Satu fill() per tingkat opacity agar ringan */
        buckets.forEach(function (bucket, level) {
            if (!bucket.length) return;
            ctx.fillStyle = 'rgba(255, 255, 255, ' + Math.max(BASE_ALPHA, ((level + 1) / ALPHA_LEVELS) * MAX_ALPHA).toFixed(3) + ')';
            ctx.beginPath();
            for (let i = 0; i < bucket.length; i += 3) {
                ctx.moveTo(bucket[i] + bucket[i + 2], bucket[i + 1]);
                ctx.arc(bucket[i], bucket[i + 1], bucket[i + 2], 0, Math.PI * 2);
            }
            ctx.fill();
        });
    }

    function tick() {
        time += TIME_STEP;
        draw();
        animationFrameId = requestAnimationFrame(tick);
    }

    function startLoop() {
        if (prefersReducedMotion || animationFrameId !== null) return;
        animationFrameId = requestAnimationFrame(tick);
    }

    function stopLoop() {
        if (animationFrameId === null) return;
        cancelAnimationFrame(animationFrameId);
        animationFrameId = null;
    }

    /* Loop hanya berjalan saat footer terlihat */
    new IntersectionObserver(function (entries) {
        if (entries[0].isIntersecting) {
            startLoop();
        } else {
            stopLoop();
        }
    }).observe(footer);

    let resizeFrame = null;
    new ResizeObserver(function () {
        if (resizeFrame !== null) cancelAnimationFrame(resizeFrame);
        resizeFrame = requestAnimationFrame(function () {
            resizeFrame = null;
            resize();
        });
    }).observe(footer);

    resize();
})();

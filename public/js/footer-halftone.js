/**
 * Latar footer "dark abstract wave" berpola titik halftone kotak.
 * Markup: resources/views/partials/footer.blade.php (.vp-footer > .vp-footer-canvas).
 */
(function () {
    const footer = document.querySelector('.vp-footer');
    const canvas = footer ? footer.querySelector('.vp-footer-canvas') : null;
    if (!footer || !canvas) return;

    const ctx = canvas.getContext('2d');
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const liteQuery = window.matchMedia('(max-width: 767px), (hover: none)');

    const TIME_STEP = 0.008;
    const CURSOR_RADIUS = 120;
    const CURSOR_PUSH = 14;
    const BASE_GRAY = 150;
    const MAX_GRAY = 210;

    let width = 0;
    let height = 0;
    let dpr = 1;
    let spacing = 5;
    let isLite = false;
    let time = 0;

    const pointer = {
        targetParallaxX: 0, targetParallaxY: 0, parallaxX: 0, parallaxY: 0,
        targetX: 0, targetY: 0, x: 0, y: 0,
        strength: 0, targetStrength: 0,
    };

    function resize() {
        const rect = footer.getBoundingClientRect();
        width = Math.max(1, Math.round(rect.width));
        height = Math.max(1, Math.round(rect.height));
        dpr = Math.min(window.devicePixelRatio || 1, 2);
        isLite = liteQuery.matches;
        spacing = isLite ? 6 : 5;

        canvas.width = Math.round(width * dpr);
        canvas.height = Math.round(height * dpr);

        if (prefersReducedMotion) draw();
    }

    /** Medan gelombang: nilai kecerahan 0..1 */
    function field(nx, ny, t) {
        const u = nx * 3.2 + 0.55 * Math.sin(ny * 3.1 + t * 0.35) + 0.25 * Math.sin(ny * 7 + t * 0.2);
        const b1 = Math.pow(0.5 + 0.5 * Math.sin(u * Math.PI * 1.6 - t * 0.15), 2.2);
        const b2 = Math.pow(0.5 + 0.5 * Math.sin((nx * 1.6 - ny * 1.2) * Math.PI * 2 + t * 0.1), 3) * 0.5;
        return Math.max(b1, b2);
    }

    function draw() {
        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
        ctx.clearRect(0, 0, width, height);

        const isInteractive = !prefersReducedMotion && !isLite;
        const offsetX = isInteractive ? pointer.parallaxX * 0.12 : 0;
        const offsetY = isInteractive ? pointer.parallaxY * 0.12 : 0;
        const cursorActive = isInteractive && pointer.strength > 0.001;
        const radiusSquared = CURSOR_RADIUS * CURSOR_RADIUS;
        const maxSize = spacing * 0.92;

        /* Kelompokkan kotak per warna agar fill() sedikit */
        const buckets = new Map();

        for (let y = spacing / 2; y < height; y += spacing) {
            const ny = y / height;

            for (let x = spacing / 2; x < width; x += spacing) {
                const nx = x / width;

                const brightness = field(nx - offsetX, ny - offsetY, time);
                /* Desktop: pudar ke kiri (teks di kiri). Mobile: pudar ke atas. */
                const fadeBase = isLite ? ny : nx;
                const fade = Math.min(Math.max((fadeBase - 0.25) * 1.6, 0), 1);
                let value = brightness * (0.25 + 0.75 * fade);

                let drawX = x;
                let drawY = y;
                let gray = BASE_GRAY;

                /* Mengambang: titik terang bergerak sedikit lebih banyak */
                if (!prefersReducedMotion) {
                    const bob = Math.sin(time * 6 + x * 0.045 + y * 0.03) * 1.1;
                    drawY += bob * (0.4 + value);
                }

                if (cursorActive) {
                    const dx = x - pointer.x;
                    const dy = y - pointer.y;
                    const distanceSquared = dx * dx + dy * dy;

                    if (distanceSquared < radiusSquared) {
                        const distance = Math.sqrt(distanceSquared) || 0.0001;
                        const falloff = 1 - distance / CURSOR_RADIUS;
                        const eased = falloff * falloff * (3 - 2 * falloff) * pointer.strength;

                        drawX += (dx / distance) * CURSOR_PUSH * eased;
                        drawY += (dy / distance) * CURSOR_PUSH * eased;
                        value += eased * 0.35;
                        gray = BASE_GRAY + (MAX_GRAY - BASE_GRAY) * eased;
                    }
                }

                if (value < 0.06) continue;
                value = Math.min(value, 1);

                const size = value * maxSize;
                const alpha = Math.min(0.25 + value * 0.55, 1);
                const bucketKey = (Math.round(gray / 10) * 10) * 100 + Math.round(alpha * 20);

                let bucket = buckets.get(bucketKey);
                if (!bucket) {
                    bucket = [];
                    buckets.set(bucketKey, bucket);
                }
                bucket.push(drawX - size / 2, drawY - size / 2, size);
            }
        }

        buckets.forEach((bucket, bucketKey) => {
            const gray = Math.floor(bucketKey / 100);
            const alpha = (bucketKey % 100) / 20;
            ctx.fillStyle = `rgba(${gray}, ${gray}, ${gray}, ${alpha})`;
            ctx.beginPath();
            for (let i = 0; i < bucket.length; i += 3) {
                ctx.rect(bucket[i], bucket[i + 1], bucket[i + 2], bucket[i + 2]);
            }
            ctx.fill();
        });
    }

    let animationFrameId = null;

    function tick() {
        time += TIME_STEP;
        pointer.parallaxX += (pointer.targetParallaxX - pointer.parallaxX) * 0.04;
        pointer.parallaxY += (pointer.targetParallaxY - pointer.parallaxY) * 0.04;
        pointer.x += (pointer.targetX - pointer.x) * 0.1;
        pointer.y += (pointer.targetY - pointer.y) * 0.1;
        pointer.strength += (pointer.targetStrength - pointer.strength) * 0.06;

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

    /* Kursor dibaca dari footer (konten footer pointer-events: none kecuali tautan) */
    if (!prefersReducedMotion) {
        footer.addEventListener('pointermove', (event) => {
            if (isLite) return;
            const rect = footer.getBoundingClientRect();
            const localX = event.clientX - rect.left;
            const localY = event.clientY - rect.top;

            if (pointer.strength < 0.01) {
                pointer.x = localX;
                pointer.y = localY;
            }
            pointer.targetX = localX;
            pointer.targetY = localY;
            pointer.targetParallaxX = localX / rect.width - 0.5;
            pointer.targetParallaxY = localY / rect.height - 0.5;
            pointer.targetStrength = 1;
        });

        footer.addEventListener('pointerleave', () => {
            pointer.targetParallaxX = 0;
            pointer.targetParallaxY = 0;
            pointer.targetStrength = 0;
        });
    }

    /* Loop hanya berjalan saat footer terlihat */
    new IntersectionObserver((entries) => {
        if (entries[0].isIntersecting) {
            startLoop();
        } else {
            stopLoop();
        }
    }).observe(footer);

    let resizeFrame = null;
    new ResizeObserver(() => {
        if (resizeFrame !== null) cancelAnimationFrame(resizeFrame);
        resizeFrame = requestAnimationFrame(() => {
            resizeFrame = null;
            resize();
        });
    }).observe(footer);

    resize();
})();

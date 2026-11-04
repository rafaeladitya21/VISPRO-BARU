/**
 * Dot grid interaktif dengan monogram "VP" di belakang teks hero.
 * Canvas: .hero-dot-grid di dalam .hero-typing. Tanpa library.
 */
(function () {
    const hero = document.querySelector('.hero-typing');
    const canvas = hero ? hero.querySelector('.hero-dot-grid') : null;
    if (!hero || !canvas) return;

    const ctx = canvas.getContext('2d');
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const GRID_SPACING = 12;
    const BASE_RADIUS = 0.75;
    const BASE_ALPHA = 0.13;
    const CURSOR_RADIUS = 150;
    const CURSOR_PUSH = 12;
    const CURSOR_GROW = 1.4;
    const CURSOR_MAX_ALPHA = 0.85;
    const FONT_FAMILY = 'Gloock';

    let width = 0;
    let height = 0;
    let dpr = 1;
    /** @type {{x: number, y: number, inLetter: boolean}[]} */
    let dots = [];

    const pointer = { targetX: -9999, targetY: -9999, x: -9999, y: -9999, strength: 0, targetStrength: 0 };
    let animationFrameId = null;
    let isVisible = false;
    let startTime = performance.now();

    /** Bangun ulang ukuran canvas, posisi titik, dan mask huruf VP. */
    function rebuild() {
        const rect = hero.getBoundingClientRect();
        width = Math.max(1, Math.round(rect.width));
        height = Math.max(1, Math.round(rect.height));
        dpr = Math.min(window.devicePixelRatio || 1, 2);

        canvas.width = Math.round(width * dpr);
        canvas.height = Math.round(height * dpr);

        const letterMask = buildLetterMask();
        const offsetX = (width % GRID_SPACING) / 2 + GRID_SPACING / 2;
        const offsetY = (height % GRID_SPACING) / 2 + GRID_SPACING / 2;

        dots = [];
        for (let y = offsetY; y < height; y += GRID_SPACING) {
            for (let x = offsetX; x < width; x += GRID_SPACING) {
                const maskIndex = (Math.floor(y) * width + Math.floor(x)) * 4 + 3;
                dots.push({ x, y, inLetter: letterMask[maskIndex] > 128 });
            }
        }

        if (prefersReducedMotion) draw(0);
    }

    /** Gambar V dan P terpisah di canvas tersembunyi, kembalikan data piksel. */
    function buildLetterMask() {
        const maskCanvas = document.createElement('canvas');
        maskCanvas.width = width;
        maskCanvas.height = height;
        const maskCtx = maskCanvas.getContext('2d');

        let fontSize = height * 0.95;
        maskCtx.font = `${fontSize}px ${FONT_FAMILY}, Georgia, serif`;

        /* Pastikan pasangan VP tetap muat di layar sempit */
        const measurePair = () => {
            const v = maskCtx.measureText('V');
            const p = maskCtx.measureText('P');
            const gap = -0.04 * fontSize;
            return { v, p, gap, total: v.width + gap + p.width };
        };

        let pair = measurePair();
        const maxWidth = width * 0.92;
        if (pair.total > maxWidth) {
            fontSize *= maxWidth / pair.total;
            maskCtx.font = `${fontSize}px ${FONT_FAMILY}, Georgia, serif`;
            pair = measurePair();
        }

        const startX = (width - pair.total) / 2;
        const centerY = height / 2;

        maskCtx.fillStyle = '#000';
        maskCtx.textAlign = 'left';
        maskCtx.textBaseline = 'alphabetic';

        /* Pusatkan kotak glyph secara vertikal: V naik 5%, P turun 5% */
        const glyphBaseline = (metrics, glyphCenterY) =>
            glyphCenterY + (metrics.actualBoundingBoxAscent - metrics.actualBoundingBoxDescent) / 2;

        maskCtx.fillText('V', startX, glyphBaseline(pair.v, centerY - height * 0.05));
        maskCtx.fillText('P', startX + pair.v.width + pair.gap, glyphBaseline(pair.p, centerY + height * 0.05));

        return maskCtx.getImageData(0, 0, width, height).data;
    }

    /** Render satu frame. Titik dikelompokkan per tingkat opacity agar fill() sedikit. */
    function draw(elapsedFrames) {
        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
        ctx.clearRect(0, 0, width, height);

        const buckets = new Map();
        const cursorActive = !prefersReducedMotion && pointer.strength > 0.001;

        for (let i = 0; i < dots.length; i++) {
            const dot = dots[i];
            let x = dot.x;
            let y = dot.y;
            let alpha = BASE_ALPHA;
            let radius = BASE_RADIUS;

            if (dot.inLetter) {
                const shimmer = prefersReducedMotion
                    ? 0.5
                    : 0.5 + 0.5 * Math.sin((x + y) * 0.012 - elapsedFrames * 0.04);
                alpha = 0.13 + 0.22 * shimmer;
                radius = 0.75 + 0.35 * shimmer;
            }

            if (cursorActive) {
                const dx = x - pointer.x;
                const dy = y - pointer.y;
                const distanceSquared = dx * dx + dy * dy;

                if (distanceSquared < CURSOR_RADIUS * CURSOR_RADIUS) {
                    const distance = Math.sqrt(distanceSquared) || 0.0001;
                    const falloff = 1 - distance / CURSOR_RADIUS;
                    const eased = falloff * falloff * (3 - 2 * falloff) * pointer.strength;

                    x += (dx / distance) * CURSOR_PUSH * eased;
                    y += (dy / distance) * CURSOR_PUSH * eased;
                    radius += CURSOR_GROW * eased;
                    alpha += (CURSOR_MAX_ALPHA - alpha) * eased;
                }
            }

            const bucketKey = Math.round(alpha * 100);
            let bucket = buckets.get(bucketKey);
            if (!bucket) {
                bucket = [];
                buckets.set(bucketKey, bucket);
            }
            bucket.push(x, y, radius);
        }

        buckets.forEach((bucket, bucketKey) => {
            ctx.fillStyle = `rgba(0, 0, 0, ${bucketKey / 100})`;
            ctx.beginPath();
            for (let i = 0; i < bucket.length; i += 3) {
                ctx.moveTo(bucket[i] + bucket[i + 2], bucket[i + 1]);
                ctx.arc(bucket[i], bucket[i + 1], bucket[i + 2], 0, Math.PI * 2);
            }
            ctx.fill();
        });
    }

    function tick(now) {
        pointer.x += (pointer.targetX - pointer.x) * 0.12;
        pointer.y += (pointer.targetY - pointer.y) * 0.12;
        pointer.strength += (pointer.targetStrength - pointer.strength) * 0.07;

        draw((now - startTime) / (1000 / 60));
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

    /* Interaksi kursor/sentuhan dibaca dari section hero, bukan canvas */
    if (!prefersReducedMotion) {
        const updatePointer = (event) => {
            const rect = hero.getBoundingClientRect();
            pointer.targetX = event.clientX - rect.left;
            pointer.targetY = event.clientY - rect.top;
            if (pointer.strength < 0.01) {
                pointer.x = pointer.targetX;
                pointer.y = pointer.targetY;
            }
            pointer.targetStrength = 1;
        };
        const releasePointer = () => {
            pointer.targetStrength = 0;
        };

        hero.addEventListener('pointerenter', updatePointer);
        hero.addEventListener('pointerdown', updatePointer);
        hero.addEventListener('pointermove', updatePointer);
        hero.addEventListener('pointerleave', releasePointer);
        hero.addEventListener('pointercancel', releasePointer);
    }

    /* Loop hanya berjalan saat hero terlihat */
    new IntersectionObserver((entries) => {
        isVisible = entries[0].isIntersecting;
        if (isVisible) {
            startLoop();
        } else {
            stopLoop();
        }
    }).observe(hero);

    /* Buat ulang mask saat ukuran hero berubah (resize window, rotasi layar) */
    let resizeFrame = null;
    new ResizeObserver(() => {
        if (resizeFrame !== null) cancelAnimationFrame(resizeFrame);
        resizeFrame = requestAnimationFrame(() => {
            resizeFrame = null;
            rebuild();
        });
    }).observe(hero);

    /* Tunggu font Gloock sebelum membuat mask huruf */
    const fontReady = document.fonts && document.fonts.load
        ? document.fonts.load(`100px ${FONT_FAMILY}`).catch(() => null)
        : Promise.resolve();

    fontReady.then(() => {
        rebuild();
        startTime = performance.now();
        if (isVisible) startLoop();
    });
})();

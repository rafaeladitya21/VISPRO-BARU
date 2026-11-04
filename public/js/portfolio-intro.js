/**
 * Pembuka section Portofolio: scroll-driven, sinematik, hitam-putih.
 * Markup: resources/views/partials/portfolio-intro.blade.php
 * Gaya:   public/css/portfolio-intro.css
 *
 * Progres timeline (0-1):
 *   0.01-0.32  judul masuk per huruf
 *   0.14-0.38  foto terbuka seperti layar dinyalakan, teks #111 → #fff, foto digelapkan
 *   0.40-0.58  judul keluar
 *   0.47-0.80  odometer berputar, lalu tepi pudar digit hilang
 *   0.70-0.82  tanda "+" dan label angka muncul
 *   0.60-1.00  suasana: penggelap 0.45 → 0.55, foto zoom perlahan
 *   0.84-1.00  angka jadi jendela lalu zoom masuk lewat "+"
 */
(function () {
    /** Satu-satunya angka yang perlu diganti: odometer, knockout, dan teks screen reader mengikutinya. */
    const PROJECT_COUNT = 150;

    const section = document.querySelector('.pf-intro');
    if (!section) return;

    const stage = section.querySelector('.pf-stage');
    const media = section.querySelector('.pf-media');
    const mediaSource = section.querySelector('.pf-media-src');
    const darken = section.querySelector('.pf-darken');
    const scrim = section.querySelector('.pf-scrim');
    const center = section.querySelector('.pf-center');
    const titleLabel = section.querySelector('.pf-title-label');
    const titleMain = section.querySelector('.pf-title-main');
    const count = section.querySelector('.pf-count');
    const odometer = section.querySelector('.pf-odometer');
    const countLabel = section.querySelector('.pf-count-label');
    const countText = section.querySelector('[data-pf-count-text]');
    const knockout = section.querySelector('.pf-knockout');
    const knockoutText = section.querySelector('.pf-knockout-text');

    const MIN_ZOOM = 40;

    /**
     * @type {{cell: HTMLElement, strip: HTMLElement, knockoutChar: HTMLElement,
     *         finalIndex: number, index: number, previousIndex: number, blur: number}[]}
     */
    const reels = [];
    let odometerPlus = null;
    let knockoutPlus = null;
    let cellPx = 0;

    /**
     * Bangun strip odometer dari angka. Digit ke-1 dan ke-2 berputar satu kali tambahan,
     * digit ke-3 dan seterusnya dua kali. 150 → "1": 0–9,0–1 · "5": 0–9,0–5 · "0": 0–9,0–9,0.
     */
    function buildOdometer(number) {
        const digits = String(number).split('');
        odometer.textContent = '';
        knockoutText.textContent = '';
        reels.length = 0;

        digits.forEach((digit, position) => {
            const extraTurns = position < 2 ? 1 : 2;
            const sequence = [];
            for (let turn = 0; turn < extraTurns; turn++) {
                for (let n = 0; n <= 9; n++) sequence.push(n);
            }
            for (let n = 0; n <= Number(digit); n++) sequence.push(n);

            const cell = document.createElement('span');
            cell.className = 'pf-digit';
            const strip = document.createElement('span');
            strip.className = 'pf-digit-strip';
            sequence.forEach((value) => {
                const item = document.createElement('span');
                item.textContent = String(value);
                strip.appendChild(item);
            });
            cell.appendChild(strip);
            odometer.appendChild(cell);

            const knockoutChar = document.createElement('span');
            knockoutChar.className = 'pf-knockout-digit';
            knockoutChar.textContent = digit;
            knockoutText.appendChild(knockoutChar);

            reels.push({ digit, cell, strip, knockoutChar, finalIndex: sequence.length - 1, index: 0, previousIndex: 0, blur: 0 });
        });

        odometerPlus = document.createElement('span');
        odometerPlus.className = 'pf-plus';
        odometerPlus.textContent = '+';
        odometer.appendChild(odometerPlus);

        knockoutPlus = document.createElement('span');
        knockoutPlus.className = 'pf-knockout-plus';
        knockoutPlus.textContent = '+';
        knockoutText.appendChild(knockoutPlus);

        if (countText) countText.textContent = `${number}+ project yang telah selesai`;
    }

    /** Geser strip ke indeks (boleh pecahan) dalam px: translateY = -(indeks × cellPx). */
    function setReelIndex(reel, index) {
        reel.index = index;
        reel.strip.style.transform = `translate3d(0, ${-(index * cellPx)}px, 0)`;
    }

    /**
     * Ukur ulang: tinggi sel, posisi & lebar teks knockout agar menumpuk tepat di atas
     * odometer, dan transform-origin di tengah "+" (horizontal tengah, vertikal 55%).
     */
    function measure() {
        /*
         * Lebar slot tiap digit = lebar DIGIT AKHIRNYA (diukur dengan span sementara
         * berfont sama), bukan digit terlebar, supaya "150" tidak renggang.
         */
        const probe = document.createElement('span');
        probe.style.cssText = 'position:absolute;visibility:hidden;white-space:nowrap;';
        odometer.appendChild(probe);
        reels.forEach((reel) => {
            probe.textContent = reel.digit;
            const width = probe.getBoundingClientRect().width;
            reel.cell.style.setProperty('--slot', `${width}px`);
            reel.knockoutChar.style.width = `${width}px`;
        });
        probe.remove();
        knockoutPlus.style.width = `${odometerPlus.offsetWidth}px`; /* offsetWidth: tidak terpengaruh scale(0) */

        const firstItem = reels[0] && reels[0].strip.firstElementChild;
        cellPx = firstItem ? firstItem.offsetHeight : 0;
        reels.forEach((reel) => setReelIndex(reel, reel.index));

        /* Posisi layout odometer relatif terhadap stage (tanpa terpengaruh scale knockout) */
        const stageRect = stage.getBoundingClientRect();
        const odometerRect = odometer.getBoundingClientRect();
        knockoutText.style.left = `${odometerRect.left - stageRect.left}px`;
        knockoutText.style.top = `${odometerRect.top - stageRect.top}px`;

        const originX = knockoutPlus.offsetLeft + knockoutPlus.offsetWidth / 2;
        const originY = knockoutPlus.offsetTop + knockoutPlus.offsetHeight * 0.55;
        knockoutText.style.transformOrigin = `${originX}px ${originY}px`;
    }

    buildOdometer(PROJECT_COUNT);

    const gsap = window.gsap;
    const ScrollTrigger = window.ScrollTrigger;
    const SplitText = window.SplitText;
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* Font judul & angka diminta eksplisit, lalu tunggu document.fonts.ready */
    const fontsReady = document.fonts && document.fonts.load
        ? Promise.all([
            document.fonts.load("700 1em 'Plus Jakarta Sans'"),
            document.fonts.load("400 1em 'JetBrains Mono'"),
        ]).catch(() => null).then(() => document.fonts.ready)
        : Promise.resolve();

    /* Tanpa animasi: keadaan akhir (foto penuh & gelap, judul putih, 150+, label) */
    if (prefersReducedMotion || !gsap || !ScrollTrigger || !SplitText) {
        fontsReady.then(() => {
            measure();
            reels.forEach((reel) => setReelIndex(reel, reel.finalIndex));
        });
        return;
    }

    gsap.registerPlugin(ScrollTrigger, SplitText);

    /* ---------- Lenis smooth scroll, disinkronkan dengan ScrollTrigger ---------- */
    if (window.Lenis && !window.__pfLenis) {
        const lenis = new window.Lenis({ lerp: 0.07, smoothWheel: true });
        window.__pfLenis = lenis;
        lenis.on('scroll', ScrollTrigger.update);
        gsap.ticker.add((time) => lenis.raf(time * 1000));
        gsap.ticker.lagSmoothing(0);
    }

    /* ---------- Motion blur odometer dari kecepatan strip tiap frame ---------- */
    let maxOdometerBlur = 5;
    let isPinActive = false;

    gsap.ticker.add(() => {
        if (!isPinActive) return;

        reels.forEach((reel) => {
            const velocity = Math.abs(reel.index - reel.previousIndex);
            reel.previousIndex = reel.index;

            const blurTarget = Math.min(maxOdometerBlur, velocity * 12);
            reel.blur += (blurTarget - reel.blur) * 0.25;
            reel.strip.style.filter = reel.blur > 0.05 ? `blur(${reel.blur.toFixed(2)}px)` : 'none';
        });
    });

    /**
     * Skala akhir minimal 40. Bila 40 belum cukup agar kotak hitam persilangan "+"
     * (tebal ~0.08em) menutup sudut layar terjauh, skala dinaikkan otomatis.
     */
    function knockoutZoom() {
        const fontSize = parseFloat(getComputedStyle(knockoutText).fontSize) || 1;
        const plusStroke = fontSize * 0.08;
        const viewportDiagonal = Math.hypot(window.innerWidth, window.innerHeight);

        return Math.max(MIN_ZOOM, (viewportDiagonal * 2) / plusStroke);
    }

    /** Durasi tiap huruf agar seluruh stagger selesai tepat di akhir rentang. */
    function staggeredDuration(start, end, stagger, total) {
        return Math.max(0.02, end - start - stagger * Math.max(0, total - 1));
    }

    /* ---------- Timeline utama ---------- */
    function buildTimeline({ isMobile }) {
        const blurCap = isMobile ? 3 : Infinity;
        const blur = (px) => `blur(${Math.min(px, blurCap)}px)`;
        maxOdometerBlur = isMobile ? 3 : 5;

        section.classList.remove('is-static', 'is-done');

        const labelSplit = SplitText.create(titleLabel, { type: 'chars', aria: 'auto' });
        const mainSplit = SplitText.create(titleMain, { type: 'words,chars', aria: 'auto' });
        const labelChars = labelSplit.chars;
        const mainChars = mainSplit.chars;

        measure();
        reels.forEach((reel) => {
            reel.previousIndex = 0;
            reel.blur = 0;
            setReelIndex(reel, 0);
        });

        /* Clip-path dibuka lewat dua sumbu terpisah agar dua tahap yang bertumpuk tidak melompat */
        const screenOpen = { x: 50, y: 49.6 };
        const applyClip = () => {
            media.style.clipPath = `inset(${screenOpen.y}% ${screenOpen.x}% ${screenOpen.y}% ${screenOpen.x}%)`;
        };
        applyClip();

        const timeline = gsap.timeline({
            defaults: { ease: 'none' },
            scrollTrigger: {
                trigger: section,
                start: 'top top',
                end: isMobile ? '+=220%' : '+=320%',
                pin: stage,
                pinSpacing: true,
                anticipatePin: 1,
                scrub: 1.8,
                invalidateOnRefresh: true,
                onToggle: (self) => {
                    isPinActive = self.isActive;
                },
                onLeave: () => section.classList.add('is-done'),
                onEnterBack: () => section.classList.remove('is-done'),
            },
        });

        /* 1. Judul masuk */
        timeline
            .fromTo(labelChars,
                { opacity: 0, y: 10, filter: blur(4) },
                { opacity: 1, y: 0, filter: blur(0), stagger: 0.006, ease: 'power4.out', duration: staggeredDuration(0.01, 0.23, 0.006, labelChars.length) },
                0.01)
            .fromTo(mainChars,
                { opacity: 0, y: 24, filter: blur(6) },
                { opacity: 1, y: 0, filter: blur(0), stagger: 0.008, ease: 'power4.out', duration: staggeredDuration(0.04, 0.32, 0.008, mainChars.length) },
                0.04);

        /* 2. Layar menyala */
        timeline
            .to(screenOpen, { x: 0, duration: 0.1, ease: 'power4.inOut', onUpdate: applyClip }, 0.14)
            .to(screenOpen, { y: 0, duration: 0.18, ease: 'power4.inOut', onUpdate: applyClip }, 0.2)
            .fromTo(mediaSource, { scale: 1.25 }, { scale: 1, duration: 0.18, ease: 'power4.inOut' }, 0.2);

        /* 3. Keterbacaan, bersamaan layar terbuka */
        timeline
            .fromTo(center, { color: '#111111' }, { color: '#ffffff', duration: 0.18, ease: 'power2.inOut' }, 0.2)
            .fromTo(darken, { opacity: 0 }, { opacity: 0.45, duration: 0.18, ease: 'power2.inOut' }, 0.2)
            .fromTo(scrim, { opacity: 0 }, { opacity: 1, duration: 0.18, ease: 'power2.inOut' }, 0.2);

        /* 4. Judul keluar */
        timeline
            .to(labelChars,
                { y: -20, opacity: 0, filter: blur(6), stagger: 0.004, ease: 'power4.inOut', duration: staggeredDuration(0.4, 0.56, 0.004, labelChars.length) },
                0.4)
            .to(mainChars,
                { y: -36, opacity: 0, filter: blur(6), stagger: 0.006, ease: 'power4.inOut', duration: staggeredDuration(0.41, 0.58, 0.006, mainChars.length) },
                0.41);

        /* 5. Odometer: tiap digit mulai 0.03 lebih lambat; di akhir indeks dibulatkan */
        timeline.fromTo(odometer, { opacity: 0 }, { opacity: 1, duration: 0.07, ease: 'power3.out' }, 0.47);
        reels.forEach((reel, position) => {
            const state = { index: 0 };
            timeline.fromTo(state, { index: 0 }, {
                index: reel.finalIndex,
                duration: 0.21,
                ease: 'sine.inOut',
                onUpdate() {
                    const isFinished = this.progress() >= 1;
                    setReelIndex(reel, isFinished ? Math.round(state.index) : state.index);
                },
            }, 0.47 + position * 0.03);
        });
        timeline.fromTo(odometer, { '--fade': '18%' }, { '--fade': '0%', duration: 0.06 }, 0.74);

        /* 6. Tanda plus */
        timeline.fromTo(odometerPlus,
            { scale: 0, rotate: -60 },
            { scale: 1, rotate: 0, duration: 0.07, ease: 'back.out(1.7)' },
            0.7);

        /* 7. Label angka, satu baris utuh */
        /* y: 0 wajib: tanpa itu GSAP membaca translateY(110%) dari CSS sebagai y px dan label tetap tersembunyi */
        timeline.fromTo(countLabel,
            { y: 0, yPercent: 110, opacity: 0, letterSpacing: '0.6em', filter: blur(3) },
            { y: 0, yPercent: 0, opacity: 1, letterSpacing: '0.2em', filter: blur(0), duration: 0.1, ease: 'power3.out' },
            0.72);

        /* 8. Suasana */
        timeline
            .fromTo(darken, { opacity: 0.45 }, { opacity: 0.55, duration: 0.24, immediateRender: false }, 0.6)
            .fromTo(mediaSource, { scale: 1 }, { scale: 1.1, duration: 0.4, immediateRender: false }, 0.6);

        /* 9. Angka jadi jendela, lalu zoom masuk lewat "+" */
        timeline
            .fromTo(knockout, { opacity: 0 }, { opacity: 1, duration: 0.05, ease: 'power3.out' }, 0.84)
            .fromTo(count, { opacity: 1 }, { opacity: 0, duration: 0.05, ease: 'power3.out' }, 0.84)
            .fromTo(knockoutText,
                { scale: 1 },
                { scale: () => knockoutZoom(), duration: 0.11, ease: 'power3.in', force3D: false },
                0.89);

        return () => {
            labelSplit.revert();
            mainSplit.revert();
            media.style.clipPath = '';
            section.classList.add('is-static');
            isPinActive = false;
            reels.forEach((reel) => {
                setReelIndex(reel, reel.finalIndex);
                reel.strip.style.filter = 'none';
            });
        };
    }

    /* ---------- Mulai setelah foto & font siap ---------- */
    const imageReady = new Promise((resolve) => {
        if (mediaSource.complete) {
            resolve();
            return;
        }
        mediaSource.addEventListener('load', resolve, { once: true });
        mediaSource.addEventListener('error', resolve, { once: true });
    }).then(() => (mediaSource.decode ? mediaSource.decode().catch(() => null) : null));

    Promise.all([imageReady, fontsReady]).then(() => {
        const breakpoints = gsap.matchMedia();
        breakpoints.add(
            { isMobile: '(max-width: 767px)', isDesktop: '(min-width: 768px)' },
            (context) => buildTimeline(context.conditions)
        );

        ScrollTrigger.refresh();

        let resizeTimer = null;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                measure();
                ScrollTrigger.refresh();
            }, 150);
        });
    });
})();

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
 *   0.60-0.96  suasana: penggelap 0.45 → 0.55, foto zoom perlahan
 *   0.84-0.96  angka jadi jendela, zoom masuk lewat "+", lapisan putih melebur
 *   0.96-1.00  jeda: foto penuh diam, gradien bawah muncul, lalu pin dilepas
 */
(function () {
    /** Satu-satunya angka yang perlu diganti: odometer, knockout, dan teks screen reader mengikutinya. */
    const PROJECT_COUNT = 150;

    /*
     * Pengaturan kecepatan (ubah di sini).
     * SCROLL_DISTANCE: panjang scroll selama section di-pin; makin besar = makin pelan/slow motion.
     * SCRUB: detik animasi "mengejar" posisi scroll; 1.5-2 = gerak tertinggal halus.
     */
    const SCROLL_DISTANCE = { desktop: '+=500%', mobile: '+=360%' };
    const SCRUB = { desktop: 1.5, mobile: 1.5 };

    const section = document.querySelector('.pf-intro');
    if (!section) return;

    const stage = section.querySelector('.pf-stage');
    const media = section.querySelector('.pf-media');
    const mediaSource = section.querySelector('.pf-media-src');
    const secondMediaSource = section.querySelector('.pf-media-src--2');
    const darken = section.querySelector('.pf-darken');
    const scrim = section.querySelector('.pf-scrim');
    const center = section.querySelector('.pf-center');
    const titleLabel = section.querySelector('.pf-title-label');
    const titleMain = section.querySelector('.pf-title-main');
    const count = section.querySelector('.pf-count');
    const odometer = section.querySelector('.pf-odometer');
    const countLabel = section.querySelector('.pf-count-label');
    const countText = section.querySelector('[data-pf-count-text]');
    const knockoutLabel = section.querySelector('.pf-knockout-label');
    const corner = section.querySelector('.pf-corner');
    const bottomFade = section.querySelector('.pf-bottom-fade');
    const knockout = section.querySelector('.pf-knockout');
    const knockoutText = section.querySelector('.pf-knockout-text');

    /** Skala akhir zoom knockout. Lapisan putih melebur selama zoom, jadi 40 sudah cukup. */
    const KNOCKOUT_ZOOM = 40;

    /**
     * @type {{cell: HTMLElement, strip: HTMLElement, knockoutChar: HTMLElement,
     *         finalIndex: number, index: number, previousIndex: number, blur: number}[]}
     */
    const reels = [];
    let odometerPlus = null;
    let knockoutPlus = null;

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

    /**
     * Geser strip ke indeks (boleh pecahan): translateY = -(indeks × tinggi sel).
     * Tinggi sel memakai var(--cell) langsung, sehingga posisi benar tanpa menunggu
     * pengukuran (angka akhir langsung tampil walau font/foto belum selesai dimuat).
     */
    function setReelIndex(reel, index) {
        reel.index = index;
        reel.strip.style.transform = `translate3d(0, calc(var(--cell) * ${-index}), 0)`;
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

        /* Posisi layout odometer relatif terhadap stage (tanpa terpengaruh scale knockout) */
        const stageRect = stage.getBoundingClientRect();
        const odometerRect = odometer.getBoundingClientRect();
        knockoutText.style.left = `${odometerRect.left - stageRect.left}px`;
        knockoutText.style.top = `${odometerRect.top - stageRect.top}px`;

        const originX = knockoutPlus.offsetLeft + knockoutPlus.offsetWidth / 2;
        const originY = knockoutPlus.offsetTop + knockoutPlus.offsetHeight * 0.55;
        knockoutText.style.transformOrigin = `${originX}px ${originY}px`;

        /*
         * Label knockout sejajar label asli. Diukur dari wrap-nya (bagian dalam padding),
         * karena label asli sendiri masih tergeser translateY/letter-spacing sebelum animasinya.
         */
        const labelWrap = countLabel.parentElement;
        const wrapRect = labelWrap.getBoundingClientRect();
        const wrapPaddingTop = parseFloat(getComputedStyle(labelWrap).paddingTop) || 0;
        knockoutLabel.style.top = `${wrapRect.top - stageRect.top + wrapPaddingTop}px`;
    }

    buildOdometer(PROJECT_COUNT);

    /* Keadaan awal = angka AKHIR (150). Timeline yang berjalan akan mengatur ulang ke 0. */
    function showFinalState() {
        section.classList.add('is-static');
        reels.forEach((reel) => setReelIndex(reel, reel.finalIndex));
    }
    showFinalState();

    const gsap = window.gsap;
    const ScrollTrigger = window.ScrollTrigger;
    const SplitText = window.SplitText;

    /*
     * Setiap penantian diberi batas waktu: di Safari iOS, document.fonts.load() dan
     * img.decode() bisa tidak pernah selesai, sehingga animasi tidak pernah dibuat.
     */
    const withTimeout = (promise, ms) => Promise.race([
        Promise.resolve(promise).catch(() => null),
        new Promise((resolve) => setTimeout(resolve, ms)),
    ]);

    /* Font judul & angka diminta eksplisit, lalu tunggu document.fonts.ready */
    const fontsReady = document.fonts && document.fonts.load
        ? withTimeout(
            Promise.all([
                document.fonts.load("700 1em 'Plus Jakarta Sans'"),
                document.fonts.load("400 1em 'JetBrains Mono'"),
            ]).catch(() => null).then(() => document.fonts.ready),
            2500
        )
        : Promise.resolve();

    const windowLoaded = document.readyState === 'complete'
        ? Promise.resolve()
        : new Promise((resolve) => window.addEventListener('load', resolve, { once: true }));

    /* Library gagal dimuat: tetap di keadaan akhir */
    if (!gsap || !ScrollTrigger || !SplitText) {
        fontsReady.then(measure);
        return;
    }

    gsap.registerPlugin(ScrollTrigger, SplitText);

    /* Di HP, address bar Safari yang muncul/hilang tidak memicu hitung ulang (penyebab layar meloncat) */
    ScrollTrigger.config({ ignoreMobileResize: true });

    /* ---------- Lenis smooth scroll, disinkronkan dengan ScrollTrigger ---------- */
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (!prefersReducedMotion && window.Lenis && !window.__pfLenis) {
        /* syncTouch false: scroll sentuh di HP tetap native (tidak dihaluskan Lenis) */
        const lenis = new window.Lenis({ lerp: 0.07, smoothWheel: true, syncTouch: false });
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
                end: isMobile ? SCROLL_DISTANCE.mobile : SCROLL_DISTANCE.desktop,
                pin: stage,
                pinSpacing: true,
                anticipatePin: 1,
                /* Scrub berupa angka (bukan true): animasi tertinggal halus di belakang scroll */
                scrub: isMobile ? SCRUB.mobile : SCRUB.desktop,
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
            .fromTo(mediaSource, { scale: 1.25 }, { scale: 1, duration: 0.18, ease: 'power4.inOut', force3D: true }, 0.2);

        /* 3. Keterbacaan, bersamaan layar terbuka */
        timeline
            .fromTo([center, corner], { color: '#111111' }, { color: '#ffffff', duration: 0.18, ease: 'power2.inOut' }, 0.2)
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
            /* Berakhir di 0.96 (bukan 1.00) agar foto benar-benar diam selama jeda akhir */
            /* Foto pertama berhenti di 0.86: setelah itu tertutup foto kedua (kecepatan zoom tetap sama) */
            .fromTo(mediaSource, { scale: 1 }, { scale: 1.072, duration: 0.26, immediateRender: false, force3D: true }, 0.6);

        /* Pergantian foto saat zoom knockout: kamera masuk lewat angka lalu mendarat di foto kedua */
        timeline
            .fromTo(secondMediaSource, { opacity: 0 }, { opacity: 1, duration: 0.08, ease: 'power2.inOut' }, 0.86)
            .fromTo(secondMediaSource, { scale: 1.15 }, { scale: 1, duration: 0.14, ease: 'power2.out', force3D: true }, 0.86);

        /*
         * 9. Angka jadi jendela, lalu zoom masuk lewat "+".
         * Lapisan putih melebur dan teks diburamkan selama zoom, jadi tidak ada potongan
         * putih yang melompat keluar layar.
         */
        timeline
            .fromTo(knockout, { opacity: 0 }, { opacity: 1, duration: 0.05, ease: 'power3.out' }, 0.84)
            .fromTo(count, { opacity: 1 }, { opacity: 0, duration: 0.05, ease: 'power3.out' }, 0.84)
            .fromTo(knockoutText,
                { scale: 1 },
                /*
                 * Desktop: force3D false agar tepi angka tajam (digambar ulang tiap frame).
                 * HP: force3D true, diperbesar oleh GPU tanpa menggambar ulang (jauh lebih ringan);
                 * tepinya sedikit lembut, tetapi lapisan putih memang sedang melebur.
                 */
                { scale: KNOCKOUT_ZOOM, duration: 0.1, ease: 'power2.inOut', force3D: isMobile },
                0.86)
            .fromTo(knockout, { opacity: 1 }, { opacity: 0, duration: 0.06, ease: 'power1.in', immediateRender: false }, 0.9);

        /* Blur pada teks yang diperbesar 40x terlalu berat untuk GPU HP: hanya di desktop */
        if (!isMobile) {
            timeline.fromTo(knockoutText, { filter: blur(0) }, { filter: blur(8), duration: 0.06, immediateRender: false }, 0.9);
        }

        /*
         * Label versi knockout (#111) muncul bersamaan .pf-count memudar, lalu turun & hilang
         * sebelum "+" yang diperbesar sempat menimpanya (zoom mulai 0.86, masih pelan di awal).
         */
        timeline
            .fromTo(knockoutLabel, { opacity: 0, y: 0 }, { opacity: 1, duration: 0.04, ease: 'power3.out' }, 0.84)
            .to(knockoutLabel, { y: 12, opacity: 0, duration: 0.03, ease: 'power2.in' }, 0.865);

        /* Label pojok mengikuti latar: putih knockout → hitam, foto penuh di akhir zoom → putih lagi */
        timeline
            .fromTo(corner, { color: '#ffffff' }, { color: '#111111', duration: 0.05, immediateRender: false }, 0.84)
            .fromTo(corner, { color: '#111111' }, { color: '#ffffff', duration: 0.04, immediateRender: false }, 0.92);

        /* Gradien putih di bawah stage agar foto menyambung halus ke grid project */
        timeline.fromTo(bottomFade, { opacity: 0 }, { opacity: 1, duration: 0.04, immediateRender: false }, 0.96);

        /* Jeda 0.96-1.00: foto penuh diam sebentar sebelum pin dilepas */
        timeline.to({}, { duration: 0.04 }, 0.96);

        return () => {
            labelSplit.revert();
            mainSplit.revert();
            media.style.clipPath = '';
            isPinActive = false;
            reels.forEach((reel) => {
                reel.strip.style.filter = 'none';
            });
            showFinalState();
        };
    }

    /* ---------- Mulai setelah foto & font siap ---------- */
    /** Tunggu foto selesai dimuat & di-decode (gagal / macet tetap dilanjutkan). */
    const whenImageReady = (image) => withTimeout(new Promise((resolve) => {
        if (!image || image.complete) {
            resolve();
            return;
        }
        image.addEventListener('load', resolve, { once: true });
        image.addEventListener('error', resolve, { once: true });
    }).then(() => (image && image.decode ? image.decode().catch(() => null) : null)), 4000);

    function init() {
        const breakpoints = gsap.matchMedia();
        breakpoints.add(
            {
                isDesktop: '(min-width: 768px) and (prefers-reduced-motion: no-preference)',
                isMobile: '(max-width: 767px) and (prefers-reduced-motion: no-preference)',
                isReduced: '(prefers-reduced-motion: reduce)',
            },
            (context) => {
                const { isDesktop, isMobile } = context.conditions;
                try {
                    if (isDesktop || isMobile) {
                        return buildTimeline({ isMobile });
                    }
                    /* Kurangi Gerakan: keadaan akhir tanpa pin/scrub */
                    showFinalState();
                    measure();
                } catch (error) {
                    console.error('[portfolio-intro] gagal membuat animasi:', error);
                    showFinalState();
                }
                return undefined;
            }
        );

        ScrollTrigger.refresh();
    }

    Promise.all([whenImageReady(mediaSource), whenImageReady(secondMediaSource), fontsReady])
        .then(init)
        .catch((error) => {
            console.error('[portfolio-intro] inisialisasi gagal:', error);
            showFinalState();
        });

    /* Ukur ulang setelah semua aset halaman selesai (event "load") & saat ukuran layar berubah */
    Promise.all([fontsReady, windowLoaded]).then(() => {
        try {
            measure();
        } catch (error) {
            console.error('[portfolio-intro] gagal mengukur:', error);
        }
        ScrollTrigger.refresh();
    });

    let resizeTimer = null;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            measure();
            ScrollTrigger.refresh();
        }, 150);
    });
})();

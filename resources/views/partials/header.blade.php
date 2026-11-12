{{-- Header situs: logo, menu pill dengan indikator bergeser, dan tombol CTA. --}}
<link rel="stylesheet" href="{{ asset('css/header.css') }}?v={{ @filemtime(public_path('css/header.css')) }}">

<header class="vp-header" id="vpHeader">
    <a href="{{ url('/') }}#top" class="vp-brand" aria-label="Visual Production - Beranda">
        <span class="vp-brand-logo">
            <img src="{{ asset('images/logo-visual-production.png') }}" alt="Visual Production" class="vp-brand-logo-img">
        </span>
        <span class="vp-brand-divider" aria-hidden="true"></span>
        <span class="vp-brand-text">CREATIVE STUDIO<br>MALANG</span>
    </a>

    <nav class="vp-nav" aria-label="Menu utama">
        <span class="vp-nav-indicator" aria-hidden="true"></span>
        <a href="{{ url('/') }}#top" class="vp-nav-item is-active" data-section="top">Home</a>
        <a href="{{ url('/') }}#proyek" class="vp-nav-item" data-section="proyek">Proyek</a>
        <a href="{{ url('/') }}#about-us" class="vp-nav-item" data-section="about-us">About Us</a>
        <a href="{{ url('/') }}#lokasi" class="vp-nav-item" data-section="lokasi">Contact</a>
    </nav>

    <div class="vp-actions">
        <a href="https://wa.me/6285746642358" target="_blank" rel="noopener" class="vp-cta">
            <span>Let's talk</span>
            <svg class="vp-cta-arrow" width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true">
                <path d="M3.5 10.5L10.5 3.5M10.5 3.5H4.5M10.5 3.5V9.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
        <button type="button" class="vp-burger" aria-label="Buka menu" aria-expanded="false" aria-controls="vpMobileMenu">
            <span class="vp-burger-line"></span>
            <span class="vp-burger-line"></span>
        </button>
    </div>

    <div class="vp-mobile-menu" id="vpMobileMenu" hidden>
        <a href="{{ url('/') }}#top">Home</a>
        <a href="{{ url('/') }}#proyek">Proyek</a>
        <a href="{{ url('/') }}#about-us">About Us</a>
        <a href="{{ url('/') }}#lokasi">Contact</a>
    </div>
</header>

<script>
    (function () {
        const header = document.getElementById('vpHeader');
        if (!header) return;

        const nav = header.querySelector('.vp-nav');
        const indicator = nav.querySelector('.vp-nav-indicator');
        const items = Array.from(nav.querySelectorAll('.vp-nav-item'));
        let activeItem = items.find((item) => item.classList.contains('is-active')) || items[0];
        let isHovering = false;

        function moveIndicatorTo(item) {
            indicator.style.left = item.offsetLeft + 'px';
            indicator.style.width = item.offsetWidth + 'px';
            items.forEach((other) => other.classList.toggle('is-current', other === item));
        }

        function setActiveItem(item) {
            activeItem = item;
            items.forEach((other) => other.classList.toggle('is-active', other === item));
            if (!isHovering) moveIndicatorTo(item);
        }

        items.forEach((item) => {
            item.addEventListener('mouseenter', () => {
                isHovering = true;
                moveIndicatorTo(item);
            });
            item.addEventListener('click', () => setActiveItem(item));
        });

        nav.addEventListener('mouseleave', () => {
            isHovering = false;
            moveIndicatorTo(activeItem);
        });

        /* Posisi awal tanpa animasi, lalu aktifkan transisi */
        moveIndicatorTo(activeItem);
        requestAnimationFrame(() => requestAnimationFrame(() => nav.classList.add('is-ready')));
        if (document.fonts) document.fonts.ready.then(() => moveIndicatorTo(isHovering ? nav.querySelector('.is-current') || activeItem : activeItem));
        window.addEventListener('resize', () => moveIndicatorTo(activeItem));

        /* Item aktif mengikuti section yang sedang terlihat saat scroll */
        const sectionItems = items
            .map((item) => ({ item, section: document.getElementById(item.dataset.section) }))
            .filter((entry) => entry.section);

        if (sectionItems.length) {
            let ticking = false;
            window.addEventListener('scroll', () => {
                if (ticking) return;
                ticking = true;
                requestAnimationFrame(() => {
                    ticking = false;
                    const probeLine = window.innerHeight * 0.4;
                    let current = items[0];
                    sectionItems.forEach(({ item, section }) => {
                        if (section.getBoundingClientRect().top <= probeLine) current = item;
                    });
                    if (current !== activeItem) setActiveItem(current);
                });
            }, { passive: true });
        }

        /* Menu mobile */
        const burger = header.querySelector('.vp-burger');
        const mobileMenu = document.getElementById('vpMobileMenu');

        function setMobileMenu(isOpen) {
            mobileMenu.hidden = !isOpen;
            burger.classList.toggle('is-open', isOpen);
            burger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            burger.setAttribute('aria-label', isOpen ? 'Tutup menu' : 'Buka menu');
        }

        burger.addEventListener('click', () => setMobileMenu(mobileMenu.hidden));
        mobileMenu.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => setMobileMenu(false)));
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') setMobileMenu(false);
        });

        /*
         * Smart header: selalu tampil di dalam hero; setelah hero dilewati,
         * sembunyi saat scroll ke bawah dan muncul saat scroll ke atas (min. 10px).
         */
        /* Script ini berjalan sebelum hero di-parse, jadi elemen hero dicari saat dibutuhkan */
        let hero = null;
        const SCROLL_TOLERANCE = 10;
        const REVEAL_ZONE = 80;
        let lastScrollY = window.scrollY;
        let isPointerNearTop = false;
        let scrollTicking = false;

        function heroBottom() {
            hero = hero || document.querySelector('.hero-container');
            if (!hero) return header.offsetHeight;
            return hero.getBoundingClientRect().bottom + window.scrollY - header.offsetHeight;
        }

        function updateSmartHeader() {
            scrollTicking = false;
            const currentScrollY = window.scrollY;
            const isPastHero = currentScrollY > heroBottom();

            header.classList.toggle('is-scrolled', isPastHero);

            if (!isPastHero) {
                header.classList.remove('is-hidden');
                lastScrollY = currentScrollY;
                return;
            }

            const delta = currentScrollY - lastScrollY;
            if (Math.abs(delta) < SCROLL_TOLERANCE) return;

            const shouldHide = delta > 0 && mobileMenu.hidden && !isPointerNearTop;
            header.classList.toggle('is-hidden', shouldHide);
            lastScrollY = currentScrollY;
        }

        window.addEventListener('scroll', () => {
            if (scrollTicking) return;
            scrollTicking = true;
            requestAnimationFrame(updateSmartHeader);
        }, { passive: true });

        /* Desktop: kursor di 80px teratas layar ikut memunculkan header */
        if (window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
            document.addEventListener('mousemove', (event) => {
                const isNearTop = event.clientY <= REVEAL_ZONE;
                if (isNearTop === isPointerNearTop) return;
                isPointerNearTop = isNearTop;
                if (isNearTop) header.classList.remove('is-hidden');
            }, { passive: true });
        }

        /* Menu mobile terbuka: header tidak boleh tersembunyi */
        burger.addEventListener('click', () => {
            if (!mobileMenu.hidden) header.classList.remove('is-hidden');
        });

        /* Posisi awal (mis. reload di tengah halaman) dihitung setelah DOM siap */
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', updateSmartHeader);
        } else {
            updateSmartHeader();
        }
    })();
</script>

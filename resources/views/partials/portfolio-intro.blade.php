{{--
    Pembuka section Portofolio: judul → layar menyala → odometer "150+" → angka jadi jendela foto.
    Gaya: public/css/portfolio-intro.css. Animasi: public/js/portfolio-intro.js
    (angka project diatur di PROJECT_COUNT pada file JS).
    Kelas is-static = keadaan akhir tanpa animasi; dilepas oleh JS saat animasi berjalan.
--}}
@php
    $featuredImage = 'SUNSET1.webp';
@endphp

<link rel="stylesheet" href="{{ asset('css/portfolio-intro.css') }}">
<link rel="preload" as="image" href="{{ asset('images/'.$featuredImage) }}">

<section class="pf-intro is-static" aria-labelledby="pf-intro-title">
    <div class="pf-stage">
        <div class="pf-media">
            <img class="pf-media-src" src="{{ asset('images/'.$featuredImage) }}" alt="" decoding="async">
            <div class="pf-flicker" aria-hidden="true"></div>
            <div class="pf-vignette" aria-hidden="true"></div>
            {{-- Di dalam .pf-media agar ikut clip-path: area putih yang belum terbuka tidak ikut menggelap --}}
            <div class="pf-darken" aria-hidden="true"></div>
            <div class="pf-scrim" aria-hidden="true"></div>
        </div>

        <div class="pf-center">
            <div class="pf-corner">(01) Portofolio</div>

            <div class="pf-title" id="pf-intro-title" role="heading" aria-level="2">
                <div class="pf-title-label">Hasil karya</div>
                <span class="pf-title-main">Visual Production.</span>
            </div>

            <div class="pf-count">
                {{-- Strip digit dibuat oleh buildOdometer() di JS --}}
                <div class="pf-odometer" aria-hidden="true"></div>
                <div class="pf-count-label-wrap" aria-hidden="true">
                    <span class="pf-count-label">Project yang telah selesai</span>
                </div>
                <span class="sr-only" data-pf-count-text>150+ project yang telah selesai</span>
            </div>
        </div>

        <div class="pf-knockout" aria-hidden="true">
            {{-- Diisi JS dengan karakter yang sama dengan odometer --}}
            <div class="pf-knockout-text"></div>
        </div>

        <div class="pf-grain" aria-hidden="true"></div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/gsap.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/ScrollTrigger.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/SplitText.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/lenis@1.1.13/dist/lenis.min.js" defer></script>
<script src="{{ asset('js/portfolio-intro.js') }}" defer></script>

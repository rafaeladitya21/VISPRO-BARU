{{--
    Section (06) Behind the crew: carousel WebGL "liquid lens" (public/js/crew-carousel.js).
    Tanpa WebGL atau dengan reduced motion: strip foto biasa yang bisa digeser (scroll-snap).
    Gaya: public/css/monochrome.css (bagian "(06) Behind the crew").
    Foto: public/images/bts/ (versi 1000px dari public/images/Foto BTS/).
--}}
@php
    $crewPhotoCount = 20;

    $crewPhotos = array_map(fn (int $number): array => [
        'src' => asset("images/bts/bts{$number}.webp"),
        'alt' => "Kru Visual Production di balik layar, foto {$number}",
    ], range(1, $crewPhotoCount));
@endphp

<section id="behind-the-crew" class="vp-crew" aria-labelledby="vp-crew-heading">
    <div class="vp-section-label vp-crew-label">
        <span>(06) Behind the crew</span>
        <span>{{ $crewPhotoCount }} foto</span>
    </div>

    <div class="vp-section-intro">
        <h2 id="vp-crew-heading" class="vp-section-heading">Behind the Crew.</h2>
        <p class="vp-section-lead">Wajah-wajah di balik setiap frame: kamera, drone, hingga belakang panggung.</p>
    </div>

    <div class="vp-crew-stage" tabindex="0" role="region" aria-roledescription="carousel" aria-label="Foto behind the crew">
        <canvas class="vp-crew-canvas" aria-hidden="true"></canvas>
        <ul class="vp-crew-track">
            @foreach ($crewPhotos as $photo)
                <li class="vp-crew-item">
                    <img src="{{ $photo['src'] }}" alt="{{ $photo['alt'] }}" loading="lazy" decoding="async">
                </li>
            @endforeach
        </ul>
    </div>

    <div class="vp-crew-controls">
        <button type="button" class="vp-crew-button" data-crew-prev aria-label="Foto sebelumnya">&larr;</button>
        <span class="vp-crew-counter" aria-live="polite"><span data-crew-current>01</span> / {{ str_pad((string) $crewPhotoCount, 2, '0', STR_PAD_LEFT) }}</span>
        <button type="button" class="vp-crew-button" data-crew-next aria-label="Foto berikutnya">&rarr;</button>
        <span class="vp-crew-hint">Geser, scroll, atau klik foto</span>
    </div>
</section>

<script src="{{ asset('js/crew-carousel.js') }}?v={{ @filemtime(public_path('js/crew-carousel.js')) }}" defer></script>

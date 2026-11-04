{{--
    Kartu project kecil yang dipakai bersama oleh section Portofolio dan Corporate.

    Props:
    - name     (string)        Judul project.
    - images   (array<string>) Nama file di public/images, contoh: ['BIM1.webp', 'BIM2.webp'].
    - category (?string)       Kategori, tampil di metadata.
    - year     (?string|int)   Tahun, tampil di metadata setelah kategori.
    - size     (?string)       null (4/3), 'tall' (span 2 baris), atau 'wide' (span 2 kolom).

    Slider di dalam foto dikontrol oleh script .manual-slideshow di dashboard.
--}}
@props([
    'name',
    'images',
    'category' => null,
    'year' => null,
    'size' => null,
])

@php
    $metadata = implode(' · ', array_filter([$category, $year], fn ($value) => filled($value)));
    $imageCount = count($images);
@endphp

<article {{ $attributes->class(['vp-work', 'vp-work--tall' => $size === 'tall', 'vp-work--wide' => $size === 'wide']) }}>
    <div class="vp-work-media manual-slideshow">
        @foreach ($images as $image)
            <div @class(['manual-slide', 'manual-slide-active' => $loop->first]) role="img" aria-label="{{ $name }}, foto {{ $loop->iteration }}" style="background-image: url('{{ asset('images/'.$image) }}');"></div>
        @endforeach

        @if ($imageCount > 1)
            <button type="button" class="manual-arrow manual-arrow-prev vp-work-arrow" aria-label="Foto sebelumnya {{ $name }}">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M20 12H4M4 12L10 6M4 12L10 18" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <button type="button" class="manual-arrow manual-arrow-next vp-work-arrow" aria-label="Foto berikutnya {{ $name }}">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M4 12H20M20 12L14 6M20 12L14 18" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <span class="manual-counter vp-work-counter">1 / {{ $imageCount }}</span>
        @endif
    </div>

    <h3 class="vp-work-name">{{ $name }}</h3>

    @if ($metadata !== '')
        <p class="vp-work-meta">{{ $metadata }}</p>
    @endif
</article>

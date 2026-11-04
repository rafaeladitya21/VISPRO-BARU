{{--
    (1) Section CTA putih: judul masuk per huruf (public/js/contact-reveal.js).
    (2) Footer hitam dengan latar halftone wave (public/js/footer-halftone.js).
    Gaya: public/css/monochrome.css (bagian "CTA" dan "Footer").
--}}
@php
    /* url null = belum punya tautan; tampil sebagai teks biasa sampai diisi */
    $footerColumns = [
        'Navigasi' => [
            ['label' => 'Home', 'url' => url('/').'#top'],
            ['label' => 'Proyek', 'url' => url('/').'#proyek'],
            ['label' => 'About Us', 'url' => url('/').'#about-us'],
            ['label' => 'Lokasi', 'url' => url('/').'#lokasi'],
        ],
        'Kontak' => [
            ['label' => 'WhatsApp', 'url' => 'https://wa.me/6285746642358'],
            ['label' => 'Email', 'url' => 'mailto:info@visualproduction.id'],
            ['label' => 'Google Maps', 'url' => 'https://maps.app.goo.gl/8Pp2TXCEAbmMnhtN9'],
        ],
        'Sosial' => [
            ['label' => 'Instagram', 'url' => 'https://instagram.com/visualproduction.id'],
            ['label' => 'YouTube', 'url' => null],
            ['label' => 'TikTok', 'url' => null],
            ['label' => 'Facebook', 'url' => null],
        ],
    ];
@endphp

<section class="vp-contact" aria-labelledby="vp-contact-heading">
    <div class="vp-contact-inner">
        <h2 id="vp-contact-heading" class="vp-contact-heading">
            <span class="vp-contact-line">Punya event besar?</span>
            <span class="vp-contact-line vp-contact-line--muted">Mari kita bicarakan.</span>
        </h2>
        <a href="https://wa.me/6285746642358" target="_blank" rel="noopener" class="vp-contact-phone">0857 4664 2358 ↗</a>
    </div>
</section>

<footer class="vp-footer">
    <canvas class="vp-footer-canvas" aria-hidden="true"></canvas>

    <div class="vp-footer-main">
        <a href="{{ url('/') }}#top" class="vp-footer-logo" aria-label="Visual Production - kembali ke atas">
            <span class="vp-brand-logo">
                <img src="{{ asset('images/logo-vp.webp') }}" alt="Visual Production" class="vp-brand-logo-img">
            </span>
        </a>

        <div class="vp-footer-columns">
            @foreach ($footerColumns as $columnTitle => $links)
                <nav class="vp-footer-col" aria-label="{{ $columnTitle }}">
                    <h3 class="vp-footer-col-heading">{{ $columnTitle }}</h3>
                    <ul>
                        @foreach ($links as $link)
                            <li>
                                @if ($link['url'])
                                    <a href="{{ $link['url'] }}" @if (str_starts_with($link['url'], 'http')) target="_blank" rel="noopener" @endif>{{ $link['label'] }}</a>
                                @else
                                    <span class="vp-footer-link-pending">{{ $link['label'] }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </nav>
            @endforeach
        </div>
    </div>

    <div class="vp-footer-bottom">
        <span>&copy; {{ date('Y') }} Visual Production.id</span>
        <span>Divisi dari CV Han Media Tekindo</span>
    </div>
</footer>

<script src="{{ asset('js/contact-reveal.js') }}?v={{ @filemtime(public_path('js/contact-reveal.js')) }}" defer></script>
<script src="{{ asset('js/footer-halftone.js') }}?v={{ @filemtime(public_path('js/footer-halftone.js')) }}" defer></script>

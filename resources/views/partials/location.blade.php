{{--
    Section (05) Lokasi. Gaya: public/css/monochrome.css (bagian "(05) Lokasi").
--}}
@php
    /*
     * Alamat kantor. Isi 'street' (nama jalan + nomor) dan 'village' (desa);
     * selama masih null, baris Kantor hanya menampilkan "Jl. Sunan Bonang, Auri, Dengkol, Kec. Singosari, Kabupaten Malang, Jawa Timur 65153".
     */
    $officeAddress = [
        'street' => null,
        'village' => null,
        'region' => 'Jl. Sunan Bonang, Auri, Dengkol, Kec. Singosari, Kabupaten Malang, Jawa Timur 65153',
    ];

    $officeLines = $officeAddress['street']
        ? [$officeAddress['street'], implode(', ', array_filter([$officeAddress['village'], $officeAddress['region']]))]
        : [$officeAddress['region'], null];

    $locationInfo = [
        ['label' => 'Kantor', 'value' => $officeLines[0], 'sub' => $officeLines[1], 'href' => null],
        ['label' => 'WhatsApp', 'value' => '0857 4664 2358', 'sub' => null, 'href' => 'https://wa.me/6285746642358'],
        ['label' => 'Email', 'value' => 'info@visualproduction.id', 'sub' => null, 'href' => 'mailto:info@visualproduction.id'],
        ['label' => 'Instagram', 'value' => '@visualproduction.id', 'sub' => null, 'href' => 'https://instagram.com/visualproduction.id'],
    ];

    $mapsUrl = 'https://maps.app.goo.gl/8Pp2TXCEAbmMnhtN9';
@endphp

<section id="lokasi" class="vp-location" aria-labelledby="vp-location-heading">
    <div class="vp-section-label vp-location-label">
        <span>(05) Lokasi</span>
        <span>Malang, Jawa Timur</span>
    </div>

    <div class="vp-section-intro">
        <h2 id="vp-location-heading" class="vp-section-heading">Temukan kami di peta.</h2>
        <p class="vp-section-lead">Kunjungi Kantor kami untuk berdiskusi langsung tentang proyek Anda.</p>
    </div>

    <div class="vp-location-grid">
        <ul class="vp-info-list">
            @foreach ($locationInfo as $info)
                <li>
                    @if ($info['href'])
                        <a href="{{ $info['href'] }}" class="vp-info-row vp-info-row--link" @if (str_starts_with($info['href'], 'http')) target="_blank" rel="noopener" @endif>
                    @else
                        <div class="vp-info-row">
                    @endif
                        <span class="vp-info-label">{{ $info['label'] }}</span>
                        <span class="vp-info-content">
                            <span class="vp-info-value">{{ $info['value'] }}</span>
                            @if ($info['sub'])
                                <span class="vp-info-sub">{{ $info['sub'] }}</span>
                            @endif
                        </span>
                        <span class="vp-info-arrow" aria-hidden="true">
                            @if ($info['href'])
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                                    <path d="M3.5 10.5L10.5 3.5M10.5 3.5H4.5M10.5 3.5V9.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            @endif
                        </span>
                    @if ($info['href'])
                        </a>
                    @else
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>

        <figure class="vp-location-map">
            <div class="vp-location-map-frame">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.0!2d110.0!3d-7.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMDAnMDAuMCJTIDExMMKwMDAnMDAuMCJF!5e0!3m2!1sid!2sid!4v1700000000000"
                    title="Peta lokasi Visual Production"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    allowfullscreen></iframe>
            </div>
            <figcaption>
                <a href="{{ $mapsUrl }}" target="_blank" rel="noopener" class="vp-section-link">
                    Buka di Google Maps
                    <svg width="12" height="12" viewBox="0 0 14 14" fill="none" aria-hidden="true">
                        <path d="M3.5 10.5L10.5 3.5M10.5 3.5H4.5M10.5 3.5V9.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </figcaption>
        </figure>
    </div>
</section>

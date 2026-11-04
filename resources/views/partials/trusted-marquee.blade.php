{{--
    Dua baris marquee monokrom: nama klien (ke kiri) dan statistik (ke kanan).
    Animasi & hitungan angka: public/js/trusted-marquee.js. Gaya: public/css/monochrome.css.
--}}
@php
    /*
     * Klien. 'logo' opsional: file di public/images, ukuran asli [lebar, tinggi],
     * dan 'crop' [x, y, lebar, tinggi] = area isi logo (membuang ruang kosong di file).
     */
    $trustedClients = [
        ['name' => 'Universitas Terbuka', 'logo' => ['file' => 'ut.png', 'size' => [2580, 2048], 'crop' => [16, 0, 2540, 2028]]],
        ['name' => 'Bank Indonesia', 'logo' => ['file' => 'bank indonesia.webp', 'size' => [2201, 697], 'crop' => [1, 151, 2200, 395]]],
        ['name' => 'Bank BRI', 'logo' => ['file' => 'logo-bri.webp', 'size' => [1920, 3413], 'crop' => [34, 856, 1886, 1603]]],
        ['name' => 'BUMN Indonesia', 'logo' => ['file' => 'bumn.webp', 'size' => [960, 172], 'crop' => [0, 0, 960, 172]]],
        ['name' => 'Danantara Indonesia', 'logo' => ['file' => 'danantara.webp', 'size' => [550, 550], 'crop' => [22, 208, 505, 134]]],
        ['name' => 'Kemendikbud', 'logo' => ['file' => 'kemendikdasmen.png', 'size' => [1920, 364], 'crop' => [5, 5, 1915, 354]]],
    ];

    $logoHeight = 26;

    /** Hitung style background agar hanya area 'crop' yang tampil setinggi $logoHeight. */
    $logoStyle = function (array $logo) use ($logoHeight): string {
        [$imageWidth, $imageHeight] = $logo['size'];
        [$cropX, $cropY, $cropWidth, $cropHeight] = $logo['crop'];

        $boxWidth = round($logoHeight * $cropWidth / $cropHeight, 1);
        $sizeX = round($imageWidth / $cropWidth * 100, 2);
        $sizeY = round($imageHeight / $cropHeight * 100, 2);
        $positionX = $imageWidth > $cropWidth ? round($cropX / ($imageWidth - $cropWidth) * 100, 2) : 0;
        $positionY = $imageHeight > $cropHeight ? round($cropY / ($imageHeight - $cropHeight) * 100, 2) : 0;

        return "width: {$boxWidth}px; height: {$logoHeight}px; background-image: url('".asset('images/'.$logo['file'])."'); "
            ."background-size: {$sizeX}% {$sizeY}%; background-position: {$positionX}% {$positionY}%;";
    };

    /* value = angka akhir hitungan, suffix tetap ditampilkan di belakang angka */
    $trustedStats = [
        ['value' => 300, 'suffix' => '+', 'label' => 'project selesai'],
        ['value' => 99, 'suffix' => '+', 'label' => 'klien'],
        ['value' => 2, 'suffix' => '+', 'label' => 'tahun'],
    ];
@endphp

<section class="vp-trusted" aria-labelledby="vp-trusted-label">
    <div class="vp-section-label vp-trusted-label">
        <span id="vp-trusted-label">(04) Dipercaya oleh</span>
        <span>2022 — sekarang</span>
    </div>

    {{-- Baris 1: nama klien --}}
    <div class="vp-marquee" data-marquee-speed="0.45" data-marquee-direction="left">
        <div class="vp-marquee-track">
            @foreach ([false, true] as $isDuplicate)
                <ul class="vp-marquee-group vp-marquee-clients" @if ($isDuplicate) aria-hidden="true" @else aria-label="Klien" @endif>
                    @foreach ($trustedClients as $client)
                        <li class="vp-marquee-item vp-client">
                            {{-- Klien berlogo tampil logo saja; nama dibacakan pembaca layar lewat aria-label --}}
                            @if ($client['logo'])
                                <span class="vp-client-logo" role="img" aria-label="{{ $client['name'] }}" style="{{ $logoStyle($client['logo']) }}"></span>
                            @else
                                <span class="vp-client-name">{{ $client['name'] }}</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </div>

    {{-- Baris 2: statistik --}}
    <div class="vp-marquee vp-marquee--stats" data-marquee-speed="0.35" data-marquee-direction="right">
        <div class="vp-marquee-track">
            @foreach ([false, true] as $isDuplicate)
                <ul class="vp-marquee-group vp-marquee-stats" @if ($isDuplicate) aria-hidden="true" @else aria-label="Statistik" @endif>
                    @foreach ($trustedStats as $stat)
                        <li class="vp-marquee-item vp-stat">
                            <span class="vp-stat-value"><span class="vp-stat-count" data-count-to="{{ $stat['value'] }}">{{ $stat['value'] }}</span>{{ $stat['suffix'] }}</span>
                            <span class="vp-stat-caption">{{ $stat['label'] }}</span>
                            <span class="vp-stat-divider" aria-hidden="true">/</span>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </div>
</section>

<script src="{{ asset('js/trusted-marquee.js') }}?v={{ @filemtime(public_path('js/trusted-marquee.js')) }}" defer></script>

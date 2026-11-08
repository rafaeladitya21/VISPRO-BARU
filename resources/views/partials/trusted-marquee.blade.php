{{--
    Dua baris marquee monokrom: nama klien (ke kiri) dan statistik (ke kanan).
    Animasi & hitungan angka: public/js/trusted-marquee.js. Gaya: public/css/monochrome.css.
--}}
@php
    /*
     * Klien. 'logo' opsional: file di public/images, ukuran asli [lebar, tinggi],
     * dan 'crop' [x, y, lebar, tinggi] = area isi logo (membuang ruang kosong di file).
     * 'height' opsional (px) untuk logo bertumpuk/kotak agar tetap terbaca; default $logoHeight.
     */
    $trustedClients = [
        ['name' => 'Universitas Terbuka', 'logo' => ['file' => 'ut.png', 'size' => [2580, 2048], 'crop' => [16, 0, 2540, 2028]]],
        ['name' => 'Bank Indonesia', 'logo' => ['file' => 'bank indonesia.webp', 'size' => [2201, 697], 'crop' => [1, 151, 2200, 395]]],
        ['name' => 'Bank BRI', 'logo' => ['file' => 'logo-bri.webp', 'size' => [1920, 3413], 'crop' => [34, 856, 1886, 1603]]],
        ['name' => 'BUMN Indonesia', 'logo' => ['file' => 'bumn.webp', 'size' => [960, 172], 'crop' => [0, 0, 960, 172]]],
        ['name' => 'Danantara Indonesia', 'logo' => ['file' => 'danantara.webp', 'size' => [550, 550], 'crop' => [22, 208, 505, 134]]],
        ['name' => 'Kemendikbud', 'logo' => ['file' => 'kemendikdasmen.png', 'size' => [1920, 364], 'crop' => [5, 5, 1915, 354]]],
        /* Logo event & klien dari public/images/LOGO */
        ['name' => 'MAN 3 Malang', 'logo' => ['file' => 'LOGO/man-3-malang.webp', 'size' => [400, 400], 'crop' => [0, 0, 400, 400], 'height' => 44]],
        ['name' => 'Paradic Fest Vol. 3', 'logo' => ['file' => 'LOGO/paradic-fest-3.webp', 'size' => [591, 422], 'crop' => [0, 0, 591, 422], 'height' => 40]],
        ['name' => 'Sunset di Kebun', 'logo' => ['file' => 'LOGO/sunset-di-kebun.webp', 'size' => [328, 400], 'crop' => [1, 124, 327, 157], 'height' => 40]],
        ['name' => 'Dempo Fair XLVIII', 'logo' => ['file' => 'LOGO/dempo-fair.webp', 'size' => [1200, 377], 'crop' => [69, 40, 1061, 289], 'height' => 34]],
        ['name' => 'Good Day Schoolicious', 'logo' => ['file' => 'LOGO/good-day-schoolicious.webp', 'size' => [738, 249], 'crop' => [0, 15, 738, 234], 'height' => 34]],
        ['name' => 'Riuh Riang', 'logo' => ['file' => 'LOGO/riuh-riang.webp', 'size' => [1024, 448], 'crop' => [123, 34, 762, 380], 'height' => 40]],
        ['name' => 'Sayapmas Festival', 'logo' => ['file' => 'LOGO/sayapmas-festival.webp', 'size' => [447, 447], 'crop' => [24, 116, 413, 235], 'height' => 40]],
        ['name' => 'Signatureè 2026', 'logo' => ['file' => 'LOGO/signaturee-2026.webp', 'size' => [225, 225], 'crop' => [32, 66, 162, 92], 'height' => 40]],
        ['name' => 'We Hear UU', 'logo' => ['file' => 'LOGO/we-hear-uu.webp', 'size' => [867, 729], 'crop' => [0, 0, 867, 729], 'height' => 40]],
        ['name' => 'RED UV', 'logo' => ['file' => 'LOGO/red-uv.webp', 'size' => [447, 116], 'crop' => [32, 8, 408, 100]]],
        ['name' => 'Osskit Entertainment', 'logo' => ['file' => 'LOGO/osskit.webp', 'size' => [150, 150], 'crop' => [1, 41, 128, 63], 'height' => 34]],
    ];

    $logoHeight = 26;

    /** Hitung style background agar hanya area 'crop' yang tampil setinggi 'height' (default $logoHeight). */
    $logoStyle = function (array $logo) use ($logoHeight): string {
        [$imageWidth, $imageHeight] = $logo['size'];
        [$cropX, $cropY, $cropWidth, $cropHeight] = $logo['crop'];
        $logoHeight = $logo['height'] ?? $logoHeight;

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

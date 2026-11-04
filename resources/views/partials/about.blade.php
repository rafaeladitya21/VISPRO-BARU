{{--
    Section About Us (gaya editorial). Gaya & animasi masuk: public/css/monochrome.css (bagian "(03) Tentang kami").
    Animasi dipicu sekali oleh script di bawah dengan menambahkan class "is-visible".
--}}
@php
    $aboutStatementLines = [
        ['text' => 'Kami mengabadikan momen terbesar', 'muted' => false],
        ['text' => 'di panggung-panggung terbaik Indonesia.', 'muted' => false],
        ['text' => 'Konser, festival, hingga acara kenegaraan,', 'muted' => true],
        ['text' => 'dikerjakan dengan standar produksi profesional.', 'muted' => true],
    ];

    $aboutServices = [
        ['name' => 'Livecam dan multicam', 'note' => 'Untuk layar panggung'],
        ['name' => 'Live streaming', 'note' => 'YouTube, Zoom, dan platform lain'],
        ['name' => 'After movie', 'note' => 'Video rangkuman event'],
        ['name' => 'Visual bumper', 'note' => 'Opening dan transisi acara'],
        ['name' => 'Visual jockey', 'note' => 'Visual live mengikuti musik'],
        ['name' => 'Video drone', 'note' => 'Pengambilan gambar udara'],
    ];

    $statementFor = fn (bool $muted) => implode(' ', array_column(array_filter($aboutStatementLines, fn ($line) => $line['muted'] === $muted), 'text'));
@endphp

<section id="about-us" class="vp-about" aria-labelledby="vp-about-heading">
    <div class="vp-section-label vp-about-label">
        <span>(03) Tentang kami</span>
        <span>Malang, Jawa Timur</span>
    </div>

    <div class="vp-about-grid">
        <figure class="vp-about-figure">
            <div class="vp-about-photo">
                <img src="{{ asset('images/foto-team.webp') }}" alt="Tim Visual Production" loading="lazy">
            </div>
            <figcaption class="vp-about-caption">Tim Visual Production di belakang panggung.</figcaption>
        </figure>

        <div class="vp-about-body">
            <h2 id="vp-about-heading" class="vp-about-statement">
                <span class="vp-visually-hidden">{{ $statementFor(false) }} {{ $statementFor(true) }}</span>

                {{-- Desktop: dipecah per baris untuk animasi --}}
                <span class="vp-about-lines" aria-hidden="true">
                    @foreach ($aboutStatementLines as $line)
                        <span @class(['vp-line', 'vp-line--muted' => $line['muted']]) style="--line-index: {{ $loop->index }};"><span>{{ $line['text'] }}</span></span>
                    @endforeach
                </span>

                {{-- Mobile: satu paragraf biasa --}}
                <span class="vp-about-flow" aria-hidden="true">
                    {{ $statementFor(false) }} <span class="vp-about-flow-muted">{{ $statementFor(true) }}</span>
                </span>
            </h2>

            <p class="vp-about-text">
                Visual Production adalah divisi dari CV Han Media Tekindo. Kami sudah bekerja untuk kampus, bank,
                instansi pemerintah, sampai festival musik, dan kami ikut turun sendiri ke lapangan di setiap project.
            </p>

            <ul class="vp-services" aria-label="Layanan">
                @foreach ($aboutServices as $service)
                    <li class="vp-service" style="--row-index: {{ $loop->index }};">
                        <span class="vp-service-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="vp-service-name">{{ $service['name'] }}</span>
                        <span class="vp-service-note">{{ $service['note'] }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

</section>

<script>
    (function () {
        const section = document.getElementById('about-us');
        if (!section) return;

        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (prefersReducedMotion || !('IntersectionObserver' in window)) {
            section.classList.add('is-visible', 'is-settled');
            return;
        }

        /* Sembunyikan elemen hanya jika JS berjalan, agar konten tetap tampil tanpa JS */
        section.classList.add('js-reveal');

        /* Durasi total animasi baris layanan: 1.05s + 5 x 0.07s + 0.9s garis bawah */
        const ENTRY_DURATION_MS = 2400;

        const observer = new IntersectionObserver((entries) => {
            if (!entries[0].isIntersecting) return;
            observer.disconnect();
            section.classList.add('is-visible');

            /* Setelah animasi masuk selesai, hapus delay agar hover tidak tertunda */
            setTimeout(() => section.classList.add('is-settled'), ENTRY_DURATION_MS);
        }, { threshold: 0.2 });

        observer.observe(section);
    })();
</script>

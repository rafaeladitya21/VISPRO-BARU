/**
 * Animasi masuk section CTA: judul dipecah per huruf (fade+blur dan gelombang),
 * lalu nomor telepon fade-up. Dipicu sekali saat section 35% terlihat.
 * Markup: resources/views/partials/footer.blade.php (.vp-contact).
 */
(function () {
    const section = document.querySelector('.vp-contact');
    const heading = section ? section.querySelector('.vp-contact-heading') : null;
    if (!section || !heading) return;

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    if (!('IntersectionObserver' in window)) return;

    /* Jeda tambahan antar baris, dalam satuan huruf (5 x 40ms = 200ms) */
    const LINE_PAUSE_STEPS = 5;
    let characterIndex = 0;

    heading.setAttribute('aria-label', heading.textContent.replace(/\s+/g, ' ').trim());

    heading.querySelectorAll('.vp-contact-line').forEach(function (line, lineIndex) {
        if (lineIndex > 0) {
            characterIndex += LINE_PAUSE_STEPS;
        }

        const words = line.textContent.trim().split(/\s+/);
        line.textContent = '';

        words.forEach(function (word, wordIndex) {
            const wordSpan = document.createElement('span');
            wordSpan.className = 'vp-contact-word';
            wordSpan.setAttribute('aria-hidden', 'true');

            Array.from(word).forEach(function (character) {
                const characterSpan = document.createElement('span');
                characterSpan.className = 'vp-contact-char';
                characterSpan.style.setProperty('--i', characterIndex++);
                characterSpan.textContent = character;
                wordSpan.appendChild(characterSpan);
            });

            line.appendChild(wordSpan);

            if (wordIndex < words.length - 1) {
                line.appendChild(document.createTextNode(' '));
                characterIndex++;
            }
        });
    });

    section.classList.add('vp-contact--animate');

    const observer = new IntersectionObserver(function (entries) {
        if (!entries[0].isIntersecting) return;
        section.classList.add('is-visible');
        observer.disconnect();
    }, { threshold: 0.35 });

    observer.observe(section);
})();

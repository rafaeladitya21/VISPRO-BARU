/**
 * Section (06) Behind the crew: carousel WebGL dengan "liquid lens" di tengah.
 * Versi vanilla dari FlexCarousel preset "liquid" (intro "rise", curl "twist").
 * - Foto di dalam lensa membesar (lensHeight) dan berwarna; di luar lensa dipadatkan (squeeze) dan abu-abu.
 * - Strip melengkung (bend), menjauh (reach), berputar ala coverflow + twist (tilt).
 * - Pass kedua: pembiasan + dispersi warna di tepi lensa (dispersion).
 * Fallback (tanpa WebGL / prefers-reduced-motion): strip <img> scroll-snap biasa.
 * Markup: resources/views/partials/crew.blade.php
 */
(function () {
    const section = document.querySelector('.vp-crew');
    if (!section) return;

    const CONFIG = {
        cardHeight: 0.5,   // tinggi kartu relatif tinggi stage
        gap: 12,           // jarak antar kartu (px)
        squeeze: 0.2,      // pemadatan kartu di luar lensa
        lensWidth: 0.74,   // lebar lensa relatif lebar stage
        lensHeight: 1.18,  // perbesaran di dalam lensa
        tilt: 62,          // derajat putaran kartu di tepi
        twist: 0.3,        // porsi tilt untuk curl "twist"
        bend: 0.34,        // lengkung strip
        reach: 0.38,       // seberapa jauh kartu tepi menjauh
        dispersion: 0.45,  // pemisahan warna di tepi lensa
        captureWheel: true,
        startIndex: 3,
    };

    const stage = section.querySelector('.vp-crew-stage');
    const canvas = section.querySelector('.vp-crew-canvas');
    const track = section.querySelector('.vp-crew-track');
    const sources = Array.from(track.querySelectorAll('img')).map((img) => img.currentSrc || img.src);
    const prevButton = section.querySelector('[data-crew-prev]');
    const nextButton = section.querySelector('[data-crew-next]');
    const currentLabel = section.querySelector('[data-crew-current]');
    const total = sources.length;
    const pad = (number) => String(number).padStart(2, '0');

    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* ---------- Fallback: strip scroll-snap ---------- */
    function setupFallback() {
        const items = Array.from(track.children);
        const nearestIndex = () => {
            const center = track.scrollLeft + track.clientWidth / 2;
            let best = 0;
            items.forEach((item, index) => {
                const itemCenter = item.offsetLeft + item.offsetWidth / 2;
                const bestCenter = items[best].offsetLeft + items[best].offsetWidth / 2;
                if (Math.abs(itemCenter - center) < Math.abs(bestCenter - center)) best = index;
            });
            return best;
        };
        const goTo = (index) => {
            const item = items[Math.max(0, Math.min(total - 1, index))];
            track.scrollTo({ left: item.offsetLeft + item.offsetWidth / 2 - track.clientWidth / 2, behavior: reduceMotion ? 'auto' : 'smooth' });
        };
        prevButton.addEventListener('click', () => goTo(nearestIndex() - 1));
        nextButton.addEventListener('click', () => goTo(nearestIndex() + 1));
        track.addEventListener('scroll', () => { currentLabel.textContent = pad(nearestIndex() + 1); }, { passive: true });
    }

    if (reduceMotion) {
        setupFallback();
        return;
    }

    const glOptions = { alpha: false, antialias: true, premultipliedAlpha: true };
    const gl = canvas.getContext('webgl2', glOptions) || canvas.getContext('webgl', glOptions);
    if (!gl) {
        setupFallback();
        return;
    }
    const isWebGL2 = typeof WebGL2RenderingContext !== 'undefined' && gl instanceof WebGL2RenderingContext;

    /* ---------- Shader ---------- */
    const TANH = 'float tanhApprox(float x){ x = clamp(x, -9.0, 9.0); float e = exp(2.0 * x); return (e - 1.0) / (e + 1.0); }';

    const cardVertex = `
        attribute vec2 aPos;
        uniform vec2 uStage;
        uniform vec2 uSize;
        uniform float uCenter, uR, uA, uB, uBend, uReach, uTilt, uTwist, uDepth, uRise;
        varying vec2 vUv;
        varying float vLens;
        varying float vFar;
        ${TANH}
        float mapX(float x){ return x * uA + (uB - uA) * uR * tanhApprox(x / uR); }
        void main(){
            float x = uCenter + (aPos.x - 0.5) * uSize.x;
            float y = (aPos.y - 0.5) * uSize.y;
            float t = tanhApprox(x / uR);
            float lens = 1.0 - t * t;
            float tc = tanhApprox(uCenter / uR);
            float far = tc * tc;
            float xc = mapX(uCenter);
            float local = mapX(x) - xc;
            float xn = clamp(xc / (uStage.x * 0.5), -1.0, 1.0);

            float theta = uTilt * xn * far;
            float X = xc + local * cos(theta);
            float Z = -local * sin(theta);

            float Y = y * mix(1.0, uB, lens);
            float phi = uTwist * xn * far;
            Z += Y * sin(phi);
            Y = Y * cos(phi);

            Z -= uReach * uStage.x * 0.5 * far * abs(xn);
            Y += uBend * uSize.y * xn * xn;
            Y -= (1.0 - uRise) * uStage.y * 0.7;

            float p = uDepth / (uDepth - Z);
            gl_Position = vec4(vec2(X, Y) * p / (uStage * 0.5), 0.0, 1.0);
            vUv = vec2(aPos.x, 1.0 - aPos.y);
            vLens = lens;
            vFar = clamp(far * abs(xn), 0.0, 1.0);
        }`;

    const cardFragment = `
        precision mediump float;
        uniform sampler2D uTex;
        uniform float uAlpha;
        uniform vec3 uBg;
        varying vec2 vUv;
        varying float vLens;
        varying float vFar;
        void main(){
            vec3 color = texture2D(uTex, vUv).rgb;
            float gray = dot(color, vec3(0.299, 0.587, 0.114));
            color = mix(vec3(gray), color, smoothstep(0.35, 0.9, vLens));
            color = mix(color, uBg, vFar * 0.35);
            gl_FragColor = vec4(color * uAlpha, uAlpha);
        }`;

    const postVertex = `
        attribute vec2 aPos;
        varying vec2 vUv;
        void main(){ vUv = aPos; gl_Position = vec4(aPos * 2.0 - 1.0, 0.0, 1.0); }`;

    const postFragment = `
        precision mediump float;
        uniform sampler2D uScene;
        uniform vec2 uRes;
        uniform float uR, uDisp, uDpr;
        uniform vec3 uBg;
        varying vec2 vUv;
        ${TANH}
        vec3 sampleOverBg(vec2 uv){ vec4 c = texture2D(uScene, uv); return c.rgb + (1.0 - c.a) * uBg; }
        void main(){
            float x = (vUv.x - 0.5) * uRes.x / uDpr;
            float t = tanhApprox(x / uR);
            float edge = pow(clamp(abs(t) * (1.0 - t * t) * 2.6, 0.0, 1.0), 6.0);
            float dir = sign(x);
            float px = uDpr / uRes.x;
            vec2 uv = vUv - vec2(dir * uDisp * edge * 10.0 * px, 0.0);
            vec2 shift = vec2(dir * uDisp * edge * 9.0 * px, 0.0);
            float r = sampleOverBg(uv + shift).r;
            float g = sampleOverBg(uv).g;
            float b = sampleOverBg(uv - shift).b;
            gl_FragColor = vec4(r, g, b, 1.0);
        }`;

    function compile(type, source) {
        const shader = gl.createShader(type);
        gl.shaderSource(shader, source);
        gl.compileShader(shader);
        if (!gl.getShaderParameter(shader, gl.COMPILE_STATUS)) throw new Error(gl.getShaderInfoLog(shader));
        return shader;
    }

    function program(vertexSource, fragmentSource) {
        const prog = gl.createProgram();
        gl.attachShader(prog, compile(gl.VERTEX_SHADER, vertexSource));
        gl.attachShader(prog, compile(gl.FRAGMENT_SHADER, fragmentSource));
        gl.linkProgram(prog);
        if (!gl.getProgramParameter(prog, gl.LINK_STATUS)) throw new Error(gl.getProgramInfoLog(prog));
        const uniforms = {};
        const count = gl.getProgramParameter(prog, gl.ACTIVE_UNIFORMS);
        for (let i = 0; i < count; i++) {
            const name = gl.getActiveUniform(prog, i).name;
            uniforms[name] = gl.getUniformLocation(prog, name);
        }
        return { prog, uniforms, aPos: gl.getAttribLocation(prog, 'aPos') };
    }

    let cardProgram;
    let postProgram;
    try {
        cardProgram = program(cardVertex, cardFragment);
        postProgram = program(postVertex, postFragment);
    } catch (error) {
        setupFallback();
        return;
    }

    section.classList.add('vp-crew--gl');

    /* ---------- Geometri: grid 32x8 untuk kartu, quad untuk post-pass ---------- */
    const SEGMENTS_X = 32;
    const SEGMENTS_Y = 8;
    const gridVertices = [];
    for (let j = 0; j <= SEGMENTS_Y; j++) {
        for (let i = 0; i <= SEGMENTS_X; i++) gridVertices.push(i / SEGMENTS_X, j / SEGMENTS_Y);
    }
    const gridIndices = [];
    for (let j = 0; j < SEGMENTS_Y; j++) {
        for (let i = 0; i < SEGMENTS_X; i++) {
            const a = j * (SEGMENTS_X + 1) + i;
            const b = a + SEGMENTS_X + 1;
            gridIndices.push(a, b, a + 1, a + 1, b, b + 1);
        }
    }
    const gridBuffer = gl.createBuffer();
    gl.bindBuffer(gl.ARRAY_BUFFER, gridBuffer);
    gl.bufferData(gl.ARRAY_BUFFER, new Float32Array(gridVertices), gl.STATIC_DRAW);
    const indexBuffer = gl.createBuffer();
    gl.bindBuffer(gl.ELEMENT_ARRAY_BUFFER, indexBuffer);
    gl.bufferData(gl.ELEMENT_ARRAY_BUFFER, new Uint16Array(gridIndices), gl.STATIC_DRAW);

    const quadBuffer = gl.createBuffer();
    gl.bindBuffer(gl.ARRAY_BUFFER, quadBuffer);
    gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([0, 0, 1, 0, 0, 1, 0, 1, 1, 0, 1, 1]), gl.STATIC_DRAW);

    /* ---------- Tekstur ---------- */
    function makeTexture(source) {
        const texture = gl.createTexture();
        gl.bindTexture(gl.TEXTURE_2D, texture);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_S, gl.CLAMP_TO_EDGE);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_T, gl.CLAMP_TO_EDGE);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, gl.LINEAR);
        if (source) {
            gl.texImage2D(gl.TEXTURE_2D, 0, gl.RGBA, gl.RGBA, gl.UNSIGNED_BYTE, source);
            if (isWebGL2) {
                gl.generateMipmap(gl.TEXTURE_2D);
                gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, gl.LINEAR_MIPMAP_LINEAR);
            } else {
                gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, gl.LINEAR);
            }
        } else {
            gl.texImage2D(gl.TEXTURE_2D, 0, gl.RGBA, 1, 1, 0, gl.RGBA, gl.UNSIGNED_BYTE, new Uint8Array([228, 228, 228, 255]));
            gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, gl.LINEAR);
        }
        return texture;
    }

    const placeholderTexture = makeTexture(null);
    const cards = sources.map(() => ({ texture: placeholderTexture, aspect: 1.5, width: 0, center: 0 }));
    let texturesReady = false;

    function loadTextures() {
        if (loadTextures.started) return;
        loadTextures.started = true;
        const loads = sources.map((src, index) => new Promise((resolve) => {
            const image = new Image();
            image.decoding = 'async';
            image.onload = () => {
                cards[index].texture = makeTexture(image);
                cards[index].aspect = image.naturalWidth / image.naturalHeight;
                resolve();
            };
            image.onerror = resolve;
            image.src = src;
        }));
        Promise.all(loads).then(() => {
            texturesReady = true;
            layout();
            scroll.current = scroll.target = cards[activeIndex].center;
            requestRender();
        });
    }

    /* ---------- Framebuffer untuk post-pass ---------- */
    let sceneTexture = null;
    let framebuffer = null;

    function resizeFramebuffer(width, height) {
        if (sceneTexture) gl.deleteTexture(sceneTexture);
        if (framebuffer) gl.deleteFramebuffer(framebuffer);
        sceneTexture = gl.createTexture();
        gl.bindTexture(gl.TEXTURE_2D, sceneTexture);
        gl.texImage2D(gl.TEXTURE_2D, 0, gl.RGBA, width, height, 0, gl.RGBA, gl.UNSIGNED_BYTE, null);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, gl.LINEAR);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, gl.LINEAR);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_S, gl.CLAMP_TO_EDGE);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_T, gl.CLAMP_TO_EDGE);
        framebuffer = gl.createFramebuffer();
        gl.bindFramebuffer(gl.FRAMEBUFFER, framebuffer);
        gl.framebufferTexture2D(gl.FRAMEBUFFER, gl.COLOR_ATTACHMENT0, gl.TEXTURE_2D, sceneTexture, 0);
        gl.bindFramebuffer(gl.FRAMEBUFFER, null);
    }

    /* ---------- Layout ---------- */
    const view = { width: 0, height: 0, dpr: 1, cardHeight: 0, lensRadius: 0 };
    const background = [1, 1, 1];
    let activeIndex = Math.min(CONFIG.startIndex, total - 1);
    const scroll = { current: 0, target: 0 };

    function readBackground() {
        let element = section;
        while (element) {
            const match = getComputedStyle(element).backgroundColor.match(/[\d.]+/g);
            if (match && (match.length < 4 || parseFloat(match[3]) > 0)) {
                background[0] = match[0] / 255;
                background[1] = match[1] / 255;
                background[2] = match[2] / 255;
                return;
            }
            element = element.parentElement;
        }
    }

    function layout() {
        const rect = stage.getBoundingClientRect();
        view.width = rect.width;
        view.height = rect.height;
        view.dpr = Math.min(window.devicePixelRatio || 1, 2);
        view.cardHeight = Math.min(view.height * CONFIG.cardHeight, view.width * 0.4);
        view.lensRadius = Math.max(CONFIG.lensWidth * view.width * 0.35, view.cardHeight * 0.9);

        const pixelWidth = Math.max(1, Math.round(view.width * view.dpr));
        const pixelHeight = Math.max(1, Math.round(view.height * view.dpr));
        if (canvas.width !== pixelWidth || canvas.height !== pixelHeight) {
            canvas.width = pixelWidth;
            canvas.height = pixelHeight;
            resizeFramebuffer(pixelWidth, pixelHeight);
        }

        let cursor = 0;
        cards.forEach((card, index) => {
            card.width = view.cardHeight * card.aspect;
            if (index > 0) cursor += cards[index - 1].width / 2 + CONFIG.gap + card.width / 2;
            card.center = cursor;
        });
    }

    /* ---------- Proyeksi di JS (sama dengan vertex shader, y = 0) untuk klik ---------- */
    const lensScale = () => CONFIG.lensHeight;
    const outerScale = () => 1 - CONFIG.squeeze;

    function mapX(x) {
        return x * outerScale() + (lensScale() - outerScale()) * view.lensRadius * Math.tanh(x / view.lensRadius);
    }

    function projectX(relativeCenter, localX) {
        const tc = Math.tanh(relativeCenter / view.lensRadius);
        const far = tc * tc;
        const xc = mapX(relativeCenter);
        const local = mapX(relativeCenter + localX) - xc;
        const xn = Math.max(-1, Math.min(1, xc / (view.width / 2)));
        const theta = (CONFIG.tilt * Math.PI / 180) * xn * far;
        const X = xc + local * Math.cos(theta);
        const Z = -local * Math.sin(theta) - CONFIG.reach * view.width * 0.5 * far * Math.abs(xn);
        const depth = view.height * 1.8;
        return X * depth / (depth - Z);
    }

    function cardAtScreenX(screenX) {
        let hit = -1;
        let bestDistance = Infinity;
        cards.forEach((card, index) => {
            const relative = card.center - scroll.current;
            const left = projectX(relative, -card.width / 2);
            const right = projectX(relative, card.width / 2);
            if (screenX >= Math.min(left, right) && screenX <= Math.max(left, right) && Math.abs(relative) < bestDistance) {
                bestDistance = Math.abs(relative);
                hit = index;
            }
        });
        return hit;
    }

    /* ---------- Navigasi ---------- */
    const clampScroll = (value) => Math.max(cards[0].center, Math.min(cards[total - 1].center, value));

    function nearestIndex(position) {
        let best = 0;
        cards.forEach((card, index) => {
            if (Math.abs(card.center - position) < Math.abs(cards[best].center - position)) best = index;
        });
        return best;
    }

    function goTo(index) {
        activeIndex = Math.max(0, Math.min(total - 1, index));
        scroll.target = cards[activeIndex].center;
        requestRender();
    }

    function snap() {
        goTo(nearestIndex(scroll.target));
    }

    prevButton.addEventListener('click', () => goTo(nearestIndex(scroll.target) - 1));
    nextButton.addEventListener('click', () => goTo(nearestIndex(scroll.target) + 1));

    stage.addEventListener('keydown', (event) => {
        if (event.key === 'ArrowLeft' || event.key === 'ArrowRight') {
            event.preventDefault();
            goTo(nearestIndex(scroll.target) + (event.key === 'ArrowRight' ? 1 : -1));
        }
    });

    /* Drag + inersia; klik tanpa geser = fokus ke foto itu */
    const drag = { active: false, pointerId: null, startX: 0, startTarget: 0, lastX: 0, lastTime: 0, velocity: 0, moved: 0 };

    stage.addEventListener('pointerdown', (event) => {
        if (event.button !== 0) return;
        drag.active = true;
        drag.pointerId = event.pointerId;
        drag.startX = drag.lastX = event.clientX;
        drag.startTarget = scroll.target;
        drag.lastTime = performance.now();
        drag.velocity = 0;
        drag.moved = 0;
        stage.setPointerCapture(event.pointerId);
        stage.classList.add('is-dragging');
    });

    stage.addEventListener('pointermove', (event) => {
        if (!drag.active || event.pointerId !== drag.pointerId) return;
        const now = performance.now();
        const dx = event.clientX - drag.startX;
        drag.moved = Math.max(drag.moved, Math.abs(dx));
        const factor = 1 / lensScale();
        scroll.target = clampScroll(drag.startTarget - dx * factor);
        const elapsed = Math.max(1, now - drag.lastTime);
        drag.velocity = ((event.clientX - drag.lastX) / elapsed) * factor;
        drag.lastX = event.clientX;
        drag.lastTime = now;
        requestRender();
    });

    function endDrag(event) {
        if (!drag.active || event.pointerId !== drag.pointerId) return;
        drag.active = false;
        stage.classList.remove('is-dragging');
        if (drag.moved < 6) {
            const rect = stage.getBoundingClientRect();
            const index = cardAtScreenX(event.clientX - rect.left - rect.width / 2);
            if (index >= 0) goTo(index);
            return;
        }
        const MAX_FLING_VELOCITY = 2.5;
        const velocity = Math.max(-MAX_FLING_VELOCITY, Math.min(MAX_FLING_VELOCITY, drag.velocity));
        scroll.target = clampScroll(scroll.target - velocity * 220);
        snap();
    }

    stage.addEventListener('pointerup', endDrag);
    stage.addEventListener('pointercancel', endDrag);

    /* Wheel: geser carousel; di ujung awal/akhir scroll halaman diteruskan */
    let wheelSnapTimer = null;
    if (CONFIG.captureWheel) {
        stage.addEventListener('wheel', (event) => {
            const delta = Math.abs(event.deltaX) > Math.abs(event.deltaY) ? event.deltaX : event.deltaY;
            const atStart = scroll.target <= cards[0].center + 1 && delta < 0;
            const atEnd = scroll.target >= cards[total - 1].center - 1 && delta > 0;
            if (atStart || atEnd) return;
            event.preventDefault();
            scroll.target = clampScroll(scroll.target + delta * 0.9);
            clearTimeout(wheelSnapTimer);
            wheelSnapTimer = setTimeout(snap, 160);
            requestRender();
        }, { passive: false });
    }

    /* ---------- Render ---------- */
    const rise = { start: null, duration: 1100, stagger: 70 };
    let isOnScreen = false;
    let frameRequested = false;

    function requestRender() {
        if (frameRequested || !isOnScreen) return;
        frameRequested = true;
        requestAnimationFrame(render);
    }

    const easeOutCubic = (t) => 1 - Math.pow(1 - t, 3);

    function render(now) {
        frameRequested = false;
        if (!view.width) layout();

        scroll.current += (scroll.target - scroll.current) * 0.12;
        if (Math.abs(scroll.target - scroll.current) < 0.05) scroll.current = scroll.target;

        const shownIndex = nearestIndex(scroll.current);
        const label = pad(shownIndex + 1);
        if (currentLabel.textContent !== label) currentLabel.textContent = label;

        /* Pass 1: kartu ke framebuffer */
        gl.bindFramebuffer(gl.FRAMEBUFFER, framebuffer);
        gl.viewport(0, 0, canvas.width, canvas.height);
        gl.clearColor(0, 0, 0, 0);
        gl.clear(gl.COLOR_BUFFER_BIT);
        gl.enable(gl.BLEND);
        gl.blendFunc(gl.ONE, gl.ONE_MINUS_SRC_ALPHA);

        const card = cardProgram;
        gl.useProgram(card.prog);
        gl.bindBuffer(gl.ARRAY_BUFFER, gridBuffer);
        gl.bindBuffer(gl.ELEMENT_ARRAY_BUFFER, indexBuffer);
        gl.enableVertexAttribArray(card.aPos);
        gl.vertexAttribPointer(card.aPos, 2, gl.FLOAT, false, 0, 0);

        const u = card.uniforms;
        gl.uniform2f(u.uStage, view.width, view.height);
        gl.uniform1f(u.uR, view.lensRadius);
        gl.uniform1f(u.uA, outerScale());
        gl.uniform1f(u.uB, lensScale());
        gl.uniform1f(u.uBend, CONFIG.bend);
        gl.uniform1f(u.uReach, CONFIG.reach);
        gl.uniform1f(u.uTilt, CONFIG.tilt * Math.PI / 180);
        gl.uniform1f(u.uTwist, CONFIG.tilt * CONFIG.twist * Math.PI / 180);
        gl.uniform1f(u.uDepth, view.height * 1.8);
        gl.uniform3f(u.uBg, background[0], background[1], background[2]);
        gl.uniform1i(u.uTex, 0);
        gl.activeTexture(gl.TEXTURE0);

        let rising = false;
        const order = cards
            .map((entry, index) => ({ entry, index, relative: entry.center - scroll.current }))
            .filter(({ relative, entry }) => Math.abs(mapX(relative)) < view.width * 0.75 + entry.width)
            .sort((a, b) => Math.abs(b.relative) - Math.abs(a.relative));

        order.forEach(({ entry, index, relative }) => {
            let progress = 1;
            if (rise.start === null) {
                progress = 0;
            } else {
                const delay = Math.abs(index - activeIndex) * rise.stagger;
                progress = Math.min(1, Math.max(0, (now - rise.start - delay) / rise.duration));
                if (progress < 1) rising = true;
            }
            const eased = easeOutCubic(progress);
            if (eased <= 0) return;
            gl.uniform1f(u.uCenter, relative);
            gl.uniform2f(u.uSize, entry.width, view.cardHeight);
            gl.uniform1f(u.uRise, eased);
            gl.uniform1f(u.uAlpha, Math.min(1, eased * 1.4));
            gl.bindTexture(gl.TEXTURE_2D, entry.texture);
            gl.drawElements(gl.TRIANGLES, gridIndices.length, gl.UNSIGNED_SHORT, 0);
        });

        /* Pass 2: pembiasan + dispersi ke layar */
        gl.bindFramebuffer(gl.FRAMEBUFFER, null);
        gl.disable(gl.BLEND);
        gl.useProgram(postProgram.prog);
        gl.bindBuffer(gl.ARRAY_BUFFER, quadBuffer);
        gl.enableVertexAttribArray(postProgram.aPos);
        gl.vertexAttribPointer(postProgram.aPos, 2, gl.FLOAT, false, 0, 0);
        const p = postProgram.uniforms;
        gl.uniform2f(p.uRes, canvas.width, canvas.height);
        gl.uniform1f(p.uR, view.lensRadius * lensScale());
        gl.uniform1f(p.uDisp, CONFIG.dispersion);
        gl.uniform1f(p.uDpr, view.dpr);
        gl.uniform3f(p.uBg, background[0], background[1], background[2]);
        gl.uniform1i(p.uScene, 0);
        gl.bindTexture(gl.TEXTURE_2D, sceneTexture);
        gl.drawArrays(gl.TRIANGLES, 0, 6);

        const settling = Math.abs(scroll.target - scroll.current) > 0.05;
        if (settling || rising || drag.active) requestRender();
    }

    /* ---------- Siklus hidup ---------- */
    readBackground();
    layout();
    scroll.current = scroll.target = cards[activeIndex].center;

    new ResizeObserver(() => {
        layout();
        scroll.target = clampScroll(scroll.target);
        scroll.current = clampScroll(scroll.current);
        requestRender();
    }).observe(stage);

    /* Muat tekstur sebelum section terlihat; render hanya saat di layar */
    new IntersectionObserver((entries) => {
        if (entries[0].isIntersecting) loadTextures();
    }, { rootMargin: '800px 0px' }).observe(section);

    new IntersectionObserver((entries) => {
        isOnScreen = entries[0].isIntersecting;
        if (isOnScreen) {
            loadTextures();
            requestRender();
        }
    }).observe(stage);

    /* Intro "rise": mulai saat stage 30% terlihat dan tekstur siap */
    const riseObserver = new IntersectionObserver((entries) => {
        if (!entries[0].isIntersecting) return;
        const begin = () => {
            if (!texturesReady) {
                setTimeout(begin, 100);
                return;
            }
            rise.start = performance.now();
            requestRender();
        };
        begin();
        riseObserver.disconnect();
    }, { threshold: 0.3 });
    riseObserver.observe(stage);
})();

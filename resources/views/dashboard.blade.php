<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visual Production - Jasa Foto Video Event Malang</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gloock&family=JetBrains+Mono:wght@400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        html {
            scroll-behavior: smooth;
            scroll-padding-top: 80px;
        }

        html, body {
            overflow-x: hidden;
            max-width: 100%;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #0a1428;
            color: #ffffff;
            width: 100%;
            position: relative;
        }

        /* ========== POP-UP ANIMATION FOR SECTIONS ========== */
        .popup-anim {
            opacity: 0;
            transform: translateY(80px) scale(0.95);
            transition: opacity 0.9s cubic-bezier(0.16, 1, 0.3, 1),
                        transform 0.9s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .popup-anim.popup-visible {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        /* Variasi pop up - dari kiri */
        .popup-left {
            transform: translateX(-100px) scale(0.95);
            opacity: 0;
        }
        .popup-left.popup-visible {
            transform: translateX(0) scale(1);
            opacity: 1;
        }

        /* Variasi pop up - dari kanan */
        .popup-right {
            transform: translateX(100px) scale(0.95);
            opacity: 0;
        }
        .popup-right.popup-visible {
            transform: translateX(0) scale(1);
            opacity: 1;
        }

        /* Variasi pop up - zoom in */
        .popup-zoom {
            transform: scale(0.7);
            opacity: 0;
        }
        .popup-zoom.popup-visible {
            transform: scale(1);
            opacity: 1;
        }

        /* Variasi pop up - simple fade (untuk CEO/Co-Hero cards) */
        .popup-fade {
            opacity: 0;
            transition: opacity 0.6s ease;
        }
        .popup-fade.popup-visible {
            opacity: 1;
        }

        /* Variasi pop up - rotate */
        .popup-rotate {
            transform: rotate(-8deg) scale(0.9);
            opacity: 0;
        }
        .popup-rotate.popup-visible {
            transform: rotate(0deg) scale(1);
            opacity: 1;
        }

        /* Stagger children animation */
        .popup-stagger > * {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1),
                        transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
        }

        /* Fallback safety: jika observer gagal, tampilkan setelah 3 detik */
        @media (prefers-reduced-motion: reduce) {
            .popup-anim, .popup-left, .popup-right, .popup-zoom, .popup-rotate, .popup-stagger, .popup-fade,
            .popup-anim > *, .popup-stagger > * {
                opacity: 1 !important;
                transform: none !important;
            }
        }
        .popup-stagger.popup-visible > *:nth-child(1) { transition-delay: 0.05s; }
        .popup-stagger.popup-visible > *:nth-child(2) { transition-delay: 0.1s; }
        .popup-stagger.popup-visible > *:nth-child(3) { transition-delay: 0.15s; }
        .popup-stagger.popup-visible > *:nth-child(4) { transition-delay: 0.2s; }
        .popup-stagger.popup-visible > *:nth-child(5) { transition-delay: 0.25s; }
        .popup-stagger.popup-visible > *:nth-child(6) { transition-delay: 0.3s; }
        .popup-stagger.popup-visible > *:nth-child(7) { transition-delay: 0.35s; }
        .popup-stagger.popup-visible > *:nth-child(8) { transition-delay: 0.4s; }
        .popup-stagger.popup-visible > *:nth-child(9) { transition-delay: 0.45s; }
        .popup-stagger.popup-visible > *:nth-child(10) { transition-delay: 0.5s; }
        .popup-stagger.popup-visible > * {
            opacity: 1;
            transform: translateY(0);
        }

        /* Container Utama */
        .hero-container {
            position: relative;
            width: 100%;
            min-height: 100vh;
            background: linear-gradient(135deg, #0a1428 0%, #16213e 50%, #1a1a2e 100%);
            overflow: visible;
            z-index: 1;
        }

        /* Layer Background (tanpa zoom animation) */
        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;

            /* Background Laravel Asset */
            background-image: url('{{ asset("images/paradic1.webp") }}');
            background-size: cover;
            background-position: center;

            z-index: 0; /* Di belakang - ubah dari 1 ke 0 */

            /* Animasi Zoom dihapus */
            filter: brightness(0.8); /* Menggelapkan gambar agar teks jelas */
        }

        /* @keyframes smoothZoom dihapus */

        /* Layer Konten (Navbar & Teks) di depan gambar */
        .hero-content {
            position: relative;
            z-index: 10;
            width: 100%;
            min-height: 100%;
            display: flex;
            flex-direction: column;
            padding-top: 0;
            overflow: visible;
        }

        /* ========== NAVBAR PROFESIONAL ========== */
        .navbar-dashboard {
            position: fixed; /* Ubah dari absolute ke fixed agar selalu di atas */
            top: 0;
            left: 0;
            right: 0;
            padding: 10px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100;
            background: rgba(10, 20, 40, 0.9);
            backdrop-filter: blur(10px);
        }

        /* ========== SELAMAT DATANG ADMIN PREMIUM BANNER ========== */
        .welcome-admin-banner {
            position: relative;
            width: 100%;
            min-height: calc(100vh - 80px);
            padding: 40px 20px 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        /* Dashboard Background Image dengan Zoom Out to In Animation */
        .welcome-sunset-bg {
            position: absolute;
            top: -10%;
            left: -10%;
            width: 120%;
            height: 120%;
            background-image: url('{{ asset("images/paradic1.webp") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            /* Animasi sunsetZoomOutIn dihapus */
            filter: brightness(0.6) saturate(1.2);
            z-index: 0;
        }

        /* Overlay gradient untuk membuat teks lebih jelas */
        .welcome-sunset-bg::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                180deg,
                rgba(15, 12, 41, 0.7) 0%,
                rgba(48, 43, 99, 0.5) 30%,
                rgba(203, 45, 62, 0.4) 70%,
                rgba(255, 140, 0, 0.6) 100%
            );
        }

        @keyframes sunsetGradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* @keyframes sunsetZoomOutIn dihapus (animasi zoom dihilangkan) */

        /* Floating Particles */
        .welcome-particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 6px;
            height: 6px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            animation: particleFloat 8s ease-in-out infinite;
        }

        .particle:nth-child(1) { left: 10%; top: 20%; animation-delay: 0s; animation-duration: 6s; }
        .particle:nth-child(2) { left: 20%; top: 60%; animation-delay: 1s; animation-duration: 8s; }
        .particle:nth-child(3) { left: 35%; top: 30%; animation-delay: 2s; animation-duration: 7s; }
        .particle:nth-child(4) { left: 50%; top: 70%; animation-delay: 0.5s; animation-duration: 9s; }
        .particle:nth-child(5) { left: 65%; top: 25%; animation-delay: 1.5s; animation-duration: 6.5s; }
        .particle:nth-child(6) { left: 75%; top: 55%; animation-delay: 2.5s; animation-duration: 7.5s; }
        .particle:nth-child(7) { left: 85%; top: 40%; animation-delay: 3s; animation-duration: 8.5s; }
        .particle:nth-child(8) { left: 15%; top: 80%; animation-delay: 1s; animation-duration: 6s; }
        .particle:nth-child(9) { left: 45%; top: 15%; animation-delay: 2s; animation-duration: 7s; }
        .particle:nth-child(10) { left: 90%; top: 75%; animation-delay: 0s; animation-duration: 8s; }

        @keyframes particleFloat {
            0%, 100% { transform: translateY(0) scale(1); opacity: 0.6; }
            50% { transform: translateY(-30px) scale(1.5); opacity: 1; }
        }

        /* Glowing Effects */
        .welcome-glow {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: 1;
            animation: glowPulse 4s ease-in-out infinite;
        }

        .welcome-glow-1 {
            width: 400px;
            height: 400px;
            background: rgba(255, 140, 0, 0.4);
            top: -100px;
            right: -100px;
            animation-delay: 0s;
        }

        .welcome-glow-2 {
            width: 300px;
            height: 300px;
            background: rgba(203, 45, 62, 0.4);
            bottom: -50px;
            left: -50px;
            animation-delay: 2s;
        }

        .welcome-glow-3 {
            width: 250px;
            height: 250px;
            background: rgba(255, 179, 71, 0.3);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: 1s;
        }

        @keyframes glowPulse {
            0%, 100% { opacity: 0.4; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.2); }
        }

        /* Welcome Content */
        .welcome-content {
            position: relative;
            z-index: 10;
            text-align: center;
            padding: 40px 20px;
            max-width: 900px;
        }

        .welcome-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 179, 71, 0.5);
            padding: 10px 24px;
            border-radius: 50px;
            margin-bottom: 30px;
            animation: badgeShine 3s ease-in-out infinite;
        }

        .welcome-badge i {
            color: #ffb347;
            font-size: 1.1rem;
        }

        .welcome-badge span {
            color: #ffb347;
            font-size: 0.9rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        @keyframes badgeShine {
            0%, 100% { box-shadow: 0 0 20px rgba(255, 179, 71, 0.3); }
            50% { box-shadow: 0 0 40px rgba(255, 179, 71, 0.6); }
        }

        .welcome-title {
            font-size: 4rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 25px;
            text-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
        }

        .welcome-text-white {
            display: block;
            color: #ffffff;
            text-shadow: 0 0 40px rgba(255, 255, 255, 0.3);
        }

        /* Judul Visual Production.id dengan gradien orange animasi */
        .welcome-title-vp {
            font-size: clamp(2.6rem, 6vw, 4.5rem);
            font-weight: 900;
            line-height: 1.05;
            margin-bottom: 25px;
            letter-spacing: -1px;
        }

        .welcome-text-vp {
            display: inline-flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: baseline;
            gap: 0 10px;
        }

        /* Bagian putih dengan glow lembut */
        .welcome-text-vp-white {
            color: #ffffff;
            text-shadow:
                0 0 12px rgba(255, 255, 255, 0.85),
                0 0 28px rgba(255, 123, 0, 0.45),
                0 4px 30px rgba(0, 0, 0, 0.6);
            animation: vpWhitePulse 3.5s ease-in-out infinite;
        }

        /* Bagian orange dengan gradien animasi + shimmer */
        .welcome-text-vp-orange {
            background: linear-gradient(90deg,
                #ffd089 0%,
                #ff7b00 25%,
                #ffb347 50%,
                #ff7b00 75%,
                #ffd089 100%);
            background-size: 250% auto;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            color: transparent;
            animation: vpOrangeFlow 4s linear infinite;
            filter: drop-shadow(0 0 14px rgba(255, 123, 0, 0.7));
        }

        @keyframes vpWhitePulse {
            0%, 100% { text-shadow:
                0 0 12px rgba(255, 255, 255, 0.85),
                0 0 28px rgba(255, 123, 0, 0.45),
                0 4px 30px rgba(0, 0, 0, 0.6); }
            50% { text-shadow:
                0 0 18px rgba(255, 255, 255, 1),
                0 0 42px rgba(255, 123, 0, 0.7),
                0 0 60px rgba(255, 179, 71, 0.35),
                0 4px 30px rgba(0, 0, 0, 0.6); }
        }

        @keyframes vpOrangeFlow {
            0%   { background-position: 0% center; }
            100% { background-position: 250% center; }
        }

        /* Gradient lama tetap ada (tidak dihapus, hanya tidak dipakai di hero baru) */
        .welcome-text-gradient {
            display: block;
            background: linear-gradient(135deg, #ff8c00 0%, #ffb347 25%, #ff6b35 50%, #ff8c00 75%, #ffd700 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradientFlow 3s ease-in-out infinite;
        }

        @keyframes gradientFlow {
            0%, 100% { background-position: 0% center; }
            50% { background-position: 100% center; }
        }

        /* .welcome-divider - dihilangkan (garis di bawah judul Visual Production.id) */

/* @keyframes dividerPulse - tidak dipakai lagi */

        .welcome-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.2rem;
            font-weight: 400;
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        /* Subtitle quote style - tagline Visual Production */
        .welcome-subtitle-quote {
            max-width: 820px;
            margin: 14px auto 0;
            padding: 22px 28px;
            position: relative;
            font-style: italic;
        }
        .welcome-subtitle-text {
            display: inline;
            line-height: 1.85;
            color: rgba(255, 255, 255, 0.88);
            letter-spacing: 0.3px;
            font-size: clamp(0.92rem, 1.4vw, 1.05rem);
        }
        .welcome-subtitle i {
            color: #ffb347;
            animation: iconBounce 1.5s ease-in-out infinite;
        }

        @keyframes iconBounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        .welcome-actions {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 50px;
        }

        .welcome-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 16px 32px;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
        }

        .welcome-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .welcome-btn:hover::before {
            left: 100%;
        }

        .welcome-btn-primary {
            background: linear-gradient(135deg, #ff8c00 0%, #ff6b35 100%);
            color: white;
            box-shadow: 0 8px 30px rgba(255, 140, 0, 0.4);
        }

        .welcome-btn-primary:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 15px 40px rgba(255, 140, 0, 0.5);
        }

        .welcome-btn-secondary {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .welcome-btn-secondary:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 179, 71, 0.5);
            transform: translateY(-5px) scale(1.05);
        }

        /* Tombol khusus navbar (Data Karyawan) - design button oranye animasi */
        .navbar-btn-special {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 22px;
            margin-left: 6px;
            color: #ffffff;
            font-weight: 800;
            font-size: 0.82rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            text-decoration: none;
            border-radius: 30px;
            background: linear-gradient(135deg, #ff7b00 0%, #ff9500 50%, #ffb347 100%);
            background-size: 200% 200%;
            box-shadow:
                0 4px 14px rgba(255, 123, 0, 0.35),
                inset 0 1px 0 rgba(255, 255, 255, 0.25);
            overflow: hidden;
            transition: transform 0.35s ease, box-shadow 0.35s ease, background-position 0.6s ease;
            animation: navbarBtnShift 5s ease-in-out infinite;
        }
        .navbar-btn-special::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(120deg,
                transparent 0%,
                rgba(255, 255, 255, 0.35) 50%,
                transparent 100%);
            transition: left 0.7s ease;
        }
        .navbar-btn-special:hover {
            transform: translateY(-3px) scale(1.04);
            background-position: 100% 100%;
            box-shadow:
                0 10px 28px rgba(255, 123, 0, 0.55),
                0 0 20px rgba(255, 179, 71, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }
        .navbar-btn-special:hover::before {
            left: 100%;
        }
        .navbar-btn-special i {
            color: #fff;
            filter: drop-shadow(0 0 4px rgba(255, 255, 255, 0.4));
            animation: navbarIconPulse 2s ease-in-out infinite;
        }
        @keyframes navbarBtnShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        @keyframes navbarIconPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.18); }
        }

        /* Tombol Login navbar (guest) */
        .navbar-btn-login {
            background: linear-gradient(135deg, #ff7b00 0%, #ff9500 100%);
            color: white;
            border: none;
            padding: 8px 18px;
            border-radius: 30px;
            font-size: 0.78rem;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 123, 0, 0.4);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-left: 6px;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .navbar-btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 123, 0, 0.5);
            background: linear-gradient(135deg, #ff9500 0%, #ff7b00 100%);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .welcome-title {
                font-size: 2.5rem;
            }
            .welcome-actions {
                flex-direction: column;
                align-items: center;
            }
        }

        /* Tambahkan body padding-top untuk menghindari konten tersembunyi di bawah navbar */
        body {
            padding-top: 0;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0;
        }

        .navbar-logo {
            width: 90px;
            height: 90px;
            object-fit: contain;
            margin-right: -10px;
            filter: drop-shadow(0 4px 12px rgba(0,0,0,0.4));
        }

        .navbar-brand-text {
            display: flex;
            flex-direction: column;
            margin-left: -3px;
        }

        .navbar-brand-name {
            font-size: 1.05rem;
            font-weight: 800;
            color: white;
            letter-spacing: 1.5px;
            line-height: 1;
            text-shadow: 0 2px 15px rgba(0,0,0,0.5);
        }

        .navbar-brand-name span {
            color: #ff7b00;
        }

        .navbar-brand-tagline {
            font-size: 0.55rem;
            color: rgba(255,255,255,0.7);
            letter-spacing: 2px;
            text-transform: uppercase;
            font-weight: 500;
            margin-top: 3px;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 3px;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 50px;
            padding: 5px 5px 5px 10px;
        }

        .navbar-link {
            color: white;
            text-decoration: none;
            padding: 7px 11px;
            font-size: 0.73rem;
            font-weight: 600;
            border-radius: 30px;
            transition: all 0.3s ease;
            letter-spacing: 0.2px;
            white-space: nowrap;
        }

        .navbar-link:hover {
            background: rgba(255, 123, 0, 0.3);
            color: #ff7b00;
        }

        .navbar-link.active {
            background: linear-gradient(135deg, #ff7b00 0%, #ff9500 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(255, 123, 0, 0.4);
        }

        .navbar-btn-logout {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            border: none;
            padding: 7px 16px;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
            display: flex;
            align-items: center;
            gap: 6px;
            margin-left: 6px;
        }

        .navbar-btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
        }

        /* Animasi Kursor Berkedip */
        .typing-cursor {
            display: inline-block;
            width: 4px;
            height: 1em;
            background-color: #ff7b00; /* Warna orange */
            margin-left: 5px;
            vertical-align: text-bottom;
            animation: blink 0.8s step-end infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }

        /* Section Statistik & Testimoni - Dengan background solid */
        .stats-testimoni-section {
            background-color: #0a1428;
            color: #ffffff;
            padding: 80px 40px;
            position: relative;
            z-index: 2;
            overflow: visible;
        }

.stats-testimoni-wrapper {
    max-width: 1200px;
    margin: 0 auto;
    background-color: #0a1428;
    position: relative;
    z-index: 3;
    overflow: visible;
}

.testimoni-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 30px;
    margin-bottom: 50px;
}

.testimoni-label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background-color: rgba(255, 123, 0, 0.15);
    color: #ff7b00;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.85rem;
    margin-bottom: 15px;
}

.testimoni-title {
    font-size: 1.8rem;
    font-weight: bold;
    max-width: 400px;
    line-height: 1.3;
}

.testimoni-content {
    max-width: 450px;
}

.testimoni-stars {
    color: #ffc107;
    margin-bottom: 12px;
    font-size: 1.1rem;
}

.testimoni-text {
    font-size: 1rem;
    line-height: 1.6;
    margin-bottom: 20px;
    color: #d1d5db;
}

.testimoni-author {
    display: flex;
    align-items: center;
    gap: 12px;
}

.testimoni-author img {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    object-fit: cover;
}

.testimoni-author-name {
    font-weight: bold;
    font-size: 0.95rem;
}

.testimoni-author-role {
    font-size: 0.85rem;
    color: #9ca3af;
}

/* ========== PORTOFOLIO PROJECT SECTION ========== */
.portofolio-section {
    margin-bottom: 50px;
    position: relative;
    z-index: 10;
}

.portofolio-header {
    text-align: center;
    margin-bottom: 40px;
    position: relative;
    z-index: 10;
}

.portofolio-label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 123, 0, 0.15);
    color: #ff7b00;
    padding: 8px 20px;
    border-radius: 30px;
    font-size: 0.85rem;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    border: 1px solid rgba(255, 123, 0, 0.3);
    margin-bottom: 18px;
}

.portofolio-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: white;
    margin-bottom: 12px;
    line-height: 1.2;
}

.portofolio-subtitle {
    color: #94a3b8;
    font-size: 1rem;
    max-width: 600px;
    margin: 0 auto;
}

.portofolio-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 25px;
    margin-top: 30px;
    position: relative;
    z-index: 10;
}

.portofolio-card {
    background: rgba(26,26,46,0.95);
    border: 1px solid rgba(255, 123, 0, 0.2);
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    cursor: pointer;
    position: relative;
    z-index: 10;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.portofolio-card:hover {
    transform: translateY(-8px);
    border-color: rgba(255, 123, 0, 0.5);
    box-shadow: 0 20px 50px rgba(255, 123, 0, 0.2);
}

.portofolio-card-image {
    position: relative;
    height: 180px;
    overflow: hidden;
    background-color: transparent !important;
    background-size: cover !important;
    background-position: center !important;
}

/* ========== SLIDESHOW CARD IMAGE ========== */
.slideshow-container {
    position: relative;
    background-color: transparent;
}

.slideshow-slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    opacity: 0;
    transition: opacity 1s ease-in-out;
}

.slideshow-slide-1 {
    animation: slideshowFade1 9s infinite;
}

.slideshow-slide-2 {
    animation: slideshowFade2 9s infinite;
}

.slideshow-slide-3 {
    animation: slideshowFade3 9s infinite;
}

/* Override slideshowFade1-3 untuk 33 detik (Good Day Schoolicious) */
@keyframes slideshowFade1 {
    0%, 3%    { opacity: 1; }
    6%, 100%  { opacity: 0; }
}

@keyframes slideshowFade2 {
    0%, 6%    { opacity: 0; }
    9%, 12%   { opacity: 1; }
    15%, 100% { opacity: 0; }
}

@keyframes slideshowFade3 {
    0%, 15%   { opacity: 0; }
    18%, 21%  { opacity: 1; }
    24%, 100% { opacity: 0; }
}

/* Slideshow 5 Keyframes - untuk Halal Bilhalal (15 detik total, ~3 detik per slide) */
@keyframes bimFade1 {
    0%, 17%   { opacity: 1; }
    20%, 100% { opacity: 0; }
}

@keyframes bimFade2 {
    0%, 20%   { opacity: 0; }
    23%, 36%  { opacity: 1; }
    39%, 100% { opacity: 0; }
}

@keyframes bimFade3 {
    0%, 39%   { opacity: 0; }
    42%, 55%  { opacity: 1; }
    58%, 100% { opacity: 0; }
}

@keyframes bimFade4 {
    0%, 58%   { opacity: 0; }
    61%, 74%  { opacity: 1; }
    77%, 100% { opacity: 0; }
}

@keyframes bimFade5 {
    0%, 77%   { opacity: 0; }
    80%, 94%  { opacity: 1; }
    97%, 100% { opacity: 0; }
}

/* Slideshow 3 Keyframes - untuk GKM Project (9 detik total, ~3 detik per slide) */
@keyframes gkmFade1 {
    0%, 28%   { opacity: 1; }
    33%, 100% { opacity: 0; }
}

@keyframes gkmFade2 {
    0%, 33%   { opacity: 0; }
    38%, 61%  { opacity: 1; }
    66%, 100% { opacity: 0; }
}

@keyframes gkmFade3 {
    0%, 66%   { opacity: 0; }
    72%, 94%  { opacity: 1; }
    99%, 100% { opacity: 0; }
}

/* Slideshow 8 Keyframes - untuk Bank Indonesia (24 detik total, ~3 detik per slide) */
@keyframes biFade1 {
    0%, 9%    { opacity: 1; }
    12%, 100% { opacity: 0; }
}

@keyframes biFade2 {
    0%, 12%   { opacity: 0; }
    15%, 21%  { opacity: 1; }
    24%, 100% { opacity: 0; }
}

@keyframes biFade3 {
    0%, 21%   { opacity: 0; }
    24%, 33%  { opacity: 1; }
    36%, 100% { opacity: 0; }
}

@keyframes biFade4 {
    0%, 33%   { opacity: 0; }
    36%, 45%  { opacity: 1; }
    48%, 100% { opacity: 0; }
}

@keyframes biFade5 {
    0%, 45%   { opacity: 0; }
    48%, 57%  { opacity: 1; }
    60%, 100% { opacity: 0; }
}

@keyframes biFade6 {
    0%, 57%   { opacity: 0; }
    60%, 69%  { opacity: 1; }
    72%, 100% { opacity: 0; }
}

@keyframes biFade7 {
    0%, 69%   { opacity: 0; }
    72%, 81%  { opacity: 1; }
    84%, 100% { opacity: 0; }
}

@keyframes biFade8 {
    0%, 81%   { opacity: 0; }
    84%, 93%  { opacity: 1; }
    96%, 100% { opacity: 0; }
}

/* Slideshow 7 Keyframes - untuk Danantara Indonesia (21 detik total, ~3 detik per slide) */
@keyframes dnFade1 {
    0%, 11%   { opacity: 1; }
    14%, 100% { opacity: 0; }
}

@keyframes dnFade2 {
    0%, 14%   { opacity: 0; }
    17%, 25%  { opacity: 1; }
    28%, 100% { opacity: 0; }
}

@keyframes dnFade3 {
    0%, 28%   { opacity: 0; }
    31%, 39%  { opacity: 1; }
    42%, 100% { opacity: 0; }
}

@keyframes dnFade4 {
    0%, 42%   { opacity: 0; }
    45%, 53%  { opacity: 1; }
    56%, 100% { opacity: 0; }
}

@keyframes dnFade5 {
    0%, 56%   { opacity: 0; }
    59%, 67%  { opacity: 1; }
    70%, 100% { opacity: 0; }
}

@keyframes dnFade6 {
    0%, 70%   { opacity: 0; }
    73%, 81%  { opacity: 1; }
    84%, 100% { opacity: 0; }
}

@keyframes dnFade7 {
    0%, 84%   { opacity: 0; }
    87%, 95%  { opacity: 1; }
    98%, 100% { opacity: 0; }
}

@keyframes gkmRedUvFade {
    0%, 3.47%  { opacity: 1; }
    4.17%, 100% { opacity: 0; }
}

@keyframes xganzaFade1 {
    0%, 22%   { opacity: 1; }
    25%, 97%  { opacity: 0; }
    100%       { opacity: 1; }
}

@keyframes xganzaFade2 {
    0%, 22%   { opacity: 0; }
    25%, 47%  { opacity: 1; }
    50%, 100% { opacity: 0; }
}

@keyframes xganzaFade3 {
    0%, 47%   { opacity: 0; }
    50%, 72%  { opacity: 1; }
    75%, 100% { opacity: 0; }
}

@keyframes xganzaFade4 {
    0%, 72%   { opacity: 0; }
    75%, 97%  { opacity: 1; }
    100%       { opacity: 0; }
}

/* Slideshow 7 Keyframes - untuk Pembekalan SK Pensiun (21 detik total, ~3 detik per slide) */
@keyframes skFade1 {
    0%, 11%   { opacity: 1; }
    14%, 100% { opacity: 0; }
}

@keyframes skFade2 {
    0%, 14%   { opacity: 0; }
    17%, 25%  { opacity: 1; }
    28%, 100% { opacity: 0; }
}

@keyframes skFade3 {
    0%, 28%   { opacity: 0; }
    31%, 39%  { opacity: 1; }
    42%, 100% { opacity: 0; }
}

@keyframes skFade4 {
    0%, 42%   { opacity: 0; }
    45%, 53%  { opacity: 1; }
    56%, 100% { opacity: 0; }
}

@keyframes skFade5 {
    0%, 56%   { opacity: 0; }
    59%, 67%  { opacity: 1; }
    70%, 100% { opacity: 0; }
}

@keyframes skFade6 {
    0%, 70%   { opacity: 0; }
    73%, 81%  { opacity: 1; }
    84%, 100% { opacity: 0; }
}

@keyframes skFade7 {
    0%, 84%   { opacity: 0; }
    87%, 95%  { opacity: 1; }
    98%, 100% { opacity: 0; }
}

/* Slideshow 7 Keyframes - untuk Video Angkatan SMKN 1 Singosari (21 detik total, ~3 detik per slide) */
@keyframes sgsFade1 {
    0%, 11%   { opacity: 1; }
    14%, 100% { opacity: 0; }
}

@keyframes sgsFade2 {
    0%, 14%   { opacity: 0; }
    17%, 25%  { opacity: 1; }
    28%, 100% { opacity: 0; }
}

@keyframes sgsFade3 {
    0%, 28%   { opacity: 0; }
    31%, 39%  { opacity: 1; }
    42%, 100% { opacity: 0; }
}

@keyframes sgsFade4 {
    0%, 42%   { opacity: 0; }
    45%, 53%  { opacity: 1; }
    56%, 100% { opacity: 0; }
}

@keyframes sgsFade5 {
    0%, 56%   { opacity: 0; }
    59%, 67%  { opacity: 1; }
    70%, 100% { opacity: 0; }
}

@keyframes sgsFade6 {
    0%, 70%   { opacity: 0; }
    73%, 81%  { opacity: 1; }
    84%, 100% { opacity: 0; }
}

@keyframes sgsFade7 {
    0%, 84%   { opacity: 0; }
    87%, 95%  { opacity: 1; }
    98%, 100% { opacity: 0; }
}

/* Slideshow 13 Keyframes - untuk Kaldera Adventure (39 detik total, ~3 detik per slide) */
@keyframes kalderaFade1 {
    0%, 5%    { opacity: 1; }
    8%, 100%  { opacity: 0; }
}

@keyframes kalderaFade2 {
    0%, 8%    { opacity: 0; }
    11%, 13%  { opacity: 1; }
    16%, 100% { opacity: 0; }
}

@keyframes kalderaFade3 {
    0%, 13%   { opacity: 0; }
    16%, 18%  { opacity: 1; }
    21%, 100% { opacity: 0; }
}

@keyframes kalderaFade4 {
    0%, 18%   { opacity: 0; }
    21%, 23%  { opacity: 1; }
    26%, 100% { opacity: 0; }
}

@keyframes kalderaFade5 {
    0%, 23%   { opacity: 0; }
    26%, 28%  { opacity: 1; }
    31%, 100% { opacity: 0; }
}

@keyframes kalderaFade6 {
    0%, 28%   { opacity: 0; }
    31%, 33%  { opacity: 1; }
    36%, 100% { opacity: 0; }
}

@keyframes kalderaFade7 {
    0%, 33%   { opacity: 0; }
    36%, 38%  { opacity: 1; }
    41%, 100% { opacity: 0; }
}

@keyframes kalderaFade8 {
    0%, 38%   { opacity: 0; }
    41%, 43%  { opacity: 1; }
    46%, 100% { opacity: 0; }
}

@keyframes kalderaFade9 {
    0%, 43%   { opacity: 0; }
    46%, 48%  { opacity: 1; }
    51%, 100% { opacity: 0; }
}

@keyframes kalderaFade10 {
    0%, 48%   { opacity: 0; }
    51%, 53%  { opacity: 1; }
    56%, 100% { opacity: 0; }
}

@keyframes kalderaFade11 {
    0%, 53%   { opacity: 0; }
    56%, 58%  { opacity: 1; }
    61%, 100% { opacity: 0; }
}

@keyframes kalderaFade12 {
    0%, 58%   { opacity: 0; }
    61%, 63%  { opacity: 1; }
    66%, 100% { opacity: 0; }
}

@keyframes kalderaFade13 {
    0%, 63%   { opacity: 0; }
    66%, 68%  { opacity: 1; }
    71%, 100% { opacity: 0; }
}

/* Slideshow 11 Keyframes - untuk Good Day Schoolicious (33 detik total, ~3 detik per slide) */
@keyframes slideshowFade4 {
    0%, 24%   { opacity: 0; }
    27%, 30%  { opacity: 1; }
    33%, 100% { opacity: 0; }
}

@keyframes slideshowFade5 {
    0%, 30%   { opacity: 0; }
    33%, 36%  { opacity: 1; }
    39%, 100% { opacity: 0; }
}

@keyframes slideshowFade6 {
    0%, 36%   { opacity: 0; }
    39%, 42%  { opacity: 1; }
    45%, 100% { opacity: 0; }
}

@keyframes slideshowFade7 {
    0%, 42%   { opacity: 0; }
    45%, 48%  { opacity: 1; }
    51%, 100% { opacity: 0; }
}

@keyframes slideshowFade8 {
    0%, 48%   { opacity: 0; }
    51%, 54%  { opacity: 1; }
    57%, 100% { opacity: 0; }
}

@keyframes slideshowFade9 {
    0%, 54%   { opacity: 0; }
    57%, 60%  { opacity: 1; }
    63%, 100% { opacity: 0; }
}

@keyframes slideshowFade10 {
    0%, 60%   { opacity: 0; }
    63%, 66%  { opacity: 1; }
    69%, 100% { opacity: 0; }
}

@keyframes slideshowFade11 {
    0%, 66%   { opacity: 0; }
    69%, 72%  { opacity: 1; }
    75%, 100% { opacity: 0; }
}

/* ========== MANUAL SLIDESHOW (Prev/Next Buttons) ========== */
/* Container dengan class manual-slideshow akan dikontrol via JS */
.manual-slideshow {
    position: relative;
}

.manual-slideshow .manual-slide {
    opacity: 0;
    transition: opacity 0.6s ease-in-out;
    pointer-events: none;
}

.manual-slideshow .manual-slide.manual-slide-active {
    opacity: 1;
    pointer-events: auto;
}

/* Tombol navigasi kiri/kanan */
.manual-slideshow .manual-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(0, 0, 0, 0.55);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    border: 1px solid rgba(255, 255, 255, 0.25);
    color: #fff;
    font-size: 0.85rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 5;
    opacity: 0;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.35);
}

.manual-slideshow:hover .manual-arrow {
    opacity: 1;
}

.manual-slideshow .manual-arrow:hover {
    background: rgba(255, 123, 0, 0.85);
    border-color: rgba(255, 123, 0, 1);
    transform: translateY(-50%) scale(1.08);
}

.manual-slideshow .manual-arrow:active {
    transform: translateY(-50%) scale(0.95);
}

.manual-slideshow .manual-arrow-prev { left: 10px; }
.manual-slideshow .manual-arrow-next { right: 10px; }

/* Tombol counter (indikator index) */
.manual-slideshow .manual-counter {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(0, 0, 0, 0.6);
    color: #fff;
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 700;
    z-index: 5;
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    border: 1px solid rgba(255, 255, 255, 0.15);
    pointer-events: none;
}

/* Untuk layar sentuh: tampilkan tombol selalu */
@media (hover: none) {
    .manual-slideshow .manual-arrow { opacity: 0.85; }
}

/* Slideshow Dots Indicator */
.slideshow-dots {
    position: absolute;
    bottom: 12px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
    z-index: 3;
}

.slideshow-dot {
    width: 8px;
    height: 8px;
    background: rgba(255, 255, 255, 0.5);
    border-radius: 50%;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
}

.slideshow-dot-1 {
    animation: dotActive1 9s infinite;
}

.slideshow-dot-2 {
    animation: dotActive2 9s infinite;
}

.slideshow-dot-3 {
    animation: dotActive3 9s infinite;
}

@keyframes dotActive1 {
    0%   { background: #ff7b00; transform: scale(1.4); }
    36%  { background: #ff7b00; transform: scale(1.4); }
    40%  { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
    96%  { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
    100% { background: #ff7b00; transform: scale(1.4); }
}

@keyframes dotActive2 {
    0%   { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
    36%  { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
    40%  { background: #ff7b00; transform: scale(1.4); }
    70%  { background: #ff7b00; transform: scale(1.4); }
    74%  { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
    100% { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
}

@keyframes dotActive3 {
    0%   { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
    70%  { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
    74%  { background: #ff7b00; transform: scale(1.4); }
    96%  { background: #ff7b00; transform: scale(1.4); }
    100% { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
}

.slideshow-4-slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    opacity: 0;
    transition: opacity 1s ease-in-out;
}

.slideshow-4-slide-1 { animation: prestonFade1 12s infinite; }
.slideshow-4-slide-2 { animation: prestonFade2 12s infinite; }
.slideshow-4-slide-3 { animation: prestonFade3 12s infinite; }
.slideshow-4-slide-4 { animation: prestonFade4 12s infinite; }

@keyframes prestonFade1 {
    0%   { opacity: 1; }
    24%  { opacity: 1; }
    28%  { opacity: 0; }
    97%  { opacity: 0; }
    100% { opacity: 1; }
}

@keyframes prestonFade2 {
    0%   { opacity: 0; }
    24%  { opacity: 0; }
    28%  { opacity: 1; }
    49%  { opacity: 1; }
    53%  { opacity: 0; }
    100% { opacity: 0; }
}

@keyframes prestonFade3 {
    0%   { opacity: 0; }
    49%  { opacity: 0; }
    53%  { opacity: 1; }
    74%  { opacity: 1; }
    78%  { opacity: 0; }
    100% { opacity: 0; }
}

@keyframes prestonFade4 {
    0%   { opacity: 0; }
    74%  { opacity: 0; }
    78%  { opacity: 1; }
    97%  { opacity: 1; }
    100% { opacity: 0; }
}

/* Slideshow 4 Dots Indicator */
.slideshow-dots-4 {
    position: absolute;
    bottom: 12px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
    z-index: 3;
}

.slideshow-dot-4 {
    width: 8px;
    height: 8px;
    background: rgba(255, 255, 255, 0.5);
    border-radius: 50%;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
}

.slideshow-dot-4-1 { animation: prestonDot1 12s infinite; }
.slideshow-dot-4-2 { animation: prestonDot2 12s infinite; }
.slideshow-dot-4-3 { animation: prestonDot3 12s infinite; }
.slideshow-dot-4-4 { animation: prestonDot4 12s infinite; }

@keyframes prestonDot1 {
    0%   { background: #ff7b00; transform: scale(1.4); }
    24%  { background: #ff7b00; transform: scale(1.4); }
    28%  { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
    97%  { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
    100% { background: #ff7b00; transform: scale(1.4); }
}

@keyframes prestonDot2 {
    0%   { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
    24%  { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
    28%  { background: #ff7b00; transform: scale(1.4); }
    49%  { background: #ff7b00; transform: scale(1.4); }
    53%  { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
    100% { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
}

@keyframes prestonDot3 {
    0%   { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
    49%  { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
    53%  { background: #ff7b00; transform: scale(1.4); }
    74%  { background: #ff7b00; transform: scale(1.4); }
    78%  { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
    100% { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
}

@keyframes prestonDot4 {
    0%   { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
    74%  { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
    78%  { background: #ff7b00; transform: scale(1.4); }
    97%  { background: #ff7b00; transform: scale(1.4); }
    100% { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
}

/* ========== FEATURED PROJECT BOX BESAR (PARADICFEST) ========== */
.portofolio-featured {
    position: relative;
    background: linear-gradient(145deg, #1a1a2e 0%, #16213e 100%);
    border: 2px solid rgba(255, 123, 0, 0.4);
    border-radius: 24px;
    overflow: hidden;
    margin-bottom: 50px;
    box-shadow:
        0 0 0 1px rgba(255, 123, 0, 0.1),
        0 25px 60px rgba(255, 123, 0, 0.15),
        0 4px 20px rgba(0, 0, 0, 0.3);
    transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    z-index: 10;
}

.portofolio-featured:hover {
    transform: translateY(-5px);
    border-color: rgba(255, 123, 0, 0.7);
    box-shadow:
        0 0 0 1px rgba(255, 123, 0, 0.2),
        0 35px 80px rgba(255, 123, 0, 0.25),
        0 8px 30px rgba(0, 0, 0, 0.4);
}

.portofolio-featured-image {
    position: relative;
    width: 100%;
    height: 480px;
    overflow: hidden;
    background-color: transparent !important;
    background-size: cover !important;
    background-position: center !important;
}

/* Gradient overlay agar title tidak menutupi/menutup area foto terlalu banyak */
.portofolio-featured-image::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg,
        transparent 0%,
        transparent 40%,
        rgba(10, 20, 40, 0.55) 75%,
        rgba(10, 20, 40, 0.92) 100%);
    pointer-events: none;
    z-index: 1;
}

.portofolio-featured-tag {
    position: absolute;
    top: 25px;
    left: 25px;
    background: linear-gradient(135deg, #ff7b00 0%, #ff9500 100%);
    color: white;
    padding: 8px 20px;
    border-radius: 30px;
    font-size: 0.8rem;
    font-weight: 800;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    box-shadow: 0 4px 15px rgba(255, 123, 0, 0.5);
    z-index: 3;
}

.portofolio-featured-content {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 28px 32px;
    z-index: 2;
    color: white;
    display: flex;
    flex-direction: column;
    gap: 10px;
    align-items: flex-start;
}

.portofolio-featured-label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 123, 0, 0.2);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 123, 0, 0.5);
    color: #ffb347;
    padding: 6px 16px;
    border-radius: 30px;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    margin-bottom: 0;
}

.portofolio-featured-title {
    font-size: 2rem;
    font-weight: 900;
    color: white;
    margin-bottom: 0;
    line-height: 1.05;
    text-shadow: 0 2px 20px rgba(0, 0, 0, 0.85);
    letter-spacing: -0.02em;
}

.portofolio-featured-desc {
    font-size: 1.05rem;
    color: rgba(255, 255, 255, 0.9);
    line-height: 1.6;
    margin-bottom: 0;
    max-width: 800px;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
}

.portofolio-featured-meta {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin-top: 4px;
}

.portofolio-featured-meta span {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.25);
    padding: 7px 14px;
    border-radius: 30px;
    color: white;
    font-size: 0.82rem;
    font-weight: 600;
}

.portofolio-featured-meta i {
    color: #ff7b00;
}

/* ========== PARADIC SLIDESHOW ========== */
.paradic-slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    opacity: 0;
    transition: opacity 1s ease-in-out;
}

.paradic-slide-1 { animation: paradicFade1 9s infinite; }
.paradic-slide-2 { animation: paradicFade2 9s infinite; }
.paradic-slide-3 { animation: paradicFade3 9s infinite; }

@keyframes paradicFade1 {
    0%   { opacity: 1; }
    36%  { opacity: 1; }
    40%  { opacity: 0; }
    96%  { opacity: 0; }
    100% { opacity: 1; }
}

@keyframes paradicFade2 {
    0%   { opacity: 0; }
    36%  { opacity: 0; }
    40%  { opacity: 1; }
    70%  { opacity: 1; }
    74%  { opacity: 0; }
    100% { opacity: 0; }
}

@keyframes paradicFade3 {
    0%   { opacity: 0; }
    70%  { opacity: 0; }
    74%  { opacity: 1; }
    96%  { opacity: 1; }
    100% { opacity: 0; }
}

.slideshow-dots-paradic {
    position: absolute;
    bottom: 20px;
    right: 30px;
    display: flex;
    gap: 10px;
    z-index: 4;
}

.slideshow-dot-paradic {
    width: 10px;
    height: 10px;
    background: rgba(255, 255, 255, 0.5);
    border-radius: 50%;
    transition: all 0.3s ease;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.5);
}

.slideshow-dot-paradic-1 { animation: paradicDot1 9s infinite; }
.slideshow-dot-paradic-2 { animation: paradicDot2 9s infinite; }
.slideshow-dot-paradic-3 { animation: paradicDot3 9s infinite; }

@keyframes paradicDot1 {
    0%   { background: #ff7b00; transform: scale(1.4); }
    36%  { background: #ff7b00; transform: scale(1.4); }
    40%  { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
    96%  { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
    100% { background: #ff7b00; transform: scale(1.4); }
}

@keyframes paradicDot2 {
    0%   { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
    36%  { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
    40%  { background: #ff7b00; transform: scale(1.4); }
    70%  { background: #ff7b00; transform: scale(1.4); }
    74%  { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
    100% { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
}

@keyframes paradicDot3 {
    0%   { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
    70%  { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
    74%  { background: #ff7b00; transform: scale(1.4); }
    96%  { background: #ff7b00; transform: scale(1.4); }
    100% { background: rgba(255, 255, 255, 0.5); transform: scale(1); }
}

/* Responsive Featured Box */
@media (max-width: 1024px) {
    .portofolio-featured-image {
        height: 420px;
    }
    .portofolio-featured-title {
        font-size: 1.8rem;
    }
}

@media (max-width: 768px) {
    .portofolio-featured-image {
        height: 340px;
    }
    .portofolio-featured-content {
        padding: 22px 24px;
    }
    .portofolio-featured-title {
        font-size: 1.5rem;
    }
    .portofolio-featured-desc {
        font-size: 0.95rem;
    }
    .portofolio-featured-meta {
        gap: 8px;
    }
    .portofolio-featured-meta span {
        padding: 6px 12px;
        font-size: 0.75rem;
    }
    .portofolio-featured-tag {
        top: 16px;
        left: 16px;
        padding: 6px 14px;
        font-size: 0.7rem;
    }
}

/* ============================================ */
/* ========== SUNSET DI KEBUN SECTION ========= */
/* ============================================ */
.sunset-section-header {
    text-align: center;
    margin-bottom: 40px;
    padding: 32px 20px 0;
}

.sunset-section-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 18px;
    background: rgba(200, 162, 104, 0.08);
    border: 1px solid var(--premium-gold-line, rgba(200, 162, 104, 0.45));
    border-radius: 999px;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    color: var(--premium-gold-bright, #d4b585);
    margin-bottom: 18px;
    box-shadow: 0 0 18px rgba(200, 162, 104, 0.12);
}

.sunset-section-badge i {
    font-size: 0.85rem;
    color: var(--premium-gold-bright, #d4b585);
}

.sunset-section-title {
    font-size: clamp(2.4rem, 5vw, 3.4rem);
    font-weight: 900;
    color: #ffffff;
    margin: 0 0 14px;
    line-height: 1.05;
    letter-spacing: -0.025em;
    text-shadow: 0 2px 30px rgba(0, 0, 0, 0.5);
}

.sunset-section-subtitle {
    font-size: 1rem;
    color: rgba(245, 245, 247, 0.65);
    max-width: 620px;
    margin: 0 auto;
    line-height: 1.6;
    font-weight: 400;
}

.sunset-section {
    position: relative;
    margin: 80px 0;
    z-index: 10;
}

.sunset-header {
    text-align: center;
    margin-bottom: 40px;
    position: relative;
    z-index: 10;
}

.sunset-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, rgba(255,123,0,0.25), rgba(255,179,71,0.15));
    color: #ffb347;
    padding: 8px 22px;
    border-radius: 30px;
    font-size: 0.85rem;
    font-weight: 800;
    letter-spacing: 2px;
    text-transform: uppercase;
    border: 1px solid rgba(255,179,71,0.5);
    margin-bottom: 18px;
    box-shadow: 0 4px 20px rgba(255,123,0,0.3);
    animation: sunsetBadgeGlow 3s ease-in-out infinite;
}

@keyframes sunsetBadgeGlow {
    0%, 100% {
        box-shadow: 0 4px 20px rgba(255,123,0,0.3);
        border-color: rgba(255,179,71,0.5);
    }
    50% {
        box-shadow: 0 8px 40px rgba(255,179,71,0.6);
        border-color: rgba(255,215,0,0.8);
    }
}

.sunset-title {
    font-size: clamp(2.2rem, 4.5vw, 3.5rem);
    font-weight: 900;
    color: white;
    margin-bottom: 15px;
    line-height: 1.1;
    text-shadow: 0 4px 30px rgba(0,0,0,0.7);
    position: relative;
    display: inline-block;
}

.sunset-title-text {
    background: linear-gradient(135deg,
        #ffd700 0%,
        #ff8c00 25%,
        #ff6b35 50%,
        #ff8c00 75%,
        #ffd700 100%);
    background-size: 250% auto;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    color: transparent;
    animation: sunsetTitleFlow 4s linear infinite;
    filter: drop-shadow(0 0 30px rgba(255,140,0,0.5));
}

@keyframes sunsetTitleFlow {
    0%   { background-position: 0% center; }
    100% { background-position: 250% center; }
}

.sunset-subtitle {
    color: rgba(255,255,255,0.85);
    font-size: 1.05rem;
    max-width: 650px;
    margin: 0 auto;
    line-height: 1.6;
    font-style: italic;
}

/* Carousel Wrapper */
.sunset-carousel-wrapper {
    position: relative;
    max-width: 1300px;
    margin: 0 auto;
    z-index: 10;
}

/* Glowing Decoration around carousel */
.sunset-carousel-wrapper::before {
    content: '';
    position: absolute;
    inset: -30px;
    background: radial-gradient(ellipse at center, rgba(255,123,0,0.2) 0%, transparent 70%);
    filter: blur(40px);
    z-index: -1;
    animation: sunsetGlowPulse 5s ease-in-out infinite;
}

@keyframes sunsetGlowPulse {
    0%, 100% { opacity: 0.5; transform: scale(1); }
    50% { opacity: 1; transform: scale(1.05); }
}

/* Main Carousel Frame */
.sunset-carousel {
    position: relative;
    background: linear-gradient(145deg, #1a1a2e 0%, #16213e 100%);
    border: 2px solid rgba(255,179,71,0.4);
    border-radius: 28px;
    overflow: hidden;
    box-shadow:
        0 0 0 1px rgba(255,179,71,0.1),
        0 30px 80px rgba(255,123,0,0.25),
        0 8px 30px rgba(0,0,0,0.5);
    height: 540px;
    z-index: 10;
    transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
}

.sunset-carousel:hover {
    border-color: rgba(255,179,71,0.7);
    box-shadow:
        0 0 0 1px rgba(255,179,71,0.2),
        0 40px 100px rgba(255,123,0,0.35),
        0 10px 40px rgba(0,0,0,0.6);
}

/* Slides Container */
.sunset-slides-viewport {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.sunset-slides-track {
    display: flex;
    width: 100%;
    height: 100%;
    transition: transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
}

.sunset-slide {
    min-width: 100%;
    height: 100%;
    position: relative;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

/* Hapus sunset-slide-overlay - div sudah dihapus dari HTML */

/* Slide Content (Caption) */
.sunset-slide-content {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 50px;
    z-index: 3;
    color: white;
}

.sunset-slide-tag {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #ff7b00, #ff9500);
    color: white;
    padding: 8px 20px;
    border-radius: 30px;
    font-size: 0.8rem;
    font-weight: 800;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    box-shadow: 0 6px 20px rgba(255,123,0,0.5);
    margin-bottom: 18px;
    animation: tagBounceIn 0.8s cubic-bezier(0.16, 1, 0.3, 1);
}

@keyframes tagBounceIn {
    0% { opacity: 0; transform: translateX(-30px) scale(0.8); }
    100% { opacity: 1; transform: translateX(0) scale(1); }
}

.sunset-slide-title {
    font-size: 3rem;
    font-weight: 900;
    color: white;
    margin-bottom: 12px;
    line-height: 1.05;
    text-shadow: 0 6px 40px rgba(0,0,0,0.8);
    animation: titleSlideUp 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.1s both;
}

@keyframes titleSlideUp {
    0% { opacity: 0; transform: translateY(40px); }
    100% { opacity: 1; transform: translateY(0); }
}

.sunset-slide-meta {
    display: flex;
    gap: 18px;
    flex-wrap: wrap;
    animation: metaFadeIn 1s cubic-bezier(0.16, 1, 0.3, 1) 0.2s both;
}

@keyframes metaFadeIn {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
}

.sunset-slide-meta span {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.12);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(255,255,255,0.25);
    padding: 8px 18px;
    border-radius: 30px;
    color: white;
    font-size: 0.85rem;
    font-weight: 600;
}

.sunset-slide-meta i {
    color: #ffb347;
}

/* Navigation Arrows */
.sunset-nav-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 64px;
    height: 64px;
    background: rgba(10,20,40,0.7);
    backdrop-filter: blur(20px);
    border: 2px solid rgba(255,179,71,0.5);
    border-radius: 50%;
    color: white;
    font-size: 1.4rem;
    cursor: pointer;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 8px 30px rgba(0,0,0,0.5);
}

.sunset-nav-arrow:hover {
    background: linear-gradient(135deg, #ff7b00, #ff9500);
    border-color: #ffd089;
    transform: translateY(-50%) scale(1.15);
    box-shadow: 0 12px 40px rgba(255,123,0,0.6);
}

.sunset-nav-arrow:active {
    transform: translateY(-50%) scale(0.95);
}

.sunset-nav-prev {
    left: 25px;
}

.sunset-nav-next {
    right: 25px;
}

.sunset-nav-arrow i {
    filter: drop-shadow(0 0 6px rgba(255,255,255,0.4));
}

/* Dots Indicator */
.sunset-dots {
    position: absolute;
    bottom: 25px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 10px;
    z-index: 10;
    background: rgba(10,20,40,0.5);
    backdrop-filter: blur(15px);
    padding: 10px 16px;
    border-radius: 30px;
    border: 1px solid rgba(255,255,255,0.1);
}

.sunset-dot {
    width: 10px;
    height: 10px;
    background: rgba(255,255,255,0.4);
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    border: 1px solid rgba(255,255,255,0.2);
}

.sunset-dot:hover {
    background: rgba(255,179,71,0.7);
    transform: scale(1.3);
}

.sunset-dot.active {
    background: linear-gradient(135deg, #ff7b00, #ffb347);
    width: 36px;
    border-radius: 6px;
    box-shadow: 0 0 20px rgba(255,123,0,0.7);
    border-color: #ffd089;
}

/* Counter */
.sunset-counter {
    position: absolute;
    top: 25px;
    right: 25px;
    background: rgba(10,20,40,0.7);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(255,179,71,0.4);
    color: white;
    padding: 8px 18px;
    border-radius: 30px;
    font-size: 0.85rem;
    font-weight: 700;
    z-index: 10;
    letter-spacing: 1px;
}

.sunset-counter span {
    color: #ffb347;
}

/* Auto-play progress bar */
.sunset-progress {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 4px;
    background: linear-gradient(90deg, #ff7b00, #ffb347, #ffd700);
    z-index: 10;
    width: 0%;
    box-shadow: 0 0 15px rgba(255,123,0,0.7);
}

.sunset-carousel:hover .sunset-progress {
    animation-play-state: paused;
}

@keyframes sunsetProgress {
    0% { width: 0%; }
    100% { width: 100%; }
}

/* Thumbnail Strip */
.sunset-thumb-strip {
    display: flex;
    gap: 10px;
    margin-top: 25px;
    overflow-x: auto;
    padding: 10px 5px;
    scrollbar-width: thin;
    scrollbar-color: rgba(255,123,0,0.5) transparent;
}

.sunset-thumb-strip::-webkit-scrollbar {
    height: 8px;
}

.sunset-thumb-strip::-webkit-scrollbar-track {
    background: rgba(255,255,255,0.05);
    border-radius: 4px;
}

.sunset-thumb-strip::-webkit-scrollbar-thumb {
    background: linear-gradient(90deg, #ff7b00, #ffb347);
    border-radius: 4px;
}

.sunset-thumb {
    flex-shrink: 0;
    width: 100px;
    height: 65px;
    border-radius: 10px;
    background-size: cover;
    background-position: center;
    cursor: pointer;
    border: 2px solid transparent;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    opacity: 0.6;
}

.sunset-thumb:hover {
    opacity: 0.9;
    transform: translateY(-3px);
    border-color: rgba(255,179,71,0.6);
}

.sunset-thumb.active {
    opacity: 1;
    border-color: #ffb347;
    box-shadow: 0 6px 20px rgba(255,123,0,0.5);
    transform: translateY(-3px);
}

.sunset-thumb-number {
    position: absolute;
    top: 3px;
    left: 5px;
    color: white;
    font-size: 0.65rem;
    font-weight: 800;
    background: rgba(0,0,0,0.6);
    padding: 2px 6px;
    border-radius: 4px;
    letter-spacing: 0.5px;
}

/* Responsive Sunset Section */
@media (max-width: 1024px) {
    .sunset-carousel { height: 460px; }
    .sunset-slide-title { font-size: 2.4rem; }
    .sunset-slide-content { padding: 35px; }
}

@media (max-width: 768px) {
    .sunset-carousel { height: 380px; }
    .sunset-slide-title { font-size: 1.8rem; }
    .sunset-slide-content { padding: 25px; }
    .sunset-slide-tag { font-size: 0.7rem; padding: 6px 14px; }
    .sunset-nav-arrow { width: 50px; height: 50px; font-size: 1.1rem; }
    .sunset-nav-prev { left: 12px; }
    .sunset-nav-next { right: 12px; }
    .sunset-slide-meta { gap: 10px; }
    .sunset-slide-meta span { padding: 6px 12px; font-size: 0.75rem; }
}

@media (max-width: 480px) {
    .sunset-carousel { height: 320px; }
    .sunset-slide-title { font-size: 1.4rem; }
    .sunset-slide-content { padding: 18px; }
    .sunset-nav-arrow { width: 42px; height: 42px; font-size: 0.95rem; }
    .sunset-counter { font-size: 0.7rem; padding: 5px 12px; }
    .sunset-thumb { width: 75px; height: 50px; }
}

.portofolio-img-1 { background: linear-gradient(145deg, #1a1a2e 0%, #16213e 100%); }
.portofolio-img-2 { background: linear-gradient(145deg, #1a1a2e 0%, #16213e 100%); }
.portofolio-img-3 { background: linear-gradient(145deg, #1a1a2e 0%, #16213e 100%); }
.portofolio-img-4 { background: linear-gradient(145deg, #1a1a2e 0%, #16213e 100%); }
.portofolio-img-5 { background: linear-gradient(145deg, #1a1a2e 0%, #16213e 100%); }
.portofolio-img-6 { background: linear-gradient(145deg, #1a1a2e 0%, #16213e 100%); }

/* Hapus portofolio-card-overlay - div sudah dihapus dari HTML */

.portofolio-card-tag {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(10px);
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    z-index: 2;
}

.portofolio-card-content {
    padding: 20px;
}

.portofolio-card-content h4 {
    color: white;
    font-size: 1.05rem;
    font-weight: 800;
    margin-bottom: 8px;
    line-height: 1.3;
}

.portofolio-card-content p {
    color: #94a3b8;
    font-size: 0.85rem;
    line-height: 1.5;
    margin-bottom: 12px;
}

.portofolio-card-meta {
    display: flex;
    gap: 15px;
    padding-top: 12px;
    border-top: 1px solid rgba(255, 123, 0, 0.15);
}

.portofolio-card-meta span {
    color: #cbd5e1;
    font-size: 0.8rem;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.portofolio-card-meta i {
    color: #ff7b00;
    font-size: 0.75rem;
}

@media (max-width: 1024px) {
    .portofolio-grid { grid-template-columns: repeat(2, 1fr); }
    .portofolio-title { font-size: 2rem; }
    .partner-track { gap: 18px; animation-duration: 26s; }
    .partner-card { width: 180px; }
}

@media (max-width: 640px) {
    .portofolio-grid { grid-template-columns: 1fr; }
    .portofolio-card-image { height: 150px; }
    .partner-logos { padding: 30px 0; margin-bottom: 30px; }
    .partner-track { gap: 14px; animation-duration: 22s; }
    .partner-card { width: 150px; padding: 18px 14px 14px; border-radius: 14px; gap: 8px; }
    .partner-logo-wrap { width: 80px; height: 80px; padding: 6px; }
    .partner-logo-wrap img { width: 65px; height: 65px; }
    .partner-name { font-size: 0.75rem; line-height: 1.3; }
    .partner-tagline { font-size: 0.62rem; }
}

/* ========== PARTNER LOGOS - CLEAN PROFESSIONAL ========== */
.partner-logos {
    overflow: hidden;
    position: relative;
    padding: 50px 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    margin-bottom: 40px;
    z-index: 10;
    /* Fade edges for premium look */
    -webkit-mask-image: linear-gradient(90deg, transparent 0%, black 8%, black 92%, transparent 100%);
    mask-image: linear-gradient(90deg, transparent 0%, black 8%, black 92%, transparent 100%);
}

/* Inner track that loops infinitely */
.partner-track {
    display: flex;
    gap: 24px;
    width: max-content;
    animation: partnerMarquee 32s linear infinite;
    padding: 0 12px;
}

.partner-track:hover {
    animation-play-state: paused;
}

@keyframes partnerMarquee {
    0%   { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

.partner-card {
    position: relative;
    background: white;
    border-radius: 16px;
    padding: 25px 20px 20px 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    border: 2px solid transparent;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    width: 200px;
    flex-shrink: 0;
    transform: translateY(0);
    animation: none;
    opacity: 1;
}

.partner-card:nth-child(1) { }
.partner-card:nth-child(2) { }
.partner-card:nth-child(3) { }
.partner-card:nth-child(4) { }
.partner-card:nth-child(5) { }

@keyframes slideUpFade {
    0% { opacity: 0; transform: translateY(40px); }
    100% { opacity: 1; transform: translateY(0); }
}

.partner-card:hover {
    transform: translateY(-12px);
    border-color: #ff7b00;
    box-shadow: 0 25px 50px rgba(255, 123, 0, 0.2);
}

.partner-logo-wrap {
    width: 110px;
    height: 110px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8fafc;
    border-radius: 12px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    padding: 10px;
    position: relative;
    overflow: hidden;
}

.partner-logo-wrap::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 60%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,123,0,0.2), transparent);
    transition: left 0.7s ease;
}

.partner-card:hover .partner-logo-wrap::before {
    left: 150%;
}

.partner-card:hover .partner-logo-wrap {
    background: #fff5eb;
    transform: scale(1.1);
}

.partner-logo-wrap img {
    width: 90px;
    height: 90px;
    object-fit: contain;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    z-index: 1;
}

.partner-card:hover .partner-logo-wrap img {
    transform: scale(1.12);
    filter: drop-shadow(0 8px 20px rgba(255,123,0,0.35));
}

.partner-name {
    font-size: 0.85rem;
    font-weight: 700;
    color: #1e293b;
    text-align: center;
    transition: all 0.3s ease;
    position: relative;
}

.partner-card:hover .partner-name {
    color: #ff7b00;
    transform: scale(1.05);
}

.partner-tagline {
    font-size: 0.7rem;
    color: #94a3b8;
    text-align: center;
    transition: all 0.3s ease;
}

.partner-card:hover .partner-tagline {
    color: #64748b;
}

.partner-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 3px;
    background: linear-gradient(90deg, #ff7b00, #ff9500, #ff7b00);
    background-size: 200% 100%;
    border-radius: 0 0 3px 3px;
    transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    animation: gradientMove 2s linear infinite paused;
}

.partner-card:hover::before {
    width: 60%;
    animation: gradientMove 1.5s linear infinite;
}

@keyframes gradientMove {
    0% { background-position: 0% 0%; }
    100% { background-position: 200% 0%; }
}

.partner-card:hover {
    animation-play-state: running;
}

/* ========== EVENT CATEGORIES SECTION ========== */
.event-categories-section {
    margin-top: 60px;
    padding-top: 40px;
    border-top: 1px solid rgba(255,123,0,0.2);
    position: relative;
    z-index: 10;
}

.event-category-block {
    margin-bottom: 80px;
    position: relative;
    z-index: 10;
}

.event-category-block:last-child {
    margin-bottom: 0;
}

.event-category-header {
    text-align: center;
    margin-bottom: 40px;
    position: relative;
    z-index: 10;
}

.event-category-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, rgba(255,123,0,0.2), rgba(255,123,0,0.1));
    color: #ff7b00;
    padding: 8px 22px;
    border-radius: 30px;
    font-size: 0.85rem;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    border: 1px solid rgba(255,123,0,0.4);
    margin-bottom: 18px;
    box-shadow: 0 4px 15px rgba(255,123,0,0.2);
}

.event-category-badge-2 {
    background: linear-gradient(135deg, rgba(168,85,247,0.2), rgba(236,72,153,0.1));
    color: #e879f9;
    border-color: rgba(168,85,247,0.4);
    box-shadow: 0 4px 15px rgba(168,85,247,0.2);
}

.event-category-title {
    font-size: 2.2rem;
    font-weight: 800;
    color: white;
    margin-bottom: 12px;
    line-height: 1.2;
}

.event-category-subtitle {
    color: #94a3b8;
    font-size: 1rem;
    max-width: 600px;
    margin: 0 auto;
}

/* Corporate Event Grid */
.event-category-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-top: 30px;
    position: relative;
    z-index: 10;
}

.event-card {
    background: rgba(26,26,46,0.95);
    border: 1px solid rgba(255,123,0,0.2);
    border-radius: 18px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    cursor: pointer;
    position: relative;
    z-index: 10;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.event-card:hover {
    transform: translateY(-8px);
    border-color: rgba(255,123,0,0.5);
    box-shadow: 0 20px 50px rgba(255,123,0,0.2);
}

.event-card-image {
    position: relative;
    height: 180px;
    background-color: transparent !important;
    background-size: cover !important;
    background-position: center !important;
    background-repeat: no-repeat !important;
    overflow: hidden;
}

/* Featured Event Card (BESAR) - untuk HALAL BILHALAL dan GKM PROJECT */
.event-card-featured {
    position: relative;
    background: rgba(26,26,46,0.95);
    border: 2px solid rgba(255,123,0,0.4);
    border-radius: 24px;
    overflow: hidden;
    transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    cursor: pointer;
    box-shadow:
        0 0 0 1px rgba(255,123,0,0.1),
        0 25px 60px rgba(255,123,0,0.15),
        0 4px 20px rgba(0, 0, 0, 0.3);
    z-index: 10;
}

.event-card-featured:hover {
    transform: translateY(-5px);
    border-color: rgba(255,123,0,0.7);
    box-shadow:
        0 0 0 1px rgba(255,123,0,0.2),
        0 35px 80px rgba(255,123,0,0.25),
        0 8px 30px rgba(0, 0, 0, 0.4);
}

.event-card-featured .event-card-image {
    position: relative;
    height: 380px;
    background-color: transparent !important;
    background-size: cover !important;
    background-position: center !important;
    background-repeat: no-repeat !important;
    overflow: hidden;
}

.event-card-featured .event-card-content {
    padding: 25px 30px;
    text-align: center;
}

.event-card-featured .event-card-content h4 {
    color: white;
    font-size: 1.4rem;
    font-weight: 800;
    margin-bottom: 8px;
    line-height: 1.3;
}

/* Layout featured + grid */
.event-featured-layout {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 25px;
    margin-top: 30px;
    position: relative;
    z-index: 10;
    align-items: stretch;
}

.event-featured-layout .event-category-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-top: 0;
}

@media (max-width: 1024px) {
    .event-featured-layout {
        grid-template-columns: 1fr;
    }
    .event-featured-layout .event-category-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    .event-card-featured .event-card-image {
        height: 280px;
    }
}

@media (max-width: 640px) {
    .event-featured-layout .event-category-grid {
        grid-template-columns: 1fr;
    }
    .event-card-featured .event-card-image {
        height: 220px;
    }
}

.event-card-image-2 {
    background-color: transparent !important;
}

.event-card-image-3 {
    background-color: transparent !important;
}

.event-card-image-4 {
    background-color: transparent !important;
}

/* Hapus gradient warna yang menutupi gambar konser, ganti dengan gradient gelap netral */

.event-card-overlay {
    position: absolute;
    inset: 0;
    background: transparent;
    display: none;
}

.event-card-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 70px;
    height: 70px;
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.8rem;
    z-index: 2;
    transition: all 0.4s ease;
    border: 2px solid rgba(255,255,255,0.3);
}

.event-card:hover .event-card-icon {
    transform: scale(1.15) rotate(-8deg);
    background: rgba(255,255,255,0.3);
}

.event-card-content {
    padding: 20px;
}

.event-card-content h4 {
    color: white;
    font-size: 1.05rem;
    font-weight: 800;
    margin-bottom: 8px;
    line-height: 1.3;
}

.event-card-content p {
    color: #94a3b8;
    font-size: 0.85rem;
    line-height: 1.5;
    margin-bottom: 12px;
}

.event-card-tags {
    display: flex;
    gap: 8px;
}

.event-card-tags span {
    background: rgba(255,123,0,0.15);
    color: #ff7b00;
    padding: 4px 10px;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 700;
    border: 1px solid rgba(255,123,0,0.3);
}

/* Konser Event Layout */
.konser-layout {
    display: grid;
    grid-template-columns: 1.3fr 1fr;
    gap: 30px;
    margin-top: 30px;
    position: relative;
    z-index: 10;
}

.konser-featured {
    position: relative;
    background-color: transparent !important;
    background-size: cover !important;
    background-position: center !important;
    border: 2px solid rgba(168,85,247,0.4);
    border-radius: 24px;
    padding: 40px;
    overflow: hidden;
    box-shadow:
        0 0 0 1px rgba(168,85,247,0.1),
        0 25px 60px rgba(168,85,247,0.2),
        0 4px 20px rgba(0, 0, 0, 0.3);
    min-height: 100%;
    z-index: 10;
}

/* Hapus overlay gelap di featured konser agar gambar terlihat jelas */

.konser-featured-content {
    position: relative;
    z-index: 2;
}

.konser-featured-bg {
    position: absolute;
    top: -50%;
    right: -30%;
    width: 500px;
    height: 500px;
    background: transparent;
    border-radius: 50%;
    filter: blur(60px);
    animation: none;
    display: none;
}

@keyframes konserFeaturedGlow {
    0%, 100% { opacity: 0.5; transform: scale(1) rotate(0deg); }
    50% { opacity: 0.8; transform: scale(1.2) rotate(180deg); }
}

.konser-featured-content {
    position: relative;
    z-index: 2;
}

.konser-featured-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: linear-gradient(135deg, #a855f7, #ec4899);
    color: white;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 800;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 18px;
    box-shadow: 0 4px 15px rgba(168,85,247,0.4);
}

.konser-featured-title {
    font-size: 1.8rem;
    font-weight: 800;
    color: white;
    margin-bottom: 15px;
    line-height: 1.2;
}

.konser-featured-desc {
    color: #cbd5e1;
    line-height: 1.7;
    margin-bottom: 20px;
    font-size: 0.95rem;
}

.konser-featured-list {
    list-style: none;
    padding: 0;
    margin: 0 0 25px 0;
}

.konser-featured-list li {
    color: #cbd5e1;
    padding: 6px 0;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.9rem;
}

.konser-featured-list li i {
    color: #a855f7;
    font-size: 1rem;
}

.konser-featured-stats {
    display: flex;
    gap: 25px;
    padding-top: 20px;
    border-top: 1px solid rgba(168,85,247,0.2);
}

.konser-stat {
    display: flex;
    flex-direction: column;
}

.konser-stat strong {
    color: white;
    font-size: 1.5rem;
    font-weight: 800;
    background: linear-gradient(135deg, #a855f7, #ec4899);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.konser-stat span {
    color: #94a3b8;
    font-size: 0.8rem;
    margin-top: 2px;
}

/* Konser Grid */
.konser-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
    position: relative;
    z-index: 10;
}

.konser-card {
    background: transparent;
    background-size: cover !important;
    background-position: center !important;
    border: 1px solid rgba(168,85,247,0.2);
    border-radius: 18px;
    padding: 25px 20px;
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    position: relative;
    overflow: hidden;
    z-index: 10;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

/* Hapus overlay agar gambar konser terlihat jelas */

.konser-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(168,85,247,0.1), transparent);
    transition: left 0.6s ease;
    z-index: 0;
}

.konser-card > * {
    position: relative;
    z-index: 2;
}

.konser-card:hover {
    transform: translateY(-5px);
    border-color: rgba(168,85,247,0.5);
    box-shadow: 0 15px 40px rgba(168,85,247,0.2);
}

.konser-card:hover::before {
    left: 100%;
}

.konser-card-icon {
    width: 55px;
    height: 55px;
    background: linear-gradient(135deg, #a855f7, #ec4899);
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.4rem;
    margin-bottom: 15px;
    box-shadow: 0 8px 20px rgba(168,85,247,0.3);
    transition: all 0.3s ease;
}

.konser-card-icon-2 { background: linear-gradient(135deg, #ec4899, #f59e0b); box-shadow: 0 8px 20px rgba(236,72,153,0.3); }
.konser-card-icon-3 { background: linear-gradient(135deg, #3b82f6, #a855f7); box-shadow: 0 8px 20px rgba(59,130,246,0.3); }
.konser-card-icon-4 { background: linear-gradient(135deg, #06b6d4, #a855f7); box-shadow: 0 8px 20px rgba(6,182,212,0.3); }

.konser-card:hover .konser-card-icon {
    transform: scale(1.1) rotate(-10deg);
}

.konser-card h4 {
    color: white;
    font-size: 1rem;
    font-weight: 800;
    margin-bottom: 8px;
    line-height: 1.3;
}

.konser-card p {
    color: #94a3b8;
    font-size: 0.85rem;
    line-height: 1.5;
    margin-bottom: 12px;
}

.konser-card-tag {
    display: inline-block;
    background: rgba(168,85,247,0.15);
    color: #e879f9;
    padding: 4px 10px;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 700;
    border: 1px solid rgba(168,85,247,0.3);
}

/* Responsive Event Section */
@media (max-width: 1024px) {
    .event-category-grid { grid-template-columns: repeat(2, 1fr); }
    .konser-layout { grid-template-columns: 1fr; }
    .konser-grid { grid-template-columns: 1fr 1fr; }
    .event-category-title { font-size: 1.8rem; }
}

@media (max-width: 640px) {
    .event-category-grid { grid-template-columns: 1fr; }
    .konser-grid { grid-template-columns: 1fr; }
    .konser-featured { padding: 25px 20px; }
    .konser-featured-title { font-size: 1.4rem; }
    .konser-featured-stats { flex-wrap: wrap; gap: 15px; }
}

.stats-row {
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-wrap: wrap;
    gap: 40px;
    text-align: center;
    padding: 20px 0;
    position: relative;
    z-index: 10;
    background-color: #0a1428;
}

.stats-row-centered {
    justify-content: center;
    gap: 100px;
}

.stat-item {
    flex: 1;
    min-width: 180px;
    padding: 25px 20px;
    border-radius: 16px;
    transition: all 0.3s ease;
    position: relative;
    z-index: 10;
    background: linear-gradient(145deg, #1a1a2e 0%, #16213e 100%);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.stat-item:hover {
    background: rgba(255, 123, 0, 0.05);
    transform: translateY(-5px);
}

.stat-item .stat-number {
    font-size: 5.5rem;
    font-weight: 900;
    color: #ffffff;
    font-family: 'Plus Jakarta Sans', sans-serif;
    line-height: 1;
    background: linear-gradient(135deg, #ffffff 0%, #ff7b00 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-shadow: none;
    filter: drop-shadow(0 2px 8px rgba(255, 123, 0, 0.3));
}

.stat-item .stat-label {
    font-size: 1.3rem;
    color: #cbd5e1;
    margin-top: 12px;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

@media (max-width: 768px) {
    .stat-item .stat-number {
        font-size: 4rem;
    }
    .stat-item .stat-label {
        font-size: 1.05rem;
    }
    .stats-row-centered {
        gap: 50px;
    }
}

@media (max-width: 480px) {
    .stat-item .stat-number {
        font-size: 3.2rem;
    }
    .stat-item .stat-label {
        font-size: 0.95rem;
    }
    .stat-item {
        min-width: 140px;
        padding: 15px 10px;
    }
    .stats-row-centered {
        gap: 30px;
    }
}

/* ========== MILESTONE BADGE (250+ project terselesaikan) ========== */
.milestone-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    margin-left: 10px;
    border-radius: 50%;
    background: linear-gradient(135deg, #ff7b00 0%, #ffb347 50%, #ffd700 100%);
    color: #ffffff;
    font-size: 1rem;
    box-shadow:
        0 0 0 3px rgba(255, 123, 0, 0.25),
        0 6px 20px rgba(255, 123, 0, 0.55),
        inset 0 1px 0 rgba(255, 255, 255, 0.4);
    vertical-align: middle;
    position: relative;
    animation: milestonePulse 2.2s ease-in-out infinite, milestoneShine 4s linear infinite;
    background-size: 200% 200%;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.milestone-badge:hover {
    transform: scale(1.15) rotate(-8deg);
}

.milestone-badge::before {
    content: '';
    position: absolute;
    inset: -6px;
    border-radius: 50%;
    border: 2px dashed rgba(255, 179, 71, 0.6);
    animation: milestoneSpin 6s linear infinite;
    pointer-events: none;
}

.milestone-badge::after {
    content: '+';
    position: absolute;
    top: -6px;
    right: -6px;
    width: 22px;
    height: 22px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #ffffff;
    color: #ff7b00;
    font-size: 0.85rem;
    font-weight: 900;
    border-radius: 50%;
    border: 2px solid #ff7b00;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.35);
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.milestone-plus {
    display: inline-block;
    margin-left: 4px;
    color: #ff7b00;
    font-weight: 900;
    font-size: 1.1em;
    text-shadow: 0 0 10px rgba(255, 123, 0, 0.7);
    animation: plusBlink 1.6s ease-in-out infinite;
}

@keyframes milestonePulse {
    0%, 100% {
        box-shadow:
            0 0 0 3px rgba(255, 123, 0, 0.25),
            0 6px 20px rgba(255, 123, 0, 0.55),
            inset 0 1px 0 rgba(255, 255, 255, 0.4);
        transform: scale(1);
    }
    50% {
        box-shadow:
            0 0 0 8px rgba(255, 123, 0, 0.15),
            0 10px 30px rgba(255, 179, 71, 0.75),
            inset 0 1px 0 rgba(255, 255, 255, 0.6);
        transform: scale(1.08);
    }
}

@keyframes milestoneShine {
    0%   { background-position: 0% 50%; }
    100% { background-position: 200% 50%; }
}

@keyframes milestoneSpin {
    0%   { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes plusBlink {
    0%, 100% { opacity: 1; transform: scale(1); }
    50%      { opacity: 0.7; transform: scale(1.2); }
}

@media (max-width: 768px) {
    .milestone-badge {
        width: 30px;
        height: 30px;
        font-size: 0.85rem;
        margin-left: 6px;
    }
    .milestone-badge::after {
        width: 18px;
        height: 18px;
        font-size: 0.7rem;
        top: -4px;
        right: -4px;
    }
}

/* ========== MILESTONE CELEBRATION (one-shot, 250+ project terselesaikan) ========== */
.milestone-celebration {
    animation:
        milestoneCelebrateBounce 0.6s cubic-bezier(0.34, 1.56, 0.64, 1),
        milestoneCelebrateGlow 1.2s ease-out !important;
}

@keyframes milestoneCelebrateBounce {
    0%   { transform: scale(1) rotate(0deg); }
    30%  { transform: scale(1.5) rotate(-15deg); }
    55%  { transform: scale(0.9) rotate(12deg); }
    80%  { transform: scale(1.2) rotate(-6deg); }
    100% { transform: scale(1) rotate(0deg); }
}

@keyframes milestoneCelebrateGlow {
    0% {
        filter: drop-shadow(0 0 0 rgba(255, 215, 0, 0));
        box-shadow:
            0 0 0 0 rgba(255, 215, 0, 0),
            0 0 0 8px rgba(255, 215, 0, 0.5),
            0 0 0 16px rgba(255, 215, 0, 0.3),
            0 0 60px rgba(255, 215, 0, 0.8),
            inset 0 1px 0 rgba(255, 255, 255, 0.6);
    }
    100% {
        filter: drop-shadow(0 0 14px rgba(255, 215, 0, 0.7));
        box-shadow:
            0 0 0 3px rgba(255, 123, 0, 0.25),
            0 6px 20px rgba(255, 123, 0, 0.55),
            inset 0 1px 0 rgba(255, 255, 255, 0.4);
    }
}

/* Confetti particles melayang keluar dari badge */
.milestone-confetti {
    position: fixed;
    z-index: 9999;
    font-size: 1.4rem;
    pointer-events: none;
    transform: translate(-50%, -50%);
    animation: milestoneConfettiFly 2.2s cubic-bezier(0.22, 1, 0.36, 1) forwards;
    filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.35));
}

@keyframes milestoneConfettiFly {
    0% {
        opacity: 0;
        transform: translate(-50%, -50%) scale(0.3) rotate(0deg);
    }
    15% {
        opacity: 1;
        transform:
            translate(
                calc(-50% + var(--tx, 0px) * 0.3),
                calc(-50% + var(--ty, 0px) * 0.5)
            )
            scale(1.2)
            rotate(calc(var(--rot, 0deg) * 0.3));
    }
    100% {
        opacity: 0;
        transform:
            translate(
                calc(-50% + var(--tx, 0px)),
                calc(-50% + var(--ty, 0px) + 80px)
            )
            scale(0.7)
            rotate(var(--rot, 0deg));
    }
}


        /* Animasi untuk teks penyemangat (muncul dari bawah perlahan) */
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(15px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        
        .subtitle-anim {
            opacity: 0; /* Sengaja disembunyikan di awal */
            /* Animasi berjalan selama 1.5 detik, dan baru mulai setelah delay 1.5 detik (menunggu teks ngetik selesai) */
            animation: fadeInUp 1.5s ease-out 1.5s forwards;
        }

        /* ========== RESPONSIVE NAVBAR ========== */
        @media (max-width: 992px) {
            .navbar-dashboard {
                padding: 8px 20px;
            }

            .navbar-brand {
                gap: 0;
            }

            .navbar-logo {
                width: 70px !important;
                height: 70px !important;
                margin-right: -8px;
            }

            .navbar-brand-text {
                margin-left: -3px;
            }

            .navbar-brand-name {
                font-size: 0.9rem !important;
            }

            .navbar-brand-tagline {
                font-size: 0.45rem !important;
                letter-spacing: 1.5px !important;
            }
        }

        @media (max-width: 480px) {
            .navbar-logo {
                width: 60px !important;
                height: 60px !important;
            }

            .navbar-brand-name {
                font-size: 0.9rem !important;
            }

            .navbar-brand-tagline {
                display: none;
            }
        }

        /* ========== CIAMIK BURGER BUTTON (DASHBOARD) ========== */
        .navbar-burger {
            display: none;
            position: relative;
            width: 46px;
            height: 46px;
            background: linear-gradient(135deg, rgba(255, 123, 0, 0.18), rgba(255, 149, 0, 0.06));
            border: 1px solid rgba(255, 123, 0, 0.5);
            border-radius: 14px;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            flex-shrink: 0;
            overflow: hidden;
            isolation: isolate;
        }

        /* Shine sweep on hover */
        .navbar-burger::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 60%;
            height: 100%;
            background: linear-gradient(110deg, transparent 30%, rgba(255, 255, 255, 0.35) 50%, transparent 70%);
            transform: skewX(-20deg);
            transition: left 0.7s ease;
            z-index: 1;
            pointer-events: none;
        }

        .navbar-burger:hover::before {
            left: 130%;
        }

        /* Glow ring on hover */
        .navbar-burger::after {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: 16px;
            background: radial-gradient(circle at center, rgba(255, 123, 0, 0.45) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: -1;
            filter: blur(8px);
        }

        .navbar-burger:hover {
            background: linear-gradient(135deg, rgba(255, 123, 0, 0.28), rgba(255, 149, 0, 0.1));
            border-color: #ffb347;
            transform: translateY(-2px) scale(1.04);
            box-shadow:
                0 10px 26px rgba(255, 123, 0, 0.4),
                0 0 0 4px rgba(255, 123, 0, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.15);
        }

        .navbar-burger:hover::after {
            opacity: 1;
        }

        .navbar-burger:active {
            transform: translateY(0) scale(0.96);
        }

        /* 3 morphing bars */
        .navbar-burger-bars {
            position: relative;
            width: 22px;
            height: 16px;
            z-index: 2;
        }

        .navbar-burger-bar {
            position: absolute;
            left: 0;
            width: 100%;
            height: 2.5px;
            background: linear-gradient(90deg, #ffd089, #ff7b00);
            border-radius: 2px;
            transition: all 0.45s cubic-bezier(0.68, -0.55, 0.27, 1.55);
            box-shadow: 0 0 8px rgba(255, 123, 0, 0.55);
        }

        .navbar-burger-bar:nth-child(1) { top: 0; }
        .navbar-burger-bar:nth-child(2) { top: 50%; transform: translateY(-50%); }
        .navbar-burger-bar:nth-child(3) { bottom: 0; }

        /* Morph to X when active */
        .navbar-burger.is-active .navbar-burger-bar:nth-child(1) {
            top: 50%;
            transform: translateY(-50%) rotate(45deg);
            background: linear-gradient(90deg, #fca5a5, #ef4444);
            box-shadow: 0 0 10px rgba(239, 68, 68, 0.6);
        }
        .navbar-burger.is-active .navbar-burger-bar:nth-child(2) {
            opacity: 0;
            transform: translateY(-50%) scaleX(0);
        }
        .navbar-burger.is-active .navbar-burger-bar:nth-child(3) {
            bottom: 50%;
            transform: translateY(50%) rotate(-45deg);
            background: linear-gradient(90deg, #fca5a5, #ef4444);
            box-shadow: 0 0 10px rgba(239, 68, 68, 0.6);
        }

        /* Decorative pulsing dot */
        .navbar-burger-dot {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 8px;
            height: 8px;
            background: #ffd089;
            border: 1.5px solid rgba(10, 20, 40, 0.9);
            border-radius: 50%;
            z-index: 3;
            box-shadow: 0 0 10px #ffb347;
            animation: burgerDotPulse 2s ease-in-out infinite;
        }

        .navbar-burger.is-active .navbar-burger-dot {
            opacity: 0;
            transform: scale(0);
        }

        @keyframes burgerDotPulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%      { opacity: 0.4; transform: scale(1.4); }
        }

        /* ========== PREMIUM MOBILE MENU PANEL (DASHBOARD) ========== */
        .navbar-mobile-menu {
            display: none;
            position: absolute;
            top: calc(100% + 10px);
            left: 16px;
            right: 16px;
            padding: 8px;
            background: linear-gradient(180deg, rgba(15, 23, 42, 0.98), rgba(10, 20, 40, 0.98));
            backdrop-filter: blur(28px) saturate(160%);
            -webkit-backdrop-filter: blur(28px) saturate(160%);
            border: 1px solid rgba(255, 123, 0, 0.4);
            border-radius: 20px;
            flex-direction: column;
            gap: 4px;
            z-index: 200;
            box-shadow:
                0 30px 70px rgba(0, 0, 0, 0.6),
                0 0 30px rgba(255, 123, 0, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.08);
            overflow: hidden;
            transform-origin: top right;
            animation: dashboardMobileMenuPop 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .navbar-mobile-menu::before {
            content: '';
            position: absolute;
            top: 0;
            left: 16px;
            right: 16px;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 123, 0, 0.7), transparent);
            opacity: 0.8;
        }

        .navbar-mobile-menu.is-open {
            display: flex;
        }

        @keyframes dashboardMobileMenuPop {
            from { opacity: 0; transform: translateY(-12px) scale(0.96); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        .navbar-mobile-menu .navbar-link,
        .navbar-mobile-menu .navbar-btn-special,
        .navbar-mobile-menu .navbar-btn-login {
            width: 100%;
            padding: 12px 16px;
            font-size: 0.88rem;
            border-radius: 12px;
            justify-content: flex-start;
            text-align: left;
            transition: all 0.25s ease;
            position: relative;
        }

        .navbar-mobile-menu .navbar-link::before {
            content: '';
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%) scaleX(0);
            transform-origin: left;
            width: 3px;
            height: 18px;
            background: linear-gradient(180deg, #ffd089, #ff7b00);
            border-radius: 2px;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .navbar-mobile-menu .navbar-link:active::before,
        .navbar-mobile-menu .navbar-link.active::before {
            transform: translateY(-50%) scaleX(1);
        }

        .navbar-mobile-menu .navbar-link:active,
        .navbar-mobile-menu .navbar-link.active {
            background: rgba(255, 123, 0, 0.12);
            color: #ffb347;
            padding-left: 26px;
        }

        .navbar-mobile-menu .navbar-btn-special,
        .navbar-mobile-menu .navbar-btn-login {
            margin-top: 4px;
            text-align: center;
            justify-content: center;
            padding: 12px 16px;
        }

        @media (max-width: 992px) {
            .navbar-burger {
                display: inline-flex;
            }
            .navbar-menu {
                display: none !important;
            }
        }

        @media (max-width: 380px) {
            .navbar-brand-text {
                display: none;
            }
            .navbar-dashboard {
                padding: 8px 14px;
            }
            .navbar-burger {
                width: 42px;
                height: 42px;
            }
        }


    </style>
</head>


<body>

    @include('partials.header')

    <section class="hero-container">

        <div class="hero-content">
            
            {{-- ========== HERO: TEKS MENGETIK DI LATAR PUTIH ========== --}}
            <div class="hero-typing">
                <canvas class="hero-dot-grid" aria-hidden="true"></canvas>
                <h1 class="hero-typing-title" aria-label="Multimedia Production and Equipment">
                    @php
                        /* Urutan --i per huruf; spasi antar kata ikut dihitung agar ada jeda kecil */
                        $heroWords = [];
                        $heroCharacterIndex = 0;
                        foreach (['Multimedia', 'Production', 'and', 'Equipment'] as $heroWord) {
                            $heroCharacters = [];
                            foreach (mb_str_split($heroWord) as $heroCharacter) {
                                $heroCharacters[] = ['character' => $heroCharacter, 'index' => $heroCharacterIndex++];
                            }
                            $heroWords[] = $heroCharacters;
                            $heroCharacterIndex++;
                        }
                    @endphp
                    <span class="hero-typing-text" aria-hidden="true">@foreach ($heroWords as $heroCharacters)<span class="hero-word">@foreach ($heroCharacters as $heroCharacter)<span class="hero-char" style="--i: {{ $heroCharacter['index'] }}">{{ $heroCharacter['character'] }}</span>@endforeach</span>{{ $loop->last ? '' : ' ' }}@endforeach</span>
                </h1>
            </div>

            <script src="{{ asset('js/hero-dot-grid.js') }}?v={{ @filemtime(public_path('js/hero-dot-grid.js')) }}" defer></script>

        </div>

    </section>

    <div style="clear: both;"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Trigger popup animations
            setTimeout(() => {
                document.querySelectorAll('.welcome-badge, .welcome-title, .welcome-divider, .welcome-subtitle, .welcome-actions, .welcome-scrolldown').forEach(el => {
                    el.classList.add('popup-visible');
                });
            }, 100);
        });
    </script>

    <script>
        // ============================================
        // ===== SUNSET DI KEBUN CAROUSEL SCRIPT =====
        // ============================================
        document.addEventListener("DOMContentLoaded", function() {
            const track = document.getElementById('sunsetSlidesTrack');
            const slides = track ? track.querySelectorAll('.sunset-slide') : [];
            const totalSlides = slides.length;
            const dots = document.querySelectorAll('#sunsetDots .sunset-dot');
            const thumbs = document.querySelectorAll('#sunsetThumbStrip .sunset-thumb');
            const prevBtn = document.getElementById('sunsetPrev');
            const nextBtn = document.getElementById('sunsetNext');
            const currentLabel = document.getElementById('sunsetCurrentSlide');
            const progressBar = document.getElementById('sunsetProgress');

            if (!track || totalSlides === 0) return;

            let currentIndex = 0;
            let autoPlayTimer = null;
            const autoPlayDuration = 5000; // 5 detik per slide

            function goToSlide(index, smooth = true) {
                if (index < 0) index = totalSlides - 1;
                if (index >= totalSlides) index = 0;
                currentIndex = index;

                if (smooth) {
                    track.style.transition = 'transform 0.7s cubic-bezier(0.16, 1, 0.3, 1)';
                } else {
                    track.style.transition = 'none';
                }
                track.style.transform = `translateX(-${currentIndex * 100}%)`;

                // Update counter
                if (currentLabel) {
                    currentLabel.textContent = String(currentIndex + 1).padStart(2, '0');
                }

                // Update dots
                dots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === currentIndex);
                });

                // Update thumbnails
                thumbs.forEach((thumb, i) => {
                    thumb.classList.toggle('active', i === currentIndex);
                });

                // Restart progress bar animation
                if (progressBar) {
                    progressBar.style.animation = 'none';
                    void progressBar.offsetWidth; // reflow
                    progressBar.style.animation = `sunsetProgress ${autoPlayDuration}ms linear infinite`;
                }

                // Re-trigger slide-in animation for content
                const activeContent = slides[currentIndex].querySelector('.sunset-slide-content');
                if (activeContent) {
                    const tag = activeContent.querySelector('.sunset-slide-tag');
                    const title = activeContent.querySelector('.sunset-slide-title');
                    const meta = activeContent.querySelector('.sunset-slide-meta');

                    if (tag) {
                        tag.style.animation = 'none';
                        void tag.offsetWidth;
                        tag.style.animation = 'tagBounceIn 0.8s cubic-bezier(0.16, 1, 0.3, 1)';
                    }
                    if (title) {
                        title.style.animation = 'none';
                        void title.offsetWidth;
                        title.style.animation = 'titleSlideUp 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.1s both';
                    }
                    if (meta) {
                        meta.style.animation = 'none';
                        void meta.offsetWidth;
                        meta.style.animation = 'metaFadeIn 1s cubic-bezier(0.16, 1, 0.3, 1) 0.2s both';
                    }
                }
            }

            function nextSlide() {
                goToSlide(currentIndex + 1);
            }

            function prevSlide() {
                goToSlide(currentIndex - 1);
            }

            function startAutoPlay() {
                stopAutoPlay();
                autoPlayTimer = setInterval(nextSlide, autoPlayDuration);
            }

            function stopAutoPlay() {
                if (autoPlayTimer) {
                    clearInterval(autoPlayTimer);
                    autoPlayTimer = null;
                }
            }

            // Event Listeners - Arrow Buttons
            if (nextBtn) {
                nextBtn.addEventListener('click', function() {
                    nextSlide();
                    startAutoPlay();
                });
            }
            if (prevBtn) {
                prevBtn.addEventListener('click', function() {
                    prevSlide();
                    startAutoPlay();
                });
            }

            // Event Listeners - Dots
            dots.forEach((dot) => {
                dot.addEventListener('click', function() {
                    const index = parseInt(this.getAttribute('data-slide'), 10);
                    goToSlide(index);
                    startAutoPlay();
                });
            });

            // Event Listeners - Thumbnails (auto scroll into view)
            thumbs.forEach((thumb) => {
                thumb.addEventListener('click', function() {
                    const index = parseInt(this.getAttribute('data-slide'), 10);
                    goToSlide(index);
                    startAutoPlay();
                    // Scroll thumbnail into view smoothly
                    this.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
                });
            });

            // Pause autoplay on hover
            const carousel = document.getElementById('sunsetCarousel');
            if (carousel) {
                carousel.addEventListener('mouseenter', stopAutoPlay);
                carousel.addEventListener('mouseleave', startAutoPlay);
            }

            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                const sunsetSection = document.getElementById('sunset-kebun');
                if (!sunsetSection) return;
                const rect = sunsetSection.getBoundingClientRect();
                const isVisible = rect.top < window.innerHeight && rect.bottom > 0;
                if (!isVisible) return;

                if (e.key === 'ArrowLeft') {
                    prevSlide();
                    startAutoPlay();
                } else if (e.key === 'ArrowRight') {
                    nextSlide();
                    startAutoPlay();
                }
            });

            // Touch / Swipe support
            let touchStartX = 0;
            let touchEndX = 0;
            if (carousel) {
                carousel.addEventListener('touchstart', function(e) {
                    touchStartX = e.changedTouches[0].screenX;
                }, { passive: true });

                carousel.addEventListener('touchend', function(e) {
                    touchEndX = e.changedTouches[0].screenX;
                    const diff = touchStartX - touchEndX;
                    if (Math.abs(diff) > 50) {
                        if (diff > 0) {
                            nextSlide();
                        } else {
                            prevSlide();
                        }
                        startAutoPlay();
                    }
                }, { passive: true });
            }

            // Initialize
            goToSlide(0);
            startAutoPlay();
        });
    </script>

    {{-- ============================================ --}}
    {{-- ========== PORTFOLIO & CONTENT SECTION ========== --}}
    {{-- ============================================ --}}
    {{-- Pembuka Portofolio (sinematik, pin + scroll) --}}
    @include('partials.portfolio-intro')

    <section class="stats-testimoni-section" id="proyek" style="clear: both; padding-top: 80px;">
    <div class="stats-testimoni-wrapper" style="max-width: 1400px; margin: 0 auto;">

        {{-- Portofolio Project (gaya editorial) --}}
        <div class="portofolio-section vp-portfolio">
            <div class="vp-section-intro">
                <h2 class="vp-section-heading">Hasil karya Visual Production.</h2>
                <p class="vp-section-lead">Beberapa project terbaik yang telah kami kerjakan untuk klien dari berbagai industri.</p>
            </div>

            {{-- Slider project unggulan: id dipertahankan untuk script carousel --}}
            <div class="vp-showcase" id="sunset-kebun">
                <div class="vp-showcase-frame" id="sunsetCarousel">
                    <div class="sunset-slides-viewport">
                        <div class="sunset-slides-track" id="sunsetSlidesTrack">
                            @foreach (range(1, 14) as $slideNumber)
                                <div class="sunset-slide" role="img" aria-label="Sunset Di Kebun, foto {{ $slideNumber }}" style="background-image: url('{{ asset("images/SUNSET{$slideNumber}.webp") }}');"></div>
                            @endforeach
                        </div>
                    </div>

                    <div class="vp-showcase-shade" aria-hidden="true"></div>

                    <div class="vp-showcase-caption">
                        <h3 class="vp-showcase-name">Sunset Di Kebun</h3>
                        <p class="vp-showcase-meta">Festival · 2025</p>
                    </div>

                    <div class="vp-showcase-controls">
                        <span class="vp-showcase-counter" aria-live="polite">
                            <span id="sunsetCurrentSlide">01</span> / <span id="sunsetTotalSlides">14</span>
                        </span>
                        <button type="button" class="vp-showcase-arrow vp-showcase-arrow--prev" id="sunsetPrev" aria-label="Foto sebelumnya">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M20 12H4M4 12L10 6M4 12L10 18" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <button type="button" class="vp-showcase-arrow vp-showcase-arrow--next" id="sunsetNext" aria-label="Foto berikutnya">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M4 12H20M20 12L14 6M20 12L14 18" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Project unggulan kedua: gaya sama persis dengan slider Sunset Di Kebun --}}
            <div class="vp-showcase">
                <div class="vp-showcase-frame manual-slideshow" data-counter-pad="2">
                    @foreach (['paradic1.webp', 'paradic3.webp', 'paradic1.webp'] as $image)
                        <div @class(['manual-slide', 'manual-slide-active' => $loop->first]) role="img" aria-label="Paradicfest Vol 2, foto {{ $loop->iteration }}" style="background-image: url('{{ asset('images/'.$image) }}');"></div>
                    @endforeach

                    <div class="vp-showcase-shade" aria-hidden="true"></div>

                    <div class="vp-showcase-caption">
                        <h3 class="vp-showcase-name">Paradicfest Vol 2</h3>
                        <p class="vp-showcase-meta">Festival · Multicam · 2025</p>
                    </div>

                    <div class="vp-showcase-controls">
                        <span class="manual-counter vp-showcase-counter" aria-live="polite">01 / 03</span>
                        <button type="button" class="manual-arrow manual-arrow-prev vp-showcase-arrow vp-showcase-arrow--prev" aria-label="Foto sebelumnya">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M20 12H4M4 12L10 6M4 12L10 18" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <button type="button" class="manual-arrow manual-arrow-next vp-showcase-arrow vp-showcase-arrow--next" aria-label="Foto berikutnya">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M4 12H20M20 12L14 6M20 12L14 18" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            @php
                /* Kartu kecil Portofolio. Isi/ubah data di sini; tampilan diatur komponen x-project-card. */
                $portfolioProjects = [
                    ['name' => 'Romansa Project', 'category' => 'Multicam', 'year' => 2024, 'images' => ['dewa 19.webp', 'romansa2.webp', 'romansa3.webp', 'romansa4.webp']],
                    ['name' => 'SayapMas Festival', 'category' => 'Festival', 'year' => 2025, 'images' => ['sayapmas.webp', 'sayapmas2.webp', 'sayapmas3.webp', 'sayapmas4.webp']],
                    ['name' => 'Rasvara Fest', 'category' => 'Festival', 'year' => 2026, 'images' => ['rasvara.webp', 'rasvara2.webp', 'rasvara3.webp', 'rasvara4.webp']],
                    ['name' => 'Preston', 'category' => 'Festival', 'year' => 2026, 'images' => ['preston1.webp', 'preston2.webp', 'preston3.webp', 'preston4.webp']],
                    ['name' => 'XGANZA', 'category' => 'Festival', 'year' => 2024, 'images' => ['X1.webp', 'X2.webp', 'X3.webp', 'X4.webp']],
                    ['name' => 'GKM x RED Uv', 'category' => 'Festival', 'year' => null, 'images' => array_map(fn ($n) => "Gkm ({$n} of 24).webp", range(1, 8))],
                ];
            @endphp

            <div class="vp-work-grid vp-work-grid--portfolio" id="semua-proyek">
                @foreach ($portfolioProjects as $project)
                    <x-project-card :name="$project['name']" :images="$project['images']" :category="$project['category']" :year="$project['year']" />
                @endforeach
            </div>
        </div>

        {{-- ========== CORPORATE & EVENT (gaya editorial, konsisten dengan Portofolio) ========== --}}
        @php
            /*
             * Data kartu Corporate & Event. Kartu pertama tampil besar (span 2 baris).
             * Isi 'year' agar metadata tampil "Kategori · Tahun".
             */
            $corporateProjects = [
                ['name' => 'Halal Bilhalal', 'size' => 'tall', 'category' => 'Corporate Event', 'year' => null, 'images' => array_map(fn ($n) => "BIM{$n}.webp", range(1, 5))],
                ['name' => 'Good Day Schoolicious', 'category' => 'Corporate Event', 'year' => null, 'images' => array_map(fn ($n) => "GDY{$n}.webp", range(1, 11))],
                ['name' => 'Kaldera Adventure', 'category' => 'Corporate Event', 'year' => null, 'images' => array_map(fn ($n) => "KALDERRA{$n}.webp", [1, 2, 3, 4, 5, 6, 7, 8, 9, 12, 13, 15, 16])],
                ['name' => 'Video Angkatan SMKN 1 Singosari', 'category' => 'Video Production', 'year' => null, 'images' => array_map(fn ($n) => "SGS{$n}.webp", [1, 2, 3, 4, 6, 7, 8])],
                ['name' => 'Pembekalan dan Penyerahan SK Pensiun (PNS) Pemerintah Kota Malang', 'category' => 'Corporate Event', 'year' => null, 'images' => array_map(fn ($n) => "SK{$n}.webp", range(1, 7))],
                ['name' => 'Bank Indonesia', 'category' => 'Corporate Event', 'year' => null, 'images' => array_map(fn ($n) => "BIM{$n}.webp", range(1, 8)), 'size' => 'wide'],
                ['name' => 'Danantara Indonesia', 'category' => 'Corporate Event', 'year' => null, 'images' => array_map(fn ($n) => "DN{$n}.webp", range(1, 7))],
            ];
        @endphp

        <div class="event-categories-section vp-corporate" id="corporate-event">
            <div class="vp-section-label">
                <span>(02) Corporate &amp; Event</span>
                <a href="#corporate-event-grid" class="vp-section-link">
                    Lihat semua
                    <svg width="12" height="12" viewBox="0 0 14 14" fill="none" aria-hidden="true">
                        <path d="M3.5 10.5L10.5 3.5M10.5 3.5H4.5M10.5 3.5V9.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

            <div class="vp-section-intro">
                <h2 class="vp-section-heading">Corporate &amp; Event Production.</h2>
                <p class="vp-section-lead">Solusi lengkap untuk berbagai event korporat dan produksi acara berskala kecil hingga besar.</p>
            </div>

            <div class="vp-work-grid" id="corporate-event-grid">
                @foreach ($corporateProjects as $project)
                    <x-project-card :name="$project['name']" :images="$project['images']" :category="$project['category']" :year="$project['year']" :size="$project['size'] ?? null" />
                @endforeach
            </div>
        </div>

        {{-- Klien & statistik: dua baris marquee monokrom --}}
        @include('partials.trusted-marquee')

{{-- Clear floats wrapper --}}
<div style="clear: both; display: block;"></div>


    </div>
</section>

{{-- ========== (03) TENTANG KAMI ========== --}}
@include('partials.about')

<script>
document.addEventListener('DOMContentLoaded', function () {
    const statsSection = document.getElementById('statsSection');
    const statNumbers = document.querySelectorAll('.stat-number');
    let hasAnimated = false;

    function easeOutQuad(t) {
        return t * (2 - t);
    }

    // Easing function yang lebih dramatis (cepat di awal, lambat di akhir)
    function easeOutExpo(t) {
        return t === 1 ? 1 : 1 - Math.pow(2, -10 * t);
    }

    // Format angka dengan koma desimal (Indonesia: 99,9)
    function formatNumber(num, decimals) {
        // Bagi bagian integer dan desimal
        const intPart = Math.floor(num);
        const decPart = decimals > 0 ? (num - intPart).toFixed(decimals).split('.')[1] : '';
        // Tambahkan separator ribuan (titik) untuk bagian integer
        const formattedInt = intPart.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        if (decPart !== '' && decPart !== '0'.repeat(decimals)) {
            return formattedInt + ',' + decPart;
        }
        return formattedInt;
    }

    function animateCount(el) {
        const rawTarget = el.getAttribute('data-target');
        const suffix = el.getAttribute('data-suffix') || '';
        // Durasi animasi: di mobile lebih lambat agar terasa lebih dramatis
        const isMobile = window.matchMedia('(max-width: 768px)').matches;
        const duration = isMobile ? 6000 : 4000; // 6 detik di mobile, 4 detik di desktop

        // Ekstrak angka target (hapus semua karakter non-angka kecuali koma)
        const numericStr = rawTarget.replace(/[^\d,]/g, '').replace(',', '.');
        const target = parseFloat(numericStr);

        // Hitung jumlah digit desimal
        const commaIndex = rawTarget.indexOf(',');
        let decimals = 0;
        if (commaIndex !== -1) {
            const afterComma = rawTarget.substring(commaIndex + 1).match(/^\d+/);
            if (afterComma) {
                decimals = afterComma[0].length;
            }
        }

        // Simpan milestone badge (jika ada) agar tidak hilang saat textContent di-overwrite
        const milestoneBadge = el.querySelector('.milestone-badge');

        let startTime = null;

        function step(currentTime) {
            if (!startTime) startTime = currentTime;
            const progress = Math.min((currentTime - startTime) / duration, 1);
            const easedProgress = easeOutExpo(progress);
            const currentValue = easedProgress * target;

            // Tampilkan angka dengan koma desimal saat animasi, sambil mempertahankan badge
            const formatted = formatNumber(currentValue, decimals) + suffix;
            if (milestoneBadge) {
                // Rekonstruksi isi: angka/teks + badge (supaya tidak hilang)
                el.innerHTML = formatted + ' ' + milestoneBadge.outerHTML;
            } else {
                el.textContent = formatted;
            }

            if (progress < 1) {
                requestAnimationFrame(step);
            } else {
                // Pastikan angka akhir persis sama dengan target, dengan badge tetap ada
                if (milestoneBadge) {
                    el.innerHTML = rawTarget + ' ' + milestoneBadge.outerHTML;

                    // 🎉 Trigger celebration effect ketika mencapai milestone 250+
                    if (parseInt(numericStr) === 250) {
                        triggerMilestoneCelebration(el, milestoneBadge);
                    }
                } else {
                    el.textContent = rawTarget;
                }
            }
        }

        requestAnimationFrame(step);
    }

    // Fungsi khusus untuk efek celebration saat mencapai 250+ project terselesaikan
    function triggerMilestoneCelebration(statNumberEl, badgeEl) {
        // 1. Tambah kelas celebration untuk animasi scale + glow
        badgeEl.classList.add('milestone-celebration');

        // 2. Spawn confetti emoji di sekitar badge
        const rect = badgeEl.getBoundingClientRect();
        const centerX = rect.left + rect.width / 2;
        const centerY = rect.top + rect.height / 2;
        const emojis = ['🎉', '🏆', '⭐', '✨', '🎊', '🥳'];

        for (let i = 0; i < 14; i++) {
            const confetti = document.createElement('div');
            confetti.className = 'milestone-confetti';
            confetti.textContent = emojis[Math.floor(Math.random() * emojis.length)];

            const offsetX = (Math.random() - 0.5) * 260;
            const offsetY = -(80 + Math.random() * 140);
            const rotate = (Math.random() - 0.5) * 540;

            confetti.style.left = centerX + 'px';
            confetti.style.top = centerY + 'px';
            confetti.style.setProperty('--tx', offsetX + 'px');
            confetti.style.setProperty('--ty', offsetY + 'px');
            confetti.style.setProperty('--rot', rotate + 'deg');
            confetti.style.animationDelay = (i * 0.04) + 's';

            document.body.appendChild(confetti);

            // Hapus confetti setelah animasi selesai
            setTimeout(() => confetti.remove(), 2400);
        }

        // 3. Hapus kelas celebration setelah 1.2 detik (animasi one-shot)
        setTimeout(() => {
            badgeEl.classList.remove('milestone-celebration');
        }, 1200);
    }

    function triggerAnimation() {
        if (hasAnimated) return;
        hasAnimated = true;
        statNumbers.forEach(el => animateCount(el));
    }

    // Jalankan animasi saat section masuk viewport (scroll)
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                triggerAnimation();
                observer.disconnect(); // jalan sekali saja
            }
        });
    }, { threshold: 0.3 });

    if (statsSection) {
        observer.observe(statsSection);
    }

    // ========== INTERSECTION OBSERVER UNTUK POPUP-ANIM ==========
    // Observer tunggal yang mengamati semua element popup (animasi fade-in saat scroll)
    const popupObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('popup-visible');
                popupObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });

    // Observe semua element dengan class animasi popup
    document.querySelectorAll('.popup-anim:not(.welcome-badge):not(.welcome-title):not(.welcome-divider):not(.welcome-subtitle):not(.welcome-actions):not(.welcome-scrolldown)').forEach(el => {
        popupObserver.observe(el);
    });

    // Observe semua element dengan class popup-left, popup-right, popup-zoom, popup-rotate, popup-stagger, popup-fade
    document.querySelectorAll('.popup-left, .popup-right, .popup-zoom, .popup-rotate, .popup-stagger, .popup-fade').forEach(el => {
        popupObserver.observe(el);
    });

    // ========== ANIMASI MASUK JUDUL SECTION (vp-section-intro) ==========
    // Gaya: public/css/monochrome.css. Elemen disembunyikan hanya jika JS berjalan.
    const sectionIntros = document.querySelectorAll('.vp-section-intro');
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (!reduceMotion && 'IntersectionObserver' in window) {
        const introObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    introObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.25, rootMargin: '0px 0px -40px 0px' });

        sectionIntros.forEach(intro => {
            intro.classList.add('js-reveal');
            introObserver.observe(intro);
        });
    }

    // ========== TYPING ANIMATION FOR CEO ==========
    function typeWriter(element, text, speed = 80) {
        let i = 0;
        element.innerHTML = '';
        element.classList.add('typing');

        function type() {
            if (i < text.length) {
                element.innerHTML += text.charAt(i);
                i++;
                setTimeout(type, speed);
            } else {
                element.classList.remove('typing');
            }
        }
        type();
    }

    // Start typing animation when page loads (legacy, kept safe)
    const ceoName  = document.querySelector('.ceo-name.typing-text');
    const ceoQuote = document.querySelector('.ceo-quote .typing-text');

    if (ceoName) {
        const nameText = ceoName.getAttribute('data-text');
        setTimeout(() => {
            typeWriter(ceoName, nameText, 100);
        }, 500);
    }

    if (ceoQuote) {
        const quoteText = ceoQuote.getAttribute('data-text');
        setTimeout(() => {
            typeWriter(ceoQuote, quoteText, 40);
        }, 2000);
    }

    // ========== FALLBACK: PASTIKAN SEMUA ELEMENT TETAP TERLIHAT ==========
    // Jika karena alasan apapun observer tidak menambahkan popup-visible,
    // maka element akan tetap muncul setelah 2 detik (fallback safety)
    setTimeout(() => {
        document.querySelectorAll('.popup-anim:not(.popup-visible), .popup-left:not(.popup-visible), .popup-right:not(.popup-visible), .popup-zoom:not(.popup-visible), .popup-rotate:not(.popup-visible), .popup-stagger:not(.popup-visible)').forEach(el => {
            const rect = el.getBoundingClientRect();
            // Tampilkan hanya yang berada di viewport atau di bawahnya
            if (rect.top < window.innerHeight + 500) {
                el.classList.add('popup-visible');
            }
        });
    }, 2500);

    // Pastikan team cards dan portofolio cards terlihat saat scroll
    window.addEventListener('scroll', function() {
        document.querySelectorAll('.portofolio-card').forEach(card => {
            const rect = card.getBoundingClientRect();
            if (rect.top < window.innerHeight && !card.classList.contains('popup-visible')) {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }
        });
    });

    // ========== SMOOTH SCROLL UNTUK NAVBAR ==========
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#' || targetId.length <= 1) return;

            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                e.preventDefault();
                const offsetTop = targetElement.getBoundingClientRect().top + window.pageYOffset - 60;
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });

                // Update active state navbar
                document.querySelectorAll('.navbar-link').forEach(link => link.classList.remove('active'));
                this.classList.add('active');
            }
        });
    });

    // ========== AUTO UPDATE ACTIVE NAVBAR BERDASARKAN SCROLL ==========
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.navbar-link[href^="#"]');

    document.querySelectorAll('.navbar-link[href^="#"]').forEach(link => link.classList.remove('active'));
    const homeLink = document.querySelector('.navbar-link[href="/"]');
    if (homeLink) {
        homeLink.classList.add('active');
    }

    const navObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const id = entry.target.getAttribute('id');
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === '#' + id) {
                        link.classList.add('active');
                    }
                });
            }
        });
    }, {
        threshold: 0.3,
        rootMargin: '-100px 0px -50% 0px'
    });

    sections.forEach(section => navObserver.observe(section));
});
</script>

{{-- ========== (05) LOKASI ========== --}}
@include('partials.location')

{{-- ========== (06) BEHIND THE CREW ========== --}}
@include('partials.crew')

{{-- ========== FOOTER ========== --}}
@include('partials.footer')

<script>
    // Burger menu toggle for dashboard navbar
    (function() {
        const burger = document.getElementById('navbarBurger');
        const mobileMenu = document.getElementById('navbarMobileMenu');
        if (!burger || !mobileMenu) return;

        function closeMenu() {
            mobileMenu.classList.remove('is-open');
            burger.classList.remove('is-active');
            burger.setAttribute('aria-expanded', 'false');
        }

        burger.addEventListener('click', function(e) {
            e.stopPropagation();
            const isOpen = mobileMenu.classList.toggle('is-open');
            burger.classList.toggle('is-active', isOpen);
            burger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });

        document.addEventListener('click', function(e) {
            if (!mobileMenu.contains(e.target) && !burger.contains(e.target)) {
                closeMenu();
            }
        });

        // Close menu when a link is clicked
        mobileMenu.querySelectorAll('a').forEach(function(link) {
            link.addEventListener('click', function() {
                closeMenu();
            });
        });
    })();

    // ===== Service Card Image Slider =====
    (function() {
        const sliders = document.querySelectorAll('[data-slider]');
        if (!sliders.length) return;

        sliders.forEach(function(slider) {
            const slides = slider.querySelectorAll('.slider-slide');
            const dots = slider.querySelectorAll('[data-slider-dot]');
            const prevBtn = slider.querySelector('[data-slider-prev]');
            const nextBtn = slider.querySelector('[data-slider-next]');
            const total = slides.length;
            let current = 0;
            let autoTimer = null;

            function goTo(index) {
                if (index < 0) index = total - 1;
                if (index >= total) index = 0;
                slides.forEach(function(slide, i) {
                    slide.classList.toggle('slider-slide-active', i === index);
                });
                dots.forEach(function(dot, i) {
                    dot.classList.toggle('slider-dot-active', i === index);
                });
                current = index;
            }

            function next() { goTo(current + 1); }
            function prev() { goTo(current - 1); }

            function startAuto() {
                stopAuto();
                autoTimer = setInterval(next, 4500);
            }
            function stopAuto() {
                if (autoTimer) { clearInterval(autoTimer); autoTimer = null; }
            }

            if (prevBtn) prevBtn.addEventListener('click', function() { prev(); startAuto(); });
            if (nextBtn) nextBtn.addEventListener('click', function() { next(); startAuto(); });

            dots.forEach(function(dot) {
                dot.addEventListener('click', function() {
                    const idx = parseInt(dot.getAttribute('data-slider-dot'), 10);
                    goTo(idx);
                    startAuto();
                });
            });

            slider.addEventListener('mouseenter', stopAuto);
            slider.addEventListener('mouseleave', startAuto);

            // Touch / swipe support
            let touchStartX = 0;
            let touchEndX = 0;
            slider.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
                stopAuto();
            }, { passive: true });
            slider.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                const diff = touchStartX - touchEndX;
                if (Math.abs(diff) > 40) {
                    if (diff > 0) next(); else prev();
                }
                startAuto();
            }, { passive: true });

            goTo(0);
            startAuto();
        });
    })();

    // ===== Corporate & Event Production Manual Slider =====
    // Mengontrol slideshow yang sebelumnya auto-play via CSS animation
    // Sekarang dikontrol manual dengan tombol kiri/kanan (tidak ada auto-play)
    (function() {
        const slideshows = document.querySelectorAll('.manual-slideshow');
        if (!slideshows.length) return;

        slideshows.forEach(function(container) {
            const slides = container.querySelectorAll('.manual-slide');
            if (slides.length === 0) return;

            const prevBtn = container.querySelector('.manual-arrow-prev');
            const nextBtn = container.querySelector('.manual-arrow-next');
            const counter = container.querySelector('.manual-counter');
            const total = slides.length;
            let current = 0;

            function goTo(index) {
                if (index < 0) index = total - 1;
                if (index >= total) index = 0;
                slides.forEach(function(slide, i) {
                    slide.classList.toggle('manual-slide-active', i === index);
                });
                if (counter) {
                    const pad = parseInt(container.dataset.counterPad || '0', 10);
                    counter.textContent = String(index + 1).padStart(pad, '0') + ' / ' + String(total).padStart(pad, '0');
                }
                current = index;
            }

            function next() { goTo(current + 1); }
            function prev() { goTo(current - 1); }

            if (prevBtn) {
                prevBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    prev();
                });
            }
            if (nextBtn) {
                nextBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    next();
                });
            }

            // Touch / swipe support untuk mobile
            let touchStartX = 0;
            let touchEndX = 0;
            container.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
            }, { passive: true });
            container.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                const diff = touchStartX - touchEndX;
                if (Math.abs(diff) > 40) {
                    if (diff > 0) next(); else prev();
                }
            }, { passive: true });

            // Inisialisasi: pastikan hanya slide pertama yang aktif
            goTo(0);
        });
    })();
</script>

    <link rel="stylesheet" href="{{ asset('css/monochrome.css') }}?v={{ @filemtime(public_path('css/monochrome.css')) }}">
    <div class="grain" aria-hidden="true"></div>
</body>
</html>
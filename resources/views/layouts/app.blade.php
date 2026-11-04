<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM Karyawan Premium</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <meta name="theme-color" content="#14171c">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --gold: #c8a268;
            --gold-bright: #d4b585;
            --gold-glow: rgba(200, 162, 104, 0.35);
            --gold-soft: rgba(200, 162, 104, 0.12);
            --gold-line: rgba(200, 162, 104, 0.45);
            --dark-bg: #14171c;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            overflow-x: hidden;
            max-width: 100%;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background:
                radial-gradient(1200px 600px at 20% 10%, rgba(200, 162, 104, 0.06), transparent 60%),
                radial-gradient(900px 500px at 90% 80%, rgba(200, 162, 104, 0.04), transparent 60%),
                linear-gradient(180deg, #181b22 0%, #14171c 60%, #0f1217 100%);
            min-height: 100vh;
            color: #f5f5f7;
            width: 100%;
            position: relative;
            letter-spacing: -0.01em;
        }

        /* ===== NAVBAR (minimalist + gold accent) ===== */
        .navbar-megah {
            background: rgba(20, 23, 28, 0.7);
            backdrop-filter: blur(24px) saturate(140%);
            -webkit-backdrop-filter: blur(24px) saturate(140%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            padding: 0.9rem 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar-megah > .container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .navbar-megah.scrolled {
            background: rgba(15, 18, 23, 0.92);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }

        .navbar-brand-megah {
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            color: white;
        }

        .brand-logo {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #e8d4a8 0%, var(--gold) 50%, #a07f4a 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #14171c;
            box-shadow: 0 6px 18px var(--gold-glow);
        }

        .brand-text h4 {
            font-size: 1.05rem;
            font-weight: 800;
            margin: 0;
            line-height: 1.2;
            letter-spacing: -0.02em;
        }

        .brand-text h4 span {
            background: linear-gradient(135deg, #e8d4a8, var(--gold));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .brand-text small {
            font-size: 0.62rem;
            color: rgba(245, 245, 247, 0.5);
            letter-spacing: 2.5px;
            text-transform: uppercase;
            font-weight: 600;
        }

        .nav-menu-megah {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .nav-link-megah {
            color: rgba(245, 245, 247, 0.7);
            text-decoration: none;
            padding: 10px 22px;
            border-radius: 999px;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.2px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link-megah:hover {
            color: white;
            background: rgba(255, 255, 255, 0.05);
        }

        .nav-link-megah.active {
            background: rgba(200, 162, 104, 0.12);
            color: var(--gold-bright);
            border: 1px solid var(--gold-line);
            box-shadow: 0 0 18px var(--gold-soft);
        }

        .nav-btn-logout {
            background: rgba(255, 255, 255, 0.04);
            color: rgba(245, 245, 247, 0.75);
            border: 1px solid rgba(255, 255, 255, 0.08);
            padding: 10px 22px;
            border-radius: 999px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-btn-logout:hover {
            background: rgba(239, 68, 68, 0.15);
            color: #fca5a5;
            border-color: rgba(239, 68, 68, 0.3);
        }

        .nav-profile {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(200, 162, 104, 0.3), rgba(200, 162, 104, 0.08));
            border: 1px solid var(--gold-line);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--gold-bright);
            font-size: 0.85rem;
            margin-left: 6px;
            box-shadow: 0 0 12px var(--gold-soft);
        }

        .page-container {
            padding-top: 110px;
            padding-bottom: 50px;
            min-height: 100vh;
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 100vw;
            overflow-x: hidden;
        }

        .container {
            max-width: 100% !important;
            overflow-x: hidden;
            padding-left: 16px;
            padding-right: 16px;
        }

        @media (max-width: 576px) {
            .navbar-megah .container {
                padding-left: 12px;
                padding-right: 12px;
            }
            .brand-text h4 {
                font-size: 0.92rem;
            }
            .brand-text small {
                font-size: 0.55rem;
                letter-spacing: 1.8px;
            }
            .brand-logo {
                width: 40px;
                height: 40px;
                font-size: 1.05rem;
            }
        }

        @media (max-width: 380px) {
            .brand-text {
                display: none;
            }
        }

        .alert-megah {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.15), rgba(22, 163, 74, 0.08));
            border: 1px solid rgba(34, 197, 94, 0.3);
            border-radius: 16px;
            padding: 18px 24px;
            color: #86efac;
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 25px;
            backdrop-filter: blur(10px);
        }

        .alert-megah i {
            font-size: 1.4rem;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease forwards;
        }

        @media (max-width: 992px) {
            .nav-menu-megah {
                display: none;
            }
            .nav-mobile-toggle {
                display: inline-flex;
            }
            .nav-mobile-menu {
                display: none;
            }
            .nav-mobile-menu.is-open {
                display: flex;
            }
            .page-container {
                padding-top: 90px;
            }
        }

        /* ============================================ */
        /* CIAMIK BURGER BUTTON - Animated Morph Bars */
        /* ============================================ */
        .nav-mobile-toggle {
            display: none;
            position: relative;
            width: 46px;
            height: 46px;
            background: linear-gradient(135deg, rgba(200, 162, 104, 0.12), rgba(200, 162, 104, 0.04));
            border: 1px solid var(--gold-line);
            border-radius: 14px;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            isolation: isolate;
        }

        /* Animated shine sweep */
        .nav-mobile-toggle::before {
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

        .nav-mobile-toggle:hover::before {
            left: 130%;
        }

        /* Gold glow on hover */
        .nav-mobile-toggle::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 14px;
            background: radial-gradient(circle at center, var(--gold-glow) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: -1;
        }

        .nav-mobile-toggle:hover {
            background: linear-gradient(135deg, rgba(200, 162, 104, 0.22), rgba(200, 162, 104, 0.08));
            border-color: var(--gold);
            transform: translateY(-2px) scale(1.04);
            box-shadow:
                0 8px 22px var(--gold-glow),
                0 0 0 4px rgba(200, 162, 104, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }

        .nav-mobile-toggle:hover::after {
            opacity: 1;
        }

        .nav-mobile-toggle:active {
            transform: translateY(0) scale(0.96);
        }

        /* The 3 morph bars inside */
        .burger-bars {
            position: relative;
            width: 20px;
            height: 16px;
            z-index: 2;
        }

        .burger-bar {
            position: absolute;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, var(--gold-bright), var(--gold));
            border-radius: 2px;
            transition: all 0.45s cubic-bezier(0.68, -0.55, 0.27, 1.55);
            box-shadow: 0 0 8px var(--gold-soft);
        }

        .burger-bar:nth-child(1) { top: 0; }
        .burger-bar:nth-child(2) { top: 50%; transform: translateY(-50%); }
        .burger-bar:nth-child(3) { bottom: 0; }

        /* Morph to X when active */
        .nav-mobile-toggle.is-active .burger-bar:nth-child(1) {
            top: 50%;
            transform: translateY(-50%) rotate(45deg);
            background: linear-gradient(90deg, #fca5a5, #ef4444);
            box-shadow: 0 0 10px rgba(239, 68, 68, 0.5);
        }
        .nav-mobile-toggle.is-active .burger-bar:nth-child(2) {
            opacity: 0;
            transform: translateY(-50%) scaleX(0);
        }
        .nav-mobile-toggle.is-active .burger-bar:nth-child(3) {
            bottom: 50%;
            transform: translateY(50%) rotate(-45deg);
            background: linear-gradient(90deg, #fca5a5, #ef4444);
            box-shadow: 0 0 10px rgba(239, 68, 68, 0.5);
        }

        /* Notification dot (optional decorative pulse) */
        .burger-pulse {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 8px;
            height: 8px;
            background: var(--gold-bright);
            border: 1.5px solid rgba(20, 23, 28, 0.9);
            border-radius: 50%;
            z-index: 3;
            box-shadow: 0 0 8px var(--gold);
            animation: burgerPulseDot 2s ease-in-out infinite;
        }

        .nav-mobile-toggle.is-active .burger-pulse {
            opacity: 0;
            transform: scale(0);
        }

        @keyframes burgerPulseDot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%      { opacity: 0.4; transform: scale(1.4); }
        }

        /* ============================================ */
        /* PREMIUM MOBILE MENU PANEL */
        /* ============================================ */
        .nav-mobile-menu {
            position: absolute;
            top: calc(100% + 10px);
            left: 16px;
            right: 16px;
            padding: 8px;
            background: linear-gradient(180deg, rgba(34, 38, 46, 0.98), rgba(20, 23, 28, 0.98));
            backdrop-filter: blur(28px) saturate(160%);
            -webkit-backdrop-filter: blur(28px) saturate(160%);
            border: 1px solid var(--gold-line);
            border-radius: 20px;
            flex-direction: column;
            gap: 4px;
            z-index: 1100;
            box-shadow:
                0 30px 70px rgba(0, 0, 0, 0.6),
                0 0 30px var(--gold-soft),
                inset 0 1px 0 rgba(255, 255, 255, 0.06);
            overflow: hidden;
            transform-origin: top right;
            animation: mobileMenuPop 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }

        /* Top gold accent line */
        .nav-mobile-menu::before {
            content: '';
            position: absolute;
            top: 0;
            left: 16px;
            right: 16px;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold-line), transparent);
            opacity: 0.7;
        }

        @keyframes mobileMenuPop {
            from { opacity: 0; transform: translateY(-12px) scale(0.96); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        .nav-mobile-menu .nav-link-megah,
        .nav-mobile-menu .nav-btn-logout {
            width: 100%;
            justify-content: flex-start;
            padding: 12px 16px;
            font-size: 0.88rem;
            transition: all 0.25s ease;
            position: relative;
            border-radius: 12px;
        }

        .nav-mobile-menu .nav-link-megah::before {
            content: '';
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%) scaleX(0);
            transform-origin: left;
            width: 3px;
            height: 18px;
            background: linear-gradient(180deg, var(--gold-bright), var(--gold));
            border-radius: 2px;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-mobile-menu .nav-link-megah:active::before,
        .nav-mobile-menu .nav-link-megah.active::before {
            transform: translateY(-50%) scaleX(1);
        }

        .nav-mobile-menu .nav-link-megah:active,
        .nav-mobile-menu .nav-link-megah.active {
            background: var(--gold-soft);
            color: var(--gold-bright);
            padding-left: 26px;
        }

        .nav-mobile-menu .nav-btn-logout {
            background: rgba(239, 68, 68, 0.06);
            color: #fca5a5;
            border-color: rgba(239, 68, 68, 0.18);
            margin-top: 4px;
        }

        .nav-mobile-menu .nav-btn-logout:hover {
            background: rgba(239, 68, 68, 0.12);
            color: #fca5a5;
            border-color: rgba(239, 68, 68, 0.3);
        }

        .nav-mobile-menu .nav-profile-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            margin-top: 6px;
            color: rgba(245, 245, 247, 0.7);
            font-size: 0.82rem;
            background: rgba(0, 0, 0, 0.15);
            border-radius: 12px;
        }

        .nav-mobile-menu .nav-profile-row i {
            color: var(--gold-bright);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-megah">
        <div class="container">
            <a class="navbar-brand-megah" href="{{ route('dashboard') }}">
                <div class="brand-logo">
                    <i class="fas fa-users-cog"></i>
                </div>
                <div class="brand-text">
                    <h4>SIM <span>KARYAWAN</span></h4>
                    <small>Premium Management</small>
                </div>
            </a>

            <div class="nav-menu-megah">
                <a href="{{ route('karyawan.index') }}" class="nav-link-megah {{ request()->routeIs('karyawan.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Data Karyawan
                </a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="nav-btn-logout">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
                <span class="nav-profile" title="Admin Profile">
                    <i class="fas fa-user"></i>
                </span>
            </div>

            <button type="button" class="nav-mobile-toggle" id="navMobileToggle" aria-label="Buka menu" aria-expanded="false">
                <span class="burger-bars">
                    <span class="burger-bar"></span>
                    <span class="burger-bar"></span>
                    <span class="burger-bar"></span>
                </span>
                <span class="burger-pulse" aria-hidden="true"></span>
            </button>

            <div class="nav-mobile-menu" id="navMobileMenu">
                <a href="{{ route('karyawan.index') }}" class="nav-link-megah {{ request()->routeIs('karyawan.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Data Karyawan
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-btn-logout">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
                <div class="nav-profile-row">
                    <i class="fas fa-user"></i> Admin Profile
                </div>
            </div>
        </div>
    </nav>

    <div class="page-container">
        <div class="container">
            @if(session('success'))
                <div class="alert-megah animate-fadeInUp">
                    <i class="fas fa-check-circle"></i>
                    <div>
                        <strong>Berhasil!</strong> {{ session('success') }}
                    </div>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-megah');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Mobile menu toggle
        const navMobileToggle = document.getElementById('navMobileToggle');
        const navMobileMenu = document.getElementById('navMobileMenu');
        if (navMobileToggle && navMobileMenu) {
            navMobileToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                const isOpen = navMobileMenu.classList.toggle('is-open');
                navMobileToggle.classList.toggle('is-active', isOpen);
                navMobileToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            });
            document.addEventListener('click', function(e) {
                if (!navMobileMenu.contains(e.target) && !navMobileToggle.contains(e.target)) {
                    navMobileMenu.classList.remove('is-open');
                    navMobileToggle.classList.remove('is-active');
                    navMobileToggle.setAttribute('aria-expanded', 'false');
                }
            });
            // Close when a menu link is clicked
            navMobileMenu.querySelectorAll('a, button').forEach(function(el) {
                el.addEventListener('click', function() {
                    navMobileMenu.classList.remove('is-open');
                    navMobileToggle.classList.remove('is-active');
                    navMobileToggle.setAttribute('aria-expanded', 'false');
                });
            });
        }
    </script>
    @stack('head')
    <link rel="stylesheet" href="{{ asset('css/monochrome.css') }}">
    <div class="grain" aria-hidden="true"></div>
</body>
</html>
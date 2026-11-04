@extends('layouts.app')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<section class="premium-hero">
    <div class="premium-hero-bg"></div>
    <div class="premium-hero-grid"></div>
    <div class="premium-hero-glow"></div>

    <div class="premium-hero-content">
        <div class="premium-eyebrow">
            <span class="premium-eyebrow-dot"></span>
            <span>HR DIRECTORY &middot; LIVE</span>
        </div>

        <div class="premium-title-wrap">
            <div class="premium-title-logo" aria-hidden="true">
                <img src="{{ asset('images/VP LOFO FIX.webp') }}" alt="VP Logo" class="premium-title-logo-img">
                <span class="premium-title-logo-glow"></span>
            </div>
            <h1 class="premium-title">
                Direktori<br>
                <span class="premium-title-accent">Karyawan</span>
            </h1>
        </div>

        <p class="premium-subtitle">
            Kelola dan telusuri data seluruh anggota tim &mdash;
            <br class="d-none d-md-inline">
            panel kontrol premium untuk manajemen talenta profesional.
        </p>

        <div class="premium-meta">
            <div class="premium-meta-item">
                <span class="premium-meta-label">Total Karyawan</span>
                <span class="premium-meta-value">{{ $employees->total() }}</span>
            </div>
            <span class="premium-meta-sep">&middot;</span>
            <div class="premium-meta-item">
                <span class="premium-meta-label">Status</span>
                <span class="premium-meta-value status-ready">
                    <span class="status-dot"></span> Aktif
                </span>
            </div>
            <span class="premium-meta-sep">&middot;</span>
            <div class="premium-meta-item">
                <span class="premium-meta-label">Halaman</span>
                <span class="premium-meta-value">{{ $employees->currentPage() }} / {{ $employees->lastPage() }}</span>
            </div>
        </div>

        <div class="premium-hero-actions">
            <a href="{{ route('karyawan.create') }}" class="premium-btn premium-btn-primary">
                <span class="premium-btn-text">Tambah Karyawan Baru</span>
                <span class="premium-btn-icon"><i class="fas fa-arrow-right"></i></span>
                <span class="premium-btn-shine"></span>
            </a>
            <button type="button" class="premium-btn premium-btn-ghost" onclick="document.querySelector('.premium-toolbar').scrollIntoView({behavior:'smooth'})">
                <i class="fas fa-search"></i>
                <span>Lihat Data</span>
            </button>
        </div>
    </div>
</section>

<div class="premium-toolbar">
    <div class="premium-search">
        <i class="fas fa-search"></i>
        <input type="text" id="empSearch" placeholder="Cari nama, NIP, jabatan, atau divisi...">
    </div>

    <div class="premium-toolbar-actions">
        {{-- Custom Divisi Filter Dropdown --}}
        <div class="divisi-select divisi-select-toolbar" id="filterDivisiSelect">
            <button
                type="button"
                class="divisi-select-trigger"
                id="filterDivisiTrigger"
                aria-haspopup="listbox"
                aria-expanded="false"
            >
                <span class="divisi-select-value" id="filterDivisiValue">
                    <span class="divisi-select-placeholder">SEMUA DIVISI</span>
                </span>
                <span class="divisi-select-arrow">
                    <i class="fas fa-chevron-down"></i>
                </span>
                <span class="divisi-select-glow"></span>
            </button>

            <select id="empFilterDept" class="divisi-select-native" aria-hidden="true" tabindex="-1">
                <option value="">Semua Divisi</option>
                <option value="PHOTOGRAPHER">PHOTOGRAPHER</option>
                <option value="VIDEOGRAPHER">VIDEOGRAPHER</option>
                <option value="DRONE PILOT">DRONE PILOT</option>
                <option value="VIDEO EDITOR">VIDEO EDITOR</option>
                <option value="VISUAL JOCKIE">VISUAL JOCKIE</option>
                <option value="VISUAL EDITOR">VISUAL EDITOR</option>
                <option value="SWITCHER">SWITCHER</option>
                <option value="CAMPERS">CAMPERS</option>
                <option value="BEHIND THE SCENE">BEHIND THE SCENE</option>
                <option value="CONTENT CREATOR">CONTENT CREATOR</option>
                <option value="SOUND ENGINER">SOUND ENGINER</option>
                <option value="SOUND MAN">SOUND MAN</option>
            </select>

            <div class="divisi-select-panel" id="filterDivisiPanel" role="listbox">
                <div class="divisi-select-panel-inner">
                    <div class="divisi-select-panel-header">
                        <span class="divisi-select-panel-title">Filter Divisi</span>
                        <span class="divisi-select-panel-meta">12 Pilihan Tersedia</span>
                    </div>
                    <div class="divisi-select-options" id="filterDivisiOptions">
                        <button type="button" class="divisi-option" data-value="" role="option">
                            <span class="divisi-option-marker"></span>
                            <span class="divisi-option-text">Semua Divisi</span>
                            <span class="divisi-option-icon"><i class="fas fa-layer-group"></i></span>
                        </button>
                        <button type="button" class="divisi-option" data-value="PHOTOGRAPHER" role="option">
                            <span class="divisi-option-marker"></span>
                            <span class="divisi-option-text">PHOTOGRAPHER</span>
                            <span class="divisi-option-icon"><i class="fas fa-camera-retro"></i></span>
                        </button>
                        <button type="button" class="divisi-option" data-value="VIDEOGRAPHER" role="option">
                            <span class="divisi-option-marker"></span>
                            <span class="divisi-option-text">VIDEOGRAPHER</span>
                            <span class="divisi-option-icon"><i class="fas fa-video"></i></span>
                        </button>
                        <button type="button" class="divisi-option" data-value="DRONE PILOT" role="option">
                            <span class="divisi-option-marker"></span>
                            <span class="divisi-option-text">DRONE PILOT</span>
                            <span class="divisi-option-icon"><i class="fas fa-helicopter"></i></span>
                        </button>
                        <button type="button" class="divisi-option" data-value="VIDEO EDITOR" role="option">
                            <span class="divisi-option-marker"></span>
                            <span class="divisi-option-text">VIDEO EDITOR</span>
                            <span class="divisi-option-icon"><i class="fas fa-film"></i></span>
                        </button>
                        <button type="button" class="divisi-option" data-value="VISUAL JOCKIE" role="option">
                            <span class="divisi-option-marker"></span>
                            <span class="divisi-option-text">VISUAL JOCKIE</span>
                            <span class="divisi-option-icon"><i class="fas fa-display"></i></span>
                        </button>
                        <button type="button" class="divisi-option" data-value="VISUAL EDITOR" role="option">
                            <span class="divisi-option-marker"></span>
                            <span class="divisi-option-text">VISUAL EDITOR</span>
                            <span class="divisi-option-icon"><i class="fas fa-palette"></i></span>
                        </button>
                        <button type="button" class="divisi-option" data-value="SWITCHER" role="option">
                            <span class="divisi-option-marker"></span>
                            <span class="divisi-option-text">SWITCHER</span>
                            <span class="divisi-option-icon"><i class="fas fa-sliders"></i></span>
                        </button>
                        <button type="button" class="divisi-option" data-value="CAMPERS" role="option">
                            <span class="divisi-option-marker"></span>
                            <span class="divisi-option-text">CAMPERS</span>
                            <span class="divisi-option-icon"><i class="fas fa-tower-broadcast"></i></span>
                        </button>
                        <button type="button" class="divisi-option" data-value="BEHIND THE SCENE" role="option">
                            <span class="divisi-option-marker"></span>
                            <span class="divisi-option-text">BEHIND THE SCENE</span>
                            <span class="divisi-option-icon"><i class="fas fa-clapperboard"></i></span>
                        </button>
                        <button type="button" class="divisi-option" data-value="CONTENT CREATOR" role="option">
                            <span class="divisi-option-marker"></span>
                            <span class="divisi-option-text">CONTENT CREATOR</span>
                            <span class="divisi-option-icon"><i class="fas fa-pen-nib"></i></span>
                        </button>
                        <button type="button" class="divisi-option" data-value="SOUND ENGINER" role="option">
                            <span class="divisi-option-marker"></span>
                            <span class="divisi-option-text">SOUND ENGINER</span>
                            <span class="divisi-option-icon"><i class="fas fa-wave-square"></i></span>
                        </button>
                        <button type="button" class="divisi-option" data-value="SOUND MAN" role="option">
                            <span class="divisi-option-marker"></span>
                            <span class="divisi-option-text">SOUND MAN</span>
                            <span class="divisi-option-icon"><i class="fas fa-microphone-lines"></i></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Refresh Button --}}
        <button class="premium-btn-refresh" onclick="location.reload()" title="Refresh Data">
            <i class="fas fa-arrows-rotate"></i>
        </button>
    </div>
</div>

<div class="premium-grid">
    @forelse($employees as $index => $emp)
    <article class="premium-card" style="animation-delay: {{ ($index % 8) * 60 }}ms;"
         data-name="{{ strtolower($emp->nama_lengkap) }}"
         data-nip="{{ $emp->nip }}"
         data-jabatan="{{ strtolower($emp->jabatan) }}"
         data-departemen="{{ $emp->departemen }}">
        <div class="premium-card-glow"></div>

        <header class="premium-card-top">
            <div class="premium-card-avatar-wrap">
                <div class="premium-card-avatar-ring"></div>
                <div class="premium-card-avatar">
                    @if($emp->foto)
                        <img src="{{ asset('storage/' . $emp->foto) }}?v={{ $emp->updated_at?->timestamp }}" alt="{{ $emp->nama_lengkap }}">
                    @else
                        <span class="premium-avatar-initial">{{ strtoupper(substr($emp->nama_lengkap, 0, 1)) }}</span>
                    @endif
                </div>
                <span class="premium-card-status" title="Aktif"></span>
            </div>

            <div class="premium-card-id">
                <span class="premium-card-nip">
                    <i class="fas fa-fingerprint"></i>
                    <span>{{ $emp->nip }}</span>
                </span>
            </div>
        </header>

        <div class="premium-card-body">
            <h3 class="premium-card-name">{{ $emp->nama_lengkap }}</h3>
            <p class="premium-card-jabatan">
                <i class="fas fa-briefcase"></i>
                <span>{{ $emp->jabatan }}</span>
            </p>
            <div class="premium-card-dept">
                <span class="premium-dept-badge">{{ $emp->departemen }}</span>
            </div>
            <div class="premium-card-meta">
                <i class="fas fa-envelope"></i>
                <span>{{ $emp->email }}</span>
            </div>
            @if($emp->tanggal_bergabung)
            <div class="premium-card-meta">
                <i class="fas fa-calendar-check"></i>
                <span>Bergabung {{ \Carbon\Carbon::parse($emp->tanggal_bergabung)->translatedFormat('d M Y') }}</span>
            </div>
            @endif
        </div>

        <footer class="premium-card-actions">
            <button type="button" class="premium-action premium-action-view" title="Lihat Detail" onclick="showDetail(this)">
                <i class="fas fa-eye"></i>
            </button>
            <a href="{{ route('karyawan.edit', $emp->id) }}" class="premium-action premium-action-edit" title="Edit">
                <i class="fas fa-pen"></i>
            </a>
            <form action="{{ route('karyawan.destroy', $emp->id) }}" method="POST" class="premium-action-form"
                  onsubmit="event.preventDefault(); showDeleteModal(this);">
                @csrf
                @method('DELETE')
                <button type="submit" class="premium-action premium-action-delete" title="Hapus">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </footer>
    </article>
    @empty
    <div class="premium-empty">
        <div class="premium-empty-icon">
            <i class="fas fa-users-slash"></i>
        </div>
        <h3>Belum Ada Data Karyawan</h3>
        <p>Tambahkan karyawan pertama untuk memulai</p>
        <a href="{{ route('karyawan.create') }}" class="premium-btn premium-btn-primary">
            <span class="premium-btn-text">Tambah Karyawan</span>
            <span class="premium-btn-icon"><i class="fas fa-arrow-right"></i></span>
        </a>
    </div>
    @endforelse
</div>

<div id="empNoResult" class="premium-no-result" style="display:none;">
    <i class="fas fa-search"></i>
    <p>Tidak ada karyawan yang cocok dengan pencarian Anda</p>
</div>

@if($employees->hasPages())
<div class="premium-pagination">
    {{ $employees->links() }}
</div>
@endif

<div id="empModal" class="premium-modal">
    <div class="premium-modal-backdrop" onclick="closeModal()"></div>
    <div class="premium-modal-card">
        <button class="premium-modal-close" onclick="closeModal()" aria-label="Tutup">
            <i class="fas fa-xmark"></i>
        </button>
        <div class="premium-modal-header">
            <div class="premium-modal-avatar" id="empModalAvatar"></div>
            <div class="premium-modal-info">
                <h3 id="empModalName"></h3>
                <p id="empModalJabatan"></p>
            </div>
        </div>
        <div class="premium-modal-body" id="empModalBody"></div>
        <div class="premium-modal-footer">
            <a id="empModalEditBtn" class="premium-btn premium-btn-primary">
                <span class="premium-btn-text">Edit Data</span>
                <span class="premium-btn-icon"><i class="fas fa-arrow-right"></i></span>
            </a>
        </div>
    </div>
</div>

<style>
.premium-hero,
.premium-toolbar,
.premium-grid,
.premium-pagination,
.premium-modal {
    font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
}

:root {
    --premium-gold: #c8a268;
    --premium-gold-bright: #d4b585;
    --premium-gold-glow: rgba(200, 162, 104, 0.35);
    --premium-gold-soft: rgba(200, 162, 104, 0.12);
    --premium-gold-line: rgba(200, 162, 104, 0.45);
    --premium-text: #f5f5f7;
    --premium-text-dim: rgba(245, 245, 247, 0.55);
    --premium-text-faint: rgba(245, 245, 247, 0.35);
    --premium-line: rgba(255, 255, 255, 0.06);
    --premium-line-strong: rgba(255, 255, 255, 0.12);
}

.premium-hero {
    position: relative;
    padding: 56px 48px 60px;
    border-radius: 28px;
    overflow: hidden;
    background:
        radial-gradient(1200px 500px at 80% 20%, rgba(200, 162, 104, 0.08), transparent 60%),
        radial-gradient(900px 400px at 10% 90%, rgba(200, 162, 104, 0.04), transparent 70%),
        linear-gradient(180deg, #181b22 0%, #14171c 100%);
    border: 1px solid var(--premium-line);
    margin-bottom: 36px;
    isolation: isolate;
}

.premium-hero-bg {
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 70% 30%, var(--premium-gold-soft) 0%, transparent 45%);
    z-index: -2;
    animation: heroBreath 10s ease-in-out infinite alternate;
}

@keyframes heroBreath {
    0%   { opacity: 0.6; transform: scale(1); }
    100% { opacity: 1;   transform: scale(1.08); }
}

.premium-hero-grid {
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(255, 255, 255, 0.025) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255, 255, 255, 0.025) 1px, transparent 1px);
    background-size: 56px 56px;
    mask-image: radial-gradient(ellipse at center, black 30%, transparent 80%);
    -webkit-mask-image: radial-gradient(ellipse at center, black 30%, transparent 80%);
    z-index: -1;
}

.premium-hero-glow {
    position: absolute;
    top: -180px;
    right: -180px;
    width: 480px;
    height: 480px;
    background: radial-gradient(circle, var(--premium-gold-glow) 0%, transparent 65%);
    filter: blur(40px);
    z-index: -1;
    opacity: 0.55;
}

.premium-hero-content {
    position: relative;
    z-index: 1;
    max-width: 820px;
}

.premium-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 8px 16px;
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(10px);
    border: 1px solid var(--premium-line-strong);
    border-radius: 999px;
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    color: var(--premium-text-dim);
    margin-bottom: 22px;
}

.premium-eyebrow-dot {
    width: 6px;
    height: 6px;
    background: var(--premium-gold);
    border-radius: 50%;
    box-shadow: 0 0 10px var(--premium-gold), 0 0 20px var(--premium-gold-glow);
    animation: dotPulse 2.4s ease-in-out infinite;
}

@keyframes dotPulse {
    0%, 100% { opacity: 1;   transform: scale(1);   }
    50%      { opacity: 0.5; transform: scale(1.4); }
}

.premium-title {
    font-size: clamp(2.8rem, 6vw, 4.6rem);
    font-weight: 900;
    line-height: 0.98;
    letter-spacing: -0.04em;
    color: var(--premium-text);
    margin: 0 0 22px;
    text-shadow: 0 2px 30px rgba(0, 0, 0, 0.5);
}

/* ===== TITLE LOCK-UP (Logo + Title) ===== */
.premium-title-wrap {
    display: flex;
    align-items: center;
    gap: 28px;
    margin: 0 0 22px;
    flex-wrap: wrap;
}

.premium-title-logo {
    position: relative;
    width: clamp(86px, 11vw, 130px);
    height: clamp(86px, 11vw, 130px);
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.premium-title-logo::before {
    content: '';
    position: absolute;
    inset: -8px;
    border-radius: 24px;
    background:
        radial-gradient(circle at 50% 50%, var(--premium-gold-glow) 0%, transparent 70%);
    filter: blur(12px);
    opacity: 0.55;
    z-index: -1;
    transition: opacity 0.5s ease;
}

.premium-title-logo::after {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 18px;
    background: linear-gradient(135deg, rgba(200, 162, 104, 0.2), rgba(200, 162, 104, 0.04));
    border: 1px solid rgba(200, 162, 104, 0.35);
    box-shadow:
        inset 0 1px 0 rgba(255, 255, 255, 0.08),
        0 12px 30px rgba(0, 0, 0, 0.35),
        0 0 24px var(--premium-gold-soft);
    z-index: -1;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.premium-title:hover .premium-title-logo::before {
    opacity: 0.85;
}

.premium-title:hover .premium-title-logo::after {
    border-color: rgba(200, 162, 104, 0.55);
    box-shadow:
        inset 0 1px 0 rgba(255, 255, 255, 0.12),
        0 16px 40px rgba(0, 0, 0, 0.45),
        0 0 36px var(--premium-gold-glow);
}

.premium-title-logo-img {
    display: block;
    width: 78%;
    height: 78%;
    object-fit: contain;
    filter:
        drop-shadow(0 4px 14px rgba(0, 0, 0, 0.5))
        drop-shadow(0 0 12px var(--premium-gold-soft));
    transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    z-index: 1;
}

.premium-title:hover .premium-title-logo-img {
    transform: scale(1.05) rotate(-2deg);
}

.premium-title-logo-glow {
    position: absolute;
    inset: -20px;
    background: radial-gradient(circle, var(--premium-gold-soft) 0%, transparent 65%);
    filter: blur(20px);
    opacity: 0.4;
    z-index: -2;
    animation: logoBreath 5s ease-in-out infinite alternate;
}

@keyframes logoBreath {
    0%   { opacity: 0.3; transform: scale(1); }
    100% { opacity: 0.6; transform: scale(1.1); }
}

@media (max-width: 576px) {
    .premium-title-wrap {
        gap: 18px;
        justify-content: flex-start;
    }
}

.premium-title-accent {
    background: linear-gradient(135deg, #e8d4a8 0%, var(--premium-gold) 50%, #a07f4a 100%);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    color: transparent;
    font-style: italic;
    filter: drop-shadow(0 0 30px var(--premium-gold-glow));
}

.premium-subtitle {
    font-size: 1.05rem;
    line-height: 1.65;
    color: var(--premium-text-dim);
    max-width: 560px;
    margin: 0 0 32px;
    font-weight: 400;
}

.premium-meta {
    display: flex;
    align-items: center;
    gap: 18px;
    flex-wrap: wrap;
    padding-top: 24px;
    border-top: 1px solid var(--premium-line);
    margin-bottom: 32px;
}

.premium-meta-item {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.premium-meta-label {
    font-size: 0.65rem;
    font-weight: 600;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--premium-text-faint);
}

.premium-meta-value {
    font-size: 0.95rem;
    font-weight: 700;
    color: var(--premium-text);
    letter-spacing: 0.3px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.status-ready .status-dot {
    width: 8px;
    height: 8px;
    background: #4ade80;
    border-radius: 50%;
    box-shadow: 0 0 10px #4ade80;
    animation: dotPulse 2s ease-in-out infinite;
}

.premium-meta-sep {
    color: var(--premium-text-faint);
    font-size: 1.2rem;
}

.premium-hero-actions {
    display: flex;
    gap: 12px;
    align-items: center;
    flex-wrap: wrap;
}

.premium-btn {
    position: relative;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 13px 26px;
    border: none;
    border-radius: 999px;
    font-family: inherit;
    font-size: 0.88rem;
    font-weight: 700;
    letter-spacing: 0.2px;
    cursor: pointer;
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    text-decoration: none;
    overflow: hidden;
    isolation: isolate;
}

.premium-btn-ghost {
    background: transparent;
    color: var(--premium-text-dim);
    border: 1px solid var(--premium-line-strong);
}

.premium-btn-ghost:hover {
    background: rgba(255, 255, 255, 0.04);
    color: var(--premium-text);
    border-color: rgba(255, 255, 255, 0.25);
    transform: translateY(-1px);
}

.premium-btn-primary {
    background: linear-gradient(135deg, #e8d4a8 0%, var(--premium-gold) 50%, #a07f4a 100%);
    background-size: 200% 200%;
    color: #1a1d24;
    box-shadow:
        0 8px 24px var(--premium-gold-glow),
        inset 0 1px 0 rgba(255, 255, 255, 0.4);
    animation: goldShimmer 6s ease infinite;
}

@keyframes goldShimmer {
    0%, 100% { background-position: 0% 50%; }
    50%      { background-position: 100% 50%; }
}

.premium-btn-primary:hover {
    transform: translateY(-3px);
    box-shadow:
        0 14px 36px var(--premium-gold-glow),
        inset 0 1px 0 rgba(255, 255, 255, 0.5);
}

.premium-btn-icon {
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background: rgba(0, 0, 0, 0.15);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.premium-btn-primary:hover .premium-btn-icon {
    transform: translateX(3px);
}

.premium-btn-shine {
    position: absolute;
    top: 0;
    left: -120%;
    width: 60%;
    height: 100%;
    background: linear-gradient(110deg, transparent 30%, rgba(255, 255, 255, 0.55) 50%, transparent 70%);
    transform: skewX(-20deg);
    transition: left 0.8s ease;
    pointer-events: none;
}

.premium-btn-primary:hover .premium-btn-shine {
    left: 130%;
}
.premium-toolbar {
    display: flex;
    gap: 14px;
    align-items: center;
    margin-bottom: 28px;
    padding: 14px 18px;
    background: rgba(26, 29, 36, 0.55);
    backdrop-filter: blur(24px) saturate(140%);
    border: 1px solid var(--premium-line-strong);
    border-radius: 20px;
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.25);
    flex-wrap: wrap;
    position: relative;
}
.premium-toolbar::before {
    content: "";
    position: absolute;
    top: 0;
    left: 18px;
    right: 18px;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--premium-gold-line), transparent);
    opacity: 0.4;
}
.premium-search {
    flex: 1;
    min-width: 260px;
    position: relative;
    display: flex;
    align-items: center;
}
.premium-search i {
    position: absolute;
    left: 16px;
    color: var(--premium-text-dim);
    font-size: 0.95rem;
    pointer-events: none;
}
.premium-search input {
    width: 100%;
    padding: 13px 16px 13px 44px;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid var(--premium-line-strong);
    border-radius: 12px;
    color: var(--premium-text);
    font-size: 0.92rem;
    font-family: inherit;
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
}
.premium-search input::placeholder { color: var(--premium-text-faint); }
.premium-search input:focus {
    outline: none;
    border-color: var(--premium-gold);
    background: rgba(200, 162, 104, 0.04);
    box-shadow: 0 0 0 4px var(--premium-gold-soft);
}
.premium-toolbar-actions { display: flex; gap: 10px; align-items: center; }
.premium-select-wrap { position: relative; }
.premium-select-input {
    appearance: none;
    -webkit-appearance: none;
    padding: 13px 36px 13px 16px;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid var(--premium-line-strong);
    border-radius: 12px;
    color: var(--premium-text);
    font-size: 0.85rem;
    font-family: inherit;
    font-weight: 600;
    letter-spacing: 0.5px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    min-width: 180px;
}
.premium-select-input option {
    background: #1a1d24;
    color: var(--premium-text);
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: 0.5px;
}
.premium-select-input:focus {
    outline: none;
    border-color: var(--premium-gold);
    box-shadow: 0 0 0 4px var(--premium-gold-soft);
}
.premium-select-caret {
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--premium-text-dim);
    font-size: 0.7rem;
    pointer-events: none;
}
.premium-btn-refresh {
    width: 46px;
    height: 46px;
    background: var(--premium-gold-soft);
    border: 1px solid var(--premium-gold-line);
    border-radius: 12px;
    color: var(--premium-gold-bright);
    cursor: pointer;
    font-size: 0.95rem;
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.premium-btn-refresh::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at center, var(--premium-gold-glow) 0%, transparent 70%);
    opacity: 0;
    transition: opacity 0.35s ease;
}

.premium-btn-refresh:hover::before {
    opacity: 1;
}

.premium-btn-refresh i {
    position: relative;
    z-index: 1;
    transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.premium-btn-refresh:hover {
    background: var(--premium-gold-glow);
    color: #fff;
    border-color: var(--premium-gold);
    box-shadow: 0 0 18px var(--premium-gold-soft);
}

.premium-btn-refresh:hover i {
    transform: rotate(180deg);
}

.premium-btn-refresh:active {
    transform: scale(0.94);
}

/* ===== TOOLBAR-SPECIFIC DIVISI SELECT ===== */
.divisi-select-toolbar {
    min-width: 200px;
    z-index: 40;
}

.divisi-select-toolbar.is-open {
    z-index: 200;
}

.divisi-select-toolbar .divisi-select-trigger {
    padding: 12px 4px 12px;
    border-bottom: 1px solid var(--premium-line-strong);
}

.divisi-select-toolbar .divisi-select-arrow {
    width: 32px;
    height: 32px;
    border-radius: 10px;
}

.divisi-select-toolbar .divisi-select-placeholder {
    font-size: 0.82rem;
    letter-spacing: 1.5px;
}

/* ===== CUSTOM DIVISI SELECT (FILTER TOOLBAR) ===== */
.divisi-select { position: relative; z-index: 40; }
.divisi-select.is-open { z-index: 200; }
.divisi-select-native { position: absolute; width: 1px; height: 1px; opacity: 0; pointer-events: none; left: -9999px; }
.divisi-select-trigger { position: relative; width: 100%; display: flex; align-items: center; justify-content: space-between; gap: 14px; padding: 12px 4px; background: transparent; border: none; border-bottom: 1px solid var(--premium-line-strong); color: var(--premium-text); font-family: inherit; font-size: 0.85rem; font-weight: 600; letter-spacing: 0.8px; cursor: pointer; transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1); text-align: left; }
.divisi-select-trigger:hover { border-bottom-color: rgba(200, 162, 104, 0.4); }
.divisi-select-trigger.is-open { border-bottom-color: var(--premium-gold); }
.divisi-select-value { flex: 1; display: flex; align-items: center; gap: 10px; overflow: hidden; }
.divisi-select-placeholder { color: var(--premium-text-faint); font-weight: 500; letter-spacing: 1.5px; text-transform: uppercase; font-size: 0.78rem; }
.divisi-select-value.has-value .divisi-select-placeholder { color: var(--premium-gold-bright); font-weight: 700; letter-spacing: 1px; }
.divisi-select-value.has-value::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: var(--premium-gold); box-shadow: 0 0 10px var(--premium-gold); flex-shrink: 0; }
.divisi-select-arrow { width: 28px; height: 28px; border-radius: 50%; background: rgba(200, 162, 104, 0.06); border: 1px solid rgba(200, 162, 104, 0.15); display: flex; align-items: center; justify-content: center; color: var(--premium-gold-bright); font-size: 0.65rem; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); flex-shrink: 0; }
.divisi-select-trigger.is-open .divisi-select-arrow { background: rgba(200, 162, 104, 0.18); transform: rotate(180deg); box-shadow: 0 0 18px var(--premium-gold-glow); }
.divisi-select-glow { position: absolute; bottom: -1px; left: 0; right: 0; height: 1px; background: linear-gradient(90deg, transparent, var(--premium-gold), transparent); transform: scaleX(0); transition: transform 0.5s; box-shadow: 0 0 14px var(--premium-gold-glow); pointer-events: none; }
.divisi-select-trigger.is-open ~ .divisi-select-glow { transform: scaleX(1); }
.divisi-select-panel { position: absolute; top: calc(100% + 12px); left: 0; right: 0; z-index: 9999; opacity: 0; visibility: hidden; pointer-events: none; transform: translateY(-8px) scaleY(0.95); transition: opacity 0.3s ease, transform 0.4s, visibility 0.3s; }
.divisi-select-panel.is-open { opacity: 1; visibility: visible; pointer-events: auto; transform: translateY(0) scaleY(1); }
.divisi-select-panel-inner { position: relative; background: linear-gradient(180deg, rgba(34, 38, 46, 0.98), rgba(26, 29, 36, 0.98)); backdrop-filter: blur(24px) saturate(140%); border: 1px solid var(--premium-line-strong); border-radius: 16px; overflow: hidden; box-shadow: 0 30px 60px rgba(0, 0, 0, 0.6), inset 0 1px 0 rgba(255, 255, 255, 0.05); }
.divisi-select-panel-inner::before { content: ''; position: absolute; top: 0; left: 16px; right: 16px; height: 1px; background: linear-gradient(90deg, transparent, var(--premium-gold-line), transparent); opacity: 0.6; }
.divisi-select-panel-header { display: flex; align-items: center; justify-content: space-between; padding: 14px 18px 10px; border-bottom: 1px solid var(--premium-line); background: rgba(0, 0, 0, 0.15); }
.divisi-select-panel-title { font-size: 0.68rem; font-weight: 700; letter-spacing: 2.5px; text-transform: uppercase; color: var(--premium-gold-bright); text-shadow: 0 0 12px var(--premium-gold-glow); }
.divisi-select-panel-meta { font-size: 0.65rem; color: var(--premium-text-faint); letter-spacing: 1px; text-transform: uppercase; font-weight: 600; }
.divisi-select-options { max-height: 320px; overflow-y: auto; padding: 6px; }
.divisi-select-options::-webkit-scrollbar { width: 6px; }
.divisi-select-options::-webkit-scrollbar-track { background: transparent; }
.divisi-select-options::-webkit-scrollbar-thumb { background: rgba(200, 162, 104, 0.25); border-radius: 3px; }
.divisi-select-options::-webkit-scrollbar-thumb:hover { background: rgba(200, 162, 104, 0.45); }
.divisi-option { position: relative; width: 100%; display: flex; align-items: center; gap: 12px; padding: 10px 12px; background: transparent; border: 1px solid transparent; border-radius: 10px; color: var(--premium-text-dim); font-family: inherit; font-size: 0.78rem; font-weight: 700; letter-spacing: 1.2px; text-transform: uppercase; text-align: left; cursor: pointer; transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1); overflow: hidden; }
.divisi-option::before { content: ''; position: absolute; inset: 0; background: linear-gradient(90deg, rgba(200, 162, 104, 0.1) 0%, rgba(200, 162, 104, 0.02) 100%); opacity: 0; transition: opacity 0.3s ease; }
.divisi-option:hover { border-color: rgba(200, 162, 104, 0.25); color: var(--premium-text); transform: translateX(4px); padding-left: 16px; }
.divisi-option:hover::before { opacity: 1; }
.divisi-option.is-selected { color: var(--premium-gold-bright); background: rgba(200, 162, 104, 0.08); border-color: rgba(200, 162, 104, 0.35); box-shadow: inset 0 0 18px rgba(200, 162, 104, 0.08); }
.divisi-option.is-selected .divisi-option-text { text-shadow: 0 0 14px var(--premium-gold-glow); }
.divisi-option-marker { width: 7px; height: 7px; border-radius: 50%; background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.15); flex-shrink: 0; transition: all 0.3s ease; position: relative; z-index: 1; }
.divisi-option:hover .divisi-option-marker { background: var(--premium-gold); border-color: var(--premium-gold); box-shadow: 0 0 10px var(--premium-gold-glow); }
.divisi-option.is-selected .divisi-option-marker { background: var(--premium-gold); border-color: var(--premium-gold); box-shadow: 0 0 14px var(--premium-gold), 0 0 24px var(--premium-gold-glow); }
.divisi-option-text { flex: 1; position: relative; z-index: 1; }
.divisi-option-icon { width: 26px; height: 26px; border-radius: 7px; background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.06); display: flex; align-items: center; justify-content: center; font-size: 0.7rem; color: var(--premium-text-faint); flex-shrink: 0; transition: all 0.35s ease; position: relative; z-index: 1; }
.divisi-option:hover .divisi-option-icon { color: var(--premium-gold-bright); background: rgba(200, 162, 104, 0.1); border-color: rgba(200, 162, 104, 0.3); transform: scale(1.08) rotate(-5deg); }
.divisi-option.is-selected .divisi-option-icon { color: var(--premium-gold); background: rgba(200, 162, 104, 0.15); border-color: var(--premium-gold-line); box-shadow: 0 0 14px var(--premium-gold-soft); }


.premium-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(310px, 1fr));
    gap: 22px;
    margin-bottom: 32px;
}
.premium-card {
    position: relative;
    background: rgba(26, 29, 36, 0.55);
    backdrop-filter: blur(24px) saturate(140%);
    border: 1px solid var(--premium-line-strong);
    border-radius: 22px;
    padding: 26px 24px 22px;
    overflow: hidden;
    transition: border-color 0.4s ease, transform 0.4s ease, box-shadow 0.4s ease;
    opacity: 0;
    transform: translateY(20px);
    animation: premiumCardIn 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}
.premium-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 22px;
    right: 22px;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--premium-gold-line), transparent);
    opacity: 0.4;
}
@keyframes premiumCardIn { to { opacity: 1; transform: translateY(0); } }
.premium-card:hover {
    border-color: rgba(200, 162, 104, 0.3);
    transform: translateY(-6px);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.45), 0 0 30px var(--premium-gold-soft);
}
.premium-card-glow {
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle at center, var(--premium-gold-soft) 0%, transparent 50%);
    opacity: 0;
    transition: opacity 0.5s ease;
    pointer-events: none;
}
.premium-card:hover .premium-card-glow { opacity: 1; }
.premium-card-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 18px;
    position: relative;
    z-index: 1;
}
.premium-card-avatar-wrap {
    position: relative;
    width: 72px;
    height: 72px;
    flex-shrink: 0;
}
.premium-card-avatar-ring {
    position: absolute;
    inset: -4px;
    border-radius: 50%;
    background: conic-gradient(from 0deg, var(--premium-gold), #a07f4a, var(--premium-gold));
    opacity: 0;
    transition: opacity 0.4s ease;
    animation: ringRotate 6s linear infinite;
}
.premium-card:hover .premium-card-avatar-ring { opacity: 0.7; }
@keyframes ringRotate { to { transform: rotate(360deg); } }
.premium-card-avatar {
    position: absolute;
    inset: 0;
    border-radius: 50%;
    overflow: hidden;
    background: linear-gradient(135deg, #e8d4a8, var(--premium-gold), #a07f4a);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 20px rgba(200, 162, 104, 0.3);
}
.premium-card-avatar img { width: 100%; height: 100%; object-fit: cover; }
.premium-avatar-initial {
    font-size: 1.8rem;
    font-weight: 900;
    color: #14171c;
}
.premium-card-status {
    position: absolute;
    bottom: 2px;
    right: 2px;
    width: 14px;
    height: 14px;
    background: #4ade80;
    border-radius: 50%;
    border: 2px solid #1a1d24;
    box-shadow: 0 0 10px rgba(74, 222, 128, 0.5);
    animation: dotPulse 2s ease-in-out infinite;
    z-index: 2;
}
.premium-card-id { margin-top: 4px; }
.premium-card-nip {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 10px;
    background: var(--premium-gold-soft);
    border: 1px solid var(--premium-gold-line);
    color: var(--premium-gold-bright);
    border-radius: 8px;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.5px;
}
.premium-card-nip i { font-size: 0.65rem; }
.premium-card-body {
    margin-bottom: 20px;
    position: relative;
    z-index: 1;
}
.premium-card-name {
    font-size: 1.15rem;
    font-weight: 800;
    color: var(--premium-text);
    margin: 0 0 6px;
    line-height: 1.3;
    letter-spacing: -0.01em;
}
.premium-card-jabatan {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--premium-text-dim);
    font-size: 0.85rem;
    margin: 0 0 12px;
}
.premium-card-jabatan i { color: var(--premium-gold); }
.premium-card-dept { margin-bottom: 12px; }
.premium-dept-badge {
    display: inline-block;
    padding: 5px 12px;
    background: var(--premium-gold-soft);
    border: 1px solid var(--premium-gold-line);
    color: var(--premium-gold-bright);
    border-radius: 999px;
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
}
.premium-card-meta {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--premium-text-dim);
    font-size: 0.82rem;
    margin-bottom: 5px;
    overflow: hidden;
}
.premium-card-meta span {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.premium-card-meta i {
    color: var(--premium-text-faint);
    flex-shrink: 0;
    width: 14px;
}
.premium-card-actions {
    display: flex;
    gap: 6px;
    padding-top: 16px;
    border-top: 1px solid var(--premium-line);
    position: relative;
    z-index: 1;
}
.premium-action-form { flex: 1; display: flex; }
.premium-action {
    flex: 1;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid var(--premium-line-strong);
    border-radius: 10px;
    cursor: pointer;
    font-size: 0.85rem;
    text-decoration: none;
    color: var(--premium-text-dim);
    background: transparent;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.premium-action:hover {
    background: rgba(255, 255, 255, 0.05);
    color: var(--premium-text);
    border-color: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
}
.premium-action-view:hover {
    border-color: var(--premium-gold-line);
    color: var(--premium-gold-bright);
    box-shadow: 0 0 14px var(--premium-gold-soft);
}
.premium-action-edit:hover {
    border-color: rgba(59, 130, 246, 0.5);
    color: #93c5fd;
    box-shadow: 0 0 14px rgba(59, 130, 246, 0.15);
}
.premium-action-delete:hover {
    border-color: rgba(239, 68, 68, 0.5);
    color: #fca5a5;
    box-shadow: 0 0 14px rgba(239, 68, 68, 0.15);
}
.premium-empty {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 20px;
    color: var(--premium-text-dim);
}
.premium-empty-icon {
    width: 100px;
    height: 100px;
    margin: 0 auto 24px;
    background: var(--premium-gold-soft);
    border: 1px dashed var(--premium-gold-line);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.6rem;
    color: var(--premium-gold-bright);
}
.premium-empty h3 {
    color: var(--premium-text);
    font-weight: 700;
    margin: 0 0 8px;
}
.premium-empty p {
    margin: 0 0 24px;
    color: var(--premium-text-dim);
}
.premium-empty .premium-btn { margin: 0 auto; }
.premium-no-result {
    text-align: center;
    padding: 60px 20px;
    color: var(--premium-text-dim);
}
.premium-no-result i {
    font-size: 2.6rem;
    margin-bottom: 14px;
    color: var(--premium-gold);
    opacity: 0.6;
}
.premium-pagination {
    margin-top: 40px;
    display: flex;
    justify-content: center;
}
.premium-pagination nav svg { width: 18px; height: 18px; }
.premium-pagination .pagination {
    gap: 8px;
    flex-wrap: wrap;
    justify-content: center;
    margin: 0;
}
.premium-pagination .page-link {
    background: rgba(26, 29, 36, 0.55) !important;
    border: 1px solid var(--premium-line-strong) !important;
    color: var(--premium-text-dim) !important;
    padding: 10px 16px !important;
    border-radius: 12px !important;
    font-weight: 600 !important;
    font-size: 0.85rem !important;
    transition: all 0.3s ease !important;
    min-width: 42px;
    text-align: center;
}
.premium-pagination .page-link:hover,
.premium-pagination .page-item.active .page-link {
    background: var(--premium-gold-soft) !important;
    border-color: var(--premium-gold-line) !important;
    color: var(--premium-gold-bright) !important;
    box-shadow: 0 6px 18px var(--premium-gold-soft) !important;
    transform: translateY(-2px);
}
.premium-pagination .page-item.disabled .page-link {
    background: rgba(255, 255, 255, 0.02) !important;
    color: rgba(245, 245, 247, 0.25) !important;
    border-color: transparent !important;
}
.premium-modal {
    position: fixed;
    inset: 0;
    z-index: 9999;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 16px;
}
.premium-modal.active {
    display: flex;
    animation: modalFadeIn 0.3s ease;
}
@keyframes modalFadeIn { from { opacity: 0; } to { opacity: 1; } }
.premium-modal-backdrop {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.75);
    backdrop-filter: blur(12px);
}
.premium-modal-card {
    position: relative;
    width: 100%;
    max-width: 500px;
    background: linear-gradient(180deg, rgba(34, 38, 46, 0.98), rgba(20, 23, 28, 0.98));
    backdrop-filter: blur(24px) saturate(140%);
    border: 1px solid var(--premium-line-strong);
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 30px 80px rgba(0, 0, 0, 0.6), inset 0 1px 0 rgba(255, 255, 255, 0.05);
    animation: modalSlideUp 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}
.premium-modal-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 18px;
    right: 18px;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--premium-gold-line), transparent);
    opacity: 0.5;
}
@keyframes modalSlideUp {
    from { transform: translateY(40px) scale(0.96); opacity: 0; }
    to   { transform: translateY(0) scale(1);       opacity: 1; }
}
.premium-modal-close {
    position: absolute;
    top: 16px;
    right: 16px;
    width: 38px;
    height: 38px;
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid var(--premium-line-strong);
    border-radius: 50%;
    color: var(--premium-text-dim);
    cursor: pointer;
    z-index: 2;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}
.premium-modal-close:hover {
    background: rgba(239, 68, 68, 0.15);
    color: #fca5a5;
    border-color: rgba(239, 68, 68, 0.3);
    transform: rotate(90deg);
}
.premium-modal-header {
    padding: 36px 28px 22px;
    display: flex;
    align-items: center;
    gap: 18px;
    border-bottom: 1px solid var(--premium-line);
}
.premium-modal-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    overflow: hidden;
    background: linear-gradient(135deg, #e8d4a8, var(--premium-gold), #a07f4a);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #14171c;
    font-size: 1.8rem;
    font-weight: 900;
    flex-shrink: 0;
    box-shadow: 0 10px 28px var(--premium-gold-glow);
}
.premium-modal-avatar img { width: 100%; height: 100%; object-fit: cover; }
.premium-modal-info h3 {
    color: var(--premium-text);
    font-size: 1.3rem;
    font-weight: 800;
    margin: 0 0 4px;
    letter-spacing: -0.01em;
}
.premium-modal-info p {
    color: var(--premium-gold-bright);
    margin: 0;
    font-size: 0.9rem;
    font-weight: 600;
    letter-spacing: 0.3px;
}
.premium-modal-body { padding: 22px 28px; }
.premium-modal-row {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 12px 0;
    border-bottom: 1px solid var(--premium-line);
}
.premium-modal-row:last-child { border-bottom: none; }
.premium-modal-row > i {
    width: 36px;
    height: 36px;
    background: var(--premium-gold-soft);
    border: 1px solid var(--premium-gold-line);
    color: var(--premium-gold-bright);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 0.85rem;
}
.premium-modal-row-text { flex: 1; min-width: 0; }
.premium-modal-row-label {
    font-size: 0.65rem;
    color: var(--premium-text-faint);
    text-transform: uppercase;
    letter-spacing: 1.5px;
    font-weight: 600;
    margin-bottom: 2px;
}
.premium-modal-row-value {
    color: var(--premium-text);
    font-weight: 600;
    font-size: 0.92rem;
    word-break: break-word;
}
.premium-modal-footer {
    padding: 18px 28px 28px;
    display: flex;
    gap: 10px;
}
.premium-modal-footer .premium-btn { flex: 1; justify-content: center; }
@media (max-width: 1024px) {
    .premium-hero { padding: 40px 28px 44px; }
    .premium-grid { grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); }
}
@media (max-width: 768px) {
    .premium-hero { padding: 32px 22px 36px; border-radius: 22px; }
    .premium-title { font-size: clamp(2.2rem, 9vw, 3.4rem); }
    .premium-title-wrap { gap: 18px; }
    .premium-toolbar { flex-direction: column; align-items: stretch; padding: 12px 14px; }
    .premium-toolbar-actions { justify-content: space-between; width: 100%; }
    .premium-search { min-width: 0; }
    .premium-search input { font-size: 0.88rem; padding: 11px 16px 11px 42px; }
    .premium-divisi-select-toolbar,
    .divisi-select-toolbar { min-width: 0; flex: 1; }
    .premium-grid { grid-template-columns: 1fr; gap: 16px; }
    .premium-card { padding: 22px 20px 18px; border-radius: 20px; }
    .premium-modal-card { max-width: 95vw; border-radius: 20px; }
    .premium-modal-header { padding: 30px 20px 20px; flex-direction: column; text-align: center; gap: 14px; }
    .premium-modal-body { padding: 18px 22px; }
    .premium-modal-footer { padding: 16px 22px 24px; flex-direction: column; }
    .premium-modal-footer .premium-btn { width: 100%; justify-content: center; }
    .premium-meta { gap: 14px; }
    .premium-pagination .page-link { padding: 8px 12px !important; font-size: 0.78rem !important; min-width: 36px; }
}
@media (max-width: 480px) {
    .premium-hero { padding: 26px 18px 30px; border-radius: 18px; }
    .premium-eyebrow { font-size: 0.6rem; padding: 7px 12px; letter-spacing: 2px; margin-bottom: 18px; }
    .premium-title { font-size: clamp(1.85rem, 10vw, 2.6rem); line-height: 1.05; }
    .premium-title-logo { width: 70px; height: 70px; }
    .premium-subtitle { font-size: 0.92rem; margin-bottom: 24px; }
    .premium-hero-actions { flex-direction: column; align-items: stretch; gap: 10px; }
    .premium-hero-actions .premium-btn { justify-content: center; padding: 12px 18px; font-size: 0.82rem; }
    .premium-meta { flex-direction: column; align-items: flex-start; gap: 12px; padding-top: 18px; }
    .premium-meta-sep { display: none; }
    .premium-meta-value { font-size: 0.85rem; }
    .premium-card-name { font-size: 1.05rem; }
    .premium-card-avatar-wrap { width: 60px; height: 60px; }
    .premium-modal-card { max-width: 100vw; border-radius: 18px; }
    .premium-modal-close { top: 12px; right: 12px; width: 34px; height: 34px; }
    .premium-modal-avatar { width: 64px; height: 64px; font-size: 1.4rem; }
    .premium-modal-info h3 { font-size: 1.1rem; }
    .premium-modal-row > i { width: 32px; height: 32px; font-size: 0.78rem; }
    .premium-pagination .pagination { gap: 4px; }
    .premium-pagination .page-link { padding: 7px 10px !important; font-size: 0.74rem !important; min-width: 32px; }
    .premium-empty { padding: 60px 16px; }
    .premium-empty-icon { width: 80px; height: 80px; font-size: 2rem; }
}
html, body { overflow-x: hidden; max-width: 100%; }
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const empSearch    = document.getElementById("empSearch");
    const empFilterDept= document.getElementById("empFilterDept");
    const empCards     = document.querySelectorAll(".premium-card");
    const empNoResult  = document.getElementById("empNoResult");

    // ===== Custom Divisi Filter Dropdown =====
    const filterDivisiSelect  = document.getElementById("filterDivisiSelect");
    const filterDivisiTrigger = document.getElementById("filterDivisiTrigger");
    const filterDivisiPanel   = document.getElementById("filterDivisiPanel");
    const filterDivisiValue   = document.getElementById("filterDivisiValue");
    const filterDivisiOptions = document.querySelectorAll("#filterDivisiOptions .divisi-option");

    function playFilterOptionAnimations() {
        filterDivisiOptions.forEach((opt, idx) => {
            opt.style.animation = "none";
            void opt.offsetWidth;
            opt.style.animation = "";
            opt.style.opacity = "0";
            opt.style.transform = "translateX(-12px)";
            setTimeout(() => {
                opt.style.transition = "opacity 0.4s cubic-bezier(0.16,1,0.3,1), transform 0.4s cubic-bezier(0.16,1,0.3,1)";
                opt.style.opacity = "1";
                opt.style.transform = "translateX(0)";
                opt.style.transitionDelay = (idx * 0.04) + "s";
            }, 10);
        });
    }

    function closeFilterDropdown() {
        if (!filterDivisiSelect) return;
        filterDivisiSelect.classList.remove("is-open");
        if (filterDivisiTrigger) {
            filterDivisiTrigger.classList.remove("is-open");
            filterDivisiTrigger.setAttribute("aria-expanded", "false");
        }
        if (filterDivisiPanel) filterDivisiPanel.classList.remove("is-open");
        const toolbar = document.querySelector(".premium-toolbar");
        if (toolbar) toolbar.style.zIndex = "";
    }

    if (filterDivisiSelect && filterDivisiTrigger && filterDivisiPanel) {
        const toolbar = document.querySelector(".premium-toolbar");
        if (toolbar) toolbar.style.position = "relative";

        filterDivisiTrigger.addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            const isOpen = filterDivisiSelect.classList.contains("is-open");
            closeFilterDropdown();
            if (!isOpen) {
                filterDivisiSelect.classList.add("is-open");
                filterDivisiTrigger.classList.add("is-open");
                filterDivisiPanel.classList.add("is-open");
                filterDivisiTrigger.setAttribute("aria-expanded", "true");
                if (toolbar) toolbar.style.zIndex = "100";
                playFilterOptionAnimations();
            }
        });

        filterDivisiOptions.forEach(opt => {
            opt.addEventListener("click", (e) => {
                e.preventDefault();
                e.stopPropagation();
                const value = opt.dataset.value;
                const text  = opt.querySelector(".divisi-option-text").textContent;

                // Update native select
                empFilterDept.value = value;
                empFilterDept.dispatchEvent(new Event("change", { bubbles: true }));

                // Update visible
                filterDivisiValue.innerHTML = `<span class="divisi-option-text" style="letter-spacing:1.2px; text-transform:uppercase;">${text}</span>`;
                filterDivisiValue.classList.add("has-value");

                // Mark selected
                filterDivisiOptions.forEach(o => o.classList.remove("is-selected"));
                opt.classList.add("is-selected");

                closeFilterDropdown();
            });
        });

        // Close on outside click
        document.addEventListener("click", (e) => {
            if (filterDivisiSelect && !filterDivisiSelect.contains(e.target)) {
                closeFilterDropdown();
            }
        });

        // Close on ESC
        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") closeFilterDropdown();
        });
    }

    function filterEmployees() {
        const search = (empSearch.value || "").toLowerCase();
        const dept   = empFilterDept.value;
        let visibleCount = 0;

        empCards.forEach(card => {
            const name    = card.dataset.name || "";
            const nip     = card.dataset.nip || "";
            const jabatan = card.dataset.jabatan || "";
            const divisi  = card.dataset.departemen || "";
            const matchSearch = name.includes(search) || nip.includes(search) || jabatan.includes(search);
            const matchDept   = !dept || divisi === dept;

            if (matchSearch && matchDept) {
                card.style.display = "";
                visibleCount++;
            } else {
                card.style.display = "none";
            }
        });

        if (empNoResult) {
            empNoResult.style.display = visibleCount === 0 ? "block" : "none";
        }
    }

    if (empSearch)     empSearch.addEventListener("input", filterEmployees);
    if (empFilterDept) empFilterDept.addEventListener("change", filterEmployees);

    window.closeModal = function () {
        document.getElementById("empModal").classList.remove("active");
    };

    window.showDetail = function (btn) {
        const card = btn.closest(".premium-card");
        if (!card) return;

        const name    = card.querySelector(".premium-card-name")?.textContent || "";
        const jabatan = card.querySelector(".premium-card-jabatan span")?.textContent || "";
        const dept    = card.querySelector(".premium-dept-badge")?.textContent || "";
        const nipRaw  = card.querySelector(".premium-card-nip span")?.textContent || "";
        const nip     = nipRaw.trim();
        const email   = card.querySelectorAll(".premium-card-meta span")[0]?.textContent || "";
        const joinEl  = card.querySelectorAll(".premium-card-meta span")[1];
        const join    = joinEl ? joinEl.textContent : "";
        const avatarEl= card.querySelector(".premium-card-avatar");
        const editLink= card.querySelector(".premium-action-edit").getAttribute("href");

        const modalAvatar = document.getElementById("empModalAvatar");
        const img = avatarEl.querySelector("img");
        if (img) {
            modalAvatar.innerHTML = "<img src=\"" + img.src + "\" alt=\"" + name + "\">";
        } else {
            const initial = avatarEl.querySelector(".premium-avatar-initial")?.textContent || name.charAt(0).toUpperCase();
            modalAvatar.innerHTML = initial;
        }

        document.getElementById("empModalName").textContent = name;
        document.getElementById("empModalJabatan").textContent = jabatan;

        document.getElementById("empModalBody").innerHTML =
            "<div class=\"premium-modal-row\">" +
                "<i class=\"fas fa-fingerprint\"></i>" +
                "<div class=\"premium-modal-row-text\">" +
                    "<div class=\"premium-modal-row-label\">CREW ID</div>" +
                    "<div class=\"premium-modal-row-value\">" + nip + "</div>" +
                "</div>" +
            "</div>" +
            "<div class=\"premium-modal-row\">" +
                "<i class=\"fas fa-envelope\"></i>" +
                "<div class=\"premium-modal-row-text\">" +
                    "<div class=\"premium-modal-row-label\">Email</div>" +
                    "<div class=\"premium-modal-row-value\">" + email + "</div>" +
                "</div>" +
            "</div>" +
            "<div class=\"premium-modal-row\">" +
                "<i class=\"fas fa-layer-group\"></i>" +
                "<div class=\"premium-modal-row-text\">" +
                    "<div class=\"premium-modal-row-label\">Divisi</div>" +
                    "<div class=\"premium-modal-row-value\">" + dept + "</div>" +
                "</div>" +
            "</div>" +
            (join ? "<div class=\"premium-modal-row\">" +
                "<i class=\"fas fa-calendar-check\"></i>" +
                "<div class=\"premium-modal-row-text\">" +
                    "<div class=\"premium-modal-row-label\">Bergabung</div>" +
                    "<div class=\"premium-modal-row-value\">" + join.replace("Bergabung ", "") + "</div>" +
                "</div>" +
            "</div>" : "");

        document.getElementById("empModalEditBtn").setAttribute("href", editLink);
        document.getElementById("empModal").classList.add("active");
    };

    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") closeModal();
    });

    window.showDeleteModal = function (form) {
        const nama = form.closest(".premium-card").querySelector(".premium-card-name").textContent;
        if (confirm("⚠️ Yakin ingin menghapus data karyawan \"" + nama + "\"?\n\nTindakan ini tidak dapat dibatalkan!")) {
            form.submit();
        }
    };
});
</script>

@endsection

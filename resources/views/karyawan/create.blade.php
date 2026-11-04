@extends('layouts.app')

@section('content')

{{-- Inter Font --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

{{-- ============================================================ --}}
{{-- CINEMATIC HERO HEADER --}}
{{-- ============================================================ --}}
<section class="premium-hero">
    <div class="premium-hero-bg"></div>
    <div class="premium-hero-grid"></div>
    <div class="premium-hero-glow"></div>

    <div class="premium-hero-content">
        <div class="premium-eyebrow">
            <span class="premium-eyebrow-dot"></span>
            <span>HR CONTROL CENTER · EST. 2026</span>
        </div>

        <h1 class="premium-title">
            Tambah Karyawan<br>
            <span class="premium-title-accent">Baru</span>
        </h1>

        <p class="premium-subtitle">
            Daftarkan anggota tim baru ke dalam sistem —
            <br class="d-none d-md-inline">
            formulir premium untuk manajemen talenta profesional.
        </p>

        <div class="premium-meta">
            <div class="premium-meta-item">
                <span class="premium-meta-label">Formulir</span>
                <span class="premium-meta-value">KRY-001 / 2026</span>
            </div>
            <span class="premium-meta-sep">·</span>
            <div class="premium-meta-item">
                <span class="premium-meta-label">Status</span>
                <span class="premium-meta-value status-ready">
                    <span class="status-dot"></span> Ready
                </span>
            </div>
            <span class="premium-meta-sep">·</span>
            <div class="premium-meta-item">
                <span class="premium-meta-label">Diperlukan</span>
                <span class="premium-meta-value">7 Field</span>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================ --}}
{{-- BENTO GRID FORM --}}
{{-- ============================================================ --}}
<form action="{{ route('karyawan.store') }}" method="POST" enctype="multipart/form-data" class="premium-form">
    @csrf

    <div class="bento-grid">

        {{-- ===== LEFT COLUMN ===== --}}
        <div class="bento-col bento-col-left">

            {{-- PANEL 01: Identitas Utama --}}
            <article class="bento-panel">
                <header class="bento-panel-header">
                    <div class="bento-step">
                        <span class="bento-step-number">01</span>
                        <span class="bento-step-pulse"></span>
                    </div>
                    <div class="bento-panel-meta">
                        <h3 class="bento-panel-title">Identitas Utama</h3>
                        <p class="bento-panel-desc">Data fundamental yang melekat pada karyawan</p>
                    </div>
                </header>

                <div class="bento-panel-body">
                    <div class="premium-field">
                        <label for="nama_lengkap" class="premium-label">
                            <span class="premium-label-text">Nama Lengkap</span>
                            <span class="premium-label-required">*</span>
                        </label>
                        <div class="premium-input-wrap">
                            <input
                                type="text"
                                name="nama_lengkap"
                                id="nama_lengkap"
                                class="premium-input @error('nama_lengkap') is-invalid @enderror"
                                placeholder="Masukkan nama sesuai KTP"
                                value="{{ old('nama_lengkap') }}"
                                autocomplete="off"
                            >
                            <span class="premium-input-line"></span>
                        </div>
                        @error('nama_lengkap')
                            <span class="premium-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="premium-field">
                        <label for="nip" class="premium-label">
                            <span class="premium-label-text">CREW ID</span>
                            <span class="premium-label-required">*</span>
                        </label>
                        <div class="premium-input-wrap">
                            <input
                                type="text"
                                name="nip"
                                id="nip"
                                class="premium-input @error('nip') is-invalid @enderror"
                                placeholder="Contoh: VP-099"
                                value="{{ old('nip') }}"
                                autocomplete="off"
                            >
                            <span class="premium-input-line"></span>
                        </div>
                        @error('nip')
                            <span class="premium-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="premium-field">
                        <label for="email" class="premium-label">
                            <span class="premium-label-text">Alamat Email</span>
                            <span class="premium-label-required">*</span>
                        </label>
                        <div class="premium-input-wrap">
                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="premium-input @error('email') is-invalid @enderror"
                                placeholder="nama@visualproduction.com"
                                value="{{ old('email') }}"
                                autocomplete="off"
                            >
                            <span class="premium-input-line"></span>
                        </div>
                        @error('email')
                            <span class="premium-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </article>

            {{-- PANEL 03: Dokumen Lampiran --}}
            <article class="bento-panel">
                <header class="bento-panel-header">
                    <div class="bento-step">
                        <span class="bento-step-number">03</span>
                        <span class="bento-step-pulse"></span>
                    </div>
                    <div class="bento-panel-meta">
                        <h3 class="bento-panel-title">Dokumen Lampiran</h3>
                        <p class="bento-panel-desc">Opsional · PDF, DOC, DOCX, JPG, PNG</p>
                    </div>
                </header>

                <div class="bento-panel-body">
                    <label for="dokumen_lampiran" class="premium-dropzone" id="premiumDropzone">
                        <input
                            type="file"
                            name="dokumen_lampiran"
                            id="dokumen_lampiran"
                            class="premium-dropzone-input @error('dokumen_lampiran') is-invalid @enderror"
                            accept=".pdf,.doc,.docx,.jpg,.png"
                        >

                        <div class="premium-dropzone-inner">
                            <div class="premium-dropzone-icon">
                                <i class="fas fa-arrow-up-from-bracket"></i>
                            </div>
                            <div class="premium-dropzone-text">
                                <span class="premium-dropzone-title">Letakkan file di sini</span>
                                <span class="premium-dropzone-sub">atau klik untuk memilih · Maks 10MB</span>
                            </div>
                        </div>

                        <div class="premium-dropzone-file" id="premiumFilePreview" hidden>
                            <i class="fas fa-file-lines"></i>
                            <span id="premiumFileName">filename.pdf</span>
                            <button type="button" class="premium-dropzone-remove" id="premiumFileRemove" aria-label="Hapus file">
                                <i class="fas fa-xmark"></i>
                            </button>
                        </div>
                    </label>

                    @error('dokumen_lampiran')
                        <span class="premium-error">{{ $message }}</span>
                    @enderror
                </div>
            </article>

            {{-- PANEL 04: Foto Profil --}}
            <article class="bento-panel">
                <header class="bento-panel-header">
                    <div class="bento-step">
                        <span class="bento-step-number">04</span>
                        <span class="bento-step-pulse"></span>
                    </div>
                    <div class="bento-panel-meta">
                        <h3 class="bento-panel-title">Foto Profil</h3>
                        <p class="bento-panel-desc">Wajib · JPG, PNG, WEBP · Maksimal 10MB</p>
                    </div>
                </header>

                <div class="bento-panel-body">
                    <label for="foto" class="premium-photo-upload" id="photoDropzone">
                        <input
                            type="file"
                            name="foto"
                            id="foto"
                            class="premium-photo-input @error('foto') is-invalid @enderror"
                            accept="image/jpeg,image/png,image/webp"
                            required
                        >

                        <div class="premium-photo-preview" id="photoPreview">
                            <i class="fas fa-user-plus" id="photoPlaceholderIcon"></i>
                            <img id="photoPreviewImage" alt="Pratinjau foto profil" hidden>
                        </div>

                        <div class="premium-photo-copy">
                            <span class="premium-dropzone-title" id="photoUploadTitle">Pilih Foto Profil</span>
                            <span class="premium-dropzone-sub" id="photoFileName">Klik atau letakkan foto di sini</span>
                            <span class="premium-photo-hint">Foto akan langsung tampil sebagai avatar di halaman karyawan.</span>
                        </div>

                        <span class="premium-photo-action">
                            <i class="fas fa-camera"></i>
                            Pilih Foto
                        </span>
                    </label>

                    @error('foto')
                        <span class="premium-error">{{ $message }}</span>
                    @enderror
                </div>
            </article>
        </div>

        {{-- ===== RIGHT COLUMN ===== --}}
        <div class="bento-col bento-col-right">
            <article class="bento-panel bento-panel-feature">
                <header class="bento-panel-header">
                    <div class="bento-step">
                        <span class="bento-step-number">02</span>
                        <span class="bento-step-pulse"></span>
                    </div>
                    <div class="bento-panel-meta">
                        <h3 class="bento-panel-title">Penugasan &amp; Jabatan</h3>
                        <p class="bento-panel-desc">Posisi strategis karyawan dalam organisasi</p>
                    </div>
                </header>

                <div class="bento-panel-body bento-panel-body-spaced">

                    {{-- Divisi --}}
                    <div class="premium-field">
                        <label for="departemen" class="premium-label">
                            <span class="premium-label-text">Divisi</span>
                            <span class="premium-label-required">*</span>
                        </label>

                        {{-- Custom Select Trigger --}}
                        <div class="divisi-select" id="divisiSelect">
                            <button
                                type="button"
                                class="divisi-select-trigger @error('departemen') is-invalid @enderror"
                                id="divisiTrigger"
                                aria-haspopup="listbox"
                                aria-expanded="false"
                            >
                                <span class="divisi-select-value" id="divisiValue">
                                    <span class="divisi-select-placeholder">PILIH DEVISI</span>
                                </span>
                                <span class="divisi-select-arrow">
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                                <span class="divisi-select-glow"></span>
                            </button>

                            {{-- Hidden native select (untuk form submission) --}}
                            <select
                                name="departemen"
                                id="departemen"
                                class="divisi-select-native"
                                aria-hidden="true"
                                tabindex="-1"
                            >
                                <option value="" disabled {{ old('departemen') ? '' : 'selected' }}>PILIH DEVISI</option>
                                <option value="PHOTOGRAPHER" {{ old('departemen') == 'PHOTOGRAPHER' ? 'selected' : '' }}>PHOTOGRAPHER</option>
                                <option value="VIDEOGRAPHER" {{ old('departemen') == 'VIDEOGRAPHER' ? 'selected' : '' }}>VIDEOGRAPHER</option>
                                <option value="DRONE PILOT" {{ old('departemen') == 'DRONE PILOT' ? 'selected' : '' }}>DRONE PILOT</option>
                                <option value="VIDEO EDITOR" {{ old('departemen') == 'VIDEO EDITOR' ? 'selected' : '' }}>VIDEO EDITOR</option>
                                <option value="VISUAL JOCKIE" {{ old('departemen') == 'VISUAL JOCKIE' ? 'selected' : '' }}>VISUAL JOCKIE</option>
                                <option value="VISUAL EDITOR" {{ old('departemen') == 'VISUAL EDITOR' ? 'selected' : '' }}>VISUAL EDITOR</option>
                                <option value="SWITCHER" {{ old('departemen') == 'SWITCHER' ? 'selected' : '' }}>SWITCHER</option>
                                <option value="CAMPERS" {{ old('departemen') == 'CAMPERS' ? 'selected' : '' }}>CAMPERS</option>
                                <option value="BEHIND THE SCENE" {{ old('departemen') == 'BEHIND THE SCENE' ? 'selected' : '' }}>BEHIND THE SCENE</option>
                                <option value="CONTENT CREATOR" {{ old('departemen') == 'CONTENT CREATOR' ? 'selected' : '' }}>CONTENT CREATOR</option>
                                <option value="SOUND ENGINER" {{ old('departemen') == 'SOUND ENGINER' ? 'selected' : '' }}>SOUND ENGINER</option>
                                <option value="SOUND MAN" {{ old('departemen') == 'SOUND MAN' ? 'selected' : '' }}>SOUND MAN</option>
                            </select>

                            {{-- Custom dropdown panel --}}
                            <div class="divisi-select-panel" id="divisiPanel" role="listbox">
                                <div class="divisi-select-panel-inner">
                                    <div class="divisi-select-panel-header">
                                        <span class="divisi-select-panel-title">Pilih Divisi</span>
                                        <span class="divisi-select-panel-meta">12 Pilihan Tersedia</span>
                                    </div>

                                    <div class="divisi-select-options">
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

                        <span class="premium-input-line"></span>

                        @error('departemen')
                            <span class="premium-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Role --}}
                    <div class="premium-field">
                        <label for="jabatan" class="premium-label">
                            <span class="premium-label-text">Role</span>
                            <span class="premium-label-required">*</span>
                        </label>
                        <div class="role-select" id="roleSelect">
                            <button
                                type="button"
                                class="role-select-trigger @error('jabatan') is-invalid @enderror"
                                id="roleTrigger"
                                aria-haspopup="listbox"
                                aria-expanded="false"
                            >
                                <span class="role-select-value" id="roleValue">
                                    <span class="role-select-placeholder">PILIH ROLE</span>
                                </span>
                                <span class="role-select-arrow">
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                                <span class="role-select-glow"></span>
                            </button>

                            <select
                                name="jabatan"
                                id="jabatan"
                                class="role-select-native"
                                aria-hidden="true"
                                tabindex="-1"
                            >
                                <option value="" disabled {{ old('jabatan') ? '' : 'selected' }}>PILIH ROLE</option>
                                <option value="Creative Director" {{ old('jabatan') == 'Creative Director' ? 'selected' : '' }}>Creative Director</option>
                                <option value="Scriptwriter" {{ old('jabatan') == 'Scriptwriter' ? 'selected' : '' }}>Scriptwriter</option>
                                <option value="Production Team" {{ old('jabatan') == 'Production Team' ? 'selected' : '' }}>Production Team</option>
                                <option value="Intern" {{ old('jabatan') == 'Intern' ? 'selected' : '' }}>Intern</option>
                                <option value="Chief Executive Office" {{ old('jabatan') == 'Chief Executive Office' ? 'selected' : '' }}>Chief Executive Office</option>
                            </select>

                            <div class="role-select-panel" id="rolePanel" role="listbox">
                                <div class="role-select-panel-inner">
                                    <div class="role-select-panel-header">
                                        <span class="role-select-panel-title">Pilih Role</span>
                                        <span class="role-select-panel-meta">5 Pilihan Tersedia</span>
                                    </div>

                                    <div class="role-select-options">
                                        <button type="button" class="role-option" data-value="Creative Director" role="option">
                                            <span class="role-option-marker"></span>
                                            <span class="role-option-text">Creative Director</span>
                                            <span class="role-option-icon"><i class="fas fa-palette"></i></span>
                                        </button>
                                        <button type="button" class="role-option" data-value="Scriptwriter" role="option">
                                            <span class="role-option-marker"></span>
                                            <span class="role-option-text">Scriptwriter</span>
                                            <span class="role-option-icon"><i class="fas fa-feather-pointed"></i></span>
                                        </button>
                                        <button type="button" class="role-option" data-value="Production Team" role="option">
                                            <span class="role-option-marker"></span>
                                            <span class="role-option-text">Production Team</span>
                                            <span class="role-option-icon"><i class="fas fa-clapperboard"></i></span>
                                        </button>
                                        <button type="button" class="role-option" data-value="Intern" role="option">
                                            <span class="role-option-marker"></span>
                                            <span class="role-option-text">Intern</span>
                                            <span class="role-option-icon"><i class="fas fa-graduation-cap"></i></span>
                                        </button>
                                        <button type="button" class="role-option" data-value="Chief Executive Office" role="option">
                                            <span class="role-option-marker"></span>
                                            <span class="role-option-text">Chief Executive Office</span>
                                            <span class="role-option-icon"><i class="fas fa-user-tie"></i></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <span class="premium-input-line"></span>

                        @error('jabatan')
                            <span class="premium-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Tanggal Bergabung --}}
                    <div class="premium-field">
                        <label for="tanggal_bergabung" class="premium-label">
                            <span class="premium-label-text">Tanggal Bergabung</span>
                            <span class="premium-label-required">*</span>
                        </label>
                        <div class="premium-input-wrap">
                            <input
                                type="date"
                                name="tanggal_bergabung"
                                id="tanggal_bergabung"
                                class="premium-input @error('tanggal_bergabung') is-invalid @enderror"
                                value="{{ old('tanggal_bergabung') }}"
                            >
                            <span class="premium-input-line"></span>
                        </div>
                        @error('tanggal_bergabung')
                            <span class="premium-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </article>
        </div>

    </div>

    {{-- ===== ACTION BAR ===== --}}
    <footer class="premium-actions">
        <div class="premium-actions-info">
            <i class="fas fa-shield-halved"></i>
            <span>Data Anda terenkripsi dan aman dalam sistem internal kami.</span>
        </div>
        <div class="premium-actions-buttons">
            <a href="{{ route('karyawan.index') }}" class="premium-btn premium-btn-ghost">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
            <button type="submit" class="premium-btn premium-btn-primary">
                <span class="premium-btn-text">Simpan Data Karyawan</span>
                <span class="premium-btn-icon"><i class="fas fa-arrow-right"></i></span>
                <span class="premium-btn-shine"></span>
            </button>
        </div>
    </footer>

</form>

{{-- ============================================================ --}}
{{-- PREMIUM STYLES --}}
{{-- ============================================================ --}}
<style>
/* ===== FONT OVERRIDE: Inter ===== */
.premium-hero,
.bento-grid,
.premium-actions {
    font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
}

/* ===== CSS VARIABLES (Charcoal + Copper Gold) ===== */
:root {
    --premium-charcoal: #14171c;
    --premium-charcoal-2: #1a1d24;
    --premium-charcoal-3: #22262e;
    --premium-line: rgba(255, 255, 255, 0.06);
    --premium-line-strong: rgba(255, 255, 255, 0.12);
    --premium-text: #f5f5f7;
    --premium-text-dim: rgba(245, 245, 247, 0.55);
    --premium-text-faint: rgba(245, 245, 247, 0.35);

    --premium-gold: #c8a268;          /* Copper gold core */
    --premium-gold-bright: #d4b585;   /* Lighter copper */
    --premium-gold-glow: rgba(200, 162, 104, 0.35);
    --premium-gold-soft: rgba(200, 162, 104, 0.12);
    --premium-gold-line: rgba(200, 162, 104, 0.45);
}

/* ============================================================ */
/* CINEMATIC HERO */
/* ============================================================ */
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
    background:
        radial-gradient(circle at 70% 30%, var(--premium-gold-soft) 0%, transparent 45%);
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
    font-size: 0.88rem;
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

/* ============================================================ */
/* BENTO GRID LAYOUT */
/* ============================================================ */
.bento-grid {
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
    gap: 24px;
    margin-bottom: 32px;
}

.bento-col {
    display: flex;
    flex-direction: column;
    gap: 24px;
    min-width: 0;
}

.bento-col-right .bento-panel {
    height: 100%;
}

/* ============================================================ */
/* BENTO PANEL (Glassmorphic) */
/* ============================================================ */
.bento-panel {
    position: relative;
    background: rgba(26, 29, 36, 0.55);
    backdrop-filter: blur(24px) saturate(140%);
    -webkit-backdrop-filter: blur(24px) saturate(140%);
    border: 1px solid var(--premium-line-strong);
    border-radius: 24px;
    padding: 32px 32px 30px;
    overflow: hidden;
    box-shadow:
        0 1px 0 rgba(255, 255, 255, 0.04) inset,
        0 20px 60px rgba(0, 0, 0, 0.4),
        0 8px 24px rgba(0, 0, 0, 0.25);
    transition: border-color 0.4s ease, transform 0.4s ease;
}

.bento-panel::before {
    content: '';
    position: absolute;
    top: 0;
    left: 24px;
    right: 24px;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--premium-gold-line), transparent);
    opacity: 0.5;
}

.bento-panel:hover {
    border-color: rgba(200, 162, 104, 0.25);
}

.bento-panel-feature {
    background:
        radial-gradient(800px 300px at 100% 0%, rgba(200, 162, 104, 0.06), transparent 60%),
        rgba(26, 29, 36, 0.6);
}

.bento-panel-header {
    display: flex;
    align-items: center;
    gap: 18px;
    margin-bottom: 26px;
    padding-bottom: 22px;
    border-bottom: 1px solid var(--premium-line);
}

.bento-panel-title {
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--premium-text);
    margin: 0 0 4px;
    letter-spacing: -0.01em;
}

.bento-panel-desc {
    font-size: 0.78rem;
    color: var(--premium-text-faint);
    margin: 0;
    letter-spacing: 0.3px;
}

.bento-panel-body {
    display: flex;
    flex-direction: column;
    gap: 26px;
}

.bento-panel-body-spaced {
    gap: 32px;
    padding-top: 6px;
}

/* ============================================================ */
/* STEP NUMBER (Glowing 01/02/03) */
/* ============================================================ */
.bento-step {
    position: relative;
    width: 64px;
    height: 64px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.bento-step-number {
    position: relative;
    z-index: 2;
    font-size: 1.55rem;
    font-weight: 900;
    letter-spacing: -0.02em;
    background: linear-gradient(135deg, #e8d4a8 0%, var(--premium-gold) 50%, #a07f4a 100%);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    color: transparent;
    filter: drop-shadow(0 0 18px var(--premium-gold-glow));
}

.bento-step::before {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 18px;
    background: rgba(200, 162, 104, 0.04);
    border: 1px solid rgba(200, 162, 104, 0.2);
    z-index: 1;
    transition: all 0.3s ease;
}

.bento-step::after {
    content: '';
    position: absolute;
    inset: -4px;
    border-radius: 22px;
    background: radial-gradient(circle, var(--premium-gold-glow) 0%, transparent 70%);
    opacity: 0.3;
    z-index: 0;
    transition: opacity 0.4s ease;
}

.bento-panel:hover .bento-step::before {
    background: rgba(200, 162, 104, 0.08);
    border-color: rgba(200, 162, 104, 0.4);
    box-shadow: 0 0 24px var(--premium-gold-soft);
}

.bento-panel:hover .bento-step::after {
    opacity: 0.6;
}

.bento-step-pulse {
    position: absolute;
    top: 4px;
    right: 4px;
    width: 8px;
    height: 8px;
    background: var(--premium-gold);
    border-radius: 50%;
    box-shadow: 0 0 12px var(--premium-gold);
    z-index: 3;
    animation: stepPulse 2.6s ease-in-out infinite;
}

@keyframes stepPulse {
    0%, 100% { opacity: 0.4; transform: scale(0.85); }
    50%      { opacity: 1;   transform: scale(1.15); }
}

/* ============================================================ */
/* PREMIUM FIELDS (Underline-only inputs) */
/* ============================================================ */
.premium-field {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.premium-label {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 0.68rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: var(--premium-text-dim);
    transition: color 0.3s ease;
}

.premium-label-text {
    display: inline-block;
}

.premium-label-required {
    color: var(--premium-gold);
    font-size: 0.85rem;
    line-height: 1;
}

.premium-input-wrap {
    position: relative;
    padding-top: 6px;
}

.premium-input {
    width: 100%;
    padding: 10px 0 14px;
    background: transparent;
    border: none;
    border-bottom: 1px solid var(--premium-line-strong);
    color: var(--premium-text);
    font-family: inherit;
    font-size: 1rem;
    font-weight: 500;
    letter-spacing: -0.005em;
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    outline: none;
}

.premium-input::placeholder {
    color: var(--premium-text-faint);
    font-weight: 400;
}

.premium-input:hover {
    border-bottom-color: rgba(200, 162, 104, 0.35);
}

.premium-input:focus {
    border-bottom-color: var(--premium-gold);
}

.premium-input-wrap:hover .premium-input-line,
.premium-input:focus ~ .premium-input-line {
    transform: scaleX(1);
}

.premium-input-line {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--premium-gold), transparent);
    transform: scaleX(0);
    transform-origin: center;
    transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 0 12px var(--premium-gold-glow);
    pointer-events: none;
}

.premium-input-wrap:focus-within {
    filter: drop-shadow(0 6px 18px rgba(200, 162, 104, 0.12));
}

.premium-input-wrap:focus-within .premium-label {
    color: var(--premium-gold);
}

.premium-input.is-invalid {
    border-bottom-color: #f87171;
}

.premium-error {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.75rem;
    color: #fca5a5;
    margin-top: 4px;
    letter-spacing: 0.2px;
}

.premium-error::before {
    content: '\f06a';
    font-family: 'Font Awesome 6 Free';
    font-weight: 900;
    font-size: 0.7rem;
}

/* ============================================================ */
/* SELECT STYLING */
/* ============================================================ */
.premium-select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    cursor: pointer;
    background: transparent;
    padding-right: 28px;
}

.premium-select option {
    background: #1a1d24;
    color: var(--premium-text);
    padding: 10px;
}

.premium-select-caret {
    position: absolute;
    right: 0;
    bottom: 16px;
    color: var(--premium-text-dim);
    font-size: 0.7rem;
    pointer-events: none;
    transition: transform 0.3s ease, color 0.3s ease;
}

.premium-input-wrap:focus-within .premium-select-caret {
    color: var(--premium-gold);
    transform: translateY(2px);
}

/* ============================================================ */
/* CUSTOM DIVISI SELECT — Premium Animated */
/* ============================================================ */
.divisi-select {
    position: relative;
    margin-top: 6px;
    z-index: 40;
}

.divisi-select.is-open {
    z-index: 100;
}

.divisi-select-native {
    position: absolute;
    width: 1px;
    height: 1px;
    opacity: 0;
    pointer-events: none;
    left: -9999px;
}

.divisi-select-trigger {
    position: relative;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    padding: 14px 4px 14px;
    background: transparent;
    border: none;
    border-bottom: 1px solid var(--premium-line-strong);
    color: var(--premium-text);
    font-family: inherit;
    font-size: 1rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    cursor: pointer;
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    text-align: left;
}

.divisi-select-trigger:hover {
    border-bottom-color: rgba(200, 162, 104, 0.4);
}

.divisi-select-trigger.is-invalid {
    border-bottom-color: #f87171;
}

.divisi-select-trigger.is-open {
    border-bottom-color: var(--premium-gold);
}

.divisi-select-value {
    flex: 1;
    display: flex;
    align-items: center;
    gap: 10px;
    overflow: hidden;
}

.divisi-select-placeholder {
    color: var(--premium-text-faint);
    font-weight: 500;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    font-size: 0.95rem;
    background: linear-gradient(90deg, rgba(245, 245, 247, 0.35), rgba(245, 245, 247, 0.55), rgba(245, 245, 247, 0.35));
    background-size: 200% 100%;
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: placeholderShine 4s ease-in-out infinite;
}

@keyframes placeholderShine {
    0%, 100% { background-position: 0% 50%; }
    50%      { background-position: 100% 50%; }
}

.divisi-select-value.has-value .divisi-select-placeholder {
    animation: none;
    background: none;
    -webkit-text-fill-color: initial;
    color: var(--premium-gold-bright);
    font-weight: 700;
    letter-spacing: 1px;
    font-size: 1rem;
}

.divisi-select-value.has-value::before {
    content: '';
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--premium-gold);
    box-shadow: 0 0 10px var(--premium-gold), 0 0 18px var(--premium-gold-glow);
    flex-shrink: 0;
    animation: valueDotPulse 2.4s ease-in-out infinite;
}

@keyframes valueDotPulse {
    0%, 100% { opacity: 1;   transform: scale(1);   }
    50%      { opacity: 0.5; transform: scale(1.4); }
}

.divisi-select-arrow {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: rgba(200, 162, 104, 0.06);
    border: 1px solid rgba(200, 162, 104, 0.15);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--premium-gold-bright);
    font-size: 0.7rem;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    flex-shrink: 0;
}

.divisi-select-trigger:hover .divisi-select-arrow {
    background: rgba(200, 162, 104, 0.12);
    box-shadow: 0 0 14px var(--premium-gold-soft);
}

.divisi-select-trigger.is-open .divisi-select-arrow {
    background: rgba(200, 162, 104, 0.18);
    transform: rotate(180deg);
    box-shadow: 0 0 18px var(--premium-gold-glow);
}

.divisi-select-glow {
    position: absolute;
    bottom: -1px;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--premium-gold), transparent);
    transform: scaleX(0);
    transform-origin: center;
    transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 0 14px var(--premium-gold-glow);
    pointer-events: none;
}

.divisi-select-trigger.is-open ~ .divisi-select-glow {
    transform: scaleX(1);
}

/* ===== PANEL — IMPORTANT: overflow visible on parent bento panel ===== */
.divisi-select-panel {
    position: absolute;
    top: calc(100% + 12px);
    left: -2px;
    right: -2px;
    z-index: 9999;
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transform: translateY(-8px) scaleY(0.95);
    transform-origin: top center;
    transition: opacity 0.3s ease, transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.3s;
}

.divisi-select-panel.is-open {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
    transform: translateY(0) scaleY(1);
}

.divisi-select-panel-inner {
    position: relative;
    background: linear-gradient(180deg, rgba(34, 38, 46, 0.98), rgba(26, 29, 36, 0.98));
    backdrop-filter: blur(24px) saturate(140%);
    -webkit-backdrop-filter: blur(24px) saturate(140%);
    border: 1px solid var(--premium-line-strong);
    border-radius: 18px;
    overflow: hidden;
    box-shadow:
        0 30px 60px rgba(0, 0, 0, 0.6),
        0 12px 30px rgba(0, 0, 0, 0.4),
        inset 0 1px 0 rgba(255, 255, 255, 0.05);
}

.divisi-select-panel-inner::before {
    content: '';
    position: absolute;
    top: 0;
    left: 16px;
    right: 16px;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--premium-gold-line), transparent);
    opacity: 0.6;
    z-index: 1;
}

.divisi-select-panel-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 20px 12px;
    border-bottom: 1px solid var(--premium-line);
    background: rgba(0, 0, 0, 0.15);
}

.divisi-select-panel-title {
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    color: var(--premium-gold-bright);
    text-shadow: 0 0 12px var(--premium-gold-glow);
}

.divisi-select-panel-meta {
    font-size: 0.68rem;
    color: var(--premium-text-faint);
    letter-spacing: 1px;
    text-transform: uppercase;
    font-weight: 600;
}

.divisi-select-options {
    max-height: 320px;
    overflow-y: auto;
    padding: 8px;
}

.divisi-select-options::-webkit-scrollbar {
    width: 6px;
}

.divisi-select-options::-webkit-scrollbar-track {
    background: transparent;
}

.divisi-select-options::-webkit-scrollbar-thumb {
    background: rgba(200, 162, 104, 0.25);
    border-radius: 3px;
}

.divisi-select-options::-webkit-scrollbar-thumb:hover {
    background: rgba(200, 162, 104, 0.45);
}

/* ===== OPTION ===== */
.divisi-option {
    position: relative;
    width: 100%;
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 12px 14px;
    background: transparent;
    border: 1px solid transparent;
    border-radius: 12px;
    color: var(--premium-text-dim);
    font-family: inherit;
    font-size: 0.82rem;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    text-align: left;
    cursor: pointer;
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
}

.divisi-option::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, rgba(200, 162, 104, 0.1) 0%, rgba(200, 162, 104, 0.02) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.divisi-option:hover {
    border-color: rgba(200, 162, 104, 0.25);
    color: var(--premium-text);
    transform: translateX(4px);
    padding-left: 18px;
}

.divisi-option:hover::before {
    opacity: 1;
}

.divisi-option.is-selected {
    color: var(--premium-gold-bright);
    background: rgba(200, 162, 104, 0.08);
    border-color: rgba(200, 162, 104, 0.35);
    box-shadow: inset 0 0 18px rgba(200, 162, 104, 0.08);
}

.divisi-option.is-selected .divisi-option-text {
    text-shadow: 0 0 14px var(--premium-gold-glow);
}

.divisi-option-marker {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.15);
    flex-shrink: 0;
    transition: all 0.3s ease;
    position: relative;
    z-index: 1;
}

.divisi-option:hover .divisi-option-marker {
    background: var(--premium-gold);
    border-color: var(--premium-gold);
    box-shadow: 0 0 10px var(--premium-gold-glow);
}

.divisi-option.is-selected .divisi-option-marker {
    background: var(--premium-gold);
    border-color: var(--premium-gold);
    box-shadow: 0 0 14px var(--premium-gold), 0 0 24px var(--premium-gold-glow);
}

.divisi-option.is-selected .divisi-option-marker::after {
    content: '';
    position: absolute;
    inset: -4px;
    border-radius: 50%;
    border: 1px solid var(--premium-gold);
    opacity: 0.6;
    animation: markerRing 1.6s ease-in-out infinite;
}

@keyframes markerRing {
    0%, 100% { transform: scale(1);   opacity: 0.6; }
    50%      { transform: scale(1.5); opacity: 0;   }
}

.divisi-option-text {
    flex: 1;
    position: relative;
    z-index: 1;
}

.divisi-option-icon {
    width: 30px;
    height: 30px;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.06);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.78rem;
    color: var(--premium-text-faint);
    flex-shrink: 0;
    transition: all 0.35s ease;
    position: relative;
    z-index: 1;
}

.divisi-option:hover .divisi-option-icon {
    color: var(--premium-gold-bright);
    background: rgba(200, 162, 104, 0.1);
    border-color: rgba(200, 162, 104, 0.3);
    transform: scale(1.08) rotate(-5deg);
}

.divisi-option.is-selected .divisi-option-icon {
    color: var(--premium-gold);
    background: rgba(200, 162, 104, 0.15);
    border-color: var(--premium-gold-line);
    box-shadow: 0 0 14px var(--premium-gold-soft);
}

/* Override: keep bento panel overflow visible when dropdown open */
.bento-panel.is-selecting {
    overflow: visible;
}

/* ============================================================ */
/* DROPZONE */
/* ============================================================ */
.premium-dropzone {
    position: relative;
    display: block;
    padding: 28px 24px;
    background: rgba(255, 255, 255, 0.02);
    border: 1px dashed var(--premium-line-strong);
    border-radius: 18px;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
}

.premium-dropzone::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at center, var(--premium-gold-soft) 0%, transparent 70%);
    opacity: 0;
    transition: opacity 0.4s ease;
}

.premium-dropzone:hover {
    border-color: var(--premium-gold-line);
    background: rgba(200, 162, 104, 0.03);
}

.premium-dropzone:hover::before {
    opacity: 1;
}

.premium-dropzone.dragover {
    border-color: var(--premium-gold);
    background: rgba(200, 162, 104, 0.06);
    transform: scale(1.005);
}

.premium-dropzone-input {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

.premium-dropzone-inner {
    position: relative;
    display: flex;
    align-items: center;
    gap: 18px;
    z-index: 1;
}

.premium-dropzone-icon {
    width: 56px;
    height: 56px;
    flex-shrink: 0;
    border-radius: 14px;
    background: linear-gradient(135deg, rgba(200, 162, 104, 0.15), rgba(200, 162, 104, 0.04));
    border: 1px solid rgba(200, 162, 104, 0.25);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    color: var(--premium-gold-bright);
    transition: all 0.4s ease;
}

.premium-dropzone:hover .premium-dropzone-icon {
    transform: translateY(-3px);
    box-shadow: 0 10px 24px var(--premium-gold-glow);
}

.premium-dropzone-text {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.premium-dropzone-title {
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--premium-text);
    letter-spacing: -0.01em;
}

.premium-dropzone-sub {
    font-size: 0.78rem;
    color: var(--premium-text-dim);
}

.premium-dropzone-file {
    position: relative;
    z-index: 1;
    display: flex;
    align-items: center;
    gap: 12px;
    margin-top: 14px;
    padding: 12px 14px;
    background: rgba(200, 162, 104, 0.08);
    border: 1px solid var(--premium-gold-line);
    border-radius: 12px;
    font-size: 0.88rem;
    color: var(--premium-text);
    font-weight: 500;
}

.premium-dropzone-file i {
    color: var(--premium-gold);
}

.premium-dropzone-file span {
    flex: 1;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.premium-dropzone-remove {
    width: 28px;
    height: 28px;
    flex-shrink: 0;
    border: none;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.06);
    color: var(--premium-text-dim);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    transition: all 0.3s ease;
}

.premium-dropzone-remove:hover {
    background: #f87171;
    color: white;
}

/* ============================================================ */
/* PHOTO PROFILE UPLOAD */
/* ============================================================ */
.premium-photo-upload {
    position: relative;
    display: flex;
    align-items: center;
    gap: 20px;
    min-height: 142px;
    padding: 22px;
    background: rgba(255, 255, 255, 0.02);
    border: 1px dashed var(--premium-line-strong);
    border-radius: 18px;
    cursor: pointer;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.premium-photo-upload::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 20% 50%, var(--premium-gold-soft) 0%, transparent 55%);
    opacity: 0;
    transition: opacity 0.4s ease;
}

.premium-photo-upload:hover,
.premium-photo-upload.dragover {
    border-color: var(--premium-gold-line);
    background: rgba(200, 162, 104, 0.04);
}

.premium-photo-upload.dragover {
    transform: scale(1.005);
}

.premium-photo-upload:hover::before,
.premium-photo-upload.dragover::before {
    opacity: 1;
}

.premium-photo-input {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 4;
}

.premium-photo-preview {
    position: relative;
    z-index: 1;
    width: 96px;
    height: 96px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    border-radius: 50%;
    color: var(--premium-gold-bright);
    font-size: 1.7rem;
    background: linear-gradient(135deg, rgba(200, 162, 104, 0.16), rgba(200, 162, 104, 0.04));
    border: 2px solid rgba(200, 162, 104, 0.32);
    box-shadow: 0 10px 28px rgba(0, 0, 0, 0.3), 0 0 24px var(--premium-gold-soft);
}

.premium-photo-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.premium-photo-copy {
    position: relative;
    z-index: 1;
    min-width: 0;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.premium-photo-copy .premium-dropzone-sub {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.premium-photo-hint {
    color: var(--premium-text-faint);
    font-size: 0.72rem;
    line-height: 1.5;
}

.premium-photo-action {
    position: relative;
    z-index: 1;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    flex-shrink: 0;
    padding: 10px 14px;
    border-radius: 999px;
    color: #1a1d24;
    background: linear-gradient(135deg, #e8d4a8, var(--premium-gold));
    font-size: 0.75rem;
    font-weight: 800;
}

@media (max-width: 576px) {
    .premium-photo-upload {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .premium-photo-copy .premium-dropzone-sub {
        max-width: 240px;
    }
}

/* ============================================================ */
/* ACTION BAR */
/* ============================================================ */
.premium-actions {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
    padding: 24px 28px;
    background: rgba(26, 29, 36, 0.6);
    backdrop-filter: blur(20px);
    border: 1px solid var(--premium-line-strong);
    border-radius: 22px;
    box-shadow: 0 16px 40px rgba(0, 0, 0, 0.35);
    flex-wrap: wrap;
}

.premium-actions-info {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-size: 0.78rem;
    color: var(--premium-text-dim);
    letter-spacing: 0.2px;
}

.premium-actions-info i {
    color: var(--premium-gold);
}

.premium-actions-buttons {
    display: flex;
    gap: 12px;
    align-items: center;
}

/* ============================================================ */
/* PREMIUM BUTTONS (Pill) */
/* ============================================================ */
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

.premium-btn-primary:active {
    transform: translateY(-1px);
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

/* ============================================================ */
/* RESPONSIVE */
/* ============================================================ */
@media (max-width: 992px) {
    .bento-grid {
        grid-template-columns: 1fr;
    }

    .premium-hero {
        padding: 40px 28px 44px;
    }

    .premium-actions {
        flex-direction: column;
        align-items: stretch;
        text-align: center;
        padding: 20px;
    }

    .premium-actions-info {
        justify-content: center;
    }

    .premium-actions-buttons {
        justify-content: center;
        width: 100%;
    }
}

@media (max-width: 576px) {
    .premium-hero {
        padding: 28px 18px 32px;
        border-radius: 20px;
        margin-bottom: 24px;
    }

    .premium-title { font-size: clamp(2rem, 8vw, 3rem); }
    .premium-eyebrow { font-size: 0.62rem; padding: 7px 12px; letter-spacing: 2px; margin-bottom: 18px; }
    .premium-subtitle { font-size: 0.92rem; margin-bottom: 22px; }
    .premium-meta { gap: 12px; padding-top: 18px; }
    .premium-meta-sep { display: none; }

    .bento-panel {
        padding: 22px 18px;
        border-radius: 20px;
    }

    .bento-panel-header {
        gap: 14px;
        margin-bottom: 20px;
        padding-bottom: 18px;
    }

    .bento-panel-title { font-size: 1rem; }
    .bento-panel-desc { font-size: 0.72rem; }
    .bento-panel-body { gap: 20px; }

    .bento-step {
        width: 50px;
        height: 50px;
        border-radius: 14px;
    }

    .bento-step-number {
        font-size: 1.2rem;
    }

    .premium-actions-buttons {
        flex-direction: column-reverse;
        width: 100%;
        gap: 10px;
    }

    .premium-btn {
        width: 100%;
        justify-content: center;
        padding: 12px 20px;
        font-size: 0.82rem;
    }

    .premium-dropzone-inner {
        flex-direction: column;
        text-align: center;
        gap: 14px;
    }

    .premium-dropzone {
        padding: 22px 16px;
    }

    .premium-dropzone-icon {
        width: 48px;
        height: 48px;
        font-size: 1.1rem;
    }

    /* Make custom dropdowns open full-width on mobile and stay within viewport */
    .divisi-select-panel-inner,
    .role-select-panel-inner {
        max-height: 60vh;
    }
    .divisi-select-options,
    .role-select-options {
        max-height: 50vh;
    }
    .divisi-select-panel-title,
    .role-select-panel-title { font-size: 0.62rem; }
    .divisi-select-panel-meta,
    .role-select-panel-meta { font-size: 0.6rem; }
    .divisi-option,
    .role-option {
        padding: 11px 12px;
        font-size: 0.74rem;
        letter-spacing: 1.2px;
    }
    .divisi-option-icon,
    .role-option-icon {
        width: 26px;
        height: 26px;
        font-size: 0.7rem;
    }
}

@media (max-width: 380px) {
    .premium-hero { padding: 24px 16px 28px; }
    .bento-panel { padding: 20px 16px; }
    .bento-panel-header { gap: 12px; }
    .bento-step { width: 44px; height: 44px; }
    .bento-step-number { font-size: 1.05rem; }
}

/* Prevent horizontal scroll */
html, body {
    overflow-x: hidden;
    max-width: 100%;
}

/* ============================================================ */
/* CUSTOM ROLE SELECT — Premium Animated */
/* ============================================================ */
/* ============================================================ */
/* CUSTOM ROLE SELECT — Premium Animated */
/* ============================================================ */
.role-select {
    position: relative;
    margin-top: 6px;
    z-index: 40;
}

.role-select.is-open {
    z-index: 100;
}

.role-select-native {
    position: absolute;
    width: 1px;
    height: 1px;
    opacity: 0;
    pointer-events: none;
    left: -9999px;
}

.role-select-trigger {
    position: relative;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    padding: 14px 4px 14px;
    background: transparent;
    border: none;
    border-bottom: 1px solid var(--premium-line-strong);
    color: var(--premium-text);
    font-family: inherit;
    font-size: 1rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    cursor: pointer;
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    text-align: left;
}

.role-select-trigger:hover {
    border-bottom-color: rgba(200, 162, 104, 0.4);
}

.role-select-trigger.is-invalid {
    border-bottom-color: #f87171;
}

.role-select-trigger.is-open {
    border-bottom-color: var(--premium-gold);
}

.role-select-value {
    flex: 1;
    display: flex;
    align-items: center;
    gap: 10px;
    overflow: hidden;
}

.role-select-placeholder {
    color: var(--premium-text-faint);
    font-weight: 500;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    font-size: 0.95rem;
    background: linear-gradient(90deg, rgba(245, 245, 247, 0.35), rgba(245, 245, 247, 0.55), rgba(245, 245, 247, 0.35));
    background-size: 200% 100%;
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: placeholderShine 4s ease-in-out infinite;
}

@keyframes placeholderShine {
    0%, 100% { background-position: 0% 50%; }
    50%      { background-position: 100% 50%; }
}

.role-select-value.has-value .role-select-placeholder {
    animation: none;
    background: none;
    -webkit-text-fill-color: initial;
    color: var(--premium-gold-bright);
    font-weight: 700;
    letter-spacing: 1px;
    font-size: 1rem;
}

.role-select-value.has-value::before {
    content: '';
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--premium-gold);
    box-shadow: 0 0 10px var(--premium-gold), 0 0 18px var(--premium-gold-glow);
    flex-shrink: 0;
    animation: valueDotPulse 2.4s ease-in-out infinite;
}

@keyframes valueDotPulse {
    0%, 100% { opacity: 1;   transform: scale(1);   }
    50%      { opacity: 0.5; transform: scale(1.4); }
}

.role-select-arrow {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: rgba(200, 162, 104, 0.06);
    border: 1px solid rgba(200, 162, 104, 0.15);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--premium-gold-bright);
    font-size: 0.7rem;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    flex-shrink: 0;
}

.role-select-trigger:hover .role-select-arrow {
    background: rgba(200, 162, 104, 0.12);
    box-shadow: 0 0 14px var(--premium-gold-soft);
}

.role-select-trigger.is-open .role-select-arrow {
    background: rgba(200, 162, 104, 0.18);
    transform: rotate(180deg);
    box-shadow: 0 0 18px var(--premium-gold-glow);
}

.role-select-glow {
    position: absolute;
    bottom: -1px;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--premium-gold), transparent);
    transform: scaleX(0);
    transform-origin: center;
    transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 0 14px var(--premium-gold-glow);
    pointer-events: none;
}

.role-select-trigger.is-open ~ .role-select-glow {
    transform: scaleX(1);
}

/* ===== PANEL — IMPORTANT: overflow visible on parent bento panel ===== */
.role-select-panel {
    position: absolute;
    top: calc(100% + 12px);
    left: -2px;
    right: -2px;
    z-index: 9999;
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transform: translateY(-8px) scaleY(0.95);
    transform-origin: top center;
    transition: opacity 0.3s ease, transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.3s;
}

.role-select-panel.is-open {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
    transform: translateY(0) scaleY(1);
}

.role-select-panel-inner {
    position: relative;
    background: linear-gradient(180deg, rgba(34, 38, 46, 0.98), rgba(26, 29, 36, 0.98));
    backdrop-filter: blur(24px) saturate(140%);
    -webkit-backdrop-filter: blur(24px) saturate(140%);
    border: 1px solid var(--premium-line-strong);
    border-radius: 18px;
    overflow: hidden;
    box-shadow:
        0 30px 60px rgba(0, 0, 0, 0.6),
        0 12px 30px rgba(0, 0, 0, 0.4),
        inset 0 1px 0 rgba(255, 255, 255, 0.05);
}

.role-select-panel-inner::before {
    content: '';
    position: absolute;
    top: 0;
    left: 16px;
    right: 16px;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--premium-gold-line), transparent);
    opacity: 0.6;
    z-index: 1;
}

.role-select-panel-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 20px 12px;
    border-bottom: 1px solid var(--premium-line);
    background: rgba(0, 0, 0, 0.15);
}

.role-select-panel-title {
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    color: var(--premium-gold-bright);
    text-shadow: 0 0 12px var(--premium-gold-glow);
}

.role-select-panel-meta {
    font-size: 0.68rem;
    color: var(--premium-text-faint);
    letter-spacing: 1px;
    text-transform: uppercase;
    font-weight: 600;
}

.role-select-options {
    max-height: 320px;
    overflow-y: auto;
    padding: 8px;
}

.role-select-options::-webkit-scrollbar {
    width: 6px;
}

.role-select-options::-webkit-scrollbar-track {
    background: transparent;
}

.role-select-options::-webkit-scrollbar-thumb {
    background: rgba(200, 162, 104, 0.25);
    border-radius: 3px;
}

.role-select-options::-webkit-scrollbar-thumb:hover {
    background: rgba(200, 162, 104, 0.45);
}

/* ===== OPTION ===== */
.role-option {
    position: relative;
    width: 100%;
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 12px 14px;
    background: transparent;
    border: 1px solid transparent;
    border-radius: 12px;
    color: var(--premium-text-dim);
    font-family: inherit;
    font-size: 0.82rem;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    text-align: left;
    cursor: pointer;
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
}

.role-option::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, rgba(200, 162, 104, 0.1) 0%, rgba(200, 162, 104, 0.02) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.role-option:hover {
    border-color: rgba(200, 162, 104, 0.25);
    color: var(--premium-text);
    transform: translateX(4px);
    padding-left: 18px;
}

.role-option:hover::before {
    opacity: 1;
}

.role-option.is-selected {
    color: var(--premium-gold-bright);
    background: rgba(200, 162, 104, 0.08);
    border-color: rgba(200, 162, 104, 0.35);
    box-shadow: inset 0 0 18px rgba(200, 162, 104, 0.08);
}

.role-option.is-selected .role-option-text {
    text-shadow: 0 0 14px var(--premium-gold-glow);
}

.role-option-marker {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.15);
    flex-shrink: 0;
    transition: all 0.3s ease;
    position: relative;
    z-index: 1;
}

.role-option:hover .role-option-marker {
    background: var(--premium-gold);
    border-color: var(--premium-gold);
    box-shadow: 0 0 10px var(--premium-gold-glow);
}

.role-option.is-selected .role-option-marker {
    background: var(--premium-gold);
    border-color: var(--premium-gold);
    box-shadow: 0 0 14px var(--premium-gold), 0 0 24px var(--premium-gold-glow);
}

.role-option.is-selected .role-option-marker::after {
    content: '';
    position: absolute;
    inset: -4px;
    border-radius: 50%;
    border: 1px solid var(--premium-gold);
    opacity: 0.6;
    animation: markerRing 1.6s ease-in-out infinite;
}

@keyframes markerRing {
    0%, 100% { transform: scale(1);   opacity: 0.6; }
    50%      { transform: scale(1.5); opacity: 0;   }
}

.role-option-text {
    flex: 1;
    position: relative;
    z-index: 1;
}

.role-option-icon {
    width: 30px;
    height: 30px;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.06);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.78rem;
    color: var(--premium-text-faint);
    flex-shrink: 0;
    transition: all 0.35s ease;
    position: relative;
    z-index: 1;
}

.role-option:hover .role-option-icon {
    color: var(--premium-gold-bright);
    background: rgba(200, 162, 104, 0.1);
    border-color: rgba(200, 162, 104, 0.3);
    transform: scale(1.08) rotate(-5deg);
}

.role-option.is-selected .role-option-icon {
    color: var(--premium-gold);
    background: rgba(200, 162, 104, 0.15);
    border-color: var(--premium-gold-line);
    box-shadow: 0 0 14px var(--premium-gold-soft);
}

/* Override: keep bento panel overflow visible when dropdown open */
.bento-panel.is-selecting {
    overflow: visible;
}

</style>

{{-- ============================================================ --}}
{{-- INTERACTIVE SCRIPTS --}}
{{-- ============================================================ --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    // ===== Dropzone: file preview =====
    const dropzone     = document.getElementById('premiumDropzone');
    const fileInput    = document.getElementById('dokumen_lampiran');
    const filePreview  = document.getElementById('premiumFilePreview');
    const fileName     = document.getElementById('premiumFileName');
    const fileRemove   = document.getElementById('premiumFileRemove');

    if (dropzone && fileInput) {
        ['dragenter', 'dragover'].forEach(evt => {
            dropzone.addEventListener(evt, e => {
                e.preventDefault();
                dropzone.classList.add('dragover');
            });
        });
        ['dragleave', 'drop'].forEach(evt => {
            dropzone.addEventListener(evt, e => {
                e.preventDefault();
                dropzone.classList.remove('dragover');
            });
        });

        dropzone.addEventListener('drop', e => {
            if (e.dataTransfer.files && e.dataTransfer.files[0]) {
                fileInput.files = e.dataTransfer.files;
                handleFile(e.dataTransfer.files[0]);
            }
        });

        fileInput.addEventListener('change', e => {
            if (fileInput.files && fileInput.files[0]) {
                handleFile(fileInput.files[0]);
            }
        });

        if (fileRemove) {
            fileRemove.addEventListener('click', e => {
                e.preventDefault();
                e.stopPropagation();
                fileInput.value = '';
                filePreview.hidden = true;
            });
        }

        function handleFile(file) {
            // Validasi ukuran file di sisi client (maks 10MB)
            const MAX_SIZE = 10 * 1024 * 1024; // 10MB dalam bytes
            if (file.size > MAX_SIZE) {
                alert('Ukuran dokumen lampiran maksimal 10MB. File "' + file.name + '" berukuran ' + (file.size / (1024 * 1024)).toFixed(2) + 'MB.');
                fileInput.value = '';
                filePreview.hidden = true;
                return;
            }
            fileName.textContent = file.name;
            filePreview.hidden = false;
        }
    }

    // ===== Foto profil: preview gambar =====
    const photoDropzone = document.getElementById('photoDropzone');
    const photoInput = document.getElementById('foto');
    const photoPreviewImage = document.getElementById('photoPreviewImage');
    const photoPlaceholderIcon = document.getElementById('photoPlaceholderIcon');
    const photoFileName = document.getElementById('photoFileName');
    const photoUploadTitle = document.getElementById('photoUploadTitle');

    if (photoDropzone && photoInput) {
        ['dragenter', 'dragover'].forEach(evt => {
            photoDropzone.addEventListener(evt, e => {
                e.preventDefault();
                photoDropzone.classList.add('dragover');
            });
        });

        ['dragleave', 'drop'].forEach(evt => {
            photoDropzone.addEventListener(evt, e => {
                e.preventDefault();
                photoDropzone.classList.remove('dragover');
            });
        });

        photoDropzone.addEventListener('drop', e => {
            const file = e.dataTransfer.files?.[0];

            if (file && file.type.startsWith('image/')) {
                const transfer = new DataTransfer();
                transfer.items.add(file);
                photoInput.files = transfer.files;
                showPhotoPreview(file);
            }
        });

        photoInput.addEventListener('change', () => {
            const file = photoInput.files?.[0];

            if (file) {
                showPhotoPreview(file);
            }
        });

        function showPhotoPreview(file) {
            const reader = new FileReader();

            reader.addEventListener('load', event => {
                photoPreviewImage.src = event.target.result;
                photoPreviewImage.hidden = false;
                photoPlaceholderIcon.hidden = true;
                photoUploadTitle.textContent = 'Foto Profil Terpilih';
                photoFileName.textContent = file.name;
            });

            reader.readAsDataURL(file);
        }
    }

    // ===== Subtle floating glow on panels =====
    document.querySelectorAll('.bento-panel').forEach(panel => {
        panel.addEventListener('mousemove', e => {
            const rect = panel.getBoundingClientRect();
            const x = ((e.clientX - rect.left) / rect.width - 0.5) * 8;
            const y = ((e.clientY - rect.top)  / rect.height - 0.5) * 8;
            panel.style.transform = `translate(${x}px, ${y}px)`;
        });
        panel.addEventListener('mouseleave', () => {
            panel.style.transform = '';
        });
    });

    // ===== Custom Divisi Select =====
    const divisiSelect   = document.getElementById('divisiSelect');
    const divisiTrigger  = document.getElementById('divisiTrigger');
    const divisiPanel    = document.getElementById('divisiPanel');
    const divisiValue    = document.getElementById('divisiValue');
    const divisiNative   = document.getElementById('departemen');
    const divisiOptions  = document.querySelectorAll('.divisi-option');

    // Helper: get nearest bento-panel ancestor
    function getBentoPanel(el) {
        return el ? el.closest('.bento-panel') : null;
    }

    // Replay option stagger animation each time panel opens
    function playOptionAnimations() {
        divisiOptions.forEach((opt, idx) => {
            opt.style.animation = 'none';
            // force reflow
            void opt.offsetWidth;
            opt.style.animation = '';
            opt.style.opacity = '0';
            opt.style.transform = 'translateX(-12px)';
            setTimeout(() => {
                opt.style.transition = 'opacity 0.4s cubic-bezier(0.16,1,0.3,1), transform 0.4s cubic-bezier(0.16,1,0.3,1)';
                opt.style.opacity = '1';
                opt.style.transform = 'translateX(0)';
                opt.style.transitionDelay = (idx * 0.04) + 's';
            }, 10);
        });
    }

    if (divisiSelect && divisiTrigger && divisiPanel) {
        const bentoPanel = getBentoPanel(divisiSelect);

        // Toggle dropdown
        divisiTrigger.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            const isOpen = divisiSelect.classList.contains('is-open');
            closeAll();
            if (!isOpen) {
                divisiSelect.classList.add('is-open');
                divisiTrigger.classList.add('is-open');
                divisiPanel.classList.add('is-open');
                divisiTrigger.setAttribute('aria-expanded', 'true');
                if (bentoPanel) bentoPanel.classList.add('is-selecting');
                // Re-trigger stagger animation
                playOptionAnimations();
            }
        });

        // Select option
        divisiOptions.forEach(opt => {
            opt.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                const value = opt.dataset.value;
                const text  = opt.querySelector('.divisi-option-text').textContent;

                // Update native select
                divisiNative.value = value;
                divisiNative.dispatchEvent(new Event('change', { bubbles: true }));

                // Update visual
                divisiValue.innerHTML = `<span class="divisi-option-text" style="letter-spacing:1px;">${text}</span>`;
                divisiValue.classList.add('has-value');

                // Mark selected option
                divisiOptions.forEach(o => o.classList.remove('is-selected'));
                opt.classList.add('is-selected');

                // Close
                closeAll();
            });
        });

        // Initial state from old()
        if (divisiNative.value) {
            const matched = Array.from(divisiOptions).find(o => o.dataset.value === divisiNative.value);
            if (matched) {
                matched.classList.add('is-selected');
                const text = matched.querySelector('.divisi-option-text').textContent;
                divisiValue.innerHTML = `<span class="divisi-option-text" style="letter-spacing:1px;">${text}</span>`;
                divisiValue.classList.add('has-value');
            }
        }

        // Close on outside click
        document.addEventListener('click', (e) => {
            if (!divisiSelect.contains(e.target)) closeAll();
        });

        // Close on ESC
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeAll();
        });

        function closeAll() {
            divisiSelect.classList.remove('is-open');
            divisiTrigger.classList.remove('is-open');
            divisiPanel.classList.remove('is-open');
            divisiTrigger.setAttribute('aria-expanded', 'false');
            if (bentoPanel) bentoPanel.classList.remove('is-selecting');
        }
    }

    // ===== Custom Role Select =====
    const roleSelect   = document.getElementById('roleSelect');
    const roleTrigger  = document.getElementById('roleTrigger');
    const rolePanel    = document.getElementById('rolePanel');
    const roleValue    = document.getElementById('roleValue');
    const roleNative   = document.getElementById('jabatan');
    const roleOptions  = document.querySelectorAll('.role-option');

    function playRoleOptionAnimations() {
        roleOptions.forEach((opt, idx) => {
            opt.style.animation = 'none';
            void opt.offsetWidth;
            opt.style.animation = '';
            opt.style.opacity = '0';
            opt.style.transform = 'translateX(-12px)';
            setTimeout(() => {
                opt.style.transition = 'opacity 0.4s cubic-bezier(0.16,1,0.3,1), transform 0.4s cubic-bezier(0.16,1,0.3,1)';
                opt.style.opacity = '1';
                opt.style.transform = 'translateX(0)';
                opt.style.transitionDelay = (idx * 0.04) + 's';
            }, 10);
        });
    }

    if (roleSelect && roleTrigger && rolePanel) {
        const bentoPanelRole = getBentoPanel(roleSelect);

        roleTrigger.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            const isOpen = roleSelect.classList.contains('is-open');
            closeAll();
            if (!isOpen) {
                roleSelect.classList.add('is-open');
                roleTrigger.classList.add('is-open');
                rolePanel.classList.add('is-open');
                roleTrigger.setAttribute('aria-expanded', 'true');
                if (bentoPanelRole) bentoPanelRole.classList.add('is-selecting');
                playRoleOptionAnimations();
            }
        });

        roleOptions.forEach(opt => {
            opt.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                const value = opt.dataset.value;
                const text  = opt.querySelector('.role-option-text').textContent;

                roleNative.value = value;
                roleNative.dispatchEvent(new Event('change', { bubbles: true }));

                roleValue.innerHTML = `<span class="role-option-text" style="letter-spacing:1px;">${text}</span>`;
                roleValue.classList.add('has-value');

                roleOptions.forEach(o => o.classList.remove('is-selected'));
                opt.classList.add('is-selected');

                // Close all selects
                document.querySelectorAll('.divisi-select, .role-select').forEach(s => {
                    s.classList.remove('is-open');
                    const t = s.querySelector('button');
                    if (t) t.classList.remove('is-open');
                    const p = s.querySelector('.divisi-select-panel, .role-select-panel');
                    if (p) p.classList.remove('is-open');
                    if (t) t.setAttribute('aria-expanded', 'false');
                });
                document.querySelectorAll('.bento-panel.is-selecting').forEach(b => b.classList.remove('is-selecting'));
            });
        });

        if (roleNative.value) {
            const matched = Array.from(roleOptions).find(o => o.dataset.value === roleNative.value);
            if (matched) {
                matched.classList.add('is-selected');
                const text = matched.querySelector('.role-option-text').textContent;
                roleValue.innerHTML = `<span class="role-option-text" style="letter-spacing:1px;">${text}</span>`;
                roleValue.classList.add('has-value');
            }
        }

        function closeRole() {
            roleSelect.classList.remove('is-open');
            roleTrigger.classList.remove('is-open');
            rolePanel.classList.remove('is-open');
            roleTrigger.setAttribute('aria-expanded', 'false');
            if (bentoPanelRole) bentoPanelRole.classList.remove('is-selecting');
        }
    }
});
</script>

@endsection
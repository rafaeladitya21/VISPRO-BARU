<?php
// Build edit.blade.php from create.blade.php by transforming key sections

$src = file_get_contents('C:/Users/adity/Downloads/UTS_Sistem-Informasi-Management-Karyawan_24083000018/resources/views/karyawan/create.blade.php');

// 1. Change form action: store -> update with id
$src = str_replace(
    'action="{{ route(\'karyawan.store\') }}"',
    'action="{{ route(\'karyawan.update\', $employee->id) }}"',
    $src
);

// 2. Add @method(\'PUT\') right after @csrf in form (inside form tag)
$src = preg_replace(
    '/(<form[^>]+>\s*@csrf)/s',
    "$1\n            @method('PUT')",
    $src,
    1
);

// 3. Change hero title
$src = str_replace(
    'Tambah Karyawan<br>
            <span class="premium-title-accent">Baru</span>',
    'Edit Data<br>
            <span class="premium-title-accent">Karyawan</span>',
    $src
);

// 4. Change hero subtitle
$src = str_replace(
    'Daftarkan anggota tim baru ke dalam sistem &mdash;',
    'Perbarui informasi karyawan dengan mudah &mdash;',
    $src
);

// 5. Change meta Formulir to CREW ID with employee->nip
$src = str_replace(
    '<span class="premium-meta-label">Formulir</span>
                <span class="premium-meta-value">KRY-001 / 2026</span>',
    '<span class="premium-meta-label">CREW ID</span>
                <span class="premium-meta-value">{{ $employee->nip }}</span>',
    $src
);

// 6. Change Ready status to Editing
$src = str_replace(
    '<span class="status-dot"></span> Ready',
    '<span class="status-dot"></span> Editing',
    $src
);

// 7. Change 5 Field to Updated
$src = str_replace(
    '<span class="premium-meta-label">Diperlukan</span>
                <span class="premium-meta-value">5 Field</span>',
    '<span class="premium-meta-label">Updated</span>
                <span class="premium-meta-value">{{ now()->format(\'d M Y\') }}</span>',
    $src
);

// 8. Add old(..., $employee->xxx ?? '') values to inputs
$src = str_replace(
    'value="{{ old(\'nama_lengkap\') }}"',
    'value="{{ old(\'nama_lengkap\', $employee->nama_lengkap ?? \'\') }}"',
    $src
);

$src = str_replace(
    'value="{{ old(\'nip\') }}"',
    'value="{{ old(\'nip\', $employee->nip ?? \'\') }}"',
    $src
);

$src = str_replace(
    'value="{{ old(\'email\') }}"',
    'value="{{ old(\'email\', $employee->email ?? \'\') }}"',
    $src
);

$src = str_replace(
    'value="{{ old(\'jabatan\') }}"',
    'value="{{ old(\'jabatan\', $employee->jabatan ?? \'\') }}"',
    $src
);

$src = str_replace(
    'value="{{ old(\'tanggal_bergabung\') }}"',
    'value="{{ old(\'tanggal_bergabung\', $employee->tanggal_bergabung ?? \'\') }}"',
    $src
);

// 9. Update departemen options to use old(..., $employee->departemen)
$src = str_replace(
    '{{ old(\'departemen\') == \'',
    '{{ (old(\'departemen\', $employee->departemen ?? \'\') == \'',
    $src
);

// 10. Update first disabled option default check
$src = str_replace(
    '<option value="" disabled {{ old(\'departemen\') ? \'\' : \'selected\' }}>PILIH DEVISI</option>',
    '<option value="" disabled {{ old(\'departemen\', $employee->departemen ?? \'\') ? \'\' : \'selected\' }}>PILIH DEVISI</option>',
    $src
);

// 11. Change submit button text
$src = str_replace(
    'Simpan Data Karyawan',
    'Update Data Karyawan',
    $src
);

// 12. Add info message about update
$src = str_replace(
    '<span>Data Anda terenkripsi dan aman dalam sistem internal kami.</span>',
    '<span>Perubahan akan langsung tersimpan ke dalam sistem.</span>',
    $src
);

// 13. Add current file indicator after dropzone (before action buttons)
// We'll inject it inside the dropzone panel after the closing label
$currentFileBlock = '

                    @if(isset($employee) && $employee->dokumen_lampiran)
                    <div class="current-file-premium">
                        <i class="fas fa-file-circle-check"></i>
                        <div class="current-file-meta">
                            <span class="current-file-label">Dokumen saat ini</span>
                            <span class="current-file-name">{{ basename($employee->dokumen_lampiran) }}</span>
                        </div>
                        <a href="{{ asset(\'storage/\' . $employee->dokumen_lampiran) }}" target="_blank" class="premium-btn premium-btn-ghost premium-btn-sm">
                            <i class="fas fa-eye"></i>
                            <span>Lihat</span>
                        </a>
                    </div>
                    @endif';

// Inject after the dropzone error message in panel 03
$src = str_replace(
    '@error(\'dokumen_lampiran\')
                        <span class="premium-error">{{ $message }}</span>
                    @enderror
                </div>
            </article>',
    '@error(\'dokumen_lampiran\')
                        <span class="premium-error">{{ $message }}</span>
                    @enderror' . $currentFileBlock . '
                </div>
            </article>',
    $src
);

file_put_contents('C:/Users/adity/Downloads/UTS_Sistem-Informasi-Management-Karyawan_24083000018/resources/views/karyawan/edit.blade.php', $src);
echo 'Edit file built: ' . strlen($src) . " bytes\n";

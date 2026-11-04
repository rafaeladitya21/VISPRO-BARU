<div class="form-section mb-5">
    <h6 class="section-title text-uppercase text-primary mb-1" style="font-size: 0.8rem; letter-spacing: 1px; font-weight: 700;">
        01. Identitas Utama
    </h6>
    <h4 class="h5 mb-4" style="font-weight: 600; color: #1e293b;">Siapa karyawan yang akan didaftarkan/diubah?</h4>
    
    <div class="row g-4">
        <div class="col-md-4">
            <label class="form-label required">Nomor Induk Pegawai (NIP)</label>
            <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" 
                   placeholder="Contoh: 77777777" value="{{ old('nip', $employee->nip ?? '') }}">
            @error('nip') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        
        <div class="col-md-8">
            <label class="form-label required">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" 
                   placeholder="Masukkan nama sesuai KTP" value="{{ old('nama_lengkap', $employee->nama_lengkap ?? '') }}">
            @error('nama_lengkap') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-12">
            <label class="form-label required">Alamat Email Perusahaan</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                   placeholder="nama@perusahaan.com" value="{{ old('email', $employee->email ?? '') }}">
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
</div>

<hr class="my-5" style="border-top: 1px dashed #cbd5e1; opacity: 0.6;">

<div class="form-section mb-5">
    <h6 class="section-title text-uppercase text-primary mb-1" style="font-size: 0.8rem; letter-spacing: 1px; font-weight: 700;">
        02. Penugasan & Jabatan
    </h6>
    <h4 class="h5 mb-4" style="font-weight: 600; color: #1e293b;">Di mana posisi dan kapan karyawan mulai bekerja?</h4>

    <div class="row g-4">
        <div class="col-md-6">
            <label class="form-label required">Departemen / Divisi</label>
            <input type="text" name="departemen" class="form-control @error('departemen') is-invalid @enderror" 
                   placeholder="Contoh: Teknologi Informasi, Kreatif" value="{{ old('departemen', $employee->departemen ?? '') }}">
            @error('departemen') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label required">Jabatan Resmi</label>
            <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" 
                   placeholder="Contoh: Senior Developer, Lead Videographer" value="{{ old('jabatan', $employee->jabatan ?? '') }}">
            @error('jabatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label required">Tanggal Bergabung</label>
            <div class="input-group">
                <input type="date" name="tanggal_bergabung" class="form-control @error('tanggal_bergabung') is-invalid @enderror" 
                       value="{{ old('tanggal_bergabung', $employee->tanggal_bergabung ?? '') }}">
            </div>
            @error('tanggal_bergabung') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
</div>

<hr class="my-5" style="border-top: 1px dashed #cbd5e1; opacity: 0.6;">
<div class="form-section mb-5">
    <h6 class="section-title text-uppercase text-primary mb-1" style="font-size: 0.8rem; letter-spacing: 1px; font-weight: 700;">
        03. Dokumen Lampiran
    </h6>
    <h4 class="h5 mb-4" style="font-weight: 600; color: #1e293b;">Apakah ada contoh berkas atau dokumen pendukung?</h4>

    <div class="upload-zone p-5 text-center mb-4">
        <div class="d-flex flex-column flex-sm-row justify-content-center align-items-center gap-3">
            
            <input type="file" name="dokumen_lampiran" id="dokumen_lampiran" class="d-none @error('dokumen_lampiran') is-invalid @enderror" accept=".pdf,.doc,.docx,.jpg,.png">
            
            <button type="button" onclick="document.getElementById('dokumen_lampiran').click()" class="btn btn-outline-primary px-4 py-2" style="font-weight: 600; border-radius: 8px;">
                Unggah Dokumen
            </button>
            
            <span id="file-name-preview" class="text-muted" style="font-size: 0.9rem;">Klik tombol untuk memilih berkas Anda</span>
        </div>

        @error('dokumen_lampiran') 
            <div class="text-danger mt-3" style="font-size: 0.85rem;">{{ $message }}</div> 
        @enderror
    </div>
    
    @if(isset($employee) && $employee->dokumen_lampiran)
    <div class="uploaded-files-list p-3" style="background-color: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0;">
        <div class="d-flex justify-content-between align-items-center py-2 px-3 bg-white" style="border-radius: 8px;">
            <div class="d-flex align-items-center gap-2">
                <span class="text-muted" style="font-size: 0.85rem;">
                    <strong>Dokumen saat ini:</strong> {{ basename($employee->dokumen_lampiran) }}
                </span>
            </div>
            <a href="{{ asset('storage/' . $employee->dokumen_lampiran) }}" target="_blank" class="text-primary text-decoration-none" style="font-size: 0.85rem; font-weight: 500;">Lihat File</a>
        </div>
    </div>
    @endif
</div>

<script>
    document.getElementById('dokumen_lampiran').addEventListener('change', function(event) {
        var input = event.target;
        var previewText = document.getElementById('file-name-preview');
        
        // Jika ada file yang dipilih
        if (input.files && input.files[0]) {
            var fileName = input.files[0].name;
            // Ubah teks menjadi nama file dengan aksen warna primer agar terlihat jelas
            previewText.innerHTML = '<span style="color: #4f46e5; font-weight: 600;">📄 File terpilih:</span> ' + fileName;
        } else {
            // Jika user membatalkan pilihan file
            previewText.innerHTML = 'Klik tombol untuk memilih berkas Anda';
        }
    });
</script>
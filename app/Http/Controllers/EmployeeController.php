<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index()
    {
        // Menggunakan pagination agar performa tetap baik saat data membesar
        $employees = Employee::latest()->paginate(10);

        return view('karyawan.index', compact('employees'));
    }

    public function create()
    {
        return view('karyawan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'required|string|max:20|unique:employees,nip',
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'jabatan' => 'required|string|max:100',
            'departemen' => 'required|string|max:100',
            'tanggal_bergabung' => 'required|date',
            // Validasi file: maksimal 10MB, format PDF/DOC/DOCX/JPG/PNG
            'dokumen_lampiran' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:10240',
            // Validasi foto profil: wajib, maksimal 10MB, format JPG/PNG/WEBP
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:10240',
        ], [
            'foto.required' => 'Foto profil wajib dipilih.',
            'foto.image' => 'File foto profil harus berupa gambar.',
            'foto.mimes' => 'Foto profil harus berformat JPG, JPEG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran foto profil maksimal 10MB.',
            'dokumen_lampiran.mimes' => 'Dokumen lampiran harus berformat PDF, DOC, DOCX, JPG, atau PNG.',
            'dokumen_lampiran.max' => 'Ukuran dokumen lampiran maksimal 10MB.',
        ]);

        $storedFiles = [];

        try {
            // Logika Upload File Dokumen
            if ($request->hasFile('dokumen_lampiran')) {
                $path = $request->file('dokumen_lampiran')->store('dokumen', 'public');
                $validated['dokumen_lampiran'] = $path;
                $storedFiles[] = $path;
            }

            // Logika Upload Foto Profile
            if ($request->hasFile('foto')) {
                $path = $request->file('foto')->store('foto', 'public');
                $validated['foto'] = $path;
                $storedFiles[] = $path;
            }

            Employee::create($validated);
        } catch (\Throwable $exception) {
            Storage::disk('public')->delete($storedFiles);

            throw $exception;
        }

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    // Pada method edit - menggunakan findOrFail
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);

        return view('karyawan.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $validated = $request->validate([
            'nip' => 'required|string|max:20|unique:employees,nip,'.$employee->id,
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,'.$employee->id,
            'jabatan' => 'required|string|max:100',
            'departemen' => 'required|string|max:100',
            'tanggal_bergabung' => 'required|date',
            'dokumen_lampiran' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:10240',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'hapus_foto' => 'nullable|boolean',
        ], [
            'foto.image' => 'File foto profil harus berupa gambar.',
            'foto.mimes' => 'Foto profil harus berformat JPG, JPEG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran foto profil maksimal 10MB.',
            'dokumen_lampiran.mimes' => 'Dokumen lampiran harus berformat PDF, DOC, DOCX, JPG, atau PNG.',
            'dokumen_lampiran.max' => 'Ukuran dokumen lampiran maksimal 10MB.',
        ]);

        $oldDocumentPath = $employee->dokumen_lampiran;
        $oldPhotoPath = $employee->foto;
        $shouldDeletePhoto = $request->boolean('hapus_foto') && ! $request->hasFile('foto');
        $newFiles = [];

        unset($validated['hapus_foto']);

        try {
            // Simpan dokumen baru terlebih dahulu agar dokumen lama tetap aman jika upload gagal.
            if ($request->hasFile('dokumen_lampiran')) {
                $path = $request->file('dokumen_lampiran')->store('dokumen', 'public');
                $validated['dokumen_lampiran'] = $path;
                $newFiles[] = $path;
            }

            // Simpan foto baru terlebih dahulu agar foto lama tetap aman jika upload gagal.
            if ($request->hasFile('foto')) {
                $path = $request->file('foto')->store('foto', 'public');
                $validated['foto'] = $path;
                $newFiles[] = $path;
            } elseif ($shouldDeletePhoto) {
                $validated['foto'] = null;
            }

            $employee->update($validated);
        } catch (\Throwable $exception) {
            Storage::disk('public')->delete($newFiles);

            throw $exception;
        }

        if ($request->hasFile('dokumen_lampiran') && $oldDocumentPath) {
            Storage::disk('public')->delete($oldDocumentPath);
        }

        if (($request->hasFile('foto') || $shouldDeletePhoto) && $oldPhotoPath) {
            Storage::disk('public')->delete($oldPhotoPath);
        }

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        // Hapus foto jika ada
        if ($employee->foto && Storage::disk('public')->exists($employee->foto)) {
            Storage::disk('public')->delete($employee->foto);
        }

        // Hapus dokumen lampiran jika ada
        if ($employee->dokumen_lampiran && Storage::disk('public')->exists($employee->dokumen_lampiran)) {
            Storage::disk('public')->delete($employee->dokumen_lampiran);
        }

        $employee->delete();

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil dihapus.');
    }
}

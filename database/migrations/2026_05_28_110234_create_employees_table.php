<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 20)->unique()->comment('Nomor Induk Pegawai');
            $table->string('nama_lengkap');
            $table->string('email')->unique();
            $table->string('jabatan');
            $table->string('departemen');
            $table->date('tanggal_bergabung');
            // TAMBAHAN: Kolom untuk menyimpan path dokumen (bisa null jika opsional)
            $table->string('dokumen_lampiran')->nullable(); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
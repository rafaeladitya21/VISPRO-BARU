<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'nama_lengkap',
        'email',
        'jabatan',
        'departemen',
        'tanggal_bergabung',
        'dokumen_lampiran',
        'foto',
    ];
}

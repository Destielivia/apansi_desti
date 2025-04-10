<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table='siswas';
    protected $fillable = [
        'no_daftar', 'nisn', 'nik', 'nama', 'asal_sekolah',
        'agama', 'ttl', 'alamat', 'jurusan', 'jenis_kelamin', 'pas_poto'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'tb_alternatif';
    protected $primaryKey = 'kode_alternatif';
    public $incrementing = false;

    protected $fillable = ['kode_alternatif', 'nama_alternatif', 'jenis_kelamin', 'prodi', 'nim', 'semester', 'nilai'];
}

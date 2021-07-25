<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    protected $table = 'tb_alternatif';
    protected $primaryKey = 'kode_alternatif';
    public $incrementing = false;

    protected $fillable = ['kode_alternatif', 'nama_alternatif', 'jenis_kelamin', 'prodi', 'nim', 'semester', 'atribut', 'bobot'];

    public function nilais()
    {
        return $this->belongsToMany(Kriteria::class, 'tb_rel_alternatif', 'kode_alternatif', 'kode_kriteria')->withPivot('ID', 'nilai', 'file');
    }
}

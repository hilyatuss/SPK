<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rel_Alternatif extends Model
{
    protected $table = 'tb_rel_alternatif';
    protected $primaryKey = 'ID';

    protected $fillable = ['kode_alternatif', 'kode_kriteria', 'nilai'];
}

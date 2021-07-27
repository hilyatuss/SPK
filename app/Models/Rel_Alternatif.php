<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rel_Alternatif extends Model
{
    protected $table = 'tb_rel_alternatif';
    protected $primaryKey = 'id';

    protected $fillable = ['nim', 'kode_kriteria', 'nilai', 'file'];
}

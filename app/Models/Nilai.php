<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'tb_nilai';
    protected $primaryKey = 'kode_nilai';

    protected $fillable = ['kode_nilai', 'kriteria_id', 'nilai', 'file'];

}

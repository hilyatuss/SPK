<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    protected $table = 'tb_periode';
    protected $primaryKey = 'ID';

    protected $fillable = ['ID', 'mulai', 'selesai', 'status'];

}

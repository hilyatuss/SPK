<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    protected $table = 'tb_periode';
    protected $primaryKey = 'id';

    protected $fillable = ['id', 'mulai', 'selesai', 'status'];

}

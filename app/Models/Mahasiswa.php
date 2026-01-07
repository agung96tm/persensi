<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'no_kartu',
        'nim',
        'nama',
        'kelas'
    ];
}

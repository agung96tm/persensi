<?php

class Sesi extends Model
{
    protected $table = 'sesi';
    public $timestamps = false;

    protected $fillable = [
        'nama_sesi',
        'kelas',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'status'
    ];
}

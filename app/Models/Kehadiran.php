<?php

class Kehadiran extends Model
{
    protected $table = 'kehadiran';
    public $timestamps = false;

    protected $fillable = [
        'sesi_id',
        'mahasiswa_id',
        'waktu_hadir'
    ];
}

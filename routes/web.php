<?php

use App\Models\Mahasiswa;

Route::get('/test-db', function () {
    return Mahasiswa::all();
});

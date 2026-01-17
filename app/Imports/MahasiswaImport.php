<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MahasiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // buat email default kalau kosong
        $email = $row['email'] ?? $row['nim'].'@student.budiluhur.ac.id';

        // buat user otomatis
        $user = User::create([
            'name' => $row['nama'],
            'email' => $email,
            'password' => Hash::make('12345678'),
            'role' => 'user',
        ]);

        return new Mahasiswa([
            'user_id'  => $user->id,
            'nim'      => $row['nim'],
            'nama'     => $row['nama'],
            'no_kartu' => $row['no_kartu'],
            'kelas'    => $row['kelas'],
        ]);
    }
}

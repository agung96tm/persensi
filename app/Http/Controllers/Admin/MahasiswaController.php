<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Imports\MahasiswaImport;
use Maatwebsite\Excel\Facades\Excel;


class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::with('user')->get();
        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        return view('admin.mahasiswa.create');
    }

public function store(Request $request)
{
    $request->validate([
        'nim'      => 'required|unique:mahasiswa,nim',
        'nama'     => 'required|string|max:255',
        'email'    => 'nullable|email|unique:users,email',
        'no_kartu' => 'required|unique:mahasiswa,no_kartu',
        'kelas'    => 'required|max:2',
    ]);

    // 🔹 Generate email jika tidak diisi
    $email = $request->email ?? ($request->nim . '@student.budiluhur.ac.id');

    // 🔹 BUAT USER OTOMATIS
    $user = User::create([
        'name'     => $request->nama,
        'email'    => $email,
        'password' => Hash::make('12345678'), // password default
        'role'     => 'user',
    ]);

    // 🔹 BUAT MAHASISWA
    Mahasiswa::create([
        'user_id'  => $user->id,
        'nim'      => $request->nim,
        'nama'     => $request->nama,
        'no_kartu' => $request->no_kartu,
        'kelas'    => $request->kelas,
    ]);

    return redirect()->route('mahasiswa.index')
        ->with('success', 'Mahasiswa & akun user berhasil ditambahkan');
}

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim,' . $mahasiswa->id,
            'nama' => 'required|string|max:255',
            'no_kartu' => 'required|unique:mahasiswa,no_kartu,' . $mahasiswa->id,
            'kelas' => 'required|max:2',
        ]);

        $mahasiswa->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'no_kartu' => $request->no_kartu,
            'kelas' => $request->kelas,
        ]);

        // 🔹 Sinkronkan nama user
        if ($mahasiswa->user) {
            $mahasiswa->user->update([
                'name' => $request->nama
            ]);
        }

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        // Optional: hapus user juga
        if ($mahasiswa->user) {
            $mahasiswa->user->delete();
        }

        $mahasiswa->delete();

        return back()->with('success', 'Mahasiswa berhasil dihapus');
    }
    public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv'
    ]);

    Excel::import(new MahasiswaImport, $request->file('file'));

    return redirect()
        ->route('mahasiswa.index')
        ->with('success', 'Data mahasiswa berhasil diimport');
}
}

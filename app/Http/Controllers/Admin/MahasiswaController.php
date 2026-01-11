<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::with('user')->get();
        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        $users = User::where('role','user')->doesntHave('mahasiswa')->get();
        return view('admin.mahasiswa.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|unique:mahasiswa',
            'nim' => 'required|unique:mahasiswa',
            'no_kartu' => 'required|unique:mahasiswa',
            'kelas' => 'required|max:2'
        ]);

        Mahasiswa::create($request->all());

        return redirect()->route('mahasiswa.index')
            ->with('success','Mahasiswa berhasil ditambahkan');
    }

    public function edit(Mahasiswa $mahasiswa)
    {   
        $mahasiswa = Mahasiswa::findOrFail($mahasiswa->id);
        $users = User::all(); // ← INI WAJIB
        return view('admin.mahasiswa.edit', compact('mahasiswa', 'users'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim,' . $mahasiswa->id,
            'no_kartu' => 'required|unique:mahasiswa,no_kartu,' . $mahasiswa->id,
            'kelas' => 'required|max:2'
        ]);

        $mahasiswa->update($request->all());

        return redirect()->route('mahasiswa.index')
            ->with('success','Mahasiswa berhasil diupdate');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return back()->with('success','Mahasiswa berhasil dihapus');
    }
}

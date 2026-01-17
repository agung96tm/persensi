<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kehadiran;
use App\Models\Sesi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KehadiranController extends Controller
{
    public function index($sesi_id)
    {
        $sesi = Sesi::findOrFail($sesi_id);
        $kehadiran = Kehadiran::with('mahasiswa')
            ->where('sesi_id', $sesi_id)
            ->get();

        return view('admin.kehadiran.index', compact('sesi','kehadiran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sesi_id' => 'required',
            'mahasiswa_id' => 'required'
        ]);

        $sesi = Sesi::findOrFail($request->sesi_id);

        // ❌ sesi tidak aktif
        if ($sesi->status !== 'aktif') {
            return back()->with('error','Sesi sudah ditutup');
        }

        // ❌ sudah absen
        $cek = Kehadiran::where('sesi_id',$request->sesi_id)
            ->where('mahasiswa_id',$request->mahasiswa_id)
            ->exists();

        if ($cek) {
            return back()->with('error','Mahasiswa sudah hadir');
        }

        Kehadiran::create([
            'sesi_id' => $request->sesi_id,
            'mahasiswa_id' => $request->mahasiswa_id,
            'waktu_hadir' => Carbon::now()
        ]);

        return back()->with('success','Presensi berhasil');
    }
}

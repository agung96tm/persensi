<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sesi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;


class SesiController extends Controller
{
    public function index()
    {
        $sesi = Sesi::orderBy('tanggal','desc')->get();
        return view('admin.sesi.index', compact('sesi'));
    }

    public function create()
    {
        return view('admin.sesi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sesi' => 'required',
            'kelas' => 'required',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required'
        ]);

        // NONAKTIFKAN SESI LAIN DI KELAS YANG SAMA
        Sesi::where('kelas',$request->kelas)
            ->update(['status'=>'selesai']);

        Sesi::create([
            'nama_sesi'=>$request->nama_sesi,
            'kelas'=>$request->kelas,
            'tanggal'=>$request->tanggal,
            'jam_mulai'=>$request->jam_mulai,
            'jam_selesai'=>$request->jam_selesai,
            'status'=>'aktif'
        ]);

        return redirect()->route('admin.sesi.index')
            ->with('success','Sesi presensi berhasil dibuat & diaktifkan');
    }

    public function selesai($id)
    {
        Sesi::where('id',$id)->update(['status'=>'selesai']);
        return back()->with('success','Sesi ditutup');
    }

    private function autoCloseSesi()
{
    $now = Carbon::now();

    Sesi::where('status', 'aktif')
        ->where(function ($q) use ($now) {
            $q->whereDate('tanggal', '<', $now->toDateString())
              ->orWhere(function ($q2) use ($now) {
                  $q2->whereDate('tanggal', $now->toDateString())
                     ->where('jam_selesai', '<=', $now->format('H:i:s'));
              });
        })
        ->update(['status' => 'selesai']);
}
}

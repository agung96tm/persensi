<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Kehadiran;
use App\Models\Mahasiswa;
use App\Models\Sesi;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalMahasiswa = Mahasiswa::count();
        $totalSesiAktif = Sesi::where('status', 'aktif')->count();

        $kehadiranHariIni = Kehadiran::whereDate('created_at', today())
            ->whereIn('status', ['hadir', 'terlambat'])
            ->count();

        $totalSesi = Sesi::count();

        $activities = ActivityLog::where('user_id', auth()->id())
            ->latest()
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalMahasiswa',
            'totalSesiAktif',
            'kehadiranHariIni',
            'totalSesi',
            'activities'
        ));
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kehadiran;
use App\Models\Sesi;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;
        $today = Carbon::today();

        $monthlyAttendanceCount = 0;
        $attendancePercentage = 0;
        $todayStatus = null;
        $recentAttendances = collect();

        if ($mahasiswa) {
            $monthlyAttendanceCount = Kehadiran::where('mahasiswa_id', $mahasiswa->id)
                ->whereIn('status', ['hadir', 'terlambat'])
                ->whereHas('sesi', function ($query) use ($today) {
                    $query->whereYear('tanggal', $today->year)
                        ->whereMonth('tanggal', $today->month);
                })
                ->count();

            $totalSessionsMonth = Sesi::where('kelas', $mahasiswa->kelas)
                ->whereYear('tanggal', $today->year)
                ->whereMonth('tanggal', $today->month)
                ->count();

            $attendancePercentage = $totalSessionsMonth > 0
                ? round(($monthlyAttendanceCount / $totalSessionsMonth) * 100)
                : 0;

            $todayAttendance = Kehadiran::where('mahasiswa_id', $mahasiswa->id)
                ->whereHas('sesi', function ($query) use ($today, $mahasiswa) {
                    $query->whereDate('tanggal', $today)
                        ->where('kelas', $mahasiswa->kelas);
                })
                ->latest('waktu_hadir')
                ->first();

            $todayStatus = $todayAttendance?->status;

            $recentAttendances = Kehadiran::with('sesi')
                ->where('mahasiswa_id', $mahasiswa->id)
                ->orderByDesc('created_at')
                ->take(5)
                ->get();
        }

        $statusConfig = [
            'hadir' => ['label' => 'Hadir', 'icon' => 'bi-check-circle'],
            'terlambat' => ['label' => 'Terlambat', 'icon' => 'bi-exclamation-circle'],
            'izin' => ['label' => 'Izin', 'icon' => 'bi-info-circle'],
            'sakit' => ['label' => 'Sakit', 'icon' => 'bi-emoji-frown'],
            'alpha' => ['label' => 'Alpha', 'icon' => 'bi-x-circle'],
        ];

        $todayStatusLabel = $statusConfig[$todayStatus]['label'] ?? 'Belum Absen';
        $todayStatusIcon = $statusConfig[$todayStatus]['icon'] ?? 'bi-dash-circle';

        return view('user.dashboard', compact(
            'mahasiswa',
            'monthlyAttendanceCount',
            'attendancePercentage',
            'todayStatusLabel',
            'todayStatusIcon',
            'recentAttendances'
        ));
    }

    public function kehadiran()
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;
        $today = Carbon::today();

        $sessions = collect();
        $attendanceBySession = collect();

        if ($mahasiswa) {
            $sessions = Sesi::where('kelas', $mahasiswa->kelas)
                ->whereDate('tanggal', $today)
                ->orderBy('jam_mulai')
                ->get();

            if ($sessions->isNotEmpty()) {
                $attendanceBySession = Kehadiran::where('mahasiswa_id', $mahasiswa->id)
                    ->whereIn('sesi_id', $sessions->pluck('id'))
                    ->get()
                    ->keyBy('sesi_id');
            }
        }

        return view('user.kehadiran', compact('mahasiswa', 'sessions', 'attendanceBySession'));
    }

    public function riwayat()
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;

        if ($mahasiswa) {
            $riwayat = Kehadiran::with('sesi')
                ->where('mahasiswa_id', $mahasiswa->id)
                ->orderByDesc('created_at')
                ->paginate(10);
        } else {
            $riwayat = new LengthAwarePaginator([], 0, 10);
        }

        return view('user.riwayat', compact('mahasiswa', 'riwayat'));
    }

    public function profile()
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;

        return view('user.profile', compact('mahasiswa'));
    }
}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kehadiran Sesi</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 12px; color: #222; }
        h1 { font-size: 16px; margin: 0 0 8px; }
        .meta { font-size: 11px; color: #666; margin-bottom: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 6px 8px; }
        th { background: #f2f2f2; text-align: left; }
        .center { text-align: center; }
    </style>
</head>
<body>
    <h1>Kehadiran Sesi</h1>
    <div class="meta">
        Sesi: {{ $sesi->nama_sesi }} | Kelas: {{ $sesi->kelas }} |
        Tanggal: {{ \Carbon\Carbon::parse($sesi->tanggal)->format('d/m/Y') }} |
        Jam: {{ \Carbon\Carbon::parse($sesi->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($sesi->jam_selesai)->format('H:i') }}
        <br>
        Dicetak: {{ now()->format('d/m/Y H:i') }}
        @if(!empty($search))
            | Cari: {{ $search }}
        @endif
        @if(!empty($status))
            | Status: {{ $status }}
        @endif
        | Total: {{ $rows->count() }}
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 40px;" class="center">No</th>
                <th style="width: 90px;">NIM</th>
                <th>Nama</th>
                <th style="width: 120px;">Waktu Hadir</th>
                <th style="width: 120px;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rows as $index => $row)
                <tr>
                    <td class="center">{{ $index + 1 }}</td>
                    <td>{{ $row->nim }}</td>
                    <td>{{ $row->nama }}</td>
                    <td class="center">
                        @if($row->kehadiran_waktu_hadir)
                            {{ \Carbon\Carbon::parse($row->kehadiran_waktu_hadir)->format('d/m/Y H:i') }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="center">{{ $row->kehadiran_status ?? 'Belum Diabsen' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>

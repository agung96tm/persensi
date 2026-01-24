<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
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
    <h1>Data Mahasiswa</h1>
    <div class="meta">
        Dicetak: {{ now()->format('d/m/Y H:i') }}
        @if(!empty($search))
            | Filter: {{ $search }}
        @endif
        | Total: {{ $mahasiswa->count() }}
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 40px;" class="center">No</th>
                <th>Nama</th>
                <th style="width: 90px;">NIM</th>
                <th style="width: 60px;">Kelas</th>
                <th style="width: 120px;">UID RFID</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mahasiswa as $index => $m)
                <tr>
                    <td class="center">{{ $index + 1 }}</td>
                    <td>{{ $m->user?->name ?? $m->nama }}</td>
                    <td>{{ $m->nim }}</td>
                    <td class="center">{{ $m->kelas }}</td>
                    <td>{{ $m->no_kartu }}</td>
                    <td>{{ $m->user?->email ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
